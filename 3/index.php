<?php
readfile('index.html');

if ($_POST['code']!=null) {
    require "RandomSort.php";
    $h = new RandomSort($_POST['code']);
    $h->run();
}