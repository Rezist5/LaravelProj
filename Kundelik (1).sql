-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2024 at 11:45 AM
-- Server version: 8.0.30
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Kundelik`
--
CREATE DATABASE IF NOT EXISTS `Kundelik` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Kundelik`;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `Id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Id`, `name`) VALUES
(1, 'IvanD'),
(2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ClassTable`
--

CREATE TABLE `ClassTable` (
  `id` int NOT NULL,
  `ClassName` varchar(50) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ClassTable`
--

INSERT INTO `ClassTable` (`id`, `ClassName`, `grade`) VALUES
(1, 'BVS', '3'),
(2, 'HAY', '3'),
(3, 'KWB', '2'),
(4, 'WAZ', '3'),
(5, 'NAE', '4'),
(6, 'NAG', '8'),
(7, 'CNF', '5'),
(8, 'ZGM', '4'),
(9, 'URU', '5'),
(10, 'QFG', '1'),
(11, 'HKG', '10'),
(12, 'THU', '10'),
(13, 'MPL', '3'),
(14, 'TLS', '9'),
(15, 'YSX', '8'),
(16, 'UTR', '2'),
(17, 'BXE', '2'),
(18, 'ITP', '10'),
(19, 'AOI', '9'),
(20, 'AYL', '10');

-- --------------------------------------------------------

--
-- Table structure for table `Lesson`
--

CREATE TABLE `Lesson` (
  `id` int NOT NULL,
  `LessonDate` date DEFAULT NULL,
  `LessonNumber` int DEFAULT NULL,
  `classId` int DEFAULT NULL,
  `TeacherId` int DEFAULT NULL,
  `classroom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Lesson`
--

INSERT INTO `Lesson` (`id`, `LessonDate`, `LessonNumber`, `classId`, `TeacherId`, `classroom`) VALUES
(1, '2024-01-08', 1, 4, 22, 222),
(2, '2024-01-08', 2, 4, 22, 222),
(3, '2024-01-08', 3, 4, 22, 222),
(4, '2024-01-08', 4, 4, 22, 222),
(5, '2024-01-08', 5, 4, 22, 223),
(6, '2024-01-08', 6, 4, 22, 223),
(7, '2024-01-08', 7, 4, 22, 223),
(8, '2024-01-08', 8, 4, 22, 223),
(9, '2024-01-08', 9, 4, 22, 232);

-- --------------------------------------------------------

--
-- Table structure for table `Mark`
--

CREATE TABLE `Mark` (
  `id` int NOT NULL,
  `MarkNumber` int DEFAULT NULL,
  `MarkDate` date DEFAULT NULL,
  `TaskId` int DEFAULT NULL,
  `StudentId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Mark`
--

INSERT INTO `Mark` (`id`, `MarkNumber`, `MarkDate`, `TaskId`, `StudentId`) VALUES
(1, 8, '2024-01-08', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `SolutionTask`
--

CREATE TABLE `SolutionTask` (
  `Id` int NOT NULL,
  `TaskId` int DEFAULT NULL,
  `StudentId` int DEFAULT NULL,
  `SolutionFilePath` varchar(500) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `downloaded` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `SolutionTask`
--

INSERT INTO `SolutionTask` (`Id`, `TaskId`, `StudentId`, `SolutionFilePath`, `verified`, `downloaded`) VALUES
(1, 3, 1, 'solution_files/1704686074_1_8_24.rar', 0, 1),
(2, 4, 1, 'solution_files/1704689273_UML.rar', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `Thirdname` varchar(50) DEFAULT NULL,
  `AvgMark` float DEFAULT NULL,
  `ClassId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`id`, `name`, `surname`, `Thirdname`, `AvgMark`, `ClassId`) VALUES
(1, 'qwe', 'qwe', 'qwe', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

CREATE TABLE `Subject` (
  `Id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Subject`
--

INSERT INTO `Subject` (`Id`, `name`) VALUES
(1, 'Math'),
(2, 'Rus Language'),
(3, 'Foreign Language'),
(4, 'Chemistry'),
(5, 'PE'),
(6, 'Informatic'),
(7, 'Physic'),
(8, 'Geography'),
(9, 'History'),
(10, 'Kazak Language');

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `Id` int NOT NULL,
  `LessonID` int DEFAULT NULL,
  `SubjectID` int DEFAULT NULL,
  `ClassId` int DEFAULT NULL,
  `TaskfilePath` varchar(500) DEFAULT NULL,
  `SolutionFilePath` varchar(500) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `downloaded` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`Id`, `LessonID`, `SubjectID`, `ClassId`, `TaskfilePath`, `SolutionFilePath`, `deadline`, `verified`, `downloaded`) VALUES
(1, 4, NULL, NULL, 'task_files/1704642664_djangohw.rar', NULL, '2024-01-08', 0, 0),
(2, 22, NULL, 3, 'task_files/1704644216_djangohw.rar', NULL, '2024-01-08', 0, 0),
(3, 23, NULL, 4, 'task_files/1704644256_Dolban.gif', NULL, '2024-01-08', 0, 0),
(4, 1, NULL, 4, 'task_files/1704687277_Dolban.gif', NULL, '2024-01-09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Thirdname` varchar(50) DEFAULT NULL,
  `SubjectID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Id`, `name`, `Surname`, `Thirdname`, `SubjectID`) VALUES
(1, 'Gussie', 'Eite', 'Zaam-Dox', 1),
(2, 'Jolyn', 'McEvoy', 'Latlux', 1),
(3, 'Ivonne', 'Escot', 'Opela', 2),
(4, 'Curcio', 'Clixby', 'Wrapsafe', 2),
(5, 'Fidole', 'Danne', 'Stringtough', 3),
(6, 'Massimo', 'De la Harpe', 'Alphazap', 3),
(7, 'Halimeda', 'Kermitt', 'Stim', 10),
(8, 'Clerissa', 'Raftery', 'Toughjoyfax', 10),
(9, 'Ash', 'Healy', 'Kanlam', 4),
(10, 'Rani', 'Yarnall', 'It', 4),
(11, 'Bonni', 'Shawyer', 'Zathin', 5),
(12, 'Marybeth', 'Moodey', 'Tampflex', 5),
(13, 'Rudie', 'Hiland', 'Vagram', 6),
(14, 'Dulcea', 'Ferrucci', 'Mat Lam Tam', 6),
(15, 'Taite', 'Shipton', 'Wrapsafe', 7),
(16, 'Abe', 'Ambrois', 'Viva', 7),
(17, 'Isabelle', 'Starbucke', 'Andalax', 8),
(18, 'Muriel', 'Bulbrook', 'Greenlam', 8),
(19, 'Mikey', 'Swanbourne', 'Prodder', 9),
(20, 'Denys', 'Cormack', 'It', 9),
(21, 'qwe', 'qwe', 'qwe', 2),
(22, 'qwe', 'qwe', 'qwe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `UserType` varchar(100) DEFAULT NULL,
  `UserId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `username`, `password`, `UserType`, `UserId`) VALUES
(1, 'IvanD', '123456', 'Admin', 1),
(2, 'IvanD5', '$2y$10$t9fbUJsDaLpiWNBAXSHsSuSzGh/b7B2VODlOtRL1bhpJceRjO6vxC', 'admin', 2),
(3, 'Stud1', '$2y$10$qw1iIgQtf3cgP5vBA.PvIuLPVQIY43Ykq7q9wSyMYsZ5Y.8hEooVy', 'student', 1),
(4, 'Teach1', '$2y$10$f/NtCOTIevf2oaJjR2jl/uLaKwXxy25i5JTNLnb/yRQMOMNoZ9F4G', 'teacher', 21),
(5, 'Teach2', '$2y$10$VRDkDwwNX2YsoaA5dGA6cecdk3FRk4R3ybz0GRKGkwZxFVI.0/RJe', 'teacher', 22),
(6, 'Stud2', '$2y$10$JjFJYnr390UVvy8h/iHt5eTs.IzqjfXN35fsiXMHyAzXjOp./LiTi', 'student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ClassTable`
--
ALTER TABLE `ClassTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Lesson`
--
ALTER TABLE `Lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classId` (`classId`),
  ADD KEY `TeacherId` (`TeacherId`);

--
-- Indexes for table `Mark`
--
ALTER TABLE `Mark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `TaskId` (`TaskId`);

--
-- Indexes for table `SolutionTask`
--
ALTER TABLE `SolutionTask`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TaskId` (`TaskId`),
  ADD KEY `StudentId` (`StudentId`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ClassId` (`ClassId`);

--
-- Indexes for table `Subject`
--
ALTER TABLE `Subject`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `LessonID` (`LessonID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `ClassId` (`ClassId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ClassTable`
--
ALTER TABLE `ClassTable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Lesson`
--
ALTER TABLE `Lesson`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Mark`
--
ALTER TABLE `Mark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SolutionTask`
--
ALTER TABLE `SolutionTask`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Subject`
--
ALTER TABLE `Subject`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Lesson`
--
ALTER TABLE `Lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `ClassTable` (`id`),
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`TeacherId`) REFERENCES `teacher` (`Id`);

--
-- Constraints for table `Mark`
--
ALTER TABLE `Mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`StudentId`) REFERENCES `Student` (`id`),
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`TaskId`) REFERENCES `Task` (`Id`);

--
-- Constraints for table `SolutionTask`
--
ALTER TABLE `SolutionTask`
  ADD CONSTRAINT `solutiontask_ibfk_1` FOREIGN KEY (`TaskId`) REFERENCES `Task` (`Id`),
  ADD CONSTRAINT `solutiontask_ibfk_2` FOREIGN KEY (`StudentId`) REFERENCES `Student` (`id`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`ClassId`) REFERENCES `ClassTable` (`id`);

--
-- Constraints for table `Task`
SET FOREIGN_KEY_CHECKS=0
--
ALTER TABLE `Task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`LessonID`) REFERENCES `Lesson` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `Subject` (`Id`),
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`ClassId`) REFERENCES `ClassTable` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `Subject` (`Id`);
COMMIT;

SET FOREIGN_KEY_CHECKS=1

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
