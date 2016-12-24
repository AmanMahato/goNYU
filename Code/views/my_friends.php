<?php
require_once 'access.php';
include_once '../php/queries.php';
?>
<html>
<head>
  <link href="../css/default.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
		<script type="text/javascript" src="jqueryy.js"></script>
		<script type="text/javascript" src="jquery.autocomplete.js"></script>
		<script>
		$(document).ready(function(){
		 $(".tag").autocomplete("autocomplete.php", {
				select : function(event,ui){
					alert(ui);
				}
			});
		});
		</script>  
 		<script>
			$(document).ready(function(){
				$("#invited_message").hide();
				$("#invited_message").submit(function(event){
					event.preventDefault();
					$.post('../php/create_invitation.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html("<p class='ui-error'>" + data.errormsg + "</p>").show().fadeOut(7000);
						} else if (data.errorcode == 2) {
							$("#errmsg").html("<p class='ui-info'>" + data.errormsg + "</p>").show().fadeOut(7000);

						} else
							$("#invited_message").html("<p class='ui-success'>" + $("#invited_message").find("[name=invited_user]").val() + " has been invited!!</p>").show().fadeOut(3000);
					}, 'json');
				});
 				$("#flip").click(function(){
    				$("#invited_message").slideToggle("slow");
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
			});
		</script> 
</head>
<title>goNYU</title>
<body>

<header id="header">
	<h1>
		<a>
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
	<a href="/goNYU/views/my_pins.php" class="addbutton menu_button" id="menu_my_pins">Photos</a>
	<a href="/goNYU/views/all_pins.php" class="addbutton menu_button" id="menu_search_pins">Search Photos</a>
</form>
<form class="toggle_menu" id="toggle_boards">
	<a href="/goNYU/views/my_boards.php" class="addbutton menu_button" id="menu_my_boards">My Diary</a>
	<a href="/goNYU/views/all_boards.php" class="addbutton menu_button" id="menu_search_boards">Search Diary</a>
</form>
<h3 class='toggle_add addbutton' id="flip">Click to add new friends!!</h3>
<?php   
if(isset($_POST['invited_user']))
{
	echo $_POST["invited_user"]." has been invited!!";
}
?>
<form action="/" method="post" id="invited_message" style="margin:auto;">
Enter user name:
<input name="invited_user" type="text" class="tag">
Enter invite message:
<input name="messageee" type="text" />
<input value="Invite" type="submit">
</form>
<div hidden id="errmsg"></div>
<br/><br/>
<h2>Here are all your friends!!</h2>
<?php
	$result1 = get_friends_list();
	while($row1 = mysqli_fetch_array($result1,MYSQLI_NUM))
	{
		echo "<a href = 'http://localhost:8888/goNYU/views/user_profile.php?username=$row1[0]'> $row1[1] $row1[2] </a>";
	$result2 = get_user_details($row1[0]);
	$row = mysqli_fetch_array($result2,MYSQLI_NUM);
	$location = "../users/".$row[0]."/userprofilepic.jpg";
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
	echo $A;
}

?>
</body>
</html>