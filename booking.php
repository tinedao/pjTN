<?php
include('config/database.php');
$db = new Database();
include('layouts/header.php');
include('layouts/navbar.php');
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}
$user = $db->select('users', 'id = "' . $_SESSION['id'] . '"', 1)[0];
?>
<style>
    *{
        font-family: 'Roboto', sans-serif;
    }
    .list-group-item{
        font-weight: bold;
    }
    .list-group .active{
        background-color: white;
        color: #007BFF;
        border-right: 5px solid #007BFF;
    }
    .col-10{
        border-left: 1px solid gray;
    }
    .itemPro{
        width: 100%;
        margin: 10px 0;
        padding: 25px;
        background-color: #B1C29E;
        border: 1px solid #B1C29E;
        border-radius: 5px;
    }
    .itemPro img{
        width: 70px;
        height: 70px ;
        border-radius: 50%;
        object-fit: cover;
    }
    .avatar{
        padding: 10px 25px !important;
    }
    .itemPro button{
        background:none;
        font-weight: bold;
        color: white;
    }
    .itemPro form{
        width: 100%;
        align-items: center;
    }
    .textA{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    .itemPro form input{
        width: 80%;
    }
    .itemPro form button{
        width: 20%;
    }
    .deleteAccount{
        color: red;
        background-color: #F0A04B;
        font-weight: bold;
    }
    table{
        text-align: center;
    }
</style>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="list-group">
                <a href="profile.php" class="list-group-item list-group-item-action">Thông tin cá nhân</a>
                <a href="booking.php" class="list-group-item active list-group-item-action">Thông tin phòng đã đặt</a>
            </div>
        </div>
        <div class="col-10">
            <h3 class="text-center"><b>BOOKING</b></h3>
            <div class="container mt-5" style="margin-left: 0 ! important; margin-right: 0 ! important">
                    <div class="card-body">
                        <table id="bookingsTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tên phòng</th>
                                    <th>Loại phòng</th>
                                    <th>Giá</th>
                                    <th>Tên khách sạn</th>
                                    <th>Địa chỉ</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $bookings = $db->select("booking_info", "user_id = " . $_SESSION['id']);
                                foreach ($bookings as $booking):
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($booking['room_name']) ?></td>
                                    <td><?= htmlspecialchars($booking['room_type_name']) ?></td>
                                    <td><?= number_format($booking['totalPrice'], 0, ',', '.') ?> VND</td>
                                    <td><?= htmlspecialchars($booking['hotel_name']) ?></td>
                                    <td><?= htmlspecialchars($booking['hotel_address']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($booking['check_in_date'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($booking['check_out_date'])) ?></td>
                                    <td>
                                        <?php
                                        switch ($booking['status']) {
                                            case 0:
                                                echo '<span class="badge bg-success">Đã đặt</span>';
                                                break;
                                            case 1:
                                                echo '<span class="badge bg-danger">Đã hủy</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-secondary">Không xác định</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($booking['created_at'])) ?></td>
                                    <td>
                                        <?php if ($booking['status'] == 0): ?>
                                            <a href="action/cancel_booking.php?booking_id=<?= $booking['booking_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy đặt phòng này không?');">Hủy</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <script>
        function toggleForm(formId) {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                if (form.id === formId) {
                    form.style.display = form.style.display === 'none' || !form.style.display ? 'flex' : 'none';
                } else {
                    form.style.display = 'none';
                }
            });
        }
    </script>
<?php
include('layouts/footer.php');
?>