-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 07:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rg_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `mothername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `presenAddress` varchar(255) NOT NULL,
  `permanentAddress` varchar(255) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `bloodgroup` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `username`, `fathername`, `mothername`, `email`, `presenAddress`, `permanentAddress`, `phonenumber`, `department`, `hobbies`, `gender`, `bloodgroup`, `city`) VALUES
(1, 'Siam Islam', ' Abdur Rouf', 'Tohomina Khatun', 'siamislam50000@gmail.com', ' Uttara', 'Uttara', 1756597799, 'CSE', 'Array', 'Male', ' O+', 'Dhaka'),
(2, 'Siam Islam', ' Abdur Rouf', 'Tohomina Khatun', 'siamislam50000@gmail.com', ' Uttara', 'Uttara', 1756597799, 'CSE', 'Playing,Coding', 'Male', ' O+', 'Dhaka'),
(3, 'Tanjimul', ' Rouf', 'Shilpi', 'siam@gmail.com', ' Dhaka', 'Uttara', 1756597799, 'CSE', 'Reading,Writing', 'Male', ' A+', 'Rajshahi'),
(4, 'siam', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(5, '', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(6, '12', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(7, '', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(8, 'Siam', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(9, '', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(10, 'Siam', ' ', '', '', ' ', '', 0, '', '', '', ' ', ''),
(11, '', ' ', '', '', ' ', '', 0, '', ' Playing,Coding', '', ' ', ''),
(12, '', ' ', '', '', ' ', '', 0, '', ' ', '', ' ', ''),
(13, 'Siam', ' ', '', '', ' ', '', 0, '', ' ', '', ' ', ''),
(14, 'Siam', ' Rouf', '', '', ' ', '', 0, '', ' ', '', ' ', ''),
(15, 'Siam', ' Rouf', 'Tohomina', '', ' ', '', 0, '', ' ', '', ' ', ''),
(16, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' ', '', 0, '', ' ', '', ' ', ''),
(17, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 0, '', ' ', '', ' ', ''),
(18, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, '', ' ', '', ' ', ''),
(19, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' ', '', ' ', ''),
(20, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' Playing', '', ' ', ''),
(21, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' Playing,Coding', '', ' ', ''),
(22, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' Playing,Coding', 'Male', ' ', ''),
(23, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' Playing,Coding', 'Male', ' O+', ''),
(24, 'Siam', ' Rouf', 'Tohomina', 'siamislam50000@gmail.com', ' Uttara', 'Dhaka', 1756597799, 'CSE', ' Playing,Coding', 'Male', ' O+', 'Dhaka'),
(25, '', ' ', '', '', ' ', '', 0, '', ' ', '', ' ', ''),
(26, '', ' ', '', '', ' ', '', 0, '', ' Playing,Coding', '', ' ', ''),
(27, '', ' ', '', '', ' ', '', 0, '', ' Playing,Coding', '', ' ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
