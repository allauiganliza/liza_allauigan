-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 03:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
 Database: `saris`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `prerequisite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_description`, `units`, `prerequisite`) VALUES
(5, '22', 'ITWS02', 6, 'web'),
(6, 'BSIT-2B', 'Information Tech', 5, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `prerequisite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_description`, `units`, `prerequisite`) VALUES
(1, 'IT 222', 'Networking 1', 3, 'Information Management'),
(2, 'IT 224', 'Integrative Programming and Technologies', 3, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `studentno` int(11) NOT NULL,
  `last` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`studentno`, `last`, `first`, `middle`, `gender`) VALUES
(1, 'allauigan', 'liza', 'p', 'Female'),
(2, 'Bautista', 'Liza Marie', 'U', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `username`, `password`, `role`) VALUES
(4, 'liza', '$2y$10$yD3mZqaJJMutV/fAL2nrEu/og3dQtIZHqWhB2GaxgAL8EHDixFXu6', 'admin'),
(5, 'user', '$2y$10$tXC4n13OI8gwPRbUxwx3/OiBW.OjvIe4SD6.JcPMSsJh//woK/TCy', 'user'),
(6, 'admin', '$2y$10$dJVz0YD.On2P2c9hRTgZSuRZFW8GSWUxSCdfjyllUj837leJETAp.', 'admin'),
(7, 'a', '$2y$10$.VpnVgF4BtxQ1EKJJStqQ.z4xjxpSSQpUeH3bEB1.ac.GpwDmwqbO', 'admin'),
(8, 'd', '$2y$10$tfyLAgP8jKwDAJCid5kH7Oud.XVHyHbTBVnRw.mwGWMXyv6Wl0tm6', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `transactions1`
--

CREATE TABLE `transactions1` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subjcode` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions1`
--

INSERT INTO `transactions1` (`id`, `student_id`, `subjcode`, `semester`, `created_at`) VALUES
(1, 1, 'IT 224', '2nd', '2024-06-09 13:35:59'),
(3, 2, 'IT 222', '1st', '2024-06-09 13:40:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`studentno`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `transactions1`
--
ALTER TABLE `transactions1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `studentno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions1`
--
ALTER TABLE `transactions1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
