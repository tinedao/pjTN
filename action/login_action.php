<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $db = new Database();

    $where = "email = '$email'";
    $users = $db->select("users", $where, "1");

    if ($users && count($users) > 0) {
        $user = $users[0];
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $alert = "Xin chào, " . $user['name'] . "!";
            $err = 0;
            
            header("Location: ../index.php?alert=" . urlencode($alert));
            exit();
        } else {
            $alert = "Invalid password.";
            $err = 1;
        }
    } else {
        $alert = "No user found with that email.";
        $err = 1;
    }

    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=" . $err);
    exit();
}
?>
