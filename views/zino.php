<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Menu - Zino UI HTML5 framework</title>
        <meta name="description" content="Creates nestable menus, accessible via keyboard.">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="http://zinoui.com/1.4/themes/silver/zino.core.css">
        <link rel="stylesheet" href="http://zinoui.com/1.4/themes/silver/zino.menu.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="http://zinoui.com/1.4/compiled/zino.datasource.min.js"></script>
        <script src="http://zinoui.com/1.4/compiled/zino.menu.min.js"></script>
                <style type="text/css">body{padding: 15px; font: normal 12px Arial, sans-serif;}</style>
    </head>
    <body>
    <ul id="menu_html">
    <li><a href="#">Atlantic division</a>
    	<ul>
			<li><a href="#">New York Knicks</a></li>
			<li><a href="#">Boston Celtics</a></li>
			<li><a href="#">Philadelphia 76ers</a></li>
		</ul>
	</li>
	<li><a href="#">Northwest Division</a>
		<ul>
			<li><a href="#">Oklahoma City Thunder</a></li>
			<li><a href="#">Denver Nuggets</a></li>
			<li><a href="#">Utah Jazz</a></li>
		</ul>
	</li>
	<li><a href="#">Pasific Division</a>
		<ul>
			<li><a href="#">L.A. Lakers</a></li>
			<li><a href="#">Sacramento Kings</a></li>
			<li><a href="#">L.A. Clippers</a></li>
		</ul>
	</li>
	<li><a href="#">Southwest Division</a></li>
</ul>

<script type="text/javascript">
$(function () {
    $("#menu_html").zinoMenu({
        enable: function (event, ui) {
            //console.log("enable", event, ui);
        },
        disable: function (event, ui) {
            //console.log("disable", event, ui);
        }
    });
});
</script>    </body>
</html>