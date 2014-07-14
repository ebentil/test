-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2013 at 10:07 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assessment`
--
CREATE DATABASE `assessment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assessment`;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `subjects` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_id` (`class_id`),
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_id`, `class_name`, `subjects`) VALUES
(58, 'C20130802133231', 'N 2', 'SUBJ20130801130011,SUBJ20130801130024,SUBJ20130801131002,SUBJ20130802093829'),
(59, 'C20130802133239', 'KG 1', 'SUBJ20130801130011,SUBJ20130801130024,SUBJ20130801130807,SUBJ20130801131002'),
(60, 'C20130802133247', 'KG 2', 'SUBJ20130801125946,SUBJ20130801130011,SUBJ20130801130024'),
(63, 'C20130806095817', 'CLASS 1', 'SUBJ20130801131115,SUBJ20130801125946,SUBJ20130801130011,SUBJ20130801130024,SUBJ20130801130807,SUBJ20130801131002,SUBJ20130802093829'),
(57, 'C20130802133223', 'N 1', 'SUBJ20130801131115,SUBJ20130801125946,SUBJ20130801130011,SUBJ20130801130024,SUBJ20130801130807,SUBJ20130801131002,SUBJ20130802093829');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(20) NOT NULL,
  `total30` varchar(20) NOT NULL,
  `total70` varchar(20) NOT NULL,
  `total100` varchar(20) NOT NULL,
  `overall_position` varchar(20) NOT NULL,
  `att1` varchar(20) NOT NULL,
  `att2` varchar(20) NOT NULL,
  `next_term_begins` varchar(20) NOT NULL,
  `conduct` text NOT NULL,
  `attitude` text NOT NULL,
  `interest` text NOT NULL,
  `form_master_remarks` text NOT NULL,
  `sch_fees` text NOT NULL,
  `sch_mgr_remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `student_id`, `class_id`, `term`, `year`, `total30`, `total70`, `total100`, `overall_position`, `att1`, `att2`, `next_term_begins`, `conduct`, `attitude`, `interest`, `form_master_remarks`, `sch_fees`, `sch_mgr_remarks`) VALUES
