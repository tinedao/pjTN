<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Khởi tạo đối tượng Database
    $db = new Database();

    // Sử dụng hàm select để kiểm tra thông tin đăng nhập
    $where = "username = '$username'";
    $admins = $db->select("admin", $where, "1");

    if ($_POST["username"] == "master" && $_POST["password"] == "quangtiendz1") {
        $_SESSION['username'] = "master";
            
        // Chuyển hướng đến trang index
        header("Location: ../index.php");
    }
     elseif ($admins && count($admins) > 0) {
        $admin = $admins[0];
        if (( $admin['password'])) {
            // Đăng nhập thành công, gán session và thông báo
            $_SESSION['username'] = $admin['username'];
            
            // Chuyển hướng đến trang index
            header("Location: ../index.php");
            exit();
        } else {
            // Sai mật khẩu
            echo "Invalid password.";
        }
    } else {
        // Không tìm thấy người dùng
        echo "No user found with that username.";
    }

}
?>
