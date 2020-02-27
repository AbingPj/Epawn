-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2020 at 02:47 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epawn`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bid_item`
--

CREATE TABLE `tbl_bid_item` (
  `id` int(11) NOT NULL,
  `item_id` int(50) NOT NULL,
  `bid_price` double(20,2) DEFAULT NULL,
  `bid_from` double(10,2) DEFAULT NULL,
  `bid_to` double(10,2) DEFAULT NULL,
  `user_id` int(50) NOT NULL,
  `pawnshop_id` int(11) NOT NULL,
  `bid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isFromPawnshop` int(11) NOT NULL DEFAULT '1',
  `interest_per_durationdays` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bid_item`
--

INSERT INTO `tbl_bid_item` (`id`, `item_id`, `bid_price`, `bid_from`, `bid_to`, `user_id`, `pawnshop_id`, `bid_date`, `isFromPawnshop`, `interest_per_durationdays`) VALUES
(1, 26, 100.00, NULL, NULL, 3, 4, '2020-02-20 19:01:42', 1, 0.00),
(2, 26, NULL, 100.00, 200.00, 3, 4, '2020-02-20 19:01:49', 1, 0.00),
(3, 21, 100.00, NULL, NULL, 1, 4, '2020-02-20 19:51:18', 1, 0.00),
(4, 25, 455.00, NULL, NULL, 3, 4, '2020-02-20 19:55:37', 1, 0.00),
(5, 25, NULL, 50.00, 100.00, 3, 4, '2020-02-20 20:08:58', 1, 0.00),
(6, 25, 500.00, NULL, NULL, 3, 2, '2020-02-21 06:48:03', 1, 0.00),
(7, 33, 100.00, NULL, NULL, 3, 2, '2020-02-21 17:18:30', 1, 0.00),
(8, 33, 500.00, NULL, NULL, 3, 2, '2020-02-21 17:19:00', 1, 0.00),
(9, 33, NULL, 10.00, 1000.00, 3, 2, '2020-02-21 17:26:08', 1, 0.00),
(10, 33, 50.00, NULL, NULL, 3, 2, '2020-02-21 17:26:18', 0, 0.00),
(11, 33, 773.00, 0.00, 0.00, 3, 2, '2020-02-21 17:26:18', 0, 0.00),
(12, 33, 818.00, 0.00, 0.00, 3, 2, '2020-02-21 17:26:41', 0, 0.00),
(13, 33, 251.00, 0.00, 0.00, 3, 2, '2020-02-21 17:26:58', 0, 0.00),
(14, 33, 1000.00, 0.00, 0.00, 3, 2, '2020-02-21 17:27:56', 0, 0.00),
(15, 33, 417.00, NULL, NULL, 3, 2, '2020-02-21 17:31:18', 0, 0.00),
(16, 33, 10.00, NULL, NULL, 3, 2, '2020-02-21 17:37:55', 0, 0.00),
(17, 33, 500.00, NULL, NULL, 3, 2, '2020-02-21 17:38:48', 0, 0.00),
(18, 30, 100.00, NULL, NULL, 3, 2, '2020-02-21 17:46:00', 1, 0.00),
(19, 30, NULL, 100.00, 500.00, 3, 2, '2020-02-21 17:46:24', 1, 0.00),
(20, 30, 411.00, NULL, NULL, 3, 2, '2020-02-21 17:47:11', 0, 0.00),
(21, 30, 500.00, NULL, NULL, 3, 2, '2020-02-21 17:47:24', 0, 0.00),
(22, 34, NULL, 10.00, 150.00, 3, 2, '2020-02-21 18:35:41', 1, 0.00),
(23, 32, NULL, 1000.00, 4000.00, 3, 13, '2020-02-21 19:52:31', 1, 0.00),
(24, 32, 4000.00, NULL, NULL, 3, 13, '2020-02-21 19:54:49', 0, 0.00),
(25, 38, NULL, 1000.00, 2000.00, 3, 13, '2020-02-21 21:07:06', 1, 0.00),
(26, 38, 1457.00, NULL, NULL, 3, 13, '2020-02-21 21:07:34', 0, 0.00),
(27, 43, NULL, 100.00, 500.00, 7, 13, '2020-02-24 08:34:44', 1, 0.00),
(28, 43, 274.00, 0.00, 0.00, 7, 13, '2020-02-24 08:39:41', 0, 0.00),
(29, 41, NULL, 1000.00, 6000.00, 14, 13, '2020-02-24 11:12:56', 1, 0.00),
(30, 46, NULL, 1000.00, 1500.00, 14, 2, '2020-02-25 05:56:38', 1, 0.00),
(31, 44, 1000.00, NULL, NULL, 16, 4, '2020-02-25 15:21:44', 1, 0.00),
(32, 47, 50.00, NULL, NULL, 9, 4, '2020-02-25 15:40:42', 1, 0.00),
(33, 47, 50.00, NULL, NULL, 9, 4, '2020-02-25 15:40:42', 1, 0.00),
(34, 47, NULL, 100.00, 1000.00, 9, 4, '2020-02-25 15:43:51', 1, 0.00),
(35, 47, 1000.00, NULL, NULL, 9, 4, '2020-02-25 15:44:10', 0, 0.00),
(36, 47, 524.00, NULL, NULL, 9, 4, '2020-02-25 15:44:50', 0, 0.00),
(37, 47, NULL, 4000.00, 6000.00, 9, 4, '2020-02-25 16:02:37', 1, 0.00),
(38, 47, 6000.00, NULL, NULL, 9, 4, '2020-02-25 16:02:52', 0, 0.00),
(39, 47, NULL, 4000.00, 6000.00, 9, 4, '2020-02-25 16:02:59', 1, 0.00),
(40, 47, 5131.00, NULL, NULL, 9, 4, '2020-02-25 16:04:20', 0, 0.00),
(41, 47, NULL, 5000.00, 7000.00, 9, 4, '2020-02-25 17:19:28', 1, 0.00),
(42, 47, 7000.00, 0.00, 0.00, 9, 4, '2020-02-25 17:20:36', 0, 0.00),
(43, 47, 6565.00, 0.00, 0.00, 9, 4, '2020-02-25 17:21:01', 0, 0.00),
(44, 47, NULL, 1001.00, 3000.00, 9, 4, '2020-02-25 17:21:39', 1, 0.00),
(45, 47, NULL, 1001.00, 3000.00, 9, 4, '2020-02-25 17:21:39', 1, 0.00),
(46, 47, NULL, 1001.00, 4000.00, 9, 4, '2020-02-25 17:21:57', 1, 0.00),
(47, 47, NULL, 1000.00, 5000.00, 9, 2, '2020-02-25 17:37:04', 1, 0.00),
(48, 48, NULL, 1000.00, 2000.00, 9, 2, '2020-02-25 17:45:18', 1, 0.00),
(49, 48, NULL, 1000.00, 2000.00, 9, 2, '2020-02-25 17:45:18', 1, 0.00),
(50, 48, 1789.00, NULL, NULL, 9, 2, '2020-02-25 17:45:50', 0, 0.00),
(51, 48, 2000.00, NULL, NULL, 9, 2, '2020-02-25 17:49:54', 0, 0.00),
(52, 22, NULL, 1000.00, 5000.00, 1, 2, '2020-02-25 18:09:57', 1, 0.00),
(53, 47, 1112.00, NULL, NULL, 9, 4, '2020-02-26 02:49:39', 0, 0.00),
(54, 47, 5000.00, 0.00, 0.00, 9, 2, '2020-02-26 05:18:41', 0, 0.00),
(55, 41, NULL, 500.00, 2000.00, 14, 2, '2020-02-26 06:51:45', 1, 0.00),
(56, 50, NULL, 1.00, 5.00, 18, 2, '2020-02-26 07:02:14', 1, 0.00),
(57, 50, 3.00, 0.00, 0.00, 18, 2, '2020-02-26 07:04:17', 0, 0.00),
(58, 51, NULL, 1000.00, 5000.00, 18, 2, '2020-02-26 08:27:43', 1, 0.00),
(59, 51, 3026.00, NULL, NULL, 18, 2, '2020-02-26 08:28:08', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `gender_id` int(10) NOT NULL,
  `gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_accepted`
--

CREATE TABLE `tbl_item_accepted` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `accepted_item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_category`
--

CREATE TABLE `tbl_item_category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` text NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `fromUser` int(11) DEFAULT NULL,
  `category_reason` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_category`
--

INSERT INTO `tbl_item_category` (`category_id`, `category_name`, `category_description`, `valid`, `fromUser`, `category_reason`) VALUES
(1, 'Gold & Jewelry', 'Mga alahas ug mga jewels', 1, 2, NULL),
(2, 'appliances', 'kagamitang de kuryente', 1, NULL, NULL),
(3, 'Cats', 'Mga iring bawal itom', 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_photo`
--

CREATE TABLE `tbl_item_photo` (
  `id` int(11) NOT NULL,
  `item_id` int(50) NOT NULL,
  `item_photos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_photo`
--

INSERT INTO `tbl_item_photo` (`id`, `item_id`, `item_photos`) VALUES
(1, 25, 'asd.jpg\r\n'),
(2, 1, '3item_photo11.jpg'),
(3, 1, '3item_photo11.jpg'),
(4, 1, '3item_photo12.jpg'),
(5, 1, '3item_photo13.jpg'),
(6, 1, '3item_photo14.jpg'),
(7, 32, '3item_photo321.jpg'),
(8, 32, '3item_photo322.jpg'),
(9, 32, '3item_photo323.jpg'),
(10, 32, '3item_photo324.jpg'),
(11, 33, '3item_photo331.jpg'),
(12, 33, '3item_photo332.jpg'),
(13, 33, '3item_photo333.jpg'),
(14, 33, '3item_photo334.jpg'),
(15, 38, '3item_photo381.jpg'),
(16, 38, '3item_photo382.jpg'),
(17, 38, '3item_photo383.jpg'),
(18, 38, '3item_photo384.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package_duration`
--

CREATE TABLE `tbl_package_duration` (
  `package_id` int(11) NOT NULL,
  `duration_from` int(11) NOT NULL,
  `duration_to` int(11) NOT NULL,
  `interestRate` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package_duration`
--

INSERT INTO `tbl_package_duration` (`package_id`, `duration_from`, `duration_to`, `interestRate`) VALUES
(2, 11, 50, 4.00),
(2, 1, 10, 1.00),
(2, 1, 30, 4.00),
(2, 1, 15, 1.00),
(5, 1, 30, 1.00),
(9, 1, 30, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pawned_items`
--

CREATE TABLE `tbl_pawned_items` (
  `pawned_id` int(11) NOT NULL,
  `pawnshop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `days_deadline` int(11) DEFAULT NULL,
  `months_ext` int(11) DEFAULT NULL,
  `pawn_reason` varchar(600) NOT NULL,
  `pawn_amount` double(10,2) DEFAULT NULL,
  `payable` double(10,2) NOT NULL,
  `interest_rate` double(10,2) NOT NULL,
  `interest_per_durationdays` double(10,2) NOT NULL,
  `bid_from` int(111) DEFAULT NULL,
  `bid_to` int(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pawned_items`
--

INSERT INTO `tbl_pawned_items` (`pawned_id`, `pawnshop_id`, `item_id`, `package_id`, `user_Id`, `days_deadline`, `months_ext`, `pawn_reason`, `pawn_amount`, `payable`, `interest_rate`, `interest_per_durationdays`, `bid_from`, `bid_to`) VALUES
(1, 4, 1, 1, 3, 8, NULL, '', 150.00, 0.00, 0.00, 0.00, 1, 30),
(2, 4, 29, 1, 3, 5, NULL, '', 1500.00, 0.00, 0.00, 0.00, 1, 30),
(3, 4, 28, 1, 3, 24, NULL, '', 244.00, 0.00, 0.00, 0.00, 1, 30),
(4, 4, 26, 2, 3, 4, NULL, '', 100.00, 0.00, 0.00, 0.10, 1, 10),
(5, 4, 26, 2, 3, 4, NULL, '', 100.00, 0.00, 0.00, 0.08, 11, 50),
(6, 2, 30, 5, 3, 14, NULL, 'fake', NULL, 0.00, 0.00, 0.00, NULL, NULL),
(7, 2, 33, 5, 3, 4, NULL, '', 50.00, 0.00, 0.00, 0.02, 1, 30),
(8, 13, 32, 9, 3, 7, NULL, '', 4000.00, 0.00, 0.00, 1.33, 1, 30),
(9, 13, 38, 9, 3, 8, NULL, '', 1457.00, 0.00, 0.00, 0.49, 1, 30),
(10, 13, 43, 9, 7, 7, NULL, '', 274.00, 0.00, 0.00, 0.09, 1, 30),
(11, 2, 50, 5, 18, 7, NULL, '', 3.00, 0.00, 0.00, 0.00, 1, 30),
(12, 2, 51, 5, 18, 8, NULL, '', 3026.00, 0.00, 0.00, 1.01, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pawnshop_info`
--

CREATE TABLE `tbl_pawnshop_info` (
  `p_id` int(50) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pawnshop_itemcategory`
--

CREATE TABLE `tbl_pawnshop_itemcategory` (
  `pawnshop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pawnshop_itemcategory`
--

INSERT INTO `tbl_pawnshop_itemcategory` (`pawnshop_id`, `category_id`) VALUES
(2, 1),
(2, 2),
(4, 1),
(4, 2),
(13, 1),
(13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pawnshop_package`
--

CREATE TABLE `tbl_pawnshop_package` (
  `package_id` int(11) NOT NULL,
  `package_name` text NOT NULL,
  `pawnshop_id` int(11) NOT NULL,
  `package_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pawnshop_package`
--

INSERT INTO `tbl_pawnshop_package` (`package_id`, `package_name`, `pawnshop_id`, `package_description`) VALUES
(2, 'default', 4, 'sadasd'),
(5, 'sample', 2, 'new desc'),
(9, 'Default', 13, 'Default Package');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `pawned_id` int(11) NOT NULL,
  `payment` double(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `pawned_id`, `payment`, `payment_date`) VALUES
(1, 32, 1.33, '2020-02-21 21:03:57'),
(2, 38, 0.49, '2020-02-21 21:13:10'),
(3, 28, 244.00, '2020-02-25 15:22:57'),
(4, 28, 244.00, '2020-02-25 15:22:57'),
(5, 33, 200.00, '2020-02-25 18:09:13'),
(6, 50, 1.00, '2020-02-26 07:08:51'),
(7, 33, 500.00, '2020-02-26 07:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `gender_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `image` varchar(100) NOT NULL,
  `business_permit` varchar(255) DEFAULT NULL,
  `control_num` varchar(255) DEFAULT NULL,
  `role_id` int(5) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `latitude` text,
  `longtitude` text,
  `isValid` int(11) NOT NULL DEFAULT '0',
  `reason` text,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `noticed` timestamp NULL DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `monthCofescation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `fname`, `gender_id`, `username`, `password`, `address`, `contact`, `email`, `image`, `business_permit`, `control_num`, `role_id`, `branch`, `latitude`, `longtitude`, `isValid`, `reason`, `joined`, `noticed`, `flag`, `monthCofescation`) VALUES
(1, 'admin', 0, 'admin', 'admin', '', '', 'admin@admin.com', '', NULL, NULL, 1, '', '', '', 0, NULL, '2020-02-17 08:13:52', NULL, 0, 0),
(2, 'RD Pawnshop', 0, 'RD Pawnshop', '1234', 'Matina Crossing', '09402336661', 'rd@gmail.com', '1582316706download.png', '1582316706download.png', '100698', 2, '', '7.062911', '125.598727', 0, NULL, '2020-02-17 08:17:48', NULL, 0, 5),
(3, 'Jeremiah Revil', 0, 'Jeremiah Revil', '123', 'asd', 'asd', 'revil@gmail.com', 'no-profile.png', '', NULL, 3, '', '123', '123', 0, NULL, '2020-02-17 14:17:25', NULL, 0, 0),
(4, 'palawan pawnshop UM', 0, 'palawan pawnshop UM', '123', 'Um Matina', '0933441502', 'palawanUM@gmail.com', 'no-profile.png', 'no-image.png', '97781', 2, '', NULL, NULL, 0, NULL, '2020-02-19 19:01:47', NULL, 0, 5),
(5, 'lloydkristoper@gmail.com', 0, 'lloydkristoper@gmail.com', '123', '', 'lloydkristo', 'lloydkristoper@gmail.com', '', NULL, NULL, 3, '', NULL, NULL, 0, NULL, '2020-02-20 00:10:48', NULL, 0, 0),
(7, 'maya_revil@yahoo.com', 0, 'maya_revil@yahoo.com', '1234', '', 'maya_revil@', 'maya_revil@yahoo.com', '', NULL, NULL, 3, '', NULL, NULL, 0, NULL, '2020-02-21 01:53:25', NULL, 0, 0),
(8, 'lloydkristoper@gmail.com', 0, 'lloydkristoper@gmail.com', '123', '', 'lloydkristo', 'lloydkristoper@gmail.com', '', NULL, NULL, 3, '', '7.0659738', '125.5649312', 0, NULL, '2020-02-21 16:48:36', NULL, 0, 0),
(9, 'pj.abing@gmail.com', 0, 'pj.abing@gmail.com', 'password', '', 'pj.abing@gm', 'pj.abing@gmail.com', '', NULL, NULL, 3, '', '7.0646135', '125.5595215', 0, NULL, '2020-02-21 17:08:33', NULL, 0, 0),
(10, 'Leonardgetes062@gmail.com', 0, 'Leonardgetes062@gmail.com', 'leonardgetes', '', 'Leonardgete', 'Leonardgetes062@gmail.com', '', NULL, NULL, 3, '', NULL, NULL, 0, NULL, '2020-02-21 18:13:44', NULL, 0, 0),
(11, 'lloydkristoper@gmail.com', 0, 'lloydkristoper@gmail.com', '123', '', 'lloydkristo', 'lloydkristoper@gmail.com', '', NULL, NULL, 3, '', '123', '123', 0, NULL, '2020-02-21 19:02:47', NULL, 0, 0),
(12, 'De Leon Pawnshop', 0, 'De Leon Pawnshop', '1234', 'Matina Crossing', '09562255632', 'deleon@gmail.com', '1582316823download (1).jfif', '1582316823download (1).jfif', '348781', 2, '', '7.059024', '125.568858', 1, NULL, '2020-02-21 19:44:56', '2020-02-22 02:46:42', 0, 4),
(13, 'Rosver Pawnshop', 0, 'Rosver Pawnshop', '1234', 'Matina Crossing', '09461155512', 'rosver@gmail.com', '1582314513download.jfif', '1582314513download.jfif', '656922', 2, '', '7.058497', '125.568900', 1, NULL, '2020-02-21 19:46:19', '2020-02-22 02:46:49', 0, 4),
(14, 'lim@gmail.com', 0, 'lim@gmail.com', '123', '', 'lim@gmail.c', 'lim@gmail.com', '', NULL, NULL, 3, '', '7.0646135', '125.5595215', 0, NULL, '2020-02-23 12:25:45', NULL, 0, 0),
(15, 'user@gmail.com', 0, 'user@gmail.com', '1', '', 'user@gmail.', 'user@gmail.com', '', NULL, NULL, 3, '', '7.0646135', '125.5595215', 0, NULL, '2020-02-23 14:24:45', NULL, 0, 0),
(16, 'newuser2', 0, 'newuser2', '123', '', 'newuser2', 'newuser2', '', NULL, NULL, 3, '', '7.0651449', '125.5615113', 0, NULL, '2020-02-24 08:40:16', NULL, 0, 0),
(17, 'Bingz Company', 0, 'Bingz Company', 'oasswird', 'Matina Aplaya, Davao City', '09068002020', 'abing.pj@gmail.com', '', '1582690806FB_IMG_1560417528415.jpg', '321123321', 2, '', NULL, NULL, 0, NULL, '2020-02-26 04:20:06', NULL, 0, 0),
(18, 'maya@yahoo.com', 0, 'maya@yahoo.com', '1234', '', 'maya@yahoo.', 'maya@yahoo.com', '', NULL, NULL, 3, '', '7.0617168', '125.5697358', 0, NULL, '2020-02-26 06:57:25', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_itempost`
--

CREATE TABLE `tbl_user_itempost` (
  `item_id` int(50) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_description` text NOT NULL,
  `item_photo` varchar(255) NOT NULL,
  `photo_1` text NOT NULL,
  `photo_2` text NOT NULL,
  `photo_3` text NOT NULL,
  `photo_4` text NOT NULL,
  `category_id` int(10) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `pawnshop_id` int(11) DEFAULT NULL,
  `initial_amount` double(10,2) NOT NULL,
  `isExpired` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_itempost`
--

INSERT INTO `tbl_user_itempost` (`item_id`, `item_name`, `item_description`, `item_photo`, `photo_1`, `photo_2`, `photo_3`, `photo_4`, `category_id`, `user_id`, `date`, `status`, `pawnshop_id`, `initial_amount`, `isExpired`) VALUES
(1, 'sampleItem', 'item sample', 'me.png', '', '', '', '', 1, 3, '2020-02-17 14:18:23', 2, 4, 150.00, 1),
(19, 'for image', 'for image', '1582149451ionicfile', '', '', '', '', 1, 1, '2020-02-19 21:57:31', 0, NULL, 0.00, 1),
(20, 'for image', 'for image', 'iphone_maya.jpg', '', '', '', '', 1, 1, '2020-02-19 21:59:58', 0, NULL, 0.00, 1),
(21, 'for image', 'for image', 'iphone_maya.jpg', '', '', '', '', 1, 1, '2020-02-19 22:03:10', 0, NULL, 0.00, 1),
(22, 'for image', 'for image', 'iphone_maya.jpg', '', '', '', '', 1, 1, '2020-02-19 22:04:25', 0, NULL, 0.00, 1),
(23, 'for image', 'for image', '1582149887ionicfile.jpg', '', '', '', '', 1, 1, '2020-02-19 22:04:50', 0, NULL, 0.00, 1),
(24, 'Gh', 'Gg', '3item[object Object].jpg', '', '', '', '', 1, 3, '2020-02-19 22:20:33', 0, NULL, 0.00, 1),
(25, 'iphone 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id tortor sed elit aliquam cursus in nec arcu. Quisque imperdiet vestibulum sagittis. Praesent lacus tortor, faucibus id cursus nec, lobortis in urna. Donec porttitor aliquet mauris, eget tincidunt lacus consequat sed. Sed gravida, neque ut mollis tempus, lectus mauris cursus leo, non facilisis felis nunc a nibh. Mauris et justo auctor, vestibulum magna sit amet, rutrum lorem. Pellentesque id tempus purus, eget hendrerit eros. Vestibulum nec lectus convallis, eleifend quam id, tincidunt metus. Nullam vulputate, augue nec efficitur tempus, ex ligula egestas enim, id auctor nisi ligula vel magna. Cras ultricies pulvinar magna vitae tincidunt. Nam luctus ultricies tortor bibendum tincidunt. Ut eget libero quis erat accumsan tincidunt. Ut id porttitor ante, in fermentum ante.\r\n\r\nMorbi vulputate mauris sit amet eros congue, ac vulputate metus bibendum. Donec lacus arcu, pretium nec ullamcorper vitae, rhoncus in magna. Phasellus vestibulum in lectus sit amet tristique. Sed vel dolor quis sem malesuada posuere. Nulla dictum fermentum tellus vitae euismod. Praesent accumsan ipsum at metus aliquam, id lobortis turpis eleifend. Pellentesque tincidunt nisi id sem maximus imperdiet. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nPellentesque a tristique nisl. Aliquam erat volutpat. Nullam condimentum faucibus malesuada. Etiam sapien enim, ultrices in gravida congue, lobortis non urna. Donec lectus ex, condimentum hendrerit urna efficitur, semper porttitor massa. Cras ultricies facilisis laoreet. Pellentesque commodo magna massa, eu euismod purus consectetur non. Pellentesque eget mollis magna. Aenean et lacinia ligula. Etiam auctor, sapien nec dapibus finibus, dolor lorem elementum purus, ac rutrum odio mi eu lorem. Cras mi nunc, suscipit et odio vitae, elementum scelerisque sapien. Proin vitae nisi sit amet elit commodo interdum id in arcu. Etiam interdum suscipit lorem vel pellentesque. Cras iaculis nisi maximus imperdiet luctus. Nulla varius lorem ut interdum ultrices.\r\n\r\nDonec lorem lorem, mattis in egestas nec, placerat eget ex. Nullam aliquam dictum justo, et efficitur mauris lobortis ac. Quisque eget convallis tellus, non convallis diam. Ut dictum pulvinar ultrices. Donec suscipit in tellus ullamcorper scelerisque. Donec blandit euismod maximus. Suspendisse ut massa tempus, commodo nisi nec, sodales purus. In interdum sagittis nulla, eget porta justo maximus iaculis. Sed id bibendum lorem. Nam eros lacus, fringilla id scelerisque eu, gravida vitae est. Nullam ut ultricies nibh. Quisque porta lacus non blandit bibendum.\r\n\r\nMorbi facilisis magna ut diam convallis bibendum. Integer imperdiet vestibulum dolor sit amet facilisis. Donec sapien est, eleifend et lacinia vel, porttitor nec lorem. Suspendisse suscipit, nulla eget sodales gravida, felis felis aliquet neque, nec posuere magna lectus vel nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce venenatis urna turpis, at consectetur nibh malesuada nec. Sed ac tincidunt metus, ut semper enim. Quisque scelerisque arcu id ultrices pretium. Fusce quis consequat massa. Mauris viverra, lectus sed varius consequat, odio nisi sagittis nibh, eget fringilla nulla orci nec ligula. Nunc venenatis, ex at pharetra tristique, metus sem accumsan metus, in rutrum ante quam sit amet quam. Nulla nec libero sit amet ligula facilisis volutpat. In ornare leo orci, eget efficitur tellus aliquet nec. Aliquam nec mollis tortor.', 'iphone_maya.jpg', '', '', '', '', 1, 3, '2020-02-19 22:23:42', 0, NULL, 0.00, 1),
(26, 'Xhuji', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id tortor sed elit aliquam cursus in nec arcu. Quisque imperdiet vestibulum sagittis. Praesent lacus tortor, faucibus id cursus nec, lobortis in urna. Donec porttitor aliquet mauris, eget tincidunt lacus consequat sed. Sed gravida, neque ut mollis tempus, lectus mauris cursus leo, non facilisis felis nunc a nibh. Mauris et justo auctor, vestibulum magna sit amet, rutrum lorem. Pellentesque id tempus purus, eget hendrerit eros. Vestibulum nec lectus convallis, eleifend quam id, tincidunt metus. Nullam vulputate, augue nec efficitur tempus, ex ligula egestas enim, id auctor nisi ligula vel magna. Cras ultricies pulvinar magna vitae tincidunt. Nam luctus ultricies tortor bibendum tincidunt. Ut eget libero quis erat accumsan tincidunt. Ut id porttitor ante, in fermentum ante.\r\n\r\nMorbi vulputate mauris sit amet eros congue, ac vulputate metus bibendum. Donec lacus arcu, pretium nec ullamcorper vitae, rhoncus in magna. Phasellus vestibulum in lectus sit amet tristique. Sed vel dolor quis sem malesuada posuere. Nulla dictum fermentum tellus vitae euismod. Praesent accumsan ipsum at metus aliquam, id lobortis turpis eleifend. Pellentesque tincidunt nisi id sem maximus imperdiet. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nPellentesque a tristique nisl. Aliquam erat volutpat. Nullam condimentum faucibus malesuada. Etiam sapien enim, ultrices in gravida congue, lobortis non urna. Donec lectus ex, condimentum hendrerit urna efficitur, semper porttitor massa. Cras ultricies facilisis laoreet. Pellentesque commodo magna massa, eu euismod purus consectetur non. Pellentesque eget mollis magna. Aenean et lacinia ligula. Etiam auctor, sapien nec dapibus finibus, dolor lorem elementum purus, ac rutrum odio mi eu lorem. Cras mi nunc, suscipit et odio vitae, elementum scelerisque sapien. Proin vitae nisi sit amet elit commodo interdum id in arcu. Etiam interdum suscipit lorem vel pellentesque. Cras iaculis nisi maximus imperdiet luctus. Nulla varius lorem ut interdum ultrices.\r\n\r\nDonec lorem lorem, mattis in egestas nec, placerat eget ex. Nullam aliquam dictum justo, et efficitur mauris lobortis ac. Quisque eget convallis tellus, non convallis diam. Ut dictum pulvinar ultrices. Donec suscipit in tellus ullamcorper scelerisque. Donec blandit euismod maximus. Suspendisse ut massa tempus, commodo nisi nec, sodales purus. In interdum sagittis nulla, eget porta justo maximus iaculis. Sed id bibendum lorem. Nam eros lacus, fringilla id scelerisque eu, gravida vitae est. Nullam ut ultricies nibh. Quisque porta lacus non blandit bibendum.\r\n\r\nMorbi facilisis magna ut diam convallis bibendum. Integer imperdiet vestibulum dolor sit amet facilisis. Donec sapien est, eleifend et lacinia vel, porttitor nec lorem. Suspendisse suscipit, nulla eget sodales gravida, felis felis aliquet neque, nec posuere magna lectus vel nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce venenatis urna turpis, at consectetur nibh malesuada nec. Sed ac tincidunt metus, ut semper enim. Quisque scelerisque arcu id ultrices pretium. Fusce quis consequat massa. Mauris viverra, lectus sed varius consequat, odio nisi sagittis nibh, eget fringilla nulla orci nec ligula. Nunc venenatis, ex at pharetra tristique, metus sem accumsan metus, in rutrum ante quam sit amet quam. Nulla nec libero sit amet ligula facilisis volutpat. In ornare leo orci, eget efficitur tellus aliquet nec. Aliquam nec mollis tortor.', 'marcbook_lloyd.jpg', '', '', '', '', 1, 3, '2020-02-19 22:25:38', 2, 4, 100.00, 1),
(27, 'Sample item as of feb 20 2020', 'Sample item with working picture', '3item261.jpg', '', '', '', '', 1, 3, '2020-02-20 14:24:06', 0, NULL, 0.00, 1),
(28, 'Seasonic powersupply for pc', 'With image na', '3item271.jpg', '', '', '', '', 1, 3, '2020-02-20 14:26:17', 2, 4, 244.00, 1),
(29, 'Sample item feb 2 2020', 'Zample lang', '3item281.jpg', '', '', '', '', 1, 3, '2020-02-20 14:32:15', 2, 4, 500.00, 1),
(30, 'Karun lang jud ni na item', 'Gagahshr', '3item291.jpg', '', '', '', '', 1, 3, '2020-02-21 05:30:25', 4, 2, 500.00, 1),
(31, 'Sample item', 'Hajajaggshs', '3item301.jpg', '', '', '', '', 1, 3, '2020-02-21 16:03:53', 0, NULL, 0.00, 1),
(32, 'Sample item', 'Item\'s description', '3item311.jpg', '', '', '', '', 1, 3, '2020-02-21 17:03:43', 2, 13, 4000.00, 1),
(33, 'Acer laptop', 'Gaming laptop 1 year use', '3item321.jpg', '', '', '', '', 1, 3, '2020-02-21 17:10:20', 2, 2, 50.00, 1),
(34, 'Abing item', 'Abing description', '3item331.jpg', '', '', '', '', 1, 3, '2020-02-21 18:34:15', 0, NULL, 0.00, 1),
(35, 'Maya new item', 'Maya item new description', '3item341.jpg', '', '', '', '', 1, 3, '2020-02-21 18:46:26', 0, NULL, 0.00, 1),
(36, 'Acer123', 'Laptop', '3item351.jpg', '', '', '', '', 2, 3, '2020-02-21 19:12:18', 0, NULL, 0.00, 1),
(37, 'Trident Z 16gb', 'Trident z na ram', '3item361.jpg', '', '', '', '', 2, 3, '2020-02-21 19:22:12', 0, NULL, 0.00, 1),
(38, 'Hiho', 'Hahahehe', '3item371.jpg', '', '', '', '', 1, 3, '2020-02-21 21:06:20', 2, 13, 1457.00, 1),
(39, 'Item sapleha', 'Gdhs', '14itemundefined1.jpg', '', '', '', '', 2, 14, '2020-02-23 12:29:35', 0, NULL, 0.00, 1),
(41, 'Item dess', 'Gshhss', '14item_picture_main1582466856721.jpg', '14item_other_pictures11582466856721.jpg', '14item_other_pictures21582466856721.jpg', '14item_other_pictures31582466856721.jpg', '14item_other_picture41582466856721.jpg', 2, 14, '2020-02-23 14:07:03', 0, NULL, 0.00, 1),
(42, 'New item for new user', 'New item for new user description', '15item_picture_main1582467991577.jpg', '15item_other_pictures11582467991577.jpg', '15item_other_pictures21582467991577.jpg', '15item_other_pictures31582467991577.jpg', '15item_other_picture41582467991577.jpg', 1, 15, '2020-02-23 14:25:57', 0, NULL, 0.00, 1),
(43, 'Item sample hehe', 'Jshahajjdd', '7item_picture_main1582532973804.jpg', '7item_other_pictures11582532973804.jpg', '7item_other_pictures21582532973804.jpg', '7item_other_pictures31582532973804.jpg', '7item_other_picture41582532973804.jpg', 2, 7, '2020-02-24 08:30:16', 2, 13, 274.00, 1),
(44, 'Pc', 'New pc', '16item_picture_main1582534363093.jpg', '16item_other_pictures11582534363093.jpg', '16item_other_pictures21582534363093.jpg', '16item_other_pictures31582534363093.jpg', '16item_other_picture41582534363093.jpg', 2, 16, '2020-02-24 08:54:02', 0, NULL, 0.00, 1),
(45, 'Sample', 'Sample ittem description', '14item_picture_main1582582105031.jpg', '14item_other_pictures11582582105031.jpg', '14item_other_pictures21582582105031.jpg', '14item_other_pictures31582582105031.jpg', '14item_other_picture41582582105031.jpg', 1, 14, '2020-02-24 22:07:43', 0, NULL, 0.00, 1),
(46, 'Sample in live app', 'Hdj', '14item_picture_main1582584562184.jpg', '14item_other_pictures11582584562184.jpg', '14item_other_pictures21582584562184.jpg', '14item_other_pictures31582584562184.jpg', '14item_other_picture41582584562184.jpg', 2, 14, '2020-02-24 22:49:11', 0, NULL, 0.00, 1),
(47, 'Wedding ring classic style', 'Wedding ring, 18k gold, 2.5g,', '9item_picture_main1582645126916.jpg', '9item_other_pictures11582645126916.jpg', '9item_other_pictures21582645126916.jpg', '9item_other_pictures31582645126916.jpg', '9item_other_picture41582645126916.jpg', 1, 9, '2020-02-25 15:38:55', 0, NULL, 0.00, 1),
(48, 'Engagement Ring', '18k pure Saudi gold, 1.1 grams', '9item_picture_main1582652649656.jpg', '9item_other_pictures11582652649656.jpg', '9item_other_pictures21582652649656.jpg', '9item_other_pictures31582652649656.jpg', '9item_other_picture41582652649656.jpg', 1, 9, '2020-02-25 17:44:24', 1, 2, 2000.00, 1),
(49, 'Haaahhuuu', 'Hahahha', '7item_picture_main1582698670226.jpg', '7item_other_pictures11582698670226.jpg', '7item_other_pictures21582698670226.jpg', '7item_other_pictures31582698670226.jpg', '7item_other_picture41582698670226.jpg', 1, 7, '2020-02-26 06:31:36', 0, NULL, 0.00, 1),
(50, 'Oppo a3s', 'Cellphone na orig', '18item_picture_main1582700406606.jpg', '18item_other_pictures11582700406606.jpg', '18item_other_pictures21582700406606.jpg', '18item_other_pictures31582700406606.jpg', '18item_other_picture41582700406606.jpg', 2, 18, '2020-02-26 07:01:43', 2, 2, 3.00, 1),
(51, 'Ambot', 'Qbxhzjsjsj cuudhdhdhdifjsj', '18item_picture_main1582705494680.jpg', '18item_other_pictures11582705494680.jpg', '18item_other_pictures21582705494680.jpg', '18item_other_pictures31582705494680.jpg', '18item_other_picture41582705494680.jpg', 1, 18, '2020-02-26 08:25:22', 2, 2, 3026.00, 1),
(52, 'Hai ko', 'Yuuus', '18item_picture_main1582709511480.jpg', '18item_other_pictures11582709511480.jpg', '18item_other_pictures21582709511480.jpg', '18item_other_pictures31582709511480.jpg', '18item_other_picture41582709511480.jpg', 1, 18, '2020-02-26 09:31:58', 0, NULL, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_reports`
--

CREATE TABLE `tbl_user_reports` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `pawnshopId` int(11) DEFAULT NULL,
  `situation` text,
  `isFromPawnshop` int(11) DEFAULT NULL,
  `dateReported` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `role_id` int(5) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`role_id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bid_item`
--
ALTER TABLE `tbl_bid_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tbl_item_accepted`
--
ALTER TABLE `tbl_item_accepted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_item_photo`
--
ALTER TABLE `tbl_item_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tbl_package_duration`
--
ALTER TABLE `tbl_package_duration`
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `tbl_pawned_items`
--
ALTER TABLE `tbl_pawned_items`
  ADD PRIMARY KEY (`pawned_id`);

--
-- Indexes for table `tbl_pawnshop_info`
--
ALTER TABLE `tbl_pawnshop_info`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_pawnshop_itemcategory`
--
ALTER TABLE `tbl_pawnshop_itemcategory`
  ADD PRIMARY KEY (`pawnshop_id`,`category_id`);

--
-- Indexes for table `tbl_pawnshop_package`
--
ALTER TABLE `tbl_pawnshop_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`role_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `tbl_user_itempost`
--
ALTER TABLE `tbl_user_itempost`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_user_reports`
--
ALTER TABLE `tbl_user_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bid_item`
--
ALTER TABLE `tbl_bid_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `gender_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_accepted`
--
ALTER TABLE `tbl_item_accepted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_item_photo`
--
ALTER TABLE `tbl_item_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_pawned_items`
--
ALTER TABLE `tbl_pawned_items`
  MODIFY `pawned_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pawnshop_info`
--
ALTER TABLE `tbl_pawnshop_info`
  MODIFY `p_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pawnshop_package`
--
ALTER TABLE `tbl_pawnshop_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user_itempost`
--
ALTER TABLE `tbl_user_itempost`
  MODIFY `item_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_user_reports`
--
ALTER TABLE `tbl_user_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_item_photo`
--
ALTER TABLE `tbl_item_photo`
  ADD CONSTRAINT `tbl_item_photo_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_user_itempost` (`item_id`);

--
-- Constraints for table `tbl_user_itempost`
--
ALTER TABLE `tbl_user_itempost`
  ADD CONSTRAINT `tbl_user_itempost_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_item_category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
