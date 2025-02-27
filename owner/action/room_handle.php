<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

$hotel = $db->select("hotels", "owner_id = $owner_id", 1);
$hotel_id = isset($hotel[0]['id']) ? $hotel[0]['id'] : null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';
    $name = $_POST['name'] ?? '';
    $type_id = $_POST['type_id'] ?? '';
    $hotel_id = $_POST['hotel_id'] ?? '';

    if ($action === 'add' && $hotel_id !== null) {
        $room_data = [
            'name' => $name,
            'type_id' => $type_id,
            'hotel_id' => $hotel_id,
        ];

        if ($db->insert("rooms", $room_data)) {
            header("Location: ../roomMan.php");
            exit();
        } else {
            echo "<p style='color:red;'>Lỗi khi thêm phòng. Vui lòng thử lại.</p>";
        }
    }

    if ($action === 'edit' && isset($_POST['room_id'])) {
        $room_id = $_POST['room_id'];

        $photo = $_FILES['photo'] ?? null;
        if ($photo) {
            $alert = "";
            $photo_url = $db->uploadImage($photo, '../assets/upload/imgRooms/', $alert);
            if (!$photo_url) {
                echo "<p style='color:red;'>$alert</p>";
                exit();
            }
        }

        $room_data = [
            'name' => $name,
            'type_id' => $type_id,
            'hotel_id' => $hotel_id
        ];
        
        if ($photo) {
            $room_data['photo'] = $photo_url; 
        }

        if ($db->update("rooms", $room_id, $room_data)) {
            header("Location: ../roomMan.php");
            exit();
        } else {
            echo "<p style='color:red;'>Lỗi khi cập nhật phòng. Vui lòng thử lại.</p>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $room_id = $_GET['id'] ?? null;
    $hotel_id_from_get = $_GET['hotel_id'] ?? null;

    if ($room_id !== null && $hotel_id_from_get !== null && $hotel_id_from_get == $hotel_id) {
        $db->delete("rooms", $room_id);
        header("Location: ../roomMan.php");
        exit();
    } else {
        echo "<p style='color:red;'>Lỗi: Không thể xóa phòng. ID không hợp lệ hoặc không thuộc khách sạn này.</p>";
    }
}
?>