-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2014 at 12:39 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gluten_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `user_id`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`note_id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `user_id`, `doctor_id`, `content`, `date`, `type`, `is_checked`) VALUES
(1, 5, NULL, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.', '2014-05-06 00:00:00', 'Déjeuner', 0),
(2, 5, 1, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.', '2014-05-06 00:00:00', 'Déjeuner', 0),
(3, 5, NULL, 'Coucou', '2014-05-07 10:44:04', 'Déjeuner', 0),
(4, 5, NULL, 'azeazaze', '2014-05-07 10:44:42', 'Diner', 0),
(5, 5, NULL, 'ytrytryryr', '2014-05-07 14:25:53', 'Déjeuner', 0),
(6, 5, NULL, 'Rien', '2014-05-12 11:25:57', 'Déjeuner', 0),
(7, 5, 1, 'lol', '2014-05-12 11:25:57', 'Déjeuner', 0),
(8, 5, NULL, 'test', '2014-05-14 10:18:36', 'Déjeuner', 1),
(9, 5, 1, 're test', '2014-05-14 10:18:36', 'Déjeuner', 0);

-- --------------------------------------------------------

--
-- Table structure for table `particularity`
--

CREATE TABLE IF NOT EXISTS `particularity` (
  `particularity_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `is_particularity` tinyint(1) NOT NULL,
  `header` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`particularity_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `size` double DEFAULT NULL,
  `intolerances` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `user_id` (`user_id`,`doctor_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `user_id`, `doctor_id`, `birthday`, `weight`, `size`, `intolerances`) VALUES
(3, 5, 1, '1989-07-01 00:00:00', 84, 1.92, 'Aucune :p'),
(4, 7, 1, NULL, NULL, NULL, NULL),
(5, 8, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `todo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`todo_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `user_id`, `content`) VALUES
(1, 5, '100 gr - Pain aux graines de tournesol'),
(2, 5, '100 gr - Pain aux graines de tournesol');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE IF NOT EXISTS `treatment` (
  `treatment_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`treatment_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `patient_id`, `month`, `count`) VALUES
(1, 3, 1, 5),
(2, 3, 2, 0),
(3, 3, 3, 0),
(4, 3, 4, 7),
(5, 3, 5, 1),
(6, 3, 6, 0),
(7, 3, 7, 0),
(8, 3, 8, 5),
(9, 3, 9, 0),
(10, 3, 10, 0),
(11, 3, 11, 0),
(12, 3, 12, 0),
(13, 4, 1, 0),
(14, 4, 2, 0),
(15, 4, 3, 0),
(16, 4, 4, 0),
(17, 4, 5, 0),
(18, 4, 6, 0),
(19, 4, 7, 0),
(20, 4, 8, 0),
(21, 4, 9, 0),
(22, 4, 10, 0),
(23, 4, 11, 0),
(24, 4, 12, 0),
(25, 5, 1, 0),
(26, 5, 2, 0),
(27, 5, 3, 0),
(28, 5, 4, 0),
(29, 5, 5, 0),
(30, 5, 6, 0),
(31, 5, 7, 0),
(32, 5, 8, 0),
(33, 5, 9, 0),
(34, 5, 10, 0),
(35, 5, 11, 0),
(36, 5, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture_src` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `is_doctor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `picture_src`, `lastname`, `firstname`, `phone_number`, `address_1`, `address_2`, `is_doctor`) VALUES
(5, 'anthony@rorkal.be', 'e618d2beb1c10bc92cd809ee896c084d', NULL, 'Caudron', 'Anthony', '0494 02 12 12', 'Rue de l''Europe, 15', '5000 Namur', 0),
(6, 'simon@rorkal.be', 'e618d2beb1c10bc92cd809ee896c084d', NULL, NULL, NULL, '0444 44 44 44', 'zerzerze', '', 1),
(7, 'zaeazeaz@zaeaze.com', 'f501a966c1985b47769568ddd3b36dbd', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 'jean@zaea.com', '27e6cb6c6de07ab44a220a53eda4f5cf', NULL, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `particularity`
--
ALTER TABLE `particularity`
  ADD CONSTRAINT `particularity_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
