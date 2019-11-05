-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 01:11 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `read-it`
--
CREATE DATABASE IF NOT EXISTS `read-it` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `read-it`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `subredditID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `postTitle` varchar(64) NOT NULL,
  `postContent` varchar(1500) NOT NULL,
  `postTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subredditadmins`
--

CREATE TABLE `subredditadmins` (
  `subredditID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subreddits`
--

CREATE TABLE `subreddits` (
  `subredditID` int(11) NOT NULL,
  `subredditName` varchar(64) NOT NULL,
  `subredditDescription` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subreddits`
--

INSERT INTO `subreddits` (`subredditID`, `subredditName`, `subredditDescription`) VALUES
(1, 'home', 'This is the home board'),
(3, 'science', 'All things science. Come to this board to discuss the latest breakthroughs in science.'),
(4, 'Announcements', 'Here is where you\'ll find all announcements related to read-it. Could also answer FAQs, unveil new features, or announce upcoming changes.'),
(5, 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`) VALUES
(29, 'shookstra', 'sam@gmail.com', '$2y$11$gLlBhWcpUJgbuvmLwOtCluWEEv08Pd30tzJCVAXUEMDblzoYp.ZB2'),
(36, 'Sam1', 'sam1@gmail.com', '$2y$11$dwEEypwYinaL8oc0W7sTn.L4m.ITDOITuwKd60gae2ZvUN905G1sC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `subredditID` (`subredditID`);

--
-- Indexes for table `subredditadmins`
--
ALTER TABLE `subredditadmins`
  ADD PRIMARY KEY (`subredditID`,`userID`),
  ADD KEY `fk_admins_userID` (`userID`);

--
-- Indexes for table `subreddits`
--
ALTER TABLE `subreddits`
  ADD PRIMARY KEY (`subredditID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
  MODIFY `subredditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_subredditID` FOREIGN KEY (`subredditID`) REFERENCES `subreddits` (`subredditID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_posts_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subredditadmins`
--
ALTER TABLE `subredditadmins`
  ADD CONSTRAINT `fk_admins_subredditID` FOREIGN KEY (`subredditID`) REFERENCES `subreddits` (`subredditID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admins_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
