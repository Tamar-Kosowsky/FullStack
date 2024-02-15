-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 09:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upwords`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `text` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `game_level`
--

DROP TABLE IF EXISTS `game_level`;
CREATE TABLE `game_level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `text` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game_level`
--

INSERT INTO `game_level` (`id`, `name`, `img_path`, `text`, `sort`) VALUES
(1, 'level 1', 'one.png', 'level 1 text', 1),
(2, 'level 2', 'two.png', 'level 2 text', 2),
(3, 'level 3', 'three.png', 'level 3 text', 3);

-- --------------------------------------------------------

--
-- Table structure for table `image_lables`
--

DROP TABLE IF EXISTS `image_lables`;
CREATE TABLE `image_lables` (
  `id` int(11) NOT NULL,
  `image_objects_id` int(11) NOT NULL,
  `lable` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_lables`
--

INSERT INTO `image_lables` (`id`, `image_objects_id`, `lable`) VALUES
(14, 98, 'Gift'),
(15, 98, 'Present'),
(16, 99, 'Blocks'),
(20, 101, 'Pizza'),
(28, 104, 'Pineapple'),
(29, 104, 'Strawberry'),
(30, 104, 'Orange'),
(31, 105, 'Shirt'),
(32, 105, 'Sun hat'),
(33, 105, 'Shoes'),
(44, 110, 'Party hat'),
(45, 110, 'Cake'),
(46, 110, 'Cups'),
(47, 110, 'Cake Candle'),
(48, 110, 'Present'),
(49, 111, 'Hat'),
(50, 111, 'Camera'),
(51, 111, 'Sunglasses'),
(52, 111, 'Headphones'),
(53, 111, 'Phone'),
(89, 139, 'Dog'),
(90, 139, 'Car'),
(91, 139, 'Girl'),
(92, 139, 'Suitcase'),
(93, 140, 'Bed'),
(94, 140, 'Red Carpet'),
(95, 140, 'Radio');

-- --------------------------------------------------------

--
-- Table structure for table `image_objects`
--

DROP TABLE IF EXISTS `image_objects`;
CREATE TABLE `image_objects` (
  `id` int(11) NOT NULL,
  `game_level_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_objects`
--

INSERT INTO `image_objects` (`id`, `game_level_id`, `image_name`, `level`) VALUES
(98, 1, '5fcab1aeda150ed70f8526a6443ffb74.net-resizeimage (53)', 1),
(99, 1, '85de3c20bbf7beafa3662c2a9196e0f6.net-resizeimage (28)', 1),
(101, 1, 'ec2b436f904a31c95d3cddb875ff5103.net-resizeimage (4)', 1),
(104, 2, '27c9af4cec301ef2a4c63de7cd08f862.jpg', 2),
(105, 2, '788159bc20b13811873a38bdc36a1e8b.net-resizeimage (12)', 2),
(110, 3, 'ed67b933878e0cad7ccd57a535ab050d.jpg', 3),
(111, 3, '6380881b52dbe55c09b287e2ae515024.net-resizeimage (29)', 3),
(139, 2, 'd8a65fdba1b91059c36193d0dd1b7bf7.png', 2),
(140, 3, '84b5468e38c4048ddb891135f7fe2d16.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `text` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `valid` bit(1) NOT NULL,
  `admin` varchar(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `valid`, `admin`) VALUES
(1, 'user', 'user@gmail.com', 'Aa123456', b'1', '0'),
(2, 'admin', 'admin@gmail.com', 'Aa123456', b'1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_level`
--
ALTER TABLE `game_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_lables`
--
ALTER TABLE `image_lables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_objects_id` (`image_objects_id`);

--
-- Indexes for table `image_objects`
--
ALTER TABLE `image_objects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_level_id` (`game_level_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_ibfk_1` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `game_level`
--
ALTER TABLE `game_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image_lables`
--
ALTER TABLE `image_lables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `image_objects`
--
ALTER TABLE `image_objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_lables`
--
ALTER TABLE `image_lables`
  ADD CONSTRAINT `image_lables_ibfk_1` FOREIGN KEY (`image_objects_id`) REFERENCES `image_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_objects`
--
ALTER TABLE `image_objects`
  ADD CONSTRAINT `image_objects_ibfk_1` FOREIGN KEY (`game_level_id`) REFERENCES `game_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
