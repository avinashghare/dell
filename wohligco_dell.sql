-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2014 at 02:59 AM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wohligco_dell`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(2, 'Normal user'),
(1, 'Super admin');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `name`, `address`) VALUES
(1, 'ibsar', 'karjat'),
(2, 'somaiiya', 'vidyavihar'),
(4, 'KGKC', 'KArjat');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'fa fa-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'fa fa-home'),
(5, 'College', '', '', 'site/viewcollege', 1, 0, 1, 2, 'fa fa-graduation-cap'),
(6, 'Post', '', '', 'site/viewpost', 1, 0, 1, 3, 'fa fa-list-alt'),
(7, 'Leaderboard', '', '', 'site/viewleaderboard', 1, 0, 1, 7, 'fa fa-trophy'),
(8, 'Profile', '', '', 'site/viewnormaluserprofile', 1, 0, 1, 4, 'fa fa-user'),
(9, 'Post', '', '', '', 1, 0, 1, 5, 'fa fa-list-alt'),
(10, 'Facebook', '', '', 'site/viewfacebookpost', 1, 9, 1, 6, 'fa fa-facebook'),
(11, 'Twitter', '', '', 'site/viewtwitterpost', 1, 9, 1, 7, 'fa fa-twitter'),
(12, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'fa fa-home'),
(13, 'Suggestion', '', '', 'site/viewsuggestion', 1, 0, 1, 8, 'fa fa-lightbulb-o'),
(14, 'Suggestion', '', '', 'site/viewadminsuggestion', 1, 0, 1, 8, 'fa fa-lightbulb-o');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`menu`,`access`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `posttype` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `text`, `image`, `posttype`, `timestamp`) VALUES
(3, 'Dell tablet', 'image.jpg', 1, '2014-12-27 08:35:38'),
(4, 'Dell Latest', 'image1.jpg', 2, '2014-12-27 11:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `posttype`
--

CREATE TABLE IF NOT EXISTS `posttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posttype`
--

INSERT INTO `posttype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE IF NOT EXISTS `suggestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` text NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`id`, `text`, `image`, `user`, `timestamp`) VALUES
(2, 'nature', 'Nature_at_its_Best!!!2.png', 15, '2014-12-27 08:50:28'),
(5, 'Test', '', 18, '2014-12-29 09:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `college` int(11) NOT NULL,
  `facebookid` varchar(255) NOT NULL,
  `twitterid` varchar(255) NOT NULL,
  `instagramid` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `rank` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `contact`, `sex`, `dob`, `college`, `facebookid`, `twitterid`, `instagramid`, `image`, `rank`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, '', '', '0000-00-00', 2, '746538842081850', '2766291092', '', '', 0),
(15, 'Avinash Ghare', 'a63526467438df9566c508027d9cb06b', 'avinash@wohlig.com', 2, '2014-12-25 00:03:29', 1, '8983454456', 'male', '1991-05-06', 2, '746538842081850', '2766291092', '', 'https://graph.facebook.com/746538842081850/picture?width=150&height=150', 3),
(16, 'Rajesh Nagda', '62cc2d8b4bf2d8728120d052163a77df', 'demo@demo.com', 2, '2014-12-27 09:34:01', NULL, '999', 'male', '0000-00-00', 1, '548331721971078', '334624987', '', 'https://graph.facebook.com/548331721971078/picture?width=150&height=150', 1),
(17, 'Jagruti Patil', '3677b23baa08f74c28aba07f0cb6554e', 'jagruti@wohlig.com', 2, '2014-12-27 09:54:41', NULL, '9999', 'female', '1989-10-09', 1, '844547372274823', '170283202', '', 'https://graph.facebook.com/844547372274823/picture?width=150&height=150', 2),
(18, 'Harish Mukhi', 'cc03e747a6afbbcbf8be7668acfebee5', 'harishmukhi@kestone.in', 2, '2014-12-29 04:54:01', NULL, '', 'male', '0000-00-00', 1, '850853144935198', '175430187', '', 'https://graph.facebook.com/850853144935198/picture?width=150&height=150', 3),
(19, 'Test', 'cc03e747a6afbbcbf8be7668acfebee5', 'test@test.com', 2, '2014-12-29 06:38:58', NULL, '', 'Male', '2014-12-24', 1, '', '', '', '', 3),
(20, 'Tulsi', '571c7524cbca934dcfc439717c6c9202', 'TULSI_GURUNG@dell.com', 1, '2014-12-30 03:46:34', NULL, '', 'Female', '0000-00-00', 1, '', '', '', '', 0),
(21, 'Tulsi Gurung', '571c7524cbca934dcfc439717c6c9202', 'TULSI_GURUNG@dell.co.in', 2, '2014-12-30 03:48:27', NULL, '', 'female', '0000-00-00', 1, '10205743142313270', '', '', 'https://graph.facebook.com/10205743142313270/picture?width=150&height=150', 3),
(22, 'Razia', 'd17b0b99aa41a72f8ec73cb944ae74af', 'razia_ali@dell.com', 1, '2014-12-30 03:50:22', NULL, '', 'Female', '0000-00-00', 1, '', '', '', '', 0),
(23, 'Razia Camp', '06615bf6dc4589737cdc5329320f1a01', 'razia_ali@dell.co.in', 2, '2014-12-30 03:50:57', NULL, '', 'Female', '0000-00-00', 1, '', '', '', '', 3),
(24, 'Jitto', 'cdd3099e40a909b792892c95204d6a8a', 'jitto@gozoop.com', 1, '2014-12-30 04:26:23', NULL, '', 'Male', '0000-00-00', 1, '', '', '', '', 0),
(25, 'Renita', '0e8367512b8f2421492f38488b98d146', 'renita@gozoop.com', 1, '2014-12-30 04:27:19', NULL, '', 'Female', '0000-00-00', 1, '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userpost`
--

CREATE TABLE IF NOT EXISTS `userpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `share` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` double NOT NULL,
  `favourites` double NOT NULL,
  `retweet` double NOT NULL,
  `posttype` int(11) NOT NULL,
  `returnpostid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userpost`
--

INSERT INTO `userpost` (`id`, `user`, `post`, `likes`, `share`, `timestamp`, `comment`, `favourites`, `retweet`, `posttype`, `returnpostid`) VALUES
(1, 17, 3, 0, 0, '2014-12-27 11:25:44', 0, 0, 0, 1, '844547372274823_844547688941458'),
(2, 17, 4, 0, 0, '2014-12-27 11:54:49', 0, 1, 0, 2, '548808971276914688'),
(3, 16, 4, 0, 0, '2014-12-29 08:10:14', 0, 0, 0, 2, '549477476674453506'),
(4, 16, 4, 0, 0, '2014-12-29 10:00:06', 0, 1, 1, 2, '549479378262822912');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
