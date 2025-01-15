<?php
$index = true;
$condition = "status = 1";
$limit = 10;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location'] ?? null;
    $arrival_date = $_POST['arrival_date'] ?? null;
    $departure_date = $_POST['departure_date'] ?? null;
    $adults = $_POST['adults'] ?? 1; // Giá trị mặc định là 1 nếu không có dữ liệu

    // Truy vấn để tìm các khách sạn có phòng trống trong khoảng thời gian đã chọn
    $query = "SELECT hotels.*, rooms.name AS room_name, rooms.price, locations.name AS location_name
              FROM hotels
              INNER JOIN rooms ON hotels.id = rooms.hotel_id
              INNER JOIN locations ON hotels.location_id = locations.id
              WHERE hotels.location_id = ? AND rooms.max_guests >= ? AND rooms.id NOT IN (
                  SELECT room_id FROM bookings
                  WHERE (check_in_date BETWEEN ? AND ?) OR (check_out_date BETWEEN ? AND ?)
              )
              LIMIT $limit";

    $params = [$location_id, $adults, $arrival_date, $departure_date, $arrival_date, $departure_date];
    
    // Thực thi truy vấn trực tiếp
    $stmt = $db->conn->prepare($query);
    if ($stmt) {
        // Gắn các tham số vào câu truy vấn
        $stmt->bind_param("iissss", $location_id, $adults, $arrival_date, $departure_date, $arrival_date, $departure_date);

        // Thực thi truy vấn
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->get_result();
        if ($result) {
            $hotels = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $hotels = [];
        }

        // Đóng câu lệnh chuẩn bị
        $stmt->close();
    } else {
        $hotels = [];
    }
} else {
    $hotels = $db->select('hotels', $condition, $limit);
}
$condition = "";
$limit = 10;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['location']) && !empty($_POST['location'])) {
    $location_id = $_POST['location'];
    $condition = "location_id = $location_id AND status = 1";


    // Truy vấn cơ sở dữ liệu để lấy danh sách khách sạn theo location_id
    $hotels = $db->select('hotels', $condition, $limit);
    $toado = $db->select('locations', "id = $location_id");

if (!empty($toado)) {
    // Giả sử $toado là một mảng với ít nhất một phần tử
    $toado_value = $toado[0]['toado']; // Lấy giá trị cần thiết từ mảng
} else {
    $toado_value = 'Không tìm thấy dữ liệu'; // Xử lý khi không có dữ liệu
}


}else{
    $hotels = $db->select('hotels', "status = 1", $limit);
}
