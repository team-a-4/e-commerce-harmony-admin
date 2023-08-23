-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 08:30 PM
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
-- Database: `harmony_2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `product_barcode` varchar(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `unit` varchar(11) NOT NULL,
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `cost_price` double NOT NULL,
  `selling_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `product_id`, `product_barcode`, `quantity`, `weight`, `unit`, `production_date`, `expiry_date`, `cost_price`, `selling_price`) VALUES
('1001', '12', 'PLA10011200', 0, 3000, '', '2023-08-15', '2024-08-15', 2.5, 5),
('1002', '2', 'STR20012000', 300, NULL, '', '2023-08-10', '2024-08-10', 0.05, 0.15),
('1003', '3', 'CUP30013000', 200, NULL, '', '2023-08-20', '2024-08-20', 1, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(11) NOT NULL,
  `category` varchar(11) NOT NULL,
  `product_name` varchar(11) NOT NULL,
  `product_desc` varchar(11) NOT NULL,
  `product_brand` varchar(11) NOT NULL,
  `product_image` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category`, `product_name`, `product_desc`, `product_brand`, `product_image`) VALUES
('12', 'Plates', 'Chic Leaf P', 'High-qualit', 'Chic Leaf', '12.png'),
('2', 'Straws', 'Biodegradab', 'Biodegradab', 'WYMOON', '2.png'),
('3', 'Cups', 'Reusable Ec', 'Durable and', 'GreenCup', '3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
