<?php
session_start();
require_once("inc/chatClass.php");
require("./inc/cookie.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 0");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_COOKIE["name"])) {
	setcookie("name", $_COOKIE["name"], $time, "/", $dom);
	setcookie("username", $_COOKIE["username"], $time, "/", $dom);
	setcookie("lastID", $_COOKIE["lastID"], $time, "/", $dom);
	$id = intval($_GET["lastID"]);
	$jsonData = chatClass::getRestChatLines($id);
	print $jsonData;
} else {
	echo "[]";
}
?>