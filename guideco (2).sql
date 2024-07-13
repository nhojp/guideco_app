-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 05:24 PM
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
-- Table structure for table `personalinformation`
--

CREATE TABLE `personalinformation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personalinformation`
--

INSERT INTO `personalinformation` (`id`, `user_id`, `created_at`, `first_name`, `middle_name`, `last_name`, `birthdate`, `sex`, `religion`, `grade`, `section`, `contact_number`) VALUES
(1, 1, '2024-07-10 13:51:50', 'John Paulmar', 'lontoc', 'manjac', '2003-07-14', 'Male', 'Roman Catholic', 11, 'Earth', '09304365359');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`) VALUES
(1, 'hi', 'Hello, what can I help?'),
(2, 'hello', 'Hello, what can I help?'),
(3, 'What is your name?', 'My name is GuideBot.'),
(4, 'How are you?', 'I am doing well, thank you!'),
(5, 'What can you do?', 'I can answer questions and have basic conversations.'),
(6, 'How old are you?', 'I am a virtual assistant, so I do not have an age.'),
(7, 'Who created you?', 'I was created by developers from Batangas State University, you can contact them in the website contact.'),
(8, 'Where are you from?', 'I exist in the digital world, so I do not have a physical location.'),
(9, 'What is the weather like today?', 'I do not have access to real-time weather information.'),
(10, 'Tell me a joke.', 'Why don\'t scientists trust atoms? Because they make up everything!'),
(11, 'How do I reset my password?', 'Please contact our support team for assistance with password resets.'),
(12, 'Can you help me with my homework?', 'I can provide information, but I cannot do your homework for you.'),
(13, 'What is the meaning of life?', 'The meaning of life is a philosophical question that varies for each individual.'),
(14, 'Do you dream?', 'As an AI, I do not dream.'),
(15, 'Tell me about yourself.', 'I am a chatbot designed to assist with answering questions and engaging in conversation.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `middle_name`, `last_name`, `birthdate`, `sex`, `religion`, `grade`, `section`, `contact_number`) VALUES
(1, 'paulmar', 'manjac', 'johnpaulmarmanjac@gmail.com', 'John', 'Paulmar', 'Lontoc', '2003-07-14', 'Male', 'Roman Catholic', 11, 'Earth', '09304365359');

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
-- Indexes for table `personalinformation`
--
ALTER TABLE `personalinformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `personalinformation`
--
ALTER TABLE `personalinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personalinformation`
--
ALTER TABLE `personalinformation`
  ADD CONSTRAINT `personalinformation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
