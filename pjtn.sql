-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 15, 2025 lúc 06:31 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pjtn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(244) NOT NULL,
  `password` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `stars` int(11) DEFAULT NULL,
  `coordinates` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `hotel_type_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`id`, `owner_id`, `name`, `address`, `photo`, `stars`, `coordinates`, `description`, `starting_price`, `location_id`, `hotel_type_id`, `status`) VALUES
(2, 3, 'hehe', 'việt trì', 'z6150677292865_6ea552a6b31a44512d9667f3b08a0aa8.jpg', 4, 'sss', 'sdsss', NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel_types`
--

CREATE TABLE `hotel_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel_types`
--

INSERT INTO `hotel_types` (`id`, `name`) VALUES
(1, 'Khách sạn'),
(2, 'Homestay'),
(3, 'Nhà nghỉ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `toado` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
--

INSERT INTO `locations` (`id`, `name`, `toado`) VALUES
(1, 'Thành phố Việt Trì', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59463.381119044636!2d105.33240040324908!3d21.33229148068744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134f2eb1dad94af%3A0x50d55a18854eee20!2zVHAuIFZp4buHdCBUcsOsLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736747777448!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(2, 'Thị xã Phú Thọ', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59463.381119044636!2d105.33240040324908!3d21.33229148068744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31349ac6c4ecd49b%3A0xb2a8129b203912ca!2zVHguIFBow7ogVGjhu40sIFBow7ogVGjhu40sIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1736747925038!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(3, 'Huyện Đoan Hùng', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118696.56046598138!2d105.06470607220085!3d21.61449700826672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134a3ec34421fd9%3A0x94062c4a307beed!2zxJBvYW4gSMO5bmcsIFBow7ogVGjhu40sIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1736747944961!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(4, 'Huyện Hạ Hòa', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118696.56046598138!2d105.06470607220085!3d21.61449700826672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31335fa484fff351%3A0x6d8c49c1598d25c2!2zSOG6oSBIw7JhLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736747961135!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(5, 'Huyện Thanh Ba', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118830.83735084723!2d105.07228511813092!3d21.450316182309884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313499642be1c0cd%3A0x71d01c6d8b2bc39d!2zVGhhbmggQmEsIFBow7ogVGjhu40sIFZp4bu'),
(6, 'Huyện Phù Ninh', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118830.83735084723!2d105.07228511813092!3d21.450316182309884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31349699a106df97%3A0x9290c8df6a7a02f8!2zUGjDuSBOaW5oLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736747987362!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(7, 'Huyện Yên Lập', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d237789.81192906946!2d104.8606266670857!3d21.37155591118057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313362afa30194a7%3A0xf68cc521d1615f37!2zWcOqbiBM4bqtcCwgUGjDuiBUaOG7jSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1736748001810!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(8, 'Huyện Cẩm Khê', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118885.03112637714!2d105.00973891648825!3d21.3837131828194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31349ce609aae285%3A0xacd51c9f8a6b539a!2zQ-G6qW0gS2jDqiwgUGjDuiBUaOG7jSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1736748017172!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(9, 'Huyện Tam Nông', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118948.17523199742!2d105.17014541457421!3d21.305860141998373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31348fa4eb38aced%3A0xe59ea21210b4c8!2zVGFtIE7DtG5nLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736748030340!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(10, 'Huyện Lâm Thao', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118948.17523199742!2d105.17014541457421!3d21.305860141998373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31348e051a270c6d%3A0xa85af77e118fcfe0!2zTMOibSBUaGFvLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736748050654!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(11, 'Huyện Thanh Sơn', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238249.75243607687!2d105.02617553805189!3d21.086541731059995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31347c93e4c2ec3b%3A0x66135b25da929521!2zVGhhbmggU8ahbiwgUGjDuiBUaOG7jSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1736748086542!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(12, 'Huyện Thanh Thủy', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119095.62201238865!2d105.20814506010468!3d21.123001631577775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313462409d26e58b%3A0x62659ef7249ab3d2!2zVGhhbmggVGjhu6d5LCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736748101305!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(13, 'Huyện Tân Sơn', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238083.74795629366!2d104.8023483485314!3d21.189832464896245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31337f66de8827c9%3A0x87de565272dae9e5!2zVMOibiBTxqFuLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736748114868!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `owners`
--

INSERT INTO `owners` (`id`, `username`, `password`, `status`, `email`, `phone`) VALUES
(3, 'tine19', '$2y$10$qXnDG/SAOf5Bc6psVtvAIe2j5jgMIIS4cD1F9.2ndfvnbWz9GFGSm', 1, 'tine.dao19@gmail.com', '0979499802');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `hotel_id`, `user_id`, `stars`, `review_text`, `created_at`) VALUES
(1, 2, 2, 5, 'Khách sạn tuyệt vời!', '2025-01-13 03:59:18'),
(2, 2, 2, 4, 'Dịch vụ tốt và phòng sạch sẽ.', '2025-01-13 03:59:18');

--
-- Bẫy `reviews`
--
DELIMITER $$
CREATE TRIGGER `update_hotel_stars` AFTER INSERT ON `reviews` FOR EACH ROW BEGIN
    DECLARE new_avg_stars FLOAT;

    -- Tính toán số sao trung bình mới
    SELECT AVG(stars) INTO new_avg_stars
    FROM reviews
    WHERE hotel_id = NEW.hotel_id;

    -- Cập nhật trường stars trong bảng hotels
    UPDATE hotels
    SET stars = new_avg_stars
    WHERE id = NEW.hotel_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bẫy `rooms`
--
DELIMITER $$
CREATE TRIGGER `update_starting_price_rooms` AFTER INSERT ON `rooms` FOR EACH ROW BEGIN
    DECLARE min_price DECIMAL(10, 2);

    -- Tính giá phòng rẻ nhất
    SELECT MIN(price) INTO min_price
    FROM rooms
    WHERE hotel_id = NEW.hotel_id;

    -- Cập nhật trường starting_price trong bảng hotels
    UPDATE hotels
    SET starting_price = min_price
    WHERE id = NEW.hotel_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_starting_price_rooms_update` AFTER UPDATE ON `rooms` FOR EACH ROW BEGIN
    DECLARE min_price DECIMAL(10, 2);

    -- Tính giá phòng rẻ nhất
    SELECT MIN(price) INTO min_price
    FROM rooms
    WHERE hotel_id = NEW.hotel_id;

    -- Cập nhật trường starting_price trong bảng hotels
    UPDATE hotels
    SET starting_price = min_price
    WHERE id = NEW.hotel_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribe_newsletter`
--

CREATE TABLE `subscribe_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `profile_picture`, `email`, `phone_number`) VALUES
(2, 'Đào Quang Tiến', '$2y$10$e2Gso8UGNr0f1FIkhV471eWCtPzfDg9lHcuQvcnfXanNN3e9AY4dO', 'b3495ad5652d095a97b48828d612c83b.jpg', 'tine.dao19@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `fk_location_id` (`location_id`),
  ADD KEY `fk_hotel_type_id` (`hotel_type_id`);

--
-- Chỉ mục cho bảng `hotel_types`
--
ALTER TABLE `hotel_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Chỉ mục cho bảng `subscribe_newsletter`
--
ALTER TABLE `subscribe_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `hotel_types`
--
ALTER TABLE `hotel_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subscribe_newsletter`
--
ALTER TABLE `subscribe_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Các ràng buộc cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `fk_hotel_type_id` FOREIGN KEY (`hotel_type_id`) REFERENCES `hotel_types` (`id`),
  ADD CONSTRAINT `fk_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `room_types` (`id`);

--
-- Các ràng buộc cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
