<?php
namespace Exceptions;

class FifthException extends FourthException
{
    public function __toString()
    {
        return "5";
    }
}