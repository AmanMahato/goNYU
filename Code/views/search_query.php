<?php
require_once 'access.php';
include_once '../php/queries.php';
$connection=mysqli_connect("localhost", "root", "root","dbproject");
$searchterm = $_REQUEST['search_term'];
echo $searchterm;
if (strpos($searchterm, '@') !== FALSE)
{
	$searchterm = substr($searchterm,strpos($searchterm,'@')+1);
	$searchterm = substr($searchterm,0,strlen($searchterm)-12);
	header("location:user_profile.php?username=".$searchterm);
}

else if (strpos($searchterm, '#') !== FALSE || strpos($searchterm, 'hashh') !== FALSE)
{
	$searchterm = substr($searchterm,10);
	$searchterm = substr($searchterm,0,strpos($searchterm,','));
	header("location:board_pins.php?board_id=".$searchterm);
}

else if (strpos($searchterm, '-') !== FALSE && strpos($searchterm, '>') !== FALSE)
{
	$category = substr($searchterm,strpos($searchterm,'>')+2);
	if($category=="Pins")
	{
		$searchterm = substr($searchterm,8);
		$searchterm = substr($searchterm,0,strpos($searchterm,','));
		header("location:view_pin.php?pin_id=".$searchterm);
	}
}

else header("location:search.php?errno=100&data=".$searchterm);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>goNYU</title>
</head>
<body>
</body>
</html>