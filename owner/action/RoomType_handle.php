<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit();
}

$db = new Database();

// Lấy thông tin từ form
$hotel_id = $_POST['hotel_id'];
$action = $_POST['action'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$bed_count = $_POST['bed_count'];

// Xử lý ảnh
$photo_url = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo_url = $db->uploadImage($_FILES['photo'], "../../assets/upload/imgTypeRooms/", $alert);
}

// Kiểm tra hành động (add hoặc edit)
if ($action === 'add') {
    // Thêm loại phòng
    if ($photo_url !== "") {
        $data = [
            'hotel_id' => $hotel_id,
            'name' => $name,
            'price' => $price,
            'photo_url' => $photo_url,
            'description' => $description,
            'bed_count' => $bed_count
        ];

        $insert_room_type = $db->insert("room_types", $data);

        if ($insert_room_type) {
            $alert = "Thêm loại phòng thành công!";
            header("location: ../typeRoom.php?alert=" . urlencode($alert));
        } else {
            $alert = "Có lỗi xảy ra khi thêm loại phòng.";
            header("location: ../typeRoom.php?err=1&alert=" . urlencode($alert));
        }
    }
} elseif ($action === 'edit') {
    // Sửa loại phòng
    $room_type_id = $_POST['room_id']; // Lấy ID loại phòng cần sửa từ form (đảm bảo form có trường này)

    // Dữ liệu để cập nhật
    $data = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'bed_count' => $bed_count
    ];

    // Chỉ cập nhật ảnh nếu có ảnh mới
    if ($photo_url !== "") {
        $data['photo_url'] = $photo_url;
    }

    // Cập nhật loại phòng
    $update_room_type = $db->update("room_types", $room_type_id, $data); // Truyền $room_type_id vào hàm update

    if ($update_room_type) {
        $alert = "Cập nhật loại phòng thành công!";
        header("location: ../typeRoom.php?alert=" . urlencode($alert));
    } else {
        $alert = "Có lỗi xảy ra khi cập nhật loại phòng.";
        header("location: ../typeRoom.php?err=1&alert=" . urlencode($alert));
    }
} else {
    $alert = "Hành động không hợp lệ!";
    header("location: ../typeRoom.php?err=1&alert=" . urlencode($alert));
}
?>
