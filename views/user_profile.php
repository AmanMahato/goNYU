<?php
require_once 'access.php';
include_once '../php/queries.php';
$uname = isset($_GET['username'])?$_GET['username']:"";
?>

<!DOCTYPE html>
<html>
<head>
  <link href="../css/default.css" rel="stylesheet">
  <script src="../js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				$("#Send_invite").submit(function(event){
					event.preventDefault();
					$.post('../php/create_invitation.php',$(this).serialize(), function(data){
						if (data.errorcode == 1) {
							$("#errmsg2").html("<p class='ui-error'>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 2) {
							$("#errmsg2").html("<p class='ui-info'>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 3) {
							$("#errmsg2").html("<p class='ui-info'>" + data.errormsg + "</p>").show();
						} else {
							alert("Invite Sent");
							document.location = "/goNYU/views/user_profile.php?username=<?php echo $uname; ?>";
						}
					} ,'json');
				});

				$("#remove_friend").click(function(){
					$.post('../php/remove_friend.php',{
						user_id: "<?php echo $uname; ?>"
					},function(data){
						if (data.errorcode == 1) {
							$("#errmsg3").html("<p class='ui-error'>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 2) {
							$("#errmsg3").html("<p class='ui-info'>" + data.errormsg + "</p>").show();

						} else {
							alert("Friend Removed");
							document.location = "/goNYU/views/user_profile.php?username=<?php echo $uname; ?>";
						}
					} ,'json');
				});

				$("#accept").click(function(){
					$.post('../php/accept_request.php',{
						invited_user: "<?php echo $uname; ?>"
					},function(data){
						if (data.errorcode == 1) {
							$("#errmsg1").html("<p class='ui-error'>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 2) {
							$("#errmsg1").html("<p class='ui-info'>" + data.errormsg + "</p>").show();

						} else {
							alert("Friend Added");
							document.location = "/goNYU/views/user_profile.php?username=<?php echo $uname; ?>";
						}
					} ,'json');
				});

				$("#reject").click(function(){
					$.post('../php/reject_request.php',{
						invited_user: "<?php echo $uname; ?>"
					},function(data){
						if (data.errorcode == 1) {
							$("#errmsg4").html("<p class='ui-error'>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 2) {
							$("#errmsg4").html("<p class='ui-info'>" + data.errormsg + "</p>").show();

						} else {
							alert("Invite Rejected");
							document.location = "/goNYU/views/user_profile.php?username=<?php echo $uname; ?>";
						}
					} ,'json');
				});



				$("#user_pins_button").click(function(){
					$("#user_pins").submit();
				});

				$("#user_boards_button").click(function(){
					$("#user_boards").submit();
				});

					$("#menu_pins").click(function(){
        				$(".toggle_menu").not("#toggle_pins").slideUp(500,function(){
        					$("#toggle_pins").slideToggle();
        				});
        			});

        			$("#menu_boards").click(function(){
        				$(".toggle_menu").not("#toggle_boards").slideUp(500,function(){
        					$("#toggle_boards").slideToggle();
        				});
        			});
        			$(".toggle_menu").hide();
        			$("#user_pins").hide();
        			$("#user_boards").hide();
			});
		</script>
</head>
<title>goNYU<?php if($_GET) echo $_GET['username']; else echo "My"?> Profile</title>
<body>

<header id="header">
	<h1>
		<a href="my_pins.php">
			<table>
				<td><a class="addbutton menu_button" id="menu_pins">Photos</a>
				<a class="addbutton menu_button" id="menu_boards">Diary</a>
				<a href="/goNYU/views/my_streams.php"class="addbutton menu_button" id="menu_streams">Interest</a>
				<a href="/goNYU/views/user_profile.php" class="addbutton menu_button" id="menu_user">Profile</a>
				<a href="/goNYU/views/my_friends.php" class="addbutton menu_button" id="menu_user">Friends</a>
				<a href="/goNYU/views/search.php" class="addbutton menu_button" id="menu_user">Search</a>
<a href="/goNYU/php/logout.php" class="addbutton menu_button" id="menu_user">Logout</a></td>
			</table>
		</a>
	</h1>
</header>
<form class="toggle_menu" id="toggle_pins">
	<a href="/goNYU/views/my_pins.php" class="addbutton menu_button" id="menu_my_pins">My Photos</a>
	<a href="/goNYU/views/all_pins.php" class="addbutton menu_button" id="menu_search_pins">Search Photos</a>
</form>
<form class="toggle_menu" id="toggle_boards">
	<a href="/goNYU/views/my_boards.php" class="addbutton menu_button" id="menu_my_boards">My Diary</a>
	<a href="/goNYU/views/all_boards.php" class="addbutton menu_button" id="menu_search_boards">Search Diary</a>
</form>


<?php
if($_GET)
{
	$result = get_user_details("{$_GET['username']}");
	$row = mysql_fetch_array($result);
	$location = "../users/".$row[0]."/userprofilepic.jpg";
$A = <<<A
		<form action="/" id="center1" style="margin:auto;">
		<div class='show-pin'>
		<img class="show-pin" src=$location alt="User Profile Picture">
		</div>
			<table id="center1">
				<tr><td><label>User Name</label></td><td>$row[0]</td></tr>
				<tr><td><label>First Name</label></td><td>$row[1]</td></tr>
				<tr><td><label>Last Name</label></td><td>$row[2]</td></tr>
				<tr><td><label>Gender</label></td><td>$row[4]</td></tr>
				<tr><td><label>Email</label></td><td>$row[3]</td></tr>
				<tr><td><label>Language</label></td><td>$row[5]</td></tr>
				<tr><td><label>Country</label></td><td>$row[6]</td></tr>
			</table>
		</form>
A;
	echo $A;
$B = <<<B
<br/>
<form method="post" hidden action="user_pins.php" id="user_pins">
<input type="text" name="uname" value="$uname" hidden/>
</form>
<input value="Show Pins" type="button" id="user_pins_button" class="menubutton"/>



<form method="post" hidden action="user_boards.php" id="user_boards">
<input type="text" name="uname" value="$uname" hidden/>
</form>
<input value="Show Boards" type="button" id="user_boards_button" class="menubutton">
<br/><br/><br/>
B;
	echo $B;


	$errmsg = NULL;
	check_friendship($_SESSION['uname'], $_GET['username'], $errmsg);
	if($errmsg == 0)
	{
		echo "Unable to connect to Database";
	}
	if($errmsg == 1)
	{
		echo '<input value="Remove friend" type="button" id="remove_friend" class="menubutton">';
		echo '<div id=errmsg3 />';
	}
	if($errmsg == 2)
	{
		echo 'Invite has already been sent, waiting for confirmation.';
	}
	if($errmsg == 3)
	{
		echo $_GET['username'].' has sent you a friend request. What do you want to do?';
		echo '<input value="Accept" type="button" id="accept" class="menubutton">';
		echo '<input value="Reject" type="button" id="reject" class="menubutton">';
		echo '<div id=errmsg1 />';
		echo '<div id=errmsg4 />';
	}
	if($errmsg == 4)
	{
		echo "You have rejected this person's invite. Do you want to accept?";
		echo '<input value="Yes" type="button" id="accept" class="menubutton">';
	}
	if($errmsg == 5)
	{
		echo '<form action="../php/create_invitation.php" method="post" id="Send_invite" style="margin: auto">';
		echo 'User';
		echo '<input Name="invited_user" type="Text" value='.$_GET["username"].' readonly>';
		echo 'Message';
		echo '<input Name="Message" type="Text">';
		echo '<input value="Invite" type="submit">';
		echo '</form>';
		echo "<div id='errmsg2' />";
	}

}
else
{

$B = <<<B
<br/>
<form action="../php/edit_profile.php" method="post" style="margin:auto;">
<input value="Edit Profile" type="submit" class="menubutton">
</form>
B;

$result = get_user_details("{$_SESSION['uname']}");
$row = mysql_fetch_array($result);
$location = "../users/".$_SESSION['uname']."/userprofilepic.jpg";
$C = <<<C
		<form action="/" style="margin:auto;">
		<div class='show-pin2'>
		<img class="show-pin2" src=$location alt="User Profile Picture">
		</div>
			<table style="margin:auto;">
				<tr><td><label>User Name</label></td><td>$row[0]</td></tr>
				<tr><td><label>First Name</label></td><td>$row[1]</td></tr>
				<tr><td><label>Last Name</label></td><td>$row[2]</td></tr>
				<tr><td><label>Gender</label></td><td>$row[4]</td></tr>
				<tr><td><label>Email</label></td><td>$row[3]</td></tr>
				<tr><td><label>Language</label></td><td>$row[5]</td></tr>
				<tr><td><label>Country</label></td><td>$row[6]</td></tr>
			</table>
		</form>
C;
echo $C;
echo $B;

	{

	echo '<br/><h2>Here are your notifications:</h2>';
	echo '<hr>';
	
	$result = friend_requests($_SESSION['uname'], $errmsg);
	if($result == FALSE)
		echo $errmsg;
	else
	{
		echo "<h4>These people have sent you friend requests:</h4>";
		while($row1 = mysql_fetch_array($result))
		{
			if($row1[1]=="Pending")
			{
				//echo "$row1[0]-----$row1[1]------$row1[2]!!!!";
				echo "<a href = 'http://localhost/goNYU/views/user_profile.php?username=$row1[0]'>$row1[0]</a> - \"$row1[2]\"<br/>";
			}
		}
		echo '<div id="errmsg1" />';
		$result = friend_requests($_SESSION['uname'], $errmsg);
		echo "<br/>";
		echo "<h4>You have rejected these people's friend requests:</h4>";
		while($row2 = mysql_fetch_array($result))
		{
			if($row2[1]=="Rejected")
			{
				echo "<a href = 'http://localhost/goNYU/views/user_profile.php?username=$row2[0]'> $row2[0] </a> - \"$row2[2]\"<br/>";
			}
		}
	}
		echo '<div id="errmsg" />';
	}
}
?>
</body>
</html>