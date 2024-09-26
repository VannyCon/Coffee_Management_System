-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 05:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE `admin_access` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_access`
--

INSERT INTO `admin_access` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `content_tbl`
--

CREATE TABLE `content_tbl` (
  `id` int(255) NOT NULL,
  `content_id_fk` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `history_time` time(6) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_tbl`
--

INSERT INTO `content_tbl` (`id`, `content_id_fk`, `content`, `status`, `history_time`) VALUES
(2, 'a6fb3c22-7960-11ef-945c-6c2408a7860e', 'dasdasd', 'success', '12:56:10.563407'),
(4, '1f22559e-797c-11ef-ab8b-6c2408a7860e', '3rd abuno in this year', 'success', '15:20:02.000000'),
(5, '61173a8d-7964-11ef-945c-6c2408a7860e', 'second abuno', 'success', '19:27:27.000000');

-- --------------------------------------------------------

--
-- Table structure for table `nursery_owner_tbl`
--

CREATE TABLE `nursery_owner_tbl` (
  `id` int(255) NOT NULL,
  `nurser_owner_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nursery_owner_tbl`
--

INSERT INTO `nursery_owner_tbl` (`id`, `nurser_owner_id`, `fullname`, `contact_number`, `address`, `created_date`) VALUES
(1, '3ce2b267-793f-11ef-945c-6c2408a7860e', 'Dr. Patrick Escalante', '097123213434', 'Cadiz City', '2024-09-24 01:56:12.521744'),
(3, '3796cfc4-7944-11ef-945c-6c2408a7860e', 'Angel Paborada', '09812323224', 'Calatrava City', '2024-09-24 01:56:01.564304'),
(4, '3b8909f2-7944-11ef-945c-6c2408a7860e', 'Beverly Saabanal', '090909090909', 'Toboso', '2024-09-24 01:55:38.599828'),
(7, '12eece16-79ac-11ef-ab8b-6c2408a7860e', 'Jessa Mae Nicos', '09232451222', 'Escalante City, Negros Occidental', '2024-09-24 02:20:09.970608');

-- --------------------------------------------------------

--
-- Stand-in structure for view `nursery_plant_summary`
-- (See below for the actual view)
--
CREATE TABLE `nursery_plant_summary` (
`total_plants` bigint(21)
,`total_types` bigint(21)
,`total_varieties` bigint(21)
,`total_nursery_owners` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `plant_info_tbl`
--

CREATE TABLE `plant_info_tbl` (
  `id` int(255) NOT NULL,
  `plant_id` varchar(255) DEFAULT NULL,
  `nurser_owner_id_fk` varchar(255) DEFAULT NULL,
  `plant_type` varchar(255) DEFAULT NULL,
  `plant_variety` varchar(255) DEFAULT NULL,
  `planted_date` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_info_tbl`
--

INSERT INTO `plant_info_tbl` (`id`, `plant_id`, `nurser_owner_id_fk`, `plant_type`, `plant_variety`, `planted_date`, `created_date`) VALUES
(2, 'ee5e049e-7940-11ef-945c-6c2408a7860e', '3ce2b267-793f-11ef-945c-6c2408a7860e', 'test1', 'test2', '2024-08-25', '2024-09-26 02:12:22.987616'),
(16, '762f5e4a-7ba8-11ef-a2a5-6c2408a7860e', '3b8909f2-7944-11ef-945c-6c2408a7860e', 'Seeds', 'Varietsss', '2024-09-28', '2024-09-26 02:12:22.987616');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_tbl`
--

CREATE TABLE `timeline_tbl` (
  `id` int(255) NOT NULL,
  `plant_id_fk` varchar(255) DEFAULT NULL,
  `content_id` varchar(255) DEFAULT NULL,
  `timeline_title` varchar(255) NOT NULL,
  `history_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeline_tbl`
--

INSERT INTO `timeline_tbl` (`id`, `plant_id_fk`, `content_id`, `timeline_title`, `history_date`) VALUES
(1, 'ee5e049e-7940-11ef-945c-6c2408a7860e', 'a6fb3c22-7960-11ef-945c-6c2408a7860e', 'Abuno', '2024-09-21'),
(3, 'ee5e049e-7940-11ef-945c-6c2408a7860e', '61173a8d-7964-11ef-945c-6c2408a7860e', '2nd Abuno', '2024-09-24'),
(4, 'ee5e049e-7940-11ef-945c-6c2408a7860e', '1f22559e-797c-11ef-ab8b-6c2408a7860e', '3rd Abuno', '2024-09-26'),
(6, 'ee5e049e-7940-11ef-945c-6c2408a7860e', '523b5f4b-799c-11ef-ab8b-6c2408a7860e', '4th Abuno', '2024-09-30'),
(12, 'ee5e049e-7940-11ef-945c-6c2408a7860e', '6b705d25-79a3-11ef-ab8b-6c2408a7860e', 'sadsd', '2024-09-23');

-- --------------------------------------------------------

--
-- Stand-in structure for view `yearly_planting_summary`
-- (See below for the actual view)
--
CREATE TABLE `yearly_planting_summary` (
`year` int(4)
,`Jan` decimal(22,0)
,`Feb` decimal(22,0)
,`Mar` decimal(22,0)
,`Apr` decimal(22,0)
,`May` decimal(22,0)
,`Jun` decimal(22,0)
,`Jul` decimal(22,0)
,`Aug` decimal(22,0)
,`Sep` decimal(22,0)
,`Oct` decimal(22,0)
,`Nov` decimal(22,0)
,`Decs` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Structure for view `nursery_plant_summary`
--
DROP TABLE IF EXISTS `nursery_plant_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nursery_plant_summary`  AS SELECT (select count(0) from `plant_info_tbl`) AS `total_plants`, (select count(distinct `plant_info_tbl`.`plant_type`) from `plant_info_tbl`) AS `total_types`, (select count(distinct `plant_info_tbl`.`plant_variety`) from `plant_info_tbl`) AS `total_varieties`, (select count(0) from `nursery_owner_tbl`) AS `total_nursery_owners` ;

-- --------------------------------------------------------

--
-- Structure for view `yearly_planting_summary`
--
DROP TABLE IF EXISTS `yearly_planting_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `yearly_planting_summary`  AS SELECT year(`plant_info_tbl`.`planted_date`) AS `year`, sum(case when month(`plant_info_tbl`.`planted_date`) = 1 then 1 else 0 end) AS `Jan`, sum(case when month(`plant_info_tbl`.`planted_date`) = 2 then 1 else 0 end) AS `Feb`, sum(case when month(`plant_info_tbl`.`planted_date`) = 3 then 1 else 0 end) AS `Mar`, sum(case when month(`plant_info_tbl`.`planted_date`) = 4 then 1 else 0 end) AS `Apr`, sum(case when month(`plant_info_tbl`.`planted_date`) = 5 then 1 else 0 end) AS `May`, sum(case when month(`plant_info_tbl`.`planted_date`) = 6 then 1 else 0 end) AS `Jun`, sum(case when month(`plant_info_tbl`.`planted_date`) = 7 then 1 else 0 end) AS `Jul`, sum(case when month(`plant_info_tbl`.`planted_date`) = 8 then 1 else 0 end) AS `Aug`, sum(case when month(`plant_info_tbl`.`planted_date`) = 9 then 1 else 0 end) AS `Sep`, sum(case when month(`plant_info_tbl`.`planted_date`) = 10 then 1 else 0 end) AS `Oct`, sum(case when month(`plant_info_tbl`.`planted_date`) = 11 then 1 else 0 end) AS `Nov`, sum(case when month(`plant_info_tbl`.`planted_date`) = 11 then 1 else 0 end) AS `Decs` FROM `plant_info_tbl` WHERE year(`plant_info_tbl`.`planted_date`) = year(curdate()) GROUP BY year(`plant_info_tbl`.`planted_date`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_access`
--
ALTER TABLE `admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_tbl`
--
ALTER TABLE `content_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id_fk` (`content_id_fk`);

--
-- Indexes for table `nursery_owner_tbl`
--
ALTER TABLE `nursery_owner_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nurser_owner_id` (`nurser_owner_id`),
  ADD KEY `nurser_owner_id_2` (`nurser_owner_id`);

--
-- Indexes for table `plant_info_tbl`
--
ALTER TABLE `plant_info_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plant_id` (`plant_id`),
  ADD KEY `nurser_owner_id_fk` (`nurser_owner_id_fk`);

--
-- Indexes for table `timeline_tbl`
--
ALTER TABLE `timeline_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_id_2` (`content_id`),
  ADD KEY `plant_id_fk` (`plant_id_fk`),
  ADD KEY `content_id` (`content_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_access`
--
ALTER TABLE `admin_access`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `content_tbl`
--
ALTER TABLE `content_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nursery_owner_tbl`
--
ALTER TABLE `nursery_owner_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plant_info_tbl`
--
ALTER TABLE `plant_info_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `timeline_tbl`
--
ALTER TABLE `timeline_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_tbl`
--
ALTER TABLE `content_tbl`
  ADD CONSTRAINT `plant_content` FOREIGN KEY (`content_id_fk`) REFERENCES `timeline_tbl` (`content_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plant_info_tbl`
--
ALTER TABLE `plant_info_tbl`
  ADD CONSTRAINT `plant_owner` FOREIGN KEY (`nurser_owner_id_fk`) REFERENCES `nursery_owner_tbl` (`nurser_owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timeline_tbl`
--
ALTER TABLE `timeline_tbl`
  ADD CONSTRAINT `plant_history_info` FOREIGN KEY (`plant_id_fk`) REFERENCES `plant_info_tbl` (`plant_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
