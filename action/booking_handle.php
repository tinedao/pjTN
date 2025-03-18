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
    $room_type_id = intval($_POST['room_type_id'] ?? 0);
    $totalPrice = floatval($_POST['totalPrice'] ?? 0);

    if (empty($check_in_date) || empty($check_out_date) || empty($phone_number) || $room_type_id == 0) {
        $alert = "Vui lòng điền đầy đủ thông tin.";
        $err = 1;
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&alert=" . urlencode($alert) . "&err=" . $err);
        exit();
    }

    $today = date('Y-m-d');
    if ($check_in_date < $today || $check_out_date <= $check_in_date) {
        $alert = "Ngày check-in phải sau ngày hôm nay và trước ngày check-out.";
        $err = 1;
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&alert=" . urlencode($alert) . "&err=" . $err);
        exit();
    }

    $sql_available_rooms = "
        SELECT r.id, r.hotel_id
        FROM rooms r
        WHERE r.type_id = ?
          AND NOT EXISTS (
              SELECT 1
              FROM booking_info bi
              WHERE bi.room_id = r.id
                AND bi.check_in_date < ?
                AND bi.check_out_date > ?
                AND bi.status = 0
          )
    ";

    $stmt = $db->conn->prepare($sql_available_rooms);
    if (!$stmt) {
        $alert = "Lỗi chuẩn bị truy vấn.";
        $err = 1;
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&alert=" . urlencode($alert) . "&err=" . $err);
        exit();
    }

    $stmt->bind_param("iss", $room_type_id, $check_out_date, $check_in_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $available_rooms = [];
    while ($row = $result->fetch_assoc()) {
        $available_rooms[] = $row;
    }
    $available_room_count = count($available_rooms);

    if ($available_room_count == 0) {
        $alert = "Không còn phòng trống cho loại phòng này trong khoảng thời gian đã chọn.";
        $err = 1;
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&alert=" . urlencode($alert) . "&err=" . $err);
        exit();
    }

    $alert = "Còn $available_room_count phòng trống cho loại phòng này.";

    $random_room = $available_rooms[array_rand($available_rooms)];
    $room_id = $random_room['id'];
    $hotel_id = $random_room['hotel_id'];

    $booking_data = [
        'user_id' => $user_id,
        'room_id' => $room_id,
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date,
        'phone_number' => $phone_number,
        'email' => $email,
        'hotel_id' => $hotel_id,
        'totalPrice' => $totalPrice
    ];

    if ($db->insert("bookings", $booking_data)) {
        $DetailBooking = $db->select("booking_info", "user_id = $user_id ORDER BY created_at DESC", 1)[0];
        $backURL="../booking.php?alert=" . urlencode($alert);
        $userMail = $email;
        $subjectMail = "Booking Room Success";

        $bodyMail = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
        <h2 style='color: #333; text-align: center;'>Thông Tin Đặt Phòng</h2>
        <div style='border:1px solid rgba(0,0,0,0.2); border-radius: 5px; padding: 10px; margin: 10px; display: flex; justify-content: center; align-items: center;'>
            <div style='padding: 2px 16px; width: 80%;'>
                <h4 style='font-weight: bold;margin: 10px 0;'>Tên người đặt: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['user_name']) ."</span></h4>
                <p style='font-weight: bold;margin: 5px 0;'>Email: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['user_email']) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Tên phòng: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['room_name']) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Giá: <span style='font-weight: normal;'>". number_format($DetailBooking['totalPrice'], 0, ',', '.') ." VND</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Check-in: <span style='font-weight: normal;'>". date('d/m/Y', strtotime($DetailBooking['check_in_date'])) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Check-out: <span style='font-weight: normal;'>". date('d/m/Y', strtotime($DetailBooking['check_out_date'])) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Số điện thoại: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['phone_number']) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Ngày đặt: <span style='font-weight: normal;'>". date('d/m/Y H:i:s', strtotime($DetailBooking['created_at'])) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Tên khách sạn: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['hotel_name']) ."</span></p>
                <p style='font-weight: bold;margin: 5px 0;'>Địa chỉ: <span style='font-weight: normal;'>". htmlspecialchars($DetailBooking['hotel_address']) ."</span></p>
            </div>
        </div>
    </div>";
        require "../sendmail.php";
        header("Location: ../booking.php");
        exit();
    } else {
        $alert = "Lỗi khi thêm đơn đặt phòng. Vui lòng thử lại.";
        $err = 1;
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&alert=" . urlencode($alert) . "&err=" . $err);
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>