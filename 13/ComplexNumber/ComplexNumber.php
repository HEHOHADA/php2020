<?php

namespace Complex;

use PHPUnit\Util\Exception;

class ComplexNumber
{
    public $real;
    public $unreal;


    public function __construct($a, $b)
    {
        $this->real = $a;
        $this->unreal = $b;
    }


    public function __toString()
    {
        $sing = $this->unreal > 0 ? "+" : "-";
        return $this->real . $sing . $this->unreal . 'i';
    }

    public function add(ComplexNumber $number)
    {
        return new ComplexNumber($this->real + $number->real, $this->unreal + $number->unreal);
    }


    public function sub(ComplexNumber $number)
    {
        return new ComplexNumber($this->real - $number->real, $this->unreal - $number->unreal);
    }

    public function multi(ComplexNumber $number)
    {
        return new ComplexNumber($this->real * $number->real - $this->unreal * $number->unreal,
            $this->unreal * $number->real + $this->real * $number->unreal);
    }

    public function div(ComplexNumber $number)
    {
        $divide = $number->real * $number->real + $number->unreal * $number->unreal;
        $complexNumber = new ComplexNumber($number->real, -$number->unreal);
        if ($divide === 0) {
           throw new \Exception("Cannot divide by zero", 100);
        }

        return new ComplexNumber(($this->multi($complexNumber))->real / $divide,
            ($this->multi($complexNumber))->unreal / $divide);

    }

    public function abs()
    {
        return sqrt($this->real * $this->real + $this->unreal * $this->unreal);
    }

}