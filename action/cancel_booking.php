<?php
include('../config/database.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: ../login.php");
    exit();
}

$db = new Database();
$user_id = $_SESSION['id'];
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

$booking = $db->select("booking_info", "booking_id = $booking_id AND user_id = $user_id AND status = 0", 1);

if (!empty($booking)) {
    $update_booking = $db->update("bookings", $booking_id, ['status' => 1]);

    if ($update_booking) {
        $room_id = $booking[0]['room_id'];
        $db->update("rooms", $room_id, ['status' => 0]);

        header("Location: ../booking.php?&alert=" . urlencode("Đặt phòng đã được hủy thành công!"));
        exit();
    } else {
        header("Location: ../booking.php?&err=1&alert=" . urlencode("Lỗi khi hủy đặt phòng. Vui lòng thử lại."));
        exit();
    }
} else {
    header("Location: ../booking.php?&err=1&alert=" . urlencode("Không thể hủy đặt phòng này."));
    exit();
}
?>