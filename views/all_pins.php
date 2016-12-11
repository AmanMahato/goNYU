<?php
require_once 'access.php';
$user_id = isset($_SESSION['uname'])?$_SESSION['uname']:"";
?>
<html>
	<head>
		<title>impressions - Pins</title>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="../js/jquery.js"></script>
		<script src="/impressions/js/custom.js"></script>
		<script>
		var user_id = "<?php echo $user_id; ?>";
		// function makepin (title,filename,tags){
		// 	pintext = "<div class='show-pin'><table>";
		// 	pintext += "<tr><th><lable>"+title+"</lable></th></tr>";
		// 	//pintext += "<br /><br />";
		// 	pintext += "<tr><td><img class = 'show-pin' src='/impressions/images/"+filename+"' alt='"+filename+"'></td>";
		// 	//pintext += "<p>"+tags+"</p>";
		// 	pintext += "</table></div>";
		// 	return pintext;
		// }
			$(document).ready(function() {
		// 		var $pins = $("#pins");
		// 		$.post("../php/show_pins.php", "", function(data) {
		// 			for (var i = 0; i < data.length; i++) {
		// 				var pin = jQuery.parseJSON(data[i])
		// 				$pins.prepend(makepin(pin.title,pin.fpath,pin.tags));
		// 			}
		// 		}, 'json');
			var $pins = $("#pins");

			// $("#view_pin").hide();
			loadPins($pins,{view_mode:"all"},user_id);
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
		<table><tr></tr></table>
		<div id="pins"></div>
		<div id="temp" />
		<div id="errmsg" />
	</body>
</html>