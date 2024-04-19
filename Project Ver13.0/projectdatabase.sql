-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 10:14 AM
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
-- Database: `projectdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `ApplicationID` varchar(30) NOT NULL,
  `matric` varchar(9) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `organization_ID` int(10) UNSIGNED DEFAULT NULL,
  `training_ID` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`ApplicationID`, `matric`, `address`, `organization_ID`, `training_ID`, `status`) VALUES
('A1', 'A21EC0101', '67, Jalan Anggerik, Taman Anggerik, 75450 Melaka, Malaysia', 47, 18, 'Pending'),
('A10', 'A21EC0078', '31, Jalan Seri Permai, Taman Seri Permai, 58200 Kuala Lumpur, Malaysia', 45, 16, 'Pending'),
('A11', 'A21EC0142', '8, Jalan Harmoni, Taman Megah, 56000 Cheras, Kuala Lumpur, Malaysia', 49, 20, 'Pending'),
('A12', 'A21EC0142', '8, Jalan Harmoni, Taman Megah, 56000 Cheras, Kuala Lumpur, Malaysia', 44, 15, 'Pending'),
('A13', 'A20EC0044', '25, Jalan Cemerlang, Taman Desa Cemerlang, 81100 Johor Bahru, Johor, Malaysia', 4, 10, 'Pending'),
('A2', 'A21EC0101', '67, Jalan Anggerik, Taman Anggerik, 75450 Melaka, Malaysia', 45, 16, 'Pending'),
('A3', 'A21EC0176', '30, JALAN SENTOSA, TAMAN JORAK PERMAI, 84300, JOHOR.', 4, 10, 'Pending'),
('A4', 'A21EC0176', '30, JALAN SENTOSA, TAMAN JORAK PERMAI, 84300, JOHOR.', 44, 15, 'Pending'),
('A5', 'A21EC0148', '56, Jalan Bunga Raya, Taman Bukit Indah, 80200 Johor Bahru, Johor, Malaysia', 4, 9, 'Pending'),
('A6', 'A21EC0148', '56, Jalan Bunga Raya, Taman Bukit Indah, 80200 Johor Bahru, Johor, Malaysia', 45, 16, 'Pending'),
('A7', 'A21EC0148', '56, Jalan Bunga Raya, Taman Bukit Indah, 80200 Johor Bahru, Johor, Malaysia', 44, 15, 'Pending'),
('A8', 'A21EC0078', '31, Jalan Seri Permai, Taman Seri Permai, 58200 Kuala Lumpur, Malaysia', 46, 17, 'Pending'),
('A9', 'A21EC0078', '31, Jalan Seri Permai, Taman Seri Permai, 58200 Kuala Lumpur, Malaysia', 50, 21, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `coordinate_ID` int(11) NOT NULL,
  `firstName` varchar(75) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `organization_ID` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinate_ID`, `firstName`, `lastName`, `email`, `organization_ID`, `username`) VALUES
