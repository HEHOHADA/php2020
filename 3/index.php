<?php
readfile('index.html');

if(!empty($_POST['code'])) {
    require "RandomSort.php";
    $h = new RandomSort($_POST['code']);
    $h->run();
}