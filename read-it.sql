-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 09:23 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `subredditID` int(11) NOT NULL,
  `commentContent` varchar(500) NOT NULL,
  `commentTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `postID`, `subredditID`, `commentContent`, `commentTime`, `rating`) VALUES
(1, 29, 21, 1, 'd', '2019-11-19 07:32:22', 5),
(2, 29, 21, 1, 'comment 2', '2019-11-19 07:48:32', 0);

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
  `postTime` datetime NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `subredditID`, `userID`, `postTitle`, `postContent`, `postTime`, `rating`) VALUES
(21, 1, 36, 'time', 'hack', '0000-00-00 00:00:00', 0),
(22, 1, 36, 'alert(\'yee\');', 'alert(\'yee\');', '2019-11-16 12:02:54', 0),
(23, 1, 36, '--', 'yeeby', '2019-11-16 12:07:37', 0),
(24, 1, 29, 'another test post', 'yeet', '2019-11-16 15:38:30', 0),
(25, 1, 29, 'test', 'sadasdfg', '2019-11-16 16:29:58', 0),
(26, 3, 29, 'post', 'yee', '2019-11-16 16:19:00', 0),
(27, 3, 29, 'dddddddddd', 'd', '2019-11-16 04:07:49', 0),
(28, 3, 29, 'Science psot', 's', '2019-11-16 04:11:06', 0);

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
(5, 'asdf', 'asdf'),
(6, 'alert(\'post\');', 'gotcha');

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `fk_comments_userID` (`userID`),
  ADD KEY `fk_comments_subredditID` (`subredditID`),
  ADD KEY `fk_comments_postID` (`postID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `subredditID` (`subredditID`),
  ADD KEY `userID` (`userID`) USING BTREE;

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
  MODIFY `subredditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_postID` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_subredditID` FOREIGN KEY (`subredditID`) REFERENCES `subreddits` (`subredditID`),
  ADD CONSTRAINT `fk_comments_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
