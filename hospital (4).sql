-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 02:08 PM
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
(1, 4, 21, '2022-03-17', '20:50:21', '2022-04-22 03:25:30', 1),
(3, 12, 22, '2022-02-21', '13:17:24', '2022-03-18 03:53:26', 1),
(4, 4, 24, '2022-02-01', '18:20:43', '2022-02-02 03:55:14', 0),
(5, 16, 26, '2022-02-20', '22:16:26', '2022-03-15 03:57:34', 1),
(6, 14, 22, '2022-03-25', '21:34:48', '2022-04-22 03:58:24', 0),
(7, 16, 22, '2022-04-05', '17:35:04', '2022-04-10 03:58:43', 0),
(9, 12, 21, '2022-02-12', '19:45:31', '2022-02-15 03:59:05', 0),
(11, 4, 24, '2022-02-24', '17:30:41', '2022-02-26 04:00:19', 1),
(15, 14, 26, '2022-04-01', '21:35:10', '2022-04-03 04:10:57', 0),
(18, 12, 21, '2022-04-14', '19:01:55', '2022-04-18 04:14:23', 0),
(20, 14, 22, '2022-04-25', '10:40:50', '2022-04-23 11:47:50', 1);

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
(1, 1, 'Firoj', 'firoj', '5a, 231-Ahmedabad Road, Bonani, Dhaka', 'male', '01631330094', NULL, NULL, 1),
(2, 21, 'Firoj', 'Uddin', '5a,ka-121,Nurani Masjid Road, Joar shahara, Dhaka 1229\n', 'male', '09385733213', 1, NULL, NULL),
(3, 22, 'Sabir', ' Sanaullah', 'Ibrahimpur 686, Maddhapara Jame Masjid Road, Dhaka', 'male', '01784644094', 1, NULL, NULL),
(4, 24, 'Mohammad', 'Shohag', '5a,ka-121,Nurani Masjid Road, Joar shahara, Dhaka 1229\n', 'male', '01631330094', 1, NULL, NULL),
(5, 26, 'James', 'May', 'Jhaortola-231, Probeshpani Road, Dhanmondi, Dhaka', 'other', '01723330094', 1, NULL, NULL),
(6, 4, 'Hasan', 'Abi', 'Kernel Road-308, Mohakhali, Dhaka', 'male', '01631330094', NULL, NULL, NULL),
(7, 12, 'Megan', 'Roxanne', 'Amish Road-306, Uttara, Kafrul-Dhaka', 'female', '09357834852', NULL, NULL, NULL),
(8, 14, 'Rebecca', 'Tony', 'Jamshedpur-1202, Katihara, Chouddogram-Khulna', 'female', '09385724234', NULL, NULL, NULL),
(9, 16, 'Gordon', 'Ramsay', 'Brighton Road-803, Jharkhanda toli, Bogura', 'male', '09385843921', NULL, NULL, NULL);

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
(6, 21, 1, '406-A', 5000, 'friday', '19:00:00', '22:00:00'),
(21, 22, 2, '321-A', 3250, 'Friday', '08:25:50', '21:35:50'),
(24, 24, 3, '220-A', 4500, 'Thursday', '07:25:50', '18:35:50'),
(26, 26, 4, '348-B', 2500, 'Saturday', '09:55:50', '16:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `doc_department`
--

CREATE TABLE `doc_department` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doc_department`
--

INSERT INTO `doc_department` (`id`, `dep_name`) VALUES
(1, 'Carcinology'),
(2, 'Nuerology'),
(3, 'Pediatrics'),
(4, 'Orthodontics'),
(5, 'Cardiology');

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
(1, 'Oncology'),
(2, 'Neurosurgery'),
(3, 'Cardiology'),
(4, 'Pediatrics'),
(5, 'Orthodontist');

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
(4, 4, 'hasan@a.com', 'hasan', '2022-03-24 04:51:57', '2022-03-24 04:51:57'),
(12, 4, 'megan@a.com', 'megan', '2022-03-25 09:38:49', '2022-03-25 09:38:49'),
(14, 4, 'user@a.com', 'user', '2022-03-25 09:51:28', '2022-03-25 09:51:28'),
(16, 4, 'ramsey@a.com', 'ramsey', '2022-04-09 10:28:37', '2022-04-09 10:28:37'),
(21, 3, 'firoj@a.com', 'firoj', '2022-04-21 12:53:29', '2022-04-21 12:53:29'),
(22, 3, 'sabir@a.com', 'sabir', '2022-04-21 13:48:47', '2022-04-21 13:48:47'),
(24, 3, 'mohammad@a.com', 'mohammad', '2022-04-21 14:03:59', '2022-04-21 14:03:59'),
(26, 3, 'james@a.com', 'james', '2022-04-21 14:05:37', '2022-04-21 14:05:37');

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
(3, 'doctors', 'doctors', 11205),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `doc_department`
--
ALTER TABLE `doc_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
