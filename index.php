<?php
require("./inc/cookie.php");
	if(isset($_COOKIE["name"])){
		?>
<html>
	<head>
		<title>Chat Room</title>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<?php
		if(isset($_COOKIE["msg"]) && !empty($_COOKIE["msg"])) {
			echo "<div class=\"noti\">{$_COOKIE['msg']}</div>";
			setcookie("msg", "", -1);
		} ?>
		<form action="php/login.php" method="post">
			<table cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td align="left" valign="top">Email:</td>
					<td align="left" valign="top">
						<input type="text" name="email" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top">Password:</td>
					<td align="left" valign="top">
						<input type="password" name="password" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top"></td>
					<td align="left" valign="top"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
		</form>
		<form action="php/register.php" method="post">
			<table cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td align="left" valign="top">Name:</td>
					<td align="left" valign="top">
						<input type="text" name="name" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top">Username:</td>
					<td align="left" valign="top">
						<input type="text" name="username" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top">Email:</td>
					<td align="left" valign="top">
						<input type="text" name="email" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top">Password:</td>
					<td align="left" valign="top">
						<input type="password" name="password" required/>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top"></td>
					<td align="left" valign="top"><input type="submit" name="submit" value="Register" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	}else{
?>
<html>
	<head>
		<title>Chat Room Example</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/main.js"></script>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<div id="view_ajax"></div>
		<div id="ajaxForm">
			<input type="text" id="chatInput" /><input type="button" value="Send" id="btnSend" />
		</div>
	</body>
</html>
<?php } ?>
