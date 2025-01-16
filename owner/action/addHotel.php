<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$alert = "";
$error = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    // Lấy dữ liệu từ form
    $name = $_POST['name']; // Không cần escape, Prepared Statements sẽ xử lý
    $address = $_POST['address'];
    $description = $_POST['description'];
    $coordinates = $_POST['coordinates'];
    $location_id = intval($_POST['location_id']);
    $owner_id = $db->select("owners", "email = '$_SESSION[email]'", 1)[0]['id'];

    // Xử lý ảnh với hàm uploadImage
    $photo_name = $db->uploadImage($_FILES["photo"], "../../assets/upload/imgHotels/", $alert);

    if ($photo_name) {
        // Chuẩn bị dữ liệu để chèn vào bảng hotels
        $data = [
            "name" => $name,
            "address" => $address,
            "photo" => $photo_name,
            "description" => $description,
            "coordinates" => $coordinates,
            "location_id" => $location_id,
            "owner_id" => $owner_id,
            "status" => 0 // Mặc định là chưa xác thực
        ];

        // Sử dụng hàm insert để thêm dữ liệu
        $result = $db->insert("hotels", $data);

        if ($result) {
            $alert = "Thêm khách sạn thành công!";
        } else {
            $alert = "Có lỗi xảy ra khi thêm khách sạn.";
            $error = 1;
        }
    } else {
        $error = 1; // Đánh dấu lỗi khi upload ảnh thất bại
    }

    // Điều hướng về trang quản lý khách sạn với thông báo
    header("location: ../index.php?alert=" . urlencode($alert) . "&err=$error");
    exit();
}
?>
