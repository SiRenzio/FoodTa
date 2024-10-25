-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 10:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodtadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ar_payment`
--

CREATE TABLE `ar_payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card_payment`
--

CREATE TABLE `card_payment` (
  `payment_id` int(11) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `expiry` date NOT NULL,
  `security_code` int(11) NOT NULL,
  `bank_name` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `full_name` varchar(75) NOT NULL,
  `address` varchar(75) NOT NULL,
  `contact_no` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryPerson_id` int(11) NOT NULL,
  `full_name` varchar(75) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `vehicle_plate` varchar(6) NOT NULL,
  `vehicle_name` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryPerson_id`, `full_name`, `contact_no`, `vehicle_plate`, `vehicle_name`, `status`) VALUES
(1, 'Jom Christian Novy Salinas', '09123123123', '123FKX', 'Honda N-Max', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `store_id`, `item_name`, `quantity`, `price`, `category`) VALUES
(1, 1, 'Jolly MocDog', 100, 75, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `online_payments`
--

CREATE TABLE `online_payments` (
  `payment_id` int(11) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `detail_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_summary`
--

CREATE TABLE `sales_summary` (
  `sales_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `deliveryPerson_id` int(11) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gross` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `gcash` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  `card` int(11) NOT NULL,
  `accounts_receivable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(25) NOT NULL,
  `store_address` varchar(75) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `opening_hr` time NOT NULL,
  `closing_hr` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_address`, `contact_no`, `opening_hr`, `closing_hr`) VALUES
(1, 'McDollibee', '#47, 4th Street, Jomsorito Subdivision, Mandurriao, Iloilo City', '09696942096', '00:00:00', '23:59:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ar_payment`
--
ALTER TABLE `ar_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `ref_no` (`ref_no`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryPerson_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `online_payments`
--
ALTER TABLE `online_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `ref_no` (`ref_no`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `sales_summary`
--
ALTER TABLE `sales_summary`
  ADD PRIMARY KEY (`sales_id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ar_payment`
--
ALTER TABLE `ar_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_payment`
--
ALTER TABLE `card_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryPerson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_payments`
--
ALTER TABLE `online_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_summary`
--
ALTER TABLE `sales_summary`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ar_payment`
--
ALTER TABLE `ar_payment`
  ADD CONSTRAINT `ar_payment_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales_summary` (`sales_id`);

--
-- Constraints for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD CONSTRAINT `sales_id_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales_summary` (`sales_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `online_payments`
--
ALTER TABLE `online_payments`
  ADD CONSTRAINT `online_payments_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales_summary` (`sales_id`);

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `sales_summary` (`sales_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
