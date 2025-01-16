<?php
include '../../config/database.php';

$db = new Database();

$table = $_GET['table'];
$id = $_GET['id'];
$page = $_GET['page'];
$db->delete($table, $id);
$alert = "Xóa thành công!";
header("location: ../$page.php?alert=" . urlencode($alert));