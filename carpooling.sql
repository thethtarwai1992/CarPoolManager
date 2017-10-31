-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 12:34 AM
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
  `manufacture_year` varchar(45) NOT NULL,
  `capacity` int(1) NOT NULL,
  `driver_register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `driving_license_no` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`plate_no`, `model`, `manufacture_year`, `capacity`, `driver_register_date`, `driving_license_no`) VALUES
(123456, 'BMW451', '2000', 4, NULL, 'SG458167');

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
('SG458167', '2018-07-07', 'Pending', NULL, 4);

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
  `route_datetime` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `pick_up_point` varchar(100) NOT NULL,
  `destination_point` varchar(100) NOT NULL,
  `drivers_driving_license_no` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `seats`, `created_date`, `route_datetime`, `comment`, `pick_up_point`, `destination_point`, `drivers_driving_license_no`) VALUES
(1, 3, '2017-10-31 07:05:05', '2017-11-03 00:00:00', 'testing', 'Tampines Street 81 Singapore', 'Boon Lay Drive Singapore', 'SG458167');

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
(1, 'Thet', NULL, 'F', 'thethw001@mymail.sim.edu.sg', 11111111, 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8'),
(2, 'Yuting', 'Wang', 'F', 'ywang084@mymail.sim.edu.sg', 22222222, 'f638e2789006da9bb337fd5689e37a265a70f359'),
(3, 'Min Thu', NULL, 'F', 'yinmt001@mymail.sim.edu.sg', 33333333, '14993032bd035408dd9ab6f6e6ad0b023eced296'),
(4, 'WANG YUTING', NULL, 'F', 'cloris910415@gmail.com', 98989898, '$2y$10$KvdY9j/wvQ4DHftSMbZF8er4NGHaiGMmL8Pt2LZK620bhfkD5Y7Da');

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
  ADD PRIMARY KEY (`plate_no`),
  ADD KEY `fk_cars_drivers_idx` (`driving_license_no`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driving_license_no`),
  ADD KEY `fk_driver_User_idx` (`User_userID`);

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
  ADD PRIMARY KEY (`route_id`,`drivers_driving_license_no`),
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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