(1, 'GOH', 'SU', 'goh@outlook.com', 4, 'gohsu'),
(2, 'ADMAD', 'ABU', 'admad@gmail.com', 5, 'abuadmad'),
(3, 'ALI', 'HASSAN', 'ali.hassan@gmail.com', 44, 'ahassan'),
(4, 'YUSUF', 'KHAN', 'yusuf.khan@gmail.com', 45, 'ykhan'),
(5, 'AHMAD', 'IBRAHIM', 'ibrahim@gmail.com', 46, 'aibrahim'),
(6, 'FATIMA', 'FATIMA', 'fatima.hassan@gmail.com', 47, 'fhassan'),
(7, 'MARIAM', 'ALI', 'mariam.ali@gmail.com', 48, 'mali'),
(8, 'HASSAN', 'AHMED', 'hassan.ahmed@gmail.com', 49, 'hahmed'),
(9, 'JACK', 'LIM', 'limjack@hotrmal.com', 50, 'jacklim'),
(10, 'AMINA', 'KRAH', 'amina.krag@gmail.com', 51, 'akrah');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organization_ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_ID`, `name`, `address`, `type`) VALUES
(4, 'UNITY', '12 Jalan Utama, Cyberjaya, 63000 Selangor, Malaysia', 'System Builders'),
(5, 'EFUN', '89 Jalan Quantum, Ipoh, 30000 Perak, Malaysia', 'Gaming'),
(44, 'TECHNOBYTE', '56 Jalan Teknologi, Kuala Lumpur, 50450 Malaysia', 'IT'),
(45, 'CYBERTECH', '34 Jalan Digital, Petaling Jaya, 46000 Selangor, Malaysia', 'E-COMMERCE'),
(46, 'INFINITI COMPUTERS', '78 Jalan Infiniti, Penang, 10350, Malaysia', 'REPAIR AND SUPPORT'),
(47, 'TECHLINX', '12 Jalan TechLinx, Cyberjaya, 63000 Selangor, Malaysia', 'GAMING'),
(48, 'LOGICLEAP', '123 Jalan LogicLeap, Kota Kinabalu, 88000 Sabah, Malaysia', 'GAMING'),
(49, 'INNOVIX', '67 Jalan Innovix, Malacca City, 75000 Melaka, Malaysia', 'SYSTEM BUILDERS'),
(50, 'SPARKTECH', '32 Jalan SparkTech, Kuching, 93000 Sarawak, Malaysia', 'E-COMMERCE'),
(51, 'BYTEVERSE', '45 Jalan ByteVerse, Georgetown, 10000 Penang, Malaysia', 'REPAIR AND SUPPORT');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `matric` varchar(9) NOT NULL,
  `firstName` varchar(75) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `IC` varchar(12) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `gpa` decimal(4,2) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`matric`, `firstName`, `lastName`, `IC`, `gender`, `contact_no`, `email`, `year`, `course`, `gpa`, `username`) VALUES
('A20EC0044', 'HAIDAH', 'ABU', '000415034854', 'Female', '0154848158', 'haidah@graduate.utm.my', 1, 'COMPUTER NETWORKS AND SECURITY', 4.00, 'haidah'),
('A21EC0078', 'AIDA', 'ABUBAKAR', '020607230484', 'Female', '01648151154', 'aida@graduate.utm.my', 2, 'COMPUTER NETWORKS AND SECURITY', 4.00, 'aida'),
('A21EC0101', 'KAI ZHENG', 'NG', '010704028384', 'Male', '01323131455', 'kaizheng@graduate.utm.my', 2, 'GRAPHICS AND MULTIMEDIA', 4.00, 'kaizheng'),
('A21EC0142', 'CHIN HONG', 'LEW', '021014011804', 'Male', '0152454841', 'lewhong@graduate.utm.my', 2, 'BIOINFORMATICS', 4.00, 'lewhong'),
('A21EC0148', 'CHUN TECK', 'YEO', '010630014845', 'Male', '0165194941', 'teoteck@graduate.utm.my', 2, 'COMPUTER NETWORKS AND SECURITY', 4.00, 'yeoteck'),
('A21EC0176', 'HENG LAI', 'GAN', '011030010829', 'Male', '01135225289', 'ganlai@graduate.utm.my', 2, 'GRAPHICS AND MULTIMEDIA', 4.00, 'ganlai');

-- --------------------------------------------------------

--
-- Table structure for table `training_session`
--

CREATE TABLE `training_session` (
  `training_ID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `required_amount` int(11) DEFAULT NULL,
  `current_amount` int(11) DEFAULT 0,
  `allowance` int(11) DEFAULT NULL,
  `organization_ID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_session`
--

