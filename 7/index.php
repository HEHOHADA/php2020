<?php
readfile('index.html');

if (isset($_POST['address']) && (isset($_POST['ping']) || isset($_POST['trace']))) {

    $address = $_POST['address'];
    if (!preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $address)) {
        echo "WRONG ADDRESS";
        return;
    }

    require "Network.php";
    if ((isset($_POST['ping']) && isset($_POST['trace']))) {
        $h = new Network($address, $_POST['ping'], $_POST['trace']);
    } else {
        $format = isset($_POST['ping']) ? "ping" : "trace";
        $h = new Network($address, $format);
    }
    $h->run();
}