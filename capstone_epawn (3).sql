-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2020 at 10:51 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_epawn`
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
  `bid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `isFromPawnshop` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bid_item`
--

INSERT INTO `tbl_bid_item` (`id`, `item_id`, `bid_price`, `bid_from`, `bid_to`, `user_id`, `pawnshop_id`, `bid_date`, `isFromPawnshop`) VALUES
(1, 1, 15.00, NULL, NULL, 3, 1, '2020-02-09 21:46:07', 1),
(2, 1, NULL, 12.00, 15.00, 3, 1, '2020-02-09 21:46:15', 1);

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
  `valid` int(11) NOT NULL DEFAULT 1,
  `fromUser` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_category`
--

INSERT INTO `tbl_item_category` (`category_id`, `category_name`, `category_description`, `valid`, `fromUser`, `reason`) VALUES
(1, 'jewelry', 'kanang mga gina suot sa tao na gamit', 1, NULL, NULL),
(2, 'appliances', 'kanang mga gamitonun sa balay na way pulos', 1, NULL, NULL),
(3, 'gadget', 'kanang pareha kay batman na mga gamit', 1, NULL, NULL),
(4, 'laptop & computers', 'mga gina gamit sa buang', 1, NULL, NULL),
(5, 'vehichle', 'mga kariton na maka dagan', 1, NULL, NULL),
(6, 'tae', 'asd', 3, 1, 'dli approriate ang category name');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_photo`
--

CREATE TABLE `tbl_item_photo` (
  `id` int(11) NOT NULL,
  `item_id` int(50) NOT NULL,
  `item_photos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 30, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pawned_items`
--

CREATE TABLE `tbl_pawned_items` (
  `pawnshop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `days_deadline` int(11) DEFAULT NULL,
  `months_ext` int(11) DEFAULT NULL,
  `pawn_reason` varchar(600) NOT NULL,
  `pawn_amount` double(10,2) NOT NULL,
  `interest_rate` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '123', 1, 'asd');

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
  `lat` text NOT NULL,
  `lang` text NOT NULL,
  `isValid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `fname`, `gender_id`, `username`, `password`, `address`, `contact`, `email`, `image`, `business_permit`, `control_num`, `role_id`, `branch`, `lat`, `lang`, `isValid`) VALUES
(1, 'palawan bankal', 0, 'palawan bankal', '123', '', '12345678901', 'palawan_bankal@gmail.com', '1581284904palawan.jpg', '15812849041581278095profilepic.jpg', '123', 2, '', '', '', 2),
(2, 'admin', 0, 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', '', NULL, NULL, 1, '', '', '', 0),
(3, 'lloyd', 0, 'lloyd', '13', '', '13', 'lloyd@gmail.com', 'profilep', '1581282873cartoon-blackboard-download-png-favpng-BKy1p0b5DWWrYDLxNpLPyUW6q.jpg', NULL, 3, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_itempost`
--

CREATE TABLE `tbl_user_itempost` (
  `item_id` int(50) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_description` text NOT NULL,
  `item_photo` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `pawnshop_id` int(11) DEFAULT NULL,
  `initial_amount` double(10,2) NOT NULL,
  `isExpired` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_itempost`
--

INSERT INTO `tbl_user_itempost` (`item_id`, `item_name`, `item_description`, `item_photo`, `category_id`, `user_id`, `date`, `status`, `pawnshop_id`, `initial_amount`, `isExpired`) VALUES
(1, 'washing', 'asdasdasd', 'washing_machine.jpg', 2, 3, '2020-02-09 21:45:35', 0, NULL, 0.00, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `gender_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_item_photo`
--
ALTER TABLE `tbl_item_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pawnshop_info`
--
ALTER TABLE `tbl_pawnshop_info`
  MODIFY `p_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pawnshop_package`
--
ALTER TABLE `tbl_pawnshop_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_itempost`
--
ALTER TABLE `tbl_user_itempost`
  MODIFY `item_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
