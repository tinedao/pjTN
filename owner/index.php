<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
$role = "owner";
$page = "hotelManagement";
include('../layouts/headerAd.php');
$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

// Truy vấn sử dụng view
$hotel = $db->select("view_hotel_details", "owner_id = $owner_id");

?>

<!-- Form Thêm Khách Sạn -->
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3">Thêm Khách Sạn Mới</h4>
    <form action="action/addHotel.php" method="POST" enctype="multipart/form-data">
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
                <label for="photo" class="form-label">Ảnh</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-6">
                <label for="location_id" class="form-label">Địa Điểm</label>
                <select name="location_id" id="location_id" class="form-select" required>
                    <?php
                    // Lấy danh sách địa điểm
                    $locations = $db->select("locations");
                    foreach ($locations as $location) {
                        echo "<option value='" . $location['id'] . "'>" . $location['name'] . "</option>";
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


<!-- Bảng Hiển Thị -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Star</th>
            <th scope="col">Photo</th>
            <th scope="col">Description</th>
            <th scope="col">Location</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($hotel as $h) {
        echo "<tr>";
        echo "<td>" . $h['name'] . "</td>";
        echo "<td>" . $h['address'] . "</td>";
        echo "<td>";
        for ($i = 0; $i < $h['stars']; $i++) {
            echo "<i class='fa fa-star text-warning'></i>"; // Hiển thị sao màu vàng
        }
        echo "</td>";
        echo "<td><img src='../assets/upload/imgHotels/" . $h['photo'] . "' alt='Hotel Image' class='img-thumbnail' style='width: 100px; height: auto;'></td>";
        echo "<td>" . $h['description'] . "</td>";
        echo "<td>" . $h['location_name'] . "</td>"; // Hiển thị tên địa điểm từ view
        echo "<td>" . ($h['status'] == 1 ? "<span class='badge bg-success'>Đã xác thực</span>" : "<span class='badge bg-danger'>Chưa xác thực</span>") . "</td>";
        echo "<td>
                <a href='editHotel.php?id=" . $h['id'] . "&table=hotels' class='btn btn-primary btn-sm'>Edit</a> 
                <a href='action/delete.php?id=" . $h['id'] . "&table=hotels' class='btn btn-danger btn-sm'>Delete</a>
              </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php
include('../layouts/footerAd.php');
?>
