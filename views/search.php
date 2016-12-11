<?php
require_once 'access.php';
include_once '../php/queries.php';

if(isset($_REQUEST["errno"]))
	$error=$_REQUEST["errno"];
else $error=0;

if(isset($_REQUEST["data"]))
	$searchdata=$_REQUEST["data"];
else $searchdata="";

mysql_connect("localhost", "root", "");
mysql_select_db("dbproject");
?>


<html>
<head>
  <link href="../css/default.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
		<script type="text/javascript" src="jqueryy.js"></script>
		<script type="text/javascript" src="jquery.autocomplete.js"></script>
		<script>
		$(document).ready(function(){
		 $(".tag").autocomplete("autocompletee.php", {
		
				select : function(event,ui){
					alert(ui);
				}
			});

		});

		</script>  

 <?php /*		<script src="../js/jquery.js"></script> */?>
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
//---------------------------------------------------------------------------------------------------------------
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
<title>impressions - Search</title>
<body>

<header id="header">
	<h1>
		<a>
			<table>
				<td><a class="addbutton menu_button" id="menu_pins">Pins</a>
				<a class="addbutton menu_button" id="menu_boards">Boards</a>
				<a href="/impressions/views/my_streams.php"class="addbutton menu_button" id="menu_streams">Streams</a>
				<a href="/impressions/views/user_profile.php" class="addbutton menu_button" id="menu_user">User Accounts</a>
				<a href="/impressions/views/my_friends.php" class="addbutton menu_button" id="menu_user">My Friends</a>
				<a href="/impressions/views/search.php" class="addbutton menu_button" id="menu_user">Search</a>
                <a href="/impressions/php/logout.php" class="addbutton menu_button" id="menu_user">Logout</a></td>
			</table>
		</a>
	</h1>
</header>
<form class="toggle_menu" id="toggle_pins">
	<a href="/impressions/views/my_pins.php" class="addbutton menu_button" id="menu_my_pins">My Pins</a>
	<a href="/impressions/views/all_pins.php" class="addbutton menu_button" id="menu_search_pins">Search Pins</a>
</form>
<form class="toggle_menu" id="toggle_boards">
	<a href="/impressions/views/my_boards.php" class="addbutton menu_button" id="menu_my_boards">My Boards</a>
	<a href="/impressions/views/all_boards.php" class="addbutton menu_button" id="menu_search_boards">Search Boards</a>
</form>







<!---<h3 class='toggle_add addbutton' id="flip">Click to Search!!</h3>-->
<?php   
if(isset($_POST['invited_user']))
{
	echo $_POST["invited_user"]." has been invited!!";
}
?>


<form action="./search_query.php" method="post" style="margin:auto;">
Search:
<input name="search_term" type="text" class="tag" size="50" >

<input value="Search" type="submit">
</form>
<!-- </div> -->
<!--<div hidden id="errmsg"></div>
<br/><br/>

<h2>Here are all your friends!!</h2>-->
<?php

if($error==100)
{
		echo "<form action='' method='post' style='margin:auto;'>";
	
		echo "<table border='0' align='center'>"; 		
		$sql1="SELECT fname,lname,user_id FROM user WHERE user_id NOT IN (select friend_id from friends where user_ID like '".$uname."') AND user_id NOT IN (select user_id from friends where friend_id like '".$uname."') AND (fname like '%$searchdata%' OR lname like '%$searchdata%') AND user_id !='".$uname."'" ;
		$result1 = mysql_query($sql1);

		if($result1)
		{
			while($row1 = mysql_fetch_array($result1))
			{
				$fname=$row1['fname'];
				$lname=$row1['lname'];
				$user_id=$row1['user_id'];
			
				echo "<tr><td align='center'><a href='search_query.php?search_term=".$fname." ".$lname." - \"@".$user_id." \" -&gt; Friends'> ".$fname." ".$lname." - \"@".$user_id."\" -> Friends </a></td></tr>";	
				
				$error = 10;	
			}
		}
		
		
		$sql="SELECT * FROM pinboards WHERE description like '%$searchdata%'" ;
	
		$result = mysql_query($sql);

		if($result)
		{
			while($row = mysql_fetch_array($result))
			{
				$rowid=$row['row_id'];
				$brdname=$row['board_name'];
				$desc=$row['description'];
		
				echo "<tr><td align='center'><a href='search_query.php?search_term=Board No. ".$rowid.", ".$desc." - \"hashh".$brdname."\" -&gt; Boards'> Board No. ".$rowid.", ".$desc." - \"#".$brdname."\" -> Boards </a></td></tr>";
				$error = 10;		
			}
		}
		 
		/////
		$sql2="SELECT * FROM pins WHERE tags like '%$searchdata%'" ;
	
		$result2 = mysql_query($sql2);

		if($result2)
		{
			while($row2 = mysql_fetch_array($result2))
			{
				$rowid=$row2['row_id'];
				$tags=$row2['tags'];
		
				echo "<tr><td align='center'><a href='search_query.php?search_term=Pin No. ".$rowid.", tagged as ".$tags." -&gt; Pins'> Pin No. ".$rowid.", tagged as ".$tags." -> Pins </a></td></tr>";
				$error = 10;
				
			}
		}
		
		if($error==100)
			echo "<tr><td align='center'>No record Found for $searchdata!! Kindly search AGAIN!</td></tr></table></form>";
		else echo "<tr><td align='center'>Multiple Results Found for $searchdata!! Kindly select any one from the above!</td></tr></table></form>";
}
?>
</body>
</html>