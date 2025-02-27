<?php
session_start(); 

include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"] ?? '';
    $email = $_POST["email"] ?? '';

    $db = new Database();

    $where = "email = '" . $db->conn->real_escape_string($email) . "'";
    $owners = $db->select("owners", $where, "1");

    if ($owners && count($owners) > 0) {
        $owner = $owners[0];
        if (password_verify($password, $owner['password'])) {
            $status = $owner['status'];
            if ($status == 1) {
            $_SESSION['email'] = $owner['email'];
            $_SESSION['username'] = $owner['username']; 

            $alert = "Login successful.";
            $err = 0;
            header("Location: ../index.php?alert=" . urlencode($alert) . "&err=" . $err);
            exit();
            } else {
                $alert = "Tài khoản của bạn chưa được xác thực hoặc bị khóa hãy liên hệ qua email tine.dao19@gmail.com để được hỗ trợ.";
                $err = 1;
            }
        } else {
            $alert = "Sai mật khẩu.";
            $err = 1;
        }
    } else {
        $alert = "Không tìm thấy email đăng ký.";
        $err = 1;
    }

    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=" . $err);
    exit();
}
?>
