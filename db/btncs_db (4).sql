-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 08:43 PM
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
-- Database: `btncs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `status` int(1) NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `owner_id`, `category_name`, `status`, `photo`, `last_updated`) VALUES
(1, 1, 'OUR SIGNATURE', 0, 'default_image.png', '2024-10-19 14:56:43.544371'),
(2, 1, 'LATTE SERIES', 0, 'default_image.png', '2024-10-19 14:18:07.271267'),
(3, 1, 'MATCHA SERIES', 0, 'default_image.png', '2024-10-19 14:18:24.731033'),
(4, 1, 'HOT COFFEE', 0, 'default_image.png', '2024-10-19 14:18:37.110621'),
(5, 1, 'SEASONAL DRINKS', 0, 'default_image.png', '2024-10-19 14:18:47.581311'),
(6, 1, 'BLENDED DRINKS', 0, 'default_image.png', '2024-10-19 14:19:07.241326'),
(7, 1, 'STARTERS', 0, 'default_image.png', '2024-10-20 10:25:00.340849'),
(8, 1, 'WEEKDAYS', 0, 'default_image.png', '2024-10-20 10:25:21.848723'),
(9, 1, 'CROFFLE SERIES', 0, 'default_image.png', '2024-10-20 10:25:45.947201'),
(10, 1, 'EGG DROP', 0, 'default_image.png', '2024-10-20 10:25:54.993661');

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
(1, 1, 'Doreen', 6925, 500, 'default_image.png', '2024-10-25 17:44:30.117670'),
(2, 1, 'Milk Syrup', 30120, 3700, 'default_image.png', '2024-10-25 17:44:30.122203'),
(3, 1, 'Milk Arla', 361050, 34500, 'default_image.png', '2024-10-25 17:44:30.123011'),
(4, 1, 'Coffee', 41820, 8750, 'default_image.png', '2024-10-25 17:44:30.123801'),
(5, 1, 'Ice', 242410, 22775, 'default_image.png', '2024-10-25 17:44:30.125131'),
(6, 1, 'Everwhip', 4200, 300, 'default_image.png', '2024-10-19 10:51:58.983339'),
(7, 1, 'White Chocolate', 1400, 100, 'default_image.png', '2024-10-19 10:53:58.100171'),
(8, 1, 'Toffee', 1400, 100, 'default_image.png', '2024-10-19 10:52:31.806826'),
(9, 1, 'Whipped Cream', 12290, 900, 'default_image.png', '2024-10-25 17:44:30.125895'),
(10, 1, 'Caramel Walling', 12480, 900, 'default_image.png', '2024-10-24 13:37:37.203822'),
(11, 1, 'Seasalt Cream', 5600, 400, 'default_image.png', '2024-10-19 10:53:36.291782'),
(12, 1, 'Tiramisu Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:54:41.060988'),
(13, 1, 'Broas', 70, 5, 'default_image.png', '2024-10-19 10:54:59.825507'),
(14, 1, 'Cocoa Powder', 6300, 354, 'default_image.png', '2024-10-19 10:55:19.279145'),
(15, 1, 'Vanilla Syrup', 1300, 450, 'default_image.png', '2024-10-24 13:25:23.556797'),
(16, 1, 'Caramel Syrup', 2795, 200, 'default_image.png', '2024-10-24 13:17:17.798913'),
(17, 1, 'Toffee Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:56:57.931058'),
(18, 1, 'Honeycomb', 1750, 125, 'default_image.png', '2024-10-19 10:57:09.270350'),
(19, 1, 'Hazelnut Syrup', 700, 50, 'default_image.png', '2024-10-19 10:57:23.213174'),
(20, 1, 'Strawberry Jam', 9420, 900, 'default_image.png', '2024-10-24 13:18:19.241312'),
(21, 1, 'Strawberry', 3835, 275, 'default_image.png', '2024-10-24 13:18:19.243314'),
(22, 1, 'Fructose', 2800, 150, 'default_image.png', '2024-10-19 10:58:28.940584'),
(23, 1, 'Ice Cream', 2450, 175, 'default_image.png', '2024-10-19 10:58:49.690692'),
(24, 1, 'Nata', 4200, 300, 'default_image.png', '2024-10-19 10:59:00.782999'),
(25, 1, 'Thai Sala', 3150, 225, 'default_image.png', '2024-10-19 10:59:16.429931'),
(26, 1, 'Matcha Powder', 3192, 120, 'default_image.png', '2024-10-24 13:25:23.555417'),
(27, 1, 'Ube Condensed', 300, 150, 'default_image.png', '2024-10-19 10:59:41.060602'),
(28, 1, 'Chocolate Syrup', 600, 300, 'default_image.png', '2024-10-19 10:59:55.342717'),
(29, 1, 'Pink Lemonade', 3360, 2400, 'default_image.png', '2024-10-19 11:00:42.369335'),
(30, 1, 'Salted Caramel Sauce', 3960, 300, 'default_image.png', '2024-10-24 13:37:37.192172'),
(31, 1, 'Choco Chips', 3264, 240, 'default_image.png', '2024-10-24 13:37:37.197037'),
(32, 1, 'Cheese', 20880, 1500, 'default_image.png', '2024-10-25 17:44:30.112240'),
(33, 1, 'Blueberry Jam', 4080, 300, 'default_image.png', '2024-10-25 17:44:30.110889'),
(34, 1, 'White Chocolate Sauce', 4140, 300, 'default_image.png', '2024-10-25 17:44:30.121057'),
(35, 1, 'Butterscotch Sauce', 4080, 300, 'default_image.png', '2024-10-24 13:37:37.199739'),
(36, 1, 'Fries', 20900, 2000, 'default_image.png', '2024-10-24 20:02:15.158654'),
(37, 1, 'Sour Cream', 2940, 300, 'default_image.png', '2024-10-19 11:03:27.955058'),
(38, 1, 'Seasonings', 139, 10, 'default_image.png', '2024-10-24 20:02:15.160846'),
(39, 1, 'Ground Beef', 5950, 750, 'default_image.png', '2024-10-24 20:02:15.159414'),
(40, 1, 'Cheese Sauce', 1950, 250, 'default_image.png', '2024-10-24 20:02:15.160109'),
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
(51, 1, 'Croffle', 23800, 3000, 'default_image.png', '2024-10-24 13:25:23.562315'),
(52, 1, 'Powdered Sugar', 139, 10, 'default_image.png', '2024-10-24 13:17:17.796085'),
(53, 1, 'Chocolate Sauce', 137, 10, 'default_image.png', '2024-10-24 13:25:23.562991'),
(54, 1, 'Sliced Almonds', 690, 10, 'default_image.png', '2024-10-24 13:17:17.795388'),
(55, 1, 'Crushed Oreos', 340, 50, 'default_image.png', '2024-10-24 13:25:23.566430'),
(56, 1, 'Blueberry Syrup', 350, 50, 'default_image.png', '2024-10-19 11:09:54.123483'),
(57, 1, 'Strawberry Syrup', 350, 50, 'default_image.png', '2024-10-19 11:10:20.373099'),
(58, 1, 'Caramel Sauce', 350, 50, 'default_image.png', '2024-10-19 11:10:33.064998'),
(59, 1, 'Whole Biscoff  Cookie', 69, 5, 'default_image.png', '2024-10-24 13:17:17.800224'),
(60, 1, 'Brioche Bread', 5850, 750, 'default_image.png', '2024-10-24 13:16:54.763416'),
(61, 1, 'Scrambled Egg', 5850, 750, 'default_image.png', '2024-10-24 13:16:54.765757'),
(62, 1, 'Signature Sauce', 4140, 300, 'default_image.png', '2024-10-24 13:16:54.767403'),
(63, 1, 'Butter', 700, 50, 'default_image.png', '2024-10-19 11:11:44.304586'),
(64, 1, 'Spam', 1850, 250, 'default_image.png', '2024-10-24 13:16:54.764181'),
(65, 1, 'Roasted Nori', 670, 50, 'default_image.png', '2024-10-24 13:16:54.764969'),
(66, 1, 'Mayonnaise', 670, 50, 'default_image.png', '2024-10-24 13:16:54.768410'),
(67, 1, 'Ham', 2000, 250, 'default_image.png', '2024-10-19 11:12:37.028692'),
(68, 1, 'Avocado', 1400, 100, 'default_image.png', '2024-10-19 11:12:47.905591'),
(69, 1, 'Cup', 487, 50, 'default_image.png', '2024-10-25 17:44:30.126747'),
(70, 1, 'Straw', 490, 50, 'default_image.png', '2024-10-25 17:44:30.128014'),
(71, 1, 'Lid', 487, 50, 'default_image.png', '2024-10-25 17:44:30.128824'),
(72, 1, 'Seasalt Sauce', 1000, 200, 'default_image.png', '2024-10-20 07:41:03.761973'),
(73, 1, 'Soda', 1000, 200, 'default_image.png', '2024-10-20 08:38:52.073663'),
(74, 1, 'Cheesecake', 997, 200, 'default_image.png', '2024-10-25 17:44:30.113157'),
(75, 1, 'Choco Powder', 1000, 200, 'default_image.png', '2024-10-20 08:58:27.067604'),
(76, 1, 'Crushed Biscoff', 995, 200, 'default_image.png', '2024-10-24 13:17:17.799555');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `contact_number` text NOT NULL,
  `photo` text NOT NULL,
  `account_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `username`, `password`, `email`, `firstname`, `lastname`, `contact_number`, `photo`, `account_created`) VALUES
