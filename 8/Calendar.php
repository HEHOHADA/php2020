<?php


class Calendar
{
    private $month = null;
    private int $dayinmonth;
    private array $calendar;
    private int $countofday;
    private int $weekcount;
    private $today = -2;

    public function __construct($month)
    {
        if ($month !== '') {
            $this->month = (int)$month;
        } else {
            $this->month = date('m');
            $this->today = date('d');
        }
        $this->dayinmonth = date('t', mktime(0, 0, 0, $this->month));
        $this->countofday = 1;
        $this->calendar[-1] = ["П", "В", "С", "Ч", "П", "С", "В"];
        $this->calendar[0] = array_fill(0, 7, "");
    }

    public function run()
    {
        $this->makeFirstWeek();
        $this->makeOtherWeeks();
        $this->drawCalendar();
    }

    private function makeFirstWeek()
    {
        $this->weekcount = 0;
        for ($i = 0; $i < 7; $i++) {
            $weekdays = date('w',
                mktime(0, 0, 0, $this->month, $this->countofday));
            $weekdays = $weekdays - 1;
            if ($weekdays == -1) $weekdays = 6;
            if ($weekdays == $i) {
                $this->calendar[$this->weekcount][$i] = $this->countofday;
                $this->countofday++;
            }
        }
    }

    private function makeOtherWeeks()
    {
        while (true) {
            $this->weekcount++;
            for ($i = 0; $i < 7; $i++) {
                $this->calendar[$this->weekcount][$i] = $this->countofday;
                $this->countofday++;
                if ($this->countofday > $this->dayinmonth) break;
            }
            if ($this->countofday > $this->dayinmonth) break;
        }
    }

    private function drawCalendar()
    {
        echo "<table>";
        for ($i = -1; $i < count($this->calendar) - 1; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++) {
                $body = null;
                $style = null;
                if ($j == 5 || $j == 6) {
                    $style = "bgcolor='red'";
                }
                if (empty($this->calendar[$i][$j])) {
                    $body = "<td>&nbsp;</td>";
                } else if (((int)$this->calendar[$i][$j] === (int)$this->today)) {
                    $body = "<td $style>" . "<b>" . $this->calendar[$i][$j] . "</b>" . "</tda>";
                } else {
                    $body = "<td $style>" . $this->calendar[$i][$j] . "</td>";
                }
                echo $body;
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}