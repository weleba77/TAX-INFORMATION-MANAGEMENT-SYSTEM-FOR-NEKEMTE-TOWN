-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 09:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tax_nekemte`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES
(1, 'admin', '$2y$10$qCT0fXiK7NWquztFKb3p9uQnuy2p4jkrx4Pq8mThGGQtBc4kqRya2', 'weleba', 'ephrem', 'welebaephrem@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `taxpayer_id` int(11) NOT NULL,
  `interviewer_id` int(11) NOT NULL,
  `assignment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 8, 'weleba', 'ephremweleba@gmail.com', 'how', 'fjdfdæv æfsøvjsf sævncnf ', '2024-06-15 05:24:13'),
(2, 9, 'nalo', 'ephremweleba1@gmail.com', 'not afgero', 'dsvlkcvmlsdævcxlbvzsmbcvm lmfapvnækzbmz', '2024-06-15 06:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `income_amount` decimal(10,2) NOT NULL,
  `income_source` enum('Employment','Rental of Building','Business Activities') NOT NULL,
  `interviewer_id` int(11) DEFAULT NULL,
  `interviewer_approved` tinyint(1) DEFAULT 0,
  `admin_approved` tinyint(1) DEFAULT 0,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  `receipt_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `user_id`, `income_amount`, `income_source`, `interviewer_id`, `interviewer_approved`, `admin_approved`, `tax_amount`, `receipt_image`) VALUES
(1, 8, 2932.00, 'Employment', 9, 1, 1, 297.30, 'uploads/Screenshot 2024-03-25 194132.png'),
(2, 9, 30000.00, 'Business Activities', 9, 1, 1, 2790.00, 'uploads/lab33.png');

-- --------------------------------------------------------

--
-- Table structure for table `interviewer`
--

CREATE TABLE `interviewer` (
  `interviewer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interviewers`
--

CREATE TABLE `interviewers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interviewers`
--

INSERT INTO `interviewers` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created_at`) VALUES
(9, 'abera', 'abera', 'abera', 'abera@gmial.com', '$2y$10$u27iv8zdr2CVaHUlkGostOaqEycrAVOafiUN8hxoG66/Xo57ikq0e', '2024-06-14 03:57:17'),
(10, 'esk', 'eskiyas', 'teke', 'abera@gmial.com', '$2y$10$Zt68ziyTaYY0x9JNtOlbiufnW5.XD3P5YetgU0tHMLF0qzBWYqJoe', '2024-06-15 06:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(10, 'wuddsid', '123456789dfghjb', 'uploads/663d286377964_Screenshot 2023-06-04 091409.png', '2024-05-09 19:47:47', '2024-06-15 06:05:51'),
(11, 'efklsdjfwe\'', 'kdfsdkfej  fhvkhfpvjowhv', 'uploads/666744b3db82d_ins15.png', '2024-06-10 18:23:47', '2024-06-10 18:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `taxpayer_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `size` varchar(100) NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_approval`
--

CREATE TABLE `receipt_approval` (
  `id` int(11) NOT NULL,
  `income_id` int(11) NOT NULL,
  `interviewer_id` int(11) DEFAULT NULL,
  `interviewer_approved` tinyint(1) DEFAULT 0,
  `admin_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxpayers`
--

CREATE TABLE `taxpayers` (
  `taxpayer_id` int(11) NOT NULL,
  `fh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_details`
--

CREATE TABLE `tax_details` (
  `tax_detail_id` int(11) NOT NULL,
  `taxpayer_id` int(11) NOT NULL,
  `current_tax` decimal(10,2) DEFAULT NULL,
  `payment_history` text DEFAULT NULL,
  `outstanding_balances` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `tin` varchar(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `income_source` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `place_of_work` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `tin`, `sex`, `income_source`, `email`, `place_of_work`, `password`, `photo_path`, `username`) VALUES
(8, 'ephrem', 'genti', '0918283723', '1234567893', 'male', 'schedule_a', 'ephremweleba@gmail.com', 'nekemte02', '$2y$10$5xH/jzMhBGzq7UoH.1isousdiUMjTVeneoERtjJGlPkRmkcqYHiUK', 'uploads/Screenshot 2024-06-06 100818.png', 'weleba'),
(9, 'nugusa', 'shura', '0903039213', '1234567890', 'male', 'business_activities', 'ephremweleba@gmaile.com', '02', '$2y$10$9lu/Hdv2LJfA3RvUqimjAuHa93.ZcpQ5NESEiSrZFqiSp2d5uEqKa', 'uploads/cmd ca.p.png', 'naol'),
(10, 'muzamil', 'asldin', '0909090909', '0987654321', 'male', 'rental_of_buildings', 'osedjfeolfj2@egkjdf.com', '03', '$2y$10$gfzd1QX3Vm6xrKuw0NB7X.56J06T1FY4NlQA6ugSsX0UcUoibp1.q', 'uploads/Screenshot 2024-02-05 204414.png', 'ustas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `taxpayer_id` (`taxpayer_id`),
  ADD KEY `interviewer_id` (`interviewer_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `interviewer_id` (`interviewer_id`);

--
-- Indexes for table `interviewer`
--
ALTER TABLE `interviewer`
  ADD PRIMARY KEY (`interviewer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `interviewers`
--
ALTER TABLE `interviewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `taxpayer_id` (`taxpayer_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `receipt_approval`
--
ALTER TABLE `receipt_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_id` (`income_id`),
  ADD KEY `interviewer_id` (`interviewer_id`);

--
-- Indexes for table `taxpayers`
--
ALTER TABLE `taxpayers`
  ADD PRIMARY KEY (`taxpayer_id`),
  ADD UNIQUE KEY `user_id` (`fh`);

--
-- Indexes for table `tax_details`
--
ALTER TABLE `tax_details`
  ADD PRIMARY KEY (`tax_detail_id`),
  ADD KEY `taxpayer_id` (`taxpayer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interviewer`
--
ALTER TABLE `interviewer`
  MODIFY `interviewer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interviewers`
--
ALTER TABLE `interviewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receipt_approval`
--
ALTER TABLE `receipt_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxpayers`
--
ALTER TABLE `taxpayers`
  MODIFY `taxpayer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_details`
--
ALTER TABLE `tax_details`
  MODIFY `tax_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`taxpayer_id`) REFERENCES `taxpayers` (`taxpayer_id`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`interviewer_id`) REFERENCES `interviewer` (`interviewer_id`);

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `income_ibfk_2` FOREIGN KEY (`interviewer_id`) REFERENCES `interviewers` (`id`);

--
-- Constraints for table `interviewer`
--
ALTER TABLE `interviewer`
  ADD CONSTRAINT `interviewer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`taxpayer_id`) REFERENCES `taxpayers` (`taxpayer_id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receipt_approval`
--
ALTER TABLE `receipt_approval`
  ADD CONSTRAINT `receipt_approval_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `income` (`id`),
  ADD CONSTRAINT `receipt_approval_ibfk_2` FOREIGN KEY (`interviewer_id`) REFERENCES `interviewers` (`id`);

--
-- Constraints for table `tax_details`
--
ALTER TABLE `tax_details`
  ADD CONSTRAINT `tax_details_ibfk_1` FOREIGN KEY (`taxpayer_id`) REFERENCES `taxpayers` (`taxpayer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
