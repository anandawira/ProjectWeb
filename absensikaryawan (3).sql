-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 01:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensikaryawan`
--
CREATE DATABASE IF NOT EXISTS `absensikaryawan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `absensikaryawan`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `add_department`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_department` (IN `name` VARCHAR(20))  NO SQL
INSERT INTO department VALUES('',name,true)$$

DROP PROCEDURE IF EXISTS `add_employee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_employee` (IN `name` VARCHAR(100), IN `deptId` SMALLINT, IN `pos` VARCHAR(50), IN `shiftId` SMALLINT)  NO SQL
INSERT INTO `employee` (`no`, `full_name`, `dept_id`, `position`, `shift_id`, `isActive`) 
VALUES (NULL, name, deptId, pos, shiftId, '1')$$

DROP PROCEDURE IF EXISTS `add_location`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_location` (IN `name` VARCHAR(50))  NO SQL
INSERT INTO location VALUES('',name,true)$$

DROP PROCEDURE IF EXISTS `add_shift`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_shift` (IN `inTime` TIME, IN `outTime` TIME)  NO SQL
INSERT INTO `shift` (`id`, `in_time`, `out_time`) VALUES (NULL, inTime, outTime)$$

DROP PROCEDURE IF EXISTS `delete_department`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_department` (IN `deleteId` INT)  NO SQL
UPDATE department
SET isActive = false
WHERE id=deleteId$$

DROP PROCEDURE IF EXISTS `delete_employee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee` (IN `deleteId` INT)  NO SQL
UPDATE employee
SET isActive = false
WHERE employee.no=deleteId$$

DROP PROCEDURE IF EXISTS `delete_location`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_location` (IN `deleteID` INT)  NO SQL
UPDATE location
SET isActive = false
WHERE id=deleteId$$

DROP PROCEDURE IF EXISTS `delete_shift`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_shift` (IN `deleteID` INT)  NO SQL
UPDATE shift
SET isActive = false
WHERE id=deleteId$$

DROP PROCEDURE IF EXISTS `edit_department`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_department` (IN `editID` SMALLINT, IN `editName` VARCHAR(20))  NO SQL
UPDATE department
SET name = editName
WHERE id=editID$$

DROP PROCEDURE IF EXISTS `edit_employee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_employee` (IN `noEdit` INT, IN `name` VARCHAR(100), IN `deptId` INT, IN `pos` VARCHAR(50), IN `shiftId` INT)  NO SQL
UPDATE `employee` SET `full_name` = name, `dept_id` = deptID, `position` = pos, `shift_id` = shiftId WHERE `employee`.`no` = noEdit$$

DROP PROCEDURE IF EXISTS `edit_location`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_location` (IN `editID` INT, IN `editName` VARCHAR(50))  NO SQL
UPDATE location
SET name = editName
WHERE id=editID$$

DROP PROCEDURE IF EXISTS `edit_shift`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_shift` (IN `editID` INT, IN `inTime` TIME, IN `outTime` TIME)  NO SQL
UPDATE shift
SET `in_time` = inTime, `out_time` = outTime
WHERE id=editID$$

DROP PROCEDURE IF EXISTS `get_departments`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_departments` ()  NO SQL
SELECT * FROM department WHERE isActive = true$$

DROP PROCEDURE IF EXISTS `get_employee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee` (IN `employeeNo` MEDIUMINT)  NO SQL
SELECT employee.full_name, employee.no, department.name AS department, employee.position, shift.in_time, shift.out_time
FROM employee
LEFT JOIN department
ON employee.dept_id = department.id
LEFT JOIN shift
ON employee.shift_id = shift.id
WHERE employee.no = employeeNo$$

DROP PROCEDURE IF EXISTS `get_employees`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employees` ()  NO SQL
SELECT employee.no , employee.full_name, employee.dept_id, department.name AS department_name, employee.position, employee.shift_id, shift.in_time, shift.out_time
FROM employee
LEFT JOIN department
ON employee.dept_id = department.id
LEFT JOIN shift
ON employee.shift_id = shift.id
WHERE employee.isActive = 1$$

DROP PROCEDURE IF EXISTS `get_locations`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_locations` ()  NO SQL
SELECT * FROM location WHERE isActive = true$$

