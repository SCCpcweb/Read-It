-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2019 at 02:42 AM
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
-- Table structure for table `commentlikes`
--

CREATE TABLE `commentlikes` (
  `likeID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `likeOrDislike` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentlikes`
--

INSERT INTO `commentlikes` (`likeID`, `commentID`, `userID`, `likeOrDislike`) VALUES
(1, 2, 38, 'dislike'),
(2, 1, 38, 'like'),
(4, 5, 29, 'like'),
(5, 2, 29, 'dislike'),
(6, 1, 29, 'like'),
(9, 2, 36, 'dislike'),
(10, 12, 39, 'like'),
(11, 13, 39, 'dislike'),
(13, 1, 40, 'like'),
(14, 2, 40, 'dislike'),
(16, 13, 38, 'dislike');

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
  `commentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `postID`, `subredditID`, `commentContent`, `commentTime`, `rating`) VALUES
(1, 38, 1, 29, 'I commented on it too', '2019-12-09 12:41:31', 3),
(2, 38, 1, 29, 'NO', '2019-12-09 12:42:02', -3),
(5, 29, 1, 29, 'hallo', '2019-12-10 11:17:40', 1),
(12, 39, 5, 29, 'I like to comment on my own posts', '2019-12-10 13:16:35', 1),
(13, 39, 5, 29, 'another comment', '2019-12-10 13:17:00', -2);

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

--
-- Dumping data for table `postlikes`
--

INSERT INTO `postlikes` (`likeID`, `postID`, `userID`, `likeOrDislike`) VALUES
(1, 1, 38, 'like');

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
  `postTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `subredditID`, `userID`, `postTitle`, `postContent`, `postTime`, `rating`) VALUES
(1, 29, 38, 'Here is my first post', 'hello again', '2019-12-09 18:44:57', 2),
(5, 29, 39, 'Hello everyone', 'What is everyone up to?', '2019-12-10 07:16:19', 0),
(11, 28, 40, 'science....', 'it aint real :0', '2019-12-10 07:26:52', -1);

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
(27, 29),
(28, 29),
(29, 38);

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
(27, 'Home', 'This is the home board where everyone should start.'),
(28, 'Science', 'A board for all things science.'),
(29, 'TestUser\'s Board', 'My board 1');

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
(38, 'TestUser', 'test@gmail.com', '$2y$11$pMSrhYNOQWDkfzediskDdew.GWF4cBEJ5omCUyaBckQhiNkVWAVzO'),
(39, 'NewUser', 'newuseremail@gmail.com', '$2y$11$y/1jxiemiYNnz8Y1SI2ZTO7oi7urVlrmRVMIS.j4JZc7wLOuzDqKa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentlikes`
--
ALTER TABLE `commentlikes`
  ADD PRIMARY KEY (`likeID`),
  ADD KEY `commentID` (`commentID`);

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
  ADD KEY `userID` (`userID`) USING BTREE,
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
-- AUTO_INCREMENT for table `commentlikes`
--
ALTER TABLE `commentlikes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `postlikes`
--
ALTER TABLE `postlikes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
  MODIFY `subredditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentlikes`
--
ALTER TABLE `commentlikes`
  ADD CONSTRAINT `fk_commentID_comments(commentID)` FOREIGN KEY (`commentID`) REFERENCES `comments` (`commentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_postID` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_subredditID` FOREIGN KEY (`subredditID`) REFERENCES `subreddits` (`subredditID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postlikes`
--
ALTER TABLE `postlikes`
  ADD CONSTRAINT `fk_postID_posts` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_subreddits(subredditid)_posts(subredditID)` FOREIGN KEY (`subredditID`) REFERENCES `subreddits` (`subredditID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
