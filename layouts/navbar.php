<?php
?>
<style>
  #userName img{
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
  }
</style>
<section class="head">
    <div class="container flex1">
        <div class="scoial">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-youtube"></i>
        </div>
        <div class="logo">
            <a href="index.php"><img src="assets/img/logo.png"></a>
        </div>
        <div class="address">
        <i class="fas fa-map-marker-alt"></i>
        <span>Phu Tho</span>
      </div>
    </div>
</section>
<header class="header">
    <div class="container">
        <nav class="navbar flex1">
            <div class="sticky_logo logo">
                <a href="index.php"><img src="assets/img/logo.png"></a>
            </div>
            <ul class="nav-menu" style="margin-bottom: 0;">
                <li> <a href="index.php">Home</a> </li>
                <li> <a href="hotels.php">Hotels</a> </li>
                <li> <a href="voucher.php">Voucher</a> </li>
                <li> <a href="blog.php">Blog Travel</a> </li>
                <li> <a href="owner/index.php">Owner</a> </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            
            <div class="inforUser sticky_infor">
                <?php
                if (isset($_SESSION['name'])) {
                    $db = new Database();
                    $user = $db->select('users', 'id = "' . $_SESSION['id'] . '"', 1)[0];
                    echo '<span id="userName" class=" btn user_name">   <img src="assets/upload/avatars/' . $user['profile_picture'].'" alt="">' . $_SESSION['name'] . ' <i id="arrowI" class="fa-solid fa-caret-down"></i></span>
                    <div class="hoverUserInfor">
                        <ul>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="booking.php">Booking</a></li>
                            <li><a href="action/logout.php">Logout</a></li>
                        </ul>
                    </div>';
                } else {
                    echo '<a class="user_name" style="color:white; font-weight:bold;" href="login.php">LOGIN</a>';
                }
                ?>
            </div>
            <div class="head_contact">
                <i class="fas fa-phone-volume"></i>
                <span style=" padding: 0 10px">+0979499802</span>
            </div>
        </nav>
    </div>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userName = document.getElementById("userName");
        const hoverUserInfor = document.querySelector(".hoverUserInfor");
        const arrowI = document.getElementById("arrowI");
        userName.addEventListener("click", function() {
            hoverUserInfor.style.display = hoverUserInfor.style.display === "none" ? "block" : "none";
            arrowI.style.transform = arrowI.style.transform === "rotate(0deg)" ? "rotate(180deg)" : "rotate(0deg)";
        });

        document.addEventListener("click", function(event) {
            if (!userName.contains(event.target) && !hoverUserInfor.contains(event.target)) {
                hoverUserInfor.style.display = "none";
                arrowI.style.transform = "rotate(0deg)";
            }
        });
    });

    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".nav-menu");
    hamburger.addEventListener("click", mobliemmenu);

    function mobliemmenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    }

    window.addEventListener("scroll", function() {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 10)
    })
</script>
