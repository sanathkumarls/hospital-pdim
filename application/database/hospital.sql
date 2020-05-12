-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2020 at 11:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `d_id` int(11) NOT NULL,
  `d_email` varchar(50) DEFAULT NULL,
  `d_password` varchar(50) DEFAULT NULL,
  `d_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`d_id`, `d_email`, `d_password`, `d_name`) VALUES
(1, 'hemanth@gmail.com', '1234', 'Hemanth');

-- --------------------------------------------------------

--
-- Table structure for table `insurer`
--

CREATE TABLE `insurer` (
  `i_id` int(11) NOT NULL,
  `i_email` varchar(50) DEFAULT NULL,
  `i_password` varchar(50) DEFAULT NULL,
  `i_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insurer`
--

INSERT INTO `insurer` (`i_id`, `i_email`, `i_password`, `i_name`) VALUES
(1, 'nagaraj@gmail.com', '1234', 'Nagaraj');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `i_id` int(11) NOT NULL,
  `i_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`i_id`, `i_name`) VALUES
(1, 'Scissor'),
(2, 'Mask'),
(3, 'Gloves'),
(4, 'Needles'),
(5, 'Glucose');

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE `medical` (
  `m_id` int(11) NOT NULL,
  `m_email` varchar(50) DEFAULT NULL,
  `m_password` varchar(50) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`m_id`, `m_email`, `m_password`, `m_name`) VALUES
(1, 'gopalkrishna@gmail.com', '1234', 'GopalKrishna');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `p_id` int(11) NOT NULL,
  `p_email` varchar(50) DEFAULT NULL,
  `p_password` varchar(50) DEFAULT NULL,
  `p_name` varchar(20) DEFAULT NULL,
  `p_number` varchar(10) DEFAULT NULL,
  `p_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`p_id`, `p_email`, `p_password`, `p_name`, `p_number`, `p_address`) VALUES
(1, 'sathwik@gmail.com', '1234', 'Sathwik', '9234561761', 'Jayapura,Koppa(T),Chikmagalur(D),577123'),
(2, 'madhan@gmail.com', '1234', 'Madhan', '9876123456', 'Makkikoppa,Koppa(T),Chikmagalur(D),577123'),
(3, 'nikith@gmail.com', '1234', 'Nikith', '9762542545', 'Kogre,Koppa(T),Chikmagalur(D),577123'),
(4, 'samarth@gmail.com', '1234', 'Samarth', '9654454545', 'Hosgadde,Koppa(T),Chikmagalur(D),577123');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `d_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `d_items` varchar(500) DEFAULT NULL,
  `i_id` int(11) DEFAULT NULL,
  `i_status` int(11) DEFAULT NULL COMMENT '1 - approved\r\n2 - rejected',
  `i_timestamp` timestamp NULL DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  `m_status` int(11) DEFAULT NULL COMMENT '1 - issued',
  `m_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`t_id`, `p_id`, `d_id`, `d_timestamp`, `d_items`, `i_id`, `i_status`, `i_timestamp`, `m_id`, `m_status`, `m_timestamp`) VALUES
(1, 1, 1, '2020-05-05 16:51:24', '{\"Scissor\":\"10\",\"Mask\":\"20\"}', 1, 1, '2020-05-05 19:19:42', 1, 1, '2020-05-05 19:20:26'),
(2, 2, 1, '2020-05-05 16:53:43', '{\"Scissor\":\"10\",\"Mask\":\"20\"}', 1, 1, '2020-05-05 18:39:47', NULL, NULL, NULL),
(3, 3, 1, '2020-05-05 19:21:55', '{\"Scissor\":\"1\",\"Mask\":\"2\",\"Gloves\":\"3\",\"Needles\":\"4\",\"Glucose\":\"5\"}', 1, 2, '2020-05-05 20:56:28', NULL, NULL, NULL),
(4, 4, 1, '2020-05-05 20:56:00', '{\"Scissor\":\"3\",\"Mask\":\"4\",\"Gloves\":\"2\",\"Needles\":\"2\",\"Glucose\":\"3\"}', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `insurer`
--
ALTER TABLE `insurer`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `insurer`
--
ALTER TABLE `insurer`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical`
--
ALTER TABLE `medical`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
