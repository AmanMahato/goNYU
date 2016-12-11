<?php
require_once 'access.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>impressions - Boards</title>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="/impressions/js/jquery.js"></script>
		<script src="/impressions/js/custom.js"></script>
		<script src="/impressions/js/zino.tooltip.min.js"></script>
		<link rel="stylesheet" href="/impressions/css/zino.core.css">
        <link rel="stylesheet" href="/impressions/css/zino.tooltip.css">
		<script>
			$(document).ready(function() {
				var $boards = $("#boards-list");
				var $boards_desc = $("#boards-desc");
				var $delete_boards = $("#delete_board").find("select[name=board_name]");
				$("#to_submit").hide();

				loadBoards($boards,$boards_desc,{view_mode:"my"},$delete_boards);

				$("#add_board").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/impressions/php/createboard.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show().fadeOut(5000);
						}
						else {
							loadBoards($boards,$boards_desc,{view_mode:"my"},$delete_boards);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Board added successfully</p>").show().fadeOut(5000);
							$("#add_board").slideToggle("slow");
						}
					}, 'json');
				});

				$("#delete_board").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/impressions/php/deleteboard.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show().fadeOut(5000);
						}
						else {
							loadBoards($boards,$boards_desc,{view_mode:"my"},$delete_boards);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Board deleted successfully</p>").show().fadeOut(5000);
							$("#delete_board").slideToggle("slow");
						}
					}, 'json');
				});

				$("#add_board").hide();
				$("#delete_board").hide();

				$(".toggle_add").click(function(){
					$(".toggleform").not("#add_board").slideUp(500,function(){
					$("#add_board").slideToggle("slow");
					$("#add_board").find("input[name=name]").focus();
						
					});
				});

				$(".toggle_delete").click(function(){
					
					$.post("../php/show_boards.php", {
						view_mode:"my"
					}, function(data) {
						var $boards = $("#delete_board_name");
						for (var i = 0; i < data.length; i++) {
							var board = jQuery.parseJSON(data[i]);
							$boards.append("<option value='" + board.board_id + "'>" + board.name + "</option>");
						}
					}, 'json');

					$(".toggleform").not("#delete_board").slideUp(500,function(){
					$("#delete_board").slideToggle("slow");
					var val = $delete_boards.val();
					$("#delete_board").find("textarea").html($("#"+val+"_desc").html());
					$("#delete_board").find("input[type=text]").val($("#"+$(this).val()+"_cmnt_status").html());
					document.getElementsByName("name")[0].focus();
					});

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
</form>			<!-- <div style="text-align:left;"> -->
		<table stlyle="width=100%">
			<tr>
				<td><button class="toggle_add togglebar addbutton" style="text-align:left;">Add Board</button></td>
				<td><button class="toggle_delete togglebar removebutton" style="text-align:left;">Delete Board</button></td>
			</tr>
		</table>

			<form id="add_board" class="toggleform">
				<table border=1>
					<tr>
						<td><label>Board Name</label></td><td><input type="text" name="name"/></td>
					</tr>
					<tr>
						<td style="vertical-align:middle;"><label>Description</label></td><td><textarea name="description"></textarea></td>
					</tr>
					<tr>
						<td><label>Comment Privacy Setting</label></td>
						<td style="text-align:left;">
							<select name="comment_privacy">
								<option value="Friends">Friends</option>
								<option value="Public">Public</option>
								<option value="Private">Private</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="Add Board" class="addbutton" style="width:100%"/></td>
					</tr>
				</table>
			</form>

			<form id="delete_board" class="toggleform">
				<table border=1>
					<tr>
						<td><label>Board Name</label></td><td><select name="board_name" id="delete_board_name"/></td>
					</tr>
					<tr>
						<td style="vertical-align:middle;"><label>Description</label></td><td><textarea name="description" disabled></textarea></td>
					</tr>
					<tr>
						<td><label>Comment Privacy Setting</label></td>
						<td style="text-align:left;">
							<input type="text" disabled>
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="Delete Board" class="removebutton" style="width:100%"/></td>
					</tr>
				</table>
			</form>

		<!-- The actual Board List starts here -->

		<table border=1 bgcolor="#0066CC">
			<tr>
				<td style="width:95%">
					<section>
						<nav style="width:100%">
							<h3 >My Boards</h3>
							<ul style="width: 100%">
							<div id="boards-list"></div>
							</ul>
						</nav>
					</section>
				</td>
				<td style="vertical-align:top;padding:150px;"><div id="show_desc" /></td>
			</tr>
		</table>
		<div hidden="hidden" id="boards-desc"></div>
		<form hidden="hidden" id="to_submit" action='/impressions/views/board_pins.php' method='post'>
			<input type='hidden' name='board_id' />
			<input type='hidden' name='board_name' />
			<input type='hidden' name='board_user' />
		</form>
			<div id="errmsg"></div>
	</body>
</html>