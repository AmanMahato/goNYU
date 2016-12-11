-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2015 at 10:32 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `pin_id` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`),
  KEY `comments_ibfk_2` (`pin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow_pinboard`
--

CREATE TABLE IF NOT EXISTS `follow_pinboard` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stream_id` int(11) DEFAULT NULL,
  `pinboard_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `follow_pinboard_ibfk_3` (`pinboard_id`),
  KEY `follow_pinboard_ibfk_2` (`stream_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `follow_pinboard`
--

INSERT INTO `follow_pinboard` (`row_id`, `created`, `stream_id`, `pinboard_id`) VALUES
(1, '2013-11-25 01:12:39', 1, 1),
(2, '2013-11-25 01:12:57', 1, 2),
(3, '2013-11-25 01:13:13', 1, 4),
(4, '2013-11-25 08:55:57', 2, 1),
(5, '2013-11-25 08:55:57', 2, 2),
(6, '2013-11-25 08:55:57', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `friend_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`row_id`, `created`, `user_id`, `friend_id`) VALUES
(5, '2013-11-25 01:05:54', 'AbhiPil', 'Dhishan'),
(6, '2013-11-25 01:06:18', 'Dhishan', 'AbhiPil'),
(9, '2013-11-25 08:42:32', 'KunalRelia', 'JayPatel'),
(10, '2013-11-25 08:42:32', 'JayPatel', 'KunalRelia'),
(13, '2013-12-13 17:59:01', 'Sgoyal', 'KunalRelia'),
(14, '2013-12-13 17:59:01', 'KunalRelia', 'Sgoyal'),
(15, '2015-04-27 08:11:46', 'SGOYAL', 'kk'),
(16, '2015-04-27 08:11:46', 'kk', 'SGOYAL'),
(17, '2015-04-27 08:18:33', 'kunalrelia', 'KK'),
(18, '2015-04-27 08:18:33', 'KK', 'kunalrelia'),
(19, '2015-05-01 04:17:26', 'abhipil', 'Naimesh'),
(20, '2015-05-01 04:17:26', 'Naimesh', 'abhipil'),
(21, '2015-05-01 05:36:05', 'kunalrelia', 'Dhishan'),
(22, '2015-05-01 05:36:05', 'Dhishan', 'kunalrelia'),
(23, '2015-05-01 05:36:13', 'kunalrelia', 'abhipil'),
(24, '2015-05-01 05:36:13', 'abhipil', 'kunalrelia'),
(25, '2015-05-01 08:42:02', 'kk', 'Dhishan'),
(26, '2015-05-01 08:42:02', 'Dhishan', 'kk');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE IF NOT EXISTS `friend_request` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `friend_id` varchar(50) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` enum('Rejected','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`row_id`, `created`, `user_id`, `friend_id`, `message`, `status`) VALUES
(1, '2013-11-25 01:06:38', 'KunalRelia', 'Naimesh', 'Accept my request', 'Pending'),
(7, '2015-05-01 04:01:15', 'abhipil', 'Sgoyal', '', 'Pending'),
(8, '2015-05-01 04:02:45', 'abhipil', 'JayPatel', '', 'Pending'),
(9, '2015-05-01 04:09:11', 'abhipil', 'kk', '', 'Pending'),
(11, '2015-05-01 04:14:13', 'dhishan', 'Sgoyal', '', 'Pending'),
(12, '2015-05-01 04:16:40', 'dhishan', 'JayPatel', '', 'Pending'),
(13, '2015-05-01 04:19:42', 'kk', 'Naimesh', '', 'Pending'),
(14, '2015-05-04 21:04:54', 'kk', 'JayPatel', '', 'Pending'),
(15, '2015-05-06 11:33:51', 'KunalRelia', 'SachinT', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pin_id` int(11) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `root_pin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`),
  KEY `likes_ibfk_3` (`pin_id`),
  KEY `likes_ibfk_5` (`root_pin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`row_id`, `created`, `pin_id`, `user_id`, `root_pin_id`) VALUES
(7, '2013-12-13 03:07:15', 9, 'KunalRelia', 9),
(10, '2013-12-13 07:00:54', 1, 'KunalRelia', 1),
(13, '2013-12-13 19:55:51', 29, 'KunalRelia', 29),
(15, '2015-04-26 09:31:56', 27, 'kk', 27),
(17, '2015-04-27 05:30:20', 38, 'naimesh', 38),
(20, '2015-04-27 08:29:39', 43, 'kk', 43),
(22, '2015-04-30 15:45:53', 39, 'kk', 27),
(23, '2015-05-04 21:12:24', 40, 'kk', 9),
(25, '2015-05-06 04:20:34', 38, 'kk', 38),
(26, '2015-05-06 12:04:45', 62, 'kk', 62);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_name` varchar(50) DEFAULT NULL,
  `url_pic` varchar(1000) DEFAULT NULL,
  `url_site` varchar(1000) DEFAULT NULL,
  `total_likes` int(11) DEFAULT '0',
  `user_id` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`row_id`, `created`, `file_name`, `url_pic`, `url_site`, `total_likes`, `user_id`, `title`, `description`) VALUES
(1, '2013-12-13 07:00:54', '1.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Emma_Watson_2013.jpg/220px-Emma_Watson_2013.jpg', 'http://en.wikipedia.org/wiki/Emma_Watson', 1, 'KunalRelia', 'Emma', 'Cool Pics'),
(2, '2013-12-12 17:21:22', '2.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Lady_Gaga_BTW_Ball_Antwerp_02.jpg/220px-Lady_Gaga_BTW_Ball_Antwerp_02.jpg', 'http://en.wikipedia.org/wiki/Lady_Gaga', 1, 'Naimesh', 'Singers', 'Fav Singer Female'),
(3, '2013-12-12 14:52:15', '3.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Believe_Tour_7%2C_2012.jpg/220px-Believe_Tour_7%2C_2012.jpg', 'http://en.wikipedia.org/wiki/Justin_Bieber', 1, 'Naimesh', 'Singers', 'Fav Singer Male'),
(4, '2013-12-02 02:18:51', '4.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Brad_Pitt_5%2C_2013.jpg/220px-Brad_Pitt_5%2C_2013.jpg', 'http://en.wikipedia.org/wiki/Brad_Pitt', 1, 'KunalRelia', 'Pitt', 'Cool Pics'),
(5, '2013-12-12 10:40:37', '5.jpg', 'http://upload.wikimedia.org/wikipedia/en/thumb/d/d8/Game_of_Thrones_title_card.jpg/250px-Game_of_Thrones_title_card.jpg', 'http://en.wikipedia.org/wiki/Game_of_Thrones', 3, 'AbhiPil', 'GOT', NULL),
(6, '2013-12-02 02:19:28', '6.jpg', 'http://upload.wikimedia.org/wikipedia/commons/7/74/Mutthuraj.jpg', 'http://en.wikipedia.org/wiki/Rajkumar_%28actor%29', 2, 'Dhishan', 'Dr. Raj', NULL),
(7, '2013-12-02 02:19:44', '7.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Modern_WhiteBullyKutta.jpg/220px-Modern_WhiteBullyKutta.jpg', 'http://en.wikipedia.org/wiki/Bully_Cutha', 0, 'KK', 'Dog', 'Bully Kutta'),
(8, '2015-05-04 21:12:24', '8.jpg', 'http://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Kimi_Raikkonen_won_2007_Brazil_GP.jpg/800px-Kimi_Raikkonen_won_2007_Brazil_GP.jpg', 'http://en.wikipedia.org/wiki/File:Kimi_Raikkonen_won_2007_Brazil_GP.jpg', 2, 'JayPatel', 'Ferrari', 'Cool Cars'),
(64, '2015-04-30 15:45:53', '64.', 'http://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Jackie_Chan_by_Gage_Skidmore.jpg/220px-Jackie_Chan_by_Gage_Skidmore.jpg', 'http://en.wikipedia.org/wiki/Jackie_Chan', 2, 'KunalRelia', 'Jackie', ''),
(65, '2013-12-13 19:55:52', '65.jpg', '', '', 1, 'KunalRelia', 'Demo 1', ''),
(66, '2013-12-13 20:10:07', '66.', 'http://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Jackie_Chan_by_Gage_Skidmore.jpg/220px-Jackie_Chan_by_Gage_Skidmore.jpg', 'http://en.wikipedia.org/wiki/Jackie_Chan', 0, 'Dhishan', 'Just Me', 'asvs'),
(67, '2013-12-13 20:54:23', '67.jpg', '', '', 0, 'KunalRelia', 'Gohan', ''),
(68, '2013-12-13 22:04:21', '68.', 'http://upload.wikimedia.org/wikipedia/commons/f/f8/Western_Derby_Eland_(Taurotragus_derbianus_derbianus)_3_crop.jpg', 'scc', 0, 'KunalRelia', 'Bharath', 'sddvssdaf'),
(69, '2013-12-13 22:27:27', '69.', 'http://upload.wikimedia.org/wikipedia/commons/f/f8/Western_Derby_Eland_(Taurotragus_derbianus_derbianus)_3_crop.jpg', '', 0, 'KunalRelia', 'Animal', 'sdvsv'),
(70, '2015-04-26 07:48:53', '70.', 'http://en.wikipedia.org/wiki/File:Taj_Mahal_in_March_2004.jpg', 'www.wikipedia.com', 0, 'kk', 'Taj Mahal', 'Wonder'),
(71, '2015-04-26 07:49:11', '71.', 'http://en.wikipedia.org/wiki/File:Taj_Mahal_in_March_2004.jpg', 'www.wikipedia.com/taj', 0, 'kk', 'Taj Mahal', 'Wonder'),
(72, '2015-04-26 07:49:26', '72.', 'http://en.wikipedia.org/wiki/File:Taj_Mahal_in_March_2004.jpeg', 'www.wikipedia.com/taj', 0, 'kk', 'Taj Mahal', 'Wonder'),
(73, '2015-04-26 07:49:50', '73.', 'http://en.wikipedia.org/wiki/File:Taj_Mahal_in_March_2004.jpg', 'www.wikipedia.com/taj', 0, 'kk', 'Taj Mahal', 'Wonder'),
(74, '2015-05-06 04:20:34', '74.', 'http://upload.wikimedia.org/wikipedia/commons/c/c8/Taj_Mahal_in_March_2004.jpg', 'www.wikipedia.com/taj', 2, 'kk', 'Taj Mahal', 'Wonder'),
(75, '2015-04-27 08:29:39', '75.', 'http://images1.fanpop.com/images/image_uploads/Pyramids-of-Giza-egypt-1239953_1600_1200.jpg', 'http://images1.fanpop.com/images/image_uploads/Pyramids-of-Giza-egypt-1239953_1600_1200.jpg', 1, 'kk', 'Pyramids of Giza', 'Pyramids of Giza'),
(76, '2015-05-04 21:07:25', '76.', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'EifTow', 'hjhkjhkjhkjh'),
(77, '2015-05-04 21:07:40', '77.', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 'http://en.wikipedia.org', 0, 'kk', 'EifTow', 'hjhkjhkjhkjh'),
(78, '2015-05-04 21:09:00', '78.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 'http://en.wikipedia.org', 0, 'kk', 'EifTow', 'hjhkjhkjhkjh'),
(79, '2015-05-05 20:39:37', '79.', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'EifTow', 'The roof of Paris'),
(80, '2015-05-05 20:41:17', '80.', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(81, '2015-05-05 20:43:58', '81.', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(82, '2015-05-05 20:45:39', '82.', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(83, '2015-05-05 20:47:42', '83.', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(84, '2015-05-05 20:52:04', '84.', 'http://en.wikipedia.org/wiki/Great_Wall_of_China#/media/File:The_Great_Wall_of_China_at_Jinshanling.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of Chian'),
(85, '2015-05-05 20:55:04', '85.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of Chian'),
(86, '2015-05-05 21:08:54', '86.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of Chian'),
(87, '2015-05-05 21:09:23', '87.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org/wiki/Eiffel_Tower#/media/File:Tour_Eiffel_Wikimedia_Commons.jpg', 0, 'kk', 'Great Wall of China', 'Great Wall of Chian'),
(88, '2015-05-05 21:10:04', '88.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(89, '2015-05-05 21:11:34', '89.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(90, '2015-05-05 21:15:24', '90.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(91, '2015-05-05 21:16:39', '91.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of China', 'Great Wall of China'),
(92, '2015-05-05 21:17:06', '92.', 'https://academichelp.net/wp-content/uploads/2013/01/Great-Wall-of-China.jpg', 'http://en.wikipedia.org', 0, 'kk', 'Great Wall of Chinaaaa', 'Great Wall of China'),
(93, '2015-05-06 12:04:46', '93.', 'http://upload.wikimedia.org/wikipedia/commons/c/c8/Taj_Mahal_in_March_2004.jpg', 'http://en.wikipedia.org', 1, 'kk', 'Taj Mahal2', 'Taj Mahal2');

-- --------------------------------------------------------

--
-- Table structure for table `pinboards`
--

CREATE TABLE IF NOT EXISTS `pinboards` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `board_name` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `comment_status` enum('Friends','Public','Private') DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `pinboards`
--

INSERT INTO `pinboards` (`row_id`, `created`, `user_id`, `board_name`, `description`, `comment_status`) VALUES
(1, '2013-11-25 01:03:52', 'KunalRelia', 'Celebrities', 'Favourite Celebrities', 'Private'),
(2, '2013-11-25 00:38:42', 'Naimesh', 'Singers', 'Favourite Singers', 'Public'),
(3, '2013-11-25 01:03:47', 'AbhiPil', 'Serials', 'Favourite Serials', 'Public'),
(4, '2013-11-25 01:14:29', 'Dhishan', 'Actors', 'Favourite Actors', 'Friends'),
(6, '2013-11-25 01:14:46', 'KK', 'Kannada Actors', 'Favourite Kannada Actors', 'Public'),
(7, '2013-11-25 08:05:05', 'JayPatel', 'Cars', 'Cool Cars', 'Public'),
(9, '2015-05-06 10:54:29', 'JayPatel', 'Celebs', 'Emma', 'Public'),
(13, '2013-12-13 06:03:09', 'KunalRelia', 'Cats', 'Love cats', 'Public'),
(14, '2013-12-13 06:06:16', 'KunalRelia', 'Anime', 'Anime wallpapers', 'Public'),
(15, '2013-12-13 17:33:17', 'Dhishan', 'Cats', 'Love Cats!!', 'Public'),
(16, '2013-12-13 19:54:29', 'KunalRelia', 'Demo', 'Demo', 'Public'),
(17, '2013-12-13 19:58:26', 'KunalRelia', 'Cars', '', 'Public'),
(18, '2015-04-26 08:28:00', 'kk', 'Woonders', 'ad', 'Public'),
(19, '2015-04-27 05:49:35', 'naimesh', 'Waaaaah Taj', 'Taj Mahal', 'Friends'),
(44, '2015-05-01 09:01:31', 'KK', 'Sachin Sachin!!', 'Sachin Tendulkar', 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE IF NOT EXISTS `pins` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pinboard_id` int(11) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `parent_row_id` int(11) DEFAULT NULL,
  `local_likes` int(11) DEFAULT '0',
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`),
  KEY `pins_ibfk_7` (`picture_id`),
  KEY `pins_ibfk_4` (`pinboard_id`),
  KEY `pins_ibfk_6` (`parent_row_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`row_id`, `created`, `pinboard_id`, `user_id`, `tags`, `picture_id`, `parent_row_id`, `local_likes`) VALUES
(1, '2013-12-13 07:00:54', 1, 'KunalRelia', 'Actress, Celebrities', 1, 1, 1),
(9, '2013-12-13 03:07:15', 7, 'JayPatel', 'Cars, Fast Cars', 8, 9, 1),
(27, '2015-04-26 09:31:56', 1, 'KunalRelia', 'Actor Famous', 64, 27, 1),
(29, '2013-12-13 19:55:52', 16, 'KunalRelia', 'Demo 2', 65, 29, 1),
(30, '2013-12-13 20:10:07', 4, 'Dhishan', 'ascacs', 66, 30, 0),
(33, '2013-12-13 22:27:27', 14, 'KunalRelia', 'sdvgd', 69, 33, 0),
(38, '2015-05-06 04:20:34', 6, 'kk', 'Wonders,Place to see', 74, 38, 2),
(39, '2015-04-30 15:45:53', 18, 'kk', 'Live Wonder', 64, 27, 1),
(40, '2015-05-04 21:12:24', 18, 'kk', 'Cars, Fast Cars', 8, 9, 1),
(43, '2015-04-27 08:29:39', 18, 'kk', 'GizaPyramids', 75, 43, 1),
(46, '2015-05-04 21:09:00', 18, 'kk', 'Wonders,Place to see', 78, 46, 0),
(62, '2015-05-06 12:04:45', 18, 'kk', 'Taj Mahal. Agra', 93, 62, 1);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE IF NOT EXISTS `streams` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `keyword_query` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`row_id`, `created`, `user_id`, `name`, `keyword_query`, `description`) VALUES
(1, '2013-12-02 04:35:55', 'KunalRelia', 'All Celebrities', NULL, 'All celebrities (Actors, Singers etc)'),
(2, '2013-11-25 08:54:28', 'JayPatel', 'Famous People', 'Celebrities', 'All celebrities'),
(3, '2013-12-13 19:57:59', 'KunalRelia', 'Demo', 'Demo', 'kjnknsdc'),
(4, '2015-04-26 08:26:16', 'kk', 'Wonders of d wrld', 'Wonders,Taj', '7 wonders of te wrld');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female','Not declared') DEFAULT NULL,
  `profile_pic_path` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `created`, `fname`, `lname`, `email`, `gender`, `profile_pic_path`, `password`, `last_updated`, `language`, `country`, `status`) VALUES
