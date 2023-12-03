-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 03:45 PM
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
-- Database: `ksudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `classattendancerecord`
--

CREATE TABLE `classattendancerecord` (
  `id` int(10) NOT NULL,
  `sectionNumber` int(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classattendancerecord`
--

INSERT INTO `classattendancerecord` (`id`, `sectionNumber`, `date`) VALUES
(112, 12345, '2022-10-14'),
(113, 56789, '2022-10-08'),
(311, 34567, '2022-10-01'),
(314, 12345, '2023-11-11'),
(315, 12345, '2023-11-11'),
(316, 12345, '2023-11-15'),
(317, 12456, '2023-11-21'),
(318, 666666, '2023-11-30'),
(319, 666666, '2023-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(3) NOT NULL,
  `symbol` varchar(6) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `symbol`, `name`) VALUES
(104, 'IT', 'physics '),
(111, 'CSC', 'java programmin'),
(151, 'CSC', 'Math'),
(220, 'CSC', 'computer organi'),
(371, 'IT', 'App security '),
(471, 'IT', 'Cybersecurity G');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(10) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email_address` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `first_name`, `last_name`, `email_address`, `password`) VALUES
(1, 'test', 'tt', 'test@email.com', '$2y$10$c.RAi38q01aKdOKXJZwPrOfEJ/4I9PZbx1r2Z4BwfSuWBWouRjtYC'),
(1112345768, 'Dr.Reem', 'Alharbi', '1112345768@ksu.edu.sa', 'rr-123654324'),
(1112345999, 'Dr.Kholoud ', 'Khaled', '1112345999@ksu.edu.sa', 'dr1112345999'),
(1112888999, 'Dr. Ahlam ', 'Alenezi', '1112888999@ksu.edu.sa', 'aa1112888999aa'),
(1115555768, 'Dr.Maryam ', 'Alharithi', '1115555768@ksu.edu.sa', 'mmAlharithi11'),
(2114555768, 'Dr.Rana', 'Alharithi', '2114555768@ksu.edu.sa', 'rana1224');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionNumber` int(5) NOT NULL,
  `courseID` int(6) NOT NULL,
  `type` varchar(20) NOT NULL,
  `hours` int(3) NOT NULL,
  `instructorID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionNumber`, `courseID`, `type`, `hours`, `instructorID`) VALUES
