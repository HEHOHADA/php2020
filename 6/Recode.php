<?php


class Recode
{
    private $ini = null;
    private $file = null;
    private int $de_in = 0;
    private bool $upp = false;

    public function __construct($ini)
    {
        $this->ini = $ini;
        $this->file = file($ini["main"]["filename"]);
        $this->de_in = $this->ini["second_rule"]["direction"] == "+" ? 1 : -1;
        $this->upp = $this->ini["first_rule"]["upper"];
    }

    public function run()
    {
        for ($i = 0; $i < count($this->file); $i++) {
            $this->upp_down($this->file[$i], $i);
            $this->decrease_increase($this->file[$i], $i);
            $this->delete($this->file[$i], $i);

            echo $this->file[$i] . "<br/>";
        }

    }

    private function upp_down($line, $index)
    {
        if ($this->ini["first_rule"]["symbol"] === $line[0]) {
            $this->upp ?
                $this->file[$index] = strtoupper($line) :
                $this->file[$index] = strtolower($line);
        }
    }

    private function decrease_increase($line, $index)
    {
        if ($line[0] == $this->ini["second_rule"]["symbol"]) {
            for ($i = 0; $i < strlen($line); $i++)
                if (ctype_digit($line[$i])) {
                    $this->file[$index][$i] = ((int)$line[$i] + $this->de_in) % 10;
                }
        }
    }

    private function delete($line, $index)
    {
        if ($line[0] == $this->ini["third_rule"]["symbol"])
            $this->file[$index] = implode("", explode($this->ini["third_rule"]["delete"], $line));
    }
}