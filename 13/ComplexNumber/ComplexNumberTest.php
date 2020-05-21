<?php


require_once 'ComplexNumber.php';

use Complex\ComplexNumber;

class ComplexNumberTest extends PHPUnit\Framework\TestCase
{

    private ComplexNumber $_firstComplexNumber;
    private ComplexNumber $_secondComplexNumber;


    public function beforeEach($first, $second, $third, $fourth)
    {

        $this->_firstComplexNumber = new ComplexNumber($first, $second);
        $this->_secondComplexNumber = new ComplexNumber($third, $fourth);
    }

    public function testAdd()
    {
        $this->beforeEach(1, 2, 3, 4);
        $result = $this->_firstComplexNumber->add($this->_secondComplexNumber);
        $this->assertEquals(1 + 3, $result->real);
        $this->assertEquals(2 + 4, $result->unreal);
    }

    public function testNegativeAdd()
    {
        $this->beforeEach(-1, -2, -3, -4);
        $result = $this->_firstComplexNumber->add($this->_secondComplexNumber);
        $this->assertEquals((-1) + (-3), $result->real);
        $this->assertEquals((-2) + (-4), $result->unreal);
    }

    public function testFractionalAdd()
    {
        $this->beforeEach(-1 / 2, -2 / 3, -3 / 4, -4 / 5);
        $result = $this->_firstComplexNumber->add($this->_secondComplexNumber);
        $this->assertEquals((-1 / 2) + (-3 / 4), $result->real);
        $this->assertEquals((-2 / 3) + (-4 / 5), $result->unreal);
    }

    public function testSub()
    {
        $this->beforeEach(1, 2, 3, 4);
        $result = $this->_firstComplexNumber->sub($this->_secondComplexNumber);
        $this->assertEquals(1 - 3, $result->real);
        $this->assertEquals(2 - 4, $result->unreal);
    }

    public function testFractionalSub()
    {
        $this->beforeEach(-1 / 2, -2 / 3, -3 / 4, -4 / 5);
        $result = $this->_firstComplexNumber->sub($this->_secondComplexNumber);
        $this->assertEquals((-1 / 2) - (-3 / 4), $result->real);
        $this->assertEquals((-2 / 3) - (-4 / 5), $result->unreal);
    }

    public function testNegativeSub()
    {
        $this->beforeEach(-1, -2, -3, -4);
        $result = $this->_firstComplexNumber->sub($this->_secondComplexNumber);
        $this->assertEquals((-1) - (-3), $result->real);
        $this->assertEquals((-2) - (-4), $result->unreal);
    }

    public function testMulti()
    {
        $this->beforeEach(1, 2, 3, 4);
        $result = $this->_firstComplexNumber->multi($this->_secondComplexNumber);
        $this->assertEquals(1 * 3 - 2 * 4, $result->real);
        $this->assertEquals(1 * 4 + 3 * 2, $result->unreal);
    }

    public function testFractionalMulti()
    {
        $this->beforeEach(-1 / 2, -2 / 3, -3 / 4, -4 / 5);
        $result = $this->_firstComplexNumber->multi($this->_secondComplexNumber);
        $this->assertEquals((-0.5) * (-0.75) - (-2 / 3) * (-4 / 5), $result->real);
        $this->assertEquals((-0.5) * (-4 / 5) + (-0.75) * (-2 / 3), $result->unreal);
    }

    public function testNegativeMulti()
    {
        $this->beforeEach(-1, -2, -3, -4);
        $result = $this->_firstComplexNumber->multi($this->_secondComplexNumber);
        $this->assertEquals(1 * 3 - 2 * 4, $result->real);
        $this->assertEquals(1 * 4 + 3 * 2, $result->unreal);
    }

    public function testDiv()
    {
        $this->beforeEach(-2, 1, 1, -1);
        $result = $this->_firstComplexNumber->div($this->_secondComplexNumber);
        $this->assertEquals((-3 / 2), $result->real);
        $this->assertEquals((-1 / 2), $result->unreal);
    }

    public function testAbs()
    {
        $this->beforeEach(1, 2, 3, 4);
        $this->_firstComplexNumber = new ComplexNumber(13, 0);
        $result1 = $this->_firstComplexNumber->abs();
        $result2 = $this->_secondComplexNumber->abs();
        $this->assertEquals(13, $result1);
        $this->assertEquals(sqrt(3 * 3 + 4 * 4), $result2);
    }

    public function testDivNull()
    {
        $this->expectException("Exception");
        $this->beforeEach(1, 2, 3, 4);
        $this->_secondComplexNumber = new ComplexNumber(0, 0);
        $this->_firstComplexNumber->div($this->_secondComplexNumber);
    }

    public function testDivNegativeNull()
    {
        $this->expectException("Exception");
        $this->beforeEach(-1, -2, -3, -4);
        $this->_secondComplexNumber = new ComplexNumber(0, 0);
        $this->_firstComplexNumber->div($this->_secondComplexNumber);
    }

    public function testString()
    {
        $this->beforeEach(1, 2, 3, 4);
        $result = strval($this->_firstComplexNumber);
        $sign = 2 > 0 ? "+" : "-";
        $this->assertEquals(1 . $sign . 2 . "i", $result);
    }

    public function testWithNegativeSecondString()
    {
        $this->beforeEach(1, -2, 3, 4);
        $result = strval($this->_firstComplexNumber);
        $sign = -2 > 0 ? "+" : "";
        $this->assertEquals(1 . $sign . -2 . "i", $result);
    }

}