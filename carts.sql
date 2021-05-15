-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2021 at 02:05 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.3.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carts`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customerid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `customerid`) VALUES
(1, '2021-05-15', 1),
(2, '2021-05-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderid`, `productid`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 399),
(2, 2, 2, 1, 59999),
(3, 2, 1, 1, 399),
(4, 2, 3, 1, 29999);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text,
  `ShortDescription` varchar(256) NOT NULL,
  `Image` varchar(256) NOT NULL,
  `Price` varchar(256) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `Description`, `ShortDescription`, `Image`, `Price`, `Status`, `CreatedDate`, `ModifiedDate`) VALUES
(1, 'Boat Earphones', 'Cable Length : About 1.2 m, \r\nSweatproof : Yes, \r\nNoise Isolation : Passive (MS),\r\nSensitivity (dB) : 92db ±3db,\r\nFrequency Response : 20Hz-20KHz\r\n', 'boAt Bassheads 225 with Mic(Black)', 'boat.jpeg', '399', 'Active', '2020-12-22 11:48:11', '2020-12-22 11:50:46'),
(2, 'HP Laptop', '39.62 cm (15.6 inch),\r\nFull HD Display,\r\nWindows 10 Home Operating System,\r\nIntel Iris Xe Graphics', 'HP 15s-fq2535TU Laptop', 'hplaptop.jpeg', '59,999', 'Active', '2021-05-13 00:00:00', '2021-05-13 00:00:00'),
(3, 'Samsung Mobile', 'No Cost EMI starts from 2610.99/month,\r\nStandard EMI starts from 1139.26/month,\r\nFlagship 7nm 9825 Processor,\r\n7000mAh (typical)* battery', 'Galaxy F62', 'samsung.jpeg\r\n', '29,999', 'Active', '2021-05-13 00:00:00', '2021-05-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Name`, `Email`, `Password`, `Phone`, `Address`) VALUES
(1, 'liki', 'liki@yopmail.com', 'likitha', '9265222837', 'Gudur(M),Nellore(D),Andhra Pradesh\r\n'),
(2, 'Santhi', 'santhi@yopmail.com', '', '1234567890', 'Gudur(M),Nellore(D),Andhra Pradesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
