<?php
include('../config/database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$role = "owner";
$page = "booking";
include('../layouts/headerAd.php');
$db = new Database();

$bookings = $db->select("booking_info");

?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách đặt phòng</h4>
        </div>
        <div class="card-body">
            <table id="bookingsTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên người đặt</th> 
                        <th>Email</th>        
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['user_name']) ?></td> 
                        <td><?= htmlspecialchars($booking['user_email']) ?></td> 
                        <td><?= date('d/m/Y', strtotime($booking['check_in_date'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($booking['check_out_date'])) ?></td>
                        <td><?= htmlspecialchars($booking['phone_number']) ?></td>
                        <td>
                            <?php
                            switch ($booking['status']) {
                                case 0:
                                    echo '<span class="badge bg-success">Đã xác nhận</span>';
                                    break;
                                case 1:
                                    echo '<span class="badge bg-danger">Đã hủy</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td><?= date('d/m/Y H:i:s', strtotime($booking['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    $('#bookingsTable').DataTable({
        "paging": true,       
        "searching": true,    
        "ordering": true,     
        "info": true,         
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json" 
        },
        "columnDefs": [
            { "orderable": false, "targets": 5 } 
        ]
    });
});
</script>
<?php
include('../layouts/footerAd.php');
?>