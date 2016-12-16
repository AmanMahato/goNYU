<?php
require_once 'access.php';
$pin_id = isset($_REQUEST['pin_id'])?$_REQUEST['pin_id']:0;
$user_id = isset($_SESSION['uname'])?$_SESSION['uname']:"";
?>
<html>
	<head>
		<title>goNYU</title>
		<link href="/goNYU/css/default.css" rel="stylesheet" />
		<script src="/goNYU/js/jquery.js"></script>
		<script src="/goNYU/js/jquery.form.js"></script>
		<script src="/goNYU/js/custom.js"></script>
		<script type="text/javascript">
			var pin_id = <?php echo $pin_id; ?>;
			var user_id = "<?php echo $user_id; ?>";

			$(document).ready(function(){
				$("#pin_id").val(pin_id);
				var $comment_list = $("#comment_list");

				viewPin(pin_id,user_id);
				loadComments($comment_list);

				$("#comment_pin_id").val(pin_id);

				$("#like_pin").submit(function(event){
					event.preventDefault();
					$.post("../php/toggle_like.php", $(this).serialize(), function(data) {
							// like_errmsg
							viewPin(pin_id,user_id);
						}, 'json');
				});

				$("#post_comments").ajaxForm(function (data) {
					// event.preventDefault();
					// post comment
					data = jQuery.parseJSON(data);
					if (data.errorcode == 1) {
						$("#errmsg").html(data.errormsg).show().fadeOut(5000);
					} else {
						$("#errmsg").html(data.errormsg+"<p class='ui-success'>Comment added successfully</p>").show().fadeOut(5000);
						loadComments($comment_list);
					}
				},'json');

				$.post("../php/show_boards.php", {
					view_mode:"my"
				}, function(data) {
					var $boards = $("#repin_boards,#unpin_boards");
					for (var i = 0; i < data.length; i++) {
						var board = jQuery.parseJSON(data[i]);
						$boards.append("<option value='" + board.board_id + "'>" + board.name + "</option>");
					}
				}, 'json');

				$("#repin").hide();
				$("#unpin").hide();

				$(".toggle_repin").click(function(){
					$(".toggleform").not("#repin").slideUp(500,function(){
							$("#repin").slideToggle("slow");
							$("#repin").find("[name=title]").val($("#pin_title").html());
							$("#repin").find("[name=description]").val($("#pin_desc").html());
							$("#repin").find("[name=tags]").val($("#pin_tags").html());
							$("#repin").find("[name=root_pin_id]").val($("#likes_pin_id").val());
							$("#repin").find("[name=title]").focus();
						});
				});
				$(".toggle_unpin").click(function(){
					$(".toggleform").not("#unpin").slideUp(500,function(){
						$("#unpin").slideToggle("slow");
						$("#unpin").find("[name=title]").focus();
					});
				});

				$('#repin').ajaxForm(function(data) { 
					data = jQuery.parseJSON(data);
					if (data.errorcode == 1) {
						$("#errmsg").html(data.errormsg).show().fadeOut(5000);
					} else {
						$("#errmsg").html(data.errormsg+"<p class='ui-success'>Pin added successfully</p>").show().fadeOut(5000);
						pin_id = data.pin_id;
						viewPin(pin_id,user_id);
						$("#repin").slideToggle("slow");
					}
				},'json');
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
</form>		<table stlyle="width=100%">
			<tr>
				<td><button class="toggle_repin menubutton" style="text-align:left;">Re-Pin</button></td>
				<td><button class="toggle_unpin menubutton" style="text-align:left;">Un-Pin</button></td>
			</tr>
		</table>


		<form id="unpin" class="toggleform">
			<table>
					<tr><td><label>Title</label></td><td><input type="text" name="title"/></td></tr>
					<tr><td style="vertical-align:middle;"><label>Description</label></td><td><textarea name="description"></textarea></td></tr>
					<tr><td><label>Diary</label></td><td><select name='pinboard_id' form='add_pin' id="unpin_boards"/></td></tr>
					<tr><td><label>Tags</label></td><td><input type="text" name="tags"/></td></tr>
					<tr><td><input type="submit" class="addbutton" value="Add Pin"/></td></tr>
				</table>
		</form>



		<form id="repin" class="toggleform" method="post" action="/goNYU/php/repin.php">
			<table>
					<input type="text" name = "root_pin_id" hidden />
					<tr><td><label>Title</label></td><td><input type="text" name="title"/></td></tr>
					<tr><td><label>Diary</label></td><td><select name='pinboard_id' form='repin' id="repin_boards"/></td></tr>
					<tr><td><label>Tags</label></td><td><input type="text" name="tags"/></td></tr>
					<tr><td><input type="submit" class="addbutton" value="Add Pin"/></td></tr>
				</table>
		</form></td></tr>
		<tr><td>
		<!-- Pin Details -->
		<form id="like_pin" class="show-pin" style="margin:auto;">
			<input type="text" id="likes_pin_id" name = "pin_id" hidden />
			<input type="text" id="likes_pic_id" hidden name="pic_id" />
			<input type="text" id="likes_root_pin_id" hidden name="root_pin_id" />
			<input type="text" id="likes_user_id" hidden name="user_id" />
				<h3 id="pin_title" style="text-align:center;" /></h3>
			<table>
				<tr><td style="width:0%"><input id="like_button" type="submit" value="">&nbsp&nbspLikes:&nbsp&nbsp<text id="llikes" /></td></tr>
				<tr><td  style="text-align:center;" colspan=2><img id="pin_pic" src="" style=""/></td></tr>
				<tr><td>Description: </td> <td  style="text-align:center;"><p id="pin_desc" /></td></tr>
				<tr><td>Tags: </td><td style="text-align:center;"><div id="pin_tags" ></div></td></tr>
				</table>
		</form>
		<!-- Comments are handeled here -->
		<form id="post_comments" style="margin:auto;" method="post" action="/goNYU/php/createcomment.php">
			<input type="hidden" id="comment_pin_id" name="pin_id" value="<?php echo $pin_id; ?>">
			<table style="width:100%">
				<tr><td colspan="2" style="text-align:left;"><input type="text" name="message" style="width:100%;"/></td></tr>
				<tr><td></td><td style="text-align:right;"><input type="submit" class="formsubmit" value="Post"/></td></tr>
			</table>
				<div id="comment_list"></div>
		</form>
		<!-- <div id="pin_comments"> </div> -->
		<div id="like_errmsg"> </div>
		<div id="errmsg"> </div>
	</body>
</html>