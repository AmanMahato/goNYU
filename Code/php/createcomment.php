<?php
session_start();
include_once 'queries.php';
$uname = key_exists('uname', $_SESSION) ? $_SESSION['uname'] : "";
$pin_id = key_exists('pin_id', $_POST) ? $_POST['pin_id'] : "";
$message = $_REQUEST["message"];
echo $message;
?>