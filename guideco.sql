-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 10:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(1, 'admin', 'admin', 'johnpaulmarmanjac@gmail.com', '0000-00-00 00:00:00', 'John Paulmar', 'Lontoc', 'Manjac', 'Guidance Counselor', 'profile.jpg');

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
(1, 'John', 'Doe', 'Smith', '2000-05-15', 22, 'Male', '11', 'B', 'Ms. Adams', '1234567890', '123 Main Street, City', 'Jane Doe', 'Teacher', '456 Oak Avenue, City', '9876543210', 'James Smith', 'Engineer', '789 Pine Road, City', '5678901234', 'Alice', 'C', 'Johnson', 'Teacher', '1112223333', '321 Elm Street, City', 'Michael', 'A', 'Brown', '1995-08-20', 28, 'Male', 'Teacher', 'Grade 10', 'A', 'Mr. Johnson', '9998887777', '567 Maple Avenue, City', 'This is a sample case description.', 'Meeting with parents and teachers.', 'Provide counseling for the students involved.');

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

--
-- Dumping data for table `complaints_student`
--

INSERT INTO `complaints_student` (`id`, `victimFirstName`, `victimMiddleName`, `victimLastName`, `victimDOB`, `victimAge`, `victimSex`, `victimGrade`, `victimSection`, `victimAdviser`, `victimContact`, `victimAddress`, `motherName`, `motherOccupation`, `motherAddress`, `motherContact`, `fatherName`, `fatherOccupation`, `fatherAddress`, `fatherContact`, `complainantFirstName`, `complainantMiddleName`, `complainantLastName`, `relationshipToVictim`, `complainantContact`, `complainantAddress`, `complainedFirstName`, `complainedMiddleName`, `complainedLastName`, `complainedDOB`, `complainedAge`, `complainedSex`, `complainedGrade`, `complainedSection`, `complainedAdviser`, `complainedContact`, `complainedAddress`, `complainedMotherName`, `complainedMotherOccupation`, `complainedMotherAddress`, `complainedMotherContact`, `complainedFatherName`, `complainedFatherOccupation`, `complainedFatherAddress`, `complainedFatherContact`, `caseDetails`, `actionTaken`, `recommendations`) VALUES
(1, 'Paulmar', 'Lontoc', 'Manjac', '2024-07-13', 21, 'Male', '11', 'A', 'Jay Bautista', NULL, NULL, 'Mylene ', 'Housewife', 'Sampaga Balayan Batangas', '09995533777', 'Paul', 'Welder', 'Sampaga Balayan Batangas', '09991122333', 'Carla', 'Jolongbayan', 'Ramos', 'Girlfriend', '09364567891', 'Coral ni Lopez Calaca Batangas', 'Ferdinand Paulo', 'Felices', 'Sacdalan', '2024-07-23', 21, 'Male', '11', 'B', 'Jessa Gutierrez', '09123123121', 'Wawa, Nasugbu Batangas', 'Rumina', 'Housewife', 'Wawa, Nasugbu Batangas', '09878778711', 'Alisto', 'Web Developer', 'Wawa, Nasugbu Batangas', '09878778712', 'sinabugan ng fat bomb sa mukha', 'pinag usap at pinagayos', 'wag na mauulit'),
(2, 'John', 'Michael', 'Doe', '2024-05-15', 16, 'Male', '10', 'C', 'Emily Smith', '09876543210', '123 Elm Street', 'Jane', 'Teacher', '456 Oak Street', '09123456789', 'Robert', 'Engineer', '456 Oak Street', '09234567890', 'Alice', 'Marie', 'Johnson', 'Aunt', '09345678901', '789 Pine Street', 'Tom', 'Henry', 'Jones', '2024-05-16', 17, 'Male', '10', 'D', 'Peter Brown', '09765432109', '321 Maple Street', 'Anna', 'Doctor', '321 Maple Street', '09456789012', 'Sam', 'Developer', '321 Maple Street', '09567890123', 'Punched in the face', 'Reprimanded', 'Ensure supervision'),
(3, 'Emily', 'Rose', 'Clark', '2024-08-20', 18, 'Female', '12', 'E', 'George White', '09123456789', '111 Birch Street', 'Martha', 'Nurse', '222 Cedar Street', '09345678901', 'James', 'Architect', '222 Cedar Street', '09234567890', 'Sara', 'Ann', 'Wilson', 'Friend', '09123456789', '333 Walnut Street', 'Nathan', 'Luke', 'Kim', '2024-08-21', 19, 'Male', '12', 'F', 'David Harris', '09456789012', '444 Cherry Street', 'Ellen', 'Artist', '444 Cherry Street', '09567890123', 'Michael', 'Manager', '444 Cherry Street', '09678901234', 'Verbal abuse', 'Counseled', 'Monitor behavior'),
(4, 'David', 'James', 'Martin', '2024-03-10', 15, 'Male', '9', 'G', 'Sarah Clark', '09876543210', '555 Spruce Street', 'Helen', 'Chef', '666 Fir Street', '09123456789', 'Paul', 'Plumber', '666 Fir Street', '09234567890', 'Emma', 'Louise', 'Taylor', 'Neighbor', '09345678901', '777 Hemlock Street', 'William', 'Lee', 'Brown', '2024-03-11', 16, 'Male', '9', 'H', 'John Walker', '09765432109', '888 Willow Street', 'Laura', 'Scientist', '888 Willow Street', '09456789012', 'Tom', 'Salesman', '888 Willow Street', '09567890123', 'Stolen property', 'Warned', 'Educate on ethics'),
(5, 'Sophia', 'Anne', 'Lewis', '2024-12-01', 17, 'Female', '11', 'I', 'Grace Adams', '09123456789', '999 Maple Avenue', 'Olivia', 'Dentist', '101 Elm Avenue', '09345678901', 'John', 'Farmer', '101 Elm Avenue', '09234567890', 'Lucas', 'Daniel', 'Reed', 'Classmate', '09123456789', '102 Pine Avenue', 'Chris', 'Alan', 'Parker', '2024-12-02', 18, 'Male', '11', 'J', 'Diana Scott', '09456789012', '103 Oak Avenue', 'Lily', 'Vet', '103 Oak Avenue', '09567890123', 'Martin', 'Lawyer', '103 Oak Avenue', '09678901234', 'Bullying', 'Suspended', 'Create awareness programs');

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fathers`
--

INSERT INTO `fathers` (`parent_id`, `student_id`, `name`, `contact_number`, `email`) VALUES
(7, 3, 'magic johnson', '09289090230', 'magicjohnson@gmail.com'),
(8, 3, 'magic johnson', '09289090230', 'magicjohnson@gmail.com'),
(9, 3, 'magic johnson', '09289090230', 'magicjohnson@gmail.com'),
(10, 3, 'magic johnson', '09289090230', 'magicjohnson@gmail.com');

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
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `position`) VALUES
(3, 'guard3', 'password3', 'Michael', '', 'Wilson', NULL, 'security guard'),
(4, 'guard', 'guard', 'ferdinand', NULL, 'sacdalan', NULL, 'security guard'),
(11, 'denver', 'denver', 'denver', NULL, 'alipustain', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mothers`
--

