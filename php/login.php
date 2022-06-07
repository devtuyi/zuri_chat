<?php
require("../inc/cookie.php");
if(isset($_COOKIE["name"])) {
    $_COOKIE["msg"] = "Session active";
} elseif(isset($_POST["submit"])){
    setcookie("msg", "", -1, "/", $dom);
    $email = (string) $_POST["email"];
    $password = (string) $_POST["password"];
    $email = strtolower($email);
    if(($handle = fopen("../storage/users.csv", "r")) !== FALSE) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            while(($data = fgetcsv($handle)) !== FALSE) {
                if($data[1] == $email || $data[3] == $email) {
                    if($data[2] == md5($password)) {
                        $time = time();
                        setcookie("name", $data[0], ($time + 1800), "/", $dom);
                        setcookie("username", $data[3], ($time + 1800), "/", $dom);
                        setcookie("lastID", filesize("../storage/chats.csv"), ($time + 1800), "/", $dom);
                        $_COOKIE["msg"] = "Login successful";
                    } else {
                        $_COOKIE["msg"] = "Incorrect password";
                    }
                }
            }
            $_COOKIE["msg"] = isset($_COOKIE["msg"]) ? $_COOKIE["msg"] : "User not registered";
        } else {
            $_COOKIE["msg"] = "Invalid email address";
        }
        fclose($handle);
    } else {
        $_COOKIE["msg"] = "Internal error";
    }
} else {
    $_COOKIE["msg"] = "Access denied";
}
header("Location: ../index.php");
?>