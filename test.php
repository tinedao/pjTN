<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
        width: 80%;
    }
</style>

<div class="card">
    <div class="container">
        <h4>T n ng i  đặt: <span id="tennguoidat">Nguy n V n A</span></h4>
        <p>Email: <span id="email">nguyenvana@gmail.com</span></p>
        <p>T n ph ng: <span id="tenphong">Ph ng 1</span></p>
        <p>Gi : <span id="gia">1000000 VND</span></p>
        <p>Check-in: <span id="checkin">12/12/2020</span></p>
        <p>Check-out: <span id="checkout">15/12/2020</span></p>
        <p>S  điện thoại: <span id="sodienthoai">0123456789</span></p>
        <p>Ng y ặt: <span id="ngaydat">10/12/2020</span></p>
        <p>T n kh ch s n: <span id="tenkhachsan">Kh ch s n ABC</span></p>
        <p> i ch : <span id="diachi">S  1 ng  123, T p 1, Qu n 1, Tp.HCM</span></p>
    </div>
</div>
</body>
</html>