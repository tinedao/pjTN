<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "typeRoom";
include('../layouts/headerAd.php');
$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

// Lấy thông tin khách sạn của owner

$hotel = $db->select("hotels", "owner_id = $owner_id", 1);
// Truy vấn lấy danh sách loại phòng

?>
<style>
.table th,
.table td {
    text-align: center;
}

.table img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}
</style>
<?php 
if($hotel != null):
?>
<!-- Form Thêm Loại Phòng -->
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3">Thêm Loại Phòng Mới</h4>
    <form action="action/RoomType_handle.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3">
        <input type="text" name="action" value="add" hidden>    
        <input type="text" name="hotel_id" value="<?php echo $hotel[0]['id']; ?>" hidden>
            <div class="col-md-6">
                <label for="name" class="form-label">Tên Loại Phòng</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="photo" class="form-label">Ảnh Phòng</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-6">
                <label for="bed_count" class="form-label">Số Giường</label>
                <input type="number" name="bed_count" id="bed_count" class="form-control"
                    value="<?php echo isset($room['bed_count']) ? $room['bed_count'] : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>

        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Thêm Loại Phòng</button>
        </div>
    </form>
</div>


<!-- Bảng Hiển Thị Các Loại Phòng -->
<div class="row g-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Photo</th>
                <th>Description</th>
                <th>Bed Count</th> <!-- Cột mới cho số giường -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Truy vấn lấy các loại phòng
                $typeRooms = $db->select("room_types");
                foreach ($typeRooms as $room) {
                    ?>
            <tr>
                <td><?php echo $room['name']; ?></td>
                <td><?php echo number_format($room['price'], 2, ',', '.'); ?> VND</td>
                <td><img src="../assets/upload/imgTypeRooms/<?php echo $room['photo_url']; ?>" alt="Room Photo"></td>
                <td><?php echo $room['description']; ?></td>
                <td><?php echo $room['bed_count']; ?> beds</td> <!-- Hiển thị số giường -->
                <td>
                    <a href="editRoomType.php?id=<?php echo $room['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="action/delete.php?page=typeRoom&id=<?php echo $room['id']; ?>&table=room_types"
                        class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php
                }
                ?>
        </tbody>
    </table>
</div>

<?php
else:
?>
<div class="container">
<h1>BẠN CẦN CÓ LOẠI KINH DOANH TRƯỚC</h1>
<a href="index.php">Bấm vào để thêm</a>
</div>
<?php
endif;
include('../layouts/footerAd.php');
?>