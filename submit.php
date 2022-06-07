<?php
	require_once("inc/chatClass.php");
	if(isset($_COOKIE["name"])) {
		$chattext = strip_tags( $_GET['chattext'] );
		chatClass::setChatLines($_COOKIE['name'], $_COOKIE['username'], $chattext);
	}
?>