-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 04:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL COMMENT 'name of category',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '2017-03-06 14:34:33', '2017-03-06 14:34:33'),
(2, 'Sony', '2017-03-06 15:00:51', '2017-03-06 15:00:51'),
(3, 'LG', '2017-03-06 15:00:51', '2017-03-06 15:00:51'),
(4, 'Panasonic', '2017-03-06 15:01:12', '2017-03-06 15:01:12'),
(5, 'Toshiba', '2017-03-06 15:01:12', '2017-03-06 15:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL COMMENT 'name of product',
  `price` float NOT NULL COMMENT 'price of product',
  `description` text COMMENT 'description of product',
  `image` varchar(225) DEFAULT NULL COMMENT 'link image of product',
  `categories_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `categories_id`, `created_at`, `updated_at`) VALUES
(1, 'Iphone 5', 1000000, 'Iphone 5\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 1, '2017-03-06 15:03:43', '2017-03-06 15:03:43'),
(2, 'Iphone 6', 12000000, 'Iphone 6\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 1, '2017-03-06 15:03:43', '2017-03-06 15:03:43'),
(3, 'Tivi Sony 19\'5', 8000000, 'Tivi Sony 19\'5 inch\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 2, '2017-03-06 15:05:59', '2017-03-06 15:05:59'),
(4, 'Tivi Sony 21\'5', 15000000, 'Tivi Sony 21\'5 inch\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 2, '2017-03-06 15:05:59', '2017-03-06 15:05:59'),
(5, 'Điện thoại LG Gold', 5000000, 'Điện thoại LG Gold\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 3, '2017-03-06 15:07:35', '2017-03-06 15:07:35'),
(6, 'Điện thoại LG Sliver', 6000000, 'Điện thoại LG Gold\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 3, '2017-03-06 15:07:35', '2017-03-06 15:07:35'),
(7, 'Điều hòa Panasonic 01', 18000000, 'Điều hòa Panasonic 01\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 4, '2017-03-06 15:09:19', '2017-03-06 15:09:19'),
(8, 'Điều hòa Panasonic 02', 20000000, 'Điều hòa Panasonic 01\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm.', NULL, 4, '2017-03-06 15:09:19', '2017-03-06 15:09:19'),
(9, 'Tủ lạnh Toshiba 01', 15000000, 'Tủ lạnh Toshiba 01\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm', NULL, 5, '2017-03-06 15:10:36', '2017-03-06 15:10:36'),
(10, 'Tủ lạnh Toshiba 02', 15000000, 'Tủ lạnh Toshiba 02\r\nThiết kế bền, đẹp.\r\nBảo hành 1 năm', NULL, 5, '2017-03-06 15:10:36', '2017-03-06 15:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '1234', NULL, '2017-03-06 14:55:22', '2017-03-06 14:55:22'),
(3, 'guest', 'guest@gmail.com', '1234', NULL, '2017-03-06 14:56:04', '2017-03-06 14:56:04'),
(4, 'hungtq', 'hungtq@gmail.com', '1234', NULL, '2017-03-06 14:56:55', '2017-03-06 14:56:55'),
(5, 'sonhh', 'sonhh@gmail.com', '1234', NULL, '2017-03-06 14:57:57', '2017-03-06 14:57:57'),
(6, 'namnt', 'namnt@gmail.com', '1234', NULL, '2017-03-06 14:58:12', '2017-03-06 14:58:12'),
(7, 'thucnk', 'thucnk@gmail.com', '1234', NULL, '2017-03-06 14:59:15', '2017-03-06 14:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
