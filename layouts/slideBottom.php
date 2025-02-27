<style>
  .gallary .owl-carousel .owl-item img {
    width: 100%; 
    height: 300px; 
    object-fit: cover;
}

</style>
<section class="gallary top" id="gallary">
    <div class="owl-carousel owl-theme">
      <div class="item">
        <img src="assets/img/s1.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s2.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s3.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s4.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s5.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s6.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s7.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
      <div class="item">
        <img src="assets/img/s8.jpg" alt="">
        <div class="overlay">
          <i class="fab fa-instagram"></i>
        </div>
      </div>
    </div>
    <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      dots: false,
      autoplay: true,
      slideTransition: 'linear',
      autoplayTimeout: 4000,
      autoplaySpeed: 4000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    })
  </script>
  </section>

  