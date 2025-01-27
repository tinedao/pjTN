<?php
session_start();  // Đảm bảo gọi session_start() ở đầu

include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"] ?? '';
    $email = $_POST["email"] ?? '';

    // Khởi tạo đối tượng Database
    $db = new Database();

    // Sử dụng hàm select để kiểm tra thông tin đăng nhập
    $where = "email = '" . $db->conn->real_escape_string($email) . "'";
    $owners = $db->select("owners", $where, "1");

    if ($owners && count($owners) > 0) {
        $owner = $owners[0];
        if (password_verify($password, $owner['password'])) {
            $status = $owner['status'];
            if ($status == 1) {
                // Đăng nhập thành công, gán session và thông báo
            $_SESSION['email'] = $owner['email'];
            $_SESSION['username'] = $owner['username']; // Thêm ID nếu cần

            $alert = "Login successful.";
            $err = 0;
            // Chuyển hướng đến trang index
            header("Location: ../index.php?alert=" . urlencode($alert) . "&err=" . $err);
            exit();
            } else {
                // Tài khoản bị khóa
                $alert = "Tài khoản của bạn chưa được xác thực hoặc bị khóa hãy liên hệ qua email tine.dao19@gmail.com để được hỗ trợ.";
                $err = 1;
            }
        } else {
            // Sai mật khẩu
            $alert = "Sai mật khẩu.";
            $err = 1;
        }
    } else {
        // Không tìm thấy người dùng
        $alert = "Không tìm thấy email đăng ký.";
        $err = 1;
    }

    // Chuyển hướng trở lại trang đăng nhập với thông báo và lỗi
    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=" . $err);
    exit();
}
?>
