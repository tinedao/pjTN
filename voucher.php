<?php
include 'config/database.php';
include 'layouts/header.php';
include 'layouts/navbar.php';

$db = new Database();

$vouchers  = $db->select('hotel_voucher_info','',8);
?>


<section class="offer2 about wrapper timer top" id="shop">
    <div class="container">
        <div class="heading">
            <h5>EXCLUSIVE OFFERS </h5>
            <h3>You can get an exclusive offer </h3>
        </div>

        <div class="content grid  top">
            <?php
              foreach ($vouchers as $voucher) {
                  echo '<div class="box">';
                  echo '<h5>DISCOUNT - ' . htmlspecialchars(number_format($voucher['discount'])) . '%</h5>';
                  echo '<h3>' . htmlspecialchars($voucher['hotel_name']) . '</h3>';
                  echo '<span>';
                  echo str_repeat('<i class="fas fa-star"></i>', floor($voucher['stars']));
                  if ($voucher['stars'] - floor($voucher['stars']) >= 0.5) {
                      echo '<i class="fas fa-star-half-alt"></i>';
                  }
                  echo str_repeat('<i class="far fa-star"></i>', 5 - ceil($voucher['stars']));
                  echo '<label>(' . $voucher['review_count'] . ' Reviews)</label>';
                  echo '</span>';
                  echo '<div class="flex timeV">';
                  echo '<i class="fal fa-alarm-clock"> Thời gian áp dụng: ' . htmlspecialchars($voucher['voucher_start_date']) . ' - ' . htmlspecialchars($voucher['voucher_end_date']) . '</i>';
                  echo '</div>';
                  echo '<a href="rooms.php?id=' . $voucher['hotel_id'] . '">';
                  echo '<button class="flex1">';
                  echo '<span>Click để xem thêm</span>';
                  echo '<i class="fas fa-arrow-circle-right"></i>';
                  echo '</button>';
                  echo '</a>';
                  echo '</div>';
              }
?>

        </div>
    </div>
</section>
<?php
include 'layouts/slideBottom.php';
include 'layouts/footer.php';