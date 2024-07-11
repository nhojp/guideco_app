-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 03:39 AM
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
-- Database: `guideco`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', 'admin', 'johnpaulmarmanjac@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `contact_number` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `first_name`, `middle_name`, `last_name`, `birthdate`, `sex`, `religion`, `grade`, `section`, `contact_number`) VALUES
(1, 'user', 'user', 'paulmarmanjac@gmail.com', '2024-06-18 15:55:52', 'john paulmar', 'lontoc', 'manjac', '2003-07-14', 'Male', 'roman catholic', '11', 'earth', '+639304365359'),
(2, 'student1', 'password1', 'student1@example.com', '2024-06-30 00:18:44', 'John', 'Middle', 'Doe', '2007-06-30', 'Male', 'Christian', '11', 'Mercury', '+639123456789'),
(3, 'student2', 'password2', 'student2@example.com', '2024-06-30 00:18:44', 'Jane', 'Middle', 'Smith', '2006-06-30', 'Female', 'Catholic', '11', 'Venus', '+639987654321'),
(4, 'student3', 'password3', 'student3@example.com', '2024-06-30 00:18:44', 'Michael', 'Middle', 'Johnson', '2007-06-30', 'Male', 'Protestant', '12', 'Earth', '+639555123456'),
(5, 'student4', 'password4', 'student4@example.com', '2024-06-30 00:18:44', 'Emily', 'Middle', 'Williams', '2006-06-30', 'Female', 'Buddhist', '12', 'Mars', '+639777789012'),
(6, 'student5', 'password5', 'student5@example.com', '2024-06-30 00:18:44', 'David', 'Middle', 'Brown', '2007-06-30', 'Male', 'Muslim', '11', 'Jupiter', '+639888456123'),
(7, 'student6', 'password6', 'student6@example.com', '2024-06-30 00:18:44', 'Sarah', 'Middle', 'Davis', '2006-06-30', 'Female', 'Hindu', '11', 'Saturn', '+639333654789'),
(8, 'student7', 'password7', 'student7@example.com', '2024-06-30 00:18:44', 'Daniel', 'Middle', 'Miller', '2007-06-30', 'Male', 'Jewish', '12', 'Uranus', '+639111234567'),
(9, 'student8', 'password8', 'student8@example.com', '2024-06-30 00:18:44', 'Olivia', 'Middle', 'Wilson', '2006-06-30', 'Female', 'Sikh', '12', 'Neptune', '+639222987654'),
(10, 'student9', 'password9', 'student9@example.com', '2024-06-30 00:18:44', 'James', 'Middle', 'Garcia', '2007-06-30', 'Male', 'Bahai', '11', 'Pluto', '+639666789012'),
(11, 'student10', 'password10', 'student10@example.com', '2024-06-30 00:18:44', 'Sophia', 'Middle', 'Rodriguez', '2006-06-30', 'Female', 'Taoist', '11', 'Sun', '+639555456789'),
(12, 'student11', 'password11', 'student11@example.com', '2024-06-30 00:18:44', 'Matthew', 'Middle', 'Martinez', '2007-06-30', 'Male', 'Jain', '12', 'Moon', '+639777123456'),
(13, 'student12', 'password12', 'student12@example.com', '2024-06-30 00:18:44', 'Emma', 'Middle', 'Lopez', '2006-06-30', 'Female', 'Confucian', '12', 'Mars', '+639888789012');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
