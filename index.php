<?php
session_start();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Chat Room</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/main.js"></script>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	</head>
	<body>
<?php
if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])) {
	if(strpos($_SESSION["msg"], "successful") !== false && !isset($_COOKIE["name"])) {
		echo "<div class='alert alert-danger'>Enable cookies in your browser</div>";
	} else {
		echo "<div class='alert alert-warning'>{$_SESSION['msg']}</div>";
	}
	if($_SESSION["msg"] == "Session closed") {
		session_destroy();
	} else {
		unset($_SESSION["msg"]);
	}
}
require("./inc/cookie.php");
if(isset($_COOKIE["name"])){
?>
		<div class="py-5">
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
<?php
	} else {
?>
		<div class="row container d-flex justify-content-center py-5">
			<div class="col">
				<div class="row">
					<div class="col-auto">
						<form action="php/login.php" method="post">
							<div class="form-floating py-1">
								<input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
								<label for="floatingInput">Email address</label>
							</div>
							<div class="form-floating py-1">
								<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
								<label for="floatingPassword">Password</label>
							</div>
							<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
						</form>
					</div>
					<div class="col-sm-0 col-md-1 clear"></div>
					<div class="col-auto">
						<form action="php/register.php" method="post">
							<div class="form-floating py-1">
								<input type="text" name="name" class="form-control" id="floatingInputName" placeholder="John Doe">
								<label for="floatingInputName">Full name</label>
							</div>
							<div class="form-floating py-1">
								<input type="text" name="username" class="form-control" id="floatingInputUserName" placeholder="@johndoe">
								<label for="floatingInputUserName">Username</label>
							</div>
							<div class="form-floating py-1">
								<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
								<label for="floatingInput">Email address</label>
							</div>
							<div class="form-floating py-1">
								<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
								<label for="floatingPassword">Password</label>
							</div>
							<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php
}
?>
	</body>
</html>
