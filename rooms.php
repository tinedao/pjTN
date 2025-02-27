<?php
include('config/database.php');
include('layouts/header.php');
include('layouts/navbar.php');

function displayStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $rating) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
    }
    return $stars;
}

$db = new Database();
$rooms = $db->select("room_types");
$hotel_id = isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0;
$reviews = $db->select("reviews", "hotel_id = $hotel_id");
$hotel = !empty($db->select("hotels", "id = $hotel_id")) ? $db->select("hotels", "id = $hotel_id")[0] : null;

if (!$hotel) {
    die("Khách sạn không tồn tại!");
}
?>

<style>
    p {
        margin-bottom: 15px;
        line-height: 2;
    }
    .box_room {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .img-room {
        border-radius: 8px;
        width: 500px;
        height: 350px;
        overflow: hidden;
    }
    .img-room img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .container {
        width: 60%;
        margin: auto;
    }
    .reviews-section {
        width: 60%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #fff;
    }
    .reviews-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .review-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    .user-info {
        display: flex;
        align-items: center;
        width: 20%;
    }
    .avt {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
        border: 1px solid #e0e0e0;
    }
    .user-info strong {
        font-size: 14px;
        color: #333;
    }
    .review-content {
        flex: 1;
        padding: 0 15px;
    }
    .review-content .stars {
        margin: 0;
        font-size: 14px;
    }
    .review-content p {
        margin: 5px 0;
        color: #333;
        font-size: 14px;
    }
    .review-content small {
        color: #999;
        font-size: 12px;
    }
    .fa-star {
        color: #ee4d2d;
        font-size: 14px;
    }
    .delete-btn a {
        color: #ee4d2d;
        font-size: 14px;
        text-decoration: none;
    }
    .delete-btn a:hover {
        text-decoration: underline;
    }
    .comment-form {
        margin-top: 20px;
    }
    .comment-form label {
        font-size: 14px;
        color: #333;
    }
    .comment-form .form-control {
        border-radius: 4px;
        font-size: 14px;
    }
    .comment-form button {
        background-color: #ee4d2d;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
    }
    .login-prompt {
        text-align: center;
        padding: 20px;
        font-size: 14px;
    }
    .text-success {
        color: #28a745;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .text-danger {
        color: #dc3545;
        font-size: 14px;
        margin-bottom: 10px;
    }
</style>

<div class="heading mt-5 mb-5 text-center">
    <h5><?php echo htmlspecialchars($hotel['address']); ?></h5>
    <h3><?php echo htmlspecialchars($hotel['name']); ?></h3>
</div>

<div class="container">
    <?php foreach ($rooms as $room) : ?>
        <div class="box_room">
            <div class="row">
                <div class="room-container d-flex align-items-center">
                    <div class="img-room">
                        <img src="assets/upload/imgTypeRooms/<?php echo htmlspecialchars($room['photo_url']); ?>" alt="">
                    </div>
                    <div class="inforRoom ms-3">
                        <h3><?php echo htmlspecialchars($room['name']); ?></h3>
                        <p>Price: <?php echo number_format($room['price']); ?> VND/night</p>
                        <p>Bed: <?php echo htmlspecialchars($room['bed_count']); ?></p>
                        <p>Description: <?php echo htmlspecialchars($room['description']); ?></p>
                    </div>
                    <div class="option ms-auto">
                        <a href="roomDetail.php?id=<?php echo htmlspecialchars($room['id']); ?>" class="btn btn-primary">Book now</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="reviews-section">
    <h3>Hotel Reviews</h3>
    <div class="reviews-list">
        <?php foreach ($reviews as $review) : ?>
            <?php
            $user = $db->getById('users', $review['user_id']);
            $user_name = $user ? $user['name'] : 'Khách';
            $profile_picture = $user ? $user['profile_picture'] : 'default.jpg';
            ?>
            <div class="review-item">
                <div class="user-info">
                    <img class="avt" src="assets/upload/avatars/<?php echo htmlspecialchars($profile_picture); ?>" alt="Avatar">
                    <strong><?php echo htmlspecialchars($user_name); ?></strong>
                </div>
                <div class="review-content">
                    <p class="stars"><?php echo displayStars($review['stars']); ?></p>
                    <p><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                </div>
                <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $review['user_id']) : ?>
                    <div class="delete-btn">
                        <a href="action/optionRoomHandle.php?option=deleteReview&review_id=<?php echo $review['id']; ?>&hotel_id=<?php echo $hotel_id; ?>" onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?');">Xóa</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['id'])) : ?>
        <div class="comment-form">
            <h4>Viết đánh giá</h4>
            <?php
            if (isset($_GET['success'])) {
                if ($_GET['success'] === 'review_added') {
                    echo '<p class="text-success">Đánh giá đã được thêm thành công!</p>';
                } elseif ($_GET['success'] === 'review_deleted') {
                    echo '<p class="text-success">Đánh giá đã được xóa thành công!</p>';
                }
            }
            if (isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case 'invalid_input':
                        echo '<p class="text-danger">Dữ liệu không hợp lệ, vui lòng kiểm tra lại!</p>';
                        break;
                    case 'hotel_not_found':
                        echo '<p class="text-danger">Không tìm thấy khách sạn!</p>';
                        break;
                    case 'database_error':
                        echo '<p class="text-danger">Có lỗi xảy ra, vui lòng thử lại!</p>';
                        break;
                    case 'delete_failed':
                        echo '<p class="text-danger">Không thể xóa đánh giá này!</p>';
                        break;
                }
            }
            ?>
            <form action="action/optionRoomHandle.php?option=addReviews" method="POST">
                <div class="mb-3">
                    <label>Đánh giá (1-5 sao):</label>
                    <select name="stars" class="form-control" required>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nội dung:</label>
                    <textarea name="review_text" class="form-control" rows="4" required placeholder="Nhập đánh giá của bạn..."></textarea>
                </div>
                <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars($hotel['id']); ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
            </form>
        </div>
    <?php else : ?>
        <div class="login-prompt">
            <p>Vui lòng <a href="login.php">đăng nhập</a> để viết đánh giá về khách sạn.</p>
        </div>
    <?php endif; ?>
</div>

<?php
$toado_value = $hotel['coordinates'];
include('layouts/footer.php');
?>