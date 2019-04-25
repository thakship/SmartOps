-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 05:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `remitdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dfcc_para`
--

CREATE TABLE IF NOT EXISTS `dfcc_para` (
  `biz_entity` int(6) NOT NULL,
  `biz_name` varchar(50) NOT NULL,
  PRIMARY KEY (`biz_entity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dfcc parameters';

--
-- Dumping data for table `dfcc_para`
--

INSERT INTO `dfcc_para` (`biz_entity`, `biz_name`) VALUES
(1, 'DFCC Bank');

-- --------------------------------------------------------

--
-- Table structure for table `dfcc_remit`
--

CREATE TABLE IF NOT EXISTS `dfcc_remit` (
  `batch_num` int(12) NOT NULL,
  `tran_id` varchar(15) NOT NULL,
  `ref_num` varchar(15) DEFAULT NULL,
  `sender_name` varchar(90) NOT NULL,
  `sender_curr` varchar(3) NOT NULL,
  `sender_phone` varchar(15) NOT NULL,
  `tran_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `benif_name` varchar(90) NOT NULL,
  `benif_glob_id` varchar(15) NOT NULL,
  `benif_cont_num` varchar(15) NOT NULL,
  `purpose` varchar(40) NOT NULL,
  `acc_num` varchar(18) NOT NULL,
  `bank_code` int(4) NOT NULL,
  `bran_code` int(3) NOT NULL,
  PRIMARY KEY (`batch_num`,`tran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dfcc_remit';

--
-- Dumping data for table `dfcc_remit`
--

INSERT INTO `dfcc_remit` (`batch_num`, `tran_id`, `ref_num`, `sender_name`, `sender_curr`, `sender_phone`, `tran_amt`, `benif_name`, `benif_glob_id`, `benif_cont_num`, `purpose`, `acc_num`, `bank_code`, `bran_code`) VALUES
(1, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 1),
(1, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 5),
(2, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '2000', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 1),
(2, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '3000', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 5),
(3, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 1),
(3, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '2147483647', 7746, 5),
(4, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(4, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5),
(5, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(5, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5),
(6, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(6, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5),
(7, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(7, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5),
(8, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(8, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5),
(9, '11567', '01000022', 'TEST REMIT', 'LKR', '97150234567', '200', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000100056889000101', 7746, 1),
(9, '11568', '01000023', 'TEST REMIT', 'LKR', '97150234567', '300', 'TEST BENEFI', '', '', 'HOME REMITANCE', '000500001113000101', 7746, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dfcc_remit_hd`
--

CREATE TABLE IF NOT EXISTS `dfcc_remit_hd` (
  `batch_num` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `upload_date` date NOT NULL,
  `upload_by` varchar(8) NOT NULL,
  `process_serial` int(11) NOT NULL DEFAULT '0',
  `process_date` date NOT NULL,
  `process_by` varchar(8) NOT NULL,
  PRIMARY KEY (`batch_num`),
  UNIQUE KEY `file_name` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dfcc_remit_hd';

--
-- Dumping data for table `dfcc_remit_hd`
--

INSERT INTO `dfcc_remit_hd` (`batch_num`, `file_name`, `upload_date`, `upload_by`, `process_serial`, `process_date`, `process_by`) VALUES
(1, 'PartnerTransaction79934.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(2, 'PartnerTransaction79935.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(3, 'PartnerTransaction79936.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(4, 'PartnerTransaction79937.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(5, 'PartnerTransaction79938.txt', '2016-02-19', 'USER1', 0, '0000-00-00', ''),
(6, 'PartnerTransaction79939.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(7, 'PartnerTransaction79940.txt', '2016-02-19', 'USER1', 1, '2016-02-24', 'USER1'),
(8, 'PartnerTransaction79941.txt', '2016-02-23', 'USER1', 2, '2016-02-24', 'USER1'),
(9, 'PartnerTransaction79942.txt', '2016-02-23', 'USER1', 1, '2016-02-24', 'USER1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dfcc_remit`
--
ALTER TABLE `dfcc_remit`
  ADD CONSTRAINT `dfcc_remit_ibfk_1` FOREIGN KEY (`batch_num`) REFERENCES `dfcc_remit_hd` (`batch_num`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
