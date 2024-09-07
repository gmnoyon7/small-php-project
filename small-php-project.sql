-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 03:51 PM
-- Server version: 10.6.16-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `small-php-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `email`, `mobile`, `address`) VALUES
(1, 'G M Noyon', 'gmnoyon7@gmail.com', 2147483647, 'Jurain');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacture`
--

CREATE TABLE `tbl_manufacture` (
  `id` int(11) NOT NULL,
  `customId` varchar(255) NOT NULL,
  `retailProId` int(11) NOT NULL,
  `retailProduct` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_manufacture`
--

INSERT INTO `tbl_manufacture` (`id`, `customId`, `retailProId`, `retailProduct`, `quantity`, `unitPrice`, `price`) VALUES
(1, '1', 0, 'Cloth', 250, 0, 3000),
(2, '1', 0, 'Iphone', 300, 0, 5000),
(3, '1', 0, 'Cloth', 100, 0, 5),
(4, '1', 0, 'Cloth', 250, 0, 3000),
(5, '1', 0, 'Iphone', 300, 0, 5000),
(6, '1', 0, 'Cloth', 100, 0, 5),
(7, '2', 0, 'Cloth', 300, 0, 5),
(10, '2', 0, 'Cloth', 220, 0, 3),
(11, '4', 0, 'Microsoft Surface Book 2', 5, 0, 10),
(12, '4', 0, 'Cloth', 200, 0, 4),
(13, '4', 0, 'Hard Disk', 1, 0, 4000),
(14, '1', 0, 'Hard Disk', 3, 0, 40),
(15, '1', 0, 'Motherboard', 5, 0, 56),
(16, '1', 0, 'Keyboard', 5, 0, 23),
(38, '090f5d', 0, 'Hard Disk', 1, 4000, 4000),
(39, '090f5d', 0, 'Processor', 1, 2500, 2500),
(40, '090f5d', 0, 'Motherboard', 1, 6500, 6500),
(41, '090f5d', 0, 'Mouse', 1, 250, 250),
(42, '090f5d', 0, 'Keyboard', 1, 540, 540),
(48, '4117fc', 0, 'Motherboard', 1, 6500, 6500),
(49, '4117fc', 0, 'Hard Disk', 1, 4000, 4000),
(50, '4117fc', 0, 'Processor', 1, 2500, 2500),
(51, '4117fc', 0, 'Printer', 1, 5000, 5000),
(52, '4117fc', 0, 'Keyboard', 1, 540, 540),
(53, '4117fc', 0, 'Mouse', 1, 250, 250),
(58, '5da13e', 0, 'Printer', 2, 5000, 10000),
(59, '5da13e', 0, 'Processor', 5, 2500, 12500),
(60, '55d6d3', 9, 'Printer', 1, 5000, 5000),
(61, '55d6d3', 8, 'Hard Disk', 1, 4000, 4000),
(62, '55d6d3', 7, 'Processor', 1, 2500, 2500),
(65, 'c60b23', 9, 'Printer', 1, 5000, 5000),
(66, 'c60b23', 8, 'Hard Disk', 1, 4000, 4000),
(67, '35745d', 9, 'Printer', 1, 5000, 5000),
(69, 'a6b272', 9, 'Printer', 2, 5000, 10000),
(70, '8bdb49', 9, 'Printer', 1, 5000, 5000),
(73, '5d91e3', 10, 'Epson', 10, 12500, 125000),
(74, '339bfe', 8, 'Hard Disk', 2, 4000, 8000),
(75, '7c1f40', 17, 'Samsung Galaxy S8', 1, 10, 10),
(76, '7c1f40', 16, 'Twin Mos Ram', 2, 10, 20),
(77, '7c1f40', 15, 'Power Supply', 1, 5, 5),
(78, '7c1f40', 17, 'Samsung Galaxy S8', 1, 10, 10),
(79, '7c1f40', 16, 'Twin Mos Ram', 2, 10, 20),
(80, '7c1f40', 15, 'Power Supply', 1, 5, 5),
(81, 'e42903', 17, 'Samsung Galaxy S8', 1, 10, 10),
(82, 'e42903', 16, 'Twin Mos Ram', 1, 10, 10),
(83, 'e42903', 15, 'Power Supply', 1, 5, 5),
(84, 'e42903', 18, 'Sanjeeda Sheikh', 60, 7, 420),
(88, '9651b7', 24, 'Akshay', 1, 4, 4),
(89, '9651b7', 23, 'Iphone X', 1, 5, 5),
(90, '9651b7', 15, 'Power Supply', 1, 5, 5),
(91, 'd80adb', 26, 'A Retail Product', 2, 5, 10),
(92, 'e577c9', 27, 'A Retail Product', 2, 5, 10),
(93, '5c294d', 27, 'A Retail Product', 1, 5, 5),
(94, '5c294d', 24, 'Akshay', 1, 4, 4),
(95, '5c294d', 18, 'Sanjeeda Sheikh', 1, 7, 7),
(96, '5404a2', 27, 'A Retail Product', 1, 5, 5),
(97, '5404a2', 24, 'Akshay', 1, 4, 4),
(99, '3dc112', 24, 'Akshay', 2, 4, 8),
(100, 'd683cc', 32, 'Cactus White', 5, 12, 60),
(101, 'd683cc', 31, 'Aloe vera - herbal', 20, 25, 500),
(102, 'd683cc', 30, 'Haworthia Wide Zebra', 25, 35, 875);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacture_product_name`
--

CREATE TABLE `tbl_manufacture_product_name` (
  `id` int(11) NOT NULL,
  `customId` varchar(255) NOT NULL,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lastUpdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `productName` text NOT NULL,
  `productDetails` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `manufactureThumb` varchar(255) NOT NULL,
  `actualPrice` float NOT NULL,
  `factoryCost` float NOT NULL,
  `labourCost` float NOT NULL,
  `othersOne` float NOT NULL,
  `othersTwo` float NOT NULL,
  `totalCost` float NOT NULL,
  `profit` float NOT NULL,
  `productPrice` float NOT NULL,
  `discount` float NOT NULL,
  `salePrice` float NOT NULL,
  `profitMargin` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_manufacture_product_name`
--

INSERT INTO `tbl_manufacture_product_name` (`id`, `customId`, `entryDate`, `lastUpdate`, `productName`, `productDetails`, `quantity`, `manufactureThumb`, `actualPrice`, `factoryCost`, `labourCost`, `othersOne`, `othersTwo`, `totalCost`, `profit`, `productPrice`, `discount`, `salePrice`, `profitMargin`) VALUES
(1, '1', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'A  full product', 'orem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wi', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '1', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'A  full product', 'sfs', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '2', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Nokia Product', 'This is a nokia product', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '4', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'ABC', 'testing product', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '1', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'ABC-2', 'testing products', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'a21928', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Samsung Galaxy', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 280, '', 28040, 50, 100, 80, 40, 28310, 200, 0, 0, 28510, 0),
(7, 'a21928', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Apple Iphone', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magn', 70, '', 34540, 10, 100, 15, 40, 34705, 50, 0, 0, 34755, 0),
(8, 'a21928', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Panasonic TV', 'orem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi', 50, '', 16040, 12, 10, 20, 78, 16160, 89, 0, 0, 16249, 0),
(9, 'a21928', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Persoanl Computer Mohammodpur', 'orem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonu', 10, '', 20040, 0, 0, 0, 0, 20040, 50, 0, 0, 20090, 0),
(10, '090f5d', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'A Computer', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna', 59, '', 13790, 20, 10, 50, 10, 13880, 100, 0, 0, 13980, 0),
(11, '090f5d', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Computer for Jurain', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna', 72, '', 13790, 15, 10, 8, 5, 13828, 50, 0, 0, 13878, 0),
(12, '4117fc', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'MY PC', 'Personal', 20, '', 18790, 150, 150, 100, 110, 19300, 700, 0, 0, 20000, 0),
(13, '5da13e', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'xyz', 'test', 5, '', 22500, 200, 100, 100, 100, 22910, 90, 0, 0, 23000, 0),
(14, '55d6d3', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Computer Set', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna', 5, '', 11500, 20, 10, 20, 10, 11560, 20, 0, 0, 11580, 0),
(15, 'c60b23', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'FutureNet Product', 'dscbdkvbd', 1, '', 9000, 0, 0, 0, 0, 9000, 20, 0, 0, 9020, 0),
(16, '35745d', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'FutureNet Product 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tin', 1, '', 5000, 0, 0, 0, 0, 5000, 20, 0, 0, 5020, 0),
(17, 'a6b272', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Canon', '2772', 1, '', 10000, 100, 100, 100, 0, 10300, 200, 0, 0, 10500, 0),
(18, '8bdb49', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'hp', 'laser', 2, '', 5000, 100, 100, 0, 0, 5200, 300, 0, 0, 5500, 0),
(19, '5d91e3', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'fnet printer', 'mcvsdbjk', 2, '', 125000, 100, 1000, 400, 500, 127000, 3000, 0, 0, 130000, 0),
(20, '339bfe', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'fnet HD', 'jgi', 2, '', 8000, 0, 0, 0, 0, 8000, 1000, 0, 0, 9000, 0),
(21, 'deef80', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Epson Computer', 'mdflsd', 10, '', 12500, 10, 0, 20, 0, 12530, 40, 0, 0, 12570, 0),
(22, 'deef80', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'A  full product', 'lorem', 10, '', 12555, 19, 0, 0, 0, 12574, 50, 0, 0, 12624, 0),
(23, '7c1f40', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Important product', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna', 10, '', 30, 50, 30, 10, 5, 125, 50, 175, 5, 166.25, 41.25),
(24, '7c1f40', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Good pro', 'md;smc', 5, '', 35, 20, 10, 20, 10, 95, 10, 105, 1, 103.95, 8.95),
(25, '7c1f40', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Excellent Product', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 3, '', 35, 20, 10, 20, 30, 115, 100, 215, 2, 210.7, 95.7),
(26, '7c1f40', '2017-12-09 06:31:28', '0000-00-00 00:00:00', 'Moha Product', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 5, '', 35, 50, 30, 20, 15, 150, 50, 200, 5, 190, 40),
(27, 'e42903', '2017-12-09 07:22:19', '0000-00-00 00:00:00', 'Big Product', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 5, 'upload/manufacture/00008c7a92.jpg', 445, 30, 20, 15, 10, 520, 50, 570, 2, 558.6, 38.6),
(28, '9651b7', '2017-12-09 07:46:42', '0000-00-00 00:00:00', 'Robi axatia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 5, 'upload/manufacture/e1f037d579.jpg', 14, 40, 20, 10, 20, 104, 50, 154, 2, 150.92, 46.92),
(29, 'd80adb', '2017-12-09 09:51:59', '0000-00-00 00:00:00', 'Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 26, 'upload/manufacture/c4baffaf5e.', 10, 10, 20, 0, 5, 45, 15, 60, 2, 58.8, 13.8),
(30, 'e577c9', '2017-12-09 09:57:32', '0000-00-00 00:00:00', 'A test product', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis', 25, 'upload/manufacture/495fc44f56.jpg', 10, 10, 10, 20, 5, 55, 50, 105, 2, 102.9, 47.9),
(31, '5c294d', '2017-12-13 09:33:35', '0000-00-00 00:00:00', 'Iphone 8', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis ', 20, 'upload/manufacture/ce282c2816.jpg', 16, 20, 10, 20, 40, 106, 50, 156, 10, 140.4, 34.4),
(32, '5404a2', '2017-12-12 19:53:31', '0000-00-00 00:00:00', 'A fort', 'dsmls', 10, 'upload/manufacture/9a50b45158.', 9, 10, 20, 30, 10, 79, 10, 89, 1, 88.11, 9.11),
(33, '3dc112', '2017-12-13 06:47:03', '0000-00-00 00:00:00', 'A product of akshay', 'csd', 10, 'upload/manufacture/432a21bffa.jpg', 8, 10, 5, 2, 1, 26, 15, 41, 2, 40.18, 14.18),
(34, 'd683cc', '2024-09-07 12:28:29', '0000-00-00 00:00:00', 'Home Gardening', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un\r\n', 20, 'upload/manufacture/6f5999c805.jpg', 1435, 100, 200, 50, 20, 1805, 100, 1905, 1, 1885.95, 80.95);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retailproduct`
--

CREATE TABLE `tbl_retailproduct` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `retailThumb` text NOT NULL,
  `reference` text NOT NULL,
  `pipeName` text NOT NULL,
  `pipeDetails` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_retailproduct`
--

INSERT INTO `tbl_retailproduct` (`id`, `date`, `retailThumb`, `reference`, `pipeName`, `pipeDetails`, `quantity`, `unitPrice`) VALUES
(28, '2024/09/07', 'upload/retail/a0ba494ef5.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Aloe vera - herbal', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 100, 10),
(29, '2024/09/07', 'upload/retail/d2fe87de9d.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Cactus White', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 200, 15),
(30, '2024/09/07', 'upload/retail/c5305eaaad.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Haworthia Wide Zebra', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 0, 35),
(31, '2024/09/07', 'upload/retail/4609a44efb.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Aloe vera - herbal', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 450, 25),
(32, '2024/09/07', 'upload/retail/b0c0335062.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Cactus White', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 150, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stuff`
--

CREATE TABLE `tbl_stuff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_stuff`
--

INSERT INTO `tbl_stuff` (`id`, `name`, `email`, `mobile`, `address`) VALUES
(1, 'Mohammod Noyon', 'admin@rafamotorsbd.com', 1834803912, 'Jurain, 24 foot');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp`
--

CREATE TABLE `tbl_temp` (
  `id` int(11) NOT NULL,
  `customId` varchar(255) NOT NULL,
  `retailProId` int(11) NOT NULL,
  `retailProduct` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `username`, `password`, `level`) VALUES
(1, 'gmnoyon7@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacture`
--
ALTER TABLE `tbl_manufacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacture_product_name`
--
ALTER TABLE `tbl_manufacture_product_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_retailproduct`
--
ALTER TABLE `tbl_retailproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stuff`
--
ALTER TABLE `tbl_stuff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_manufacture`
--
ALTER TABLE `tbl_manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_manufacture_product_name`
--
ALTER TABLE `tbl_manufacture_product_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_retailproduct`
--
ALTER TABLE `tbl_retailproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_stuff`
--
ALTER TABLE `tbl_stuff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
