<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "rooms";
include('../layouts/headerAd.php');
$db = new Database();
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

$hotel = $db->select("hotels", "owner_id = $owner_id", 1);
$room_types = $db->select("room_types");
$hotel_id = $hotel[0]['id'];
$rooms = $db->select("rooms", "hotel_id = " . $hotel_id);
?>
<style>
.table th, .table td {
    text-align: center;
}

.table img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}
</style>

<?php 
if ($hotel != null && $room_types != null):
?>
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3">Thêm Phòng Mới</h4>
    <form action="action/room_handle.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="action" value="add" hidden>    
        <input type="text" name="hotel_id" value="<?php echo $hotel[0]['id']; ?>" hidden>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Tên Phòng</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="type_id" class="form-label">Loại Phòng</label>
                <select name="type_id" id="type_id" class="form-control" required>
                    <option value="">-- Chọn loại phòng --</option>
                    <?php
                    $room_types = $db->select("room_types");
                    foreach ($room_types as $type):
                    ?>
                        <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Thêm Phòng</button>
        </div>
    </form>
</div>

<div class="row g-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Phòng</th>
                <th>Trạng Thái</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= $room['name'] ?></td>
                <td><?= $room['status'] == 1 ? 'Đang Thuê' : 'Sẵn Sàng' ?></td>
                <td>
                    <a href="action/room_handle.php?action=delete&id=<?= $room['id'] ?>&hotel_id=<?= $hotel[0]['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
else:
?>
<div class="container">
    <h1>BẠN CẦN CÓ KHÁCH SẠN HOẶC LOẠI PHÒNG TRƯỚC</h1>
</div>
<?php
endif;
include('../layouts/footerAd.php');
?>
