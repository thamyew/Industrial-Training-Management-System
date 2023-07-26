-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 04:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `industrialtrainingdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_staff_no` varchar(10) NOT NULL,
  `admin_ic` varchar(20) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_address` varchar(100) NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_staff_no`, `admin_ic`, `admin_name`, `admin_address`, `admin_phone`, `admin_email`, `admin_username`) VALUES
('AD003', '821221016271', 'Admin Admin', '31, Jalan ccc, Johor Bahru, Johor, Malaysia', '0192727181', 'admin132@email.com', 'admin132'),
('AD023', '790921012133', 'Razak bin Osman', '12, Jalan 001, Johor Bahru, Malaysia', '0192837619', 'admin0921@email.com', 'admin0921'),
('admin', '012345678', 'admin', '13, Jalan bbb, Johor, Malaysia', '012377777777', 'admin@email.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `coor_staff_no` varchar(10) NOT NULL,
  `coor_ic` varchar(20) NOT NULL,
  `coor_name` varchar(50) NOT NULL,
  `coor_address` varchar(100) NOT NULL,
  `coor_phone` varchar(20) NOT NULL,
  `coor_email` varchar(30) NOT NULL,
  `coor_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coor_staff_no`, `coor_ic`, `coor_name`, `coor_address`, `coor_phone`, `coor_email`, `coor_username`) VALUES
('ST001', '870112019828', 'Aisyah binti Musa', '120, Jalan B, Taman C, Johor Bahru, Johor', '0158192311', 'aisyah@email.com', 'st001coor'),
('ST002', '900131018271', 'Kang King', '12, Jalan 81, Taman A, Johor Bahru, Johor, Malaysia', '0123912398', 'kk@email.com', 'coor123'),
('ST003', '920412011244', 'Yong Yan', '12, Jalan G, Taman Z, Johor Bahru, Johor', '0162392910', 'yongyan@email.com', 'st003coor');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_username` varchar(20) NOT NULL,
  `login_password` varchar(20) NOT NULL,
  `login_usertype` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_username`, `login_password`, `login_usertype`) VALUES
('admin', 'admin', 'Admin'),
('admin0921', 'admin0921#', 'Admin'),
('admin132', '#admin132', 'Admin'),
('bobby123', '$bobby', 'Student'),
('coor123', '#coor123', 'Coordinator'),
('murshid', '#qe12', 'Student'),
('nafeesa0111', '*nafeesa', 'Student'),
('st001coor', '#st123', 'Coordinator'),
('st003coor', '#iwoq1', 'Coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `practicaltrainingapplication`
--

CREATE TABLE `practicaltrainingapplication` (
  `application_id` int(6) UNSIGNED NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_phone` varchar(20) NOT NULL,
  `company_email` varchar(30) NOT NULL,
  `training_startdate` date NOT NULL,
  `training_enddate` date NOT NULL,
  `application_result` varchar(10) NOT NULL DEFAULT 'In Review',
  `stud_matric_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `practicaltrainingapplication`
--

INSERT INTO `practicaltrainingapplication` (`application_id`, `company_name`, `company_address`, `company_phone`, `company_email`, `training_startdate`, `training_enddate`, `application_result`, `stud_matric_no`) VALUES
(1, 'Inte', '41, Jalan 33, Johor Bahru, Johor', '071231234', 'inte@email.com', '2022-07-03', '2022-11-09', 'In Review', 'A20EC0012'),
(2, 'Ucomn', '11, Jalan 10, Johor Bahru, Johor', '071348888', 'ucomn@email.com', '2022-06-13', '2022-09-07', 'In Review', 'A20EC0111'),
(3, 'BomChad', '11, Jalan 02, Kuala Lumpur, Malaysia', '037712011', 'bomchad@email.com', '2022-06-07', '2022-09-06', 'In Review', 'A20EC0134'),
(4, 'ABC', '99, Jalan 11, Penang, Malaysia', '073211255', 'abc@email.com', '2022-06-26', '2022-07-26', 'In Review', 'A20EC0012'),
(5, 'Jackel', '22, Jalan 01, Johor Bahru, Johor', '071928887', 'jackel@email.com', '2022-07-11', '2022-12-01', 'In Review', 'A20EC0111');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_matric_no` varchar(10) NOT NULL,
  `stud_ic` varchar(20) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `stud_address` varchar(100) NOT NULL,
  `stud_phone` varchar(20) NOT NULL,
  `stud_email` varchar(30) NOT NULL,
  `stud_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_matric_no`, `stud_ic`, `stud_name`, `stud_address`, `stud_phone`, `stud_email`, `stud_username`) VALUES
('A20EC0012', '000111014232', 'Nafeesa binti Quraish', '40, Jalan F, Taman E, Johor Bahru, Johor', '0178821912', 'nafeesa@email.com', 'nafeesa0111'),
('A20EC0111', '000812012811', 'Murshid bin Qaasim', '11, Jalan D, Taman G, Johor Bahru, Johor', '0132127777', 'murshid@email.com', 'murshid'),
('A20EC0134', '000421012311', 'Bobby', '19, Jalan O, Taman P, Johor Bahru, Johor', '0159123231', 'bobby@email.com', 'bobby123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_staff_no`),
  ADD UNIQUE KEY `admin_ic` (`admin_ic`),
  ADD UNIQUE KEY `admin_phone` (`admin_phone`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD KEY `admin_username` (`admin_username`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`coor_staff_no`),
  ADD UNIQUE KEY `coor_ic` (`coor_ic`),
  ADD UNIQUE KEY `coor_phone` (`coor_phone`),
  ADD UNIQUE KEY `coor_email` (`coor_email`),
  ADD KEY `coor_username` (`coor_username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_username`);

--
-- Indexes for table `practicaltrainingapplication`
--
ALTER TABLE `practicaltrainingapplication`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `stud_matric_no` (`stud_matric_no`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_matric_no`),
  ADD UNIQUE KEY `stud_ic` (`stud_ic`),
  ADD UNIQUE KEY `stud_phone` (`stud_phone`),
  ADD UNIQUE KEY `stud_email` (`stud_email`),
  ADD KEY `stud_username` (`stud_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `practicaltrainingapplication`
--
ALTER TABLE `practicaltrainingapplication`
  MODIFY `application_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_username`) REFERENCES `login` (`login_username`);

--
-- Constraints for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD CONSTRAINT `coordinator_ibfk_1` FOREIGN KEY (`coor_username`) REFERENCES `login` (`login_username`);

--
-- Constraints for table `practicaltrainingapplication`
--
ALTER TABLE `practicaltrainingapplication`
  ADD CONSTRAINT `practicaltrainingapplication_ibfk_1` FOREIGN KEY (`stud_matric_no`) REFERENCES `student` (`stud_matric_no`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`stud_username`) REFERENCES `login` (`login_username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
