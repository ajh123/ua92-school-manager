-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 10.0.0.143
-- Generation Time: Apr 11, 2025 at 11:09 AM
-- Server version: 11.7.2-MariaDB-ubu2404
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendance`
--

CREATE TABLE `Attendance` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `type` enum('PRESENT','LATE','UNAUTHORISED_ABSENT','AUTHORISED_ABSENT','EXPELLED') NOT NULL,
  `comments` text DEFAULT NULL,
  `whenMarked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Attendance`
--

INSERT INTO `Attendance` (`id`, `userID`, `classID`, `type`, `comments`, `whenMarked`) VALUES
(1, 2, 1, 'PRESENT', 'Good work!', '2025-04-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `BookAssignments`
--

CREATE TABLE `BookAssignments` (
  `id` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `whenHandOut` datetime NOT NULL,
  `whenDueIn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `BookAssignments`
--

INSERT INTO `BookAssignments` (`id`, `bookID`, `userID`, `whenHandOut`, `whenDueIn`) VALUES
(1, 1, 2, '2025-04-04 00:00:00', '2025-05-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `inStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`id`, `isbn`, `name`, `author`, `inStock`) VALUES
(1, '45665455456', 'Universe', 'Person', 4454341);

-- --------------------------------------------------------

--
-- Table structure for table `ClassAssignments`
--

CREATE TABLE `ClassAssignments` (
  `id` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `ClassAssignments`
--

INSERT INTO `ClassAssignments` (`id`, `classID`, `groupID`) VALUES
(1, 1, 5),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `teacherID` int(11) DEFAULT NULL,
  `daysOfWeek` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`id`, `capacity`, `name`, `startTime`, `endTime`, `teacherID`, `daysOfWeek`, `startDate`, `endDate`) VALUES
(1, 30, 'ICT', '10:20:00', '12:40:00', 3, 11010, '2025-04-04', '2025-05-10'),
(2, 30, 'English', '09:00:00', '10:20:00', 3, 11010, '2025-04-04', '2025-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `ContactInformation`
--

CREATE TABLE `ContactInformation` (
  `id` int(11) NOT NULL,
  `addressLine1` varchar(200) NOT NULL,
  `addressLine2` varchar(200) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `ContactInformation`
--

INSERT INTO `ContactInformation` (`id`, `addressLine1`, `addressLine2`, `city`, `state`, `country`, `postcode`, `telephone`) VALUES
(1, '57 Deans Road', 'Swinton', 'Manchester', 'England', 'United Kingdom', 'M27OAP', '07946276552');

-- --------------------------------------------------------

--
-- Table structure for table `GroupAssignments`
--

CREATE TABLE `GroupAssignments` (
  `id` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `GroupAssignments`
--

INSERT INTO `GroupAssignments` (`id`, `groupID`, `userID`) VALUES
(1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE `Groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Groups`
--

INSERT INTO `Groups` (`id`, `name`) VALUES
(1, 'Reception Year'),
(2, 'Year 1'),
(3, 'Year 2'),
(4, 'Year 3'),
(5, 'Year 4'),
(6, 'Year 5'),
(7, 'Year 6'),
(8, 'Year 7');

-- --------------------------------------------------------

--
-- Table structure for table `GuardianAssignments`
--

CREATE TABLE `GuardianAssignments` (
  `id` int(11) NOT NULL,
  `guardianID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `relationship` enum('PARENT','GUARDIAN','CAREER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `GuardianAssignments`
--

INSERT INTO `GuardianAssignments` (`id`, `guardianID`, `userID`, `relationship`) VALUES
(1, 5, 2, 'PARENT');

-- --------------------------------------------------------

--
-- Table structure for table `MedicalInformation`
--

CREATE TABLE `MedicalInformation` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `dateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `permissions` text NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`id`, `permissions`, `name`) VALUES
(1, '*', 'Admin'),
(2, 'table.*.view;table.attendance.*;', 'Teacher'),
(3, 'table.*.view', 'Staff'),
(4, '.', 'Guardian'),
(5, '.', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `Salaries`
--

CREATE TABLE `Salaries` (
  `id` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `wage` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Salaries`
--

INSERT INTO `Salaries` (`id`, `roleID`, `wage`) VALUES
(1, 1, 2000),
(2, 2, 1000),
(3, 3, 400);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `avatarURL` varchar(1000) DEFAULT NULL,
  `roleID` int(11) NOT NULL,
  `contactID` int(11) DEFAULT NULL,
  `medicalID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `password`, `avatarURL`, `roleID`, `contactID`, `medicalID`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, 1, NULL, NULL),
(2, 'student', 'student@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, 5, 1, NULL),
(3, 'teacher', 'teacher@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, 2, NULL, NULL),
(4, 'staff', 'staff@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, 3, NULL, NULL),
(5, 'parent', 'parent@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attendance`
--
ALTER TABLE `Attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `BookAssignments`
--
ALTER TABLE `BookAssignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ClassAssignments`
--
ALTER TABLE `ClassAssignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classID` (`classID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `ContactInformation`
--
ALTER TABLE `ContactInformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `GroupAssignments`
--
ALTER TABLE `GroupAssignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupID` (`groupID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `GuardianAssignments`
--
ALTER TABLE `GuardianAssignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardianID` (`guardianID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `MedicalInformation`
--
ALTER TABLE `MedicalInformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Salaries`
--
ALTER TABLE `Salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `contactID` (`contactID`),
  ADD KEY `medicalID` (`medicalID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attendance`
--
ALTER TABLE `Attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `BookAssignments`
--
ALTER TABLE `BookAssignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ClassAssignments`
--
ALTER TABLE `ClassAssignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ContactInformation`
--
ALTER TABLE `ContactInformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `GroupAssignments`
--
ALTER TABLE `GroupAssignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Groups`
--
ALTER TABLE `Groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `GuardianAssignments`
--
ALTER TABLE `GuardianAssignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `MedicalInformation`
--
ALTER TABLE `MedicalInformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Salaries`
--
ALTER TABLE `Salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Attendance`
--
ALTER TABLE `Attendance`
  ADD CONSTRAINT `Attendance_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Attendance_ibfk_2` FOREIGN KEY (`classID`) REFERENCES `Classes` (`id`);

--
-- Constraints for table `BookAssignments`
--
ALTER TABLE `BookAssignments`
  ADD CONSTRAINT `BookAssignments_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `Books` (`id`),
  ADD CONSTRAINT `BookAssignments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`);

--
-- Constraints for table `ClassAssignments`
--
ALTER TABLE `ClassAssignments`
  ADD CONSTRAINT `ClassAssignments_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `Classes` (`id`),
  ADD CONSTRAINT `ClassAssignments_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `Groups` (`id`);

--
-- Constraints for table `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `Classes_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `Users` (`id`);

--
-- Constraints for table `GroupAssignments`
--
ALTER TABLE `GroupAssignments`
  ADD CONSTRAINT `GroupAssignments_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `Groups` (`id`),
  ADD CONSTRAINT `GroupAssignments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`);

--
-- Constraints for table `GuardianAssignments`
--
ALTER TABLE `GuardianAssignments`
  ADD CONSTRAINT `GuardianAssignments_ibfk_1` FOREIGN KEY (`guardianID`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `GuardianAssignments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Salaries`
--
ALTER TABLE `Salaries`
  ADD CONSTRAINT `Salaries_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `Roles` (`id`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `Roles` (`id`),
  ADD CONSTRAINT `Users_ibfk_2` FOREIGN KEY (`contactID`) REFERENCES `ContactInformation` (`id`),
  ADD CONSTRAINT `Users_ibfk_3` FOREIGN KEY (`medicalID`) REFERENCES `MedicalInformation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
