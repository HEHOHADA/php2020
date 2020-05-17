<?php


require_once 'ComplexNumber.php';

use Complex\ComplexNumber;

class ComplexNumberTest extends PHPUnit\Framework\TestCase
{

    private ComplexNumber $_firstComplexNumber;
    private ComplexNumber $_secondComplexNumber;
    private int $_rnd;
    private int $_rnd1;
    private int $_rnd2;
    private int $_rnd3;

    public function beforeEach()
    {
        $this->_rnd = rand(1, 20);
        $this->_rnd1 = rand(2, 30);
        $this->_rnd2 = rand(3, 40);
        $this->_rnd3 = rand(4, 50);
        $this->_firstComplexNumber = new ComplexNumber($this->_rnd, $this->_rnd1);
        $this->_secondComplexNumber = new ComplexNumber($this->_rnd2, $this->_rnd3);
    }

    public function testAdd()
    {
        $this->beforeEach();
        $result = $this->_firstComplexNumber->add($this->_secondComplexNumber);
        $this->assertEquals($this->_rnd + $this->_rnd2, $result->real);
        $this->assertEquals($this->_rnd1 + $this->_rnd3, $result->unreal);
    }

    public function testSub()
    {
        $this->beforeEach();
        $result = $this->_firstComplexNumber->sub($this->_secondComplexNumber);
        $this->assertEquals($this->_rnd - $this->_rnd2, $result->real);
        $this->assertEquals($this->_rnd1 - $this->_rnd3, $result->unreal);
    }

    public function testMulti()
    {
        $this->beforeEach();
        $result = $this->_firstComplexNumber->multi($this->_secondComplexNumber);
        $this->assertEquals($this->_rnd * $this->_rnd2 - $this->_rnd1 * $this->_rnd3, $result->real);
        $this->assertEquals($this->_rnd * $this->_rnd3 + $this->_rnd2 * $this->_rnd1, $result->unreal);
    }

    public function testDiv()
    {
        $this->_firstComplexNumber = new ComplexNumber(-2, 1);
        $this->_secondComplexNumber = new ComplexNumber(1, -1);
        $result = $this->_firstComplexNumber->div($this->_secondComplexNumber);
        $this->assertEquals((-3 / 2), $result->real);
        $this->assertEquals((-1 / 2), $result->unreal);
    }

    public function testAbs()
    {
        $this->beforeEach();
        $this->_firstComplexNumber = new ComplexNumber(13, 0);
        $result1 = $this->_firstComplexNumber->abs();
        $result2 = $this->_secondComplexNumber->abs();
        $this->assertEquals(13, $result1);
        $this->assertEquals(sqrt($this->_rnd2 * $this->_rnd2 + $this->_rnd3 * $this->_rnd3), $result2);
    }

    public function testDivNull()
    {
        $this->expectException("Exception");
        $this->beforeEach();
        $this->_secondComplexNumber = new ComplexNumber(0, 0);
        $this->_secondComplexNumber->div($this->_firstComplexNumber);
        $this->expectExceptionCode(100);
        $this->expectExceptionMessage("Cannot divide by zero");
    }

    public function testString()
    {
        $this->beforeEach();
        $result = strval($this->_firstComplexNumber);
        $sign = $this->_rnd1 > 0 ? "+" : "-";
        $this->assertEquals($this->_rnd . $sign . $this->_rnd1 . "i", $result);
    }

}