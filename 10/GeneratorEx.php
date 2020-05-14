<?php


class GeneratorEx
{
    private $_type = ["\Exceptions\FirstException", "\Exceptions\SecondException", "\Exceptions\ThirdException", "\Exceptions\FourthException", "\Exceptions\FifthException"];

    public function generate()
    {
        $case = rand(0, 4);
        $ex = $this->_type[$case];
        throw new $ex();
    }
}