-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2017 at 04:21 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `price` decimal(2,0) DEFAULT NULL,
  `drivers_driving_license_no` varchar(45) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `plate_no` int(11) NOT NULL,
  `model` varchar(45) NOT NULL,
  `manufacture_year` int(4) NOT NULL,
  `capacity` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`plate_no`, `model`, `manufacture_year`, `capacity`) VALUES
(1234, 'testing car', 2001, 4),
(3333, 'BMW2345', 2000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driving_license_no` varchar(45) NOT NULL,
  `driving_license_valid_till` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `User_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driving_license_no`, `driving_license_valid_till`, `status`, `remarks`, `User_userID`) VALUES
('SG2345', '2018-04-30', 'pending', NULL, 1),
('xs123456', '2020-10-31', 'Active', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver_cars`
--

CREATE TABLE `driver_cars` (
  `driver_driving_license_no` varchar(45) NOT NULL,
  `car_plate_no` int(11) NOT NULL,
  `register_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_cars`
--

INSERT INTO `driver_cars` (`driver_driving_license_no`, `car_plate_no`, `register_date`) VALUES
('SG2345', 3333, '2017-10-29 20:28:38'),
('xs123456', 1234, '2017-10-01 00:00:00');

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
  `seats` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_start_datetime` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `driver_car_driver_driving_license_no` varchar(45) NOT NULL,
  `driver_car_car_plate_no` int(11) NOT NULL,
  `pick_up_point` varchar(50) NOT NULL,
  `destination_point` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `seats`, `created_date`, `route_start_datetime`, `comment`, `driver_car_driver_driving_license_no`, `driver_car_car_plate_no`, `pick_up_point`, `destination_point`) VALUES
(5, 3, '2017-10-29 16:16:06', '0000-00-00 00:00:00', 'testing', 'xs123456', 1234, 'Ang Mo Kio Singapore', 'Bukit Timah Road Singapore'),
(6, 3, '2017-10-29 16:43:55', '0000-00-00 00:00:00', 'testing', 'xs123456', 1234, 'Ang Mo Kio Avenue 8 Singapore', 'Bukit Timah Road Singapore'),
(7, 3, '2017-10-29 16:45:17', '0000-00-00 00:00:00', 'testing', 'xs123456', 1234, 'Ang Mo Kio Avenue 8 Singapore', 'Bukit Timah Road Singapore'),
(8, 3, '2017-10-29 16:46:43', '0000-00-00 00:00:00', 'testing', 'xs123456', 1234, 'Ang Mo Kio Avenue 8 Singapore', 'Bukit Timah Road Singapore'),
(9, 3, '2017-10-29 16:49:02', '0000-00-00 00:00:00', 'testing', 'xs123456', 1234, 'Bukit Timah Road Singapore', 'Ang Mo Kio Singapore'),
(10, 3, '2017-10-29 19:28:03', '2017-10-31 00:00:00', 'testing', 'xs123456', 1234, 'Ang Mo Kio Avenue 8 Singapore', 'Boon Lay Place Singapore'),
(11, 3, '2017-10-29 22:01:57', '2017-11-03 00:00:00', 'testing', 'xs123456', 1234, 'Alexandra Road Singapore', 'Edgefield Plains Singapore'),
(12, 3, '2017-10-29 22:03:44', '2017-11-04 09:05:00', 'testing', 'xs123456', 1234, '200 Boon Lay Way Singapore', 'Orchard Turn Singapore'),
(13, 3, '2017-10-29 23:18:53', '2017-10-29 00:00:00', 'testing', 'xs123456', 1234, 'Victoria Street Singapore', 'Boon Keng Road Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNO` int(8) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `gender`, `email`, `contactNO`, `password`) VALUES
(1, 'Yuting', 'Wang', 'F', 'cloris910415@gmail.com', 98552377, '20eabe5d64b0e216796e834f52d61fd0b70332fc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking_User1_idx` (`passenger_id`),
  ADD KEY `fk_booking_route1_idx` (`route_id`),
  ADD KEY `fk_bookings_drivers1_idx` (`drivers_driving_license_no`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`plate_no`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driving_license_no`),
  ADD KEY `fk_driver_User_idx` (`User_userID`);

--
-- Indexes for table `driver_cars`
--
ALTER TABLE `driver_cars`
  ADD PRIMARY KEY (`driver_driving_license_no`,`car_plate_no`),
  ADD KEY `fk_driver_has_car_car1_idx` (`car_plate_no`),
  ADD KEY `fk_driver_has_car_driver1_idx` (`driver_driving_license_no`);

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
  ADD PRIMARY KEY (`route_id`,`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`),
  ADD KEY `fk_route_driver_car1_idx` (`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`);

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `preference_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_User1` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_route1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bookings_drivers1` FOREIGN KEY (`drivers_driving_license_no`) REFERENCES `drivers` (`driving_license_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `fk_driver_User` FOREIGN KEY (`User_userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `driver_cars`
--
ALTER TABLE `driver_cars`
  ADD CONSTRAINT `fk_driver_has_car_car1` FOREIGN KEY (`car_plate_no`) REFERENCES `cars` (`plate_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_driver_has_car_driver1` FOREIGN KEY (`driver_driving_license_no`) REFERENCES `drivers` (`driving_license_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `fk_Preference_User1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `fk_route_driver_car1` FOREIGN KEY (`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`) REFERENCES `driver_cars` (`driver_driving_license_no`, `car_plate_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
