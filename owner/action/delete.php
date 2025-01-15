<?php
include '../../config/database.php';

$db = new Database();
$table = $_GET['table'];
$id = $_GET['id'];

if ($db->delete($table, $id)) {
    header("location: ../index.php?alert=Xóa thành công!");
    exit();
} else {
    header("location: ../index.php?alert=Xóa thất bại!&err=1");
    exit();
}
