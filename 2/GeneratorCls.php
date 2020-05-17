<?php


class GeneratorCls
{
    public $input = null;
    public $result = null;
    public int $count = 0;

    public function __construct($input = null)
    {
        $this->input = $input;
    }

    public function run()
    {
        foreach ($this->getNewText($this->input) as $res) {
            $this->result.= $res;
        }
        echo "Итоговый текст: $this->result";
        echo "<br/>";
        echo "Число замен: $this->count";
    }

    function getNewText($text)
    {
        try {
            for ($i = 0; $i < strlen($text); $i++) {
                switch ($text[$i]) {
                    case "h":
                        $this->count++;
                        yield "4";
                        break;
                    case"l":
                        $this->count++;
                        yield "1";
                        break;
                    case"e":
                        $this->count++;
                        yield "3";
                        break;
                    case"o":
                        $this->count++;
                        yield "0";
                        break;
                    default:
                        yield $text[$i];
                        break;
                }
            }
        } finally {
            return;
        }
    }
}
