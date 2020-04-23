<?php


class Calendar
{
    private DateTime $dayinmonth;
    private array $calendar;
    private int $weekcount;
    private DateTime $today;
    private DatePeriod $month_period;
    private $check = false;

    public function __construct($month)
    {
        if ($month !== '') {
            $this->today = new DateTime(date('y-m-d', mktime(0, 0, 0, $month, 1)));

        } else {
            $this->today = new DateTime(date('y-m-d', mktime(0, 0, 0, date('m'), 1)));
            $this->check = true;
        }
        $this->month_period = new DatePeriod($this->today, new DateInterval('P1D'), $this->lastDay);
        $this->calendar[-1] = ["П", "В", "С", "Ч", "П", "С", "В"];
        $this->calendar[0] = array_fill(0, 7, "");
    }

    public function run()
    {
        $this->makeCalendar();
        $this->drawCalendar();
    }


    private function makeCalendar()
    {
        $this->weekcount = 0;
        foreach ($this->month_period as $item) {
            $this->calendar[$this->weekcount][$item->format('N') - 1] = (int)$item->format('d');
            if ($item->format('N') == 7) {
                $this->weekcount++;
            }
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
                } else if (($this->calendar[$i][$j] == date('d') && $this->check)) {
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