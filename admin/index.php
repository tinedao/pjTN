<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
};
$role = "";
include('../config/database.php');
include('../layouts/headerAd.php');

?>


<?php
include('../layouts/footerAd.php');