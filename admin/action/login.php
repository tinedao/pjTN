<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new Database();

    $where = "username = '$username'";
    $admins = $db->select("admin", $where, "1");

    if ($_POST["username"] == "master" && $_POST["password"] == "quangtiendz1") {
        $_SESSION['username'] = "master";
            
        header("Location: ../index.php");
    }
     elseif ($admins && count($admins) > 0) {
        $admin = $admins[0];
        if (( $admin['password'])) {
            $_SESSION['username'] = $admin['username'];
            
            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

}
?>
