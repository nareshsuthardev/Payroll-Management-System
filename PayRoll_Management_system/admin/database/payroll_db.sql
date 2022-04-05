-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2021 at 02:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `emp_id` int(5) NOT NULL,
  `attendance_name` varchar(20) NOT NULL,
  `date_of_attendance` date NOT NULL,
  `working_hours` int(2) DEFAULT 12,
  `attendance_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`emp_id`, `attendance_name`, `date_of_attendance`, `working_hours`, `attendance_status`) VALUES
(21422, 'Ganesh', '2021-09-24', 12, 'Present'),
(21420, 'Naresh', '2021-09-24', 12, 'Present'),
(21421, 'Padmaja', '2021-09-24', 12, 'Absent'),
(21424, 'Prajwal', '2021-09-24', 12, 'Present'),
(21423, 'Prem', '2021-09-24', 12, 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `ded_id` int(5) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `pf_amount` double(8,2) DEFAULT NULL,
  `advanced_salary_amount` double(8,2) DEFAULT NULL,
  `loan_amount` double(8,2) DEFAULT NULL,
  `total_ded` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`ded_id`, `emp_id`, `pf_amount`, `advanced_salary_amount`, `loan_amount`, `total_ded`) VALUES
(1, 21420, 2000.00, 0.00, 0.00, 2000.00),
(2, 21421, 0.00, 2000.00, 0.00, 2000.00),
(3, 21422, 500.00, 400.00, 0.00, 900.00),
(4, 21423, 7000.00, 0.00, 0.00, 7000.00),
(5, 21424, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `hire_date` date NOT NULL,
  `pos_id` int(11) DEFAULT NULL,
  `payroll_id` int(5) DEFAULT NULL,
  `salary_id` int(5) DEFAULT NULL,
  `total_deduction` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `email`, `hire_date`, `pos_id`, `payroll_id`, `salary_id`, `total_deduction`) VALUES
(21420, 'Naresh', 'Naresh@GmailCom', '2002-08-07', 1, 3020, 101, 2000.00),
(21421, 'Padmaja', 'Padmaja@GmailCom', '2002-09-07', 2, 3021, 102, 2000.00),
(21422, 'Ganesh', 'Ganesh@GmailCom', '2002-10-05', 3, 3022, 103, 900.00),
(21423, 'Prem', 'Prem@GmailCom', '2002-11-08', 1, 3023, 104, 7000.00),
(21424, 'Prajwal', 'Prajwal@GmailCom', '2002-12-15', 2, 3024, 105, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `payroll_date` date DEFAULT NULL,
  `total_payroll` double(8,2) DEFAULT NULL,
  `transaction_id` varchar(25) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `emp_id`, `payroll_date`, `total_payroll`, `transaction_id`, `payment_status`) VALUES
(3020, 21420, '2021-08-25', 8000.00, 'ABCD2120', 'Paid'),
(3021, 21421, '2021-08-25', 13000.00, 'ABCD2121', 'Paid'),
(3022, 21422, '2021-08-25', 14100.00, 'ABCD2122', 'Paid'),
(3023, 21423, '2021-08-25', 3000.00, 'ABCD2123', 'Paid'),
(3024, 21424, '2021-08-25', 15000.00, 'ABCD2124', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `pos_id` int(11) NOT NULL,
  `pos_title` varchar(25) NOT NULL,
  `pos_rate_per_hour` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `pos_title`, `pos_rate_per_hour`) VALUES
(1, '100', 0.00),
(2, '200', 0.00),
(3, '50', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(5) NOT NULL,
  `pos_id` int(11) DEFAULT NULL,
  `emp_id` int(5) DEFAULT NULL,
  `total_salary` double(8,2) DEFAULT NULL,
  `ded_id` int(11) DEFAULT NULL,
  `net_salary` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `pos_id`, `emp_id`, `total_salary`, `ded_id`, `net_salary`) VALUES
(101, 1, 21420, 10000.00, 1, 10000.00),
(102, 2, 21421, 15000.00, 2, 15000.00),
(103, 3, 21422, 15000.00, 3, 15000.00),
(104, 1, 21423, 10000.00, 4, 10000.00),
(105, 2, 21424, 15000.00, 5, 15000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_name`),
  ADD KEY `attendance_emp_id` (`emp_id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`ded_id`),
  ADD KEY `deduction_emp_id_fk` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `employee_payroll_id` (`payroll_id`),
  ADD KEY `employee_pos_id` (`pos_id`),
  ADD KEY `employee_salary_id` (`salary_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `payroll_table_emp_id` (`emp_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `salary_pos_id_fk` (`pos_id`),
  ADD KEY `salary_ded_id_fk` (`ded_id`),
  ADD KEY `salary_emp_id` (`emp_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `deduction`
--
ALTER TABLE `deduction`
  ADD CONSTRAINT `deduction_emp_id_fk` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_payroll_id` FOREIGN KEY (`payroll_id`) REFERENCES `payroll` (`payroll_id`),
  ADD CONSTRAINT `employee_pos_id` FOREIGN KEY (`pos_id`) REFERENCES `position` (`pos_id`),
  ADD CONSTRAINT `employee_salary_id` FOREIGN KEY (`salary_id`) REFERENCES `salary` (`salary_id`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_table_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ded_id_fk` FOREIGN KEY (`ded_id`) REFERENCES `deduction` (`ded_id`),
  ADD CONSTRAINT `salary_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `salary_pos_id_fk` FOREIGN KEY (`pos_id`) REFERENCES `position` (`pos_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
