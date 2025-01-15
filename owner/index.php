<?php
include('../config/database.php');
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit();
}
$role = "owner";
$page = "hotelManagement";
include('../layouts/headerAd.php');
$db = new Database();
$hotel = $db->select("hotels", "owner_id = " . $db->conn->real_escape_string($_SESSION['email']), "1");
?>
    
<?php
include('../layouts/footerAd.php');
?>