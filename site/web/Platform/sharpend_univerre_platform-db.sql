-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2018 at 04:55 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharpend_univerre_platform-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `campaign_type` varchar(100) NOT NULL,
  `campaign_URL` varchar(100) NOT NULL,
  `campaign_description` varchar(100) NOT NULL,
  `number_of_bottles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_ID`, `client_ID`, `product`, `campaign_name`, `campaign_type`, `campaign_URL`, `campaign_description`, `number_of_bottles`) VALUES
(1, 0, 'Coop', 'Provenance - Vaille', 'provenance', 'demo.io.tt/provenance', 'This campaign demonstrates brand provenance', 1000),
(7, 0, 'asdfa', 'asdfas', 'repurchase', 'asdfsa', 'asdfas', 5),
(8, 0, 'asdfa', 'asdfas', 'provenance', 'asdfas', 'asdfa', 3),
(9, 0, 'asdf', 'asdfa', 'provenance', 'asdfa', 'asdfa', 10),
(10, 0, 'asdf', 'aasdfs', 'repurchase', 'asdfas', 'asdfas', 5),
(11, 0, 'asdf', 'asdfs', 'repurchase', 'asdfas', 'asdfas', 4);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_ID` int(11) NOT NULL,
  `business_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_ID`, `business_name`) VALUES
(0, 'Coop');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_number_ID` varchar(11) NOT NULL,
  `total_palettes` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `contact` text NOT NULL,
  `app_created` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_number_ID`, `total_palettes`, `client_ID`, `contact`, `app_created`) VALUES
('AH07723GB', 8, 0, 'c.yves@coop.ch', 0),
('CB37723GB', 5, 0, 'c.yves@coop.ch', 0),
('DS30723GY', 5, 0, 'c.yves@coop.ch', 0),
('GF06784GB', 5, 0, 'c.yves@coop.ch', 0),
('GH07784GB', 10, 0, 'c.yves@coop.ch', 1),
('PH07723GB', 15, 0, 'c.yves@coop.ch', 0),
('QF07784GB', 5, 0, 'c.yves@coop.ch', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_ID`),
  ADD KEY `client_ID` (`client_ID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_number_ID`),
  ADD KEY `client_ID` (`client_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `clients` (`client_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `clients` (`client_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
