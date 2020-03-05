<?php
readfile('index.html');
if (!empty($_POST['code'])) {
    require "JsonChanceGenerator.php";
    $h = new JsonChanceGenerator($_POST['code']);
    $h->runJson();
}