<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
$id = $_GET['id'];
$role = "owner";
$page = "typeRoom";
include('../layouts/headerAd.php');
$db = new Database();
$roomType = $db->select("room_types", "id = $id");
?>
<form action="action/editRoomType.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $roomType[0]['id']; ?>">
    <input type="hidden" name="hotel_id" value="<?php echo $roomType[0]['hotel_id']; ?>">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Tên Loại Phòng</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $roomType[0]['name']; ?>" required>
        </div>
        <div class="col-md-6">
            <label for="photo" class="form-label">Ảnh Phòng</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            <img src="../assets/upload/imgTypeRooms/<?php echo $roomType[0]['photo_url']; ?>" alt="Room Photo" width="100">
        </div>
        <div class="col-md-6">
            <label for="bed_count" class="form-label">Số Giường</label>
            <input type="number" name="bed_count" id="bed_count" class="form-control" value="<?php echo $roomType[0]['bed_count']; ?>" required>
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="<?php echo $roomType[0]['price']; ?>" required>
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea name="description" id="description" class="form-control" rows="4" required><?php echo $roomType[0]['description']; ?></textarea>
        </div>
    </div>
    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100">Cập Nhật Loại Phòng</button>
    </div>
</form>

<?php
include('../layouts/footerAd.php');
?>
