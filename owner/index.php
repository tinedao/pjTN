<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit();
}
$role = "owner";
$page = "hotelManagement";
include('../layouts/headerAd.php');
?>
    owners
<?php
include('../layouts/footerAd.php');
?>