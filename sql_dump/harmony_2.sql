-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 06:09 PM
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
-- Database: `harmony_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` int(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `product_barcode` varchar(13) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `unit` varchar(3) NOT NULL,
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `cost_price` double NOT NULL,
  `selling_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `product_id`, `product_barcode`, `quantity`, `weight`, `unit`, `production_date`, `expiry_date`, `cost_price`, `selling_price`) VALUES
(1001, '3', 'PLEAF10011200', 300, NULL, 'Pcs', '2023-08-15', '2024-08-15', 2.5, 5),
(1002, '1', 'STRAW20012000', 300, NULL, 'Pcs', '2023-08-10', '2024-08-10', 0.05, 0.15),
(1003, '2', 'CUPGC30013000', 200, NULL, 'Pcs', '2023-08-20', '2024-08-20', 1, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_desc` text NOT NULL,
  `product_brand` varchar(200) NOT NULL,
  `product_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category`, `product_name`, `product_desc`, `product_brand`, `product_image`) VALUES
(1, 'Straws', 'Biodegradab', 'Biodegradab', 'WYMOON', '1.png'),
(2, 'Cups', 'Reusable Ec', 'Durable and', 'GreenCup', '2.png'),
(3, 'Plates', 'Chic Leaf P', 'High-qualit', 'Chic Leaf', '3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
