<?php
spl_autoload_register(function ($className) {
    include "\Exceptions\\" . $className . ".php";
});

class GeneratorEx
{
    public function generate()
    {
        $case = rand(1, 5);
        switch ($case) {
            case 1:
                throw new \Exceptions\FirstException();
                break;
            case 2:
                throw new \Exceptions\SecondException();
                break;
            case 3:
                throw new \Exceptions\ThirdException();
                break;
            case 4:
                throw new \Exceptions\FourthException();
                break;
            case 5:
                throw new \Exceptions\FifthException();
                break;
            default:
                throw new Exception("something went wrong");
        }
    }
}