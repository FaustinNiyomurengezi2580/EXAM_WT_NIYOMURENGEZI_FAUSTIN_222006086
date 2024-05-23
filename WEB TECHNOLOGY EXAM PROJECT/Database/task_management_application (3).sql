-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `role`, `created_at`, `password`) VALUES
(1, 'FAUSTIN KAGAGEMA MURENGEZI', 'faustinniyomurengezi@gmail.com', 'Project Manager', '2024-05-19 14:26:51', '222006086'),
(2, 'Chrisss Shema', 'shema@gmail.com', 'Instructor', '2024-05-21 20:01:30', '222006086'),
(3, 'Kabarungi Jeannette', 'kabarungi@gmail.com', 'Project Analyser', '2024-05-22 09:01:53', '111000111');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AssignmentID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `AssignedUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`AssignmentID`, `ProjectID`, `TaskID`, `AssignedUserID`) VALUES
(1, 1, 1, 1),
(2, 4, 4, 4),
(4, 3, 3, 3),
(5, 4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `AttachmentID` int(11) NOT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `FileName` varchar(255) NOT NULL,
  `FileType` varchar(50) NOT NULL,
  `FileLocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`AttachmentID`, `TaskID`, `ProjectID`, `UserID`, `Timestamp`, `FileName`, `FileType`, `FileLocation`) VALUES
(3, 1, 1, 1, '2024-05-18 20:37:51', 'Academic Year Tasks', 'Study for Mathematics Exam', 'library'),
(4, 2, 2, 2, '2024-05-18 20:41:59', 'Team Collaboration Tasks', 'Prepare Presentation for Client Meeting', 'Directory');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `TaskID`, `ProjectID`, `UserID`, `Timestamp`, `Content`) VALUES
(1, 1, 1, 1, '0000-00-00 00:00:00', 'Great project! Consider adding more input validation, user authentication, and more responsive design for better usability.'),
(2, 2, 2, 2, '0000-00-00 00:00:00', 'User Auntentication and safety');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `RecipientUserID` int(11) NOT NULL,
  `SenderUserID` int(11) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `NotificationType` varchar(50) NOT NULL,
  `Content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `RecipientUserID`, `SenderUserID`, `Timestamp`, `NotificationType`, `Content`) VALUES
(1, 1, 1, '2024-05-18 13:18:29', 'Tasks Assignment', 'New Task Assigned'),
(2, 2, 2, '2024-05-18 13:51:07', 'Project Update Notification', 'Project Update'),
(3, 4, 4, '2024-05-19 07:22:57', 'Chandes notifications', 'Descriptions Of Changes Occured in the system');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `Title`, `Description`, `StartDate`, `EndDate`) VALUES
(1, 'Tasks Manager', 'Monitoring All The Tasks', '2024-05-21', '2024-07-01'),
(3, 'Projects Analyser', 'Analysing All projects before the launching period', '2024-05-14', '2025-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `TagID` int(11) NOT NULL,
  `TagName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagID`, `TagName`) VALUES
(6, 'Omah'),
(7, 'Niyo Faustin'),
(8, 'Murengezi Rogrigue'),
(9, 'Sandrine Irasubiza');

-- --------------------------------------------------------

--
-- Table structure for table `taskdependencies`
--

CREATE TABLE `taskdependencies` (
  `DependencyID` int(11) NOT NULL,
  `DependentTaskID` int(11) NOT NULL,
  `PrerequisiteTaskID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taskdependencies`
--

INSERT INTO `taskdependencies` (`DependencyID`, `DependentTaskID`, `PrerequisiteTaskID`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `taskhistory`
--

CREATE TABLE `taskhistory` (
  `HistoryID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `OldValue` varchar(255) DEFAULT NULL,
  `NewValue` varchar(255) DEFAULT NULL,
  `ChangeDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taskhistory`
--

INSERT INTO `taskhistory` (`HistoryID`, `TaskID`, `UserID`, `Timestamp`, `OldValue`, `NewValue`, `ChangeDescription`) VALUES
(1, 1, 1, '2024-08-21 14:53:00', 'Incomplete', 'Complete', 'Description of all the Change'),
(2, 2, 2, '2024-05-15 10:00:00', '0.5', '1.5', 'Tasks View'),
(3, 3, 3, '2024-05-01 10:00:00', '10.8', '8.0', 'task created'),
(4, 4, 4, '2024-05-14 10:00:00', '2.80', '4.8', 'coordinater');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Priority` int(11) DEFAULT NULL,
  `Status` varchar(50) NOT NULL,
  `AssignedUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `Title`, `Description`, `DueDate`, `Priority`, `Status`, `AssignedUserID`) VALUES
(1, 'Time Tracking', 'Monitor all the time spent on each task and project.', '2024-05-31', 1, 'pending', 1),
(2, 'Document Management', 'Store, organize, and sharing documents.', '2024-05-30', 2, 'in progress', 2),
(3, 'Analytics and Reporting', 'Gain insights into team performances.', '2024-04-30', 3, 'Completed', 3),
(4, 'Notifications and Reminders', 'Staying updated with real-time notifications.', '2024-06-01', 2, 'pending', 1),
(5, 'Document Management', 'Store, organize, and share documents.', '2024-06-02', 3, 'in progress', 2),
(8, 'Team Collaboration', 'Collaborate with all team members in real-time.', '2024-06-05', 3, 'in progress', 2),
(9, 'Task Prioritization', 'Prioritize all tasks to focus on what\'s important.', '2024-06-06', 1, 'completed', 3),
(10, 'Resource Allocation', 'Allocate all the \r\nresources efficiently to tasks and projects.', '2024-06-07', 2, 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `Role`) VALUES
(3, 'emmery', 'intwari@gmail.com', '4545', 'user'),
(4, 'NiyomurengeziFaustin', 'niyomurengezifaustin222006086@gmail.com', '89890', 'user'),
(5, 'christian', 'rugemana@gmail.com', '454545', 'user'),
(6, 'SHEMA', 'SHEMA@gmail.com', '7878734', 'user'),
(7, 'lamar', 'lamarjp@gmail.com', '44444', 'user'),
(8, 'emmery', 'intwariemmery1@gmail.com', '454665', 'user'),
(9, 'emmery', 'intwariemmery@gmail.com', '67676', 'user'),
(10, 'momo', 'moshionking@gmail.com', '90909', 'user'),
(11, 'kagabe', 'kagabe@gmail.com', '6767677', 'user'),
(12, 'kayhura', 'kayihura@gmail.com', '123', 'user'),
(13, 'faustin', 'faustinniyomurengezi@gmail.com', '12345', 'user'),
(14, 'prince king', 'king@gmail.com', '22200890', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `TaskID` (`TaskID`),
  ADD KEY `AssignedUserID` (`AssignedUserID`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`AttachmentID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TagID`);

--
-- Indexes for table `taskdependencies`
--
ALTER TABLE `taskdependencies`
  ADD PRIMARY KEY (`DependencyID`),
  ADD KEY `DependentTaskID` (`DependentTaskID`),
  ADD KEY `PrerequisiteTaskID` (`PrerequisiteTaskID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `AttachmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `TagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taskdependencies`
--
ALTER TABLE `taskdependencies`
  MODIFY `DependencyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `taskdependencies`
--
ALTER TABLE `taskdependencies`
  ADD CONSTRAINT `taskdependencies_ibfk_1` FOREIGN KEY (`DependentTaskID`) REFERENCES `tasks` (`TaskID`),
  ADD CONSTRAINT `taskdependencies_ibfk_2` FOREIGN KEY (`PrerequisiteTaskID`) REFERENCES `tasks` (`TaskID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
