-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2012 at 02:01 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devuser1`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_enrollment`
--

CREATE TABLE IF NOT EXISTS `group_enrollment` (
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY  (`uid`,`group_id`),
  KEY `uid` (`uid`,`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Many to many relationship table linking user and group they ';

--
-- Dumping data for table `group_enrollment`
--

INSERT INTO `group_enrollment` (`uid`, `group_id`, `start_date`) VALUES
(1, 2, '2012-04-10'),
(1, 5, '2012-04-10'),
(1, 6, '2012-04-09'),
(1, 9, '2012-04-10'),
(4, 2, '2012-04-09'),
(4, 3, '2012-04-09'),
(5, 2, '2012-04-09'),
(5, 4, '2012-04-09'),
(6, 2, '2012-04-09'),
(6, 3, '2012-04-09'),
(6, 5, '2012-04-09'),
(7, 2, '2012-04-09'),
(7, 3, '2012-04-09'),
(7, 4, '2012-04-09'),
(7, 6, '2012-04-09'),
(8, 7, '2012-04-09'),
(8, 8, '2012-04-09'),
(10, 6, '2012-04-09'),
(11, 5, '2012-04-09'),
(11, 7, '2012-04-09'),
(11, 9, '2012-04-09'),
(12, 2, '2012-04-10'),
(12, 4, '2012-04-10'),
(12, 9, '2012-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `interest_group`
--

CREATE TABLE IF NOT EXISTS `interest_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY  (`group_id`),
  UNIQUE KEY `name` (`name`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `interest_group`
--

INSERT INTO `interest_group` (`group_id`, `name`, `description`, `creator_id`) VALUES
(2, 'FIFA', 'FIFA ROCKS!', 1),
(3, 'I am the KING', '', 4),
(4, 'The GEEKS', '', 5),
(5, 'Heart broken ers', 'Come to heal ', 6),
(6, 'Windows User', 'Love Windows!!!', 10),
(7, 'UNC Tar Heel', 'UNC Athletes', 8),
(8, 'Italian food', 'Pizza, Pasta', 8),
(9, 'iOS Dev', 'dev', 11);

-- --------------------------------------------------------

--
-- Table structure for table `is_friend_with`
--

CREATE TABLE IF NOT EXISTS `is_friend_with` (
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  PRIMARY KEY  (`uid1`,`uid2`),
  KEY `uid2` (`uid2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_belonging_to_group`
--

CREATE TABLE IF NOT EXISTS `post_belonging_to_group` (
  `post_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`post_id`,`group_id`),
  KEY `post_id` (`post_id`,`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='We cannot assume one post is for one group only, so this is ';

--
-- Dumping data for table `post_belonging_to_group`
--

INSERT INTO `post_belonging_to_group` (`post_id`, `group_id`) VALUES
(29, 2),
(32, 2),
(33, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(40, 2),
(41, 2),
(44, 2),
(45, 2),
(50, 2),
(39, 3),
(43, 3),
(47, 3),
(42, 4),
(46, 4),
(52, 4),
(48, 6),
(53, 6),
(49, 8),
(51, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail_info`
--

CREATE TABLE IF NOT EXISTS `user_detail_info` (
  `uid` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `first_name` varchar(64) default NULL,
  `last_name` varchar(64) default NULL,
  `twitter` text,
  `facebook` text,
  `occupation` text,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail_info`
--

INSERT INTO `user_detail_info` (`uid`, `email`, `gender`, `dob`, `first_name`, `last_name`, `twitter`, `facebook`, `occupation`) VALUES
(1, 'great@hotmail.com', 'F', '2000-02-29', 'Belle', 'Nolastname', '', 'facebook.com/user1', 'student'),
(2, 'joy.zhang7@gmail.com', 'F', '1990-07-24', 'Xiaoyu', 'Zhang', '', '', 'student'),
(3, 'eat@gmail.com', 'M', '0000-00-00', '', 'Ren', '', '', ''),
(4, '><@gmail.com', '', '2012-04-09', 'uh', 'oh', 'hahaha', 'lalalalala', 'Baby'),
(5, 'imnew@yahoo.com.sg', 'M', '1991-12-05', 'New', 'User', 'www.twitter.com/001', 'www.facebook.com/001', 'Professor'),
(6, 'heartbroken@sina.com', 'M', '1983-04-01', 'Heart broken', 'Dude', '', 'www.facebook.com/002', 'Money maker'),
(7, 'genius@gmail.com', 'M', '0000-00-00', 'Bill', 'Gates', 'www.twitter.com/007', '', 'Genius'),
(8, 'belle@gmail.com', 'F', '1991-07-07', 'belle', 'chun', 'bellaaa', 'lallala', 'student'),
(9, '999@123.com', 'F', '2002-04-09', 'Buffy', 'Vampire', 'bff99', 'bff99', 'student'),
(10, 'ten10@gmail.com', 'M', '1995-07-05', 'tenten', '10', '1010', '1010', 'student'),
(11, 'test111', 'F', '2010-07-04', 'test', 'test_last', 'fb', 'tw', 'student'),
(12, 'belle@belle.com', 'F', '2009-07-08', 'BElle', 'Belle', 'twitter.com', 'fb.com', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `user_password`
--

CREATE TABLE IF NOT EXISTS `user_password` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user_password`
--

INSERT INTO `user_password` (`uid`, `username`, `password`) VALUES
(1, 'user1', '0000'),
(2, 'joy', '12345'),
(3, 'steven', '0000'),
(4, '>.<', '0000'),
(5, 'newuser', 'password'),
(6, 'T.T', '8888'),
(7, '$.$', 'lala'),
(8, 'belle', '0000'),
(9, 'nine9', '999999'),
(10, 'tenten', 'ten'),
(11, 'test111', '0000'),
(12, 'belle2', '00000');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE IF NOT EXISTS `user_post` (
  `post_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `full_text` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`post_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='store posts by each user, relation to group in another table' AUTO_INCREMENT=54 ;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`post_id`, `uid`, `title`, `full_text`, `date`) VALUES
(29, 1, 'Hello world!', 'Hi !', '0000-00-00'),
(32, 1, 'They win!!!', '', '0000-00-00'),
(33, 1, 'They win again!!!!! :O', '', '0000-00-00'),
(35, 1, 'Is anybody here??  ', '', '0000-00-00'),
(36, 1, 'Hey, nice to meet you all!', 'fdsafds', '0000-00-00'),
(37, 1, 'I am so lonely :(', '', '0000-00-00'),
(38, 1, 'Hello???', '', '2012-04-09'),
(39, 4, 'Welcome to join this group. ', '', '2012-04-09'),
(40, 4, 'Hi user1~~~  I am here to support you.  ^^', '', '2012-04-09'),
(41, 5, 'HELLO', 'I am new to Friendy.  Nice to meet you guys!', '2012-04-09'),
(42, 5, 'Help me with my math assignment plzzzzzz', 'How do I solve 1+1?  \r\n\r\nHELP!!!!  T.T', '2012-04-09'),
(43, 6, 'May I be your queen?', '<3', '2012-04-09'),
(44, 6, 'Hi friends ', 'FIFA ROCKS!!!', '2012-04-09'),
(45, 1, '!!!', 'Party @ my place on Sunday! ', '2012-04-09'),
(46, 1, '1+1=2', '', '2012-04-09'),
(47, 7, 'Yes, I am the king!  ', 'I am Bill Gates.\r\nI am so poor.\r\nPlease donate.\r\n\r\nThank you!', '2012-04-09'),
(48, 10, 'Windows 8', 'What do you guys think of it?', '2012-04-09'),
(49, 8, 'Hungry', 'What should I eat?', '2012-04-09'),
(50, 11, 'fdasfda', 'fdsafda', '2012-04-09'),
(51, 11, 'Hello world!', 'fdafdafda', '2012-04-09'),
(52, 1, 'test1', 'dfdafdafdsafdfda', '2012-04-10'),
(53, 1, 'Free software in the eyes of Richard Stallman, or what I called, freed software.', 'If I have the chance, I will suggest Richard Stallman to rename â€œfree softwareâ€ to â€œfreed softwareâ€.\r\n\r\nWhy? To answer this question, you must first get to know who Richard Stallman is: wiki. He has done so many things that different people remember him in the different way. Author of Emacs, founder of GNU and free software foundationâ€¦\r\n\r\nWhat is the most important achievement for him, I believe, is the idea and the following actions by him. He did not just provoke the idea, but also gave up a lot to come up with real â€œfree softwareâ€, including a whole new operating system GNU, or (GNUâ€™s Not Unix, a classic recursive acronym).\r\n\r\nOn this blog, president of NUSHacker discussed about whether we need a new Richard Stallman for this Internet age:\r\n\r\nTrying to get out of Facebook, for instance, is an interesting experience. When you attempt to delete your account, it throws pictures of friends in your face. â€œTom, Bob, and Alice will miss you!â€ it says. This doesnâ€™t strike me as good behavior. In fact, it smells slightly abusive, as if the service were holding you hostage with your friendships. If you wanted to, you should be given the choice of taking your data, your friendships, and your profile information with you. And you should be able to use that data in an alternative social network, the same way you may switch email providers or telephone providers, but still keep your your email address and phone number. This is fair to you as a consumer. You shouldnâ€™t be punished because you are choosing to opt-out of Facebook.\r\nHe provides an interesting point here: should we have the freedom to take out the data that is belonged to us to transfer to, for example, another social networking site?\r\n\r\nMy answer is yes, because certain information belongs to us. The problem is whether Facebook would allow so, or should the legal system implement some regulation to make this happen.\r\n\r\nAfter all, I believe no matter what goal Richard Stallman wants to achieve, he at least travel around the world and make speeches to keep reminding people all over the world that there is such thing called free software, as in â€˜free  speechâ€™, not as in â€˜free beerâ€™.\r\n', '2012-04-10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vmax`
--
CREATE TABLE IF NOT EXISTS `vmax` (
`count1` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vmax1`
--
CREATE TABLE IF NOT EXISTS `vmax1` (
`name` varchar(64)
,`username` varchar(64)
,`posts` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vmax2`
--
CREATE TABLE IF NOT EXISTS `vmax2` (
`name` varchar(64)
,`username` varchar(64)
,`posts` bigint(21)
);
-- --------------------------------------------------------

--
-- Structure for view `vmax`
--
DROP TABLE IF EXISTS `vmax`;

CREATE ALGORITHM=UNDEFINED DEFINER=`devuser1`@`localhost` SQL SECURITY DEFINER VIEW `vmax` AS select count(0) AS `count1` from ((`user_password` `u` join `post_belonging_to_group` `pg`) join `user_post` `up`) where ((`pg`.`group_id` = 1) and (`u`.`uid` = `up`.`uid`) and (`up`.`post_id` = `pg`.`post_id`)) group by `u`.`username`;

-- --------------------------------------------------------

--
-- Structure for view `vmax1`
--
DROP TABLE IF EXISTS `vmax1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`devuser1`@`localhost` SQL SECURITY DEFINER VIEW `vmax1` AS select `ig`.`name` AS `name`,`u`.`username` AS `username`,count(0) AS `posts` from (((`user_password` `u` join `post_belonging_to_group` `pg`) join `user_post` `up`) join `interest_group` `ig`) where ((`pg`.`group_id` = 1) and (`u`.`uid` = `up`.`uid`) and (`up`.`post_id` = `pg`.`post_id`) and (`ig`.`group_id` = `pg`.`group_id`)) group by `u`.`username`;

-- --------------------------------------------------------

--
-- Structure for view `vmax2`
--
DROP TABLE IF EXISTS `vmax2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`devuser1`@`localhost` SQL SECURITY DEFINER VIEW `vmax2` AS select `ig`.`name` AS `name`,`u`.`username` AS `username`,count(0) AS `posts` from (((`user_password` `u` join `post_belonging_to_group` `pg`) join `user_post` `up`) join `interest_group` `ig`) where ((`pg`.`group_id` = 1) and (`u`.`uid` = `up`.`uid`) and (`up`.`post_id` = `pg`.`post_id`) and (`ig`.`group_id` = `pg`.`group_id`)) group by `u`.`username` order by count(0) desc;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_enrollment`
--
ALTER TABLE `group_enrollment`
  ADD CONSTRAINT `group_enrollment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_password` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_enrollment_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `interest_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interest_group`
--
ALTER TABLE `interest_group`
  ADD CONSTRAINT `interest_group_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user_password` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `is_friend_with`
--
ALTER TABLE `is_friend_with`
  ADD CONSTRAINT `is_friend_with_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `user_password` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_friend_with_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `user_password` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_belonging_to_group`
--
ALTER TABLE `post_belonging_to_group`
  ADD CONSTRAINT `post_belonging_to_group_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `user_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_belonging_to_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `interest_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_detail_info`
--
ALTER TABLE `user_detail_info`
  ADD CONSTRAINT `user_detail_info_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_password` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_password` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
