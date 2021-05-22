-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 04:17 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanket`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE `active` (
  `userName` varchar(20) DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  `lastSeen` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active`
--

INSERT INTO `active` (`userName`, `isActive`, `lastSeen`) VALUES
('Sanket7474', 1, '21 05 2021,22:07'),
('Saurabh7070', 0, '02 01 2021,14:57'),
('Amit', 0, '02 01 2021,15:29'),
('Amar', 0, '21 05 2021,22:23'),
('Sagar', 0, '25 12 2018,22:05'),
('Kishor', 0, '25 12 2018,16:36'),
('Abhi', 0, '25 12 2018,21:28'),
('Any', 1, ''),
('CHAMPYA', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `any`
--

CREATE TABLE `any` (
  `name` varchar(20) DEFAULT NULL,
  `no` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `any`
--

INSERT INTO `any` (`name`, `no`) VALUES
('A', 1),
('B', 1),
('C', 1),
('D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conv`
--

CREATE TABLE `conv` (
  `CID` varchar(40) NOT NULL,
  `fromUser` varchar(20) DEFAULT NULL,
  `toUser` varchar(20) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conv`
--

INSERT INTO `conv` (`CID`, `fromUser`, `toUser`, `UserName`) VALUES
('sanket7474saurabh7070', 'sanket7474', 'saurabh7070', 'sanket7474'),
('sanket7474Amit', 'sanket7474', 'Amit', 'sanket7474'),
('sanket7474amar', 'sanket7474', 'amar', 'sanket7474');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `UserName` varchar(20) DEFAULT NULL,
  `CID` varchar(40) DEFAULT NULL,
  `fromUser` varchar(20) DEFAULT NULL,
  `toUser` varchar(20) DEFAULT NULL,
  `msg` text,
  `Deliver` int(11) NOT NULL,
  `Seen` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`UserName`, `CID`, `fromUser`, `toUser`, `msg`, `Deliver`, `Seen`) VALUES
('sanket7474', 'sanket7474saurabh7070', 'sanket7474', 'saurabh7070', 'hello', 1, 1),
('sanket7474', 'sanket7474Amit', 'sanket7474', 'Amit', 'heyy', 1, 1),
('amit', 'sanket7474Amit', 'amit', 'sanket7474', 'hello', 1, 1),
('amit', 'sanket7474Amit', 'amit', 'sanket7474', 'I am busy right now ', 1, 1),
('sanket7474', 'sanket7474Amit', 'sanket7474', 'Amit', 'are you there', 1, 1),
('sanket7474', 'sanket7474saurabh7070', 'sanket7474', 'saurabh7070', 'uth ayyy', 1, 1),
('Saurabh7070', 'sanket7474saurabh7070', 'Saurabh7070', 'sanket7474', 'kay rr', 1, 1),
('sanket7474', 'sanket7474saurabh7070', 'sanket7474', 'saurabh7070', 'Nothing Much', 0, 0),
('sanket7474', 'sanket7474saurabh7070', 'sanket7474', 'saurabh7070', 'Nothing Much', 0, 0),
('sanket7474', 'sanket7474amar', 'sanket7474', 'amar', 'hii', 1, 1),
('amar', 'sanket7474amar', 'amar', 'sanket7474', 'hurr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `name`, `pass`, `email`) VALUES
('Sanket7474', 'Sanket Maske', 'pari7474', ''),
('Saurabh7070', 'Saurabh Mali', 'ashwini7070', ''),
('Amit', 'Amit Bhosale', '123', ''),
('Amar', 'Amar Ingale', '3737', ''),
('Sagar', 'Sagar Pathade', '6666', ''),
('kishor', 'kishor', 'kishor12', 'kishor@gmail.com'),
('Abhi', 'Abhi', '12345678', 'abhi@gmail.com'),
('Any', 'Any', 'aaaaaaaa', 'Any@gmail.com'),
('CHAMPYA', 'SIDDESH', 'Darksiders@2', 'ubale.siddesh1997@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conv`
--
ALTER TABLE `conv`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
