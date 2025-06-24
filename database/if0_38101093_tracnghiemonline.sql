-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql211.infinityfree.com
-- Generation Time: Jun 24, 2025 at 06:10 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38101093_tracnghiemonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
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
(169, 57, '1', 0),
(170, 57, '2', 0),
(171, 57, '3', 1),
(172, 57, '4', 0),
(173, 58, '1', 0),
(174, 58, '2', 0),
(175, 58, '3', 0),
(176, 58, '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `TOKEN_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `EXPIRES_AT` datetime NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`TOKEN_ID`, `USER_ID`, `TOKEN`, `EXPIRES_AT`, `CREATED_AT`, `UPDATED_AT`) VALUES
(26, 4, '5306b124309b35d4f2d34847c5506b6b3c2e2e22', '0000-00-00 00:00:00', '2025-01-17 08:08:47', '2025-01-17 05:08:47'),
(31, 4, '78a1b772fa6c1f5b18cc1e2112a6c4dc086ced3a', '0000-00-00 00:00:00', '2025-01-18 06:36:13', '2025-01-18 03:36:13'),
(32, 9, '074784c7535464ac416404b7b15ed17bce65738e', '0000-00-00 00:00:00', '2025-02-24 11:29:55', '2025-02-24 08:29:55'),
(33, 4, 'efacd2de42c924d5c09ecb227ba40c96e5c35e92', '0000-00-00 00:00:00', '2025-04-11 12:59:49', '2025-04-11 09:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
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
(57, '1 + 2 = ?', 1),
(58, '1 + 3 = ?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `ID` int(11) NOT NULL,
  `POINT` int(11) NOT NULL,
  `QUESTIONS` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`ID`, `POINT`, `QUESTIONS`, `CREATED_AT`) VALUES
(68, 1, 2, '2025-01-13 02:37:26'),
(69, 1, 1, '2025-01-15 15:30:06'),
(70, 1, 1, '2025-01-17 04:49:18'),
(71, 2, 2, '2025-01-17 04:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name_subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
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
-- Table structure for table `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `PHONE`, `PASSWORD`, `FORGOT_TOKEN`, `ACTIVE_TOKEN`, `STATUS`, `CREATED_AT`, `UPDATED_AT`) VALUES
(3, 'Du', 'Con', 'tragiccoffee@freesourcecodes.com', '0987654321', '$2y$10$1NZleZsyYoacfF5wxhRhzOitb1hPL3Db81e7qaIDXlFwsTQQUY2VG', NULL, '', 1, '2024-12-23 02:10:04', '2025-01-17 07:37:34'),
(4, 'Dung', 'Dammm', 'trangngoc@gmail.com', '0987654321', '$2y$10$GlzCLOhl7g4rBN9YtQLVjuprgQNAn8a27daYGiYpxm6G3uy0slK3e', NULL, '', 1, '2024-12-25 03:38:47', '2025-01-03 15:28:57'),
(6, 'Dung', 'Dam', 'deptraino1vn@gmail.com', '0123456789', '$2y$10$U/NIXObLi.LeJUj0xG93p.IyZHh1DreVXWs9C46qQY.C67OPLoxKe', '', '', 1, '2025-01-17 07:58:47', '2025-01-17 08:01:23'),
(7, 'đức thắng ', 'vũ ', 'vuduct728@gmail.com', '0941069975', '$2y$10$M.Jg5g3pqAB1Qd4YrgXvDuFpL0tT0LDGQrhQd.vfHNhQYXDq73B7a', NULL, '33bb4c54ddbe5c6c98120266caf3a1235ac20e4c', 0, '2025-01-18 10:41:02', '2025-01-18 07:41:02'),
(8, 'đức thắng ', 'vũ ', 'vuduct2604@gmail.com', '0941069975', '$2y$10$S2/thKjG1c06jN2lHwMojO7T5p1H1eezrVL.dcYGc/VguOdTDKUP6', NULL, '980da3294f98c00c6b67f99ab34c2ffd5e5ba50e', 0, '2025-01-18 10:42:16', '2025-01-18 07:42:16'),
(9, 'Dung', 'Dam', '77clinical@e-record.com', '0987654321', '$2y$10$/CbII.0KW1bkZKrvMoiDsuL4AYtpiZF5J/5rmY7jaH2eu9zEkYWUu', NULL, '', 1, '2025-02-22 09:54:32', '2025-02-24 08:29:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_ibfk_1` (`question_id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`TOKEN_ID`),
  ADD UNIQUE KEY `TOKEN` (`TOKEN`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `TOKEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
