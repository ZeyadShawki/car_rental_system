-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 09:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminId` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `user_password` varchar(50) NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `bdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminId`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `user_password`, `sex`, `bdate`) VALUES
(1, 'Sophia', 'Smith', 'sophia.smith@example.com', '555-111-2222', 'admin123', 'female', '1991-08-12'),
(2, 'Benjamin', 'Turner', 'benjamin.turner@example.com', '555-333-4444', 'admin456', 'male', '1986-02-25'),
(3, 'Isabella', 'Clark', 'isabella.clark@example.com', '555-555-5555', 'admin789', 'female', '1994-11-05'),
(4, 'Elijah', 'Brown', 'elijah.brown@example.com', '555-777-8888', 'adminxyz', 'male', '1981-07-20'),
(5, 'Ava', 'Anderson', 'ava.anderson@example.com', '555-999-0000', 'admin123', 'female', '1995-03-22'),
(6, 'Jackson', 'Roberts', 'jackson.roberts@example.com', '555-444-6666', 'admin456', 'male', '1988-12-15'),
(7, 'Mia', 'Davis', 'mia.davis@example.com', '555-666-2222', 'adminxyz', 'female', '1993-06-18'),
(8, 'Lucas', 'Miller', 'lucas.miller@example.com', '555-123-7890', 'admin123', 'male', '1984-09-30'),
(9, 'Chloe', 'Johnson', 'chloe.johnson@example.com', '555-888-9999', 'admin456', 'female', '1992-04-05'),
(10, 'Henry', 'Williams', 'henry.williams@example.com', '555-222-3333', 'admin789', 'male', '1987-01-10'),
(11, 'Olivia', 'Davis', 'olivia.davis@example.com', '555-222-3333', 'adminxyz', 'female', '1980-07-10'),
(12, 'Alex', 'Brown', 'alex.brown@example.com', '555-777-8888', 'admin789', 'male', '1992-03-22'),
(13, 'Emma', 'Anderson', 'emma.anderson@example.com', '555-999-0000', 'adminxyz', 'female', '1983-09-15'),
(14, 'Nathan', 'Clark', 'nathan.clark@example.com', '555-444-6666', 'admin123', 'male', '1990-04-30'),
(15, 'Grace', 'Roberts', 'grace.roberts@example.com', '555-666-2222', 'admin456', 'female', '1987-12-05'),
(16, 'Liam', 'Turner', 'liam.turner@example.com', '555-123-7890', 'adminxyz', 'male', '1982-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `plateID` int(11) NOT NULL,
  `OfficeID` int(11) NOT NULL,
  `carname` varchar(50) NOT NULL,
  `Year` int(11) NOT NULL,
  `imageUrl` varchar(300) NOT NULL,
  `rentvalue` double(10,2) NOT NULL,
  `carStatus` enum('active','out of service','rented') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`plateID`, `OfficeID`, `carname`, `Year`, `imageUrl`, `rentvalue`, `carStatus`) VALUES
(1, 2, 'Convertible', 2020, 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg', 80.00, 'active'),
(2, 1, 'Compact', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/2.jpg', 60.00, 'out of service'),
(3, 1, 'Sedan', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/3.jpg', 50.00, 'active'),
(4, 2, 'SUV', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/4.jpg', 70.00, 'active'),
(5, 1, 'Compact', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/5.jpg', 60.00, 'out of service'),
(6, 2, 'Hatchback', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/6.jpg', 55.00, 'active'),
(7, 1, 'Coupe', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/7.jpg', 65.00, 'active'),
(8, 2, 'Truck', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/8.jpg', 75.00, 'active'),
(9, 1, 'Minivan', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/9.jpg', 60.00, 'active'),
(10, 2, 'Luxury', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/10.jpg', 90.00, 'active'),
(11, 1, 'Electric', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/11.jpg', 80.00, 'active'),
(12, 2, 'Crossover', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg', 70.00, 'active'),
(13, 1, 'Sedan', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg', 50.00, 'active'),
(14, 2, 'SUV', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/2.jpg', 70.00, 'active'),
(15, 3, 'Compact', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/3.jpg', 60.00, 'out of service'),
(16, 4, 'Hatchback', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/4.jpg', 55.00, 'active'),
(17, 5, 'Coupe', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/5.jpg', 65.00, 'active'),
(18, 6, 'Truck', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/6.jpg', 75.00, 'active'),
(19, 7, 'Minivan', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/7.jpg', 60.00, 'active'),
(20, 8, 'Luxury', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/8.jpg', 90.00, 'active'),
(21, 9, 'Electric', 2022, 'http://localhost/final_db_admin/backend/uploaded_images/9.jpg', 80.00, 'active'),
(22, 10, 'Crossover', 2021, 'http://localhost/final_db_admin/backend/uploaded_images/10.jpg', 70.00, 'active'),
(23, 11, 'Convertible', 2020, 'http://localhost/final_db_admin/backend/uploaded_images/11.jpg', 80.00, 'active'),
(24, 12, 'Sports Car', 2023, 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg', 95.00, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `carname` varchar(225) NOT NULL,
  `brand` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`carname`, `brand`) VALUES
('asdas', 'sadas'),
('Compact', 'Honda'),
('Convertible', 'Chevrolet'),
('Coupe', 'BMW'),
('Crossover', 'Nissan'),
('Electric', 'Tesla'),
('Hatchback', 'Volkswagen'),
('Luxury', 'Mercedes-Benz'),
('Minivan', 'Honda'),
('Sedan', 'Toyota'),
('Sports Car', 'Porsche'),
('SUV', 'Ford'),
('Truck', 'Chevrolet');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `user_password` varchar(50) NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `amount` double(10,2) DEFAULT 0.00,
  `imageLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `user_password`, `sex`, `bdate`, `amount`, `imageLink`) VALUES
