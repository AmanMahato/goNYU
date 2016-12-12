<?php
require_once 'access.php';
$uname = isset($_SESSION['uname'])?$_SESSION['uname']:"";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>goNYU</title>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="/goNYU/js/jquery-1.8.3.js"></script>
		<script src="/goNYU/js/jquery-ui-1.9.2.custom.js"></script>
		<script src="/goNYU/js/zino.tooltip.min.js"></script>
		<link rel="stylesheet" href="/goNYU/css/zino.core.css">
        <link rel="stylesheet" href="/goNYU/css/zino.tooltip.css">
		<script src="/goNYU/js/custom.js"></script>
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
		<table border=1>
			<tr>
				<td style="width:100%">
					<section class='clear'>
						<nav style="width:100%">
							<h3 >All Diary</h3>
							<ul style="width: 100%">
							<div id="boards-list"></div>
							</ul>
						</nav>
					</section>
				</td>
			</tr>
		</table>
		<form hidden="hidden" id="to_submit" action='/goNYU/views/board_pins.php' method='post'>
			<input type='hidden' name='board_id' />
			<input type='hidden' name='board_name' />
			<input type='hidden' name='board_user' />
		</form>
	</body>
</html>