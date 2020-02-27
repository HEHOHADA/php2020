<?php
readfile('index.html');
require "RandomSort.php";

$h = new RandomSort($_POST['code']);
$h->run();