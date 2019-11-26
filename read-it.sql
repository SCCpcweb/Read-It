-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 09:22 PM
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
-- Table structure for table `commentlikes`
--

CREATE TABLE `commentlikes` (
  `likeID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `likeOrDislike` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 36, 35, 17, 'Here\'s a comment', '2019-11-26 18:49:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `postlikes`
--

CREATE TABLE `postlikes` (
  `likeID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `likeOrDislike` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(35, 17, 36, 'Post title', 'Yee', '2019-11-26 12:49:09', 0),
(36, 17, 29, 'Shookstra psot', 'test post for deleting posts', '2019-11-26 02:17:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subredditadmins`
--

CREATE TABLE `subredditadmins` (
  `subredditID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subredditadmins`
--

INSERT INTO `subredditadmins` (`subredditID`, `userID`) VALUES
(17, 29),
(17, 36),
(18, 29),
(19, 29);

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
(17, 'testing board for admins', 'hallo'),
(18, 'shookstra\'s board', 'yesssss'),
(19, 'another board yeet', 'oh babay');

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
(36, 'Sam1', 'sam1@gmail.com', '$2y$11$dwEEypwYinaL8oc0W7sTn.L4m.ITDOITuwKd60gae2ZvUN905G1sC'),
(37, 'TestUser', 'testEmail@gmail.com', '$2y$11$9fC9pJxpa6siq9bytGxvMu4FiILQowsYFj8Brh3mx4RhvI2ewk4lu'),
(38, 'TestUser2', 'testEmail2@gmail.com', '$2y$11$rR3maBtGJBJtliqI2j8HQe8Eum..l7sk5pMdTOGPzkH8Sfq43CR3C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentlikes`
--
ALTER TABLE `commentlikes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `fk_comments_userID` (`userID`),
  ADD KEY `fk_comments_subredditID` (`subredditID`),
  ADD KEY `fk_comments_postID` (`postID`);

--
-- Indexes for table `postlikes`
--
ALTER TABLE `postlikes`
  ADD PRIMARY KEY (`likeID`),
  ADD KEY `fk_postID_posts` (`postID`),
  ADD KEY `fk_userID_users` (`userID`);

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
-- AUTO_INCREMENT for table `commentlikes`
--
ALTER TABLE `commentlikes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `postlikes`
--
ALTER TABLE `postlikes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
  MODIFY `subredditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Constraints for table `postlikes`
--
ALTER TABLE `postlikes`
  ADD CONSTRAINT `fk_postID_posts` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `fk_userID_users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

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
