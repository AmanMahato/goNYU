<?php
session_start();
$_SESSION = array();
header( 'Location: /impressions/views/my_pins.php' ) ;
?>