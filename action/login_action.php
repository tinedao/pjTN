<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Khởi tạo đối tượng Database
    $db = new Database();

    // Sử dụng hàm select để kiểm tra thông tin đăng nhập
    $where = "email = '$email'";
    $users = $db->select("users", $where, "1");

    if ($users && count($users) > 0) {
        $user = $users[0];
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công, gán session và thông báo
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $alert = "Xin chào, " . $user['name'] . "!";
            $err = 0;
            
            // Chuyển hướng đến trang index
            header("Location: ../index.php?alert=" . urlencode($alert));
            exit();
        } else {
            // Sai mật khẩu
            $alert = "Invalid password.";
            $err = 1;
        }
    } else {
        // Không tìm thấy người dùng
        $alert = "No user found with that email.";
        $err = 1;
    }

    // Chuyển hướng trở lại trang đăng nhập với thông báo và lỗi
    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=" . $err);
    exit();
}
?>
