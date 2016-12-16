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

//Checking the connection
/*//$sql = "SELECT * FROM user";
	$sql='SELECT F.friend_id, fname, lname FROM friends F join user U where U.user_id = F.friend_id and F.user_id = "SGOYAL"';
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result,MYSQLI_NUM))
//    echo $row1['user_id']. " ";
	$A = <<<A
<form action="/" id="cuser" >
<div class='show-pin'>
<img class="show-pin" src=$location alt="User Profile Picture">
</div>
	<table style="margin:auto;">
		<tr><td><label>User Name</label></td><td>$row[0]</td></tr>
		<tr><td><label>First Name</label></td><td>$row[2]</td></tr>
		<tr><td><label>Last Name</label></td><td>$row[3]</td></tr>
		<tr><td><label>Gender</label></td><td>$row[5]</td></tr>
		<tr><td><label>Email</label></td><td>$row[4]</td></tr>
		<tr><td><label>Language</label></td><td>$row[9]</td></tr>
		<tr><td><label>Country</label></td><td>$row[10]</td></tr>
	</table>
</form>
<br/>		
A;
	echo $A;*/

	return $con;
}

function dbClose($con) {
	mysqli_close($con); 
}

?>
