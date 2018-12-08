-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 01:28 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drinkdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `address` varchar(300) NOT NULL,
  `cart` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `email`, `password`, `Fname`, `Lname`, `phone`, `gender`, `DoB`, `address`, `cart`) VALUES
('user1', '1@prj.com', 'password', 'hu', 'xi', '123456789', 'M', '2000-12-12', 'address, addr', ''),
('user2', '2@prj.com', 'password', 'er', 'ren', '222222222', 'M', '2000-12-24', 'address, addr', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeID` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `address` varchar(300) NOT NULL,
  `SSN` varchar(9) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalsold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` varchar(10) NOT NULL,
  `cost` float DEFAULT NULL,
  `status` enum('pending','fulfilled','special') DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `fulfilldate` date DEFAULT NULL,
  `request` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `cost`, `status`, `orderdate`, `fulfilldate`, `request`) VALUES
(0, 'user1', 1, 'pending', '2018-12-01', NULL, 'test request true'),
(1, 'user1', 2, 'fulfilled', '2012-12-12', NULL, 'test request false'),
(7, 'user2', 5, 'pending', '2022-01-01', NULL, 'reqthree'),
(8, 'user1', 0, 'pending', '2018-12-04', NULL, ''),
(9, 'user1', 0, 'pending', '2018-12-04', NULL, ''),
(10, 'user1', 0, 'pending', '2018-12-04', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `type` enum('water','juice','soda','alcoholic','other') DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `name`, `brand`, `description`, `picture`, `price`, `type`, `quantity`) VALUES
(1, 'Water', 'Nature', 'Good ol\' H2O', 'water.jpg', 1, 'water', 99);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role` varchar(30) NOT NULL,
  `ch_orderstatus` enum('No','Yes') DEFAULT NULL,
  `ch_order` enum('No','Yes') DEFAULT NULL,
  `ch_employee` enum('No','Yes') DEFAULT NULL,
  `ch_product` enum('No','Yes') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`productid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
