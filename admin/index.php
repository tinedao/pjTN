<?php
$page = "hotelManagement";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('../config/database.php');
$db = new Database();
include('../layouts/headerAd.php');

$currentStatus = isset($_GET['status']) && in_array($_GET['status'], ['1', '0', '2']) ? $_GET['status'] : '1';

$hotel = $db->select("hotels", "status = $currentStatus");
?>

<div class="mt-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $currentStatus == '1' ? 'active' : ''; ?>" href="?status=1">Đã xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $currentStatus == '0' ? 'active' : ''; ?>" href="?status=0">Chưa xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $currentStatus == '2' ? 'active' : ''; ?>" href="?status=2">Bị cấm</a>
        </li>
    </ul>

    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($hotel) > 0) { ?>
                    <?php foreach ($hotel as $row) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <span class="badge <?php echo $row['status'] == 1 ? 'badge-success' : ($row['status'] == 2 ? 'badge-warning' : 'badge-danger'); ?>">
                                    <?php echo $row['status'] == 1 ? 'Đã xác nhận' : ($row['status'] == 2 ? 'Bị cấm' : 'Chưa xác nhận'); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status'] == 0) { ?>
                                    <a href="action/hotel_handle.php?id=<?php echo $row['id']; ?>&action=1" class="btn btn-success">Xác nhận</a>
                                    <a href="action/hotel_handle.php?id=<?php echo $row['id']; ?>&action=3" class="btn btn-danger">Cấm</a>
                                <?php } else if ($row['status'] == 2) { ?>
                                    <a href="action/hotel_handle.php?id=<?php echo $row['id']; ?>&action=2" class="btn btn-warning">Gỡ cấm</a>
                                <?php } else { ?>
                                    <a href="action/hotel_handle.php?id=<?php echo $row['id']; ?>&action=0" class="btn btn-danger">Hủy xác nhận</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có dữ liệu!</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('../layouts/footerAd.php');
?>
