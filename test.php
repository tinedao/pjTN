<?php
include('config/database.php');
include('layouts/header.php');
include('layouts/navbar.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $adults = $_POST['adults'];

    // Truy vấn để tìm các khách sạn có phòng trống trong khoảng thời gian đã chọn
    $query = "SELECT hotels.*, rooms.name AS room_name, rooms.price
              FROM hotels
              INNER JOIN rooms ON hotels.id = rooms.hotel_id
              WHERE hotels.location_id = ? AND rooms.max_guests >= ? AND rooms.id NOT IN (
                  SELECT room_id FROM bookings
                  WHERE (check_in_date BETWEEN ? AND ?) OR (check_out_date BETWEEN ? AND ?)
              )";

    $params = [$location_id, $adults, $arrival_date, $departure_date, $arrival_date, $departure_date];
    $hotels = $db->select($query, $params);
} else {
    $hotels = [];
}
?>

<div class="container">
<section class="offer mtop" id="services">
    <div class="container">
      <div class="heading">
        <h5>EXCLUSIVE OFFERS </h5>
        <h3>You can get an exclusive offer </h3>
      </div>
      <div class="content grid2 mtop">
        <?php
        if ($hotels) {
            foreach ($hotels as $hotel) {
                echo "<a href='rooms.php?hotel_id=".$hotel['id']."'>";
                echo "<div class='box flex'>";
                echo "<div class='left imgHotels'>";
                echo "<img src='assets/upload/imgHotels/".$hotel['photo']."' alt=''>";
                echo "</div>";
                echo "<div class='right'>";
                echo "<h4>".$hotel['name']."</h4>";
                echo "<div class='rate flex'>";
                echo "<small style='color: black; margin-top: 10px;'><address>".$hotel['address']."</address></small>";
                echo "</div>";
                echo "<div class='rate flex'>";
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $hotel['stars']) {
                        echo "<i class='fas fa-star'></i>";
                    } else {
                        echo "<i class='far fa-star'></i>";
                    }
                }
                echo "</div>";
                echo "<p>".$hotel['description']."</p>";
                echo "<h5>From ".number_format($hotel['starting_price'])." VND/night</h5>";
                echo "<button class='flex1'>";
                echo "<span>Book</span>";
                echo "<i class='fas fa-arrow-circle-right'></i>";
                echo "</button>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "<p>No hotels found.</p>";
        }
        ?>
      </div>
    </div>
  </section>
</div>
<?php
include('layouts/footer.php');
?>
