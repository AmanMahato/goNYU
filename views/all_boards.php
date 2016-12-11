<?php
require_once 'access.php';
$uname = isset($_SESSION['uname'])?$_SESSION['uname']:"";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>impressions - Boards</title>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="/impressions/js/jquery-1.8.3.js"></script>
		<script src="/impressions/js/jquery-ui-1.9.2.custom.js"></script>
		<script src="/impressions/js/zino.tooltip.min.js"></script>
		<link rel="stylesheet" href="/impressions/css/zino.core.css">
        <link rel="stylesheet" href="/impressions/css/zino.tooltip.css">
		<script src="/impressions/js/custom.js"></script>
		<script>
			var uname = "<?php echo strtolower($uname);?>";

			$(document).ready(function() {

				var $boards = $("#boards-list");
				var $boards_desc = $("#boards-desc");

				$("#to_submit").hide();

				loadBoards($boards,$boards_desc,{view_mode:"all"},null);

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
		<table border=1>
			<tr>
				<td style="width:100%">
					<section class='clear'>
						<nav style="width:100%">
							<h3 >All Boards</h3>
							<ul style="width: 100%">
							<div id="boards-list"></div>
							</ul>
						</nav>
					</section>
				</td>
			</tr>
		</table>
		<form hidden="hidden" id="to_submit" action='/impressions/views/board_pins.php' method='post'>
			<input type='hidden' name='board_id' />
			<input type='hidden' name='board_name' />
			<input type='hidden' name='board_user' />
		</form>
	</body>
</html>