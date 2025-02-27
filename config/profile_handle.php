<?php
include('../config/database.php');
$db = new Database();
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];
$user = $db->select('users', 'id = "' . $user_id . '"', 1)[0];

if (isset($_GET['action']) && ($_GET['action'] === 'delete')) {
    $db->delete('users', $user_id);
    session_destroy();
    $alert = "Xóa tài khoản thành công.";
    header('Location: index.php?alert=' . urlencode($alert));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $alert = "";
    $err = 0;

    
    if (isset($_FILES['profile_picture'])) {
        $target_dir = dirname(__DIR__) . "/assets/upload/avatars/";
        $profile_picture = $db->uploadImage($_FILES['profile_picture'], $target_dir, $alert);

        if ($profile_picture !== false) {
            $update_data = ['profile_picture' => $profile_picture];
            if ($db->update('users', $user_id, $update_data)) {
                $alert = "Avatar đã được cập nhật thành công.";
            } else {
                $err = 1;
                $alert = "Cập nhật avatar thất bại.";
            }
        } else {
            $err = 1; 
        }
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if (!empty($name)) {
            $update_data = ['name' => $name];
            if ($db->update('users', $user_id, $update_data)) {
                $alert = "Tên đã được cập nhật thành công.";
            } else {
                $err = 1;
                $alert = "Cập nhật tên thất bại.";
            }
        }
    }

    if (isset($_POST['phone_number'])) {
        $phone_number = $_POST['phone_number'];
        if (!empty($phone_number)) {
            $update_data = ['phone_number' => $phone_number];
            if ($db->update('users', $user_id, $update_data)) {
                $alert = "Số điện thoại đã được cập nhật thành công.";
            } else {
                $err = 1;
                $alert = "Cập nhật số điện thoại thất bại.";
            }
        }
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $update_data = ['password' => $hashed_password];
            if ($db->update('users', $user_id, $update_data)) {
                $alert = "Mật khẩu đã được cập nhật thành công.";
            } else {
                $err = 1;
                $alert = "Cập nhật mật khẩu thất bại.";
            }
        }
    }

    if ($err) {
        header('Location: ../profile.php?alert=' . urlencode($alert) . '&err=' . $err);
    } else {
        header('Location: ../profile.php?alert=' . urlencode($alert));
    }
    exit();
}

header('Location: ../profile.php');
exit();
?>
