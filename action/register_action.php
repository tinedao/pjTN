<?php
include dirname(__DIR__) . '/config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $db = new Database();

    $target_dir = dirname(__DIR__) . "/assets/upload/avatars/";
    $alert = "";
    $profile_picture = $db->uploadImage($_FILES["profile_picture"], $target_dir, $alert);

    if ($profile_picture === false) {
        $err=1;
        header("Location: ../register.php?alert=" . urlencode($alert));
        exit();
    }

    $data = array(
        "name" => "$name", 
        "email" => "$email", 
        "password" => "$password",
        "profile_picture" => "$profile_picture" 
    );

    $db->insert("users", $data);

    $alert = "Đăng ký thành công!";
    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=0");
    exit();
}
?>
