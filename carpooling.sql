-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2017 at 01:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpoolingmanager`
--
 
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `cars`;
DROP TABLE IF EXISTS `drivers`;
DROP TABLE IF EXISTS `preferences`;
DROP TABLE IF EXISTS `routes`;
DROP TABLE IF EXISTS `users`; 
DROP TABLE IF EXISTS `cancellations`;
  
-- --------------------------------------------------------
 
--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `seats` int(1) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `price` decimal(4,2) DEFAULT NULL,
  `passenger_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `request_time`, `seats`, `start`, `end`, `status`, `price`, `passenger_id`, `driver_id`, `route_id`, `created_at`, `updated_at`) VALUES
(1, '2017-11-07 01:20:00', 0, NULL, NULL, 'Canceled', '20', 1, 4, 1, '2017-11-13 23:50:30', '2017-11-15 17:46:06'),
(2, '2017-11-14 03:10:00', 1, NULL, NULL, 'Canceled', '9', 6, 4, 2, '2017-11-13 23:50:30', '2017-11-18 16:27:06'),
(4, '2017-11-12 12:59:52', 1, NULL, NULL, 'Canceled', NULL, 6, 4, 5, '2017-11-13 23:50:30', '2017-11-19 06:13:10'),
(5, '2017-11-18 16:18:57', 1, NULL, NULL, 'Booked', NULL, 6, 4, 6, '2017-11-18 16:18:57', '2017-11-18 08:18:57'),
(6, '2017-11-19 03:35:40', 1, NULL, NULL, 'Scheduled', NULL, 6, 4, 7, '2017-11-19 03:35:40', '2017-11-18 19:35:40'),
(9, '2017-11-19 20:00:00', 1, NULL, NULL, 'Scheduled', '10', 1, 4, 9, '2017-11-19 19:08:33', '2017-11-19 04:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `cancellations`
--

CREATE TABLE `cancellations` (
  `cancel_id` int(10) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `support_doc` varchar(255) DEFAULT NULL,
  `booking_id` int(10) NOT NULL,
  `cancel_by` int(8) NOT NULL,
  `cancel_type` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancellations`
--

INSERT INTO `cancellations` (`cancel_id`, `reason`, `remarks`, `support_doc`, `booking_id`, `cancel_by`, `cancel_type`, `created_at`, `updated_at`) VALUES
(5, 'Unable to fulfill ride due to unexpected reasons(accident,sick)', NULL, NULL, 1, 0, '', '2017-11-19 00:23:24', '2017-11-18 16:23:24'),
(6, 'Unable to fulfill ride due to unexpected reasons(accident,sick)', NULL, NULL, 2, 4, 'Driver', '2017-11-19 00:30:57', '2017-11-18 16:30:57'),
(7, 'Others', NULL, 'supportDoc/UX2db1uwhNDEZhhfMhrHsy9PUI72Zt4E5cmfl2h6.jpeg', 4, 4, 'Driver', '2017-11-19 14:13:10', '2017-11-19 06:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `plate_no` int(11) NOT NULL,
  `model` varchar(45) NOT NULL,
  `manufacture_year` varchar(45) NOT NULL,
  `capacity` int(1) NOT NULL,
  `driver_register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `driving_license_no` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`plate_no`, `model`, `manufacture_year`, `capacity`, `driver_register_date`, `driving_license_no`) VALUES
(123456, 'bmw451', '2005', 4, '2017-11-05 18:20:48', 'sg78915');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driving_license_no` varchar(45) NOT NULL,
  `driving_license_valid_till` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `remarks` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driving_license_no`, `driving_license_valid_till`, `status`, `remarks`, `userID`) VALUES
