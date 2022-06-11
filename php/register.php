<?php
session_start();
if(isset($_SESSION["name"])) {
    $msg = "Session active";
} elseif(isset($_POST["submit"])){
    $name = (string) $_POST["name"];
    $username = (string) $_POST["username"];
    $email = (string) $_POST["email"];
    $password = (string) $_POST["password"];
    $name = ucwords(htmlspecialchars(strip_tags($name)));
    if(empty($name) || empty($username) || empty($email) || empty($password) || empty($password) || empty($email)) {
        $msg = "All fields are required";
    } elseif(preg_match("/[^A-z\s]/", $name) || strlen($name) < 3) {
        $msg = "Name contains invalid characters<br>Only alphabeths are allowed<br/>Minimun length: 3";
    } elseif(preg_match("/[^A-z0-9\_]/", $username) || strlen($username) < 3) {
        $msg = "Username contains invalid characters<br>Allowed characters: A-z, 0-9, _<br/>Minimun length: 3";
    } elseif(strlen($password) < 5) {
        $msg = "Password is too short<br/>Minimun length: 6";
    } elseif(($handle = fopen("../storage/users.csv", "a+")) !== FALSE) {
        $username = strtolower($username);
        $email = strtolower($email);
        $password = md5($password);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            while(($data = fgetcsv($handle)) !== FALSE) {
                if($data[1] == $email) {
                    $msg = "Email exist";
                    break;
                } elseif($data[3] == $username) {
                    $msg = "Username exist";
                    break;
                }
            }
            if(!isset($msg)) {
                fputcsv($handle, array($name, $email, $password, $username));
                $_SESSION["name"] = $name;
                $_SESSION["username"] = $username;
                $_SESSION["lastID"] = filesize("../storage/chats.csv");
                $msg = "User Successfully registered";
            }
        } else {
            $msg = "Invalid email address";
        }
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
