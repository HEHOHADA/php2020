<?php
namespace Exceptions;

class FourthException extends ThirdException
{
    public function __toString()
    {
        return "4";
    }
}