INSERT INTO `training_session` (`training_ID`, `name`, `description`, `startDate`, `endDate`, `required_amount`, `current_amount`, `allowance`, `organization_ID`) VALUES
(9, 'ADVANCED PC BUILDING', 'This training session is tailored for professionals in the System Builders industry who want to deepen their understanding of the latest hardware components and optimize system performance. ', '2023-09-21', '2023-12-21', 5, 0, 1200, 4),
(10, 'TESTING BEST PRACTICES SEMINAR', 'This training session is designed for System Builders looking to enhance their knowledge and skills in ensuring smooth integration of hardware and software components. Learn about industry best practi', '2023-10-18', '2024-01-18', 1, 0, 1600, 4),
(11, 'GAME TESTING', 'Join us for a hands-on workshop focused on game testing and quality assurance (QA). This training session is designed to equip participants with the skills and techniques necessary to ensure the highe', '2023-08-10', '2023-11-10', 13, 0, 1500, 5),
(15, 'CYBERSECURITY FUNDAMENTALS', 'Enhance your cybersecurity knowledge and fortify your organization defenses with our comprehensive training on cybersecurity fundamentals and best practices.', '2023-09-07', '2023-12-24', 8, 0, 1300, 44),
(16, 'ONLINE RETAIL', 'Explore the fundamentals of e-commerce, including business models, customer acquisition strategies, and online payment systems.', '2023-08-18', '2023-11-17', 3, 0, 1000, 45),
(17, 'DEVICE REPAIR ', 'Gain practical insights into troubleshooting techniques, software diagnostics, and hardware repair.', '2023-10-11', '2024-01-10', 2, 0, 1400, 46),
(18, 'GLOBAL EXPANSION TRAINING', 'Learn the intricacies of adapting your game for different markets, including language translation, cultural localization, and regional preferences. ', '2023-10-19', '2024-01-18', 3, 0, 1200, 47),
(19, 'VIRTUAL REALITY (VR) GAME DEVELOPMENT', 'Embark on an immersive journey into the world of virtual reality (VR) game development with our workshop dedicated to creating captivating VR experiences.', '2023-09-02', '2023-12-01', 3, 0, 1200, 48),
(20, 'SYSTEM PERFORMANCE OPTIMIZATION', 'Explore techniques for fine-tuning system settings, optimizing BIOS configurations, and maximizing component performance.', '2023-10-05', '2024-01-04', 4, 0, 1000, 49),
(21, 'SUPPLY CHAIN MANAGEMENT', 'Optimize your e-commerce logistics and supply chain operations with our training session focused on efficient order fulfillment, inventory management, and shipping strategies.', '2023-09-28', '2023-12-27', 5, 0, 1200, 50),
(22, 'OPERATING SYSTEM SUPPORT SEMINAR', 'Learn how to diagnose and resolve common software issues, including operating system errors, software conflicts, and driver problems.', '2023-09-01', '2023-11-30', 3, 0, 1300, 51);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('abuadmad', '2222', 2),
('admin', '0000', 1),
('ahassan', '2222', 2),
('aibrahim', '2222', 2),
('aida', '1111', 3),
('akrah', '2222', 2),
('fhassan', '2222', 2),
('ganlai', '1111', 3),
('gohsu', '2222', 2),
('hahmed', '2222', 2),
('haidah', '1111', 3),
('jacklim', '2222', 2),
('kaizheng', '1111', 3),
('lewhong', '1111', 3),
('mali', '2222', 2),
('yeoteck', '1111', 3),
('ykhan', '2222', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `matric` (`matric`),
  ADD KEY `organization_ID` (`organization_ID`),
  ADD KEY `training_ID` (`training_ID`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`coordinate_ID`),
  ADD KEY `username` (`username`),
  ADD KEY `organization_ID` (`organization_ID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organization_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `training_session`
--
ALTER TABLE `training_session`
  ADD PRIMARY KEY (`training_ID`),
  ADD KEY `organization_ID` (`organization_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `organization_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `training_session`
--
ALTER TABLE `training_session`
  MODIFY `training_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`matric`) REFERENCES `student` (`matric`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`organization_ID`) REFERENCES `organization` (`organization_ID`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`training_ID`) REFERENCES `training_session` (`training_ID`);

--
-- Constraints for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD CONSTRAINT `coordinator_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `coordinator_ibfk_2` FOREIGN KEY (`organization_ID`) REFERENCES `organization` (`organization_ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `training_session`
--
ALTER TABLE `training_session`
  ADD CONSTRAINT `training_session_ibfk_1` FOREIGN KEY (`organization_ID`) REFERENCES `organization` (`organization_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
