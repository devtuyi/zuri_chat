<?php
require("../inc/cookie.php");
if(isset($_COOKIE["name"])) {
    $_COOKIE["msg"] = "Session active";
} elseif(isset($_POST["submit"])){
    setcookie("msg", "", -1, "/", $dom);
    $name = (string) $_POST["name"];
    $username = (string) $_POST["username"];
    $email = (string) $_POST["email"];
    $password = (string) $_POST["password"];
    $name = ucwords(htmlspecialchars(strip_tags($name)));
    if(empty($name) || empty($username) || empty($email) || empty($password) || empty($password) || empty($email)) {
        $_COOKIE["msg"] = "All fields are required";
    } elseif(preg_match("/[^A-z\s]/", $name) || strlen($name) < 3) {
        $_COOKIE["msg"] = "Name contains invalid characters<br>Only alphabeths are allowed<br/>Minimun length: 3";
    } elseif(preg_match("/[^A-z0-9\_]/", $username) || strlen($username) < 3) {
        $_COOKIE["msg"] = "Username contains invalid characters<br>Allowed characters: A-z, 0-9, _<br/>Minimun length: 3";
    } elseif(strlen($password) < 5) {
        $_COOKIE["msg"] = "Password is too short<br/>Minimun length: 6";
    } elseif(($handle = fopen("../storage/users.csv", "a+")) !== FALSE) {
        $email = strtolower($email);
        $password = md5($password);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            while(($data = fgetcsv($handle)) !== FALSE) {
                if($data[1] == $email) {
                    $_COOKIE["msg"] = "Email exist";
                } elseif($data[3] == $username) {
                    $_COOKIE["msg"] = "Username exist";
                }
            }
            if(!isset($_COOKIE["msg"])) {
                fputcsv($handle, array($name, $email, $password, $username));
                $time = time();
                setcookie("name", $name, ($time + 1800), "/", $dom);
                setcookie("username", $username, ($time + 1800), "/", $dom);
                setcookie("lastID", filesize("../storage/chats.csv"), ($time + 1800), "/", $dom);
                $_COOKIE["msg"] = "User Successfully registered";
            }
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