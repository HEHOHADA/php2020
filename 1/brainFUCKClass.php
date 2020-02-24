<?php


class brainFUCK
{
    public $code = null;
    public $input = null;
    public $result = null;
    public int $index = 0;
    public int $pointer = 0;
    public array $cells = array();
    public array $array = array();


    public function __construct($code, $input = null)
    {
        $this->code = $code;
        $this->input = $input;
        $this->array = array_values(array_filter(preg_split('//', $this->code)));

    }

    private function cycle($i, $symbol, $_symbol)
    {
        if ($this->cells[$this->index] == 0 && $symbol == '[' ||
            $this->cells[$this->index] != 0 && $symbol == ']') {
            $brackets = 1;
            while ($brackets) {
                $symbol == '[' ? $i++ : $i--;
                if ($this->array[$i] == $symbol) {
                    $brackets++;
                } else if ($this->array[$i] == $_symbol) {
                    $brackets--;
                }
            }
        }
        return $i;

    }

    public function start()
    {
        for ($i = 0; $i < count($this->array); ++$i) {
            if (!isset($this->cells[$this->index])) {
                $this->cells[$this->index] = 0;
            }

            switch ($this->array[$i]) {
                case '>':
                    $this->index++;
                    break;
                case '<':
                    $this->index--;

                    break;
                case '+':
                    $this->cells[$this->index]++;;
                    break;
                case '-':
                    $this->cells[$this->index]--;
                    break;
                case '.':
                    $this->result .= chr($this->cells[$this->index]);
                    break;
                case ',':
                    $this->cells[$this->index] = isset($this->input[$this->pointer]) ?
                        ord($this->input[$this->pointer]) : 0;
                    $this->pointer++;
                    break;
                case '[':
                    $i = $this->cycle($i, '[', ']');
                    break;
                case ']':
                    $i = $this->cycle($i, ']', '[');
                    break;
            }
        }
        return $this->result;
    }
}