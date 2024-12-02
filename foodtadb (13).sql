-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 02:57 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(9) NOT NULL DEFAULT 'UNORDERED'
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
  `user_password` varchar(50) NOT NULL,
  `foodtawallet` float NOT NULL,
  `gcash` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `full_name`, `customer_address`, `contact_no`, `username`, `user_password`, `foodtawallet`, `gcash`) VALUES
(1, 'Jan Victor T. Zaldarriaga', '#69, 1st Street, Monggoloid Subdivision, Calumpang, Molo, Iloilo City', '09212223242', 'jantotoextreme', '123asawanimarie', 703, 5),
(2, 'Clarns Legaspi', 'Earth, Solar System, Milky Way', '9991234567', 'Clarns', 'oogabooga', 0, 0);

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
(1, 1, 'Big Mac', 12, 85, 'Food', 'uploads/Big Mac.jpg'),
(2, 1, 'Chicken Burger', 21, 75, 'Food', 'uploads/McChicken.jpg'),
(3, 1, 'Quarter Pounder', 16, 110, 'Food', 'uploads/Quarter Pounder.jpg'),
(4, 2, 'Caramel Macchiato', 50, 99, 'Coffee', 'uploads/Caramel Macchiato.jpg'),
(5, 2, 'Espresso', 50, 70, 'Coffee', 'uploads/Espresso.jpg'),
(6, 2, 'Berry Blast Smoothie', 12, 110, 'Non-Coffee', 'uploads/Berry Blast Smoothie.jpg'),
(7, 2, 'Iced Matcha', 16, 89, 'Non-Coffee', 'uploads/Iced Matcha.jpg'),
(8, 3, 'Filet-O-Fish', 21, 75, 'Food', 'uploads/Filet-O-Fish.jpg'),
(9, 3, 'Crispy Chicken', 16, 65, 'Food', 'uploads/KFC Crispy Chicken.jpg'),
(10, 3, 'Chicken Bowls', 17, 99, 'Food', 'uploads/KFC Famous Bowls.jpg');

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
(1, 'McDonald\'s', '#47, 4th Street, Jomsorito Subdivision, Mandurriao, Iloilo City', '09696942096', '00:00:00', '23:59:59', 5, 'uploads/Mcdo.jpg', 'McDolibee is a vibrant, family-friendly restaurant that blends the best of American fast-food classics with beloved Filipino flavors. With a lively, welcoming atmosphere and a playful bee mascot, McDolibee has become a go-to spot for people of all ages. Its menu offers a unique twist on fast-food staples, featuring crispy fried chicken, juicy burgers, and spaghetti with a sweet, savory Filipino-style sauce. For breakfast, enjoy a hearty longganisa and garlic rice plate, and don\'t miss the halo-halo dessert, topped with colorful layers of fruit, shaved ice, and ube. Each meal is freshly prepared, balancing quality ingredients with flavors that evoke comfort and nostalgia. McDolibee’s friendly staff, fun ambiance, and playful menu make it a community favorite, perfect for a quick bite, family gatherings, or friends looking to enjoy a fusion of familiar and Filipino-inspired fast-food fare.', '', ''),
(2, 'Deja Brew Coffee', 'Brgy. Abong, Carles, Iloilo', '09696969696', '08:00:00', '22:00:00', 4, 'uploads/DejaBrew.jpg', 'The coffee that you had it before, but better.', 'dejaBrow', 'kape'),
(3, 'Chikhin', 'Burgos St., La Paz, Iloilo City', '09981736521', '08:00:00', '22:00:00', 4, 'uploads/Chikhin.jpg', 'Crispilicious, Juicilicious korean fried chicken with a taste love.', 'chikhen', 'kfc');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `deliveryPerson_id` int(11) NOT NULL,
  `pickup_Time` time NOT NULL,
  `dropoff_Time` time NOT NULL,
  `subtotal` float NOT NULL,
  `delivery_fee` float NOT NULL,
  `discount` float NOT NULL,
  `tax` float NOT NULL,
  `net` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`customer_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `order_id` (`transaction_id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `store_id` (`customer_id`,`deliveryPerson_id`),
  ADD KEY `sales_summary_ibfk_3` (`customer_id`),
  ADD KEY `sales_summary_ibfk_4` (`deliveryPerson_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`item_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`),
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`deliveryPerson_id`) REFERENCES `delivery` (`deliveryPerson_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
