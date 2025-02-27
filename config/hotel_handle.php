<?php
$index = true;
$condition = "status = 1";
$limit = 10;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location'] ?? null;
    $arrival_date = $_POST['arrival_date'] ?? null;
    $departure_date = $_POST['departure_date'] ?? null;

    if ($location_id && $arrival_date && $departure_date) {
        $query = "SELECT hotels.*, rooms.name AS room_name, locations.name AS location_name
                  FROM hotels
                  INNER JOIN rooms ON hotels.id = rooms.hotel_id
                  INNER JOIN locations ON hotels.location_id = locations.id
                  WHERE hotels.location_id = ? AND rooms.status = 1 AND rooms.id NOT IN (
                      SELECT room_id FROM bookings
                      WHERE (check_in_date BETWEEN ? AND ?) OR (check_out_date BETWEEN ? AND ?)
                  )
                  LIMIT $limit";

        $stmt = $db->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("issss", $location_id, $arrival_date, $departure_date, $arrival_date, $departure_date);

            $stmt->execute();

            $result = $stmt->get_result();
            if ($result) {
                $hotels = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $hotels = [];
            }

            $stmt->close();
        } else {
            $hotels = [];
        }
    } else {
        $hotels = [];
    }
} else {
    $hotels = $db->select('hotels', $condition, $limit);
}

if (isset($_POST['location']) && !empty($_POST['location'])) {
    $location_id = $_POST['location'];
    $condition = "location_id = $location_id AND status = 1";

    $hotels = $db->select('hotels', $condition, $limit);

    $toado = $db->select('locations', "id = $location_id");

    if (!empty($toado)) {
        $toado_value = $toado[0]['toado']; 
    } else {
        $toado_value = 'Không tìm thấy dữ liệu'; 
    }
} else {
    $hotels = $db->select('hotels', "status = 1", $limit);
}
?>
