<?php
require_once 'access.php';
$stream_id = key_exists('stream_id', $_POST) ? $_POST['stream_id'] : "";
$stream_name = key_exists('stream_name', $_POST) ? $_POST['stream_name'] : "";
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="/goNYU/js/jquery.js"></script>
		<script src="/goNYU/js/custom.js"></script>
		<script src="/goNYU/js/zino.tooltip.min.js"></script>
		<link rel="stylesheet" href="/goNYU/css/zino.core.css">
        <link rel="stylesheet" href="/goNYU/css/zino.tooltip.css">
		
		<script>
		var stream_id = "<?php echo $stream_id; ?>";
		var stream_name = "<?php echo $stream_name; ?>";

			/*function loadBoards($boards,$boards_desc,$delete_boards) {
				$(".board").remove();
				$.post("../php/show_boards.php", {
					view_mode:"stream",
					stream_id:stream_id
				}, function(data) {
					$delete_boards.html("");
					for (var i = 0; i < data.length; i++) {
						var board = jQuery.parseJSON(data[i]);
						$boards.append("<li id='" + board.board_id + "' class='board'><a>" + board.name + "</a></li>");
						$boards.append("<div id='"+board.board_id+"_name' hidden>"+board.name+"</div>");
						$boards.append("<div id='"+board.board_id+"_uname' hidden>"+board.uname+"</div>");
						$boards_desc.append("<div id='"+board.board_id+"_desc'>"+board.description+"</div>");
						$boards_desc.append("<div id='"+board.board_id+"_cmnt_status'>"+board.cmnt_status+"</div>");
						$delete_boards.append("<option value='"+board.board_id+"'>"+board.name+"</option>")
					}
					$(".board").mouseover(function() {
						$("#show_desc").html($("#"+$(this).attr("id")+"_desc").html());
					});
					$(".board").mouseout(function() {
						$("#show_desc").html("");
					});
					$(".board").click(function() {
						var board_id = $(this).attr("id");
						var board_name = $("#"+board_id+"_name").html();
						var board_user = $("#"+board_id+"_uname").html();
						$("#to_submit").find("input[name=board_id]").val(board_id);
						$("#to_submit").find("input[name=board_name]").val(board_name);
						$("#to_submit").find("input[name=board_user]").val(board_user);
						$("#to_submit").submit();
					});
					$delete_boards.change(function(){
						$("#delete_board").find("textarea").html($("#"+$(this).val()+"_desc").html());
						$("#delete_board").find("input[type=text]").val($("#"+$(this).val()+"_cmnt_status").html());
					});
				}, 'json');
			}*/

			$(document).ready(function() {
				var $boards = $("#boards-list");
				var $boards_desc = $("#boards-desc");
				var $delete_boards = $("#delete_board").find("select[name=board_name]");
				$("#to_submit").hide();
				loadBoards($boards,$boards_desc,{view_mode:"stream", stream_id:stream_id},$delete_boards);
				//loadBoards($boards,$boards_desc,$delete_boards);

				$("#board_title").append(stream_name);

				$("#add_board").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/goNYU/php/createboard.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show().fadeOut(5000);
						}
						else {
							loadBoards($boards,$boards_desc,{view_mode:"stream", stream_id:stream_id},$delete_boards);
							//loadBoards($boards,$boards_desc,$delete_boards);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Board added successfully</p>").show().fadeOut(5000);
							$("#add_board").slideToggle("slow");
						}
					}, 'json');
				});

				$("#delete_board").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/goNYU/php/deleteboard.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show().fadeOut(5000);
						}
						else {
							loadBoards($boards,$boards_desc,{view_mode:"stream", stream_id:stream_id},$delete_boards);
							//loadBoards($boards,$boards_desc,$delete_boards);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Board deleted successfully</p>").show().fadeOut(5000);
							$("#delete_board").slideToggle("slow");
						}
					}, 'json');
				});

				$("#add_board").hide();
				$(".toggle_add").click(function(){
					$("#delete_board").slideUp(500);
					$("#add_board").slideToggle("slow");
					document.getElementsByName("name")[0].focus();
				});
				$("#delete_board").hide();
				$(".toggle_delete").click(function(){
					$("#add_board").slideUp(500);
					$("#delete_board").slideToggle("slow");
					var val = $delete_boards.val();
					$("#delete_board").find("textarea").html($("#"+val+"_desc").html());
					$("#delete_board").find("input[type=text]").val($("#"+$(this).val()+"_cmnt_status").html());
					document.getElementsByName("name")[0].focus();
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
				<a href="/goNYU/views/my_streams.php"class="addbutton menu_button" id="menu_streams">Streams</a>
				<a href="/goNYU/views/user_profile.php" class="addbutton menu_button" id="menu_user">User Accounts</a>
				<a href="/goNYU/views/my_friends.php" class="addbutton menu_button" id="menu_user">My Friends</a>
				<a href="/goNYU/views/search.php" class="addbutton menu_button" id="menu_user">Search</a>
                <a href="/goNYU/php/logout.php" class="addbutton menu_button" id="menu_user">Logout</a></td>
			</table>
		</a>
	</h1>
</header>
<form class="toggle_menu" id="toggle_pins">
	<a href="/goNYU/views/my_pins.php" class="addbutton menu_button" id="menu_my_pins">My Pins</a>
	<a href="/goNYU/views/all_pins.php" class="addbutton menu_button" id="menu_search_pins">Search Pins</a>
</form>
<form class="toggle_menu" id="toggle_boards">
	<a href="/goNYU/views/my_boards.php" class="addbutton menu_button" id="menu_my_boards">My Boards</a>
	<a href="/goNYU/views/all_boards.php" class="addbutton menu_button" id="menu_search_boards">Search Boards</a>
</form>			<!-- <div style="text-align:left;"> -->
			
			<table stlyle="width=100%">
			<tr>
				<td><button class="toggle_add togglebar addbutton" style="text-align:left;">Add Board</button></td>
				<td><button class="toggle_delete togglebar removebutton" style="text-align:left;">Delete Board</button></td>
			</tr>
		</table>
		
		
			<!--<h3 class="toggle_add" style="text-align:left;">Add Board</h3>-->
			<form id="add_board">
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

			<!--<h3 class="toggle_delete" style="text-align:left;">Delete Board</h3>-->
			<form id="delete_board">
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
			<div id="errmsg"></div>

		<!-- The actual Board List starts here -->

		<table border=1>
			<tr>
				<td style="width:95%">
					<section>
						<nav style="width:100%">
							<h3 id="board_title">Boards in Stream </h3>
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
		<form hidden="hidden" id="to_submit" action='/goNYU/views/board_pins.php' method='post'>
			<input type='hidden' name='board_id' />
			<input type='hidden' name='board_name' />
			<input type='hidden' name='board_user' />
		</form>
	</body>
</html>