(12344, 104, 'Lecture', 24, 1),
(12345, 111, 'Lecture', 3, 1),
(12456, 104, 'Lab', 23, 1),
(34567, 371, 'Lab', 4, 1),
(56789, 111, 'Lab', 3, 1),
(67891, 104, 'Lecture', 2, 1112888999),
(666666, 104, 'Lecture', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sectionstudents`
--

CREATE TABLE `sectionstudents` (
  `sectionNumber` int(5) NOT NULL,
  `studentKSUID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sectionstudents`
--

INSERT INTO `sectionstudents` (`sectionNumber`, `studentKSUID`) VALUES
(12345, 443567885),
(12345, 376548976),
(12345, 987654321),
(12345, 371123567),
(67891, 398765428),
(67891, 441023456),
(34567, 443567885),
(34567, 398765428),
(12456, 123123123),
(666666, 123123123);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `KSUID` int(9) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`KSUID`, `firstName`, `lastName`) VALUES
(123123123, 'ssstudent', 'test'),
(371123567, 'Sama', 'Sultan'),
(376548976, 'Asmaa', 'Abdullah'),
(386547659, 'Reema', 'Faisal'),
(398765428, 'Maryam ', 'Majid'),
(441023456, 'Sara', 'Abdullah'),
(443567885, 'Areen', 'Fahad'),
(443897654, 'Maha', 'Mohammed'),
(444789654, 'Reem', 'Khalid '),
(936541123, 'Maryam', 'Mohammed'),
(987654321, 'Rana', 'Sultan');

-- --------------------------------------------------------

--
-- Table structure for table `studentaccount`
--

CREATE TABLE `studentaccount` (
  `id` int(10) NOT NULL,
  `KSUID` int(9) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studentaccount`
--

INSERT INTO `studentaccount` (`id`, `KSUID`, `password`) VALUES
(215498076, 444789654, 'yuiopl98'),
(441023465, 441023456, 'ddfrg44356d'),
(443567888, 443567885, 'arr443567885arr'),
(1087654328, 398765428, 'yhbnji8765'),
(1098765432, 936541123, '6yhnji876'),
(1123678945, 386547659, 'kjfieoir789'),
(1159388789, 371123567, 'lekfo990'),
(1234567892, 443897654, 'ervgtb66'),
(1456789000, 376548976, 'bnjhyu66'),
(2145678976, 987654321, 'cvgtb66'),
(2145678977, 123123123, '$2y$10$jDaCHfZioinWR5jGo17k5.Iek7fBpCAMyKhPxwkk.VVdcb82dSXvG');

-- --------------------------------------------------------

--
-- Table structure for table `studentattendanceinrecord`
--

CREATE TABLE `studentattendanceinrecord` (
  `attendanceRecordID` int(11) NOT NULL,
  `studentKSUID` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studentattendanceinrecord`
--

INSERT INTO `studentattendanceinrecord` (`attendanceRecordID`, `studentKSUID`, `attendance`) VALUES
(112, 443567885, 1),
(113, 376548976, 1),
(113, 443897654, 0),
(314, 443567885, 1),
(314, 376548976, 0),
(314, 987654321, 1),
(314, 371123567, 0),
(315, 443567885, 1),
(315, 376548976, 0),
(315, 987654321, 1),
(315, 371123567, 0),
(316, 443567885, 0),
(316, 376548976, 0),
(316, 987654321, 1),
(316, 371123567, 1),
(317, 123123123, 1),
(318, 123123123, 0),
(319, 123123123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploadedexcuses`
--

CREATE TABLE `uploadedexcuses` (
  `id` int(10) NOT NULL,
  `studentAccountID` int(11) NOT NULL,
  `attendanceRecordID` int(11) NOT NULL,
  `absenceReason` varchar(30) NOT NULL,
  `uploadedExcuseFileName` varchar(1000) NOT NULL,
  `decision` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uploadedexcuses`
--

INSERT INTO `uploadedexcuses` (`id`, `studentAccountID`, `attendanceRecordID`, `absenceReason`, `uploadedExcuseFileName`, `decision`) VALUES
(1, 2145678977, 112, 'test', 'dummy.pdf', 'approved'),
(2, 2145678977, 112, 'test', 'dummy.pdf', 'approved'),
(3, 2145678977, 112, 'test', 'dummy.pdf', 'approved'),
(4, 2145678977, 318, 'sdvdsvd', '1698849582_dummy.pdf', 'approved'),
(5, 2145678977, 319, 'svsv', '1698849897_IT329 Project - Pha', 'under consideration');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classattendancerecord`
--
ALTER TABLE `classattendancerecord`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sectionNumber` (`sectionNumber`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionNumber`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `sectionstudents`
--
ALTER TABLE `sectionstudents`
  ADD KEY `sectionNumber` (`sectionNumber`),
  ADD KEY `studentKSUID` (`studentKSUID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`KSUID`);

--
-- Indexes for table `studentaccount`
--
ALTER TABLE `studentaccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `KSUID` (`KSUID`);

--
-- Indexes for table `studentattendanceinrecord`
--
ALTER TABLE `studentattendanceinrecord`
  ADD KEY `attendanceRecordID` (`attendanceRecordID`),
  ADD KEY `studentKSUID` (`studentKSUID`);

--
-- Indexes for table `uploadedexcuses`
--
ALTER TABLE `uploadedexcuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentAccountID` (`studentAccountID`),
  ADD KEY `attendanceRecordID` (`attendanceRecordID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classattendancerecord`
--
ALTER TABLE `classattendancerecord`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2114555777;

--
-- AUTO_INCREMENT for table `studentaccount`
--
ALTER TABLE `studentaccount`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2145678978;

--
-- AUTO_INCREMENT for table `uploadedexcuses`
--
ALTER TABLE `uploadedexcuses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classattendancerecord`
--
ALTER TABLE `classattendancerecord`
  ADD CONSTRAINT `classattendancerecord_ibfk_1` FOREIGN KEY (`sectionNumber`) REFERENCES `section` (`sectionNumber`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`id`);

--
-- Constraints for table `sectionstudents`
--
ALTER TABLE `sectionstudents`
  ADD CONSTRAINT `sectionstudents_ibfk_1` FOREIGN KEY (`sectionNumber`) REFERENCES `section` (`sectionNumber`),
  ADD CONSTRAINT `sectionstudents_ibfk_2` FOREIGN KEY (`studentKSUID`) REFERENCES `student` (`KSUID`);

--
-- Constraints for table `studentaccount`
--
ALTER TABLE `studentaccount`
  ADD CONSTRAINT `studentaccount_ibfk_1` FOREIGN KEY (`KSUID`) REFERENCES `student` (`KSUID`);

--
-- Constraints for table `studentattendanceinrecord`
--
ALTER TABLE `studentattendanceinrecord`
  ADD CONSTRAINT `studentattendanceinrecord_ibfk_1` FOREIGN KEY (`attendanceRecordID`) REFERENCES `classattendancerecord` (`id`),
  ADD CONSTRAINT `studentattendanceinrecord_ibfk_2` FOREIGN KEY (`studentKSUID`) REFERENCES `student` (`KSUID`);

--
-- Constraints for table `uploadedexcuses`
--
ALTER TABLE `uploadedexcuses`
  ADD CONSTRAINT `uploadedexcuses_ibfk_1` FOREIGN KEY (`attendanceRecordID`) REFERENCES `classattendancerecord` (`id`),
  ADD CONSTRAINT `uploadedexcuses_ibfk_2` FOREIGN KEY (`studentAccountID`) REFERENCES `studentaccount` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