(1, 'Daniel', 'Miller', 'yelraggal@gmail.com', '12345678997', '12345678', 'male', '1988-02-12', 2000.00, 'http://localhost/final_db_admin/backend/uploaded_images/yosf.jpg'),
(2, 'Olivia', 'Davis', 'olivia.davis@example.com', '555-777-8888', 'customerxyz', 'female', '1993-09-25', 1200.00, NULL),
(3, 'Alex', 'Brown', 'alex.brown@example.com', '555-999-0000', 'customer123', 'male', '1992-08-08', 1800.00, NULL),
(4, 'Emma', 'Anderson', 'emma.anderson@example.com', '555-222-3333', 'customer456', 'female', '1987-04-30', 1300.00, NULL),
(5, 'Nathan', 'Clark', 'nathan.clark@example.com', '555-444-6666', 'customer789', 'male', '1985-12-15', 1600.00, NULL),
(6, 'Grace', 'Roberts', 'grace.roberts@example.com', '555-666-2222', 'customerxyz', 'female', '1990-03-22', 1400.00, NULL),
(7, 'Liam', 'Turner', 'liam.turner@example.com', '555-123-7890', 'customer123', 'male', '1982-11-10', 1100.00, NULL),
(8, 'Ella', 'Johnson', 'ella.johnson@example.com', '555-111-2222', 'customer123', 'female', '1991-08-12', 1300.00, NULL),
(9, 'Oliver', 'Smith', 'oliver.smith@example.com', '555-333-4444', 'customer456', 'male', '1986-02-25', 900.00, NULL),
(10, 'Ava', 'Taylor', 'ava.taylor@example.com', '555-555-5555', 'customer789', 'female', '1994-11-05', 1800.00, NULL),
(11, 'Noah', 'Turner', 'noah.turner@example.com', '555-777-8888', 'customerxyz', 'male', '1981-07-20', 1100.00, NULL),
(12, 'Mia', 'Williams', 'mia.williams@example.com', '555-999-0000', 'customer123', 'female', '1995-03-22', 2000.00, NULL),
(13, 'Liam', 'Roberts', 'liam.roberts@example.com', '555-444-6666', 'customer456', 'male', '1988-12-15', 1400.00, NULL),
(14, 'Emma', 'Davis', 'emma.davis@example.com', '555-666-2222', 'customerxyz', 'female', '1993-06-18', 1600.00, NULL),
(15, 'Lucas', 'Brown', 'lucas.brown@example.com', '555-123-7890', 'customer123', 'male', '1984-09-30', 1200.00, NULL),
(16, 'Isabella', 'Clark', 'isabella.clark@example.com', '555-888-9999', 'customer456', 'female', '1992-04-05', 1700.00, NULL),
(17, 'Jackson', 'Miller', 'jackson.miller@example.com', '555-222-3333', 'customer789', 'male', '1987-01-10', 1500.00, NULL),
(18, 'Sophie', 'Turner', 'sophie.turner@example.com', '555-666-7777', 'customerxyz', 'female', '1989-11-10', 1900.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `OfficeID` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`OfficeID`, `country`, `city`) VALUES
(1, 'Canada', 'Toronto'),
(2, 'Germany', 'Berlin'),
(3, 'United States', 'New York'),
(4, 'France', 'Paris'),
(5, 'United Kingdom', 'London'),
(6, 'Australia', 'Sydney'),
(7, 'Japan', 'Tokyo'),
(8, 'Brazil', 'Rio de Janeiro'),
(9, 'South Africa', 'Cape Town'),
(10, 'India', 'Mumbai'),
(11, 'China', 'Beijing'),
(12, 'Russia', 'Moscow');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `PaymentDate`, `Amount`) VALUES
(1, '2023-03-10', '120.00'),
(2, '2023-03-15', '80.00'),
(3, '2023-03-20', '150.00'),
(4, '2023-03-25', '95.00'),
(5, '2023-03-30', '110.00'),
(6, '2023-04-05', '130.00'),
(7, '2023-04-10', '75.00'),
(8, '2023-04-15', '105.00'),
(9, '2023-04-20', '140.00'),
(10, '2023-04-25', '90.00'),
(11, '2023-05-01', '100.00'),
(12, '2023-05-05', '120.00'),
(13, '2023-05-10', '85.00'),
(14, '2023-05-15', '130.00'),
(15, '2023-05-20', '110.00'),
(16, '2023-05-25', '95.00'),
(17, '2023-05-30', '150.00'),
(18, '2023-06-05', '120.00'),
(19, '2023-06-10', '80.00'),
(20, '2023-06-15', '135.00'),
(21, '2023-12-31', '3440.00'),
(22, '2023-12-31', '160.00'),
(23, '2023-12-31', '80.00'),
(24, '2023-12-31', '240.00'),
(25, '2023-12-31', '4000.00');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationID` int(11) NOT NULL,
  `plateID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `ReservationDate` date NOT NULL,
  `PickupDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservationID`, `plateID`, `CustomerID`, `PaymentID`, `ReservationDate`, `PickupDate`, `ReturnDate`) VALUES
