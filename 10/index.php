<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
spl_autoload_register();

$exceptionGenerator = new GeneratorEx();

try {
    $exceptionGenerator->generate();
} catch (\Exceptions\FifthException $exception) {
    echo 'Exceptions 1 ';
} catch (\Exceptions\FourthException $exception) {
    echo 'Exceptions 2 ';
} catch (\Exceptions\ThirdException $exception) {
    echo 'Exceptions 3 ';
} catch (\Exceptions\SecondException $exception) {
    echo 'Exceptions 4 ';
} catch (\Exceptions\FirstException $exception) {
    echo 'Exceptions 5 ';
}