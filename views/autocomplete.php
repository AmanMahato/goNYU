<?php
	require_once 'access.php';
	if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time()) {
		session_destroy();
		$_SESSION = array();
	}	

	if (key_exists('uname', $_SESSION) && (!isset($uname)|| $uname!=""))
	{
		$uname = $_SESSION['uname'];
	}

	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	
	mysql_connect("localhost", "root", "");
	mysql_select_db("dbproject");
	
	if($my_data[0]!="@")
		$sql="SELECT fname,lname,user_id FROM user WHERE user_id NOT IN (select friend_id from friends where user_ID like '".$uname."') AND user_id NOT IN (select user_id from friends where friend_id like '".$uname."') AND (fname like '%$my_data%' OR lname like '%$my_data%') AND user_id !='".$uname."'" ;
	
	else 
	{
		$my_data = substr($my_data,1);
		$sql="SELECT fname,lname,user_id FROM user WHERE user_id NOT IN (select friend_id from friends where user_ID like '".$uname."') AND user_id NOT IN (select user_id from friends where friend_id like '".$uname."') AND user_id like '%$my_data%' AND user_id !='".$uname."'";
	}
	
	$result = mysql_query($sql);
	// or die()
	/*$sql1="SELECT * FROM company_detail WHERE Com_Id = '$com_id'";
			$result = mysql_query($sql1);*/
	
	if($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$fname=$row['fname'];
			$lname=$row['lname'];
			$user_id=$row['user_id'];
			
			/*$sql="SELECT * FROM company_detail WHERE Com_Id = '$com_id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result)*/
			
			echo $fname." ".$lname." - \"@".$user_id."\"\n";
						
		}
	}
?>