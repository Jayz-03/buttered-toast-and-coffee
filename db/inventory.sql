-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btncs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `item` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `low_stock` int(11) NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `owner_id`, `item`, `quantity`, `low_stock`, `photo`, `last_updated`) VALUES
(1, 1, 'Doreen', 7000, 500, 'default_image.png', '2024-10-19 10:49:53.797072'),
(2, 1, 'Milk Syrup', 30600, 3700, 'default_image.png', '2024-10-19 10:50:48.498751'),
(3, 1, 'Milk Arla', 362600, 34500, 'default_image.png', '2024-10-19 10:51:06.430268'),
(4, 1, 'Coffee', 42000, 8750, 'default_image.png', '2024-10-19 10:51:23.448897'),
(5, 1, 'Ice', 243250, 22775, 'default_image.png', '2024-10-19 10:51:38.191208'),
(6, 1, 'Everwhip', 4200, 300, 'default_image.png', '2024-10-19 10:51:58.983339'),
(7, 1, 'White Chocolate', 1400, 100, 'default_image.png', '2024-10-19 10:53:58.100171'),
(8, 1, 'Toffee', 1400, 100, 'default_image.png', '2024-10-19 10:52:31.806826'),
(9, 1, 'Whipped Cream', 12600, 900, 'default_image.png', '2024-10-19 10:52:49.034058'),
(10, 1, 'Caramel Walling', 12600, 900, 'default_image.png', '2024-10-19 10:53:19.360264'),
(11, 1, 'Seasalt Cream', 5600, 400, 'default_image.png', '2024-10-19 10:53:36.291782'),
(12, 1, 'Tiramisu Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:54:41.060988'),
(13, 1, 'Broas', 70, 5, 'default_image.png', '2024-10-19 10:54:59.825507'),
(14, 1, 'Cocoa Powder', 6300, 354, 'default_image.png', '2024-10-19 10:55:19.279145'),
(15, 1, 'Vanilla Syrup', 1400, 450, 'default_image.png', '2024-10-19 10:55:36.902384'),
(16, 1, 'Caramel Syrup', 2800, 200, 'default_image.png', '2024-10-19 10:56:36.063917'),
(17, 1, 'Toffee Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:56:57.931058'),
(18, 1, 'Honeycomb', 1750, 125, 'default_image.png', '2024-10-19 10:57:09.270350'),
(19, 1, 'Hazelnut Syrup', 700, 50, 'default_image.png', '2024-10-19 10:57:23.213174'),
(20, 1, 'Strawberry Jam', 9600, 900, 'default_image.png', '2024-10-19 10:58:03.803876'),
(21, 1, 'Strawberry', 3850, 275, 'default_image.png', '2024-10-19 10:58:15.606950'),
(22, 1, 'Fructose', 2800, 150, 'default_image.png', '2024-10-19 10:58:28.940584'),
(23, 1, 'Ice Cream', 2450, 175, 'default_image.png', '2024-10-19 10:58:49.690692'),
(24, 1, 'Nata', 4200, 300, 'default_image.png', '2024-10-19 10:59:00.782999'),
(25, 1, 'Thai Sala', 3150, 225, 'default_image.png', '2024-10-19 10:59:16.429931'),
(26, 1, 'Matcha Powder', 3200, 120, 'default_image.png', '2024-10-19 10:59:28.310681'),
(27, 1, 'Ube Condensed', 300, 150, 'default_image.png', '2024-10-19 10:59:41.060602'),
(28, 1, 'Chocolate Syrup', 600, 300, 'default_image.png', '2024-10-19 10:59:55.342717'),
(29, 1, 'Pink Lemonade', 3360, 2400, 'default_image.png', '2024-10-19 11:00:42.369335'),
(30, 1, 'Salted Caramel Sauce', 4200, 300, 'default_image.png', '2024-10-19 11:00:58.688036'),
(31, 1, 'Choco Chips', 3360, 240, 'default_image.png', '2024-10-19 11:01:40.471014'),
(32, 1, 'Cheese', 21000, 1500, 'default_image.png', '2024-10-19 11:01:53.293095'),
(33, 1, 'Blueberry Jam', 4200, 300, 'default_image.png', '2024-10-19 11:02:16.651146'),
(34, 1, 'White Chocolate Sauce', 4200, 300, 'default_image.png', '2024-10-19 11:02:34.317271'),
(35, 1, 'Butterscotch Sauce', 4200, 300, 'default_image.png', '2024-10-19 11:02:52.152146'),
(36, 1, 'Fries', 21000, 2000, 'default_image.png', '2024-10-19 11:03:09.731188'),
(37, 1, 'Sour Cream', 2940, 300, 'default_image.png', '2024-10-19 11:03:27.955058'),
(38, 1, 'Seasonings', 140, 10, 'default_image.png', '2024-10-19 11:03:40.214700'),
(39, 1, 'Ground Beef', 6000, 750, 'default_image.png', '2024-10-19 11:03:57.575456'),
(40, 1, 'Cheese Sauce', 2000, 250, 'default_image.png', '2024-10-19 11:04:10.011594'),
(41, 1, 'Nacho Chips', 7000, 500, 'default_image.png', '2024-10-19 11:04:22.090465'),
(42, 1, 'Onions', 1400, 100, 'default_image.png', '2024-10-19 11:04:34.365724'),
(43, 1, 'Tomatoes', 1400, 100, 'default_image.png', '2024-10-19 11:04:51.010560'),
(44, 1, 'Cucumbers', 1400, 100, 'default_image.png', '2024-10-19 11:05:08.328327'),
(45, 1, 'Salsa', 1470, 150, 'default_image.png', '2024-10-19 11:05:19.070004'),
(46, 1, 'Jalapenos', 700, 50, 'default_image.png', '2024-10-19 11:05:31.299390'),
(47, 1, 'Lasagna Sheets', 7000, 500, 'default_image.png', '2024-10-19 11:05:47.857095'),
(48, 1, 'Tomato Sauce', 14000, 750, 'default_image.png', '2024-10-19 11:06:00.363570'),
(49, 1, 'Ricotta Cheese', 2000, 250, 'default_image.png', '2024-10-19 11:06:18.864429'),
(50, 1, 'Spinach', 2000, 250, 'default_image.png', '2024-10-19 11:07:51.180837'),
(51, 1, 'Croffle', 24000, 3000, 'default_image.png', '2024-10-19 11:08:01.953128'),
(52, 1, 'Powdered Sugar', 140, 10, 'default_image.png', '2024-10-19 11:08:43.634831'),
(53, 1, 'Chocolate Sauce', 140, 10, 'default_image.png', '2024-10-19 11:08:57.083401'),
(54, 1, 'Sliced Almonds', 700, 10, 'default_image.png', '2024-10-19 11:09:12.580826'),
(55, 1, 'Crushed Oreos', 350, 50, 'default_image.png', '2024-10-19 11:09:43.028040'),
(56, 1, 'Blueberry Syrup', 350, 50, 'default_image.png', '2024-10-19 11:09:54.123483'),
(57, 1, 'Strawberry Syrup', 350, 50, 'default_image.png', '2024-10-19 11:10:20.373099'),
(58, 1, 'Caramel Sauce', 350, 50, 'default_image.png', '2024-10-19 11:10:33.064998'),
(59, 1, 'Whole Biscoff  Cookie', 70, 5, 'default_image.png', '2024-10-19 11:10:47.541913'),
(60, 1, 'Brioche Bread', 6000, 750, 'default_image.png', '2024-10-19 11:10:58.228044'),
(61, 1, 'Scrambled Egg', 6000, 750, 'default_image.png', '2024-10-19 11:11:16.433806'),
(62, 1, 'Signature Sauce', 4200, 300, 'default_image.png', '2024-10-19 11:11:35.539241'),
(63, 1, 'Butter', 700, 50, 'default_image.png', '2024-10-19 11:11:44.304586'),
(64, 1, 'Spam', 2000, 250, 'default_image.png', '2024-10-19 11:11:54.743266'),
(65, 1, 'Roasted Nori', 700, 50, 'default_image.png', '2024-10-19 11:12:07.783741'),
(66, 1, 'Mayonnaise', 700, 50, 'default_image.png', '2024-10-19 11:12:21.656770'),
(67, 1, 'Ham', 2000, 250, 'default_image.png', '2024-10-19 11:12:37.028692'),
(68, 1, 'Avocado', 1400, 100, 'default_image.png', '2024-10-19 11:12:47.905591');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
