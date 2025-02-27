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


$isEdit = isset($_GET['id']) && !empty($_GET['id']);
$room = null;

if ($isEdit) {
    $room_id = $_GET['id'];
    $rooms = $db->select("room_types", "id = $room_id", 1);
    if (!empty($rooms)) {
        $room = $rooms[0];
    } else {
        echo "<div class='alert alert-danger'>Không tìm thấy loại phòng!</div>";
        $isEdit = false;
    }
}
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
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3"><?php echo $isEdit ? "Chỉnh Sửa Loại Phòng" : "Thêm Loại Phòng Mới"; ?></h4>
    <form action="action/RoomType_handle.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3">
            <input type="hidden" name="action" value="<?php echo $isEdit ? "edit" : "add"; ?>">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel[0]['id']; ?>">
            <?php if ($isEdit): ?>
            <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
            <?php endif; ?>
            <div class="col-md-6">
                <label for="name" class="form-label">Tên Loại Phòng</label>
                <input type="text" name="name" id="name" class="form-control" 
                    value="<?php echo $isEdit ? $room['name'] : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="photo" class="form-label">Ảnh Phòng</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" <?php echo $isEdit ? '' : 'required'; ?>>
                <?php if ($isEdit && !empty($room['photo_url'])): ?>
                <img src="../assets/upload/imgTypeRooms/<?php echo $room['photo_url']; ?>" alt="Room Photo" class="mt-2" style="width: 100px; height: 100px;">
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label for="bed_count" class="form-label">Số Giường</label>
                <input type="number" name="bed_count" id="bed_count" class="form-control" 
                    value="<?php echo $isEdit ? $room['bed_count'] : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price" id="price" class="form-control" 
                    value="<?php echo $isEdit ? $room['price'] : ''; ?>" required>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" id="description" class="form-control" rows="4" required><?php echo $isEdit ? $room['description'] : ''; ?></textarea>
            </div>

        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100"><?php echo $isEdit ? "Lưu Thay Đổi" : "Thêm Loại Phòng"; ?></button>
        </div>
    </form>
</div>

<?php
include('../layouts/footerAd.php');
?>
