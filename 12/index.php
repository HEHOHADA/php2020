<?php
//$postdata = http_build_query(
//    array(
//        'code' => "lll"
//    )
//);
//$opts = array('http' =>
//    array(
//        'method' => 'POST',
//        'content' => $postdata
//    )
//);
//$context = stream_context_create($opts);
//
//$result = file_get_contents('http://localhost/2/index', false, $context);
//echo $result;
//die();
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://localhost/2/index.php");
//curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
//
////So that curl_exec returns the contents of the cURL; rather than echoing it
//curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//
////execute post
//$result = curl_exec($ch);
//echo $result;

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
//session_cache_limiter('private');
//$cache_limiter = session_cache_limiter();

session_cache_expire(30);
$cache_expire = session_cache_expire();
session_name("session");
session_start();
// Я очень много пытался отправить разные виды запросов не получилось
//также хотел сдедлать через еще один класс но слишком сложно было использовать ооп в этом задании

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../2/index.html");
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_SESSION["code"])) {
        if (isset($_POST["code"])) {
            $_SESSION["code"] = $_POST["code"];
            $postdata = http_build_query(
                array(
                    'code' => $_POST["code"]
                )
            );
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded",
                    'content' => $postdata
                )
            );
            $context = stream_context_create($opts);
//любой урл для второго зания
            $result = file_get_contents('http://127.0.0.1:2222', false, $context);
            echo $result;
            die();
        } else {
            echo 'error';
        }
    } else {
        if (isset($_POST["code"])) {
            if ($_SESSION["code"] === $_POST["code"]) {
                $postdata = http_build_query(
                    array(
                        'code' => $_POST["code"]
                    )
                );

                $opts = array('http' =>
                    array(
                        'method' => 'POST',
                        'header' => "Content-type: application/x-www-form-urlencoded",
                        'content' => $postdata
                    )
                );
                $context = stream_context_create($opts);

                $result = file_get_contents('http://127.0.0.1:2222', false, $context);
                echo $result;
                die();
            } else {
                echo "WRONG DATA";
            }
        }
    }
}


