-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 13, 2025 lúc 04:31 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btl_web_humg`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `is_correct`) VALUES
(1, 1, 'OpenProject', 1),
(2, 1, 'Microsoft Project', 0),
(3, 1, 'Primavera', 0),
(4, 1, 'Basecamp', 0),
(5, 2, 'Oracle', 0),
(6, 2, 'MariaDB', 1),
(7, 2, 'IBM DB2', 0),
(8, 2, 'Microsoft Access', 0),
(9, 3, 'Adobe Illustrator', 0),
(10, 3, 'Inkscape', 1),
(11, 3, 'CorelDRAW', 0),
(12, 3, 'Affinity Designer', 0),
(13, 4, 'Windows', 0),
(14, 4, 'macOS', 0),
(15, 4, 'Debian', 1),
(16, 4, 'iOS', 0),
(17, 5, 'Opera PMS', 0),
(18, 5, 'Cloudbeds', 0),
(19, 5, 'OpenHotel', 1),
(20, 5, 'Amadeus Hospitality', 0),
(21, 6, 'Adobe Audition', 0),
(22, 6, 'Audacity', 1),
(23, 6, 'FL Studio', 0),
(24, 6, 'Pro Tools', 0),
(25, 7, 'VLC Media Player', 0),
(26, 7, 'GIMP', 0),
(27, 7, 'Adobe Premiere Pro', 1),
(28, 7, 'Blender', 0),
(29, 8, 'Wix', 0),
(30, 8, 'Squarespace', 0),
(31, 8, 'Drupal', 1),
(32, 8, 'Webflow', 0),
(33, 9, 'Final Cut Pro', 0),
(34, 9, 'Adobe Premiere Pro', 0),
(35, 9, 'OpenShot', 1),
(36, 9, 'DaVinci Resolve', 0),
(37, 10, 'Ubuntu', 0),
(38, 10, 'Fedora', 0),
(39, 10, 'FreeBSD', 1),
(40, 10, 'Manjaro', 0),
(153, 53, '1', 0),
(154, 53, '2', 1),
(155, 53, '3', 0),
(156, 53, '4', 0),
(157, 54, 'Văn lang', 1),
(158, 54, 'Âu lạc', 0),
(159, 54, 'Việt Nam', 0),
(160, 54, 'Trung Quốc', 0),
(161, 55, '1', 0),
(162, 55, '2', 0),
(163, 55, '3', 1),
(164, 55, '4', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_token`
--

CREATE TABLE `login_token` (
  `TOKEN_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `EXPIRES_AT` datetime NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login_token`
--

INSERT INTO `login_token` (`TOKEN_ID`, `USER_ID`, `TOKEN`, `EXPIRES_AT`, `CREATED_AT`, `UPDATED_AT`) VALUES
(16, 3, '9270eb98c7337402eb2d48e2ec3077ef9207b785', '0000-00-00 00:00:00', '2024-12-26 21:38:21', '2024-12-27 03:38:21'),
(19, 3, '45d2c0ad3a6262d84bdc967a9c8a4b2d34e3136e', '0000-00-00 00:00:00', '2025-01-03 04:36:43', '2025-01-03 10:36:43'),
(21, 3, 'e864bf31fc92026d388387d282376a535c75a2b4', '0000-00-00 00:00:00', '2025-01-12 01:58:24', '2025-01-12 07:58:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `question`, `subject_id`) VALUES
(1, 'Phần mềm mã nguồn mở nào được sử dụng để quản lý dự án?', 8),
(2, 'Hệ quản trị cơ sở dữ liệu nào sau đây là mã nguồn mở?', 8),
(3, 'Phần mềm mã nguồn mở nào được sử dụng để tạo và chỉnh sửa vector đồ họa?', 8),
(4, 'Trong các hệ điều hành sau, hệ điều hành nào là mã nguồn mở?', 8),
(5, 'Phần mềm mã nguồn mở nào được sử dụng để quản lý khách sạn?', 8),
(6, 'Phần mềm mã nguồn mở nào được sử dụng để tạo và chỉnh sửa âm thanh?', 8),
(7, 'Trong các phần mềm sau, phần mềm nào không phải là mã nguồn mở?', 8),
(8, 'Hệ thống quản lý nội dung (CMS) nào sau đây là mã nguồn mở?', 8),
(9, 'Phần mềm mã nguồn mở nào được sử dụng để tạo và chỉnh sửa video?', 8),
(10, 'Trong các hệ điều hành sau, hệ điều hành nào không phải là bản phân phối của Linux?', 8),
(53, '1 + 1 = ?', 1),
(54, 'Nhà nước đầu tiên của nước ta là gì?', 3),
(55, '1+2 = ?', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `score`
--

CREATE TABLE `score` (
  `ID` int(11) NOT NULL,
  `POINT` int(11) NOT NULL,
  `QUESTIONS` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `score`
--

INSERT INTO `score` (`ID`, `POINT`, `QUESTIONS`, `CREATED_AT`) VALUES
(68, 1, 2, '2025-01-13 02:37:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name_subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `name_subject`) VALUES
(1, 'Toán'),
(2, 'Văn'),
(3, 'Lịch sử'),
(4, 'Địa lí'),
(5, 'Giáo dục công dân'),
(6, 'Sinh học'),
(7, 'Hóa học'),
(8, 'Mã nguồn mở'),
(9, 'Tiếng anh'),
(10, 'Khác');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `FORGOT_TOKEN` varchar(255) DEFAULT NULL,
  `ACTIVE_TOKEN` varchar(255) DEFAULT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `PHONE`, `PASSWORD`, `FORGOT_TOKEN`, `ACTIVE_TOKEN`, `STATUS`, `CREATED_AT`, `UPDATED_AT`) VALUES
(3, 'Dung', 'Dammm1221', 'tragiccoffee@freesourcecodes.com', '0987654321', '$2y$10$4gZklhO4bVPByrpdBKD2Ee5XjdPOgyQ4OUQTQqmSV3gS.tJuMzCwO', NULL, '', 1, '2024-12-23 02:10:04', '2025-01-03 15:30:50'),
(4, 'Dung', 'Dammm', 'trangngoc@gmail.com', '0987654321', '$2y$10$GlzCLOhl7g4rBN9YtQLVjuprgQNAn8a27daYGiYpxm6G3uy0slK3e', NULL, '', 1, '2024-12-25 03:38:47', '2025-01-03 15:28:57');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_ibfk_1` (`question_id`);

--
-- Chỉ mục cho bảng `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`TOKEN_ID`),
  ADD UNIQUE KEY `TOKEN` (`TOKEN`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Chỉ mục cho bảng `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT cho bảng `login_token`
--
ALTER TABLE `login_token`
  MODIFY `TOKEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `score`
--
ALTER TABLE `score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
