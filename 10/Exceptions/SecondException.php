<?php

namespace Exceptions;

class SecondException extends FirstException
{
    public function __toString()
    {
        return "2";
    }
}