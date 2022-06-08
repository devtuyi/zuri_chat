<?php
session_start();
require("../inc/cookie.php");
if(isset($_COOKIE["name"])) {
    $msg = "Session active";
} elseif(isset($_POST["submit"])){
    $email = (string) $_POST["email"];
    $password = (string) $_POST["password"];
    $email = strtolower($email);
    if(($handle = fopen("../storage/users.csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle)) !== FALSE) {
            if($data[1] == $email || $data[3] == $email) {
                if($data[2] == md5($password)) {
                    $time = time();
                    setcookie("name", $data[0], ($time + 1800), "/", $dom);
                    setcookie("username", $data[3], ($time + 1800), "/", $dom);
                    setcookie("lastID", filesize("../storage/chats.csv"), ($time + 1800), "/", $dom);
                    $msg = "Login successful";
                } else {
                    $msg = "Incorrect password";
                }
            }
        }
        $msg = isset($msg) ? $msg : "User not registered";
        fclose($handle);
    } else {
        $msg = "Internal error";
    }
} else {
    $msg = "Access denied";
}
$_SESSION["msg"] = $msg;
header("Location: ../index.php");
?>