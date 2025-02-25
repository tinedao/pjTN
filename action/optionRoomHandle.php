<?php
session_start();
include('../config/database.php');

$db = new Database();

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['option'])) {
    switch ($_GET['option']) {
        case 'addReviews':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $stars = isset($_POST['stars']) ? intval($_POST['stars']) : 0;
            $review_text = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';
            $hotel_id = isset($_POST['hotel_id']) ? intval($_POST['hotel_id']) : 0;
            $user_id = $_SESSION['id'];

            if ($stars < 1 || $stars > 5 || empty($review_text) || $hotel_id <= 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=invalid_input');
                exit();
            }

            $hotel = $db->getById('hotels', $hotel_id);
            if (!$hotel) {
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=hotel_not_found');
                exit();
            }

            $data = [
                'hotel_id' => $hotel_id,
                'user_id' => $user_id,
                'stars' => $stars,
                'review_text' => $review_text,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $result = $db->insert('reviews', $data);
            if ($result) {
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&success=review_added');
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=database_error');
            }
            break;

        case 'deleteReview':
            $review_id = isset($_GET['review_id']) ? intval($_GET['review_id']) : 0;
            $hotel_id = isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0;

            $review = $db->getById('reviews', $review_id);
            if ($review && $review['user_id'] == $_SESSION['id']) {
                $db->delete('reviews', $review_id);
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&success=review_deleted');
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=delete_failed');
            }
            break;

        default:
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
    }
    exit();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();