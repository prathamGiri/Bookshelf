-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 05:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshelf_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `AdminId` int(11) NOT NULL,
  `AdminName` varchar(56) NOT NULL,
  `AdmPass` varchar(56) NOT NULL,
  `Mobile` bigint(10) NOT NULL,
  `Email` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`AdminId`, `AdminName`, `AdmPass`, `Mobile`, `Email`) VALUES
(3, 'YWRtaW5fbmFtZQ==', '43f3707b8aaca104be65b48d274baa54', 1111111111, 'YWRtaW5AZ21haWwuY29t');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityId` int(11) NOT NULL,
  `cityName` varchar(256) NOT NULL,
  `customerNum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `retBookId` int(11) DEFAULT NULL,
  `bookId` int(11) DEFAULT NULL,
  `orderDateTime` datetime NOT NULL,
  `orderStatus` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `customerId` int(11) NOT NULL,
  `pays` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `request` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staticbookinfo`
--

CREATE TABLE `staticbookinfo` (
  `bookId` int(11) NOT NULL,
  `bookName` varchar(256) NOT NULL,
  `bookAuthor` varchar(256) NOT NULL,
  `bookLanguage` varchar(256) NOT NULL,
  `bookType` varchar(256) NOT NULL,
  `numOfPages` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `rep` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `readDays` int(11) NOT NULL DEFAULT '7',
  `contriBy` int(11) NOT NULL,
  `discription` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staticbookinfo`
--

INSERT INTO `staticbookinfo` (`bookId`, `bookName`, `bookAuthor`, `bookLanguage`, `bookType`, `numOfPages`, `mrp`, `rep`, `img`, `readDays`, `contriBy`, `discription`) VALUES
(1, 'Yayati', 'Vi S Khandekar', 'Marathi', 'Novel', 300, 450, 75, 'yayati.jpg', 7, 0, 'content not available'),
(2, 'DON QUIXOTE', 'Miguel de Cervantes', 'English', 'Novel,English Litrature', 300, 250, 66, 'don-quixote.jpg', 7, 0, 'content not available'),
(3, 'Fahrenheit 451', 'Ray Bradbury', 'English', 'Novel,Sci-fi', 300, 330, 75, 'fahrenheiy-451.jpg', 15, 0, 'content not available'),
(4, 'Wings Of Fire', 'Dr. A. P. J. Abdul Kalam', 'English', 'Autobiography', 300, 250, 66, 'wings-of-fire.jpg', 5, 0, 'content not available'),
(5, 'Agnipankh', 'Dr. A. P. J. Abdul Kalam', 'Marathi', 'Autobiography', 300, 370, 50, 'agnipankh.jpg', 7, 0, 'content not available'),
(6, 'The Man Who Knew Infinity', 'Robert Kenigal', 'English', 'Biography,Mathematics', 400, 450, 75, 'the-man-who-knew-infinity.jpeg', 7, 0, 'content not available'),
(7, 'Elon Musk', 'Ashlee Vance', 'English', 'Biography,Entreprenurship', 400, 370, 50, 'elon-musk.jpg', 15, 0, 'content not available');

-- --------------------------------------------------------

--
-- Table structure for table `staticcustomerinfo`
--

CREATE TABLE `staticcustomerinfo` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(256) NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `cityId` int(11) NOT NULL,
  `address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `variablebookinfo`
--

CREATE TABLE `variablebookinfo` (
  `bookId` int(11) NOT NULL,
  `bookCategory` varchar(56) NOT NULL,
  `bookStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variablebookinfo`
--

INSERT INTO `variablebookinfo` (`bookId`, `bookCategory`, `bookStatus`) VALUES
(1, 'Free', 0),
(2, 'Free', 1),
(3, 'Premium', 1),
(4, 'Premium', 0),
(5, 'Premium', 1),
(6, 'Premium', 1),
(7, 'Premium', 0);

-- --------------------------------------------------------

--
-- Table structure for table `variablecustomerinfo`
--

CREATE TABLE `variablecustomerinfo` (
  `customerId` int(11) NOT NULL,
  `customerStatus` int(11) NOT NULL DEFAULT '0',
  `activeBookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `staticbookinfo`
--
ALTER TABLE `staticbookinfo`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `staticcustomerinfo`
--
ALTER TABLE `staticcustomerinfo`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `variablebookinfo`
--
ALTER TABLE `variablebookinfo`
  ADD PRIMARY KEY (`bookId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `staticbookinfo`
--
ALTER TABLE `staticbookinfo`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staticcustomerinfo`
--
ALTER TABLE `staticcustomerinfo`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variablebookinfo`
--
ALTER TABLE `variablebookinfo`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
