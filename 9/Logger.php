<?php


abstract class Logger
{
    public $time = "H:i";
    public $time_year = "Y-m-d H:i";
    public $without = "";

    abstract public function print($line, $format);
}