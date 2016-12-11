<?php
session_start();
include_once 'db.php';

$uname = "prasad";
$pin_id = 9;
$message = "Test Message";


$data = array('errorcode' => 0);
$data['errormsg'] = "";

if ($uname == "") {
	$data['errorcode'] = 1;
	$data['errormsg'] .= "<p class='ui-error'>User account is logged out</p>";
}
if (strlen($message) > 1000) {
	$data['errorcode'] = 1;
	$data['errormsg'] .= "<p class='ui-error'>Message must be less than 1000 Characters</p>";
}
if ($message == "") {
	$data['errorcode'] = 1;
	$data['errormsg'] .= "<p class='ui-error'>Message is empty</p>";
}

if ($data['errorcode'] == 0) {
	$errmsg = "";
	$con = dbConnect();

	$err_msg = "";
	$sql_create_comment = mysqli_prepare ($con,
		"INSERT INTO comments(`user_id`,`message`,`pin_id`) VALUES (?,?,?)");

	if(!$sql_create_comment){
		echo ("Cannot prepare statement to create Comment".mysqli_stmt_error($sql_create_comment));
		exit();
		// dbClose($con);
		// return FALSE;
	}

	if(!mysqli_stmt_bind_param($sql_create_comment,'ssi',$uname,$message,$pin_id)){
		$err_msg .= "Cannot bind statement to create Pic".mysqli_stmt_error($sql_create_comment);
		// dbClose($con);
		// return FALSE;
	}

	if(!mysqli_stmt_execute($sql_create_comment)){
		$err_msg .= "Cannot execute statement to create Pic".mysqli_stmt_error($sql_create_comment);
		// dbClose($con);
		// return FALSE;
	}
	echo $err_msg;
	
	$comment_id = mysqli_insert_id($con);
	dbClose($con);
	// return TRUE;

	echo $err_msg;
}


echo json_encode($data);
?>