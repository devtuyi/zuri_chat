<?php
session_start();
require("chatClass.php");
chatClass::setOffline();
session_destroy();
header("Location: ../index.php");
?>