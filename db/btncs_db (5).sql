-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 09:54 PM
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
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `owner_id` int(11) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `limits` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`owner_id`, `balance`, `limits`, `status`, `last_updated`) VALUES
(1, 200605.00, 300000.00, 0, '2024-11-24 20:53:55.777148');

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
(1, 1, 'Doreen', 6675, 500, '702806193Doreen.png', '2024-11-24 20:53:55.796166'),
(2, 1, 'Milk Syrup', 29145, 3700, '1954975028Milk syrup.jpg', '2024-11-24 20:51:20.960438'),
(3, 1, 'Milk Arla', 357170, 34500, '2113943345Milk Arla.png', '2024-11-24 20:51:20.961158'),
(4, 1, 'Coffee', 41442, 8750, '524009733Coffee.jpeg', '2024-11-24 20:51:20.961857'),
(5, 1, 'Ice', 239870, 22775, '1256192592Ice Cubes.jpg', '2024-11-24 20:53:55.795517'),
(6, 1, 'Everwhip', 4200, 300, 'default_image.png', '2024-10-19 10:51:58.983339'),
(7, 1, 'White Chocolate', 1400, 100, '1882457583White Chocolate.jpg', '2024-11-01 16:05:01.834392'),
(8, 1, 'Toffee', 1380, 100, 'default_image.png', '2024-10-29 07:25:07.844200'),
(9, 1, 'Whipped Cream', 11580, 900, '2122203380Whipped Cream.jpeg', '2024-11-24 20:53:55.799690'),
(10, 1, 'Caramel Walling', 12300, 900, '35449025Caramel Walling.jpg', '2024-11-24 20:50:04.399270'),
(11, 1, 'Seasalt Cream', 5600, 400, 'default_image.png', '2024-10-19 10:53:36.291782'),
(12, 1, 'Tiramisu Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:54:41.060988'),
(13, 1, 'Broas', 70, 5, 'default_image.png', '2024-10-19 10:54:59.825507'),
(14, 1, 'Cocoa Powder', 6275, 354, '1891934419Cocoa Powder.jpeg', '2024-11-24 20:35:12.327861'),
(15, 1, 'Vanilla Syrup', 1100, 450, '692145424Vanilla Syrup.png', '2024-11-24 20:45:32.905244'),
(16, 1, 'Caramel Syrup', 2770, 200, '129931675Caramel Syrup.jpeg', '2024-11-24 20:19:04.206911'),
(17, 1, 'Toffee Syrup', 1400, 100, 'default_image.png', '2024-10-19 10:56:57.931058'),
(18, 1, 'Honeycomb', 1750, 125, 'default_image.png', '2024-10-19 10:57:09.270350'),
(19, 1, 'Hazelnut Syrup', 700, 50, 'default_image.png', '2024-10-19 10:57:23.213174'),
(20, 1, 'Strawberry Jam', 8520, 900, '2046377866Strawberry Jam.jpg', '2024-11-24 20:53:55.793617'),
(21, 1, 'Strawberry', 3760, 275, 'default_image.png', '2024-11-24 20:53:55.799057'),
(22, 1, 'Fructose', 2800, 150, '271949627Fructose.jpeg', '2024-11-01 16:20:01.040951'),
(23, 1, 'Ice Cream', 2450, 175, 'default_image.png', '2024-10-19 10:58:49.690692'),
(24, 1, 'Nata', 4140, 300, 'default_image.png', '2024-11-19 21:09:45.317690'),
(25, 1, 'Thai Sala', 3105, 225, 'default_image.png', '2024-11-19 21:09:45.318462'),
(26, 1, 'Matcha Powder', 3180, 120, '1415667598Matcha Powder.jpeg', '2024-11-24 20:23:22.793348'),
(27, 1, 'Ube Condensed', 300, 150, '148662521Ube Condensed.jpg', '2024-11-01 16:20:38.349480'),
(28, 1, 'Chocolate Syrup', 490, 300, '1930241371Choco Syrup.jpeg', '2024-11-24 20:35:12.324840'),
(29, 1, 'Pink Lemonade', 3360, 2400, '178685725Pink Lemonade.jpg', '2024-11-01 16:21:14.315282'),
(30, 1, 'Salted Caramel Sauce', 3840, 300, '1058166169Salted Caramel Sauce.jpg', '2024-11-24 20:50:04.394629'),
(31, 1, 'Choco Chips', 3192, 240, '1109136920Choco Chips.jpg', '2024-11-24 20:50:04.399952'),
(32, 1, 'Cheese', 20660, 1500, '1052171030Cheese.jpg', '2024-11-24 20:53:55.794265'),
(33, 1, 'Blueberry Jam', 3840, 300, '1532838908Blueberry Jam.jpeg', '2024-11-24 20:19:04.195782'),
(34, 1, 'White Chocolate Sauce', 3840, 300, '221466754White Chocolate sauce.jpeg', '2024-11-24 20:25:15.451171'),
(35, 1, 'Butterscotch Sauce', 3780, 300, 'default_image.png', '2024-11-24 20:45:32.912832'),
(36, 1, 'Fries', 20900, 2000, '856361939Fries.jpeg', '2024-11-01 16:11:12.105358'),
(37, 1, 'Sour Cream', 2940, 300, '1190287284Sour Cream.jpeg', '2024-11-01 16:16:41.228983'),
(38, 1, 'Seasonings', 139, 10, '367302281Seasonings.jpg', '2024-11-01 16:15:23.602106'),
(39, 1, 'Ground Beef', 5950, 750, '243057177Ground Beef.jpg', '2024-11-01 16:11:24.154075'),
(40, 1, 'Cheese Sauce', 1950, 250, 'default_image.png', '2024-10-24 20:02:15.160109'),
(41, 1, 'Nacho Chips', 7000, 500, '1469267716Nacho chips.jpeg', '2024-11-01 16:13:48.120647'),
(42, 1, 'Onions', 1400, 100, '1670637696Onions.jpeg', '2024-11-01 16:14:01.082532'),
(43, 1, 'Tomatoes', 1400, 100, '258013716Tomato.jpg', '2024-11-01 16:18:31.810582'),
(44, 1, 'Cucumbers', 1400, 100, '548653963Cucumber.jpeg', '2024-11-01 16:10:25.336411'),
(45, 1, 'Salsa', 1470, 150, '1098178018Salsa.jpeg', '2024-11-01 16:15:07.500686'),
(46, 1, 'Jalapenos', 700, 50, '88830658Jalapenos.jpg', '2024-11-01 16:13:01.641872'),
(47, 1, 'Lasagna Sheets', 7000, 500, '773340493Lasagna Sheets.jpeg', '2024-11-01 16:13:17.851991'),
(48, 1, 'Tomato Sauce', 14000, 750, '2064485853Tomato Sauce.jpg', '2024-11-01 16:18:16.914919'),
(49, 1, 'Ricotta Cheese', 2000, 250, '666725220Ricotta Cheese.jpeg', '2024-11-01 16:14:38.248529'),
(50, 1, 'Spinach', 2000, 250, '980471996Spinach.jpeg', '2024-11-01 16:17:37.438616'),
(51, 1, 'Croffle', 23450, 3000, '1559869054croffle.jpg', '2024-11-24 20:32:21.906839'),
(52, 1, 'Powdered Sugar', 137, 10, '2043228134Powdered Sugar.jpg', '2024-11-19 21:08:48.754965'),
(53, 1, 'Chocolate Sauce', 134, 10, '1808980848Chocolate Sauce.jpeg', '2024-11-24 20:18:31.689512'),
(54, 1, 'Sliced Almonds', 690, 10, '871089859Sliced Almonds.jpg', '2024-11-01 16:16:01.590344'),
(55, 1, 'Crushed Oreos', 325, 50, '1894511401Crushed Oreos.jpg', '2024-11-24 20:18:31.690910'),
(56, 1, 'Blueberry Syrup', 350, 50, '2042419042Blueberry Syrup.jpg', '2024-11-01 16:08:05.729544'),
(57, 1, 'Strawberry Syrup', 345, 50, '562669123Strawberry Syrup.jpeg', '2024-11-24 20:32:21.908105'),
(58, 1, 'Caramel Sauce', 350, 50, 'default_image.png', '2024-10-19 11:10:33.064998'),
(59, 1, 'Whole Biscoff  Cookie', 68, 5, '1397369084Whole Biscoff Cookie.png', '2024-11-24 20:19:04.208701'),
(60, 1, 'Brioche Bread', 5850, 750, '1696705689Brioche Bread.png', '2024-11-01 16:08:25.865573'),
(61, 1, 'Scrambled Egg', 5850, 750, 'default_image.png', '2024-10-24 13:16:54.765757'),
(62, 1, 'Signature Sauce', 4140, 300, '447137729Signature Sauce.jpg', '2024-11-01 16:15:47.484506'),
(63, 1, 'Butter', 700, 50, '119005865Butter.jpg', '2024-11-01 16:08:38.837398'),
(64, 1, 'Spam', 1850, 250, '1286506431Spam.jpg', '2024-11-01 16:17:13.386659'),
(65, 1, 'Roasted Nori', 670, 50, '1691413221Roasted Nori.jpg', '2024-11-01 16:14:54.520341'),
(66, 1, 'Mayonnaise', 670, 50, '1834727059Mayo.jpg', '2024-11-01 16:13:31.649671'),
(67, 1, 'Ham', 2000, 250, '379862287Ham.jpeg', '2024-11-01 16:11:41.062653'),
(68, 1, 'Avocado', 1400, 100, '347342382Avocado.jpg', '2024-11-01 16:07:50.999168'),
(69, 1, 'Cup', 446, 50, '1802055352Cup Only.png', '2024-11-24 20:53:55.796874'),
(70, 1, 'Straw', 454, 50, '122086463Straw.jpeg', '2024-11-24 20:53:55.797561'),
(71, 1, 'Lid', 446, 50, '1423079393Coffee Lid.png', '2024-11-24 20:53:55.798411'),
(72, 1, 'Seasalt Sauce', 1000, 200, 'default_image.png', '2024-10-20 07:41:03.761973'),
(73, 1, 'Soda', 1000, 200, '519393515Soda.jpg', '2024-11-01 16:21:24.494927'),
(74, 1, 'Cheesecake', 986, 200, '571684407Cheesecake.jpg', '2024-11-24 20:53:55.794883'),
(75, 1, 'Choco Powder', 940, 200, 'default_image.png', '2024-11-24 20:35:12.329294'),
(76, 1, 'Crushed Biscoff', 990, 200, '1884116333Crushed Biscoff.jpeg', '2024-11-24 20:19:04.207986');

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
(1, 'admin', '$2y$10$xYa/zJQ9KOg341XVI255bOPi.yqQqGTJIHk8KKFZ99gzX6qogsv2a', 'butteredtoastandcoffee@gmail.com', 'Buttered Toast', '& Coffee', '09876543210', 'admin.png', '2024-11-24 19:10:48.769017');

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
(1, 1, 'SPANISH LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '85106263SpanishLatte.JPG', '2024-11-01 13:33:37.595873'),
(2, 1, 'BARISTA DRINK', 'OUR SIGNATURE', 120, 0, '[{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"7\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"50\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '80676847BaristaDrink.JPG', '2024-11-01 13:31:22.018717'),
(3, 1, 'TOFFEE NUT CARAMEL', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"8\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1398337807ToffeeNutCaramel.JPG', '2024-11-01 13:34:34.119231'),
(4, 1, 'TIRAMISU LATTE', 'OUR SIGNATURE', 160, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"12\",\"quantity\":\"20\"},{\"inventory_id\":\"13\",\"quantity\":\"1\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '606902519TiramisuLatte.JPG', '2024-11-01 13:33:52.716901'),
(5, 1, 'VANI LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"15\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1457273406VaniLatte.JPG', '2024-11-01 13:34:48.900765'),
(6, 1, 'CARAMEL LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"280\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '425915820CaramelLatte.JPG', '2024-11-01 13:31:46.923779'),
(7, 1, 'TOFFEE LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"17\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '234777159ToffeeLatte.JPG', '2024-11-01 13:34:13.370024'),
(8, 1, 'MOCAFINO LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '411691391MocafinoLatte.JPG', '2024-11-01 13:32:19.246408'),
(9, 1, 'SEASALT LATTE', 'OUR SIGNATURE', 150, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"72\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '269835815SeaSaltLatte.JPG', '2024-11-01 13:33:20.076902'),
(10, 1, 'HONEYCOMB LATTE', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"18\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '2069222003HoneyCombLatte.JPG', '2024-11-01 13:32:03.093745'),
(11, 1, 'PURPLE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"27\",\"quantity\":\"30\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '906337839PurpleLatte.JPG', '2024-11-01 13:32:58.880348'),
(12, 1, 'ON THE HOUSE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"19\",\"quantity\":\"10\"},{\"inventory_id\":\"15\",\"quantity\":\"10\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '804101713OnTheHouseLatte.JPG', '2024-11-01 13:32:43.051188'),
(13, 1, 'BERRY LATTE', 'LATTE SERIES', 150, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1216232860BerryLatte.JPG', '2024-11-01 13:26:09.845356'),
(14, 1, 'DOUBLE CHOCO LAVA', 'LATTE SERIES', 140, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"}]', '1494621505DoubleChocoLava.JPG', '2024-11-01 13:26:49.808724'),
(15, 1, 'DOUBLE CHOCO FLOAT', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"23\",\"quantity\":\"35\"}]', '1706273194DoubleChocoFloat.JPG', '2024-11-01 13:26:29.562603'),
(16, 1, 'THAI PINKY', 'LATTE SERIES', 120, 0, '[{\"inventory_id\":\"24\",\"quantity\":\"60\"},{\"inventory_id\":\"25\",\"quantity\":\"45\"},{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '2118240959ThaiPinky.JPG', '2024-11-01 13:28:12.583327'),
(17, 1, 'ICHIGO COCOA', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '165263310IchigoCocoa.JPG', '2024-11-01 13:27:51.068631'),
(18, 1, 'MATCHA GREEN LATTE', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1706098038MatchGreenLatte.JPG', '2024-11-01 13:29:17.339692'),
(19, 1, 'STRAWBERRY MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', '1221531044StrawberryMatcha.JPG', '2024-11-01 13:30:24.885829'),
(20, 1, 'PINKY MATCHA', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', '1413806522PinkyMatcha.JPG', '2024-11-01 13:29:39.699617'),
(21, 1, 'PURPLE MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"27\",\"quantity\":\"15\"}]', '1776600277PurpleMatcha.JPG', '2024-11-01 13:30:07.148384'),
(22, 1, 'DIRTY MATCHA', 'MATCHA SERIES', 170, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"}]', '1554261404DirtyMatcha.JPG', '2024-11-01 13:28:52.830916'),
(23, 1, 'AMERICANO', 'HOT COFFEE', 100, 0, '[{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1165423849Americano.JPG', '2024-11-01 13:23:24.002225'),
(24, 1, 'LATTE', 'HOT COFFEE', 115, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2024-10-20 08:11:03.239634'),
(26, 1, 'DARK MOCHA', 'HOT COFFEE', 120, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '739171511DarkMocha.JPG', '2024-11-01 13:23:45.615446'),
(27, 1, 'HOT SPANISH LATTE', 'HOT COFFEE', 125, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"12\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '682425002SpanishLatte.JPG', '2024-11-01 13:25:11.076017'),
(28, 1, 'WHITE MOCHA', 'HOT COFFEE', 135, 0, '[{\"inventory_id\":\"7\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', '748102268Mocha.JPG', '2024-11-01 13:24:56.010247'),
(29, 1, 'MACCHIATO', 'HOT COFFEE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', '1756698449Machiatto.JPG', '2024-11-01 13:24:08.600672'),
(30, 1, 'HOT MATCHA GREEN LATTE', 'HOT COFFEE', 145, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1586803506MatchaGreen.JPG', '2024-11-01 13:24:35.590927'),
(31, 1, 'PINK LEMONADE SLUSHIE', 'SEASONAL DRINKS', 160, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1578979235PinkLemonadeSlushie.JPG', '2024-11-01 13:35:29.640202'),
(32, 1, 'PINK LEMONADE FRIZ', 'SEASONAL DRINKS', 150, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"73\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1354532358PinkLemonadeFriz.JPG', '2024-11-01 13:35:46.299417'),
(33, 1, 'SALTED CARAMEL', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"30\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"}]', '881243495SaltedCaramel.JPG', '2024-11-01 13:12:46.653608'),
(34, 1, 'STRAWBERRIES & CREAM', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"}]', '1901592446Strawberries&Cream.JPG', '2024-11-01 13:14:58.738667'),
(35, 1, 'STRAWBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', '2063445121StrawberryCheesecake.JPG', '2024-11-01 13:15:23.752793'),
(36, 1, 'BLUEBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"33\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', '899585060BlueberryCheesecake.JPG', '2024-11-01 13:10:10.566045'),
(37, 1, 'JAVA CHIP', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"},{\"inventory_id\":\"75\",\"quantity\":\"60\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1327835747JavaChip.JPG', '2024-11-01 13:12:28.507729'),
(38, 1, 'VANILLA MATCHA CREME', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '652415703VanillaMatchaCreme.JPG', '2024-11-01 13:15:43.072051'),
(39, 1, 'WHITE CHOCO MOCHA', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"34\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '45057962WhiteChocoMocha.JPG', '2024-11-01 13:16:04.719665'),
(40, 1, 'BUTTERSCOTCH', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"35\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '2068260072Butterscotch.JPG', '2024-11-01 13:11:59.564559'),
(41, 1, 'FLAVORED FRIES', 'STARTERS', 100, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"37\",\"quantity\":\"30\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', '1553949242FlavoredFries.JPG', '2024-11-01 13:20:20.744546'),
(42, 1, 'CHEESY BEEF FRIES', 'STARTERS', 150, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"40\",\"quantity\":\"50\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', '37501886CheesyBeefFries.JPG', '2024-11-01 13:19:07.967495'),
(43, 1, 'OVERLOAD NACHOS', 'STARTERS', 150, 0, '[{\"inventory_id\":\"41\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"42\",\"quantity\":\"20\"},{\"inventory_id\":\"43\",\"quantity\":\"20\"},{\"inventory_id\":\"44\",\"quantity\":\"20\"},{\"inventory_id\":\"32\",\"quantity\":\"30\"},{\"inventory_id\":\"45\",\"quantity\":\"30\"},{\"inventory_id\":\"37\",\"quantity\":\"20\"},{\"inventory_id\":\"46\",\"quantity\":\"10\"}]', '1478719318OverloadNachos.JPG', '2024-11-01 13:21:53.099242'),
(44, 1, 'LASAGNA', 'WEEKDAYS', 130, 0, '[{\"inventory_id\":\"46\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"150\"},{\"inventory_id\":\"48\",\"quantity\":\"200\"},{\"inventory_id\":\"32\",\"quantity\":\"100\"},{\"inventory_id\":\"49\",\"quantity\":\"50\"},{\"inventory_id\":\"50\",\"quantity\":\"50\"}]', '514318766Lasagna.JPG', '2024-11-01 13:21:09.774317'),
(45, 1, 'BREAKFAST CROFFLE', 'CROFFLE SERIES', 90, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', '1151291481BreakfastCroffle.JPG', '2024-11-01 13:18:44.355617'),
(46, 1, 'DARK CHOCOLATE ALMONDS', 'CROFFLE SERIES', 125, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"54\",\"quantity\":\"10\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', '928965236DarkChocolateAlmonds.JPG', '2024-11-01 13:19:53.544026'),
(47, 1, 'OREO CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"55\",\"quantity\":\"5\"}]', '483719487OreoCroffle.JPG', '2024-11-01 13:21:31.265898'),
(48, 1, 'BLUEBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"56\",\"quantity\":\"5\"}]', '1448352478BlueberryCroffle.JPG', '2024-11-01 13:17:49.047772'),
(49, 1, 'STRAWBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"57\",\"quantity\":\"5\"}]', '770380929StrawberryCroffle.JPG', '2024-11-01 13:22:34.826946'),
(50, 1, 'BISCOFF CROFFLE', 'CROFFLE SERIES', 150, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"16\",\"quantity\":\"5\"},{\"inventory_id\":\"76\",\"quantity\":\"5\"},{\"inventory_id\":\"59\",\"quantity\":\"1\"}]', '1379441436BiscoffCroffle.JPG', '2024-11-01 13:17:12.509619'),
(51, 1, 'CLASSIC EGG TOAST', 'EGG DROP', 130, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"63\",\"quantity\":\"10\"}]', '175959818ClassicEggToast.JPG', '2024-11-01 13:19:30.268973'),
(52, 1, 'SPAM NORI', 'EGG DROP', 160, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"64\",\"quantity\":\"50\"},{\"inventory_id\":\"65\",\"quantity\":\"10\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"66\",\"quantity\":\"10\"}]', '370561624SpamNori.JPG', '2024-11-01 13:22:13.793149'),
(53, 1, 'HAM AND CHEESE', 'EGG DROP', 140, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"67\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"68\",\"quantity\":\"20\"}]', '2056284443HamandCheese.JPG', '2024-11-01 13:20:46.179861');

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
(1, 155.00, 200.00, 45.00, 'Cash', '250455', 0, '2024-11-24 20:16:55.229785'),
(2, 300.00, 400.00, 100.00, 'Card', '250431', 0, '2024-11-24 20:18:31.676961'),
(3, 310.00, 500.00, 190.00, 'Card', '250404', 0, '2024-11-24 20:19:04.193341'),
(4, 155.00, 200.00, 45.00, 'Card', '250435', 0, '2024-11-24 20:20:35.929093'),
(5, 255.00, 300.00, 45.00, 'Card', '250414', 0, '2024-11-24 20:22:14.420120'),
(6, 160.00, 200.00, 40.00, 'Cash', '250422', 0, '2024-11-24 20:23:22.785412'),
(7, 155.00, 200.00, 45.00, 'Card', '250412', 0, '2024-11-24 20:24:12.325495'),
(8, 155.00, 200.00, 45.00, 'Cash', '250415', 0, '2024-11-24 20:25:15.448019'),
(9, 295.00, 300.00, 5.00, 'cash', '250421', 0, '2024-11-24 20:32:21.897211'),
(10, 155.00, 200.00, 45.00, 'Cash', '250420', 0, '2024-11-24 20:34:20.737780'),
(11, 155.00, 200.00, 45.00, 'Cash', '250412', 0, '2024-11-24 20:35:12.320054'),
(12, 310.00, 400.00, 90.00, 'card', '250432', 0, '2024-11-24 20:45:32.902746'),
(13, 155.00, 200.00, 45.00, 'card', '250404', 0, '2024-11-24 20:50:04.391456'),
(14, 130.00, 200.00, 70.00, 'card', '250420', 0, '2024-11-24 20:51:20.957402'),
(15, 160.00, 200.00, 40.00, 'Card', '250420', 0, '2024-11-24 20:53:20.439159'),
(16, 160.00, 200.00, 40.00, 'Card', '250455', 0, '2024-11-24 20:53:55.791887');

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
(1, 1, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(2, 2, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(3, 2, 47, 'OREO CROFFLE', 1, 140.00),
(4, 3, 36, 'BLUEBERRY CHEESECAKE', 1, 160.00),
(5, 3, 50, 'BISCOFF CROFFLE', 1, 150.00),
(6, 4, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(7, 5, 23, 'AMERICANO', 1, 100.00),
(8, 5, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(9, 6, 19, 'STRAWBERRY MATCHA', 1, 160.00),
(10, 7, 40, 'BUTTERSCOTCH', 1, 155.00),
(11, 8, 39, 'WHITE CHOCO MOCHA', 1, 155.00),
(12, 9, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(13, 9, 49, 'STRAWBERRY CROFFLE', 1, 140.00),
(14, 10, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(15, 11, 37, 'JAVA CHIP', 1, 155.00),
(16, 12, 34, 'STRAWBERRIES & CREAM', 1, 155.00),
(17, 12, 40, 'BUTTERSCOTCH', 1, 155.00),
(18, 13, 33, 'SALTED CARAMEL', 1, 155.00),
(19, 14, 1, 'SPANISH LATTE', 1, 130.00),
(20, 15, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(21, 16, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00);

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
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`owner_id`);

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
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