('sg78915', '2018-08-25', 'Active', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preference_id` int(8) NOT NULL,
  `userID` int(11) NOT NULL,
  `total_pax` int(11) DEFAULT NULL,
  `tripdate` date DEFAULT NULL,
  `triptime` datetime DEFAULT NULL,
  `note` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Open',
  `available_seats` int(1) NOT NULL,
  `route_datetime` datetime DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `pickup` varchar(100) NOT NULL, 
  `destination` varchar(100) NOT NULL, 
  `drivers_driving_license_no` varchar(45) DEFAULT NULL,
  `posted_by` int(11) NOT NULL,
  `posted_type` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `status`, `available_seats`, `route_datetime`, `comment`, `pickup`, `destination`, `drivers_driving_license_no`, `posted_by`, `posted_type`, `created_at`, `updated_at`) VALUES
(1, 'Closed', 3, '2017-11-07 01:20:00', 'no smoking', 'Clementi Avenue 3 Singapore', 'Lakeside Drive Singapore', 'sg78915', 4, 'Driver', '2017-11-05 08:36:23', '2017-11-15 17:46:06'),
(2, 'Closed', 3, '2017-11-14 03:10:00', NULL, 'Opp Bugis Junction Singapore', 'Tampines Central 1 Singapore', 'sg78915', 4, 'Driver', '2017-11-11 07:17:05', '2017-11-18 16:27:06'),
(5, 'Closed', 0, '2017-11-16 21:00:00', NULL, 'Lakeside Drive Singapore', 'Clementi Avenue 3 Singapore', 'sg78915', 4, 'Driver', '2017-11-11 08:08:09', '2017-11-19 06:13:10'),
(6, 'Closed', 0, '2017-11-17 07:30:00', NULL, 'Bukit Merah Central Singapore', 'Queensway Shopping Centre Singapore', 'sg78915', 4, 'Driver', '2017-11-15 15:24:50', '2017-11-18 08:18:57'),
(7, 'Open', 1, '2017-11-21 04:30:00', NULL, 'Tuas Crescent Singapore', 'Bedok Reservoir Road Singapore', 'sg78915', 4, 'Driver', '2017-11-19 03:34:36', '2017-11-18 19:35:40'),
(8, 'Open', 1, '2017-11-19 14:30:00', NULL, 'Boon Lay Way Singapore', 'Bukit Timah Road Singapore', 'sg78915', 4, 'Driver', '2017-11-19 03:35:02', '2017-11-18 19:35:02'),
(9, 'Scheduled', 1, '2017-11-19 20:00:00', NULL, 'Boon Lay Driver', 'Tampines Cnetral', 'sg78915', 1, 'Passenger', '2017-11-19 19:06:32', '2017-11-19 04:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contactNO` int(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_driver` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(100) NOT NULL DEFAULt 'avatar.jpg',
  `remember_token` text,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `gender`, `email`, `contactNO`, `password`, `is_driver`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thet', NULL, 'F', 'thethw001@mymail.sim.edu.sg', 11111111, '$2y$10$Gnk1GGQ/rmaOqVYEQCJb1u299A2KLNk4mZsgnh1ZIgbn/enmQfn1y', 0, NULL, '2017-10-22 08:06:46', '2017-10-22 00:06:46'),
(2, 'Yuting', 'Wang', 'F', 'ywang084@mymail.sim.edu.sg', 22222222, '$2y$10$Gnk1GGQ/rmaOqVYEQCJb1u299A2KLNk4mZsgnh1ZIgbn/enmQfn1y', 0, NULL, '2017-10-22 08:06:46', '2017-10-22 00:06:46'),
(3, 'Min Thu', NULL, 'F', 'yinmt001@mymail.sim.edu.sg', 33333333, '$2y$10$Gnk1GGQ/rmaOqVYEQCJb1u299A2KLNk4mZsgnh1ZIgbn/enmQfn1y', 0, NULL, '2017-10-22 08:06:46', '2017-10-22 00:06:46'),
(4, 'WANG YUTING', NULL, 'F', 'cloris910415@gmail.com', 98989898, '$2y$10$KvdY9j/wvQ4DHftSMbZF8er4NGHaiGMmL8Pt2LZK620bhfkD5Y7Da', 0, 'YPr4whFHz9F8G4KyYCeLtWiC2i6C9eRCWycl98S3MIenjpoiUnbCj5B7SODt', '2017-10-22 08:06:46', '2017-10-22 00:06:46'),
(6, 'Yuting', 'Wang', 'Female', 'june1991@qq.com', 98552377, '$2y$10$k9sSN3Jdgz1hSpNJa5rzOOClB6P1YnQ565ZuNx8rjOB8H1ruW6paq', 1, '44GGQEGigKrae8IONGu4VO4dy43fhusDCoiyloJdS6R3ecCEHFVKz5gF7C63', '2017-11-12 12:39:44', '2017-11-12 04:39:44'),
(7, 'TESTER', NULL, 'Female', 'test@hotmail.com', 98552377, '$2y$10$v.lJJVIaROTApS8p1AxuUOwnbejW.oa69v3u5cUHzcd7upZX0Ji8O', 0, 'mqODVtfI826tIwA3y66k7OvOBAn8G3xtsfPj5vy35Fo4suf4YpigJ9pf541V', '2017-11-16 14:25:35', '2017-11-16 06:25:35'),
(8, 'test', 'Wang', 'F', 'ywang@mymail.sim.edu.sg', 98989898, '$2y$10$4MaYlOr5N34mlGswhO7JDe70StxADP6RXdXsfibFTnxcinwXRd2Dq', 0, 'EwFOyZWOdbFAGJy2HlBZVmaHSIX7maUxFg2pUKcdVZzVv0dYIH56GfIV2VvV', '2017-11-16 15:03:48', '2017-11-16 07:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking_User1_idx` (`passenger_id`),
  ADD KEY `fk_booking_User2_idx` (`driver_id`),
  ADD KEY `fk_booking_route1_idx` (`route_id`);

--
-- Indexes for table `cancellations`
--
ALTER TABLE `cancellations`
  ADD PRIMARY KEY (`cancel_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`plate_no`),
  ADD KEY `fk_cars_drivers_idx` (`driving_license_no`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driving_license_no`),
  ADD KEY `fk_driver_User_idx` (`userID`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`),
  ADD UNIQUE KEY `preference_id_UNIQUE` (`preference_id`),
  ADD KEY `fk_Preference_User1_idx` (`userID`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `fk_route_driver_car1_idx` (`drivers_driving_license_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID_UNIQUE` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cancellations`
--
ALTER TABLE `cancellations`
  MODIFY `cancel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_User1` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_User2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_route1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `fk_driver_User` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `fk_Preference_User1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `fk_route_driver_car1` FOREIGN KEY (`drivers_driving_license_no`) REFERENCES `drivers` (`driving_license_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
