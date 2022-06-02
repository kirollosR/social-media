-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 10:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_score` float DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  `comment_data` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `topic_id`, `post_id`, `comment_score`, `comment_date`, `comment_data`) VALUES
(12, 1, 10, 6, 6, NULL, 'fuck yes'),
(13, 1, 10, 6, 8, NULL, 'good'),
(14, 1, 10, 9, 8, NULL, 'good'),
(15, 1, 10, 9, 2, NULL, 'fuck'),
(16, 1, 10, 9, 10, NULL, 'great'),
(26, 1, 10, 19, 4, NULL, 'no'),
(27, 1, 10, 19, 0, NULL, 'bad'),
(28, 1, 10, 19, 2, NULL, 'fuck'),
(34, 1, 10, 5, 8, NULL, 'good'),
(36, 1, 10, 21, 8, NULL, 'good'),
(37, 1, 10, 22, 8, NULL, 'good'),
(38, 1, 10, 22, 10, NULL, 'yes'),
(44, 1, 8, 5, 10, NULL, 'great');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `keyword_id` int(11) NOT NULL,
  `keyword_name` varchar(50) DEFAULT NULL,
  `keyword_score` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword_name`, `keyword_score`, `user_id`) VALUES
(5, 'fuck', 4, 30),
(14, 'good', 10, 30),
(15, 'yes', 10, 30),
(17, 'great', 10, 30),
(18, 'perfect', 10, 30),
(19, 'yes', 10, 30),
(21, 'no', 4, 30),
(22, 'beautifull', 10, 30);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `post_score` float DEFAULT 5,
  `post_date` date DEFAULT NULL,
  `post_data` varchar(1000) DEFAULT NULL,
  `post_likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_score`, `post_date`, `post_data`, `post_likes`) VALUES
(5, 1, 8, 9, NULL, 'I want to buy a new laptop, any recommendations !!', 0),
(6, 1, 10, 7, NULL, 'when', 0),
(8, 1, 0, 0, NULL, 'nxc', 0),
(9, 14, 10, 6.66667, NULL, 'very good', 0),
(10, 1, 0, 0, NULL, 'hellos', 0),
(11, 1, 0, 0, NULL, 'hey', 0),
(13, 1, 0, 0, NULL, 'sahvhas', 0),
(14, 1, 0, 0, NULL, 'ahds', 0),
(16, 1, 0, 0, NULL, 'jsdb', 0),
(17, 1, 0, 0, NULL, 'sfsf', 0),
(18, 1, 0, 0, NULL, 'please', 0),
(19, 1, 10, 2, NULL, 'hell no', 0),
(20, 1, 0, 0, NULL, 'hsdgsh', 0),
(21, 14, 8, 8, NULL, 'hellos guys', NULL),
(22, 5, 6, 9, NULL, 'i want laptop', NULL),
(23, 30, 7, 0, NULL, 'hello', 0),
(24, 30, 0, 0, NULL, 'heeloos ', 0),
(25, 30, 0, 0, NULL, 'hellos post', 0),
(26, 30, 0, 0, NULL, 'hey there', 0),
(27, 30, 0, 0, NULL, 'hey', 0),
(28, 30, 0, 0, NULL, 'he', 0),
(29, 30, 0, 0, NULL, 'hell', 0),
(30, 1, 0, 0, NULL, 'hey', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `user_id`) VALUES
(6, 'Cars', 1),
(7, 'Food', 1),
(8, 'Laptops', 1),
(10, 'Football', 30),
(11, 'Phones', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_profile` varchar(500) DEFAULT NULL,
  `user_status` varchar(500) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `username`, `password`, `gender_id`, `role_id`, `user_profile`, `user_status`) VALUES
(1, 'Kirollos', 'Rafik', 'kirollos@yahoo.com', 'ko', 'k12345678', 1, 1, NULL, 'hellos'),
(2, 'Youssef', 'Rafik', 'youssef@yahoo.com', 'yo', '123456', 1, 1, NULL, NULL),
(4, 'ahmed', 'Rafik', 'ahmed@yahoo.com', 'ahm', '123456', 1, 1, NULL, NULL),
(5, 'Marina', 'Mague', 'marina@yahoo.com', 'mar', '123456', 2, 1, NULL, NULL),
(12, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mag123456', 1, 1, NULL, NULL),
(13, 'farah', 'kirollos', 'farah@yahoo.com', 'farohaa', 'farah1235', 1, 1, NULL, NULL),
(14, 'farah', 'kirollos', 'fara2h@yahoo.com', 'farohaa', 'farah1234', 1, 1, NULL, NULL),
(18, 'magued', 'moris', 'magued1@yahoo.com', 'mag', 'mag123456', 1, 1, NULL, NULL),
(19, 'magued', 'moris', 'magued1@yahoo.com', 'mag', 'mag123456', 1, 1, NULL, NULL),
(20, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mag123456', 1, 1, NULL, NULL),
(21, 'magued', 'moris', 'magued1@yahoo.com', 'mag', 'mag123456+', 1, 1, NULL, NULL),
(22, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mag123456', 1, 1, NULL, NULL),
(23, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mago123456', 1, 1, NULL, NULL),
(24, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mago12345', 1, 1, NULL, NULL),
(25, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mago12345', 1, 1, NULL, NULL),
(26, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mago1234', 1, 1, NULL, NULL),
(27, 'magued', 'moris', 'magued@yahoo.com', 'mag', 'mago1234', 1, 1, NULL, NULL),
(28, 'magued', 'moris', 'magued@yahoo.com', 'magod', 'magod123', 1, 1, NULL, NULL),
(29, 'magued', 'moris', 'magueddd@yahoo.com', 'magodaa', 'magodaa123', 1, 1, NULL, NULL),
(30, 'Kirollos', 'Rafik', 'admin@admin.com', 'admin', 'admin123', 1, 2, NULL, NULL),
(31, 'Youssef', 'Rafik', 'youssef3@yahoo.com', 'youyou', 'youyou123', 1, 1, NULL, 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `comments_ibfk_3` (`post_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`keyword_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_5` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_6` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