(1, 'DV20130806101428', 'C20130806095817', '1st', '2012', '153.3', '353.5', '153.3', '', '23', '45', '12/12/12', 'Wayne has become more confident in class.', 'He is always committed to doing his/her best.', 'He is a talented athlete.', 'He needs to improve classroom attitude.', '', 'He needs to improve classroom attitude.'),
(3, 'DV20130814122333', 'C20130802133231', '1st', '2012', '52.2', '156.1', '52.2', '', '23', '45', '12/12/12', 'Scooby is an enthusiastic learner who seems to enjoy school.', 'He shows great interest in all classroom activities.', 'He enjoys sharing his ideas with others.', 'I am pleased to report that Scooby is showing positive development in regards to his attitude in the classroom.', 'uyijihjyughijyuhi', 'He can do better if he makes his mind up to work harder.'),
(2, 'DV20130806101444', 'C20130806095817', '1st', '2012', '0.9', '0', '0.9', '', '23', '45', '12/12/12', 'Didier shows respect for teachers and peers.', 'He is always committed to doing his/her best.', 'He is very good at physical activities.', 'He frequently needs to be reminded to be respectful.', '', 'He can do well if he decides to work harder and listens to instructions.'),
(4, 'DV20130814122227', 'C20130802133231', '1st', '2012', '62.64', '130.9', '62.64', '', '34', '55', '', 'Dean has become more confident in class.', 'He always follows classroom rules.', 'null', 'null', '', 'null'),
(5, 'DV20130814122259', 'C20130802133231', '1st', '2012', '85.05', '213.43', '85.05', '', '23', '34', '', 'Ama is cooperative and well mannered.', 'She does not do her home work.', 'She can sing very well.', 'I am pleased to report that Ama is showing positive development in regards to his attitude in the classroom.', '', 'I am pleased to report that Ama is showing positive development in regards to his attitude in the classroom.'),
(6, 'DV20130806101509', 'C20130806095817', '1st', '2012', '2.1', '0', '2.1', '', '', '', '', 'Serena has become more confident in class.', 'null', 'null', 'null', '', 'null'),
(7, 'DV20130806101457', 'C20130806095817', '1st', '2012', '2.1', '0', '2.1', '', '', '', '12/12/12', 'null', 'null', 'null', 'null', '', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `term` varchar(12) NOT NULL,
  `year` varchar(12) NOT NULL,
  `ex1` float NOT NULL,
  `ex2` float NOT NULL,
  `ex3` float NOT NULL,
  `ex4` float NOT NULL,
  `ex_tot` float NOT NULL,
  `t1` float NOT NULL,
  `t2` float NOT NULL,
  `t3` float NOT NULL,
  `t_tot` float NOT NULL,
  `hw1` float NOT NULL,
  `hw2` float NOT NULL,
  `hw3` float NOT NULL,
  `hw4` float NOT NULL,
  `hw_tot` float NOT NULL,
  `c_subtot` float NOT NULL,
  `c_subtot30` float NOT NULL,
  `exam100` float NOT NULL,
  `exam70` float NOT NULL,
  `overall30_70` float NOT NULL,
  `grade` float NOT NULL,
  `position` float NOT NULL,
  `remarks` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `sheets`
--

INSERT INTO `sheets` (`id`, `class_id`, `subject_id`, `student_id`, `term`, `year`, `ex1`, `ex2`, `ex3`, `ex4`, `ex_tot`, `t1`, `t2`, `t3`, `t_tot`, `hw1`, `hw2`, `hw3`, `hw4`, `hw_tot`, `c_subtot`, `c_subtot30`, `exam100`, `exam70`, `overall30_70`, `grade`, `position`, `remarks`) VALUES
(28, 'C20130724114308', 'SUBJ20130724085726', 'DV20130724124501', '', '', 0, 5, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1.5, 0, 0, 1.5, 9, 0, 'Fail'),
(26, 'C20130724114308', 'SUBJ20130724085649', 'DV20130724124422', '', '', 5, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1.5, 0, 0, 1.5, 9, 0, 'Fail'),
(27, 'C20130724114308', 'SUBJ20130724085649', 'DV20130724124436', '', '', 0, 6, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 1.8, 0, 0, 1.8, 9, 0, 'Fail'),
(25, 'C20130724114308', 'SUBJ20130724085649', 'DV20130724124501', '', '', 4, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1.2, 0, 0, 1.2, 9, 0, 'Fail'),
(24, 'C20130724114308', 'SUBJ20130724085005', 'DV20130724124436', '', '', 5, 0, 9, 0, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14, 4.2, 101, 70.7, 74.9, 2, 0, 'Very Good'),
(23, 'C20130724114308', 'SUBJ20130724085005', 'DV20130724124422', '', '', 8, 5, 7, 5, 25, 12, 0, 0, 12, 0, 0, 0, 0, 0, 37, 11.1, 77, 53.9, 65, 3, 0, 'Good'),
(22, 'C20130724114308', 'SUBJ20130724085005', 'DV20130724124501', '', '', 3, 5, 6, 8, 22, 8, 0, 0, 8, 0, 0, 0, 0, 0, 30, 9, 10, 7, 16, 9, 0, 'Fail'),
(29, 'C20130724114308', 'SUBJ20130724085726', 'DV20130724124422', '', '', 4, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1.2, 0, 0, 1.2, 9, 0, 'Fail'),
(30, 'C20130724115617', 'SUBJ20130724114700', 'DV20130724124448', '', '', 6, 7, 5, 6, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 7.2, 0, 0, 7.2, 9, 0, 'Fail'),
(31, 'C20130724114308', 'SUBJ20130724085005', 'DV20130724125715', '', '', 3, 3, 3, 3, 12, 0, 0, 1, 1, 0, 0, 0, 0, 4, 17, 5.1, 3, 2.1, 7.2, 9, 0, 'Fail'),
(32, 'C20130724114308', 'SUBJ20130724085649', 'DV20130724125715', '', '', 5, 7, 7, 5, 24, 15, 7, 6, 28, 0, 4, 5, 5, 14, 66, 19.8, 80, 56, 75.8, 2, 0, 'Very Good'),
(33, 'C20130724114308', 'SUBJ20130724085005', 'DV20130724132739', '', '', 9, 4, 0.6, 5, 18.6, 6, 0, 4.7, 10.7, 0, 8, 5, 6, 26, 55.3, 16.59, 78, 54.6, 71.19, 2, 0, 'Very Good'),
(34, 'C20130724115617', 'SUBJ20130724085005', 'DV20130724124448', '', '', 3, 6, 7, 6, 22, 18, 7, 5, 30, 3, 3, 4, 5, 15, 67, 20.1, 62, 43.4, 63.5, 3, 0, 'Good'),
(44, 'C20130806095817', 'SUBJ20130801131115', 'DV20130806101509', '1st', '2012', 5, 6, 8, 9, 28, 19, 7, 6, 32, 5, 4, 4, 6, 19, 79, 23.7, 90, 63, 86.7, 1, 0, 'Excellent'),
(42, 'C20130806095817', 'SUBJ20130801131002', 'DV20130806101428', '1st', '2012', 9, 9, 5, 7, 30, 16, 9, 8, 33, 4, 5, 3, 5, 17, 80, 24, 80, 56, 80, 1, 0, 'Excellent'),
(43, 'C20130806095817', 'SUBJ20130801131002', 'DV20130806101509', '1st', '2012', 2, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0.6, 0, 0, 0.6, 9, 0, 'Fail'),
(37, 'C20130806095817', 'SUBJ20130801130011', 'DV20130806101428', '1st', '2012', 8, 6, 5, 8, 27, 16, 5, 8, 29, 4, 5, 3, 5, 17, 73, 21.9, 50, 35, 56.9, 3, 0, 'Good'),
(39, 'C20130806095817', 'SUBJ20130801131115', 'DV20130806101457', '1st', '2012', 7, 4, 5, 5, 21, 7, 9, 9, 25, 5, 4, 4, 3, 16, 62, 18.6, 87, 60.9, 79.5, 1, 0, 'Excellent'),
(40, 'C20130806095817', 'SUBJ20130801131115', 'DV20130806101444', '1st', '2012', 3, 8, 9, 7, 27, 16, 9.5, 5, 30.5, 5, 3.8, 4, 4.9, 17.7, 75.2, 22.56, 76, 53.2, 75.76, 9, 0, 'Fail'),
(41, 'C20130806095817', 'SUBJ20130801131115', 'DV20130806101428', '1st', '2012', 3, 5, 8, 7, 23, 17, 5, 8, 30, 4, 3, 2, 5, 14, 67, 20.1, 60, 42, 62.1, 3, 0, 'Good'),
(45, 'C20130806095817', 'SUBJ20130801125946', 'DV20130806101428', '1st', '2012', 8, 9, 7, 6, 30, 17, 6, 9, 32, 4, 2, 5, 5, 16, 78, 23.4, 78, 54.6, 78, 1, 0, 'Excellent'),
(46, 'C20130806095817', 'SUBJ20130801130024', 'DV20130806101428', '1st', '2012', 5, 7, 8, 6, 26, 16, 7, 9, 32, 4, 3, 4, 5, 16, 74, 22.2, 90, 63, 85.2, 1, 0, 'Excellent'),
(47, 'C20130806095817', 'SUBJ20130801130807', 'DV20130806101428', '1st', '2012', 6, 7, 5, 7, 25, 15, 6, 8, 29, 4, 3, 2, 4, 13, 67, 20.1, 80, 56, 76.1, 1, 0, 'Excellent'),
(48, 'C20130806095817', 'SUBJ20130802093829', 'DV20130806101428', '1st', '2012', 9, 7, 6, 9, 31, 15, 7, 6, 28, 4, 3, 2, 4, 13, 72, 21.6, 67, 46.9, 68.5, 2, 0, 'Very Good'),
(49, 'C20130802133231', 'SUBJ20130801130011', 'DV20130814122227', '1st', '2012', 7, 8, 9, 5, 29, 14, 5, 7, 26, 4, 5, 5, 3, 17, 72, 21.6, 67, 46.9, 68.5, 2, 0, 'Very Good'),
(50, 'C20130802133231', 'SUBJ20130801130011', 'DV20130814122333', '1st', '2012', 4, 6, 8, 7, 25, 6, 5, 6, 17, 4, 3, 3, 5, 15, 57, 17.1, 64, 44.8, 61.9, 3, 0, 'Good'),
(51, 'C20130802133231', 'SUBJ20130801130011', 'DV20130814122259', '1st', '2012', 6, 6, 7, 10, 29, 19, 6, 6, 31, 5, 5, 4, 4, 18, 78, 23.4, 87, 60.9, 84.3, 1, 0, 'Excellent'),
(52, 'C20130802133231', 'SUBJ20130801130011', 'DV20130814122316', '1st', '2012', 5, 7, 8, 8, 28, 16, 6, 6, 28, 4, 5, 4, 3, 16, 72, 21.6, 80, 56, 77.6, 1, 0, 'Excellent'),
(53, 'C20130802133231', 'SUBJ20130801130024', 'DV20130814122227', '1st', '2012', 4, 5, 6, 6, 21, 17, 7, 4, 28, 4, 2, 5, 4, 15, 64, 19.2, 70, 49, 68.2, 2, 0, 'Very Good'),
(54, 'C20130802133231', 'SUBJ20130801130024', 'DV20130814122333', '1st', '2012', 5, 6, 9, 5, 25, 19, 7, 8, 34, 4, 3, 3, 3, 13, 72, 21.6, 89, 62.3, 83.9, 1, 0, 'Excellent'),
(55, 'C20130802133231', 'SUBJ20130801130024', 'DV20130814122259', '1st', '2012', 3, 6, 7, 8, 24, 20, 7, 10, 37, 5, 5, 5, 5, 20, 81, 24.3, 80, 56, 80.3, 1, 0, 'Excellent'),
(56, 'C20130802133231', 'SUBJ20130801130024', 'DV20130814122316', '1st', '2012', 5, 7, 8, 8, 28, 18, 7, 9, 34, 4, 3, 4, 5, 16, 78, 23.4, 76, 53.2, 76.6, 1, 0, 'Excellent'),
(57, 'C20130802133231', 'SUBJ20130801131002', 'DV20130814122227', '1st', '2012', 3, 4, 6, 7, 20, 7, 8, 9, 24, 3, 3, 3, 4, 13, 57, 17.1, 50, 35, 52.1, 4, 0, 'Satisfactory'),
(58, 'C20130802133231', 'SUBJ20130801131002', 'DV20130814122333', '1st', '2012', 1, 2, 3, 4, 10, 4, 5, 6, 15, 5, 5, 5, 5, 20, 45, 13.5, 70, 49, 62.5, 3, 0, 'Good'),
(59, 'C20130802133231', 'SUBJ20130801131002', 'DV20130814122259', '1st', '2012', 3, 5, 5, 6, 19, 6, 6, 7, 19, 4, 5, 4.5, 5, 18.5, 56.5, 16.95, 67.9, 47.53, 64.48, 3, 0, 'Good'),
(60, 'C20130802133231', 'SUBJ20130801131002', 'DV20130814122316', '1st', '2012', 8.7, 6.7, 5.8, 9.8, 31, 17.4, 5, 7.8, 30.2, 3, 4, 4, 5, 16, 77.2, 23.16, 80, 56, 79.16, 1, 0, 'Excellent'),
(61, 'C20130802133231', 'SUBJ20130802093829', 'DV20130814122227', '1st', '2012', 5, 5, 5.8, 0, 15.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 15.8, 4.74, 0, 0, 4.74, 9, 0, 'Fail'),
(62, 'C20130802133231', 'SUBJ20130802093829', 'DV20130814122259', '1st', '2012', 5, 4, 9, 5, 23, 12, 9, 6, 27, 4, 5, 5, 4, 18, 68, 20.4, 70, 49, 69.4, 2, 0, 'Very Good');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `account_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `lname`, `fname`, `username`, `password`, `account_type`) VALUES
(25, 'ST20130815115418', 'Bentil', 'Ebo', 'ebobent', 'hxk5KWfZVDydY', 'Admin'),
(26, 'ST20130815115528', 'Sam', 'Ama', 'amasam', 'hxk5KWfZVDydY', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `class_id`, `lname`, `fname`, `gender`) VALUES
(93, 'DV20130724125715', 'C20130724114308', 'Steve', 'Jobs', 'male'),
(92, 'DV20130724124501', 'C20130724114308', 'GI', 'Joe', 'male'),
(91, 'DV20130724124448', 'C20130724115617', 'Shawn', 'BIll', 'male'),
(89, 'DV20130724124422', 'C20130724114308', 'Kevin', 'Totto', 'male'),
(90, 'DV20130724124436', 'C20130724114308', 'Lotto', 'Boys', 'male'),
(94, 'DV20130724132739', 'C20130724114308', 'Sally', 'Gen', 'female'),
(95, 'DV20130729174355', 'C20130724115617', 'Jennifer', 'Aniston', 'female'),
(96, 'DV20130730103053', 'C20130724114308', 'Alex', 'King', 'male'),
(97, 'DV20130730103121', 'C20130724114308', 'David', 'Beckham', 'female'),
(98, 'DV20130730103723', 'C20130724115617', 'Dexter', 'Lab', 'male'),
(99, 'DV20130730103749', 'C20130729175155', 'Rhoda', 'Island', 'male'),
(100, 'DV20130730103834', 'C20130729175147', 'Larry', 'King', 'male'),
(101, 'DV20130730104103', 'C20130724114308', 'George', 'Todd', 'male'),
(102, 'DV20130806101428', 'C20130806095817', 'Rooney', 'Wayne', 'male'),
(103, 'DV20130806101444', 'C20130806095817', 'Drogba', 'Didier', 'male'),
(104, 'DV20130806101457', 'C20130806095817', 'Essien', 'Micheal', 'male'),
(105, 'DV20130806101509', 'C20130806095817', 'Williams', 'Serena', 'female'),
(106, 'DV20130814122227', 'C20130802133231', 'Winchester', 'Dean', 'male'),
(107, 'DV20130814122259', 'C20130802133231', 'Cole', 'Ama', 'female'),
(108, 'DV20130814122316', 'C20130802133231', 'Freda', 'Fins', 'female'),
(109, 'DV20130814122333', 'C20130802133231', 'Doo', 'Scooby', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `subject_id` varchar(100) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_name` (`subject_name`),
  UNIQUE KEY `subject_name_2` (`subject_name`),
  UNIQUE KEY `subject_name_3` (`subject_name`),
  UNIQUE KEY `subject_name_4` (`subject_name`),
  UNIQUE KEY `subject_name_5` (`subject_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_id`, `subject_name`) VALUES
(33, 'SUBJ20130801131115', 'Information Communication Technology'),
(24, 'SUBJ20130801125946', 'English Language'),
(25, 'SUBJ20130801130011', 'Mathematics'),
(26, 'SUBJ20130801130024', 'Integrated Science'),
(28, 'SUBJ20130801130807', 'Ghanaian Language '),
(29, 'SUBJ20130801131002', 'Basic Technology '),
(35, 'SUBJ20130802093829', 'French'),
(36, 'SUBJ20130815132833', 'Social Studies'),
(37, 'SUBJ20130815133318', 'Religious & Moral Education'),
(38, 'SUBJ20130815133343', 'Natural Science'),
(39, 'SUBJ20130815133404', 'Creative Arts'),
(40, 'SUBJ20130815133421', 'Citizenship Education'),
(42, 'SUBJ20130815133538', 'Language/Literacy'),
(44, 'SUBJ20130816144043', 'Environmental Studies');
