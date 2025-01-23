<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "hotel";
include('../layouts/headerAd.php');
$db = new Database();

// Kiểm tra nếu là chỉnh sửa
$isEdit = isset($_GET['id']) && !empty($_GET['id']);
$hotel = null;

if ($isEdit) {
    $hotel_id = intval($_GET['id']);
    $hotels = $db->select("hotels", "id = $hotel_id", 1);
    if (!empty($hotels)) {
        $hotel = $hotels[0];
    } else {
        echo "<div class='alert alert-danger'>Không tìm thấy khách sạn!</div>";
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

<!-- Form Thêm/Chỉnh Sửa Khách Sạn -->
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3"><?php echo $isEdit ? "Chỉnh Sửa Khách Sạn" : "Thêm Khách Sạn Mới"; ?></h4>
    <form action="action/hotelHandle.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3">
            <input type="hidden" name="action" value="<?php echo $isEdit ? "edit" : "add"; ?>">
            <?php if ($isEdit): ?>
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <?php endif; ?>

            <div class="col-md-6">
                <label for="name" class="form-label">Tên Khách Sạn</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="<?php echo $isEdit ? $hotel['name'] : ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="photo" class="form-label">Ảnh Khách Sạn</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*"
                    <?php echo $isEdit ? '' : 'required'; ?>>
                <?php if ($isEdit && !empty($hotel['photo'])): ?>
                <img src="../assets/upload/imgHotels/<?php echo $hotel['photo']; ?>" alt="Hotel Photo" class="mt-2"
                    style="width: 100px; height: 100px;">
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label for="address" class="form-label">Địa Chỉ</label>
                <input type="text" name="address" id="address" class="form-control"
                    value="<?php echo $isEdit ? $hotel['address'] : ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="coordinates" class="form-label">Tọa Độ</label>
                <input type="text" name="coordinates" id="coordinates" class="form-control"
                    value="<?php echo $isEdit ? htmlspecialchars($hotel['coordinates'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                    required>
            </div>


            <div class="col-md-6">
                <label for="hotel_type_id" class="form-label">Loại Khách Sạn</label>
                <select name="hotel_type_id" id="hotel_type_id" class="form-control" required>
                    <?php
                    $hotel_types = $db->select("hotel_types");
                    foreach ($hotel_types as $type) {
                        $selected = $isEdit && $hotel['hotel_type_id'] == $type['id'] ? 'selected' : '';
                        echo "<option value='{$type['id']}' $selected>{$type['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="location_id" class="form-label">Vị Trí</label>
                <select name="location_id" id="location_id" class="form-control" required>
                    <?php
                    $locations = $db->select("locations");
                    foreach ($locations as $location) {
                        $selected = $isEdit && $hotel['location_id'] == $location['id'] ? 'selected' : '';
                        echo "<option value='{$location['id']}' $selected>{$location['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" id="description" class="form-control" rows="4"
                    required><?php echo $isEdit ? $hotel['description'] : ''; ?></textarea>
            </div>

        </div>
        <div class="mt-4">
            <button type="submit"
                class="btn btn-success w-100"><?php echo $isEdit ? "Lưu Thay Đổi" : "Thêm Khách Sạn"; ?></button>
        </div>
    </form>
</div>

<?php
include('../layouts/footerAd.php');
?>