(1, 3, 16, 3, '2023-03-10', '2023-03-15', '2023-03-20'),
(2, 4, 17, 4, '2023-03-12', '2023-03-18', '2023-03-25'),
(3, 5, 18, 5, '2023-04-01', '2023-04-05', '2023-04-10'),
(4, 6, 9, 6, '2023-04-03', '2023-04-08', '2023-04-15'),
(5, 7, 10, 7, '2023-04-05', '2023-04-10', '2023-04-17'),
(6, 8, 7, 8, '2023-04-08', '2023-04-13', '2023-04-20'),
(7, 9, 8, 9, '2023-04-10', '2023-04-15', '2023-04-22'),
(8, 10, 3, 10, '2023-04-12', '2023-04-17', '2023-04-24'),
(9, 11, 4, 11, '2023-04-15', '2023-04-20', '2023-04-27'),
(10, 12, 5, 12, '2023-04-18', '2023-04-23', '2023-04-30'),
(11, 13, 2, 13, '2023-04-20', '2023-04-25', '2023-05-02'),
(12, 14, 1, 14, '2023-04-23', '2023-04-28', '2023-05-05'),
(13, 11, 1, 21, '2023-12-31', '2024-01-17', '2024-02-29'),
(14, 11, 1, 22, '2023-12-31', '2024-01-02', '2024-01-04'),
(15, 11, 1, 23, '2023-12-31', '2024-01-05', '2024-01-06'),
(16, 11, 1, 24, '2023-12-31', '2024-03-04', '2024-03-07'),
(17, 11, 1, 25, '2023-12-31', '2024-04-03', '2024-05-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminId`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`plateID`),
  ADD KEY `OfficeID` (`OfficeID`),
  ADD KEY `carname` (`carname`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`carname`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`OfficeID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `plateID` (`plateID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `plateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `OfficeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`OfficeID`) REFERENCES `offices` (`OfficeID`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`carname`) REFERENCES `category` (`carname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`plateID`) REFERENCES `cars` (`plateID`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `payments` (`PaymentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
