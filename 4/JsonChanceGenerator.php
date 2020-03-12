<?php


class JsonChanceGenerator
{
    private $text = null;
    private array $array = [];
    private int $sum = 0;
    private array $jsonResult = [];
    private array $resultGenerator = [];
    private array $someArr = [];
    private int $sumChance = 0;
    private int $sumChanceDivided = 0;

    public function __construct($text)
    {
        $this->text = $text;
        $this->array = explode(PHP_EOL, $text);
    }

    public function runJson()
    {
        for ($i = 0; $i < count($this->array); $i++) {
            $words = preg_split("/[\s,]+/", ($this->array[$i]));
            $weight = $words[count($words) - 1];
            if (!is_numeric($weight)) {
                return;
            }
            $this->sum += (int)$weight;
            unset($words[count($words) - 1]);
            $lineNumber = $i + 1;
            array_push($this->jsonResult, $this->toJson(implode(" ", $words), (int)$weight, "text", "weight"));
        }
        for ($i = 0; $i < count($this->jsonResult); $i++) {
            $this->jsonResult[$i]["probability"] = $this->jsonResult[$i]["weight"] / $this->sum;
        }

        echo json_encode($this->toJson($this->sum, $this->jsonResult, "sum", "data"), JSON_UNESCAPED_UNICODE) . "<br/>";
        $this->round_random($this->sum);
        $this->checkCorrect();

        echo json_encode($this->resultGenerator, JSON_UNESCAPED_UNICODE) . "<br/>";
    }

    private function toJson($words, $weight, $text1, $text2)
    {
        $json = [];
        $json[$text1] = $words;
        $json[$text2] = $weight;
        return $json;
    }

    private function round_random($numb)
    {
        $countOfSum = 0;
        while ($numb > 1) {
            $countOfSum++;
            $numb = $numb / 10;
        }

        $this->sumChance = pow(10, $countOfSum);
        $this->sumChanceDivided = $this->sumChance / $this->sum;

        for ($i = 0; $i < count($this->jsonResult); $i++) {
            if ($i == 0) {
                $this->someArr[$i] = $this->jsonResult[$i]["weight"] * $this->sumChanceDivided;
            } else
                $this->someArr[$i] = $this->jsonResult[$i]["weight"] * $this->sumChanceDivided + $this->someArr[$i - 1];

        }
    }


    private function generator()
    {
        $rnd = mt_rand(0, $this->sumChance);
        $index = 0;

        foreach ($this->someArr as $item => $value) {
            if ($value <= $rnd)
                $index++;
        }
        if($index>=count($this->someArr)){
            $index--;
        }

        return $this->jsonResult[$index]["text"];
    }

    private function checkCorrect()
    {
        $arrayOfChance = [];
        for ($i = 0; $i < 10000; $i++) {
            $json = $this->generator();
            $key = array_key_exists($json, $arrayOfChance);
            if (!$key) {
                $arrayOfChance[$json] = 0;
            }
            $arrayOfChance[$json]++;
        }
        foreach ($arrayOfChance as $value => $key) {
            $resultChance = $this->toJson($value, $key, "text", "count");
            $resultChance["calculated_probability"] = $key / 10000;
            array_push($this->resultGenerator, $resultChance);
        }
    }

}