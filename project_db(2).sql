-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 11:36 PM
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
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_form`
--

CREATE TABLE `admin_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_form`
--

INSERT INTO `admin_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'kuziva', 'kuziva@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `projectors` int(11) NOT NULL,
  `laptops` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `phone_extension` varchar(10) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_date`, `start_time`, `end_time`, `projectors`, `laptops`, `customer_id`, `department`, `phone_extension`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, '2024-06-06', '11:01:00', '12:00:00', 2, 3, 5, '', '', '', '2024-05-29 09:15:06', '2024-05-29 09:15:06'),
(2, '2024-05-30', '10:00:00', '11:00:00', 2, 1, 5, '0', '2160', '0783988199', '2024-05-29 09:22:01', '2024-05-29 09:22:01'),
(3, '2024-05-31', '10:00:00', '12:00:00', 2, 3, 5, '0', '0909', '9878', '2024-05-29 09:27:00', '2024-05-29 09:27:00'),
(4, '2024-03-02', '10:00:00', '13:00:00', 1, 0, 5, 'School of Arts and Design', '2060', '9898', '2024-05-29 09:43:51', '2024-05-29 09:43:51'),
(5, '2024-03-02', '10:00:00', '13:00:00', 1, 0, 5, 'School of Arts and Design', '2060', '9898', '2024-05-29 09:46:42', '2024-05-29 09:46:42'),
(6, '2024-03-02', '10:00:00', '13:00:00', 1, 0, 5, 'School of Arts and Design', '2060', '9898', '2024-05-29 09:47:15', '2024-05-29 09:47:15'),
(7, '2024-03-02', '10:00:00', '13:00:00', 1, 0, 5, 'School of Arts and Design', '2060', '9898', '2024-05-29 12:39:02', '2024-05-29 12:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `device_type` varchar(20) NOT NULL,
  `device_name` varchar(20) NOT NULL,
  `serial_number` varchar(20) NOT NULL,
  `hdd_storage` varchar(20) NOT NULL,
  `ram_storage` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `surname`, `email`, `department`, `device_type`, `device_name`, `serial_number`, `hdd_storage`, `ram_storage`, `created_at`) VALUES
(1, 'eliana', 'musiyandaka', 'emus@gmail.com', 'School of Arts and Design', 'laptop', 'hp450', 'fnc45fr89', '500', '8', '2024-05-27 06:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `available_projectors` int(11) DEFAULT 5,
  `available_laptops` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `available_projectors`, `available_laptops`) VALUES
(1, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'kiroto', 'am@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(2, 'kk', 'kk@gmail.com', '7b7a53e239400a13bd6be6c91c4f6c4e', ''),
(3, 'aime', 'ok@gmail.com', 'b59c67bf196a4758191e42f76670ceba', ''),
(5, 'kuziva01', 'kuziva01user@gmail.com', '934b535800b1cba8f96a5d72f72f1611', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_form`
--
ALTER TABLE `admin_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_form`
--
ALTER TABLE `admin_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
