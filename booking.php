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
    <div class="container">

    </div>
</div>

        </div>
    </div>
    <script>
        function toggleForm(formId) {
    // Lấy tất cả các form
    const forms = document.querySelectorAll('form');
    
    // Lặp qua các form và ẩn tất cả trừ form được nhấn
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