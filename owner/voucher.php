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
$owners = $db->select("owners", "email = '$_SESSION[email]'", 1);
$owner = $owners[0];
$owner_id = $owner['id'];

$hotel = $db->select("hotels", "owner_id = $owner_id", 1);

?>
<style>
.table th,
.table td {
    text-align: center;
}
</style>

<?php if ($hotel != null): ?>
<div class="card shadow p-4 mb-4">
    <h4 class="card-title mb-3">Thêm Voucher Mới</h4>
    <form action="action/voucherHandle.php" method="POST">
        <div class="row g-3">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel[0]['id']; ?>">
            <div class="col-md-6">
                <label for="code" class="form-label">Mã Voucher</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="discount" class="form-label">Phần Trăm Giảm Giá</label>
                <input type="number" name="discount" id="discount" class="form-control" step="0.01" required min="1" max="100">
            </div>
            <div class="col-md-6">
                <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100">Thêm Voucher</button>
        </div>
    </form>
</div>

<div class="row g-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Voucher</th>
                <th>Phần Trăm Giảm Giá</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Trạng Thái</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $vouchers = $db->select("vouchers", "hotel_id = " . $hotel[0]['id']);
            foreach ($vouchers as $voucher) {
                ?>
                <tr>
                    <td><?php echo $voucher['code']; ?></td>
                    <td><?php echo number_format($voucher['discount']); ?>%</td>
                    <td><?php echo $voucher['start_date']; ?></td>
                    <td><?php echo $voucher['end_date']; ?></td>
                    <td><?php echo $voucher['status'] == 1 ? 'Kích Hoạt' : 'Không Kích Hoạt'; ?></td>
                    <td>
                        <a href="editVoucher.php?id=<?php echo $voucher['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                        <a href="action/delete.php?page=voucher&id=<?php echo $voucher['id']; ?>&table=vouchers"
                            class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php else: ?>
<div class="container">
    <h1>Bạn cần tạo khách sạn trước</h1>
    <a href="index.php" class="btn btn-primary">Tạo khách sạn</a>
</div>
<?php endif; ?>

<?php include('../layouts/footerAd.php'); ?>
