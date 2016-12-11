<?php 
dbConnect(); 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$db = "dbproject";

function dbConnect() {
	global $dbhost, $dbuser, $dbpass, $db;

	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	return $con;
}

function dbClose($con) {
	mysqli_close($con);
}
?>
