<?php
session_start();
require("../inc/cookie.php");
if(isset($_COOKIE["name"])) {
    $msg = "Session active";
} elseif(isset($_POST["submit"])){
    $email = (string) $_POST["email"];
    $password = (string) $_POST["password"];
    $email = strtolower($email);
    if(empty($email) || empty($password)) {
        $msg = "All fields are required";
    } elseif(($handle = fopen("../storage/users.csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle)) !== FALSE) {
            if($data[1] == $email || $data[3] == $email) {
                if($data[2] == md5($password)) {
                    setcookie("name", $data[0], $time, "/", $dom);
                    setcookie("username", $data[3], $time, "/", $dom);
                    setcookie("lastID", filesize("../storage/chats.csv"), $time, "/", $dom);
                    $msg = "Login successful";
                } else {
                    $msg = "Incorrect password";
                }
                break;
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