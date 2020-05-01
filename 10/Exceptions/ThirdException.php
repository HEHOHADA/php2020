<?php
namespace Exceptions;

class ThirdException extends SecondException
{
    public function __toString()
    {
        return "3";
    }
}