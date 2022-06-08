<?php
require("./inc/cookie.php");
if(isset($_COOKIE["name"])){
?>
<html>
	<head>
		<title>Chat Room</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/main.js"></script>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	</head>
	<body>
		<div class="padding">
			<div class="row container d-flex justify-content-center">
				<div class="col-md-6">
					<div class="card border-primary">
						<div class="card-header">
							<span class="pull-left"><strong>Chat</strong></span>
							<a class="btn btn-sm btn-outline-danger pull-right" style="float: right;" href="php/logout.php">End chat</a>
						</div>

						<div class="card-body" id="view_ajax"></div>
						
						<div class="card-footer input-group">
							<input class="form-control" type="text" placeholder="Write something" id="chatInput">
							<span class="input-group-text">
								<a class="" href="#" id="btnSend"><i class="bi bi-send"></i></a>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<html>
<?php
	} else {
?>
	<head>
		<title>Chat Room</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<?php
		if(isset($_COOKIE["msg"]) && !empty($_COOKIE["msg"])) {
			echo "<div class=\"noti\">{$_COOKIE['msg']}</div>";
			setcookie("msg", "", -1, "/", $dom);
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
<?php } ?>