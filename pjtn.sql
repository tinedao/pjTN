-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 06:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjtn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(244) NOT NULL,
  `password` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `stars` int(11) DEFAULT NULL,
  `coordinates` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `hotel_type_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `owner_id`, `name`, `address`, `photo`, `stars`, `coordinates`, `description`, `starting_price`, `location_id`, `hotel_type_id`, `status`) VALUES
(13, 3, 'Khách sạn Phú Thọ - Sài Gòn', 'Châu Phong', '654fe6d7b4250cb42f33eec4ea961a43.jpg', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3716.765930633168!2d105.39871297596939!3d21.32026338040293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31348d5162acb801%3A0x80cf111220ae974f!2zS2jDoWNoIHPhuqFuIFPDoGkgR8OybiAtIFBow7ogVGjhu40gKFNhaWdvbnRvdXJpc3QgR3JvdXAp!5e0!3m2!1svi!2s!4v1737440610096!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'trên cả tuyệt vời ngọt như nước suối', 200000.00, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_types`
--

CREATE TABLE `hotel_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_types`
--

INSERT INTO `hotel_types` (`id`, `name`) VALUES
(1, 'Khách sạn'),
(2, 'Homestay'),
(3, 'Nhà nghỉ');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hotel_voucher_info`
-- (See below for the actual view)
--
CREATE TABLE `hotel_voucher_info` (
`hotel_id` int(11)
,`hotel_name` varchar(255)
,`stars` int(11)
,`review_count` bigint(21)
,`code` varchar(255)
,`discount` decimal(10,2)
,`voucher_start_date` date
,`voucher_end_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `toado` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
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
-- Table structure for table `owners`
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
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `username`, `password`, `status`, `email`, `phone`) VALUES
(3, 'tine19', '$2y$10$qXnDG/SAOf5Bc6psVtvAIe2j5jgMIIS4cD1F9.2ndfvnbWz9GFGSm', 1, 'tine.dao19@gmail.com', '0979499802');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
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
-- Triggers `reviews`
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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `rooms`
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
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `bed_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `hotel_id`, `name`, `photo_url`, `description`, `price`, `bed_count`) VALUES
(5, 13, 'Luxury', 'bbf3c9f83d6cf343dbedd00fad03117b.jpg', 'okelahaha\r\n', 200000.00, 4);

--
-- Triggers `room_types`
--
DELIMITER $$
CREATE TRIGGER `update_starting_price` AFTER INSERT ON `room_types` FOR EACH ROW BEGIN
    DECLARE min_price DECIMAL(10, 2);

    -- Tìm giá phòng thấp nhất của loại phòng cho khách sạn liên quan
    SELECT MIN(price) INTO min_price
    FROM room_types
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
-- Stand-in structure for view `room_view`
-- (See below for the actual view)
--
CREATE TABLE `room_view` (
`room_id` int(11)
,`room_name` varchar(255)
,`room_image` varchar(255)
,`room_price` decimal(10,2)
,`room_status` varchar(9)
,`room_description` text
);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_newsletter`
--

CREATE TABLE `subscribe_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `profile_picture`, `email`, `phone_number`) VALUES
(2, 'Đào Quang Tiến', '$2y$10$e2Gso8UGNr0f1FIkhV471eWCtPzfDg9lHcuQvcnfXanNN3e9AY4dO', 'b3495ad5652d095a97b48828d612c83b.jpg', 'tine.dao19@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hotel_details`
-- (See below for the actual view)
--
CREATE TABLE `view_hotel_details` (
`id` int(11)
,`owner_id` int(11)
,`name` varchar(255)
,`address` varchar(255)
,`photo` varchar(255)
,`stars` int(11)
,`coordinates` longtext
,`description` text
,`starting_price` decimal(10,2)
,`location_id` int(11)
,`hotel_type_id` int(11)
,`status` tinyint(4)
,`location_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `hotel_id` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount`, `start_date`, `created_at`, `hotel_id`, `end_date`, `status`) VALUES
(1, 'vip1233', 100.00, '2025-01-25', '2025-01-23 09:43:39', 13, '2025-01-25', 0);

