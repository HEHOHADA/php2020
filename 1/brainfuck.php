<?php
require "brainFUCKClass.php";

$h = new brainFUCK($_POST['code'], $_POST['text']);
$result = $h->start();
echo ''. json_encode( $result ) .')';
echo $result;
?>