('AbhiPil', '2015-04-15 04:33:26', 'Abhishek', 'Pillai', 'ab@nyu.edu', 'Male', NULL, 'abhpil', '2013-11-25 00:05:54', 'English', 'USA', 'Active'),
('Dhishan', '2015-04-15 04:35:04', 'Dhishan', 'Amarnatha', 'da@nyu.edu', 'Male', NULL, '987654', '2013-11-25 00:07:01', 'English', 'USA', 'Active'),
('JayPatel', '2015-04-15 04:21:52', 'Jay', 'Patel', 'jp@nyu.edu', 'Male', NULL, '12345', '2013-11-25 07:56:12', 'English', 'USA', 'Active'),
('KK', '2015-04-15 04:20:50', 'Kratika', 'Kasliwal', 'kk@nyu.edu', 'Female', NULL, 'kk', '2013-11-25 00:08:52', 'English', 'USA', 'Active'),
('KunalRelia', '2015-04-15 04:19:36', 'Kunal', 'Relia', 'kbr263@nyu.edu', 'Male', NULL, 'kunalrelia91', '2013-11-24 23:58:40', 'English', 'USA', 'Active'),
('Naimesh', '2015-04-15 04:21:21', 'Naimesh', 'Narsinghani', 'nin212@nyu.edu', 'Male', NULL, 'nin212', '2013-11-25 00:04:37', 'English', 'USA', 'Active'),
('SachinT', '2015-05-01 08:59:05', 'Sachin', 'Tendulkar', 'st@bcci.com', 'Male', NULL, 'st', '2015-05-01 08:59:05', 'English', 'USA', 'Active'),
('Sgoyal', '2015-04-15 04:35:27', 'Samiksha', 'Goyal', 'sg@nyu.edu', 'Female', NULL, 'sg1111', '2013-12-13 10:39:20', NULL, NULL, 'Active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `follow_pinboard`
--
ALTER TABLE `follow_pinboard`
  ADD CONSTRAINT `follow_pinboard_ibfk_2` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_pinboard_ibfk_3` FOREIGN KEY (`pinboard_id`) REFERENCES `pinboards` (`row_id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_5` FOREIGN KEY (`root_pin_id`) REFERENCES `pins` (`row_id`) ON DELETE CASCADE;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `pinboards`
--
ALTER TABLE `pinboards`
  ADD CONSTRAINT `pinboards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `pins`
--
ALTER TABLE `pins`
  ADD CONSTRAINT `pins_ibfk_4` FOREIGN KEY (`pinboard_id`) REFERENCES `pinboards` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pins_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pins_ibfk_6` FOREIGN KEY (`parent_row_id`) REFERENCES `pins` (`row_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pins_ibfk_7` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`row_id`) ON DELETE CASCADE;

--
-- Constraints for table `streams`
--
ALTER TABLE `streams`
  ADD CONSTRAINT `streams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
