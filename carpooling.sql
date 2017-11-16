-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 06:47 PM
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
-- Database: `carpooling`
--

DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `cars`;
DROP TABLE IF EXISTS `drivers`;
DROP TABLE IF EXISTS `preferences`;
DROP TABLE IF EXISTS `routes`;
DROP TABLE IF EXISTS `users`;

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
  `price` decimal(2,0) DEFAULT NULL,
  `passenger_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `cancel_by` int(8) DEFAULT NULL,
  `cancel_type` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `request_time`, `seats`, `start`, `end`, `status`, `price`, `passenger_id`, `driver_id`, `route_id`, `cancel_by`, `cancel_type`, `created_at`, `updated_at`) VALUES
(1, '2017-11-07 01:20:00', 0, NULL, NULL, 'Canceled', '20', 1, 4, 1, NULL, NULL, '2017-11-13 23:50:30', '2017-11-15 17:46:06'),
(2, '2017-11-14 03:10:00', 1, NULL, NULL, 'Scheduled', '9', 6, 4, 2, NULL, NULL, '2017-11-13 23:50:30', '2017-11-15 17:38:09'),
(4, '2017-11-12 12:59:52', 1, NULL, NULL, 'Scheduled', NULL, 6, 4, 5, NULL, NULL, '2017-11-13 23:50:30', '2017-11-15 17:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `cancellations`
--

CREATE TABLE `cancellations` (
  `cancel_id` int(10) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `support_doc` varchar(255) DEFAULT NULL,
  `booking_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancellations`
--

INSERT INTO `cancellations` (`cancel_id`, `reason`, `remarks`, `support_doc`, `booking_id`) VALUES
(5, 'Unable to fulfill ride due to unexpected reasons(accident,sick)', NULL, NULL, 1);

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
  `price` decimal(2,0) DEFAULT '0',
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
(2, 'Scheduled', 3, '2017-11-14 03:10:00', NULL, 'Opp Bugis Junction Singapore', 'Tampines Central 1 Singapore', 'sg78915', 4, 'Driver', '2017-11-11 07:17:05', '2017-11-15 17:38:09'),
(5, 'Scheduled', 0, '2017-11-16 21:00:00', NULL, 'Lakeside Drive Singapore', 'Clementi Avenue 3 Singapore', 'sg78915', 4, 'Driver', '2017-11-11 08:08:09', '2017-11-15 17:41:15'),
(6, 'Open', 1, '2017-11-17 07:30:00', NULL, 'Bukit Merah Central Singapore', 'Queensway Shopping Centre Singapore', 'sg78915', 4, 'Driver', '2017-11-15 15:24:50', '2017-11-15 07:24:50');

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
(4, 'WANG YUTING', NULL, 'F', 'cloris910415@gmail.com', 98989898, '$2y$10$KvdY9j/wvQ4DHftSMbZF8er4NGHaiGMmL8Pt2LZK620bhfkD5Y7Da', 0, 'pLzqDSoUWyNYdkQoooLs4xCw0MjE0F48MrfhQQhF8h6baPjYf7z5IhWae6wW', '2017-10-22 08:06:46', '2017-10-22 00:06:46'),
(6, 'Yuting', 'Wang', 'Female', 'june1991@qq.com', 98552377, '$2y$10$k9sSN3Jdgz1hSpNJa5rzOOClB6P1YnQ565ZuNx8rjOB8H1ruW6paq', 0, 'uLamdHxE25YwTDy1eyGcfqSg3BbUr8Ee7e6CG7XC8D6oBTsYowp4FS3plJrw', '2017-11-12 12:39:44', '2017-11-12 04:39:44');

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cancellations`
--
ALTER TABLE `cancellations`
  MODIFY `cancel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_User1` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION, 
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
