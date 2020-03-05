<?php


class JsonChanceGenerator
{
    private $text = null;
    private array $array = [];
    private int $sum = 0;
    private array $jsonResult = [];
    private array $resultGenerator = [];

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
            array_push($this->jsonResult, $this->toJson(implode(" ", $words), (int)$weight, "text $lineNumber", "weight"));
        }
        for ($i = 0; $i < count($this->jsonResult); $i++) {
            $this->jsonResult[$i]["probability"] = $this->jsonResult[$i]["weight"] / $this->sum;
        }

        echo json_encode($this->toJson($this->sum, $this->jsonResult, "sum", "data"), JSON_UNESCAPED_UNICODE) . "<br/>";
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

    private function generator()
    {
        $rnd = mt_rand(1, count($this->jsonResult));
        return $this->jsonResult[$rnd - 1]["text $rnd"];
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