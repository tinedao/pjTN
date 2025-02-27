<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "hotelManagement";
$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

$hotel = $db->select("view_hotel_details", "owner_id = $owner_id", 1);
$status = $hotel[0]['status'];
include('../layouts/headerAd.php');

?>
<style>
    .row .col-md-6 {
        margin-bottom: 1rem;
    }
    .form-select{
        padding: 5px;
        border-radius: 15px;
    }

    .card img{
        height: 350px !important;
    }
    .card-footer a{
        width: 40%;
        padding: 5px;
    }
    .map iframe{
        width: 100%;
        height: 500px;
    }
</style>
<?php
if($hotel == null){
    ?>
    <div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3">Thêm Khách Sạn Mới</h4>
    <form action="action/addHotel.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="hotel_id" value="<?php echo $hotel_id; ?>" hidden>
        <input type="hidden" name="action" value="add">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Tên Khách Sạn</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Địa Chỉ</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Tọa độ google</label>
                <input type="text" placeholder="vào google map rồi chọn địa chỉ khách sạn, bấm chia sẻ -> nhúng bản đồ và sao chép HTML" name="coordinates" id="address" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="photo" class="form-label">Ảnh</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-6">
                <label for="location_id" class="form-label w-100">Địa Điểm</label>
                <select name="location_id" id="location_id" class="form-select" required>
                    <?php
                    $locations = $db->select("locations");
                    foreach ($locations as $location) {
                        echo "<option value='" . $location['id'] . "'>" . $location['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="hotel_type_id" class="form-label w-100">Loại Khách Sạn</label>
                <select name="hotel_type_id" id="hotel_type_id" class="form-select" required>
                    <?php
                    $hotelTypes = $db->select("hotel_types");
                    foreach ($hotelTypes as $hotelType) {
                        echo "<option value='" . $hotelType['id'] . "'>" . $hotelType['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Thêm Khách Sạn</button>
        </div>
    </form>
</div>
    <?php
}
?>

<div class="container">
<div class="row g-4">
    <?php
    foreach ($hotel as $h) {
        ?>
        <div class="w-75">
            <div class="card shadow-sm h-100">
                <img src="../assets/upload/imgHotels/<?php echo $h['photo']; ?>" class="card-img-top" alt="Hotel Image" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><b>Name:</b>  <?php echo $h['name']; ?></h5>
                    <p class="card-text mb-1"><strong>Address:</strong> <?php echo $h['address']; ?></p>
                    <p class="card-text mb-1"><strong>Location:</strong> <?php echo $h['location_name']; ?></p>
                    <p class="card-text">
                        <strong>Star Rating:</strong>
                        <?php
                        for ($i = 0; $i < $h['stars']; $i++) {
                            echo "<i class='fa fa-star text-warning'></i>";
                        }
                        ?>
                    </p>
                    <p class="card-text mb-2"><strong>Description:</strong> <?php echo $h['description']; ?></p>
                    <p class="card-text">
                        <strong>Status:</strong> 
                        <?php echo $h['status'] == 1 
                            ? "<span class='badge bg-success'>Đã xác thực</span>" 
                            : ($h['status'] == 2 
                                ? "<span class='badge bg-warning'>Bị cấm</span> <br>     <span class='text-warning'>Hãy liên hệ với quản trị viên để được gỡ cấm</span>" 
                                : "<span class='badge bg-danger'>Chưa xác thực</span> <br>     <span class='text-danger'>Hãy liên hệ với quản trị viên để được xác thực</span>"); ?>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="editHotel.php?id=<?php echo $h['id']; ?>&table=hotels" class="btn btn-primary btn-sm">Edit</a>
                    <a href="action/delete.php?page=index&id=<?php echo $h['id']; ?>&table=hotels" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
        
        <?php
        
    }
    ?>
</div>
</div>


<div class="map">
    <?php
if (isset($h)) {
    echo $h['coordinates'] ;
}
    ?>
</div>

<?php

include('../layouts/footerAd.php');
?>
