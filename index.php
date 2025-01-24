<?php
include 'config/database.php';
include 'layouts/header.php';
include 'layouts/navbar.php';

$db = new Database();
$locations = $db->select('locations');

$conditionHotel = "status = 1";
$hotels = $db->select('hotels',$conditionHotel,4);
$vouchers  = $db->select('hotel_voucher_info','',8);
?>
<style>
.locationOp {
    width: 100%;
    padding: 10px 20px;
    border: none;
}

.locationOp:focus {
    border: none;
}
</style>


<form method="POST" action="hotels.php">
    <section class="home" id="home">
        <div class="container">
            <h1>Phu Tho Booking</h1>
            <p>Discover the place where you have fun & enjoy a lot</p>

            <div class="content grid">
                <div class="box">
                    <span>LOCATION</span> <br>
                    <select class="locationOp" name="location" required>
                        <option value="">Chọn huyện</option>
                        <?php
            foreach ($locations as $location) {
              echo "<option value='{$location['id']}'>" . htmlspecialchars($location['name']) . "</option>";
            }
            ?>
                    </select>
                </div>
                <div class="box">
                    <span>ARRIVAL DATE</span> <br>
                    <input type="date" name="arrival_date" required>
                </div>
                <div class="box">
                    <span>DEPARTURE DATE</span> <br>
                    <input type="date" name="departure_date" required>
                </div>
                <div class="box">
                    <button class="flex1" type="submit">
                        <span>Check Availability</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</form>


<section class="about" id="about">
    <div class="container">
        <div class="heading">
            <h5>EXPLORE</h5>
            <h2>We are cool to give you pleasure
            </h2>
        </div>

        <div class="content flex  top">
            <div class="left">
                <h3>Hãy để sự tò mò của bạn thực hiện việc đặt phòng
                </h3>
                <p>Bắt đầu một hành trình mà mỗi cú nhấp chuột mở ra một cánh cửa dẫn đến những trải nghiệm mới. Nền
                    tảng của chúng tôi biến hành động đặt phòng đơn thuần thành một cuộc phiêu lưu, làm cho mỗi lần lưu
                    trú trở nên đặc biệt. Khám phá thế giới đầy tiềm năng, nơi mà chuyến đi hoàn hảo chỉ cách vài cú
                    nhấp chuột. </p>
                <p> Hãy để lòng đam mê du lịch của bạn dẫn lối đến những điểm đến khó quên. Cho dù bạn đang tìm kiếm một
                    kỳ nghỉ sang trọng, một homestay ấm cúng hay một nhà nghỉ tiết kiệm, chuyến đi lý tưởng của bạn đang
                    chờ được khám phá.</p>
                <a href="hotels.php">
                    <button class="flex1">
                        <span>I’m flexible</span>
                        <i class="fas fa-arrow-circle-right"></i>
                    </button></a>
            </div>
            <div class="right">
                <img src="assets/img/a.png" alt="">
            </div>
        </div>
    </div>
</section>

<section class="blog top margin-bottom" id="blog">
    <div class="container">
        <div class="heading">
            <h3>Inspiration for your next trip</h3>
        </div>

        <div class="content grid mtop">
            <div class="box">
                <div class="img">
                    <img src="assets/img/b1.jpg" alt="">
                    <span>HOTEL</span>
                </div>
                <div class="text">
                    <h3>Lonavla</h3>
                    <p>69 kilometres away</p>
                    <a href="#">Read More <i class='far fa-long-arrow-alt-right'></i> </a>
                </div>
            </div>
            <div class="box">
                <div class="img">
                    <img src="assets/img/b2.jpg" alt="">
                    <span>HOTEL</span>
                </div>
                <div class="text">
                    <h3>Alibagh</h3>
                    <p>37 kilometres away</p>
                    <a href="#">Read More <i class='far fa-long-arrow-alt-right'></i> </a>
                </div>
            </div>
            <div class="box">
                <div class="img">
                    <img src="assets/img/b3.jpg" alt="">
                    <span>HOTEL</span>
                </div>
                <div class="text">
                    <h3>Calangute</h3>
                    <p>53 kilometres away</p>
                    <a href="#">Read More <i class='far fa-long-arrow-alt-right'></i> </a>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script>
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    navText: ["<i class='far fa-long-arrow-alt-left'></i>", "<i class='far fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})
</script>







<section class="timer about wrapper">
    <div class="background"> </div>
    <div class="container">
        <div class="heading">
            <h5>LAST MINUTE!</h5>
            <h2> <span>Incredible!</span> Are you coming today</h2>
        </div>

        <div id="time" class="flex1 mtop"> </div>
    </div>
</section>
<script src="js/jquery.countdown.js" charset="utf-8"></script>
<script src="js/jquery.countdown.min.js" charset="utf-8"></script>
<script type="text/javascript">
$('#time').countdown('2024/01/01', function(event) {
    $(this).html(event.strftime(
        '<div class="clock"><span>%d</span> <p>Days</p></div> ' +
        '<div class="clock"><span>%H</span> <p>Hours</p></div> ' +
        '<div class="clock"><span>%M</span> <p>Minutes</p></div> ' +
        '<div class="clock"><span>%S</span> <p>Seconds</p></div> '
    ));
});
</script>


<section class="offer mtop" id="services">
    <div class="container">
        <div class="heading">
            <h5>EXCLUSIVE OFFERS </h5>
            <h3>You can get an exclusive offer </h3>
        </div>

        <div class="content grid2 mtop">
            <?php
        if ($hotels) {
            foreach ($hotels as $hotel) {
                echo "<div class='box flex'>";
                echo "<div class='left imgHotels'>";
                echo "<img src='assets/upload/imgHotels/".$hotel['photo']."' alt=''>";
                echo "</div>";
                echo "<div class='right'>";
                echo "<h4 class='titleHotel'>".$hotel['name']."</h4>";
                echo "<div class='rate flex'>";
                echo "<small style='color: black; margin-top: 10px;'><address>Địa chỉ: ".$hotel['address']."</address></small>";
                echo "</div>";
                echo "<div class='rate flex'>";
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $hotel['stars']) {
                        echo "<i class='fas fa-star'></i>";
                    } else {
                        echo "<i class='far fa-star'></i>";
                    }
                }
                echo "</div>";
                echo "<p>".$hotel['description']."</p>";
                echo "<h5>From ".number_format($hotel['starting_price'])." VND/night</h5>";
                echo "<a href='rooms.php?hotel_id=".$hotel['id']."'>";
                echo "<button class='flex1'>";
                echo "<span>Book</span>";
                echo "<i class='fas fa-arrow-circle-right'></i>";
                echo "</button>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No hotels found.</p>";
        }
        ?>

            <div class="more">
                <a href="hotels.php">Bấm để xem thêm</a>
            </div>
        </div>
    </div>
