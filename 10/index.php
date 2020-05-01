<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
spl_autoload_register(function ($className) {
    include $className . ".php";
});

$exceptionGenerator = new GeneratorEx();

try {
    $exceptionGenerator->generate();
} catch (\Exceptions\FifthException $exception) {
    echo $exception->__toString();
} catch (\Exceptions\FourthException $exception) {
    echo $exception->__toString();
} catch (\Exceptions\ThirdException $exception) {
    echo $exception->__toString();
} catch (\Exceptions\SecondException $exception) {
    echo $exception->__toString();
} catch (\Exceptions\FirstException $exception) {
    echo $exception->__toString();
} catch (Exception $e) {
    echo 'Something went wrong';
}