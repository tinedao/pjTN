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
        
        <table border='1'>
            <thead>
                <tr>
                    <th>Tên người đặt</th>
                    <th>Email</th>
                    <th>Tên phòng</th>
                    <th>Giá</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt</th>
                    <th>Tên khách sạn</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$DetailBooking['user_name']."</td>
                    <td>".$DetailBooking['user_email']."</td>
                    <td>".$DetailBooking['room_name']."</td>
                    <td class='price'>".number_format($DetailBooking['totalPrice'], 0, ',', '.') ." VND</td>
                    <td class='date'>". date('d/m/Y', strtotime($DetailBooking['check_in_date'])) ."</td>
                    <td class='date'>". date('d/m/Y', strtotime($DetailBooking['check_out_date']))."</td>
                    <td>". htmlspecialchars($DetailBooking['phone_number']) ."</td>
                    <td class='date'>". date('d/m/Y H:i:s', strtotime($DetailBooking['created_at'])) ."</td>
                    <td>". htmlspecialchars($DetailBooking['hotel_name']) ."</td>
                    <td>". htmlspecialchars($DetailBooking['hotel_address']) ."</td>
                </tr>
            </tbody>
        </table>";
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