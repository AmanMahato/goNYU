<?php
session_start();
if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time()) {
	session_destroy();
	$_SESSION = array();
}	

if (key_exists('uname', $_SESSION) && (!isset($uname)|| $uname!="")){
	$uname = $_SESSION['uname'];
}

if(!isset($uname)){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Welcome to goNYU!</title>
		<link href="/impressions/css/default_Login.css" rel="stylesheet" />
		<script src="/impressions/js/jquery.js"></script>
		<script type="text/javascript">
			var self = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>";
			$(document).ready(function() {
				$("#loginform").submit(function(event) {
					event.preventDefault();
					$("#errmsg").hide();
					$.post('/impressions/php/validate_user.php', $(this).serialize(), function(data) {

						if (data.errorcode == 1) {
							$("#errmsg").html("<p>" + data.errormsg + "</p>").show();
						} else if (data.errorcode == 2) {
							$("#errmsg").html("<p>" + data.errormsg + "</p>").show();
						}
						else{
							window.location.replace(self);
						}
					},"json");
				});
				document.getElementsByName("uname")[0].focus();
			});
		</script>
	</head>
	<body>
		<div align="center">
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
		</div>
		<div style="text-align: center;">
			<a href="/impressions"><img src="/impressions/css/images/logo_large.png" alt="logo" height="20%" width="40%"/></a>
			<form id="loginform" method="post">
            <h1 class="entry-title" align="center"><font color="#FFFFFF"> Login </font> </h1>
				<table>
					<tr><td><lable>
					User Name:
				</lable></td><td><input name="uname" type="text"></td></tr>
				<tr><td><lable>
					Password:
				</lable></td><td><input name="pwd" type="password"></td></tr>
				<tr><td><br></td><td><br></td></tr>
				<tr><td><input value="Login" type="submit"></td><td>Don't Have Account?? <a href = "signup.html">Sign Up</a></td></tr>
				</table>
			</form>
		</div>
		<div class="ui-error" hidden id="errmsg"></div>
	</body>
</html>
<?php
	exit();
}
else{
	$_SESSION['EXPIRES'] = time()+360;
}
?>