(1, 'admin', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', 'admin@gmail.com', 'John', 'Doe', '09876543210', 'admin.png', '2024-05-30 08:50:41.748933');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `category_name` text NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `product_ingredients` text NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `owner_id`, `product_name`, `category_name`, `price`, `status`, `product_ingredients`, `photo`, `last_updated`) VALUES
(1, 1, 'SPANISH LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:13:36.508256'),
(2, 1, 'BARISTA DRINK', 'OUR SIGNATURE', 120, 0, '[{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"7\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"50\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:14:42.274356'),
(3, 1, 'TOFFEE NUT CARAMEL', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"8\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:16:16.646338'),
(4, 1, 'TIRAMISU LATTE', 'OUR SIGNATURE', 160, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"12\",\"quantity\":\"20\"},{\"inventory_id\":\"13\",\"quantity\":\"1\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:20:06.475161'),
(5, 1, 'VANI LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"15\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:21:48.344728'),
(6, 1, 'CARAMEL LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"280\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:23:42.091570'),
(7, 1, 'TOFFEE LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"17\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:27:29.305988'),
(8, 1, 'MOCAFINO LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:29:07.955275'),
(9, 1, 'SEASALT LATTE', 'OUR SIGNATURE', 150, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"72\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:45:09.684814'),
(10, 1, 'HONEYCOMB LATTE', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"18\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:47:17.619864'),
(11, 1, 'PURPLE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"27\",\"quantity\":\"30\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:48:41.238345'),
(12, 1, 'ON THE HOUSE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"19\",\"quantity\":\"10\"},{\"inventory_id\":\"15\",\"quantity\":\"10\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:49:58.516450'),
(13, 1, 'BERRY LATTE', 'LATTE SERIES', 150, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:51:46.451494'),
(14, 1, 'DOUBLE CHOCO LAVA', 'LATTE SERIES', 140, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"}]', 'default_image.png', '2024-10-20 07:52:59.081240'),
(15, 1, 'DOUBLE CHOCO FLOAT', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"23\",\"quantity\":\"35\"}]', 'default_image.png', '2024-10-20 07:54:44.933544'),
(16, 1, 'THAI PINKY', 'LATTE SERIES', 120, 0, '[{\"inventory_id\":\"24\",\"quantity\":\"60\"},{\"inventory_id\":\"25\",\"quantity\":\"45\"},{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:56:28.545095'),
(17, 1, 'ICHIGO COCOA', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 07:58:42.727481'),
(18, 1, 'MATCHA GREEN LATTE', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:01:11.721168'),
(19, 1, 'STRAWBERRY MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', 'default_image.png', '2024-10-20 08:04:08.094250'),
(20, 1, 'PINKY MATCHA', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', 'default_image.png', '2024-10-20 08:05:18.502535'),
(21, 1, 'PURPLE MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"27\",\"quantity\":\"15\"}]', 'default_image.png', '2024-10-20 08:06:38.731088'),
(22, 1, 'DIRTY MATCHA', 'MATCHA SERIES', 170, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"}]', 'default_image.png', '2024-10-20 08:07:39.952262'),
(23, 1, 'AMERICANO', 'HOT COFFEE', 100, 0, '[{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:10:08.479190'),
(24, 1, 'LATTE', 'HOT COFFEE', 115, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:11:03.239634'),
(26, 1, 'DARK MOCHA', 'HOT COFFEE', 120, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:16:38.032656'),
(27, 1, 'HOT SPANISH LATTE', 'HOT COFFEE', 125, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"12\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:20:18.470635'),
(28, 1, 'WHITE MOCHA', 'HOT COFFEE', 135, 0, '[{\"inventory_id\":\"7\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', 'default_image.png', '2024-10-20 08:21:30.215433'),
(29, 1, 'MACCHIATO', 'HOT COFFEE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', 'default_image.png', '2024-10-20 08:33:58.000640'),
(30, 1, 'HOT MATCHA GREEN LATTE', 'HOT COFFEE', 145, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:36:02.864607'),
(31, 1, 'PINK LEMONADE SLUSHIE', 'SEASONAL DRINKS', 160, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:37:28.404433'),
(32, 1, 'PINK LEMONADE FRIZ', 'SEASONAL DRINKS', 150, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"73\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:40:14.820541'),
(33, 1, 'SALTED CARAMEL', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"30\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"}]', 'default_image.png', '2024-10-24 13:01:01.844775'),
(34, 1, 'STRAWBERRIES & CREAM', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"}]', 'default_image.png', '2024-10-20 08:47:24.316907'),
(35, 1, 'STRAWBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', 'default_image.png', '2024-10-20 08:53:07.267423'),
(36, 1, 'BLUEBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"33\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', 'default_image.png', '2024-10-20 08:54:55.171051'),
(37, 1, 'JAVA CHIP', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"},{\"inventory_id\":\"75\",\"quantity\":\"60\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 09:00:41.210599'),
(38, 1, 'VANILLA MATCHA CREME', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 09:09:41.722155'),
(39, 1, 'WHITE CHOCO MOCHA', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"34\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 09:11:07.365759'),
(40, 1, 'BUTTERSCOTCH', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"35\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 09:12:32.627504'),
(41, 1, 'FLAVORED FRIES', 'STARTERS', 100, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"37\",\"quantity\":\"30\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 10:31:06.001502'),
(42, 1, 'CHEESY BEEF FRIES', 'STARTERS', 150, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"40\",\"quantity\":\"50\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 10:31:13.338938'),
(43, 1, 'OVERLOAD NACHOS', 'STARTERS', 150, 0, '[{\"inventory_id\":\"41\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"42\",\"quantity\":\"20\"},{\"inventory_id\":\"43\",\"quantity\":\"20\"},{\"inventory_id\":\"44\",\"quantity\":\"20\"},{\"inventory_id\":\"32\",\"quantity\":\"30\"},{\"inventory_id\":\"45\",\"quantity\":\"30\"},{\"inventory_id\":\"37\",\"quantity\":\"20\"},{\"inventory_id\":\"46\",\"quantity\":\"10\"}]', 'default_image.png', '2024-10-20 10:31:18.434065'),
(44, 1, 'LASAGNA', 'WEEKDAYS', 130, 0, '[{\"inventory_id\":\"46\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"150\"},{\"inventory_id\":\"48\",\"quantity\":\"200\"},{\"inventory_id\":\"32\",\"quantity\":\"100\"},{\"inventory_id\":\"49\",\"quantity\":\"50\"},{\"inventory_id\":\"50\",\"quantity\":\"50\"}]', 'default_image.png', '2024-10-20 10:31:23.186260'),
(45, 1, 'BREAKFAST CROFFLE', 'CROFFLE SERIES', 90, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 10:31:28.963140'),
(46, 1, 'DARK CHOCOLATE ALMONDS', 'CROFFLE SERIES', 125, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"54\",\"quantity\":\"10\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 10:31:40.152695'),
(47, 1, 'OREO CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"55\",\"quantity\":\"5\"}]', 'default_image.png', '2024-10-20 10:31:48.333925'),
(48, 1, 'BLUEBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"56\",\"quantity\":\"5\"}]', 'default_image.png', '2024-10-20 10:31:59.705839'),
(49, 1, 'STRAWBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"57\",\"quantity\":\"5\"}]', 'default_image.png', '2024-10-20 10:32:12.070602'),
(50, 1, 'BISCOFF CROFFLE', 'CROFFLE SERIES', 150, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"16\",\"quantity\":\"5\"},{\"inventory_id\":\"76\",\"quantity\":\"5\"},{\"inventory_id\":\"59\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 10:36:35.940730'),
(51, 1, 'CLASSIC EGG TOAST', 'EGG DROP', 130, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"63\",\"quantity\":\"10\"}]', 'default_image.png', '2024-10-20 10:36:42.511521'),
(52, 1, 'SPAM NORI', 'EGG DROP', 160, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"64\",\"quantity\":\"50\"},{\"inventory_id\":\"65\",\"quantity\":\"10\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"66\",\"quantity\":\"10\"}]', 'default_image.png', '2024-10-20 10:30:22.535841'),
(53, 1, 'HAM AND CHEESE', 'EGG DROP', 140, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"67\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"68\",\"quantity\":\"20\"}]', 'default_image.png', '2024-10-20 10:36:59.144587');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `customer_pay` decimal(11,2) NOT NULL,
  `change_amount` decimal(11,2) NOT NULL,
  `payment_method` text NOT NULL,
  `queue_no` text NOT NULL,
  `status` int(1) NOT NULL,
  `transaction_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `total_amount`, `customer_pay`, `change_amount`, `payment_method`, `queue_no`, `status`, `transaction_date`) VALUES
(1, 470.00, 500.00, 30.00, 'Cash', '', 0, '2024-10-24 11:43:16.893072'),
(2, 155.00, 200.00, 45.00, 'Cash', '', 0, '2024-10-23 11:46:50.507536'),
(3, 315.00, 500.00, 185.00, 'Cash', '', 0, '2024-10-22 12:27:17.836028'),
(4, 295.00, 300.00, 5.00, 'Cash', '241530', 0, '2024-10-21 13:04:30.147940'),
(5, 275.00, 300.00, 25.00, 'Cash', '242148', 0, '2024-10-20 13:16:48.845129'),
(6, 275.00, 300.00, 25.00, 'Cash', '242150', 0, '2024-10-19 13:16:50.392680'),
(7, 275.00, 300.00, 25.00, 'Cash', '242154', 0, '2024-09-24 13:16:54.754989'),
(8, 275.00, 300.00, 25.00, 'Cash', '242117', 0, '2024-09-10 13:17:17.791029'),
(9, 310.00, 350.00, 40.00, 'Cash', '242119', 0, '2024-08-24 13:18:19.238872'),
(10, 295.00, 300.00, 5.00, 'Card', '242123', 0, '2024-07-24 13:25:23.553714'),
(11, 310.00, 400.00, 90.00, 'Cash', '242137', 0, '2024-06-24 13:37:37.188869'),
(12, 150.00, 200.00, 50.00, 'Cash', '250415', 0, '2024-10-24 20:02:15.155441'),
(13, 315.00, 400.00, 85.00, 'Cash', '260130', 0, '2024-10-25 17:44:30.106943');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `sale_items_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`sale_items_id`, `sale_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 33, 'SALTED CARAMEL', 2, 155.00),
(2, 1, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(3, 2, 33, 'SALTED CARAMEL', 1, 155.00),
(4, 3, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(5, 3, 36, 'BLUEBERRY CHEESECAKE', 1, 160.00),
(6, 4, 38, 'VANILLA MATCHA CREME', 1, 155.00),
(7, 4, 47, 'OREO CROFFLE', 1, 140.00),
(8, 5, 24, 'LATTE', 1, 115.00),
(9, 5, 52, 'SPAM NORI', 1, 160.00),
(10, 6, 24, 'LATTE', 1, 115.00),
(11, 6, 52, 'SPAM NORI', 1, 160.00),
(12, 7, 24, 'LATTE', 1, 115.00),
(13, 7, 52, 'SPAM NORI', 1, 160.00),
(14, 8, 46, 'DARK CHOCOLATE ALMONDS', 1, 125.00),
(15, 8, 50, 'BISCOFF CROFFLE', 1, 150.00),
(16, 9, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(17, 9, 40, 'BUTTERSCOTCH', 1, 155.00),
(18, 10, 38, 'VANILLA MATCHA CREME', 1, 155.00),
(19, 10, 47, 'OREO CROFFLE', 1, 140.00),
(20, 11, 33, 'SALTED CARAMEL', 1, 155.00),
(21, 11, 40, 'BUTTERSCOTCH', 1, 155.00),
(22, 12, 42, 'CHEESY BEEF FRIES', 1, 150.00),
(23, 13, 36, 'BLUEBERRY CHEESECAKE', 1, 160.00),
(24, 13, 39, 'WHITE CHOCO MOCHA', 1, 155.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `contact_number` text NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `status`, `username`, `password`, `email`, `firstname`, `lastname`, `contact_number`, `photo`, `last_updated`) VALUES
(3, 0, 'staffmanager', '$2y$10$yMpkAqw7P/oU7jdp1JlePOK3t4Qj8oJ/KfJPJkkx03b9KDgPO6r4e', 'juandelacruz@gmail.com', 'Juan', 'Dela Cruz', '+639876543212', '1909312970defaut_image.jpg', '2024-09-17 16:22:01.649448');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`sale_items_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
