-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 07:03 PM
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
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `usermessages`
--

CREATE TABLE `usermessages` (
  `uid` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `msgID` int(30) NOT NULL,
  `message` varchar(280) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usermessages`
--

INSERT INTO `usermessages` (`uid`, `name`, `msgID`, `message`, `timePosted`) VALUES
(97422826648387037, 'user', 1, 'fart', '2024-06-04 10:35:16'),
(97422826648387037, 'user', 2, 'lets goooooooo', '2024-06-04 10:35:10'),
(97422826648387037, 'user', 7, 'oasjd asd ', '2024-06-04 10:32:36'),
(359442579127721835, 'User123', 17, 'wutitzgoingevry', '2024-06-06 04:49:58'),
(359442579127721835, 'User123', 21, 'test\r\n', '2024-06-06 04:50:25'),
(359442579127721835, 'User123', 22, 'fart\r\n', '2024-06-06 04:51:48'),
(359442579127721835, 'User123', 23, 'joe biden\r\n', '2024-06-06 04:57:23'),
(359442579127721835, 'User123', 24, 'afas', '2024-06-06 04:57:29'),
(41014646441541, 'duramidura', 29, 'hooauasle', '2024-06-06 07:01:59'),
(41014646441541, 'duramidura', 30, 'dasdassd', '2024-06-06 07:48:38'),
(41014646441541, 'duramidura', 31, 'joe roafnda\r\na', '2024-06-06 07:48:53'),
(112868746298525389, 'username1234567890', 32, 'im the goat', '2024-06-06 09:47:20'),
(112868746298525389, 'username1234567890', 33, 'wlaklwjhaf', '2024-06-06 10:04:04'),
(112868746298525389, 'username1234567890', 34, 'akjshfkjhfka', '2024-06-06 10:04:09'),
(112868746298525389, 'username1234567890', 35, 'lezz goo', '2024-06-06 11:06:51'),
(2952027787558542, 'joerogan2', 37, 'woahaba', '2024-06-07 15:24:20'),
(2952027787558542, 'joerogan2', 38, 'huahahaha ', '2024-06-07 15:24:26'),
(2952027787558542, 'joerogan2', 39, 'wutitzgoingevery', '2024-06-07 15:24:37'),
(2952027787558542, 'joerogan2', 41, 'hello', '2024-06-07 16:26:57'),
(2952027787558542, 'Anonymous', 43, 'test1', '2024-06-07 15:37:12'),
(2952027787558542, 'Anonymous', 44, 'hello', '2024-06-07 16:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` bigint(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `notes` varchar(20) DEFAULT 'Hello!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `admin`, `firstname`, `lastname`, `email`, `username`, `password`, `gender`, `notes`) VALUES
(41014646441541, 0, 'joeee', 'bideen', 'rogan21@gmail.com', 'duramidura', 'joerogan', 'Female', 'asd'),
(635976156720958, 0, 'Joe', 'Mama', 'niggas@gmail.com', 'Majoe', 'duraamidura', 'Male', 'Hello!'),
(2952027787558542, 1, 'joe', 'rogan', 'joerogan@gmail.com', 'joerogan2', 'pass', 'Male', 'letz goo'),
(97422826648387037, 1, 'ahahaha', 'pleaaase', 'wa@gmail.com', 'user', 'pass', 'Male', 'wutitzgoinevery'),
(112868746298525389, 0, 'fart', 'fart', 'fart@gmail.com', 'username1234567890', 'pass', 'Male', 'Hello!'),
(359442579127721835, 0, 'testing', 'pleaaase', 'testing@gmail.com', 'User123', 'pass', 'Other', 'Hello!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`msgID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `Username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `msgID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359442579127721836;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
