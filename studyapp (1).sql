-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2015 at 08:31 PM
-- Server version: 5.5.23
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `UniqueID` int(11) NOT NULL,
  `DepartmentAbbreviation` varchar(3) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `ClassNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `Abbreviation` varchar(3) NOT NULL,
  `LongName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Abbreviation`, `LongName`) VALUES
('CS', 'Computer Science'),
('IM', 'Interactive Media'),
('MTH', 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `UniqueID` int(11) NOT NULL,
  `UniqueCourseID` int(11) NOT NULL,
  `Professor` varchar(40) NOT NULL,
  `Section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`UniqueID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`UniqueID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `UniqueID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `UniqueID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
