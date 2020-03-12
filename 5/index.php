<?php
readfile('index.html');
if (isset($_POST['password'])) {
    require "Validation.php";
    $h = new Validation($_POST['password']);
    $h->validate();
}