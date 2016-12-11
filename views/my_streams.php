<?php
require_once 'access.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>impressions - streams</title>
		<link href="../css/default.css" rel="stylesheet" />
		<script src="/impressions/js/jquery.js"></script>
		<script src="/impressions/js/custom.js"></script>
		<script src="/impressions/js/zino.tooltip.min.js"></script>
		<link rel="stylesheet" href="/impressions/css/zino.core.css">
        <link rel="stylesheet" href="/impressions/css/zino.tooltip.css">
		<script>

				/*function loadStreams ($streams,$streams_desc,$delete_stream) {
					$(".stream").remove();
					$.post("../php/show_streams.php",  {
						view_mode:"my"
					}, function(data) {
						$delete_stream.html("");
						for (var i = 0; i < data.length; i++) {
							var stream = jQuery.parseJSON(data[i]);
							$streams.append("<li id='" + stream.stream_id + "' class='stream'><a title = '<b>Description:</b><br/>"+stream.description+"'>" + stream.name + "</a></li>");
							$streams_desc.append("<div id='"+stream.stream_id+"_name' hidden>"+stream.name+"</div>");
							$streams_desc.append("<div id='"+stream.stream_id+"_desc' hidden>"+stream.description+"</div>");
							$streams_desc.append("<div id='"+stream.stream_id+"_keyword' hidden>"+stream.kquery+"</div>");
							$delete_stream.append("<option value='"+stream.stream_id+"'>"+stream.name+"</option>");
						}
						$(".stream").zinoTooltip({follow: true});
			/*			$(".stream").mouseover(function() {
							$("#show_desc").html($("#"+$(this).attr("id")+"_desc").html());
						});*/
						/*$(".stream").mouseout(function() {
							$("#show_desc").html("");
						});
						$(".stream").click(function() {
							var ID = $(this).attr("id");
							$("#to_submit").find("input[name=stream_id]").val(ID);
							$("#to_submit").find("input[name=stream_name]").val($("#"+ID+"_name").html());
							$("#to_submit").submit();
						});
						$delete_stream.change(function(){
						$("#delete_stream").find("textarea").html($("#"+$(this).val()+"_desc").html());
						$("#delete_stream").find("input[type=text]").val($("#"+$(this).val()+"_keyword").html());
					});
					}, 'json')
			}*/

			$(document).ready(function() {

				var $streams = $("#streams-list");
				var $streams_desc = $("#streams-desc");
				var $delete_stream = $("#stream_name");

				$("#to_submit").hide();

				loadStreams ($streams,$streams_desc,$delete_stream);

				$("#add_stream").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/impressions/php/createstream.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show();
						}
						else {
							loadStreams ($streams,$streams_desc,$delete_stream);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Stream  added successfully</p>").show().fadeOut(5000);
							$("#add_stream").slideToggle("slow");
						}
					}, 'json');
				});

				$("#delete_stream").submit(function(event){
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/impressions/php/deletestream.php', $(this).serialize(), function(data) {
						if (data.errorcode == 1) {
							$("#errmsg").html(data.errormsg).show();
						}
						else {
							loadStreams ($streams,$streams_desc,$delete_stream);
							$("#errmsg").html(data.errormsg+"<p class='ui-success'>Stream  deleted successfully</p>").show().fadeOut(5000);
							$("#delete_stream").slideToggle("slow");
						}
					}, 'json');
				});

				$("#add_stream").hide();
				$(".toggle_add").click(function(){
					$(".toggleform").not("#add_stream").slideUp(500);
					$("#add_stream").slideToggle("slow");
					document.getElementsByName("name")[0].focus();
				});
				$("#delete_stream").hide();
				$(".toggle_delete").click(function(){
					var val = $delete_stream.val();
					$(".toggleform").not("#delete_stream").slideUp(500);
					$("#delete_stream").slideToggle("slow");
					$("#delete_stream").find("textarea").html($("#"+val+"_desc").html());
					$("#delete_stream").find("input[type=text]").val($("#"+$(this).val()+"_keyword").html());
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
</form><table stlyle="width=100%">
			<tr>
				<td><button class="toggle_add togglebar addbutton" style="text-align:left;">Add Stream</button></td>
				<td><button class="toggle_delete togglebar removebutton" style="text-align:left;">Delete Stream</button></td>
			</tr>
		</table>
<!--<h3 class="toggle_add" style="text-align:left;">Add Stream</h3>-->
				<form id="add_stream" class="toggleform">
					<table border=1>
						<tr>
							<td><label>Stream Name</label></td><td><input type="text" name="name"/></td>
						</tr>
						<tr>
							<td style="vertical-align:middle;"><label>Description</label></td><td><textarea name="description"></textarea></td>
						</tr>
						<tr>
							<td><label>Keyword Query</label></td>
							<td>
								<input type="text" name="keyword">
							</td>
						</tr>
						<tr>
							<td><input type="submit" value="Add Stream" class="addbutton" style="width:100%"/></td>
						</tr>
					</table>
				</form>

				<!--<h3 class="toggle_delete" style="text-align:left;">Delete Stream</h3>-->
				<form id="delete_stream" class="toggleform">
					<table border=1>
						<tr>
							<td><label>Stream Name</label></td><td><select id="stream_name" name="stream_name"></select></td>
						</tr>
						<tr>
							<td style="vertical-align:middle;"><label>Description</label></td><td><textarea name="description" disabled></textarea></td>
						</tr>
						<tr>
							<td><label>Keyword Query</label></td>
							<td>
								<input type="text" name="keyword" disabled>
							</td>
						</tr>
						<tr>
							<td><input type="submit" value="Delete Stream" class="removebutton" style="width:100%"/></td>
						</tr>
					</table>
				</form>
		<div id="errmsg"></div>

		<!-- Actual Stream data is loaded here -->

		<table>
			<tr>
				<td style="width:80%">
					<section class='clear'>
						<nav style="width:100%">
							<h3 >My Streams</h3>
							<ul style="width: 100%">
							<div id="streams-list"></div>
							</ul>
						</nav>
					</section>
				</td>
				<td style="vertical-align:top;padding:50px"><div id="show_desc" /></td>
			</tr>
		</table>
		<div hidden="hidden" id="streams-desc"></div>
		<form hidden="hidden" id="to_submit" action='/impressions/views/stream_boards.php' method='post'>
			<input type='hidden' name='stream_id' />
			<input type='hidden' name='stream_name' />
		</form>
	</body>
</html>