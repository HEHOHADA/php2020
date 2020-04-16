<?php
readfile('index.html');

if(isset($_POST['month'])){
    require "Calendar.php";
    date_default_timezone_set("Europe/Moscow");
    $h = new Calendar($_POST['month']);
    $h->run();
}
