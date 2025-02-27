<?php
include('../../config/database.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$alert = "";
$error = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    $action = $_POST['action'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $coordinates = $_POST['coordinates'];
    $location_id = intval($_POST['location_id']);
    $hotel_type_id = intval($_POST['hotel_type_id']);
    $owner_id = $db->select("owners", "email = '$_SESSION[email]'", 1)[0]['id'];

    $photo_name = null;
    if (!empty($_FILES["photo"]["name"])) {
        $photo_name = $db->uploadImage($_FILES["photo"], "../../assets/upload/imgHotels/", $alert);
        if (!$photo_name) {
            $error = 1; 
        }
    }

    if ($action === 'add') {
        if ($photo_name || empty($_FILES["photo"]["name"])) {
            $data = [
                "name" => $name,
                "address" => $address,
                "photo" => $photo_name,
                "description" => $description,
                "hotel_type_id" => $hotel_type_id,
                "coordinates" => $coordinates,
                "location_id" => $location_id,
                "owner_id" => $owner_id,
                "status" => 0 
            ];

           
            $result = $db->insert("hotels", $data);

            if ($result) {
                $alert = "Thêm khách sạn thành công!";
            } else {
                $alert = "Có lỗi xảy ra khi thêm khách sạn.";
                $error = 1;
            }
        }
    } elseif ($action === 'edit') {
        $hotel_id = intval($_POST['hotel_id']); 

        $data = [
            "name" => $name,
            "address" => $address,
            "description" => $description,
            "hotel_type_id" => $hotel_type_id,
            "coordinates" => $coordinates,
            "location_id" => $location_id
        ];
        
        
        if ($photo_name) {
            $data["photo"] = $photo_name;
        }

        $result = $db->update("hotels", $hotel_id, $data);

        if ($result) {
            $alert = "Cập nhật khách sạn thành công!";
        } else {
            $alert = "Có lỗi xảy ra khi cập nhật khách sạn.";
            $error = 1;
        }
    } else {
        $alert = "Hành động không hợp lệ.";
        $error = 1;
    }

    header("location: ../index.php?alert=" . urlencode($alert) . "&err=$error");
    exit();
}
?>
