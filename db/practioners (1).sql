-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 01:20 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`, `date_created`, `status`) VALUES
(4, 'Dentistf', 0, '2017-05-29 09:09:53', 1),
(5, 'test cat', 0, '2017-05-24 02:26:15', 1),
(6, 'sub category', 5, '2017-05-29 02:33:50', 1),
(7, 'dentist sub category', 4, '2017-05-29 06:13:45', 1),
(8, 'laptops', 0, '2017-05-29 03:08:59', 1),
(9, 'sub sub cat', 6, '2017-05-29 03:09:37', 1),
(10, 'dentiest sub dentiest', 9, '2017-05-29 06:10:42', 1),
(11, 'Technology', 0, '2017-05-29 06:11:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `id` bigint(20) NOT NULL,
  `practice_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `languages` varchar(100) NOT NULL,
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practice`
--

INSERT INTO `practice` (`id`, `practice_name`, `description`, `logo`, `address`, `state`, `suburb`, `postal_code`, `phone_number`, `languages`, `latitude`, `longitude`, `date_created`) VALUES
(1, 'James Clinic private limited', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. updated', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. updated', '', '', '', 'Engilsh , Urder , Italian ,pun', '8237402028115', '99.999999', '999.999999', '2017-06-01 12:01:32'),
(2, 'Art Clinic private', 'Art Clinic private', '', 'Art Clinic private', '', '', '', 'Engilsh ,  Dutch', '1112344256', '99.999999', '999.999999', '2017-06-01 12:31:11'),
(3, 'with suburbu', 'with suburbu', '', 'with suburbu', 'with suburbu', 'with suburbu', 'with su', 'with suburbu', 'with suburbuf', '99.999999', '999.999999', '2017-06-06 09:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `practice_reviews`
--

CREATE TABLE `practice_reviews` (
  `id` bigint(20) NOT NULL,
  `practice_id` bigint(20) NOT NULL,
  `review` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practice_specialities`
--

CREATE TABLE `practice_specialities` (
  `id` int(11) NOT NULL,
  `practice_id` bigint(20) NOT NULL,
  `speciality_id` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practice_staff`
--

CREATE TABLE `practice_staff` (
  `id` bigint(20) NOT NULL,
  `practice_id` bigint(20) NOT NULL,
  `practitioner_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practice_timing`
--

CREATE TABLE `practice_timing` (
  `id` bigint(20) NOT NULL,
  `practice_id` bigint(20) NOT NULL,
  `practice_day` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practioner_qualification`
--

CREATE TABLE `practioner_qualification` (
  `id` bigint(20) NOT NULL,
  `practioner_id` bigint(20) NOT NULL,
  `qualification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practitioners`
--

CREATE TABLE `practitioners` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL COMMENT 'comma seprated languages',
  `phone_number` varchar(30) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '1 = male 0 = female',
  `address` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `overview` text NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practitioners`
--

INSERT INTO `practitioners` (`id`, `first_name`, `last_name`, `email`, `language`, `phone_number`, `gender`, `address`, `qualification`, `overview`, `avatar`, `date_created`) VALUES
(1, 'kami', 'kamran', 'kamran@yahoo.com', 'French', '123456789', 1, '123456789', 'bds', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL),
(2, 'Muhammad', 'Ali', 'waqas@gmail.com', 'English', '22222222', 1, '21212121', 'bds', 'sxsxsxs', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_timing`
--

CREATE TABLE `practitioner_timing` (
  `id` int(11) NOT NULL,
  `practitioner_id` int(11) NOT NULL,
  `practitioner_day` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification`, `date_created`) VALUES
(1, 'MBBSR', '2017-05-30 12:02:59'),
(2, 'MBBS', '2017-05-30 12:21:23'),
(3, 'ACMSC', '2017-05-30 12:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` int(11) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `speciality`, `date_created`) VALUES
(1, 'Metabolism', '2017-05-31 07:23:00'),
(2, 'NeuroSergen', '2017-05-31 08:46:22'),
(3, 'Cardialogested', '2017-05-31 09:33:57');

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
(2, 'cuda@gmail.com', 'rop', '$2y$10$JSkCehOWBtkI1JBOSImlJuAQpTkwuaUc0QGZycGinW4OLu8Xo1NAi', 1, '2017-05-11 15:20:51', NULL, NULL),
(3, 'cudapouqeh@gmail.com', 'dd', '$2y$10$J6DqdTt.06JpVpXr.dxYTOD9pdnEwWmqmO62UHJNdKhyuf/NbjpsS', 1, '2017-05-11 16:39:51', NULL, NULL),
(4, 'test@gmail.com', 'tester', '$2y$10$SgngjrBagBNmhennJSn4/.MfHUgOZqdJ9y2UFhBR4cpZ2qCjB8EQ.', 1, '2017-05-13 05:47:38', NULL, NULL),
(5, 'rest@gmail.com', 'Faisal', '$2y$10$.XqzdMJCuXPTPLdU0n0h1uwPf6ox1y1B0d6tUOQ/qURCCAqAppIwq', 1, '2017-05-21 04:00:34', NULL, NULL),
(6, 'muhammad.ramzan@elementarylogics.com', 'admin@example.com', '$2y$10$PfrVS3Opqrv25JEl/ZlCgu7uVxrhz8TfVo0gRaWBZ0XiEgFImDJUe', 2, '2017-05-24 07:26:50', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practice_staff`
--
ALTER TABLE `practice_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practice_timing`
--
ALTER TABLE `practice_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practitioners`
--
ALTER TABLE `practitioners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `practice`
--
ALTER TABLE `practice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `practice_staff`
--
ALTER TABLE `practice_staff`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `practice_timing`
--
ALTER TABLE `practice_timing`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `practitioners`
--
ALTER TABLE `practitioners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
