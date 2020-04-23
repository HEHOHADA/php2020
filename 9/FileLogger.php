<?php


class FileLogger extends Logger
{
    private $path;
    private $descriptor;

    function __construct($path)
    {
        $this->path = $path;
        $this->descriptor = fopen($path, "w");
    }

    function __destruct()
    {
        fclose($this->descriptor);
    }

    public function print($line, $format)
    {
        fwrite($this->descriptor, date($format) . $line . "\n");
    }
}