</section>



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
                  // Hiển thị số sao
                  echo str_repeat('<i class="fas fa-star"></i>', floor($voucher['stars'])); // Sao đầy
                  if ($voucher['stars'] - floor($voucher['stars']) >= 0.5) {
                      echo '<i class="fas fa-star-half-alt"></i>'; // Sao nửa
                  }
                  echo str_repeat('<i class="far fa-star"></i>', 5 - ceil($voucher['stars'])); // Sao rỗng
                  // Hiển thị số lượng đánh giá
                  echo '<label>(' . $voucher['review_count'] . ' Reviews)</label>';
                  echo '</span>';
                  // Hiển thị thời gian áp dụng voucher
                  echo '<div class="flex">';
                  echo '<i class="fal fa-alarm-clock"> Thời gian áp dụng: ' . htmlspecialchars($voucher['voucher_start_date']) . ' - ' . htmlspecialchars($voucher['voucher_end_date']) . '</i>';
                  echo '</div>';
                  // Bọc button trong thẻ <a> để chuyển hướng tới trang hotels
                  echo '<a href="rooms.php?id=' . $voucher['hotel_id'] . '">';
                  echo '<button class="flex1">';
                  echo '<span>Click để xem thêm</span>';
                  echo '<i class="fas fa-arrow-circle-right"></i>';
                  echo '</button>';
                  echo '</a>';
                  echo '</div>';
              }
?>
        <div class="more">
          <a href="vouchers.php">Xem thêm voucher</a>
        </div>
        </div>
    </div>
</section>
<section class="customer top" id="testimonials">
    <div class="container">
        <div class="heading">
            <h5>TESTIMONIALS </h5>
            <h3>Project Management</h3>
        </div>

        <div class="owl-carousel owl-theme mtop">
            <div class="item">
                <p>Với vai trò là chủ nhiệm đề tài của nền tảng đặt phòng khách sạn tỉnh Phú Thọ, tôi xin gửi lời tri ân
                    sâu sắc đến quý khách hàng đã tin tưởng và đồng hành cùng chúng tôi. Trang web không chỉ đơn thuần
                    là nơi cung cấp các dịch vụ đặt phòng, mà còn là cầu nối mang đến trải nghiệm du lịch trọn vẹn, giúp
                    du khách khám phá vẻ đẹp thiên nhiên, văn hóa và con người Phú Thọ. Chúng tôi cam kết mang lại dịch
                    vụ chuyên nghiệp, tiện ích hiện đại và những giá trị thực sự cho mỗi chuyến đi của bạn.</p>
                <div class="admin flex">
                    <div class="img">
                        <img src="assets/img/dqt.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>Đào Quang Tiến</h3>
                        <span>Leader Team</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <p>Chúng tôi luôn nỗ lực không ngừng để kết nối du khách trong và ngoài nước với những trải nghiệm lưu
                    trú chất lượng cao, đồng thời góp phần thúc đẩy du lịch địa phương phát triển bền vững. Thành công
                    của chúng tôi không thể thiếu sự đóng góp quý báu từ các đối tác khách sạn, nhà nghỉ và sự ủng hộ
                    của quý khách hàng. Chúng tôi xin chân thành cảm ơn và hy vọng được tiếp tục đồng hành cùng quý vị
                    trong hành trình khám phá vùng đất Tổ linh thiêng.</p>
                <div class="admin flex">
                    <div class="img">
                        <img src="assets/img/dtn.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>Đinh Thị Ngọc</h3>
                        <span>Manager</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    autoplayHoverPause: true,
    navText: ["<i class='far fa-long-arrow-alt-left'></i>", "<i class='far fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})
</script>




<?php
include 'layouts/slideBottom.php';
include 'layouts/footer.php';