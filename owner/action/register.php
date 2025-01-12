<?php
include dirname(__DIR__) . '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Khởi tạo đối tượng Database
    $db = new Database();

    $alert = "";

    $data = array(
        "username" => "'$username'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "email" => "'$email'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "password" => "'$password'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "phone" => "'$phone'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
    );

    // Gọi phương thức insert
    $db->insert("owners", $data);

    // Thiết lập thông báo thành công và chuyển hướng đến trang login
    $alert = "Đăng ký thành công!";
    header("Location: ../login.php?alert=" . urlencode($alert));
    exit();
}
?>
