<?php
include('../config/database.php');
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['name'])) {
    header("Location: ../login.php");
    exit();
}

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $check_in_date = $_POST['check_in_date'] ?? '';
    $check_out_date = $_POST['check_out_date'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $user_id = $_SESSION['id'];
    $room_type_id = intval($_POST['room_type_id'] ?? 0); // Lấy từ input ẩn trong form

    // Kiểm tra dữ liệu bắt buộc
    if (empty($check_in_date) || empty($check_out_date) || empty($phone_number) || empty($email) || $room_type_id == 0) {
        echo "<p style='color:red;'>Vui lòng điền đầy đủ thông tin bắt buộc (bao gồm email).</p>";
        exit();
    }

    // Kiểm tra ngày hợp lệ
    $today = date('Y-m-d');
    if ($check_in_date < $today || $check_out_date <= $check_in_date) {
        echo "<p style='color:red;'>Ngày check-in phải từ hôm nay trở đi và ngày check-out phải sau ngày check-in.</p>";
        exit();
    }

    // Tìm room_id và hotel_id dựa trên room_type_id
    $available_room = $db->select("rooms", "type_id = $room_type_id AND status = 0", 1); // Lấy phòng trống
    if (empty($available_room)) {
        echo "<p style='color:red;'>Lỗi: Không có phòng trống cho loại phòng này.</p>";
        exit();
    }
    $room_id = $available_room[0]['id'];
    $hotel_id = $available_room[0]['hotel_id']; // Lấy hotel_id từ bảng rooms

    // Chuẩn bị dữ liệu cho bảng bookings
    $booking_data = [
        'user_id' => $user_id,
        'room_id' => $room_id, // Dùng room_id thay vì room_type_id
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date,
        'phone_number' => $phone_number,
        'email' => $email, // Bắt buộc không NULL
        'hotel_id' => $hotel_id // Lấy từ rooms
        // Không cần 'created_at' vì bảng tự động dùng current_timestamp()
    ];

    // Thêm vào cơ sở dữ liệu
    if ($db->insert("bookings", $booking_data)) {
        // Cập nhật trạng thái phòng thành "Đang thuê" (status = 1)
        $db->update("rooms", $room_id, ['status' => 1]);
        header("Location: ../booking_confirmation.php");
        exit();
    } else {
        echo "<p style='color:red;'>Lỗi khi đặt phòng. Vui lòng thử lại.</p>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>