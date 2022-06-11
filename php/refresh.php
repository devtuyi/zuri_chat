<?php
session_start();
require_once("./chatClass.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 0");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_SESSION["name"])) {
	setcookie(session_name(), session_id(), time()+1800);
	$jsonData = chatClass::getRestChatLines();
	print $jsonData;
} else {
	echo '{"data": false}';
}
?>