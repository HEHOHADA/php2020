<?php

$ini = parse_ini_file("index.ini", true);
if (isset($ini)) {
    if ($ini["second_rule"]["direction"] != "+" && $ini["second_rule"]["direction"] != "-") {
        $symbol = $ini["second_rule"]["direction"];
        echo "$symbol должен быть \"+\" или \"-\"";
        return;
    }
    if (strlen($ini["third_rule"]["delete"]) != 1) {
        $not_symbol = $ini["third_rule"]["delete"];
        echo "$not_symbol не является символом";
        return;
    }
    require "Recode.php";
    $h = new Recode($ini);
    $h->run();
}