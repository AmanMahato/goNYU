<?php
session_start();
$_SESSION = array();
header( 'Location: /goNYU/views/my_pins.php' ) ;
?>