-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2026 at 05:12 AM
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
-- Database: `gogreen`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bins`
--

CREATE TABLE `bins` (
  `id` int(11) NOT NULL,
  `bin_name` varchar(100) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bin_type` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive','full') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bins`
--

INSERT INTO `bins` (`id`, `bin_name`, `latitude`, `longitude`, `address`, `bin_type`, `status`, `created_at`) VALUES
(14, 'Pusat Sukan UTeM', 2.31671500, 102.32073900, '', 'Mixed Recyclable', '', '2026-06-22 17:20:07'),
(15, 'Cafe Satria', 2.31001000, 102.31498400, '', 'Mixed Recyclable', '', '2026-06-22 17:20:27'),
(16, 'Fakulti Teknologi dan Komunikasi', 2.30812800, 102.31930300, '', 'Mixed Recyclable', '', '2026-06-22 17:20:56'),
(17, 'Masjid', 2.31185300, 102.31873000, '', 'Mixed Recyclable', '', '2026-06-23 01:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard_logs`
--

CREATE TABLE `leaderboard_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points_added` int(11) DEFAULT 0,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_posts`
--

CREATE TABLE `media_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `media_type` enum('Poster','Video','Ad') DEFAULT 'Poster',
  `audience` enum('Everyone','Users','Workers') DEFAULT 'Everyone',
  `youtube_link` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_posts`
--

INSERT INTO `media_posts` (`id`, `title`, `content`, `image`, `created_by`, `created_at`, `media_type`, `audience`, `youtube_link`) VALUES
(12, 'Earth day Go Green', 'Save The Earth', '1782149241_images (2).jpg', 15, '2026-06-22 17:27:21', 'Poster', 'Everyone', ''),
(13, 'Go Green,Save Energy', 'Protect Earth', '1782149310_images (3).jpg', 15, '2026-06-22 17:28:30', 'Poster', 'Everyone', ''),
(14, ' TONG SAMPAH KITAR SEMULA', 'Created using Powtoon', '1782149401_images (4).jpg', 15, '2026-06-22 17:30:01', 'Poster', 'Everyone', 'https://youtu.be/Wr3YgrYhWVE?si=Fhoy_J8AEpfDRMNW');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `waste_type` varchar(100) DEFAULT NULL,
  `estimated_weight` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','accepted','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recycle_submissions`
--

CREATE TABLE `recycle_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `waste_type` varchar(100) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `points_earned` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected','picked_up') DEFAULT 'pending',
  `admin_remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recycle_submissions`
--

INSERT INTO `recycle_submissions` (`id`, `user_id`, `waste_type`, `weight`, `image`, `location`, `pickup_date`, `pickup_time`, `points_earned`, `status`, `admin_remark`, `created_at`) VALUES
(8, 13, 'plastic', 33.00, '1782133686_download.jpg', 'FTMK Recycle Bin', '2026-06-18', '12:08:00', 330, 'approved', NULL, '2026-06-22 13:08:06'),
(9, 13, 'plastic', 20.00, '', 'FTMK Recycle Bin', '2026-06-23', '22:15:00', 200, 'approved', NULL, '2026-06-22 14:11:20'),
(10, 13, 'paper', 20.00, '1782144549_download.jpg', 'MASJID', '0000-00-00', '00:00:00', 200, 'approved', NULL, '2026-06-22 16:09:09'),
(11, 17, 'paper', 1.00, '1782176430_images (3).jpg', 'Fakulti Teknologi dan Komunikasi', '0000-00-00', '00:00:00', 10, 'approved', NULL, '2026-06-23 01:00:30'),
(18, 13, 'plastic', 10.00, '1782441713_images (4).jpg', 'Pusat Sukan UTeM', '0000-00-00', '00:00:00', 0, 'pending', NULL, '2026-06-26 02:41:53'),
(19, 13, 'paper', 10.00, '1782441713_images (4).jpg', 'Pusat Sukan UTeM', '0000-00-00', '00:00:00', 0, 'pending', NULL, '2026-06-26 02:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `report_type` enum('Contact','Pickup') NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Assigned','In Progress','Completed','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `worker_id`, `name`, `email`, `phone`, `report_type`, `subject`, `message`, `location`, `status`, `created_at`) VALUES
(1, 13, 16, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Contact', 'www', 'ww', 'tt', 'Completed', '2026-06-22 09:01:16'),
(2, 15, 16, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Pickup', 'ww', 'ww', 'www', 'Completed', '2026-06-22 09:17:55'),
(3, 15, 2, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Contact', 'ww', 'ww', 'ww', 'Assigned', '2026-06-22 09:18:01'),
(4, 13, 16, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Contact', 'aaa', 'aaaa', 'aaa', 'Completed', '2026-06-22 09:38:24'),
(5, 13, 16, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Contact', 'dd', 'dd', '0', 'Completed', '2026-06-22 09:48:20'),
(6, 13, 16, 'FAHRUL AZWAN BIN MONJAMIL', 'd032410282@student.utem.edu.my', '0149124116', 'Contact', 'qqq', 'qq', 'qqq', 'Completed', '2026-06-22 10:12:03'),
(7, 13, NULL, 'FAHRUL AZWAN BIN MONJAMIL', 'fahrulazwan89@gmail.com', '0149124116', 'Contact', 'ww', '', '0', 'Pending', '2026-06-23 12:17:02'),
(8, 15, NULL, 'terimakasih', 'ahhhh@yahoo.com', 'Boboiboymental_00!', 'Pickup', 'Meletop', '', 'Johor lama', 'Pending', '2026-06-23 12:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `reward_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `points_required` int(11) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `reward_name`, `description`, `points_required`, `stock`, `image`, `status`, `created_at`) VALUES
(1, 'RM5 Grab Voucher', '', 100, 10, 'grab.jpg', 'available', '2026-06-06 12:38:48'),
(8, '1 - Tuah Indeks', 'Mencorak pencapaian unggul mahasiswa secara holistik menerusi kaedah TUAH Index.', 10, 1000, '1782149078_download (1).jpg', 'available', '2026-06-22 17:24:38'),
(9, '10 - Tuah Indeks', 'Mencorak pencapaian unggul mahasiswa secara holistik menerusi kaedah TUAH Index.', 100, 100, '1782149113_download (1).jpg', 'available', '2026-06-22 17:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `reward_redeems`
--

CREATE TABLE `reward_redeems` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_points` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `redeem_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `serial_number` varchar(50) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward_redeems`
--

INSERT INTO `reward_redeems` (`id`, `user_id`, `reward_id`, `quantity`, `total_points`, `status`, `redeem_date`, `serial_number`, `approved_at`, `approved_by`) VALUES
(9, 13, 1, 1, 100, 'approved', '2026-06-22 11:20:20', NULL, NULL, NULL),
(11, 13, 1, 1, 100, 'pending', '2026-06-22 14:14:52', NULL, NULL, NULL),
(14, 13, 1, 1, 100, 'approved', '2026-06-22 15:38:36', NULL, NULL, NULL),
(15, 13, 1, 1, 100, 'rejected', '2026-06-22 16:09:18', NULL, NULL, NULL),
(16, 13, 8, 1, 10, 'approved', '2026-06-22 17:52:29', 'GG-20260622-0016', '2026-06-23 01:53:16', 15),
(17, 13, 1, 1, 100, 'approved', '2026-06-22 17:52:31', 'GG-20260622-0017', '2026-06-23 01:52:47', 15),
(18, 17, 8, 1, 10, 'approved', '2026-06-23 01:13:21', 'GG-20260623-0018', '2026-06-23 09:15:08', 15);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_description` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `status` enum('pending','ongoing','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `worker_id`, `task_title`, `task_description`, `location`, `schedule_date`, `schedule_time`, `priority`, `status`, `created_at`, `end_time`) VALUES
(1, 2, 'ss', 's', 'ss', '2026-06-24', '12:04:00', 'medium', 'pending', '2026-06-22 04:01:22', NULL),
(2, 16, 'ww', '2', '0', '2026-06-18', '14:05:00', 'medium', 'pending', '2026-06-22 04:05:39', NULL),
(3, 16, 'collect bin', 'pls update stat', 'bin1', '2026-06-22', '14:37:00', 'low', 'completed', '2026-06-22 06:38:03', NULL),
(4, 16, 'collect bin', 'cek pending', 'bin2', '2026-06-22', '14:38:00', 'high', 'completed', '2026-06-22 06:38:25', NULL),
(5, 16, 'bin rosak', 'bin', 'library', '2026-06-23', '09:17:00', 'high', 'pending', '2026-06-23 01:18:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matric_id` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','worker','user') DEFAULT 'user',
  `faculty` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default.png',
  `points` int(11) DEFAULT 0,
  `address` text DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `matric_id`, `phone`, `password`, `role`, `faculty`, `profile_image`, `points`, `address`, `email_verified`, `otp_code`, `otp_expiry`, `status`, `created_at`) VALUES
(1, 'Administrator', 'admin', 'admin@utem.edu.my', 'A000000001', '0123456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administration', 'default.png', 0, NULL, 1, NULL, NULL, 'active', '2026-06-06 12:38:48'),
(2, 'GoGreen Worker', 'worker', 'worker@utem.edu.my', 'W000000001', '0111111111', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'worker', 'GoGreen Unit', 'default.png', 0, NULL, 1, NULL, NULL, 'active', '2026-06-06 12:38:48'),
(3, 'Test User', 'testuser', 'b032410001@student.utem.edu.my', 'B032410001', '0100000000', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'FTMK', 'default.png', 150, NULL, 1, NULL, NULL, 'active', '2026-06-06 12:38:48'),
(13, 'Azwan', 'wan', 'd032410282@student.utem.edu.my', 'd032410282', NULL, '$2y$10$VR.dZzfqLmfpQnS9shPM4ecNENKGhPKbtNGgtAnTQ3AY.GZk2U44.', 'user', 'FTMK', '1782151289_9877.jpg', 2, NULL, 0, NULL, NULL, 'active', '2026-06-22 02:16:59'),
(15, 'wan', 'wan1', 'wan@utem.edu.my', 'd032410287', NULL, '$2y$10$rSBqsKf5tKGLWwA3y7ABzu2MJUfMFIbkdHK9Rm/wU7XXG2WORmjLS', 'admin', '', '1782143812_1108.jpg', 0, NULL, 0, NULL, NULL, 'active', '2026-06-22 02:35:40'),
(16, 'fahrul', 'fahrul', 'fahrul@utem.edu.my', 'd032410283', NULL, '$2y$10$tmv94EwoMLFSqQX6onpxX.UBRI1cOYR69VLsvdwX43gR1F9NwLdR6', 'worker', NULL, '1782146019_1933.jpg', 0, NULL, 0, NULL, NULL, 'active', '2026-06-22 04:03:06'),
(17, 'Datu Amirul', 'Datu', 'd032410441@student.utem.edu.my', 'd032410441', NULL, '$2y$10$/Z4bLwr1Wf5MA.JmvHrlHObjPsiuN91ErgTo6TodVMlJy9x6jw8ne', 'user', NULL, 'default.png', 10, NULL, 0, NULL, NULL, 'active', '2026-06-23 00:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_notifications` tinyint(1) DEFAULT 1,
  `push_notifications` tinyint(1) DEFAULT 1,
  `weekly_digest` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker_routine`
--

CREATE TABLE `worker_routine` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `schedule_time` time NOT NULL,
  `priority` enum('low','medium','high') DEFAULT 'medium'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_routine`
--

INSERT INTO `worker_routine` (`id`, `worker_id`, `task_title`, `location`, `schedule_time`, `priority`) VALUES
(1, 16, 'Collect Bin', 'FTMK Bin', '08:00:00', 'medium'),
(2, 16, 'Collect Bin', 'Library Bin', '10:00:00', 'medium'),
(3, 16, 'Collect Bin', 'Cafeteria Bin', '14:00:00', 'low'),
(4, 16, 'collect bin', 'library', '09:16:00', 'low');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bins`
--
ALTER TABLE `bins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaderboard_logs`
--
ALTER TABLE `leaderboard_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `media_posts`
--
ALTER TABLE `media_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recycle_submissions`
--
ALTER TABLE `recycle_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_redeems`
--
ALTER TABLE `reward_redeems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `matric_id` (`matric_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_routine`
--
ALTER TABLE `worker_routine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bins`
--
ALTER TABLE `bins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaderboard_logs`
--
ALTER TABLE `leaderboard_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_posts`
--
ALTER TABLE `media_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recycle_submissions`
--
ALTER TABLE `recycle_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reward_redeems`
--
ALTER TABLE `reward_redeems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker_routine`
--
ALTER TABLE `worker_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `leaderboard_logs`
--
ALTER TABLE `leaderboard_logs`
  ADD CONSTRAINT `leaderboard_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_posts`
--
ALTER TABLE `media_posts`
  ADD CONSTRAINT `media_posts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD CONSTRAINT `pickup_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recycle_submissions`
--
ALTER TABLE `recycle_submissions`
  ADD CONSTRAINT `recycle_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reward_redeems`
--
ALTER TABLE `reward_redeems`
  ADD CONSTRAINT `reward_redeems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reward_redeems_ibfk_2` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
