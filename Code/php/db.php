<?php 
dbConnect(); 

function dbConnect() {

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$db = 'dbproject';
	$con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
	if ($con->connect_error) {  
		die("Connection failed: " . $con->connect_error);
	}

	return $con;
}

function dbClose($con) {
	mysqli_close($con); 
}

?>
