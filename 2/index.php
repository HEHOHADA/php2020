<?php
readfile('index.html');
require "GeneratorCls.php";
if(isset($_POST['code'])) {
    $h = new GeneratorCls($_POST['code']);
    $h->run();
}


