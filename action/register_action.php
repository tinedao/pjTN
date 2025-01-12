<?php
include dirname(__DIR__) . '/config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Khởi tạo đối tượng Database
    $db = new Database();

    // Tải lên ảnh và nhận tên tệp
    $target_dir = dirname(__DIR__) . "/assets/upload/avatars/";
    $alert = "";
    $profile_picture = $db->uploadImage($_FILES["profile_picture"], $target_dir, $alert);

    if ($profile_picture === false) {
        // Nếu có lỗi, chuyển hướng trở lại trang đăng ký với thông báo lỗi
        $err=1;
        header("Location: ../register.php?alert=" . urlencode($alert));
        exit();
    }

    // Lưu tên ảnh (token) vào cơ sở dữ liệu
    $data = array(
        "name" => "'$name'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "email" => "'$email'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "password" => "'$password'", // Chú ý thêm dấu nháy đơn bao quanh chuỗi
        "profile_picture" => "'$profile_picture'" // Lưu tên ảnh (token + phần mở rộng)
    );

    // Gọi phương thức insert
    $db->insert("users", $data);

    // Thiết lập thông báo thành công và chuyển hướng đến trang login
    $alert = "Đăng ký thành công!";
    header("Location: ../login.php?alert=" . urlencode($alert) . "&err=0");
    exit();
}
?>
