-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:29 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `store_id`, `item_id`, `quantity`, `timestamp`) VALUES
(5, 1, 0, 1, 0, '2024-11-26 04:07:46'),
(6, 1, 1, 3, 3, '2024-11-29 14:20:40'),
(7, 1, 1, 1, 1, '2024-11-29 14:31:54'),
(8, 1, 1, 4, 1, '2024-11-29 14:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `cod`
--

CREATE TABLE `cod` (
  `payment_id` int(11) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `amount` float NOT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `crew_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `full_name` varchar(75) NOT NULL,
  `customer_address` varchar(75) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `full_name`, `customer_address`, `contact_no`, `username`, `user_password`) VALUES
(1, 'Jan Victor T. Zaldarriaga', '#69, 1st Street, Monggoloid Subdivision, Calumpang, Molo, Iloilo City', '09212223242', 'jantotoextreme', '123asawanimarie'),
(2, 'Clarns Legaspi', 'Earth, Solar System, Milky Way', '9991234567', 'Clarns', 'oogabooga');

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
  `category` varchar(20) NOT NULL,
  `item_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `store_id`, `item_name`, `quantity`, `price`, `category`, `item_img`) VALUES
(1, 1, 'Jolly MocDog', 100, 75, 'Food', ''),
(2, 2, 'Roarsted Dinosaur', 12, 99, 'Food', ''),
(3, 1, 'Jolly McBoger', 17, 85, 'Food', ''),
(4, 1, 'Supaghetti', 10, 99, 'Food', '');

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
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `deliveryPerson_id` int(11) NOT NULL,
  `pickup_Time` time NOT NULL,
  `dropoff_Time` time NOT NULL,
  `date` date NOT NULL,
  `subtotal` float NOT NULL,
  `delivery_fee` float NOT NULL,
  `discount` float NOT NULL,
  `tax` float NOT NULL,
  `net` float NOT NULL
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
  `closing_hr` time NOT NULL,
  `rating` decimal(2,0) NOT NULL,
  `coverphoto` text NOT NULL,
  `store_description` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `store_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_address`, `contact_no`, `opening_hr`, `closing_hr`, `rating`, `coverphoto`, `store_description`, `username`, `store_password`) VALUES
(1, 'McDollibee', '#47, 4th Street, Jomsorito Subdivision, Mandurriao, Iloilo City', '09696942096', '00:00:00', '23:59:59', 5, '', 'McDolibee is a vibrant, family-friendly restaurant that blends the best of American fast-food classics with beloved Filipino flavors. With a lively, welcoming atmosphere and a playful bee mascot, McDolibee has become a go-to spot for people of all ages. Its menu offers a unique twist on fast-food staples, featuring crispy fried chicken, juicy burgers, and spaghetti with a sweet, savory Filipino-style sauce. For breakfast, enjoy a hearty longganisa and garlic rice plate, and don\'t miss the halo-halo dessert, topped with colorful layers of fruit, shaved ice, and ube. Each meal is freshly prepared, balancing quality ingredients with flavors that evoke comfort and nostalgia. McDolibee’s friendly staff, fun ambiance, and playful menu make it a community favorite, perfect for a quick bite, family gatherings, or friends looking to enjoy a fusion of familiar and Filipino-inspired fast-food fare.', '', ''),
(2, 'Tang Inasal', 'Brgy, Di Makita, Hanapin, Nakatago', '09696969696', '08:00:00', '22:00:00', 4, '', 'Manok Na Pinatindig ', 'mitnamit', 'hmmmm'),
(4, 'aa', 'a', '00:00:00', '00:00:00', '00:00:05', 5, '', 'a', 'aaa', 'a'),
(6, 'Tub ol\'s Tavern', 't', '11:00:00', '20:00:00', '00:00:05', 5, 'uploads/025.png', 't', 'tt', 't');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `ref_no` (`ref_no`),
  ADD UNIQUE KEY `ref_no_2` (`ref_no`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`customer_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `cod`
--
ALTER TABLE `cod`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`crew_id`),
  ADD KEY `store_id` (`store_id`);

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
  ADD UNIQUE KEY `ref_no_2` (`ref_no`),
  ADD KEY `sales_id` (`sales_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `store_id` (`customer_id`,`deliveryPerson_id`),
  ADD KEY `sales_summary_ibfk_3` (`customer_id`),
  ADD KEY `sales_summary_ibfk_4` (`deliveryPerson_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_payment`
--
ALTER TABLE `card_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cod`
--
ALTER TABLE `cod`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `crew_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryPerson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `online_payments`
--
ALTER TABLE `online_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD CONSTRAINT `sales_id_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `cod`
--
ALTER TABLE `cod`
  ADD CONSTRAINT `cod_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `crew_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `online_payments`
--
ALTER TABLE `online_payments`
  ADD CONSTRAINT `online_payments_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`deliveryPerson_id`) REFERENCES `delivery` (`deliveryPerson_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
