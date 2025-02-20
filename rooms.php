<?php
include('config/database.php');

include('layouts/header.php');
include('layouts/navbar.php');

$db = new Database();
?>
<style>
    p{
        margin-bottom: 15px;
        line-height: 2;
    }
    .optionMain{
        border: 1px solid #ccc;
        border-radius: 15px;
        overflow: hidden;
    }
    .active{
        background-color: #007bff;
        color: white;
    }
    .btnRoom{
        padding: 5px 20px;
        text-align: center;
        flex: 1;
        text-decoration: none;
        color: black;
        width: 170px;

    }
    .box{
        border: 1px solid #ccc;
        border-radius: 15px;
        overflow: hidden;
        padding: 10px;
        width: 60%;
    }
    .img-room{
        overflow: hidden;
        border-radius: 15px;
        width: 500px;
        height: 350px;
    }
    .img-room img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
    <div class="heading mt-5">
        <h5>EXCLUSIVE OFFERS </h5>
        <h3>You can get an exclusive offer </h3>
    </div>
    <div class=" m-5 d-flex justify-content-center">
            <div class="optionMain d-flex align-items-center">
                <a href="action/optionRoomHandle.php?option=lowPrice" class="btnRoom active">Giá thấp trước</a>
                <a href="action/optionRoomHandle.php?option=highPrice" class="btnRoom">Giá cao trước</a>
            </div>
        </div>
    <div class="container d-flex justify-content-center">
        
        <div class="box">
            <div class="row">
                <div class="room-container d-flex align-items-center">
                    <div class="img-room">
                        <img src="assets/img/b1.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="inforRoom ms-3">
                        <h3>Deluxe Room</h3>
                        <p>Price: 100$</p>
                        <p>Size: 30m<sup>2</sup></p>
                        <p>Bed: 1</p>
                        <p>View: City</p>
                        <p>Max: 2</p>
                        <p>Facilities: Free Wifi, Air Conditioner, TV, ...</p>
                    </div>
                    <div class="option">
                        <a href="booking.php" class="btn btn-primary me-2">Book now</a>
                        <a href="roomDetail.php" class="btn btn-secondary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include('layouts/footer.php');