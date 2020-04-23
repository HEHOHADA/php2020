<?php


class BrowserLogger extends Logger
{
    public function print($line, $format)
    {
        echo date($format) . $line."</br>";
    }
}