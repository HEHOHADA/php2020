<?php
readfile('index.html');
require "generator.php";

$h = new generatorClass($_POST['code']);
$h->run();