DROP PROCEDURE IF EXISTS `get_shifts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_shifts` ()  NO SQL
SELECT * FROM shift WHERE isActive = true$$

DROP PROCEDURE IF EXISTS `record_attendance`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `record_attendance` (IN `empID` INT, IN `locID` INT, IN `note` VARCHAR(200), IN `file` VARCHAR(50), IN `types` ENUM('in','out'))  NO SQL
INSERT INTO `attendance` (`id`, `time`, `employee_id`, `location_id`, `notes`, `file_name`, `type`) VALUES (NULL, current_timestamp(), empID, locID, note, file, types)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` enum('in','out') NOT NULL,
  `employee_id` mediumint(9) NOT NULL,
  `location_id` smallint(6) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `file_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `time`, `type`, `employee_id`, `location_id`, `notes`, `file_name`) VALUES
(43, '2020-05-10 09:07:55', 'in', 100010, 1, '', '100010_1589101675045.png'),
(44, '2020-05-10 09:08:42', 'in', 100010, 1, '', '100010_1589101722923.png'),
(45, '2020-05-10 09:08:44', 'out', 100010, 1, '', '100010_1589101724166.png'),
(46, '2020-05-10 09:08:45', 'in', 100010, 1, '', '100010_1589101725060.png'),
(47, '2020-05-10 09:31:07', 'in', 100010, 1, '', '100010_1589103067448.png'),
(48, '2020-05-10 09:31:47', 'in', 100010, 1, '', '100010_1589103107209.jpg'),
(49, '2020-05-10 09:34:20', 'in', 100010, 2, 'Loh loh loh', '100010_1589103259990.png');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` smallint(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `isActive`) VALUES
(1, 'Finance', 1),
(2, 'Marketing', 1),
(3, 'Production', 1),
(4, 'IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `no` mediumint(9) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `dept_id` smallint(6) NOT NULL,
  `position` varchar(50) NOT NULL,
  `shift_id` smallint(6) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`no`, `full_name`, `dept_id`, `position`, `shift_id`, `isActive`) VALUES
(100001, 'Ananda Wiradharma', 2, 'Staff', 1, 0),
(100002, 'Hooman', 2, 'Operator', 1, 0),
(100003, 'Lucifer', 3, 'Investor', 3, 0),
(100004, 'Jasmine', 3, 'Engineer', 1, 0),
(100005, 'Ananda Wiradharma', 4, 'Engineer', 1, 0),
(100006, 'Xiaomi', 4, 'Manager', 2, 0),
(100007, 'Goblok', 2, 'Engineer', 1, 0),
(100008, 'Useless Man', 2, 'Staff', 2, 0),
(100009, 'Aladdin', 4, 'Engineer', 1, 1),
(100010, 'Abu', 3, 'Engineer', 2, 1),
(100011, 'Jasmine', 2, 'Engineer', 1, 1),
(100012, 'Simpson', 3, 'Staff', 1, 0),
(100013, 'John Wick', 4, 'Staff', 3, 1),
(100014, 'Home Credit', 3, 'Operator', 1, 1),
(100015, 'LG', 4, 'Manager', 1, 1),
(100016, 'Logitech', 3, 'Manager', 1, 1),
(100017, 'VenomRX', 3, 'Manager', 1, 1),
(100018, 'SanDisk', 4, 'Engineer', 1, 1),
(100019, 'Sanyo', 1, 'Engineer', 1, 1),
(100020, 'Copyright', 2, 'Staff', 1, 1),
(100021, 'Yonex', 3, 'Operator', 1, 0),
(100022, 'Yonex', 3, 'Operator', 1, 1),
(100023, 'God', 3, 'Supervisor', 2, 1),
(100024, 'Ananda Wiradharma', 1, 'Operator', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `isActive`) VALUES
(1, 'Home', 1),
(2, 'Office', 1),
(3, 'Factory', 1),
(4, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

DROP TABLE IF EXISTS `shift`;
CREATE TABLE `shift` (
  `id` smallint(6) NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `in_time`, `out_time`, `isActive`) VALUES
(1, '07:00:00', '15:00:00', 1),
(2, '15:00:00', '23:00:00', 1),
(3, '23:00:00', '07:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`no`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `no` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100025;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`no`) ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
