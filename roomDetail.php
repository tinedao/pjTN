<?php

include('config/database.php');
$db = new Database();

include('layouts/header.php');

include('layouts/navbar.php');
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$room_type = $db->select("room_types", "id = $id")[0];
$user = $db->select("users", "id = $_SESSION[id]")[0];
?>
<style>
    .img_room{
        width: 100%;
        height: 300px;
        overflow: hidden;
    }
    .img_room img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div class="container w-75 mt-5 d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-6">
            <div class="img_room w-100">
                <img class="" src="assets/upload/imgTypeRooms/<?= $room_type['photo_url'] ?>" alt="">
            </div>
            <table class="table w-100 border mt-3">
                <tbody>
                    <tr>
                        <th>Loại phòng</th>
                        <td><?= $room_type['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Thông tin</th>
                        <td><?= $room_type['description'] ?></td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td><?= number_format($room_type['price']) ?> VND/ngày</td>
                    </tr>
                    <tr>
                        <th>Số giường</th>
                        <td><?= $room_type['bed_count'] ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-6">
<div class="-none">
    <form id="bookingForm" action="action/booking_handle.php" method="POST">
        <div class="row">
            <div class="mb-3 col-6">
                <label for="check_in_date" class="form-label">Check in date</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <div class="mb-3 col-6">
                <label for="check_out_date" class="form-label">Check out date</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
        </div>
        <button>Booking</button>
    </form>
</div>

        </div>
    </div>
</div>

<?php
include('layouts/footer.php');