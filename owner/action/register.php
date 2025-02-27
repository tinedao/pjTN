<?php
include dirname(__DIR__) . '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $db = new Database();

    $alert = "";

    $data = array(
        "username" => "'$username'", 
        "email" => "'$email'", 
        "password" => "'$password'", 
        "phone" => "'$phone'", 
    );

    $db->insert("owners", $data);

    $alert = "Đăng ký thành công!";
    header("Location: ../login.php?alert=" . urlencode($alert));
    exit();
}
?>
