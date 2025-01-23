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
    $action = $_POST['action']; // Nhận giá trị action (edit hoặc add)
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $coordinates = $_POST['coordinates'];
    $location_id = intval($_POST['location_id']);
    $hotel_type_id = intval($_POST['hotel_type_id']);
    $owner_id = $db->select("owners", "email = '$_SESSION[email]'", 1)[0]['id'];

    // Xử lý ảnh nếu có upload
    $photo_name = null;
    if (!empty($_FILES["photo"]["name"])) {
        $photo_name = $db->uploadImage($_FILES["photo"], "../../assets/upload/imgHotels/", $alert);
        if (!$photo_name) {
            $error = 1; // Đánh dấu lỗi khi upload ảnh thất bại
        }
    }

    if ($action === 'add') {
        if ($photo_name || empty($_FILES["photo"]["name"])) {
            // Chuẩn bị dữ liệu để chèn vào bảng hotels
            $data = [
                "name" => $name,
                "address" => $address,
                "photo" => $photo_name,
                "description" => $description,
                "hotel_type_id" => $hotel_type_id,
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
        }
    } elseif ($action === 'edit') {
        $hotel_id = intval($_POST['hotel_id']); // Nhận ID khách sạn cần chỉnh sửa

        // Chuẩn bị dữ liệu để cập nhật
        $data = [
            "name" => $name,
            "address" => $address,
            "description" => $description,
            "hotel_type_id" => $hotel_type_id,
            "coordinates" => $coordinates,
            "location_id" => $location_id
        ];
        
        // Nếu có ảnh mới, thêm vào dữ liệu cập nhật
        if ($photo_name) {
            $data["photo"] = $photo_name;
        }

        // Sử dụng hàm update để chỉnh sửa dữ liệu
        $result = $db->update("hotels", $hotel_id, $data);

        if ($result) {
            $alert = "Cập nhật khách sạn thành công!";
        } else {
            $alert = "Có lỗi xảy ra khi cập nhật khách sạn.";
            $error = 1;
        }
    } else {
        $alert = "Hành động không hợp lệ.";
        $error = 1;
    }

    // Điều hướng về trang quản lý khách sạn với thông báo
    header("location: ../index.php?alert=" . urlencode($alert) . "&err=$error");
    exit();
}
?>
