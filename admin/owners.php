<?php
$page = "ownersManagement";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('../config/database.php');
$db = new Database();
include('../layouts/headerAd.php');

$currentStatus = isset($_GET['status']) && in_array($_GET['status'], ['0', '1']) ? $_GET['status'] : '1';

$owners = $db->select("owners", "status = $currentStatus");
?>

<div class=" mt-4">
    <!-- Taskbar -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $currentStatus == '1' ? 'active' : ''; ?>" href="?status=1">Đã kích hoạt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $currentStatus == '0' ? 'active' : ''; ?>" href="?status=0">Chưa kích hoạt</a>
        </li>
    </ul>

    <!-- Table -->
    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($owners) > 0) { ?>
                    <?php foreach ($owners as $row) { ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <span class="badge <?php echo $row['status'] == 1 ? 'badge-success' : 'badge-danger'; ?>">
                                    <?php echo $row['status'] == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status'] == 0) { ?>
                                    <a href="action/owners_handle.php?id=<?php echo $row['id']; ?>&action=1" class="btn btn-success">Kích hoạt</a>
                                <?php } else { ?>
                                    <a href="action/owners_handle.php?id=<?php echo $row['id']; ?>&action=0" class="btn btn-danger">Hủy kích hoạt</a>
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
