-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 12:41 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `ap_date` varchar(255) NOT NULL,
  `ap_time` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `user_id`, `doctor_id`, `ap_date`, `ap_time`, `created_at`, `status`) VALUES
(1, 1, 1, '4', '4', '2022-04-22 03:25:30', 1),
(2, 1, 21, 'dsfg', 'sadf', '2022-04-22 03:53:02', 0),
(3, 1, 21, 'dsfg', 'sadf', '2022-04-22 03:53:26', 0),
(4, 0, 21, '2022-04-27', '20:00:00', '2022-04-22 03:55:14', 0),
(5, 0, 21, '2022-04-27', '20:00:00', '2022-04-22 03:57:34', 0),
(6, 0, 21, '2022-04-27', '20:00:00', '2022-04-22 03:58:24', 0),
(7, 0, 21, '2022-04-27', '20:00:00', '2022-04-22 03:58:43', 0),
(8, 0, 21, '2022-04-27', '20:00:00', '2022-04-22 03:58:53', 0),
(9, 0, 21, '2022-04-26', '20:15:00', '2022-04-22 03:59:05', 0),
(10, 0, 21, '2022-04-26', '20:15:00', '2022-04-22 04:00:04', 0),
(11, 0, 21, '2022-04-25', '20:00:00', '2022-04-22 04:00:19', 0),
(12, 4, 21, '2022-04-25', '20:00:00', '2022-04-22 04:01:55', 0),
(13, 4, 21, '2022-04-23', '20:30:00', '2022-04-22 04:03:04', 0),
(14, 0, 21, '2022-04-24', '20:00:00', '2022-04-22 04:09:56', 0),
(15, 4, 21, '2022-04-25', '19:45:00', '2022-04-22 04:10:57', 0),
(16, 4, 21, '2022-04-24', '20:00:00', '2022-04-22 04:13:37', 0),
(17, 4, 21, '2022-04-24', '19:45:00', '2022-04-22 04:14:01', 0),
(18, 4, 21, '2022-04-22', '19:00:00', '2022-04-22 04:14:23', 0),
(19, 4, 21, '2022-04-24', '19:00:00', '2022-04-22 04:43:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `doctor_details` tinyint(1) DEFAULT NULL,
  `employee_details` tinyint(1) DEFAULT NULL,
  `admin_details` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `user_id`, `f_name`, `l_name`, `address`, `sex`, `phone`, `doctor_details`, `employee_details`, `admin_details`) VALUES
(1, 1, 'firoj', 'uddin', '5a,ka-121,nurani maszid road, joar shahara, dhaka 1229\r\nprogoti soroni.', 'female', '01631330094', 1, NULL, NULL),
(3, 3, 'richa', 'Kal', 'washington', 'female', '5644568456', NULL, NULL, 1),
(8, 4, 'none', ' too', 'asdfas', 'male', '1015485', NULL, NULL, NULL),
(9, 0, 'firoj', 'dafsfsda', 'nurani maszid road\r\n5c,ka-121', 'male', '01631330094', NULL, NULL, NULL),
(11, 14, 'tonny', 'uddin', '5a,ka-121,nurani maszid road, joar shahara, dhaka 1229\r\nprogoti soroni.', 'other', '01631330094', NULL, NULL, NULL),
(18, 21, 'firoj', 'uddin', '5a,ka-121,nurani maszid road, joar shahara, dhaka 1229\r\nprogoti soroni.', 'male', '01631330094', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialist_at` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `fees` int(11) NOT NULL,
  `off_day` varchar(255) NOT NULL,
  `starting_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialist_at`, `room_no`, `fees`, `off_day`, `starting_time`, `end_time`) VALUES
(6, 21, 1, '406', 5000, 'friday', '19:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doc_department`
--

CREATE TABLE `doc_department` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doc_specialist`
--

CREATE TABLE `doc_specialist` (
  `id` int(11) NOT NULL,
  `specialist_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doc_specialist`
--

INSERT INTO `doc_specialist` (`id`, `specialist_at`) VALUES
(1, 'Anatomy'),
(2, 'Biochemistry'),
(3, 'Cardiology'),
(4, 'Children'),
(5, 'Dental');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@a.com', 'admin', '2022-03-24 04:50:42', '2022-03-24 04:50:42'),
(3, 2, 'employee@a.com', 'employee', '2022-03-23 04:51:57', '2022-03-24 04:51:57'),
(4, 4, 'user@a.com', 'user', '2022-03-24 04:51:57', '2022-03-24 04:51:57'),
(12, 4, 'pan@a.com', 'pan', '2022-03-25 09:38:49', '2022-03-25 09:38:49'),
(14, 4, 'pan@gmail.com', 'tonny', '2022-03-25 09:51:28', '2022-03-25 09:51:28'),
(16, 4, 'user2@a.com', 'user2', '2022-04-09 10:28:37', '2022-04-09 10:28:37'),
(21, 3, 'doc1@a.com', 'doc', '2022-04-21 12:53:29', '2022-04-21 12:53:29'),
(22, 3, 'doctor@a.com', '', '2022-04-21 13:48:47', '2022-04-21 13:48:47'),
(24, 3, 'firoj.uddin2580@gmail.com', 'admin', '2022-04-21 14:03:59', '2022-04-21 14:03:59'),
(26, 3, 'doc2@a.com', '', '2022-04-21 14:05:37', '2022-04-21 14:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `type`, `role_id`) VALUES
(1, 'admin', 'admin', 11202),
(2, 'employee', 'employee', 11206),
(3, 'dectors', 'dectors', 11205),
(4, 'users', 'users', 11209);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `doc_department`
--
ALTER TABLE `doc_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_specialist`
--
ALTER TABLE `doc_specialist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doc_department`
--
ALTER TABLE `doc_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_specialist`
--
ALTER TABLE `doc_specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
