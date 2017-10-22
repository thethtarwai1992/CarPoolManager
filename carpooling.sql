-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2017 at 04:02 PM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `request_time` datetime DEFAULT NULL,
  `passenger_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `price` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `cars` (
  `plate_no` int(11) NOT NULL,
  `model` varchar(45) DEFAULT NULL,
  `manufacture_year` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `drivers` (
  `driving_license_no` varchar(45) NOT NULL,
  `driving_license_valid_from` date DEFAULT NULL,
  `User_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver_car`
--

CREATE TABLE `driver_cars` (
  `driver_driving_license_no` varchar(45) NOT NULL,
  `car_plate_no` int(11) NOT NULL,
  `register_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `locations` (
  `address` varchar(100) NOT NULL,
  `postal_code` int(6) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preferences` (
  `userID` int(11) NOT NULL,
  `total_pax` int(11) DEFAULT NULL,
  `tripdate` date DEFAULT NULL,
  `triptime` datetime DEFAULT NULL,
  `note` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `seats_offered` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `route_start_time` datetime NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `start_point` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `driver_car_driver_driving_license_no` varchar(45) NOT NULL,
  `driver_car_car_plate_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_desc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNO` int(8) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`,`passenger_id`,`status_id`,`route_id`),
  ADD KEY `fk_booking_User1_idx` (`passenger_id`),
  ADD KEY `fk_booking_status1_idx` (`status_id`),
  ADD KEY `fk_booking_route1_idx` (`route_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`plate_no`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driving_license_no`),
  ADD KEY `fk_driver_User_idx` (`User_userID`);

--
-- Indexes for table `driver_car`
--
ALTER TABLE `driver_car`
  ADD PRIMARY KEY (`driver_driving_license_no`,`car_plate_no`),
  ADD KEY `fk_driver_has_car_car1_idx` (`car_plate_no`),
  ADD KEY `fk_driver_has_car_driver1_idx` (`driver_driving_license_no`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `postal_code_UNIQUE` (`postal_code`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `fk_Preference_User1_idx` (`userID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`,`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`),
  ADD KEY `fk_route_driver_car1_idx` (`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`),
  ADD KEY `fk_route_Location1_idx` (`start_point`),
  ADD KEY `fk_route_Location2_idx` (`destination`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_User1` FOREIGN KEY (`passenger_id`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_route1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `fk_driver_User` FOREIGN KEY (`User_userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `driver_car`
--
ALTER TABLE `driver_car`
  ADD CONSTRAINT `fk_driver_has_car_car1` FOREIGN KEY (`car_plate_no`) REFERENCES `car` (`plate_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_driver_has_car_driver1` FOREIGN KEY (`driver_driving_license_no`) REFERENCES `driver` (`driving_license_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `fk_Preference_User1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `fk_route_Location1` FOREIGN KEY (`start_point`) REFERENCES `location` (`postal_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_route_Location2` FOREIGN KEY (`destination`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_route_driver_car1` FOREIGN KEY (`driver_car_driver_driving_license_no`,`driver_car_car_plate_no`) REFERENCES `driver_car` (`driver_driving_license_no`, `car_plate_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
