<?php include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

// Lấy thông tin khách sạn của owner
$hotel = $db->select("hotels", "owner_id = $owner_id", 1);
$hotel_id = isset($hotel[0]['id']) ? $hotel[0]['id'] : null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';
    $name = $_POST['name'] ?? '';
    $type_id = $_POST['type_id'] ?? '';
    $hotel_id = $_POST['hotel_id'] ?? '';

    // Kiểm tra nếu hành động là thêm phòng
    if ($action === 'add' && $hotel_id !== null) {
        // Chuẩn bị dữ liệu để thêm
        $room_data = [
            'name' => $name,
            'type_id' => $type_id,
            'hotel_id' => $hotel_id,
        ];

        // Thêm phòng vào cơ sở dữ liệu
        if ($db->insert("rooms", $room_data)) {
            header("Location: rooms.php");
            exit();
        } else {
            echo "<p style='color:red;'>Lỗi khi thêm phòng. Vui lòng thử lại.</p>";
        }
    }

    // Nếu hành động là cập nhật phòng
    if ($action === 'edit' && isset($_POST['room_id'])) {
        $room_id = $_POST['room_id'];

        // Kiểm tra ảnh nếu có
        $photo = $_FILES['photo'] ?? null;
        if ($photo) {
            $alert = "";
            $photo_url = $db->uploadImage($photo, '../assets/upload/imgRooms/', $alert);
            if (!$photo_url) {
                echo "<p style='color:red;'>$alert</p>";
                exit();
            }
        }

        // Chuẩn bị dữ liệu để cập nhật
        $room_data = [
            'name' => $name,
            'type_id' => $type_id,
            'hotel_id' => $hotel_id
        ];
        
        // Nếu có ảnh mới, thêm vào dữ liệu cập nhật
        if ($photo) {
            $room_data['photo'] = $photo_url; // Thêm đường dẫn ảnh vào dữ liệu
        }

        // Cập nhật phòng
        if ($db->update("rooms", $room_id, $room_data)) {
            header("Location: ../rooms.php");
            exit();
        } else {
            echo "<p style='color:red;'>Lỗi khi cập nhật phòng. Vui lòng thử lại.</p>";
        }
    }
}
