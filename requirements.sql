-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 03:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `requirements`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` text NOT NULL,
  `Description` varchar(10) NOT NULL,
  `Price` int(5) NOT NULL,
  `In_Product` int(11) NOT NULL,
  `Out_Product` int(11) NOT NULL,
  `Stocks_Available` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`Product_ID`, `Product_Name`, `Description`, `Price`, `In_Product`, `Out_Product`, `Stocks_Available`) VALUES
(1, 'Chorizo', '250grms.', 150, 50, 30, 0),
(2, 'Tocino', '65grms.', 65, 1000, 781, 0),
(3, 'Hotdog', '250grms.', 190, 200, 150, 0),
(4, 'Tapa', '150grms.', 75, 75, 34, 0),
(5, 'Ham', '180grms.', 99, 235, 178, 0),
(6, 'Corned Beef', '120grms.', 65, 200, 13, 0),
(7, 'Bacon', '250grms.', 250, 789, 99, 0),
(8, 'Chicken Nuggets', '250grms.', 98, 456, 342, 0),
(9, 'Dressed Chicken', '500grms.', 75, 500, 97, 0),
(10, 'Fish Fillet', '350grms.', 180, 300, 88, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`Product_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
