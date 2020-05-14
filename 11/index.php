<?php


require "vendor/autoload.php";
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
spl_autoload_register(function ($className) {
    include $className . ".php";
});

$logger = new Controller\Logger("result.json");

$logger->run();

$logger->writeResult();