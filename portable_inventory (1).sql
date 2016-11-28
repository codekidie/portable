-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2016 at 03:12 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portable_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `admin_id`, `name`) VALUES
(1, 809361, 'test'),
(2, 809361, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `admin_id`, `file_name`, `file_type`) VALUES
(1, 0, 'd0mr49l3.jpg', 'image/jpeg'),
(2, 809361, 'AMA_University_logo.png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `buy_price` decimal(25,2) NOT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(4, 809361, 'Laptop', '0', '2.00', '4.00', 1, 2, '2016-11-28 01:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `admin_id`, `product_id`, `qty`, `price`, `date`) VALUES
(1, 809361, 4, 1, '4.00', '2016-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `company_name` text NOT NULL,
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `name`, `username`, `password`, `user_level`, `image`, `company_name`, `status`, `last_login`) VALUES
(1, 334511, ' Admin User', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '54h3w1kx1.jpg', 'nelsa inventory system', 1, '2016-11-28 03:05:25'),
(2, 334511, 'Claire Logan', 'Special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'tyjmkqf2.jpg', 'John Doe Inventory System', 1, '2016-11-23 11:09:12'),
(3, 334511, 'Donald Trump', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'd0mr49l3.jpg', '', 1, '2016-11-23 11:31:04'),
(4, 0, 'Super Admin', 'super', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 0, 'no_image.jpg', '', 1, '2016-11-28 03:11:19'),
(7, 954864, 'Krystal Amora', 'admin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Tala inc.', 1, NULL),
(8, 809361, 'Mario', 'mario', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Mario Bros.', 1, '2016-11-28 02:34:30'),
(10, 809361, 'Krystal Amora', 'admin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Mario Bros.', 1, NULL),
(11, 809361, 'Raijin Kunami', 'raijin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Mario Bros.', 1, '2016-11-28 02:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `group_name` text NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `admin_id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 334511, 'Admin', 1, 1),
(2, 334511, 'special', 2, 1),
(3, 334511, 'User', 3, 1),
(4, 0, 'Super Admin', 0, 1),
(5, 809361, 'special', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
