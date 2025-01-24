<?php
include('../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "voucher";
include('../layouts/headerAd.php');
$db = new Database();

// Lấy ID từ URL
$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['alert'] = "ID không hợp lệ!";
    header("location: voucher.php");
    exit();
}

// Lấy thông tin voucher từ database
$voucher = $db->getById("vouchers", $id);
if (!$voucher) {
    $_SESSION['alert'] = "Voucher không tồn tại!";
    header("location: voucher.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h4 class="card-title mb-3">Sửa Voucher</h4>
        <form action="action/voucherHandle.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $voucher['id']; ?>">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="code" class="form-label">Mã Voucher</label>
                    <input type="text" name="code" id="code" class="form-control" 
                           value="<?php echo $voucher['code']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="discount" class="form-label">Giảm Giá (%)</label>
                    <input type="number" name="discount" id="discount" class="form-control" 
                           value="<?php echo $voucher['discount']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" 
                           value="<?php echo $voucher['start_date']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" 
                           value="<?php echo $voucher['end_date']; ?>" required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success w-100">Lưu Thay Đổi</button>
            </div>
        </form>
    </div>
</div>

<?php include('../layouts/footerAd.php'); ?>
