<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit();
}

$db = new Database();

// Lấy thông tin khách sạn của owner
$hotel_id = $_POST['hotel_id']; // Cập nhật từ form gửi lên

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$bed_count = $_POST['bed_count']; // Số giường

// Xử lý ảnh
$photo_url = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo_url = $db->uploadImage($_FILES['photo'], "../assets/upload/imgTypeRooms/", $alert);
}

// Thêm loại phòng vào bảng room_types
if ($photo_url !== "") {
    $data = [
        'hotel_id' => $hotel_id,
        'name' => $name,
        'price' => $price,
        'photo_url' => $photo_url,
        'description' => $description,
        'bed_count' => $bed_count  // Thêm số giường
    ];

    $insert_room_type = $db->insert("room_types", $data);

    if ($insert_room_type) {
        echo "Thêm loại phòng thành công!";
    } else {
        echo "Thêm loại phòng thất bại!";
    }
}
?>
