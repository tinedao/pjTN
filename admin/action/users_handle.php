<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

include('../../config/database.php');
$db = new Database();

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($id === null || !is_numeric($id) || !in_array($action, ['0', '1'])) {
    echo "Yêu cầu không hợp lệ!";
    exit();
}

$status = $action == '1' ? 1 : 0;
if ($db->update('users', $id, ['status' => $status])) {
    header('Location: ../users.php?status=' . $status);
    exit();
} else {
    echo "Cập nhật thất bại!";
    exit();
}
?>
