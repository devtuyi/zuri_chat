<?php
require("../inc/cookie.php");
if(isset($_COOKIE["name"])) {
    setcookie("name", "", -1, "/", $dom);
    setcookie("username", "", -1, "/", $dom);
    setcookie("lastID", 0, -1, "/", $dom);
}
header("Location: ../index.php");
?>