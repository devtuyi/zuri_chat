<?php
session_start();
require_once("chatClass.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 0");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_SESSION["name"]) && isset($_POST["_l"])) {
	chatClass::setOnline();
	if(intval($_POST["_l"]) == "0") {
		$jsonData = chatClass::getStartChatLines();
	} else {
		$jsonData = chatClass::getRestChatLines();
	}
	print $jsonData;
} else {
	echo '{"data": false}';
}
?>