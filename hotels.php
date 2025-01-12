<?php 
$hotels = null;
include('config/database.php');
include('layouts/header.php');
include('layouts/navbar.php');
$db = new Database();
include('config/hotel_handle.php');
$condition = "";
$limit = 10;

if (isset($_POST['location']) && !empty($_POST['location'])) {
    $location_id = $_POST['location'];
    $condition = "location_id = $location_id";
}

?>
<div class="container">
<section class="offer mtop" id="services">
    <div class="container">
      <div class="heading">
        <h5>EXCLUSIVE OFFERS </h5>
        <h3>You can get an exclusive offer </h3>
      </div>
    <div class="search-location">
        <form action="" method="post">
            <div class="input-group mb-3">
                <select id="inputGroupSelect01" name="location" onchange="this.form.submit()" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <option value="">Chọn huyện</option>
                    <?php
                    $locations = $db->select('locations'); 
                    foreach ($locations as $location) {
                        $selected = "";
                        if (isset($_POST['location']) && $_POST['location'] == $location['id']) {
                            $selected = "selected";
                            
                        }
                        echo "<option value='{$location['id']}' $selected style='padding: 10px;'>" . htmlspecialchars($location['name']) . "</option>";
                        

                    }
                    ?>
                </select>
            </div>
        </form>
        <h1>
        </h1>
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

include('layouts/slideBottom.php');
include('layouts/footer.php');
?>

