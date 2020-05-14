<?php

namespace Controller;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    private $_path;
    private $_result = [];
    private $_descriptor;
    private $_type = ["emergency", "alert", "critical", "alert", "info", "error", "warning", "notice"];
    private $_random;

    function __construct($path)
    {
        $this->_random = rand(10, 50);
        $this->_path = $path;
        $this->_descriptor = fopen($path, "w");
    }

    function __destruct()
    {
        fclose($this->_descriptor);
    }

    public function writeResult()
    {
        fwrite($this->_descriptor, json_encode($this->_result));
    }

    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message);
    }

    public function alert($message, array $context = array())
    {

        $this->log(LogLevel::ALERT, $message);
    }

    public function critical($message, array $context = array())
    {

        $this->log(LogLevel::CRITICAL, $message);
    }


    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message);
    }


    public function warning($message, array $context = array())
    {

        $this->log(LogLevel::WARNING, $message);
    }


    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message);
    }

    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message);
    }


    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message);
    }

    public function log($level, $message, array $context = array())
    {
        $log = [];
        $log["type"] = $level;
        $log["time"] = date("H:i:s");
        $log["content"] = $message;
        array_push($this->_result, $log);
    }

    private function runFunction($name, $message)
    {
        $this->$name($message);
    }

    public function run()
    {
        for ($i = 0; $i < $this->_random; $i++) {
            $rand = rand(0, 7);

            $this->runFunction($this->_type[$rand], $this->_type[$rand]);
        }
    }
}