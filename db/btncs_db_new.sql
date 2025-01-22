-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 09:27 AM
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
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `branch_name` text NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `owner_id`, `branch_name`, `created_at`) VALUES
(1, 1, 'Alangilan', '2025-01-02 20:16:39.666907'),
(2, 1, 'UB', '2025-01-02 20:16:47.380024');

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
(1, 240000.00, 300000.00, 0, '2025-01-02 22:39:14.095004');

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
  `branch_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `item` text NOT NULL,
  `measurement` text NOT NULL,
  `fulfillment` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `low_stock` int(11) NOT NULL,
  `photo` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `branch_id`, `owner_id`, `item`, `measurement`, `fulfillment`, `quantity`, `stocks`, `low_stock`, `photo`, `last_updated`) VALUES
(1, 1, 1, 'Doreen', 'bottle', 750, 150, 3, 1, '702806193Doreen.png', '2025-01-03 03:21:23.186958'),
(2, 1, 1, 'Milk Syrup', 'bottle', 750, 545, 4, 2, '1954975028Milk syrup.jpg', '2025-01-03 03:18:22.011608'),
(3, 1, 1, 'Milk Arla', 'bottle', 750, 610, 3, 2, '2113943345Milk Arla.png', '2025-01-03 03:18:22.013399'),
(4, 1, 1, 'Coffee', 'pack', 750, 594, 8, 2, '524009733Coffee.jpeg', '2025-01-03 03:18:22.014113'),
(5, 1, 1, 'Ice', 'block', 750, 275, 2, 2, '1256192592Ice Cubes.jpg', '2025-01-03 03:21:23.186061'),
(6, 1, 1, 'Everwhip', 'bottle', 750, 30, 3, 1, 'default_image.png', '2025-01-03 02:38:20.746331'),
(7, 1, 1, 'White Chocolate', 'box', 750, 10, 2, 1, '1882457583White Chocolate.jpg', '2025-01-03 02:38:20.747360'),
(8, 1, 1, 'Toffee', 'box', 750, 0, 2, 1, 'default_image.png', '2025-01-02 22:40:14.855857'),
(9, 1, 1, 'Whipped Cream', 'bottle', 750, 60, 3, 1, '2122203380Whipped Cream.jpeg', '2025-01-03 03:21:23.191560'),
(10, 1, 1, 'Caramel Walling', 'bottle', 750, 600, 3, 1, '35449025Caramel Walling.jpg', '2025-01-03 03:18:22.018286'),
(11, 1, 1, 'Seasalt Cream', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:40:53.276976'),
(12, 1, 1, 'Tiramisu Syrup', 'bottle', 750, 0, 4, 1, 'default_image.png', '2025-01-02 22:41:00.461106'),
(13, 1, 1, 'Broas', 'container', 750, 0, 5, 1, 'default_image.png', '2025-01-02 22:41:01.616912'),
(14, 1, 1, 'Cocoa Powder', 'pack', 750, 0, 8, 2, '1891934419Cocoa Powder.jpeg', '2025-01-02 22:41:02.607150'),
(15, 1, 1, 'Vanilla Syrup', 'bottle', 750, 25, 4, 1, '692145424Vanilla Syrup.png', '2025-01-03 02:35:23.161323'),
(16, 1, 1, 'Caramel Syrup', 'bottle', 750, 5, 4, 1, '129931675Caramel Syrup.jpeg', '2025-01-03 02:37:39.238766'),
(17, 1, 1, 'Toffee Syrup', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:41:05.425959'),
(18, 1, 1, 'Honeycomb', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:41:07.859109'),
(19, 1, 1, 'Hazelnut Syrup', 'bottle', 750, 0, 4, 1, 'default_image.png', '2025-01-02 22:41:08.935234'),
(20, 1, 1, 'Strawberry Jam', 'jar', 750, 420, 3, 1, '2046377866Strawberry Jam.jpg', '2025-01-03 03:21:23.183248'),
(21, 1, 1, 'Strawberry', 'box', 750, 35, 2, 1, 'default_image.png', '2025-01-03 03:21:23.190517'),
(22, 1, 1, 'Fructose', 'bottle', 750, 0, 3, 1, '271949627Fructose.jpeg', '2025-01-02 22:41:16.183616'),
(23, 1, 1, 'Ice Cream', 'block', 750, 0, 2, 1, 'default_image.png', '2025-01-02 22:43:01.953652'),
(24, 1, 1, 'Nata', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:43:00.705129'),
(25, 1, 1, 'Thai Sala', 'bottle', 750, 0, 4, 1, 'default_image.png', '2025-01-02 22:42:59.662745'),
(26, 1, 1, 'Matcha Powder', 'pack', 750, 8, 8, 2, '1415667598Matcha Powder.jpeg', '2025-01-03 02:38:08.140609'),
(27, 1, 1, 'Ube Condensed', 'bottle', 750, 30, 3, 1, '148662521Ube Condensed.jpg', '2025-01-03 02:38:20.757326'),
(28, 1, 1, 'Chocolate Syrup', 'bottle', 750, 0, 4, 1, '1930241371Choco Syrup.jpeg', '2025-01-02 22:42:54.776550'),
(29, 1, 1, 'Pink Lemonade', 'box', 750, 0, 2, 1, '178685725Pink Lemonade.jpg', '2025-01-02 22:42:52.492332'),
(30, 1, 1, 'Salted Caramel Sauce', 'bottle', 750, 240, 1, 1, '1058166169Salted Caramel Sauce.jpg', '2025-01-03 03:18:22.010800'),
(31, 1, 1, 'Choco Chips', 'pack', 750, 696, 8, 2, '1109136920Choco Chips.jpg', '2025-01-03 03:18:22.019199'),
(32, 1, 1, 'Cheese', 'container', 750, 220, 5, 1, '1052171030Cheese.jpg', '2025-01-03 03:21:23.184130'),
(33, 1, 1, 'Blueberry Jam', 'jar', 750, 0, 2, 1, '1532838908Blueberry Jam.jpeg', '2025-01-02 22:42:47.612469'),
(34, 1, 1, 'White Chocolate Sauce', 'bottle', 750, 60, 3, 1, '221466754White Chocolate sauce.jpeg', '2025-01-03 02:37:49.959487'),
(35, 1, 1, 'Butterscotch Sauce', 'bottle', 750, 60, 4, 1, 'default_image.png', '2025-01-03 02:36:27.990469'),
(36, 1, 1, 'Fries', 'box', 750, 0, 2, 1, '856361939Fries.jpeg', '2025-01-02 22:42:40.503760'),
(37, 1, 1, 'Sour Cream', 'pack', 750, 0, 8, 1, '1190287284Sour Cream.jpeg', '2025-01-02 22:42:37.072371'),
(38, 1, 1, 'Seasonings', 'pack', 750, 0, 8, 1, '367302281Seasonings.jpg', '2025-01-02 22:42:35.874597'),
(39, 1, 1, 'Ground Beef', 'container', 750, 150, 5, 1, '243057177Ground Beef.jpg', '2025-01-03 02:38:29.106613'),
(40, 1, 1, 'Cheese Sauce', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:42:33.913674'),
(41, 1, 1, 'Nacho Chips', 'pack', 750, 0, 8, 1, '1469267716Nacho chips.jpeg', '2025-01-02 22:42:32.831098'),
(42, 1, 1, 'Onions', 'box', 750, 0, 2, 1, '1670637696Onions.jpeg', '2025-01-02 22:42:30.596362'),
(43, 1, 1, 'Tomatoes', 'box', 750, 0, 2, 1, '258013716Tomato.jpg', '2025-01-02 22:42:29.835507'),
(44, 1, 1, 'Cucumbers', 'box', 750, 0, 2, 1, '548653963Cucumber.jpeg', '2025-01-02 22:42:28.226774'),
(45, 1, 1, 'Salsa', 'container', 750, 0, 4, 1, '1098178018Salsa.jpeg', '2025-01-02 22:42:27.482372'),
(46, 1, 1, 'Jalapenos', 'box', 750, 100, 2, 1, '88830658Jalapenos.jpg', '2025-01-03 02:38:29.105842'),
(47, 1, 1, 'Lasagna Sheets', 'container', 750, 0, 5, 1, '773340493Lasagna Sheets.jpeg', '2025-01-02 22:42:25.965141'),
(48, 1, 1, 'Tomato Sauce', 'bottle', 750, 200, 4, 1, '2064485853Tomato Sauce.jpg', '2025-01-03 02:38:29.107353'),
(49, 1, 1, 'Ricotta Cheese', 'block', 750, 50, 3, 1, '666725220Ricotta Cheese.jpeg', '2025-01-03 02:38:29.108878'),
(50, 1, 1, 'Spinach', 'box', 750, 50, 2, 1, '980471996Spinach.jpeg', '2025-01-03 02:38:29.109706'),
(51, 1, 1, 'Croffle', 'container', 750, 300, 4, 1, '1559869054croffle.jpg', '2025-01-03 03:14:39.490090'),
(52, 1, 1, 'Powdered Sugar', 'bottle', 750, 1, 3, 1, '2043228134Powdered Sugar.jpg', '2025-01-03 03:14:12.051038'),
(53, 1, 1, 'Chocolate Sauce', 'bottle', 750, 3, 3, 1, '1808980848Chocolate Sauce.jpeg', '2025-01-03 03:14:39.491053'),
(54, 1, 1, 'Sliced Almonds', 'container', 750, 10, 5, 1, '871089859Sliced Almonds.jpg', '2025-01-03 03:14:12.050310'),
(55, 1, 1, 'Crushed Oreos', 'container', 750, 10, 4, 1, '1894511401Crushed Oreos.jpg', '2025-01-03 03:14:39.492942'),
(56, 1, 1, 'Blueberry Syrup', 'bottle', 750, 5, 4, 1, '2042419042Blueberry Syrup.jpg', '2025-01-03 02:36:28.003114'),
(57, 1, 1, 'Strawberry Syrup', 'bottle', 750, 5, 3, 1, '562669123Strawberry Syrup.jpeg', '2025-01-03 02:37:49.970385'),
(58, 1, 1, 'Caramel Sauce', 'bottle', 750, 0, 3, 1, 'default_image.png', '2025-01-02 22:42:09.610306'),
(59, 1, 1, 'Whole Biscoff  Cookie', 'container', 750, 1, 5, 1, '1397369084Whole Biscoff Cookie.png', '2025-01-03 02:37:39.240413'),
(60, 1, 1, 'Brioche Bread', 'container', 750, 0, 4, 1, '1696705689Brioche Bread.png', '2025-01-02 22:42:07.388196'),
(61, 1, 1, 'Scrambled Egg', 'container', 750, 0, 5, 1, 'default_image.png', '2025-01-02 22:42:04.931639'),
(62, 1, 1, 'Signature Sauce', 'bottle', 750, 0, 4, 1, '447137729Signature Sauce.jpg', '2025-01-02 22:42:03.856922'),
(63, 1, 1, 'Butter', 'bottle', 750, 0, 3, 1, '119005865Butter.jpg', '2025-01-02 22:42:00.421354'),
(64, 1, 1, 'Spam', 'container', 750, 0, 4, 1, '1286506431Spam.jpg', '2025-01-02 22:41:59.393537'),
(65, 1, 1, 'Roasted Nori', 'pack', 750, 0, 3, 1, '1691413221Roasted Nori.jpg', '2025-01-02 22:41:58.480985'),
(66, 1, 1, 'Mayonnaise', 'bottle', 750, 0, 3, 1, '1834727059Mayo.jpg', '2025-01-02 22:41:57.372056'),
(67, 1, 1, 'Ham', 'pack', 750, 0, 6, 1, '379862287Ham.jpeg', '2025-01-02 22:41:55.141352'),
(68, 1, 1, 'Avocado', 'box', 750, 0, 3, 1, '347342382Avocado.jpg', '2025-01-02 22:43:09.691887'),
(69, 1, 1, 'Cup', 'box', 70, 12, 3, 1, '1802055352Cup Only.png', '2025-01-03 03:21:23.187831'),
(70, 1, 1, 'Straw', 'box', 70, 12, 3, 1, '122086463Straw.jpeg', '2025-01-03 03:21:23.188785'),
(71, 1, 1, 'Lid', 'box', 70, 12, 3, 1, '1423079393Coffee Lid.png', '2025-01-03 03:21:23.189622'),
(72, 1, 1, 'Seasalt Sauce', 'bottle', 750, 0, 4, 1, 'default_image.png', '2025-01-02 22:41:31.060613'),
(73, 1, 1, 'Soda', 'block', 750, 0, 3, 1, '519393515Soda.jpg', '2025-01-02 22:41:29.931192'),
(74, 1, 1, 'Cheesecake', 'container', 750, 6, 5, 1, '571684407Cheesecake.jpg', '2025-01-03 03:21:23.185127'),
(75, 1, 1, 'Choco Powder', 'pack', 750, 0, 8, 2, 'default_image.png', '2025-01-02 22:41:27.121131'),
(76, 1, 1, 'Crushed Biscoff', 'container', 750, 5, 4, 1, '1884116333Crushed Biscoff.jpeg', '2025-01-03 02:37:39.239641');

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
  `branch_id` int(11) NOT NULL,
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

INSERT INTO `product` (`product_id`, `branch_id`, `owner_id`, `product_name`, `category_name`, `price`, `status`, `product_ingredients`, `photo`, `last_updated`) VALUES
(1, 1, 1, 'SPANISH LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '85106263SpanishLatte.JPG', '2025-01-02 21:03:55.679937'),
(2, 1, 1, 'BARISTA DRINK', 'OUR SIGNATURE', 120, 0, '[{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"7\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"50\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '80676847BaristaDrink.JPG', '2025-01-02 21:03:57.609734'),
(3, 1, 1, 'TOFFEE NUT CARAMEL', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"8\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1398337807ToffeeNutCaramel.JPG', '2025-01-02 21:03:58.695068'),
(4, 1, 1, 'TIRAMISU LATTE', 'OUR SIGNATURE', 160, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"12\",\"quantity\":\"20\"},{\"inventory_id\":\"13\",\"quantity\":\"1\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '606902519TiramisuLatte.JPG', '2025-01-02 21:03:59.718452'),
(5, 1, 1, 'VANI LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"15\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1457273406VaniLatte.JPG', '2025-01-02 21:04:00.681767'),
(6, 1, 1, 'CARAMEL LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"280\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '425915820CaramelLatte.JPG', '2025-01-02 21:04:01.732746'),
(7, 1, 1, 'TOFFEE LATTE', 'OUR SIGNATURE', 130, 0, '[{\"inventory_id\":\"17\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '234777159ToffeeLatte.JPG', '2025-01-02 21:04:03.766679'),
(8, 1, 1, 'MOCAFINO LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"2\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '411691391MocafinoLatte.JPG', '2025-01-02 21:04:05.116498'),
(9, 1, 1, 'SEASALT LATTE', 'OUR SIGNATURE', 150, 0, '[{\"inventory_id\":\"11\",\"quantity\":\"40\"},{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"72\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '269835815SeaSaltLatte.JPG', '2025-01-02 21:04:06.174735'),
(10, 1, 1, 'HONEYCOMB LATTE', 'OUR SIGNATURE', 145, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"18\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '2069222003HoneyCombLatte.JPG', '2025-01-02 21:04:07.186388'),
(11, 1, 1, 'PURPLE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"27\",\"quantity\":\"30\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '906337839PurpleLatte.JPG', '2025-01-02 21:04:08.036109'),
(12, 1, 1, 'ON THE HOUSE LATTE', 'OUR SIGNATURE', 140, 0, '[{\"inventory_id\":\"2\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"19\",\"quantity\":\"10\"},{\"inventory_id\":\"15\",\"quantity\":\"10\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '804101713OnTheHouseLatte.JPG', '2025-01-02 21:04:08.889768'),
(13, 1, 1, 'BERRY LATTE', 'LATTE SERIES', 150, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1216232860BerryLatte.JPG', '2025-01-02 21:04:09.737523'),
(14, 1, 1, 'DOUBLE CHOCO LAVA', 'LATTE SERIES', 140, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"}]', '1494621505DoubleChocoLava.JPG', '2025-01-02 21:04:10.965539'),
(15, 1, 1, 'DOUBLE CHOCO FLOAT', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"14\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"23\",\"quantity\":\"35\"}]', '1706273194DoubleChocoFloat.JPG', '2025-01-02 21:04:11.890859'),
(16, 1, 1, 'THAI PINKY', 'LATTE SERIES', 120, 0, '[{\"inventory_id\":\"24\",\"quantity\":\"60\"},{\"inventory_id\":\"25\",\"quantity\":\"45\"},{\"inventory_id\":\"2\",\"quantity\":\"15\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '2118240959ThaiPinky.JPG', '2025-01-02 21:04:12.785764'),
(17, 1, 1, 'ICHIGO COCOA', 'LATTE SERIES', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"2\",\"quantity\":\"30\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '165263310IchigoCocoa.JPG', '2025-01-02 21:04:13.619705'),
(18, 1, 1, 'MATCHA GREEN LATTE', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"22\",\"quantity\":\"10\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1706098038MatchGreenLatte.JPG', '2025-01-02 21:04:14.582864'),
(19, 1, 1, 'STRAWBERRY MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', '1221531044StrawberryMatcha.JPG', '2025-01-02 21:04:17.851344'),
(20, 1, 1, 'PINKY MATCHA', 'MATCHA SERIES', 150, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"26\",\"quantity\":\"4\"}]', '1413806522PinkyMatcha.JPG', '2025-01-02 21:04:18.807782'),
(21, 1, 1, 'PURPLE MATCHA', 'MATCHA SERIES', 160, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"6\",\"quantity\":\"30\"},{\"inventory_id\":\"27\",\"quantity\":\"15\"}]', '1776600277PurpleMatcha.JPG', '2025-01-02 21:04:19.509039'),
(22, 1, 1, 'DIRTY MATCHA', 'MATCHA SERIES', 170, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"125\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"}]', '1554261404DirtyMatcha.JPG', '2025-01-02 21:04:20.531382'),
(23, 1, 1, 'AMERICANO', 'HOT COFFEE', 100, 0, '[{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1165423849Americano.JPG', '2025-01-02 21:04:21.342204'),
(24, 1, 1, 'LATTE', 'HOT COFFEE', 115, 0, '[{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', 'default_image.png', '2025-01-02 21:04:22.126609'),
(26, 1, 1, 'DARK MOCHA', 'HOT COFFEE', 120, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"14\",\"quantity\":\"5\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '739171511DarkMocha.JPG', '2025-01-02 21:04:26.669573'),
(27, 1, 1, 'HOT SPANISH LATTE', 'HOT COFFEE', 125, 0, '[{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"4\",\"quantity\":\"12\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '682425002SpanishLatte.JPG', '2025-01-02 21:04:35.849940'),
(28, 1, 1, 'WHITE MOCHA', 'HOT COFFEE', 135, 0, '[{\"inventory_id\":\"7\",\"quantity\":\"30\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', '748102268Mocha.JPG', '2025-01-02 21:04:37.007173'),
(29, 1, 1, 'MACCHIATO', 'HOT COFFEE', 130, 0, '[{\"inventory_id\":\"16\",\"quantity\":\"20\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"}]', '1756698449Machiatto.JPG', '2025-01-02 21:04:37.912854'),
(30, 1, 1, 'HOT MATCHA GREEN LATTE', 'HOT COFFEE', 145, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"3\",\"quantity\":\"150\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1586803506MatchaGreen.JPG', '2025-01-02 21:04:38.714130'),
(31, 1, 1, 'PINK LEMONADE SLUSHIE', 'SEASONAL DRINKS', 160, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"}]', '1578979235PinkLemonadeSlushie.JPG', '2025-01-02 21:04:40.249837'),
(32, 1, 1, 'PINK LEMONADE FRIZ', 'SEASONAL DRINKS', 150, 0, '[{\"inventory_id\":\"29\",\"quantity\":\"48\"},{\"inventory_id\":\"73\",\"quantity\":\"180\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1354532358PinkLemonadeFriz.JPG', '2025-01-02 21:04:41.664233'),
(33, 1, 1, 'SALTED CARAMEL', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"30\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"}]', '881243495SaltedCaramel.JPG', '2025-01-02 21:04:42.340747'),
(34, 1, 1, 'STRAWBERRIES & CREAM', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"2\",\"quantity\":\"60\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"}]', '1901592446Strawberries&Cream.JPG', '2025-01-02 21:04:42.999942'),
(35, 1, 1, 'STRAWBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"20\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"21\",\"quantity\":\"5\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', '2063445121StrawberryCheesecake.JPG', '2025-01-02 21:04:43.672420'),
(36, 1, 1, 'BLUEBERRY CHEESECAKE', 'BLENDED DRINKS', 160, 0, '[{\"inventory_id\":\"33\",\"quantity\":\"60\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"74\",\"quantity\":\"1\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"},{\"inventory_id\":\"1\",\"quantity\":\"25\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"}]', '899585060BlueberryCheesecake.JPG', '2025-01-02 21:04:45.762749'),
(37, 1, 1, 'JAVA CHIP', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"28\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"14\",\"quantity\":\"10\"},{\"inventory_id\":\"31\",\"quantity\":\"24\"},{\"inventory_id\":\"75\",\"quantity\":\"60\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '1327835747JavaChip.JPG', '2025-01-02 21:04:47.167043'),
(38, 1, 1, 'VANILLA MATCHA CREME', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"26\",\"quantity\":\"4\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"15\",\"quantity\":\"25\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '652415703VanillaMatchaCreme.JPG', '2025-01-02 21:04:48.824724'),
(39, 1, 1, 'WHITE CHOCO MOCHA', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"34\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '45057962WhiteChocoMocha.JPG', '2025-01-02 21:04:47.912158'),
(40, 1, 1, 'BUTTERSCOTCH', 'BLENDED DRINKS', 155, 0, '[{\"inventory_id\":\"35\",\"quantity\":\"60\"},{\"inventory_id\":\"2\",\"quantity\":\"40\"},{\"inventory_id\":\"3\",\"quantity\":\"100\"},{\"inventory_id\":\"4\",\"quantity\":\"18\"},{\"inventory_id\":\"5\",\"quantity\":\"60\"},{\"inventory_id\":\"9\",\"quantity\":\"20\"},{\"inventory_id\":\"10\",\"quantity\":\"20\"},{\"inventory_id\":\"69\",\"quantity\":\"1\"},{\"inventory_id\":\"70\",\"quantity\":\"1\"},{\"inventory_id\":\"71\",\"quantity\":\"1\"}]', '2068260072Butterscotch.JPG', '2025-01-02 21:04:50.963297'),
(41, 1, 1, 'FLAVORED FRIES', 'STARTERS', 100, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"37\",\"quantity\":\"30\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', '1553949242FlavoredFries.JPG', '2025-01-02 21:04:50.010895'),
(42, 1, 1, 'CHEESY BEEF FRIES', 'STARTERS', 150, 0, '[{\"inventory_id\":\"36\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"40\",\"quantity\":\"50\"},{\"inventory_id\":\"38\",\"quantity\":\"1\"}]', '37501886CheesyBeefFries.JPG', '2025-01-02 21:04:51.736208'),
(43, 1, 1, 'OVERLOAD NACHOS', 'STARTERS', 150, 0, '[{\"inventory_id\":\"41\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"50\"},{\"inventory_id\":\"42\",\"quantity\":\"20\"},{\"inventory_id\":\"43\",\"quantity\":\"20\"},{\"inventory_id\":\"44\",\"quantity\":\"20\"},{\"inventory_id\":\"32\",\"quantity\":\"30\"},{\"inventory_id\":\"45\",\"quantity\":\"30\"},{\"inventory_id\":\"37\",\"quantity\":\"20\"},{\"inventory_id\":\"46\",\"quantity\":\"10\"}]', '1478719318OverloadNachos.JPG', '2025-01-02 21:04:52.569080'),
(44, 1, 1, 'LASAGNA', 'WEEKDAYS', 130, 0, '[{\"inventory_id\":\"46\",\"quantity\":\"100\"},{\"inventory_id\":\"39\",\"quantity\":\"150\"},{\"inventory_id\":\"48\",\"quantity\":\"200\"},{\"inventory_id\":\"32\",\"quantity\":\"100\"},{\"inventory_id\":\"49\",\"quantity\":\"50\"},{\"inventory_id\":\"50\",\"quantity\":\"50\"}]', '514318766Lasagna.JPG', '2025-01-02 21:04:53.353948'),
(45, 1, 1, 'BREAKFAST CROFFLE', 'CROFFLE SERIES', 90, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', '1151291481BreakfastCroffle.JPG', '2025-01-02 21:04:54.249615'),
(46, 1, 1, 'DARK CHOCOLATE ALMONDS', 'CROFFLE SERIES', 125, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"54\",\"quantity\":\"10\"},{\"inventory_id\":\"52\",\"quantity\":\"1\"}]', '928965236DarkChocolateAlmonds.JPG', '2025-01-02 21:04:57.224374'),
(47, 1, 1, 'OREO CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"53\",\"quantity\":\"1\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"55\",\"quantity\":\"5\"}]', '483719487OreoCroffle.JPG', '2025-01-02 21:04:59.134418'),
(48, 1, 1, 'BLUEBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"56\",\"quantity\":\"5\"}]', '1448352478BlueberryCroffle.JPG', '2025-01-02 21:04:58.250555'),
(49, 1, 1, 'STRAWBERRY CROFFLE', 'CROFFLE SERIES', 140, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"57\",\"quantity\":\"5\"}]', '770380929StrawberryCroffle.JPG', '2025-01-02 21:05:00.157092'),
(50, 1, 1, 'BISCOFF CROFFLE', 'CROFFLE SERIES', 150, 0, '[{\"inventory_id\":\"51\",\"quantity\":\"50\"},{\"inventory_id\":\"9\",\"quantity\":\"10\"},{\"inventory_id\":\"16\",\"quantity\":\"5\"},{\"inventory_id\":\"76\",\"quantity\":\"5\"},{\"inventory_id\":\"59\",\"quantity\":\"1\"}]', '1379441436BiscoffCroffle.JPG', '2025-01-02 21:05:00.919196'),
(51, 1, 1, 'CLASSIC EGG TOAST', 'EGG DROP', 130, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"63\",\"quantity\":\"10\"}]', '175959818ClassicEggToast.JPG', '2025-01-02 21:05:01.653097'),
(52, 1, 1, 'SPAM NORI', 'EGG DROP', 160, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"64\",\"quantity\":\"50\"},{\"inventory_id\":\"65\",\"quantity\":\"10\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"66\",\"quantity\":\"10\"}]', '370561624SpamNori.JPG', '2025-01-02 21:05:02.456944'),
(53, 1, 1, 'HAM AND CHEESE', 'EGG DROP', 140, 0, '[{\"inventory_id\":\"60\",\"quantity\":\"50\"},{\"inventory_id\":\"67\",\"quantity\":\"50\"},{\"inventory_id\":\"61\",\"quantity\":\"50\"},{\"inventory_id\":\"32\",\"quantity\":\"20\"},{\"inventory_id\":\"62\",\"quantity\":\"20\"},{\"inventory_id\":\"68\",\"quantity\":\"20\"}]', '2056284443HamandCheese.JPG', '2025-01-02 21:05:05.895229');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
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

INSERT INTO `sales` (`sale_id`, `branch_id`, `total_amount`, `customer_pay`, `change_amount`, `payment_method`, `queue_no`, `status`, `transaction_date`) VALUES
(1, 1, 155.00, 200.00, 45.00, 'Cash', '250455', 1, '2024-10-01 23:04:38.938948'),
(2, 1, 300.00, 400.00, 100.00, 'Card', '250431', 0, '2024-10-07 23:03:23.195389'),
(3, 1, 310.00, 500.00, 190.00, 'Card', '250404', 0, '2024-10-10 23:03:24.024495'),
(4, 1, 155.00, 200.00, 45.00, 'Card', '250435', 0, '2024-10-14 23:03:26.650671'),
(5, 1, 255.00, 300.00, 45.00, 'Card', '250414', 0, '2024-10-18 23:03:24.999202'),
(6, 1, 160.00, 200.00, 40.00, 'Cash', '250422', 0, '2024-10-22 23:03:27.435251'),
(7, 1, 155.00, 200.00, 45.00, 'Card', '250412', 0, '2024-10-24 23:03:28.222252'),
(8, 1, 155.00, 200.00, 45.00, 'Cash', '250415', 0, '2024-10-27 23:03:29.037814'),
(9, 1, 295.00, 300.00, 5.00, 'Cash', '250421', 0, '2024-10-29 02:08:55.316707'),
(10, 1, 155.00, 200.00, 45.00, 'Cash', '250420', 0, '2024-10-30 23:03:32.875917'),
(11, 1, 155.00, 200.00, 45.00, 'Cash', '250412', 0, '2024-11-01 23:03:34.521522'),
(12, 1, 310.00, 400.00, 90.00, 'Card', '250432', 0, '2024-11-05 02:08:50.492196'),
(13, 1, 155.00, 200.00, 45.00, 'Card', '250404', 0, '2024-11-08 02:08:45.295219'),
(14, 1, 130.00, 200.00, 70.00, 'Card', '250420', 0, '2024-11-11 02:08:48.104251'),
(15, 1, 160.00, 200.00, 40.00, 'Card', '250420', 0, '2024-11-12 23:03:38.736418'),
(16, 1, 160.00, 200.00, 40.00, 'Card', '250455', 1, '2024-11-15 23:03:41.610239'),
(17, 0, 155.00, 200.00, 45.00, 'Cash', '030738', 0, '2024-11-18 23:25:38.431382'),
(18, 0, 620.00, 700.00, 80.00, 'Cash', '030705', 0, '2024-11-23 23:26:05.929804'),
(19, 0, 465.00, 500.00, 35.00, 'Cash', '030741', 0, '2024-11-25 23:26:41.007933'),
(20, 0, 930.00, 1000.00, 70.00, 'Cash', '031038', 0, '2024-11-29 02:19:38.225746'),
(21, 0, 310.00, 400.00, 90.00, 'Cash', '031027', 0, '2024-12-01 02:20:27.687912'),
(22, 0, 310.00, 400.00, 90.00, 'Cash', '031035', 0, '2024-12-03 02:27:35.232892'),
(23, 0, 155.00, 200.00, 45.00, 'Cash', '031009', 0, '2024-12-05 02:28:09.967039'),
(24, 0, 315.00, 400.00, 85.00, 'Cash', '031023', 0, '2024-12-06 02:35:23.145859'),
(25, 0, 140.00, 200.00, 60.00, 'Cash', '031029', 0, '2024-12-08 02:35:29.602890'),
(26, 0, 295.00, 300.00, 5.00, 'Cash', '031027', 0, '2024-12-10 02:36:27.987705'),
(27, 0, 150.00, 200.00, 50.00, 'Cash', '031039', 0, '2024-12-13 02:37:39.233528'),
(28, 0, 295.00, 300.00, 5.00, 'Cash', '031049', 0, '2024-12-16 02:37:49.957094'),
(29, 0, 160.00, 200.00, 40.00, 'Cash', '031008', 0, '2024-12-19 02:38:08.131373'),
(30, 0, 260.00, 300.00, 40.00, 'Cash', '031020', 0, '2024-12-20 02:38:20.741657'),
(31, 0, 130.00, 150.00, 20.00, 'Cash', '031029', 0, '2024-12-22 02:38:29.103706'),
(32, 0, 160.00, 200.00, 40.00, 'Cash', '031055', 0, '2025-01-03 02:53:55.913371'),
(33, 0, 285.00, 300.00, 15.00, 'Cash', '031112', 0, '2025-01-03 03:14:12.035341'),
(34, 0, 300.00, 400.00, 100.00, 'Cash', '031139', 0, '2025-01-03 03:14:39.479354'),
(35, 0, 470.00, 500.00, 30.00, 'Cash', '031126', 0, '2025-01-03 03:17:26.979321'),
(36, 0, 1240.00, 1300.00, 60.00, 'Cash', '031122', 0, '2025-01-03 03:18:22.006956'),
(37, 0, 160.00, 200.00, 40.00, 'Cash', '031123', 0, '2025-01-03 03:21:23.179316');

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
(21, 16, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(22, 17, 33, 'SALTED CARAMEL', 1, 155.00),
(23, 18, 33, 'SALTED CARAMEL', 4, 155.00),
(24, 19, 33, 'SALTED CARAMEL', 3, 155.00),
(25, 20, 33, 'SALTED CARAMEL', 6, 155.00),
(26, 21, 33, 'SALTED CARAMEL', 2, 155.00),
(27, 22, 33, 'SALTED CARAMEL', 2, 155.00),
(28, 23, 33, 'SALTED CARAMEL', 1, 155.00),
(29, 24, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(30, 24, 38, 'VANILLA MATCHA CREME', 1, 155.00),
(31, 25, 47, 'OREO CROFFLE', 1, 140.00),
(32, 26, 40, 'BUTTERSCOTCH', 1, 155.00),
(33, 26, 48, 'BLUEBERRY CROFFLE', 1, 140.00),
(34, 27, 50, 'BISCOFF CROFFLE', 1, 150.00),
(35, 28, 39, 'WHITE CHOCO MOCHA', 1, 155.00),
(36, 28, 49, 'STRAWBERRY CROFFLE', 1, 140.00),
(37, 29, 19, 'STRAWBERRY MATCHA', 1, 160.00),
(38, 30, 2, 'BARISTA DRINK', 1, 120.00),
(39, 30, 11, 'PURPLE LATTE', 1, 140.00),
(40, 31, 44, 'LASAGNA', 1, 130.00),
(41, 32, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(42, 33, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(43, 33, 46, 'DARK CHOCOLATE ALMONDS', 1, 125.00),
(44, 34, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(45, 34, 47, 'OREO CROFFLE', 1, 140.00),
(46, 35, 33, 'SALTED CARAMEL', 2, 155.00),
(47, 35, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00),
(48, 36, 33, 'SALTED CARAMEL', 8, 155.00),
(49, 37, 35, 'STRAWBERRY CHEESECAKE', 1, 160.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
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

INSERT INTO `staff` (`staff_id`, `branch_id`, `status`, `username`, `password`, `email`, `firstname`, `lastname`, `contact_number`, `photo`, `last_updated`) VALUES
(3, 1, 0, 'staffmanager', '$2y$10$yMpkAqw7P/oU7jdp1JlePOK3t4Qj8oJ/KfJPJkkx03b9KDgPO6r4e', 'juandelacruz@gmail.com', 'Juan', 'Dela Cruz', '+639876543212', '1909312970defaut_image.jpg', '2025-01-02 20:17:29.982783');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
