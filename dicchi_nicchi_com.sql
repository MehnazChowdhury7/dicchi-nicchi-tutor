-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 09:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dicchi_nicchi.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(100) NOT NULL,
  `d_id` int(100) NOT NULL,
  `area_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `d_id`, `area_name`) VALUES
(1, 1, 'nikunja-1'),
(2, 1, 'nikunja-2'),
(3, 2, 'halisahar'),
(4, 2, 'nasirabad'),
(5, 3, 'sadar'),
(6, 3, 'chagolnaiya');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(100) NOT NULL,
  `class_name` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `day_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_name`) VALUES
(1, 'Saturday'),
(2, 'Sunday'),
(3, 'Monday'),
(4, 'Tuesday'),
(5, 'Wednesday'),
(6, 'Thursday'),
(7, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(100) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`) VALUES
(1, 'Dhaka'),
(2, 'ctg'),
(3, 'feni'),
(4, 'rajbari');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `medium`
--

CREATE TABLE `medium` (
  `id` int(11) NOT NULL,
  `medium_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medium`
--

INSERT INTO `medium` (`id`, `medium_name`) VALUES
(1, 'Bangla'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `parentregistration`
--

CREATE TABLE `parentregistration` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `mobile` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_admin_approve` int(100) NOT NULL DEFAULT 0,
  `approved_by` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parentregistration`
--

INSERT INTO `parentregistration` (`id`, `username`, `email`, `password`, `image`, `mobile`, `status`, `is_admin_approve`, `approved_by`) VALUES
(19, 'fahad1', 'fahad1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PP_60b7b90ba286a7.42722066.jpg', '01827537225', 1, 1, 1),
(20, 'fahad2', 'fahad2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PP_60b7b92e98e846.19189329.jpg', '01827537226', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parent_tution_payment`
--

CREATE TABLE `parent_tution_payment` (
  `id` int(11) NOT NULL,
  `tution_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_type` varchar(100) NOT NULL,
  `is_admin_approve` tinyint(4) NOT NULL DEFAULT 0,
  `approved_by` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_tution_payment`
--

INSERT INTO `parent_tution_payment` (`id`, `tution_id`, `amount`, `transaction_id`, `transaction_date`, `transaction_type`, `is_admin_approve`, `approved_by`) VALUES
(20, 46, 120, 'SSLCZ_TEST_60ebc229a9f46', '2021-07-12 04:22:16', 'BKASH-BKash', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `parent_id` int(100) NOT NULL,
  `studentname` varchar(100) NOT NULL,
  `studentclass` int(100) NOT NULL,
  `medium` int(100) NOT NULL,
  `studentgender` int(100) NOT NULL,
  `studentDistrict` int(100) NOT NULL,
  `studentArea` int(100) NOT NULL,
  `studentimage` varchar(100) NOT NULL,
  `status` int(100) NOT NULL DEFAULT 0,
  `is_admin_approve` int(100) NOT NULL DEFAULT 0,
  `approved_by` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `parent_id`, `studentname`, `studentclass`, `medium`, `studentgender`, `studentDistrict`, `studentArea`, `studentimage`, `status`, `is_admin_approve`, `approved_by`) VALUES
(3, 19, 'toma1', 1, 1, 1, 1, 1, 'PP_60e8b865ef5ab3.34279324.jpg', 1, 1, 1),
(4, 19, 'toma2', 1, 1, 2, 1, 1, 'PP_60e8b89b9253d8.22793991.jpg', 1, 1, 1),
(5, 19, 'toma3', 9, 2, 2, 2, 3, 'PP_60e8b8e4bea440.34995685.jpg', 1, 1, 1),
(6, 20, 'toma4', 8, 1, 1, 3, 5, 'PP_60e8b9242aa273.83638500.jpg', 1, 1, 1),
(7, 19, 'taom5', 6, 1, 2, 2, 3, 'PP_60e940505cf994.90982227.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(100) NOT NULL,
  `studentname` varchar(100) NOT NULL,
  `studentclass` int(100) NOT NULL,
  `medium` int(100) NOT NULL,
  `subject` int(100) NOT NULL,
  `Offer_Salary` int(100) NOT NULL,
  `studentgender` int(100) NOT NULL,
  `studentDistrict` int(100) NOT NULL,
  `studentArea` int(100) NOT NULL,
  `studentimage` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_admin_approve` int(100) NOT NULL DEFAULT 0,
  `approved_by` int(100) NOT NULL DEFAULT 0,
  `tution_days` varchar(100) NOT NULL,
  `tution_time_from` time NOT NULL,
  `tution_time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `student_id`, `parent_id`, `studentname`, `studentclass`, `medium`, `subject`, `Offer_Salary`, `studentgender`, `studentDistrict`, `studentArea`, `studentimage`, `status`, `is_admin_approve`, `approved_by`, `tution_days`, `tution_time_from`, `tution_time_to`) VALUES
(41, 4, 19, 'toma2', 1, 1, 1, 5000, 2, 1, 1, 'PP_60e8b89b9253d8.22793991.jpg', 1, 0, 0, ' 1 , 2 , 3 , 4 , 5 , 6', '15:00:00', '16:00:00'),
(42, 5, 19, 'toma3', 9, 2, 5, 1000, 2, 2, 3, 'PP_60e8b8e4bea440.34995685.jpg', 1, 0, 0, ' 1', '18:00:00', '19:00:00'),
(43, 6, 20, 'toma4', 8, 1, 3, 500, 1, 3, 5, 'PP_60e8b9242aa273.83638500.jpg', 1, 0, 0, '1', '10:00:00', '11:00:00'),
(45, 3, 19, 'toma1', 1, 1, 1, 1000, 1, 1, 1, 'PP_60e8b865ef5ab3.34279324.jpg', 1, 0, 0, ' 1 , 5', '14:00:00', '15:00:00'),
(46, 3, 19, 'toma1', 1, 1, 1, 1200, 1, 1, 1, 'PP_60e8b865ef5ab3.34279324.jpg', 1, 0, 0, ' 1 , 5', '10:00:00', '11:00:00'),
(47, 3, 19, 'toma1', 1, 1, 2, 1200, 1, 1, 1, 'PP_60e8b865ef5ab3.34279324.jpg', 1, 0, 0, '1, 5', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`) VALUES
(1, 'Bangla'),
(2, 'English'),
(3, 'Math'),
(4, 'Biology'),
(5, 'Chemistry'),
(6, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `tution`
--

CREATE TABLE `tution` (
  `id` int(11) NOT NULL,
  `parent_id` int(100) NOT NULL,
  `teacher_id` int(100) NOT NULL,
  `student_id` int(100) NOT NULL,
  `tution_info_id` int(100) NOT NULL,
  `status` int(100) NOT NULL COMMENT '1= parent request to tutor\r\n2= tutor request to a parent\r\n3= tutor accept a request\r\n4= parent accept a request\r\n5= tutor rejects the request\r\n6= parent reject the request\r\n7= admin approved parent request\r\n8= admin unapproved parent request\r\n9= confirmed\r\n10= delete\r\n11= admin approved tutor request\r\n12= admin unapproved tutor parent request',
  `started_date` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `parent_is_pay` tinyint(4) NOT NULL DEFAULT 0,
  `tutor_is_pay` tinyint(4) NOT NULL DEFAULT 0,
  `parent_payment_id` int(100) NOT NULL,
  `tutor_payment_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tution`
--

INSERT INTO `tution` (`id`, `parent_id`, `teacher_id`, `student_id`, `tution_info_id`, `status`, `started_date`, `approved_by`, `parent_is_pay`, `tutor_is_pay`, `parent_payment_id`, `tutor_payment_id`) VALUES
(46, 19, 9, 46, 32, 9, '2021-07-11 18:00:00', 1, 1, 0, 20, 0),
(47, 19, 9, 45, 30, 9, '2021-07-11 18:00:00', 1, 0, 1, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tution_info`
--

CREATE TABLE `tution_info` (
  `id` int(11) NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `medium` int(100) NOT NULL,
  `TeacherClass` int(100) NOT NULL,
  `TeacherSubject` int(100) NOT NULL,
  `Tutor_Salary` int(100) NOT NULL,
  `status` int(100) NOT NULL DEFAULT 1,
  `tutor_tution_days` varchar(100) NOT NULL,
  `tutor_tution_time_from` time NOT NULL,
  `tutor_tution_time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tution_info`
--

INSERT INTO `tution_info` (`id`, `tutor_id`, `medium`, `TeacherClass`, `TeacherSubject`, `Tutor_Salary`, `status`, `tutor_tution_days`, `tutor_tution_time_from`, `tutor_tution_time_to`) VALUES
(12, 11, 1, 8, 3, 500, 1, '', '00:00:00', '00:00:00'),
(30, 9, 1, 1, 1, 1000, 0, ' 1 , 5', '14:00:00', '15:00:00'),
(31, 9, 1, 1, 1, 1000, 1, ' 1 , 3 , 5', '13:00:00', '14:00:00'),
(32, 9, 1, 1, 1, 1200, 1, ' 1 , 5', '10:00:00', '11:00:00'),
(33, 9, 1, 1, 1, 1200, 1, ' 1 , 2 , 3 , 4 , 5 , 6', '15:00:00', '16:00:00'),
(34, 10, 1, 7, 2, 1200, 1, ' 1 , 5', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tutorregistration`
--

CREATE TABLE `tutorregistration` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `tutorgender` int(100) NOT NULL,
  `TutorDistrict` int(100) NOT NULL,
  `TutorArea` int(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `is_admin_approve` int(100) NOT NULL DEFAULT 0,
  `approved_by` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutorregistration`
--

INSERT INTO `tutorregistration` (`id`, `username`, `email`, `password`, `mobile`, `image`, `tutorgender`, `TutorDistrict`, `TutorArea`, `status`, `is_admin_approve`, `approved_by`) VALUES
(9, 'fahim1', 'fahim1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01817109985', 'PP_60b7ba1c231447.81307942.jpg', 1, 1, 1, 1, 1, 1),
(10, 'fahim2', 'fahim2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01817109986', 'PP_60b7ba484e5224.64804674.jpg', 1, 1, 2, 1, 1, 1),
(11, 'fahim3', 'fahim3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01817109987', 'PP_60b7ba71524e55.32353915.jpg', 1, 3, 5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutor_tution_payment`
--

CREATE TABLE `tutor_tution_payment` (
  `id` int(11) NOT NULL,
  `tution_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `transaction_id` int(100) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_type` varchar(100) NOT NULL,
  `is_admin_approve` int(11) NOT NULL DEFAULT 0,
  `approved_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor_tution_payment`
--

INSERT INTO `tutor_tution_payment` (`id`, `tution_id`, `amount`, `transaction_id`, `transaction_date`, `transaction_type`, `is_admin_approve`, `approved_by`) VALUES
(7, 47, 100, 0, '2021-07-12 06:01:24', 'BKASH-BKash', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medium`
--
ALTER TABLE `medium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parentregistration`
--
ALTER TABLE `parentregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_tution_payment`
--
ALTER TABLE `parent_tution_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tution`
--
ALTER TABLE `tution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tution_info`
--
ALTER TABLE `tution_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorregistration`
--
ALTER TABLE `tutorregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor_tution_payment`
--
ALTER TABLE `tutor_tution_payment`
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
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medium`
--
ALTER TABLE `medium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parentregistration`
--
ALTER TABLE `parentregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `parent_tution_payment`
--
ALTER TABLE `parent_tution_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tution`
--
ALTER TABLE `tution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tution_info`
--
ALTER TABLE `tution_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tutorregistration`
--
ALTER TABLE `tutorregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tutor_tution_payment`
--
ALTER TABLE `tutor_tution_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
