<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

include('../../config/database.php');
$db = new Database();

// Lấy action và id từ query parameter
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

// Kiểm tra id và action
if ($id === null || !is_numeric($id) || !in_array($action, ['0', '1'])) {
    echo "Yêu cầu không hợp lệ!";
    exit();
}

// Cập nhật trạng thái
$status = $action == '1' ? 1 : 0;
if ($db->update('users', $id, ['status' => $status])) {
    header('Location: ../users.php?status=' . $status);
    exit();
} else {
    echo "Cập nhật thất bại!";
    exit();
}
?>