INSERT INTO `mothers` (`parent_id`, `student_id`, `name`, `contact_number`, `email`) VALUES
(6, 3, 'anastacia johnson', '09123787472', 'anastaciajohnson@gmail.com');

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
(1, 'earth', 1, 8),
(2, 'Venus', 1, 4),
(3, 'Saturn', 1, 9),
(4, 'Sampaguita', 2, 10),
(5, 'Rose', 2, 11),
(6, 'Sunflower', 2, 13),
(7, 'Santan', 2, 14);

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
(1, 'John', 'Doe', '', 17, 'Male', 1, '1234567890', 'Christian', '2007-01-01', 1),
(2, 'Jane', 'Marie', 'Smith', 16, 'Female', 2, '0987654321', 'Christian', '2008-02-01', 2),
(3, 'Michael', 'Ray', 'Johnson', 18, 'Male', 3, '0922334455', 'Muslim', '2006-03-01', 3),
(157, 'Emma', 'Louise', 'Brown', 17, 'Female', 1, '09171234567', 'Catholic', '2007-04-15', 10),
(158, 'William', 'Thomas', 'Jackson', 18, 'Male', 2, '09281234567', 'Christian', '2006-05-20', 11),
(159, 'Sophia', 'Anne', 'Wilson', 17, 'Female', 3, '09391234567', 'Buddhist', '2007-06-25', 12),
(160, 'Ethan', 'Daniel', 'Martinez', 16, 'Male', 1, '09451234567', 'Muslim', '2008-03-10', 13),
(161, 'Olivia', 'Grace', 'Garcia', 18, 'Female', 2, '09182345678', 'Catholic', '2006-02-18', 14),
(162, 'James', 'Robert', 'Rodriguez', 17, 'Male', 3, '09293456789', 'Christian', '2007-07-12', 15),
(163, 'Amelia', 'Sophia', 'Lopez', 16, 'Female', 1, '09384567890', 'Buddhist', '2008-01-05', 16),
(164, 'Michael', 'David', 'Reyes', 18, 'Male', 2, '09173567890', 'Muslim', '2006-09-30', 17),
(165, 'Isabella', 'Emily', 'Torres', 17, 'Female', 3, '09284678901', 'Catholic', '2007-11-22', 18),
(166, 'Alexander', 'Joseph', 'Hernandez', 16, 'Male', 1, '09395789012', 'Christian', '2008-06-08', 19),
(167, 'Mia', 'Madison', 'Flores', 18, 'Female', 2, '09456890123', 'Buddhist', '2006-12-03', 20),
(168, 'Benjamin', 'Charles', 'Gomez', 17, 'Male', 3, '09176890123', 'Muslim', '2007-04-17', 21),
(169, 'Charlotte', 'Avery', 'Morales', 16, 'Female', 1, '09287901234', 'Catholic', '2008-02-14', 22),
(170, 'Daniel', 'Owen', 'Rivera', 18, 'Male', 2, '09399012345', 'Christian', '2006-10-19', 23),
(171, 'Liam', 'Carter', 'Santos', 17, 'Male', 3, '09178123456', 'Buddhist', '2007-08-26', 24);

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
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `position`) VALUES
(4, 'teacher', 'teacher', 'juspher ', '', 'pedraza', 'juspherpedraza@gmail.com', 'teacher'),
(8, 'ferdinand', 'ferdinand', 'ferdinand', 'felices', 'sacdalan', 'ferdinand@gmail.com', 'teacher'),
(9, 'nicoll', 'nicoll', 'nicoll', 'lapitan', 'quiroz', 'nicoll@gmail.com', 'teacher'),
(10, 'paulmar', 'paulmar', 'paulmar', 'lontoc', 'manjac', 'paulmar@gmail.com', 'teacher'),
(11, 'paulo', 'paulo', 'paulo', 'sacdalan', 'felices', 'paulo@gmail.com', 'teacher'),
(12, 'frederik', 'frederik', 'frederik', 'quiroz', 'lapitan', 'frederik@gmail.com', 'teacher'),
(13, 'bon', 'bon', 'Bon', NULL, 'De Padua', NULL, NULL),
(14, 'brian', 'brian', 'brian', NULL, 'alano', NULL, NULL),
(15, 'christian', 'christian', 'Christian', NULL, 'abiog', NULL, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'user1', 'user1@example.com', 'password1'),
(2, 'user2', 'user2@example.com', 'password2'),
(3, 'user3', 'user3@example.com', 'password3'),
(10, 'user4', 'user4@example.com', 'password4'),
(11, 'user5', 'user5@example.com', 'password5'),
(12, 'user6', 'user6@example.com', 'password6'),
(13, 'user7', 'user7@example.com', 'password7'),
(14, 'user8', 'user8@example.com', 'password8'),
(15, 'user9', 'user9@example.com', 'password9'),
(16, 'user10', 'user10@example.com', 'password10'),
(17, 'user11', 'user11@example.com', 'password11'),
(18, 'user12', 'user12@example.com', 'password12'),
(19, 'user13', 'user13@example.com', 'password13'),
(20, 'user14', 'user14@example.com', 'password14'),
(21, 'user15', 'user15@example.com', 'password15'),
(22, 'user16', 'user16@example.com', 'password16'),
(23, 'user17', 'user17@example.com', 'password17'),
(24, 'user18', 'user18@example.com', 'password18'),
(32, 'user11', 'user11@example.com', 'password11'),
(33, 'user12', 'user12@example.com', 'password12'),
(34, 'user13', 'user13@example.com', 'password13'),
(35, 'user14', 'user14@example.com', 'password14'),
(36, 'user15', 'user15@example.com', 'password15'),
(37, 'user16', 'user16@example.com', 'password16'),
(38, 'user17', 'user17@example.com', 'password17'),
(39, 'user18', 'user18@example.com', 'password18');

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
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`id`, `student_id`, `violation`, `reported_at`, `guard_id`, `teacher_id`) VALUES
(12, 166, 'Smoking', '2024-07-16 16:53:55', NULL, 4),
(13, 165, 'Disrespect to Teachers', '2024-07-16 16:54:25', NULL, 4),
(14, 157, 'Improper Haircut', '2024-07-16 16:55:36', 4, NULL),
(15, 2, 'Cutting Classes', '2024-07-16 16:55:50', 4, NULL),
(16, 157, 'Over the Bakod', '2024-07-16 16:55:56', 4, NULL),
(17, 160, 'Littering', '2024-07-16 16:56:04', 4, NULL),
(18, 2, 'Over the Bakod', '2024-07-17 07:58:17', 4, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaints_student`
--
ALTER TABLE `complaints_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fathers`
--
ALTER TABLE `fathers`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guards`
--
ALTER TABLE `guards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
