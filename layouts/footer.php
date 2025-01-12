<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />






  <section class="map top">
  <?php
  
    if(isset($toado)){
      echo $toado;
    }else{
      echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3716.3427522178654!2d105.38285066579321!3d21.33697159232104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313493519a7ff667%3A0xdd0a564e4942f39d!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBIw7luZyBWxrDGoW5n!5e0!3m2!1svi!2s!4v1735882554993!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
    }
  ?>
  
  </section>


<footer>
    <div class="container top">
      <div class="subscribe" id="contact">
        <h2>Subscribe newsletter</h2>
        <p> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="input flex">
          <input type="email" placeholder="Your Email address">
          <button class="flex1">
            <span>Subscribe</span>
            <i class="fas fa-arrow-circle-right"></i>
          </button>
        </div>
      </div>

      <div class="content grid  top">
        <div class="box">
          <div class="logo">
          <a href="index.php"><img src="assets/img/logo.png"></a>
          </div>
          <p>Chúng tôi cam kết mang đến cho khách hàng trải nghiệm tuyệt vời nhất với dịch vụ chuyên nghiệp, sản phẩm chất lượng cao và tiện ích vượt trội. Với tầm nhìn hướng tới sự hoàn hảo, chúng tôi không ngừng cải tiến và sáng tạo để đáp ứng mọi nhu cầu của khách hàng, tạo dựng sự tin tưởng và đem lại giá trị bền vững.</p>
          <div class="social flex">
            <a href="https://www.facebook.com/gakeugaumeo"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/tinedao19"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.instagram.com/khaoisme/"><i class="fab fa-instagram"></i></a>
            <a href="https://github.com/tinedao"><i class="fa-brands fa-github"></i></a>
          </div>
        </div>

        <div class="box">
          <h2>Quick Links</h2>
          <ul>
            <li><i class="fas fa-angle-double-right"></i>Big Data</li>
            <li><i class="fas fa-angle-double-right"></i>Wellness</li>
            <li><i class="fas fa-angle-double-right"></i>Spa Gallery</li>
            <li><i class="fas fa-angle-double-right"></i>Reservation</li>
            <li><i class="fas fa-angle-double-right"></i>FAQ</li>
            <li><i class="fas fa-angle-double-right"></i>Contact</li>
          </ul>
        </div>

        <div class="box">
          <h2>Services</h2>
          <ul>
            <li><i class="fas fa-angle-double-right"></i>Restaurant</li>
            <li><i class="fas fa-angle-double-right"></i>Swimming Pool</li>
            <li><i class="fas fa-angle-double-right"></i>Wellness & Spa</li>
            <li><i class="fas fa-angle-double-right"></i>Conference Room</li>
            <li><i class="fas fa-angle-double-right"></i>Events</li>
            <li><i class="fas fa-angle-double-right"></i>Adult Room</li>
          </ul>
        </div>

        <div class="box">
          <h2>Services</h2>
          <div class="icon flex">
            <div class="i">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="text">
              <h3>Address</h3>
              <p>Phu Tho</p>
            </div>
          </div>
          <div class="icon flex">
            <div class="i">
              <i class="fas fa-phone"></i>
            </div>
            <div class="text">
              <h3>Phone</h3>
              <p>+0979499802</p>
            </div>
          </div>
          <div class="icon flex">
            <div class="i">
              <i class="far fa-envelope"></i>
            </div>
            <div class="text">
              <h3>Email</h3>
              <p>tine.dao19@gmail.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

    <script src="vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  
  <script src="assets/js/main.js"></script>
</body>


</html>