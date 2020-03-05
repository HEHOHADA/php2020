<?php


class RandomSort
{
    private $code = null;
    private array $array = [];
    private array $resultWithoutSort = [];


    public function __construct($code)
    {
        $this->code = $code;
        $this->array = explode(PHP_EOL, $_POST['code']);
    }

    public function run()
    {
        $this->shuffleText($this->array);
        $this->sortArraySecondElem($this->resultWithoutSort);
    }

    private function shuffleText($array)
    {
        $strShuffleArr = null;
        $strArr = null;
        for ($i = 0; $i < count($array); $i++) {
            $strShuffleArr = preg_split("/[\s,]+/", ($array[$i]));
            $this->splitText($strShuffleArr);
            shuffle($strShuffleArr);
            $this->splitText($strShuffleArr);
        }
    }

    private function splitText($array)
    {
        $str = implode(" ", (array)$array);
        array_push($this->resultWithoutSort, $str);
    }




    private function sortArraySecondElem($array)
    {
        function cmp($a, $b)
        {
            if ($a[1] == $b[1]) {
                return 0;
            }
            return ($a[1] < $b[1]) ? -1 : 1;
        }

        uasort($array, 'cmp');
        for ($i = 0; $i < count($array); $i++) {
            echo "$array[$i] <br/>";
        }
    }

}