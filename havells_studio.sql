-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2022 at 12:58 PM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `havells_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `enquire`
--

CREATE TABLE `enquire` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquire`
--

INSERT INTO `enquire` (`id`, `name`, `email`, `phone`, `location`, `city`, `pincode`, `comment`, `ip`, `status`, `created_date`) VALUES
(1, 'Ravi', 'test@gmail.com', '9874563210', 'Chandigarh', 'New Delhi', '110044', 'Test Mail', '106.208.150.109', 'Open', '2022-10-10 11:33:54'),
(2, 'Ravi', 'test@gmail.com', '9874563210', 'Bangalore', '', '110044', 'Enquiry Test Mail', '106.208.156.85', 'Open', '2022-10-10 12:20:22'),
(3, 'Ravi', 'test@gmail.com', '9874563210', 'Bengaluru', '', '110044', 'New Enquiry Test Mail', '106.208.156.85', 'Open', '2022-10-10 12:24:27'),
(4, 'Niyim', 'K.nitinmail@gmail.com', '9899525063', 'Chandigarh', '', '201010', 'Yyyyyy', '49.36.181.91', 'Open', '2022-10-13 09:27:40'),
(5, 'test', 'test@123.com', '1234567890', 'Bengaluru', '', '201005', 'jhjjjhhjhj', '49.36.181.91', 'Open', '2022-10-13 09:29:50'),
(6, 'Test', 'testail@gmail.com', '09899525063', 'Faridabad', '', '201010', 'Hello type', '49.36.181.91', 'Open', '2022-10-13 09:41:34'),
(7, 'Isha sharma', 'ishajuly2004@yahoo.co.in', '09818765514', 'Delhi', '', '110092', 'Test', '117.97.252.37', 'Open', '2022-10-27 07:24:54'),
(8, 'Isha sharma', 'ishajuly2004@yahoo.co.in', '09818765514', 'Delhi', '', '110092', 'Test', '172.70.251.132', 'Open', '2022-10-27 08:59:55'),
(9, 'Isha sharma', 'ishajuly2004@yahoo.co.in', '09818765514', 'Delhi', '', '110092', 'Test', '162.158.91.38', 'Open', '2022-10-27 09:14:45'),
(10, 'Isha sharma', 'ishajuly2004@yahoo.co.in', '09818765514', 'Delhi', '', '110092', 'Test', '117.97.252.37', 'Open', '2022-10-27 09:16:02'),
(11, 'Isha sharma', 'ishajuly2004@yahoo.co.in', '09818765514', 'Delhi', '', '110092', 'Test', '172.70.242.89', 'Open', '2022-10-27 09:19:12'),
(12, 'Tester', 'test@gmail.com', '9874563210', 'Faridabad', '', '110044', 'Local Test', '106.208.147.71', 'Open', '2022-10-27 11:35:13'),
(13, 'Monochrome', 'test@gmail.com', '0321456987', 'Faridabad', '', '3425263', 'Local Server Test', '106.208.147.71', 'Open', '2022-10-27 11:43:20'),
(14, 'Tester', 'test@gmail.com', '9874563210', 'Gurugram', '', '110044', 'Local Server Test', '106.208.147.71', 'Open', '2022-10-27 11:51:11'),
(15, 'Tester', 'test@gmail.com', '9874563210', 'Hyderabad', '', '110044', 'New Local Test', '106.208.147.71', 'Open', '2022-10-27 11:56:38'),
(16, 'test', 'test@gmail.com', '9874563210', 'Hyderabad', '', '110044', 'Local Server Mail', '106.208.147.71', 'Open', '2022-10-27 12:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int(250) NOT NULL,
  `logo` varchar(40) NOT NULL,
  `head_color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `logo`, `head_color`) VALUES
(1, 'Logo2.png', 'D0C0A8');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(240) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(40) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `image`, `role`) VALUES
(1, 'Ravi', 'ravindra.verma@repindia.com', '7896541230', '34dff8257578aadfbacdb6d5caee234c', 'Prashant_Desai_1-removebg-preview.png', 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enquire`
--
ALTER TABLE `enquire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquire`
--
ALTER TABLE `enquire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(240) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
