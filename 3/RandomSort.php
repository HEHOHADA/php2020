<?php


class RandomSort
{
    private $code = null;
    private $array = [];
    private $resultWithoutSort = [];


    public function __construct($code)
    {
        $this->code = $code;
        $this->array = array_values(array_filter(preg_split('\n', $this->code)));
        array_push($this->resultWithoutSort,$this->array);
    }

    public function run()
    {
        foreach ($this->shuffleText($this->array) as $val) {
            array_push($this->resultWithoutSort, $val);
        }
        $this->sortArraySecondElem($this->resultWithoutSort);
    }

    private function shuffleText($array)
    {
        $strArr = null;
        for ($i = 0; $i < count($array) - 1; $i++) {
            yield implode((array)" ",shuffle(explode("//", $array[$i])));
        }

    }

    private function sortArraySecondElem($array)
    {
        for ($i = 0; $i < count($array) - 1; $i++) {

        }
    }

}