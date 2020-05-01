<?php

namespace Exceptions;

use Exception;

class FirstException extends Exception
{
    public function __toString()
    {
       return "1";
    }
}