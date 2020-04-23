<?php
readfile('index.html');
include("Logger.php");
include("FileLogger.php");
include("BrowserLogger.php");


if (isset($_POST['text']) && isset($_POST['log']) && isset($_POST['format'])) {
    if (!isset($_POST["file"]) && $_POST["log"] === "file") {
        return;
    }

    require "Execution.php";
    $h = new Execution($_POST["log"], $_POST["format"], $_POST["text"], $_POST["file"]);
    $h->run();
}
