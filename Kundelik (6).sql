-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2024 at 05:28 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

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

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id`, `name`) VALUES
(1, 'IvanD');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `abonent_1` bigint UNSIGNED NOT NULL,
  `abonent_2` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `abonent_1`, `abonent_2`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2024-01-19 13:49:09', '2024-01-19 13:49:09'),
(2, 4, 5, '2024-01-19 14:44:41', '2024-01-19 14:44:41'),
(3, 4, 3, '2024-01-20 01:17:01', '2024-01-20 01:17:01'),
(4, 5, 1, '2024-01-20 13:48:03', '2024-01-20 13:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `ClassTable`
--

CREATE TABLE `ClassTable` (
  `id` bigint UNSIGNED NOT NULL,
  `ClassName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ClassTable`
--

INSERT INTO `ClassTable` (`id`, `ClassName`, `grade`) VALUES
(1, 'G', '10');

-- --------------------------------------------------------

--
-- Table structure for table `Exam`
--

CREATE TABLE `Exam` (
  `id` bigint UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectId` bigint UNSIGNED NOT NULL,
  `classId` bigint UNSIGNED NOT NULL,
  `duration` int NOT NULL,
  `startDate` datetime NOT NULL,
  `ExamfilePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `downloaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Exam`
--

INSERT INTO `Exam` (`id`, `Name`, `subjectId`, `classId`, `duration`, `startDate`, `ExamfilePath`, `verified`, `downloaded`) VALUES
(1, 'Sor', 1, 1, 2, '2024-02-28 22:00:00', 'exam_files/1709049671_Diagram.rar', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ExamMark`
--

