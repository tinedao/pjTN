<?php session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
};
include('../../config/database.php');
$db = new Database();
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
if($action == 1){
    $db->update('hotels', $id, ['status' => 1]);
    header('Location: ../index.php');
    exit();
}else if($action == 2){
    $db->update('hotels', $id, ['status' => 0]);
    header('Location: ../index.php');
    exit();
}else if($action == 3){
    $db->update('hotels', $id, ['status' => 2]);
    header('Location: ../index.php');
    exit();
}else if($action == 0){
    $db->update('hotels', $id, ['status' => 0]);
    header('Location: ../index.php');
    exit();
}
?>
