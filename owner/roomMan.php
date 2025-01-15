<?php
include('../config/database.php');
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit();
}
$role = "owner";
$page = "room";
include('../layouts/headerAd.php');
$db = new Database();
?>
    
<?php
include('../layouts/footerAd.php');
?>