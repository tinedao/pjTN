<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit();
}

$db = new Database();

// Lấy hành động từ form
$action = $_POST['action'] ?? null;

if ($action === "add") {
    // Thêm voucher mới
    $hotel_id = $_POST['hotel_id'];
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($code) || empty($discount) || empty($start_date) || empty($end_date)) {
        $_SESSION['alert'] = "Tất cả các trường là bắt buộc!";
        header("location: ../voucher.php");
        exit();
    }

    // Chuẩn bị dữ liệu để chèn vào database
    $data = [
        'hotel_id' => $hotel_id,
        'code' => $code,
        'discount' => $discount,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'status' => 0 // Mặc định là không kích hoạt
    ];

    $result = $db->insert('vouchers', $data);

    if ($result) {
        $_SESSION['alert'] = "Thêm voucher thành công!";
    } else {
        $_SESSION['alert'] = "Thêm voucher thất bại!";
    }

    header("location: ../voucher.php");
    exit();
}

if ($action === "edit") {
    // Sửa voucher
    $id = $_POST['id'];
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($code) || empty($discount) || empty($start_date) || empty($end_date)) {
        $_SESSION['alert'] = "Tất cả các trường là bắt buộc!";
        header("location: ../editVoucher.php?id=$id");
        exit();
    }

    // Chuẩn bị dữ liệu để cập nhật
    $data = [
        'code' => $code,
        'discount' => $discount,
        'start_date' => $start_date,
        'end_date' => $end_date
        // Không cập nhật `status`, để SQL tự xử lý
    ];

    $result = $db->update('vouchers', $id, $data);

    if ($result) {
        $_SESSION['alert'] = "Cập nhật voucher thành công!";
    } else {
        $_SESSION['alert'] = "Cập nhật voucher thất bại!";
    }

    header("location: ../voucher.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === "delete") {
    // Xóa voucher
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['alert'] = "ID không hợp lệ!";
        header("location: ../voucher.php");
        exit();
    }

    $result = $db->delete('vouchers', $id);

    if ($result) {
        $_SESSION['alert'] = "Xóa voucher thành công!";
    } else {
        $_SESSION['alert'] = "Xóa voucher thất bại!";
    }

    header("location: ../voucher.php");
    exit();
}

// Nếu không có hành động nào, chuyển về trang voucher
header("location: ../voucher.php");
exit();
