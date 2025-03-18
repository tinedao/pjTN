<?php

include('config/database.php');
$db = new Database();
include('layouts/header.php');
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

include('layouts/navbar.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$room_type = $db->select("room_types", "id = $id")[0];
$user = $db->select("users", "id = $_SESSION[id]")[0];
$vouchers = $db->select("vouchers", $room_type['hotel_id'] ? "status = 1" : "status = 1");
$toado_value = $db->select("hotels", "id = $room_type[hotel_id]")[0]['coordinates'];
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
            <input type="number" name="room_type_id" value="<?= $room_type['id'] ?>" hidden>
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
            <label for="discount_id" class="form-label">Discount</label>
            <select class="form-select" id="discount_id" name="discount_id">
                <option value="0" selected>Không</option>
                <?php foreach ($vouchers as $voucher): ?>
                <option value="<?= $voucher['id'] ?>"> <?= number_format($voucher['discount']) ?>%</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="totalPrice" class="form-label">Tổng tiền</label>
            <input type="text" class="form-control" id="totalPrice"readonly>
            <input type="text" class="form-control" id="PriceHide" name="totalPrice" hidden>
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
<script>
function calculateDays(checkInDate, checkOutDate) {
    const checkIn = new Date(checkInDate);
    const checkOut = new Date(checkOutDate);
    const timeDiff = checkOut - checkIn; 
    const daysDiff = timeDiff / (1000 * 3600 * 24); 
    return daysDiff;
}

let pricePerNight = <?= $room_type['price'] ?>; 

function updateTotalPrice() {
    const checkInDate = document.getElementById('check_in_date').value;
    const checkOutDate = document.getElementById('check_out_date').value;
    const totalPriceField = document.getElementById('totalPrice');
    const Price = document.getElementById('PriceHide');

    if (checkInDate && checkOutDate) {
        const days = calculateDays(checkInDate, checkOutDate);
        if (days > 0) {
            if (document.getElementById('discount_id').value != 0) {
                var totalPrice = days * pricePerNight * (1 - (document.getElementById('discount_id').value / 100));
            }else{
                var totalPrice = days * pricePerNight;
            }
            totalPriceField.value = totalPrice.toLocaleString('vi-VN') + ' VND';
            Price.value = totalPrice;

        } else {
            totalPriceField.value = 'Ngày không hợp lệ';
        }
    } else {
        totalPriceField.value = '';
    }
}

document.getElementById('check_in_date').addEventListener('change', updateTotalPrice);
document.getElementById('check_out_date').addEventListener('change', updateTotalPrice);
document.getElementById('discount_id').addEventListener('change', updateTotalPrice);
document.getElementById('PriceHide').addEventListener('change', updateTotalPrice);
</script>
<?php

include('layouts/footer.php');