--
-- Triggers `vouchers`
--
DELIMITER $$
CREATE TRIGGER `update_voucher_status_on_insert` BEFORE INSERT ON `vouchers` FOR EACH ROW BEGIN
    IF (NEW.start_date <= CURDATE() AND NEW.end_date >= CURDATE()) THEN
        SET NEW.status = 1; -- Kích hoạt nếu trong khoảng thời gian hợp lệ
    ELSE
        SET NEW.status = 0; -- Không kích hoạt
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_voucher_status_on_update` BEFORE UPDATE ON `vouchers` FOR EACH ROW BEGIN
    IF (NEW.start_date <= CURDATE() AND NEW.end_date >= CURDATE()) THEN
        SET NEW.status = 1; -- Kích hoạt nếu trong khoảng thời gian hợp lệ
    ELSE
        SET NEW.status = 0; -- Không kích hoạt
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `hotel_voucher_info`
--
DROP TABLE IF EXISTS `hotel_voucher_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hotel_voucher_info`  AS SELECT `h`.`id` AS `hotel_id`, `h`.`name` AS `hotel_name`, `h`.`stars` AS `stars`, count(`r`.`id`) AS `review_count`, `v`.`code` AS `code`, `v`.`discount` AS `discount`, `v`.`start_date` AS `voucher_start_date`, `v`.`end_date` AS `voucher_end_date` FROM ((`hotels` `h` left join `reviews` `r` on(`h`.`id` = `r`.`hotel_id`)) left join `vouchers` `v` on(`h`.`id` = `v`.`hotel_id`)) WHERE `v`.`start_date` <= curdate() AND `v`.`end_date` >= curdate() GROUP BY `h`.`id`, `v`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `room_view`
--
DROP TABLE IF EXISTS `room_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `room_view`  AS SELECT `r`.`id` AS `room_id`, `r`.`name` AS `room_name`, `rt`.`photo_url` AS `room_image`, `rt`.`price` AS `room_price`, CASE WHEN exists(select 1 from `bookings` `b` where `b`.`room_id` = `r`.`id` AND curdate() between `b`.`check_in_date` and `b`.`check_out_date` AND `b`.`status` = 1 limit 1) THEN 'Đang thuê' ELSE 'Sẵn sàng' END AS `room_status`, `rt`.`description` AS `room_description` FROM (`rooms` `r` left join `room_types` `rt` on(`r`.`type_id` = `rt`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_hotel_details`
--
DROP TABLE IF EXISTS `view_hotel_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hotel_details`  AS SELECT `hotels`.`id` AS `id`, `hotels`.`owner_id` AS `owner_id`, `hotels`.`name` AS `name`, `hotels`.`address` AS `address`, `hotels`.`photo` AS `photo`, `hotels`.`stars` AS `stars`, `hotels`.`coordinates` AS `coordinates`, `hotels`.`description` AS `description`, `hotels`.`starting_price` AS `starting_price`, `hotels`.`location_id` AS `location_id`, `hotels`.`hotel_type_id` AS `hotel_type_id`, `hotels`.`status` AS `status`, `locations`.`name` AS `location_name` FROM (`hotels` left join `locations` on(`hotels`.`location_id` = `locations`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `fk_bookings_hotel` (`hotel_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `fk_location_id` (`location_id`),
  ADD KEY `fk_hotel_type_id` (`hotel_type_id`);

--
-- Indexes for table `hotel_types`
--
ALTER TABLE `hotel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `subscribe_newsletter`
--
ALTER TABLE `subscribe_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vouchers_hotel_id` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hotel_types`
--
ALTER TABLE `hotel_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribe_newsletter`
--
ALTER TABLE `subscribe_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `fk_hotel_type_id` FOREIGN KEY (`hotel_type_id`) REFERENCES `hotel_types` (`id`),
  ADD CONSTRAINT `fk_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `fk_vouchers_hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
