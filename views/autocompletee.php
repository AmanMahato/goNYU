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
	
	$db_conn=new mysqli("localhost", "root", "root", "dbproject");
	
	if($my_data[0]=="#")
	{
		$my_data = substr($my_data,1);
		$sql="SELECT * FROM pinboards WHERE board_name like '%$my_data%'" ;
	
		$result = mysql_query($sql);

		if($result)
		{
			while($row = mysql_fetch_array($result))
			{
				$rowid=$row['row_id'];
				$brdname=$row['board_name'];
				$desc=$row['description'];
		
				echo "Board No. ".$rowid.", ".$desc." - \"#".$brdname."\" -> Boards\n";
						
			}
		}
	}
	
	else if($my_data[0]=="@")
	{
		$my_data = substr($my_data,1);
		$sql1="SELECT fname,lname,user_id FROM user WHERE user_id NOT IN (select friend_id from friends where user_ID like '".$uname."') AND user_id NOT IN (select user_id from friends where friend_id like '".$uname."') AND user_id like '%$my_data%' AND user_id !='".$uname."'";
	
		$result1 = mysql_query($sql1);

		if($result1)
		{
			while($row1 = mysql_fetch_array($result1))
			{
				$fname=$row1['fname'];
				$lname=$row1['lname'];
				$user_id=$row1['user_id'];
			
				echo $fname." ".$lname." - \"@".$user_id."\" -> Friends\n";		
			}
		}
	}
	
	else
	{
		$sql1="SELECT fname,lname,user_id FROM user WHERE user_id NOT IN (select friend_id from friends where user_ID like '".$uname."') AND user_id NOT IN (select user_id from friends where friend_id like '".$uname."') AND (fname like '%$my_data%' OR lname like '%$my_data%') AND user_id !='".$uname."'" ;
		$result1 = mysql_query($sql1);

		if($result1)
		{
			while($row1 = mysql_fetch_array($result1))
			{
				$fname=$row1['fname'];
				$lname=$row1['lname'];
				$user_id=$row1['user_id'];
			
				echo $fname." ".$lname." - \"@".$user_id."\" -> Friends\n";		
			}
		}
		
		
		$sql="SELECT * FROM pinboards WHERE description like '%$my_data%'" ;
	
		$result = mysql_query($sql);

		if($result)
		{
			while($row = mysql_fetch_array($result))
			{
				$rowid=$row['row_id'];
				$brdname=$row['board_name'];
				$desc=$row['description'];
		
				echo "Board No. ".$rowid.", ".$desc." - \"#".$brdname."\" -> Boards\n";
						
			}
		}
		
		/////
		$sql2="SELECT * FROM pins WHERE tags like '%$my_data%'" ;
	
		$result2 = mysql_query($sql2);

		if($result2)
		{
			while($row2 = mysql_fetch_array($result2))
			{
				$rowid=$row2['row_id'];
				$tags=$row2['tags'];
		
				echo "Pin No. ".$rowid.", tagged as ".$tags." -> Pins\n";
						
			}
		}
	}
?>