-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 04:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practioners`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `full_name` varchar(512) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `pwd_reset_token` varchar(32) DEFAULT NULL,
  `pwd_reset_token_creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `full_name`, `password`, `status`, `date_created`, `pwd_reset_token`, `pwd_reset_token_creation_date`) VALUES
(1, 'admin@example.com', 'Admin', '$2y$10$G/Z3N0H.GnkKq5gZZJtXvO3KEdAyG00FqdBul5CiyYC3hLE3zwqK6', 1, '2017-05-11 14:28:59', NULL, NULL),
(2, 'cudapouqe@gmail.com', 'rop', '$2y$10$JSkCehOWBtkI1JBOSImlJuAQpTkwuaUc0QGZycGinW4OLu8Xo1NAi', 1, '2017-05-11 15:20:51', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
