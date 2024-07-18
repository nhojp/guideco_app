-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 08:24 PM
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
-- Database: `guideco2`
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`, `first_name`, `middle_name`, `last_name`, `position`, `picture`) VALUES
(2, 'jpaulmar', 'john14manjac', 'johnpaulmarmanjac@gmail.com', '2024-07-18 13:02:12', 'john paulmar', 'lontoc', 'manjac', 'Developer/Creator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `victimFirstName` varchar(255) DEFAULT NULL,
  `victimMiddleName` varchar(255) DEFAULT NULL,
  `victimLastName` varchar(255) DEFAULT NULL,
  `victimDOB` date DEFAULT NULL,
  `victimAge` int(11) DEFAULT NULL,
  `victimSex` varchar(10) DEFAULT NULL,
  `victimGrade` varchar(50) DEFAULT NULL,
  `victimSection` varchar(50) DEFAULT NULL,
  `victimAdviser` varchar(255) DEFAULT NULL,
  `victimContact` varchar(50) DEFAULT NULL,
  `victimAddress` text DEFAULT NULL,
  `motherName` varchar(255) DEFAULT NULL,
  `motherOccupation` varchar(255) DEFAULT NULL,
  `motherAddress` text DEFAULT NULL,
  `motherContact` varchar(50) DEFAULT NULL,
  `fatherName` varchar(255) DEFAULT NULL,
  `fatherOccupation` varchar(255) DEFAULT NULL,
  `fatherAddress` text DEFAULT NULL,
  `fatherContact` varchar(50) DEFAULT NULL,
  `complainantFirstName` varchar(255) DEFAULT NULL,
  `complainantMiddleName` varchar(255) DEFAULT NULL,
  `complainantLastName` varchar(255) DEFAULT NULL,
  `relationshipToVictim` varchar(255) DEFAULT NULL,
  `complainantContact` varchar(50) DEFAULT NULL,
  `complainantAddress` text DEFAULT NULL,
  `complainedFirstName` varchar(255) DEFAULT NULL,
  `complainedMiddleName` varchar(255) DEFAULT NULL,
  `complainedLastName` varchar(255) DEFAULT NULL,
  `complainedDOB` date DEFAULT NULL,
  `complainedAge` int(11) DEFAULT NULL,
  `complainedSex` varchar(10) DEFAULT NULL,
  `complainedDesignation` varchar(100) DEFAULT NULL,
  `complainedGrade` varchar(50) DEFAULT NULL,
  `complainedSection` varchar(50) DEFAULT NULL,
  `complainedAdviser` varchar(255) DEFAULT NULL,
  `complainedContact` varchar(50) DEFAULT NULL,
  `complainedAddress` text DEFAULT NULL,
  `caseDetails` text DEFAULT NULL,
  `actionTaken` text DEFAULT NULL,
  `recommendations` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `victimFirstName`, `victimMiddleName`, `victimLastName`, `victimDOB`, `victimAge`, `victimSex`, `victimGrade`, `victimSection`, `victimAdviser`, `victimContact`, `victimAddress`, `motherName`, `motherOccupation`, `motherAddress`, `motherContact`, `fatherName`, `fatherOccupation`, `fatherAddress`, `fatherContact`, `complainantFirstName`, `complainantMiddleName`, `complainantLastName`, `relationshipToVictim`, `complainantContact`, `complainantAddress`, `complainedFirstName`, `complainedMiddleName`, `complainedLastName`, `complainedDOB`, `complainedAge`, `complainedSex`, `complainedDesignation`, `complainedGrade`, `complainedSection`, `complainedAdviser`, `complainedContact`, `complainedAddress`, `caseDetails`, `actionTaken`, `recommendations`) VALUES
(11, 'john paulmar', 'lontoc', 'manjac', '2003-07-14', 21, 'Male', 'Grade 11', 'Rose', 'ferdinand paulo sacdalan', NULL, NULL, 'mylene manjac', '', '', '09995533777', 'apolinar manjac', '', '', '09124569879', 'Carla', 'Jolongbayan', 'Ramos', 'Girlfriend', '09123847281', 'Coral ni Lopez Calaca Batangas', 'john paulmar', 'lontoc', 'manjac', '0000-00-00', 0, '0', '', NULL, NULL, NULL, '', '', 'dasdasd', 'afasda', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `complaints_student`
--

CREATE TABLE `complaints_student` (
  `id` int(11) NOT NULL,
  `victimFirstName` varchar(255) DEFAULT NULL,
  `victimMiddleName` varchar(255) DEFAULT NULL,
  `victimLastName` varchar(255) DEFAULT NULL,
  `victimDOB` date DEFAULT NULL,
  `victimAge` int(11) DEFAULT NULL,
  `victimSex` enum('Male','Female','Other') DEFAULT NULL,
  `victimGrade` varchar(50) DEFAULT NULL,
  `victimSection` varchar(50) DEFAULT NULL,
  `victimAdviser` varchar(255) DEFAULT NULL,
  `victimContact` varchar(20) DEFAULT NULL,
  `victimAddress` text DEFAULT NULL,
  `motherName` varchar(255) DEFAULT NULL,
  `motherOccupation` varchar(255) DEFAULT NULL,
  `motherAddress` text DEFAULT NULL,
  `motherContact` varchar(20) DEFAULT NULL,
  `fatherName` varchar(255) DEFAULT NULL,
  `fatherOccupation` varchar(255) DEFAULT NULL,
  `fatherAddress` text DEFAULT NULL,
  `fatherContact` varchar(20) DEFAULT NULL,
  `complainantFirstName` varchar(255) DEFAULT NULL,
  `complainantMiddleName` varchar(255) DEFAULT NULL,
  `complainantLastName` varchar(255) DEFAULT NULL,
  `relationshipToVictim` varchar(255) DEFAULT NULL,
  `complainantContact` varchar(20) DEFAULT NULL,
  `complainantAddress` text DEFAULT NULL,
  `complainedFirstName` varchar(255) DEFAULT NULL,
  `complainedMiddleName` varchar(255) DEFAULT NULL,
  `complainedLastName` varchar(255) DEFAULT NULL,
  `complainedDOB` date DEFAULT NULL,
  `complainedAge` int(11) DEFAULT NULL,
  `complainedSex` enum('Male','Female','Other') DEFAULT NULL,
  `complainedGrade` varchar(50) DEFAULT NULL,
  `complainedSection` varchar(50) DEFAULT NULL,
  `complainedAdviser` varchar(255) DEFAULT NULL,
  `complainedContact` varchar(20) DEFAULT NULL,
  `complainedAddress` text DEFAULT NULL,
  `complainedMotherName` varchar(255) DEFAULT NULL,
  `complainedMotherOccupation` varchar(255) DEFAULT NULL,
  `complainedMotherAddress` text DEFAULT NULL,
  `complainedMotherContact` varchar(20) DEFAULT NULL,
  `complainedFatherName` varchar(255) DEFAULT NULL,
  `complainedFatherOccupation` varchar(255) DEFAULT NULL,
  `complainedFatherAddress` text DEFAULT NULL,
  `complainedFatherContact` varchar(20) DEFAULT NULL,
  `caseDetails` text DEFAULT NULL,
  `actionTaken` text DEFAULT NULL,
  `recommendations` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fathers`
