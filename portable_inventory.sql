-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 16, 2016 at 09:04 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

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
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `name`, `admin_id`) VALUES
(1, 'firstbatch', 168739),
(2, 'second batch', 168739);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `admin_id`, `name`) VALUES
(1, 809361, 'test'),
(2, 809361, 'test'),
(3, 168739, 'beverage'),
(4, 334511, 'test'),
(5, 168739, 'Can Goods');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `batch` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `sms_sent` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `product_id`, `admin_id`, `item_name`, `batch`, `expiry_date`, `sms_sent`) VALUES
(1, 34, 168739, 'Mega', 1, '2016-12-31', 1),
(2, 37, 168739, 'Argentina Meat loaf', 1, '2016-12-17', 1),
(3, 37, 168739, 'Beef Loaf', 1, '2016-12-17', 1),
(4, 38, 168739, 'Century Tuna', 2, '2016-12-24', 1),
(5, 39, 168739, '555 Tuna', 2, '2016-12-17', 1),
(6, 40, 168739, 'Mega Tuna', 3, '2016-12-20', 1),
(7, 41, 168739, 'Nagoya Sardines', 2, '2016-12-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `admin_id`, `file_name`, `file_type`) VALUES
(1, 0, 'd0mr49l3.jpg', 'image/jpeg'),
(2, 809361, 'AMA_University_logo.png', 'image/png'),
(3, 168739, 'Roger_in_His_Youth.png', ''),
(4, 168739, 'blue berry yakult.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `user_id`, `access`, `admin_id`) VALUES
(6, 13, 'Manage_Product', 168739),
(7, 13, 'Daily_Sales', 168739),
(8, 12, 'Sales_by_dates', 168739),
(9, 14, 'Add_Product', 168739),
(12, 1, 'Category', 334511),
(13, 1, 'Manage_Product', 334511),
(14, 1, 'Add_Product', 334511);

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
  `expiry_date` date NOT NULL,
  `unit_of_measure` text NOT NULL,
  `batch` text NOT NULL,
  `sms_sent` int(1) NOT NULL,
  `mode_of_selling` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `expiry_date`, `unit_of_measure`, `batch`, `sms_sent`, `mode_of_selling`, `date`) VALUES
(4, 809361, 'Laptop', '-2', '2.00', '4.00', 1, 2, '0000-00-00', '', '', 0, '', '2016-11-28 01:59:27'),
(9, 334511, 'test', '8', '7.00', '3.00', 4, 0, '2016-12-12', '', '', 1, '', '2016-12-11 18:51:10'),
(10, 334511, 'testa', '3', '4.00', '4.00', 4, 0, '2016-12-12', '', 'testbatch', 1, '', '2016-12-11 18:59:25'),
(39, 168739, '555 Tuna', '17', '15.00', '18.00', 5, 4, '0000-00-00', 'gram', '', 1, 'none', '2016-12-15 22:28:35'),
(40, 168739, 'Mega Tuna', '15', '28.00', '32.00', 5, 4, '0000-00-00', 'gram', '', 1, 'none', '2016-12-15 23:03:32'),
(41, 168739, 'Nagoya Sardines', '16', '14.00', '17.00', 5, 4, '0000-00-00', 'gram', '', 1, 'none', '2016-12-16 00:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `suppliername` text NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_town` text NOT NULL,
  `supplier_country` text NOT NULL,
  `supplier_postcode` text NOT NULL,
  `buyername` text NOT NULL,
  `buyer_address` text NOT NULL,
  `buyer_town` text NOT NULL,
  `buyer_country` text NOT NULL,
  `buyer_postcode` text NOT NULL,
  `po_no` text NOT NULL,
  `po_date` date NOT NULL,
  `quantity` text NOT NULL,
  `description` text NOT NULL,
  `unit_price` text NOT NULL,
  `amount` text NOT NULL,
  `delivery_address` text NOT NULL,
  `street_address` text NOT NULL,
  `town` text NOT NULL,
  `country` text NOT NULL,
  `postcode` text NOT NULL,
  `deliverydate` date NOT NULL,
  `terms` text NOT NULL,
  `authorised_by` text NOT NULL,
  `date_created` date NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `suppliername`, `supplier_address`, `supplier_town`, `supplier_country`, `supplier_postcode`, `buyername`, `buyer_address`, `buyer_town`, `buyer_country`, `buyer_postcode`, `po_no`, `po_date`, `quantity`, `description`, `unit_price`, `amount`, `delivery_address`, `street_address`, `town`, `country`, `postcode`, `deliverydate`, `terms`, `authorised_by`, `date_created`, `admin_id`) VALUES
(1, 'a', 'c', 'e', 'g', 'i', 'b', 'd', 'f', 'h', 'j', 'k', '2016-12-03', '1', 'm', '2', '3', 'n', 'o', 'p', 'q', '5', '2016-12-03', '', 'r', '2016-12-03', 168739);

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `comment` text NOT NULL,
  `replace_product` text NOT NULL,
  `reason` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_product`
--

INSERT INTO `return_product` (`id`, `product_id`, `name`, `email`, `phone`, `comment`, `replace_product`, `reason`, `quantity`, `admin_id`) VALUES
(1, 7, 'Claire Logan', 'randycph@gmail.com', '639436089485', 'fak the coder', 'Yes', 'Broke', 1, 168739),
(2, 8, 'Donald Trump', 'randycph@gmail.com', '639436089485', 'Ilisdan kai wa na lamian.', 'Yes', 'Wai lami', 1, 168739);

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
  `mode_of_selling` text NOT NULL,
  `unit_of_measure` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `admin_id`, `product_id`, `qty`, `price`, `mode_of_selling`, `unit_of_measure`, `date`) VALUES
(1, 809361, 4, 1, '4.00', '', '', '2016-11-28'),
(2, 809361, 4, 2, '8.00', '', '', '2016-11-28'),
(4, 168739, 7, 1, '3.00', '', '', '2016-12-01'),
(5, 168739, 8, 2, '22.00', '', '', '2016-12-01'),
(6, 168739, 6, 1, '3.00', '', '', '2016-12-14'),
(7, 168739, 6, 2, '3.00', '', '', '2016-12-14'),
(8, 168739, 7, 1, '3.00', '', '', '2016-12-14'),
(11, 168739, 15, 3, '450.00', '', '', '2016-12-14'),
(12, 168739, 15, 12, '1800.00', '', '', '2016-12-14'),
(13, 168739, 41, 1, '17.00', 'c', 'g', '2016-12-16'),
(14, 168739, 41, 1, '17.00', 'c', 'g', '2016-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `company_name` text NOT NULL,
  `status` int(1) NOT NULL,
  `phone` text NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `name`, `mname`, `lname`, `username`, `password`, `user_level`, `image`, `company_name`, `status`, `phone`, `last_login`) VALUES
(1, 334511, ' Admin User', '', '', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '5zpjyj3r1.jpg', 'nelsa inventory system', 1, '', '2016-12-15 13:14:43'),
(2, 334511, 'Claire Logan', '', '', 'Special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'tyjmkqf2.jpg', 'John Doe Inventory System', 1, '', '2016-11-29 12:44:59'),
(3, 334511, 'Donald Trump', '', '', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'd0mr49l3.jpg', '', 1, '', '2016-11-23 11:31:04'),
(4, 0, 'Super Admin', '', '', 'super', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 0, 'no_image.jpg', '', 1, '', '2016-12-04 09:46:47'),
(7, 954864, 'Krystal Amora', '', '', 'admin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Tala inc.', 1, '', NULL),
(8, 809361, 'Mario', '', '', 'mario', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'mo6qapon8.jpg', 'Mario Bros.', 1, '', '2016-11-29 13:31:06'),
(10, 809361, 'Krystal Amora', '', '', 'admin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Mario Bros.', 1, '', NULL),
(11, 809361, 'Raijin Kunami', '', '', 'raijin', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Mario Bros.', 1, '', '2016-11-28 02:42:31'),
(12, 168739, 'nelma', '', '', 'nelma', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'Green Coffee', 1, '', '2016-12-15 13:03:29'),
(13, 168739, 'john ', '', '', 'john', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Green Coffee', 1, '', '2016-11-30 08:26:33'),
(14, 168739, 'Clement', '', '', 'clement', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Green Coffee', 1, '', '2016-12-01 09:30:23'),
(15, 168739, 'Reko', '', '', 'reko', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Green Coffee', 1, '', NULL),
(16, 334511, 'Ali Baba', '', '', 'Alibaba', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 2, 'no_image.jpg', 'Nelsa Inventory System', 1, '639436089485', NULL),
(17, 168739, 'Torta', '', '', 'torta', 'b6b5ec93b27307f4ce746eea982f12d851553bb4', 2, 'no_image.jpg', 'Green Coffee', 1, '639436089485', '2016-12-14 02:14:55'),
(18, 527075, 'a', '', '', 'a', 'efebddf7bd15ba2627baa23f8c3d8e386b99cd74', 1, 'no_image.jpg', 'a', 1, '', '2016-12-14 02:09:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
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
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;