CREATE TABLE `ExamMark` (
  `id` bigint UNSIGNED NOT NULL,
  `MarkNumber` int UNSIGNED NOT NULL,
  `MarkDate` date NOT NULL,
  `MaxMarkNumber` int UNSIGNED NOT NULL DEFAULT '10',
  `ExamId` bigint UNSIGNED NOT NULL,
  `StudentId` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` bigint UNSIGNED NOT NULL,
  `LessonDate` date NOT NULL,
  `LessonNumber` int NOT NULL,
  `classId` bigint UNSIGNED NOT NULL,
  `TeacherId` bigint UNSIGNED NOT NULL,
  `classroom` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `LessonDate`, `LessonNumber`, `classId`, `TeacherId`, `classroom`, `created_at`, `updated_at`) VALUES
(45, '2024-01-03', 1, 1, 3, 546, NULL, NULL),
(46, '2024-01-03', 2, 1, 3, 546, NULL, NULL),
(47, '2024-01-03', 3, 1, 3, 546, NULL, NULL),
(48, '2024-01-03', 4, 1, 3, 546, NULL, NULL),
(49, '2024-01-03', 5, 1, 3, 546, NULL, NULL),
(50, '2024-01-03', 6, 1, 3, 546, NULL, NULL),
(51, '2024-01-03', 7, 1, 3, 546, NULL, NULL),
(52, '2024-01-03', 8, 1, 3, 546, NULL, NULL),
(53, '2024-01-03', 9, 1, 3, 546, NULL, NULL),
(54, '2024-01-01', 1, 1, 3, 546, NULL, NULL),
(55, '2024-01-01', 2, 1, 3, 546, NULL, NULL),
(56, '2024-01-01', 3, 1, 3, 546, NULL, NULL),
(57, '2024-01-01', 4, 1, 3, 546, NULL, NULL),
(58, '2024-01-01', 5, 1, 3, 546, NULL, NULL),
(59, '2024-01-01', 6, 1, 3, 546, NULL, NULL),
(60, '2024-01-01', 7, 1, 3, 546, NULL, NULL),
(61, '2024-01-01', 8, 1, 3, 546, NULL, NULL),
(62, '2024-01-01', 9, 1, 3, 546, NULL, NULL),
(63, '2024-01-08', 1, 1, 3, 546, NULL, NULL),
(64, '2024-01-08', 2, 1, 3, 546, NULL, NULL),
(65, '2024-01-08', 3, 1, 3, 546, NULL, NULL),
(66, '2024-01-08', 4, 1, 3, 546, NULL, NULL),
(67, '2024-01-08', 5, 1, 3, 546, NULL, NULL),
(68, '2024-01-08', 6, 1, 3, 546, NULL, NULL),
(69, '2024-01-08', 7, 1, 3, 546, NULL, NULL),
(70, '2024-01-08', 8, 1, 3, 546, NULL, NULL),
(71, '2024-01-08', 9, 1, 3, 546, NULL, NULL),
(72, '2024-01-15', 1, 1, 3, 546, NULL, NULL),
(73, '2024-01-15', 2, 1, 3, 546, NULL, NULL),
(74, '2024-01-15', 3, 1, 3, 546, NULL, NULL),
(75, '2024-01-15', 4, 1, 3, 546, NULL, NULL),
(76, '2024-01-15', 5, 1, 3, 546, NULL, NULL),
(77, '2024-01-15', 6, 1, 3, 546, NULL, NULL),
(78, '2024-01-15', 7, 1, 3, 546, NULL, NULL),
(79, '2024-01-15', 8, 1, 3, 546, NULL, NULL),
(80, '2024-01-15', 9, 1, 3, 546, NULL, NULL),
(81, '2024-01-22', 1, 1, 3, 546, NULL, NULL),
(82, '2024-01-22', 2, 1, 3, 546, NULL, NULL),
(83, '2024-01-22', 3, 1, 3, 546, NULL, NULL),
(84, '2024-01-22', 4, 1, 3, 546, NULL, NULL),
(85, '2024-01-22', 5, 1, 3, 546, NULL, NULL),
(86, '2024-01-22', 6, 1, 3, 546, NULL, NULL),
(87, '2024-01-22', 7, 1, 3, 546, NULL, NULL),
(88, '2024-01-22', 8, 1, 3, 546, NULL, NULL),
(89, '2024-01-22', 9, 1, 3, 546, NULL, NULL),
(90, '2024-01-29', 1, 1, 3, 546, NULL, NULL),
(91, '2024-01-29', 2, 1, 3, 546, NULL, NULL),
(92, '2024-01-29', 3, 1, 3, 546, NULL, NULL),
(93, '2024-01-29', 4, 1, 3, 546, NULL, NULL),
(94, '2024-01-29', 5, 1, 3, 546, NULL, NULL),
(95, '2024-01-29', 6, 1, 3, 546, NULL, NULL),
(96, '2024-01-29', 7, 1, 3, 546, NULL, NULL),
(97, '2024-01-29', 8, 1, 3, 546, NULL, NULL),
(98, '2024-01-29', 9, 1, 3, 546, NULL, NULL),
(99, '2024-02-01', 1, 1, 2, 546, NULL, NULL),
(100, '2024-02-08', 1, 1, 2, 546, NULL, NULL),
(101, '2024-02-15', 1, 1, 2, 546, NULL, NULL),
(102, '2024-02-22', 1, 1, 2, 546, NULL, NULL),
(103, '2024-02-29', 1, 1, 2, 546, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Mark`
--

CREATE TABLE `Mark` (
  `id` bigint UNSIGNED NOT NULL,
  `MarkNumber` int UNSIGNED NOT NULL,
  `TaskId` bigint UNSIGNED NOT NULL,
  `StudentId` bigint UNSIGNED NOT NULL,
  `MarkDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Mark`
--

INSERT INTO `Mark` (`id`, `MarkNumber`, `TaskId`, `StudentId`, `MarkDate`) VALUES
(3, 8, 3, 1, '2024-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_id` bigint UNSIGNED NOT NULL,
  `create_time` timestamp NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `recipient_id` bigint UNSIGNED NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `create_time`, `author_id`, `recipient_id`, `message`) VALUES
(1, 3, '2024-01-20 08:12:34', 4, 3, 'Priv'),
(9, 3, '2024-01-20 08:25:34', 4, 3, 'Darova'),
(10, 2, '2024-01-20 13:56:42', 5, 4, 'Alo'),
(11, 2, '2024-01-20 13:58:15', 5, 4, 'Alo'),
(12, 2, '2024-01-20 13:59:24', 5, 4, 'Alo'),
(13, 2, '2024-01-20 13:59:34', 5, 4, 'Alo'),
(14, 2, '2024-01-20 13:59:45', 5, 4, 'Alo'),
(15, 2, '2024-01-20 13:59:50', 5, 4, 'Alo'),
(16, 2, '2024-01-20 14:00:23', 5, 4, 'Alo'),
(17, 2, '2024-01-20 14:21:17', 5, 4, 'Alo'),
(18, 2, '2024-01-20 14:21:36', 5, 4, 'Alo'),
(19, 2, '2024-01-20 16:06:45', 5, 4, 'Alo');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_30_083113_create_exam_models_table', 1),
(2, '2024_01_30_141300_create_solution_exam_models_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `PictureFilePath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `date`, `PictureFilePath`) VALUES
(9, 'test', '123', '2024-01-21', 'news_images/4FjzEAiqkdQjNFKMMOCCIFicS3qmRuyZtp5LZJtl.jpg'),
(10, 'TEst1', 'ewr', '2024-01-21', 'news_images/Gof9fMidFTJSLnwK0K2qRKpHROLAdTgxEjgyPifZ.jpg'),
(11, 'Test3', '123', '2024-01-21', 'news_images/QWhgOfnBDIFU2y3GQybvDzYTBDlfSgwGhZzP4zgV.png');

-- --------------------------------------------------------

--
-- Table structure for table `SolutionExam`
--

CREATE TABLE `SolutionExam` (
  `id` bigint UNSIGNED NOT NULL,
  `ExamId` bigint UNSIGNED NOT NULL,
  `StudentId` bigint UNSIGNED NOT NULL,
  `SolutionFilePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `downloaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SolutionTask`
--

CREATE TABLE `SolutionTask` (
  `id` bigint UNSIGNED NOT NULL,
  `TaskId` bigint UNSIGNED NOT NULL,
  `StudentId` bigint UNSIGNED NOT NULL,
  `SolutionFilePath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `downloaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `SolutionTask`
--

INSERT INTO `SolutionTask` (`id`, `TaskId`, `StudentId`, `SolutionFilePath`, `verified`, `downloaded`) VALUES
(1, 1, 1, 'solution_files/1705230442_1705213980_1_14_24.rar', 1, 1),
(2, 2, 1, 'solution_files/1705214013_UML_14.rar', 1, 1),
(3, 3, 1, 'solution_files/1709033631_Diagram.rar', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Thirdname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AvgMark` decimal(5,2) NOT NULL,
  `ClassId` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`id`, `name`, `Surname`, `Thirdname`, `AvgMark`, `ClassId`) VALUES
(1, 'Stud1', 'Stud1', 'Stud1', '4.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

CREATE TABLE `Subject` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Subject`
--

INSERT INTO `Subject` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Math', NULL, NULL),
(2, 'G', NULL, NULL),
(3, 'G', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `id` bigint UNSIGNED NOT NULL,
  `lessonId` bigint UNSIGNED NOT NULL,
  `subjectId` bigint UNSIGNED NOT NULL,
  `classId` bigint UNSIGNED NOT NULL,
  `deadline` datetime NOT NULL,
  `TaskfilePath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `downloaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`id`, `lessonId`, `subjectId`, `classId`, `deadline`, `TaskfilePath`, `verified`, `downloaded`) VALUES
(3, 103, 1, 1, '2024-02-29 00:00:00', 'task_files/1709030840_Diagram.rar', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Thirdname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SubjectID` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `Surname`, `Thirdname`, `SubjectID`) VALUES
(2, 'Teach1', 'Teach1', 'Teach1', 1),
(3, 'Teach2', 'Teach2', 'Teach2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserType` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserId` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `UserType`, `UserId`, `created_at`, `updated_at`) VALUES
(1, 'IvanD', '123456', 'Admin', 1, NULL, NULL),
(2, 'IvanD2', '$2y$10$rtHqn.BWZNkThq4e8nOk9uFmGWqrEfj71EI0WzPFBDL9hVf/D6dJa', 'admin', NULL, NULL, NULL),
(3, 'Teach1', '$2y$10$jFDu8wVScdcAdfoW37d8F.SzWc/JUhwRrcSKeH.Ezij/vcqlGW5C6', 'teacher', 2, NULL, NULL),
(4, 'Stud1', '$2y$10$3uHAep.gil968/3kWE7CpOfSwZn3j2aM00c3DRP62mUN6Oe01.jNm', 'student', 1, NULL, NULL),
(5, 'Teach2', '$2y$10$yXFN/k2F3OFpMTipVSx6h.lRx0q9nKO2pBZ6znV2GXNvlFPih76fa', 'teacher', 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_abonent_1_foreign` (`abonent_1`),
  ADD KEY `chats_abonent_2_foreign` (`abonent_2`);

--
-- Indexes for table `ClassTable`
--
ALTER TABLE `ClassTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Exam`
--
ALTER TABLE `Exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_subjectid_foreign` (`subjectId`),
  ADD KEY `exam_classid_foreign` (`classId`);

--
-- Indexes for table `ExamMark`
--
ALTER TABLE `ExamMark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_classid_foreign` (`classId`),
  ADD KEY `lesson_teacherid_foreign` (`TeacherId`);

--
-- Indexes for table `Mark`
--
ALTER TABLE `Mark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mark_taskid_foreign` (`TaskId`),
  ADD KEY `mark_studentid_foreign` (`StudentId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_chat_id_foreign` (`chat_id`),
  ADD KEY `messages_author_id_foreign` (`author_id`),
  ADD KEY `messages_recipient_id_foreign` (`recipient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SolutionExam`
--
ALTER TABLE `SolutionExam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solutionexam_examid_foreign` (`ExamId`),
  ADD KEY `solutionexam_studentid_foreign` (`StudentId`);

--
-- Indexes for table `SolutionTask`
--
ALTER TABLE `SolutionTask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solutiontask_taskid_foreign` (`TaskId`),
  ADD KEY `solutiontask_studentid_foreign` (`StudentId`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_classid_foreign` (`ClassId`);

--
-- Indexes for table `Subject`
--
ALTER TABLE `Subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_lessonid_foreign` (`lessonId`),
  ADD KEY `task_subjectid_foreign` (`subjectId`),
  ADD KEY `task_classid_foreign` (`classId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subjectid_foreign` (`SubjectID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ClassTable`
--
ALTER TABLE `ClassTable`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Exam`
--
ALTER TABLE `Exam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ExamMark`
--
ALTER TABLE `ExamMark`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `Mark`
--
ALTER TABLE `Mark`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `SolutionExam`
--
ALTER TABLE `SolutionExam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SolutionTask`
--
ALTER TABLE `SolutionTask`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Subject`
--
ALTER TABLE `Subject`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Exam`
--
ALTER TABLE `Exam`
  ADD CONSTRAINT `exam_classid_foreign` FOREIGN KEY (`classId`) REFERENCES `ClassTable` (`id`),
  ADD CONSTRAINT `exam_subjectid_foreign` FOREIGN KEY (`subjectId`) REFERENCES `Subject` (`id`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_classid_foreign` FOREIGN KEY (`classId`) REFERENCES `ClassTable` (`id`),
  ADD CONSTRAINT `lesson_teacherid_foreign` FOREIGN KEY (`TeacherId`) REFERENCES `teacher` (`id`);

--
-- Constraints for table `SolutionExam`
--
ALTER TABLE `SolutionExam`
  ADD CONSTRAINT `solutionexam_examid_foreign` FOREIGN KEY (`ExamId`) REFERENCES `Exam` (`id`),
  ADD CONSTRAINT `solutionexam_studentid_foreign` FOREIGN KEY (`StudentId`) REFERENCES `Student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
