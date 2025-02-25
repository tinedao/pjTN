<?php
include('../config/database.php');
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit();
}
$role = "owner";
$page = "booking";
include('../layouts/headerAd.php');
$db = new Database();
$bookings = $db->select("bookings");

?>
<!-- Phần HTML -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách đặt phòng</h4>
        </div>
        <div class="card-body">
            <table id="bookingsTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID Phòng</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>ID Khách sạn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= $booking['room_id'] ?></td>
                        <td><?= date('d/m/Y', strtotime($booking['check_in_date'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($booking['check_out_date'])) ?></td>
                        <td><?= $booking['phone_number'] ?></td>
                        <td>
                            <?php
                            switch ($booking['status']) {
                                case 0:
                                    echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                                    break;
                                case 1:
                                    echo '<span class="badge bg-success">Đã xác nhận</span>';
                                    break;
                                case 2:
                                    echo '<span class="badge bg-danger">Đã hủy</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary">Không xác định</span>';
                            }
                            ?>
                        </td>
                        <td><?= date('d/m/Y H:i:s', strtotime($booking['created_at'])) ?></td>
                        <td><?= $booking['hotel_id'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Thư viện AdminLTE và các phụ thuộc -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<!-- Khởi tạo DataTables -->
<script>
$(document).ready(function() {
    $('#bookingsTable').DataTable({
        "paging": true,       // Phân trang
        "searching": true,    // Tìm kiếm
        "ordering": true,     // Sắp xếp cột
        "info": true,         // Thông tin số bản ghi
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json" // Ngôn ngữ tiếng Việt
        },
        "columnDefs": [
            { "orderable": false, "targets": 4 } // Không cho phép sắp xếp cột Trạng thái
        ]
    });
});
</script>
<?php
include('../layouts/footerAd.php');