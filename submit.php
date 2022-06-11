<?php
session_start();
require_once("inc/chatClass.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 0");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_COOKIE["name"])) {
	$chattext = strip_tags( $_POST['chattext'] );
	chatClass::setChatLines($_COOKIE['name'], $_COOKIE['username'], $chattext);
	echo '{"data": true}';
} else {
	$_SESSION["msg"] = "Login to send message";
	echo '{"data": false}';
}
?>