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

        $this->resultWithoutSort[$str] = $array[1];
    }


    private function sortArraySecondElem($array)
    {
        asort($array);
        $keys = array_keys($array);
           for ($i=0;$i<count($keys);$i++){
               echo "$keys[$i] <br/>";
           }
    }

}