--

INSERT INTO `fathers` (`parent_id`, `student_id`, `name`, `contact_number`, `email`, `occupation`, `address`) VALUES
(11, 1, 'apolinar manjac', '09124569879', 'apolinarmanjac@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `grade_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade_name`) VALUES
(1, 'Grade 11'),
(2, 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `guards`
--

CREATE TABLE `guards` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `position`, `birthdate`, `sex`, `contact_number`, `address`) VALUES
(12, 'paul', 'john14manjac', 'john paulmar', NULL, 'manjac', NULL, 'Guard', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mothers`
--

INSERT INTO `mothers` (`parent_id`, `student_id`, `name`, `contact_number`, `email`, `occupation`, `address`) VALUES
(7, 1, 'mylene manjac', '09995533777', 'mylenemanjac@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(10) NOT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `grade_id`, `teacher_id`) VALUES
(8, 'Rose', 1, 17),
(9, 'Sampaguita', 1, 16),
(10, 'Gumamela', 1, 18),
(11, 'Daisy', 1, 19),
(12, 'earth', 2, 20),
(13, 'jupiter', 2, 21),
(14, 'saturn', 2, 22),
(15, 'mars', 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `middle_name`, `last_name`, `age`, `sex`, `section_id`, `contact_number`, `religion`, `birthdate`, `user_id`) VALUES
(1, 'john paulmar', 'lontoc', 'manjac', 21, 'Male', 8, '09304365359', 'roman catholic', '2003-07-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `position`, `birthdate`, `sex`, `contact_number`, `address`) VALUES
(16, 'jpaul', 'john14manjac', 'john paulmar', 'lontoc', 'manjac', 'paulmarmanjac@gmail.com', 'Teacher', '2003-07-14', 'Male', '09304365359', 'sampaga balayan batangas'),
(17, 'ferdi', '1234', 'ferdinand paulo', NULL, 'sacdalan', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(18, 'juspher', '1234', 'juspher ', NULL, 'pedraza', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(19, 'nicoll', '1234', 'nicoll', NULL, 'quiroz', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(20, 'john', '1234', 'john', NULL, 'lontoc', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(21, 'paulman', '1234', 'paul ', NULL, 'marman', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(22, 'frederik', '1234', 'frederik', NULL, 'lapitan', NULL, 'Teacher', NULL, NULL, NULL, NULL),
(23, 'perding', '1234', 'perding', NULL, 'felices', NULL, 'Teacher', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `sex`, `birthdate`, `address`, `contact_number`) VALUES
(1, 'paulmar', 'johnpaulmarmanjac', 'john14manjac', NULL, NULL, NULL, NULL),
(47, '241', '', '241', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `violation` varchar(255) NOT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `guard_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints_student`
--
ALTER TABLE `complaints_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fathers`
--
ALTER TABLE `fathers`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guards`
--
ALTER TABLE `guards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mothers`
--
ALTER TABLE `mothers`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fk_guard` (`guard_id`),
  ADD KEY `fk_teacher` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `complaints_student`
--
ALTER TABLE `complaints_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fathers`
--
ALTER TABLE `fathers`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guards`
--
ALTER TABLE `guards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fathers`
--
ALTER TABLE `fathers`
  ADD CONSTRAINT `fathers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `mothers`
--
ALTER TABLE `mothers`
  ADD CONSTRAINT `mothers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `fk_guard` FOREIGN KEY (`guard_id`) REFERENCES `guards` (`id`),
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `violations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
