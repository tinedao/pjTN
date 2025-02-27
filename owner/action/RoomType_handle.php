<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit();
}

$db = new Database();

$hotel_id = $_POST['hotel_id'];
$action = $_POST['action'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$bed_count = $_POST['bed_count'];

$photo_url = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo_url = $db->uploadImage($_FILES['photo'], "../../assets/upload/imgTypeRooms/", $alert);
}

if ($action === 'add') {
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
    $room_type_id = $_POST['room_id'];

    $data = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'bed_count' => $bed_count
    ];

    if ($photo_url !== "") {
        $data['photo_url'] = $photo_url;
    }

    $update_room_type = $db->update("room_types", $room_type_id, $data);

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
