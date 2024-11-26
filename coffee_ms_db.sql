-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 11:38 AM
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
-- Database: `coffee_ms_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `nursery_plant_summary`
-- (See below for the actual view)
--
CREATE TABLE `nursery_plant_summary` (
`total_plants` bigint(21)
,`total_types` bigint(21)
,`total_varieties` bigint(21)
,`total_source` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_access`
--

CREATE TABLE `tbl_admin_access` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_access`
--

INSERT INTO `tbl_admin_access` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `id` int(255) NOT NULL,
  `content_id_fk` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `history_time` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `content_id_fk`, `content`, `status`, `history_time`) VALUES
(18, '68cd0a7c-a3d4-11ef-a9cc-6c2408a7860e', '50% are already harvested on November 16,2024', 'Success', '05:00:00.000000'),
(19, '68cd0a7c-a3d4-11ef-a9cc-6c2408a7860e', '100% Done already success harvest all at November 20,2024', 'Success', '11:00:00.000000'),
(21, '8b5a9091-a3d6-11ef-a9cc-6c2408a7860e', '-Compound -Rice Hulls', 'Success', '12:53:00.000000'),
(22, '8b5a9091-a3d6-11ef-a9cc-6c2408a7860e', '-Compound soild \r\n-add new chemical compunenets\r\n-blah blah', 'Success', '12:55:00.000000'),
(24, '68cd0a7c-a3d4-11ef-a9cc-6c2408a7860e', 'asdsad\r\nASD\r\nASD\r\nASD\r\nASD\r\nASD\r\nDAS', 'asdsad', '07:56:00.000000'),
(25, '8b5a9091-a3d6-11ef-a9cc-6c2408a7860e', 'sadasd\r\nASD\r\nSDA\r\nASD\r\nASD\r\nASD\r\nSDA', 'sdad', '19:57:00.000000'),
(26, '0c5fb05c-a63e-11ef-aa6e-6c2408a7860e', 'sadsadasdsad', 'sadsad', '14:18:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nursery`
--

CREATE TABLE `tbl_nursery` (
  `id` int(255) NOT NULL,
  `nursery_id` varchar(255) DEFAULT NULL,
  `nursery_field` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `variety_id` varchar(255) DEFAULT NULL,
  `quantity` int(255) NOT NULL,
  `planted_date` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nursery`
--

INSERT INTO `tbl_nursery` (`id`, `nursery_id`, `nursery_field`, `source_id`, `type_id`, `variety_id`, `quantity`, `planted_date`, `created_date`) VALUES
(46, '249ffcef-a29a-11ef-a9cc-6c2408a7860e', 'Batch 3', 'SRC-F623BA3069', 'TID-12459C4CDC', 'VID-1FDCB3577C', 10, '2024-11-14', '2024-11-14 15:07:19.490189'),
(52, '0014c03c-a40d-11ef-a9cc-6c2408a7860e', 'may batch 1', 'SRC-5055E18065', 'TID-E2917F25A3', 'VID-1FDCB3577C', 10, '2024-11-15', '2024-11-16 11:22:01.647166'),
(53, '67fa3dea-a40e-11ef-a9cc-6c2408a7860e', 'Batch 3', 'SRC-E7013C7046', 'TID-12459C4CDC', 'VID-1FDCB3577C', 10, '2024-11-16', '2024-11-16 11:32:05.453336');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

CREATE TABLE `tbl_source` (
  `id` int(255) NOT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `source_fullname` varchar(255) DEFAULT NULL,
  `source_variety` varchar(255) NOT NULL,
  `source_quantity` int(255) NOT NULL,
  `source_contact_number` varchar(255) DEFAULT NULL,
  `source_email` varchar(255) NOT NULL,
  `source_address` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_source`
--

INSERT INTO `tbl_source` (`id`, `source_id`, `source_fullname`, `source_variety`, `source_quantity`, `source_contact_number`, `source_email`, `source_address`, `created_date`) VALUES
(1, 'SRC-F623BA3069', 'Dr. Patrick Escalante', 'Rubosks', 500, '097123213435', 'dr.pat@gmail.com', 'Cadiz City', '2024-11-16 11:09:49.305576'),
(7, 'SRC-K6LASA3069', 'Jessa Mae Nicos', 'Ruboska', 100, '09232451222', 'jes@gmail.com', 'Escalante City, Negros Occidental', '2024-11-16 11:10:06.773160'),
(24, 'SRC-5055E18065', 'Angel Paborada', 'Rubosk', 1200, '0908123214', 'angel@gmail.com', 'Sagay City, Negros Occidental', '2024-11-16 11:11:01.000000'),
(25, 'SRC-D9E74405EA', 'Beverly Sabanal', 'Rubosks', 200, '091232342', 'bev@gmail.com', 'Dumaguete, Negros Oriental', '2024-11-16 11:11:29.000000'),
(26, 'SRC-E7013C7046', 'N/A', 'N/A', 0, '0', 'N/A@gmail.coom', 'N/A', '2024-11-16 11:31:17.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeline`
--

CREATE TABLE `tbl_timeline` (
  `id` int(255) NOT NULL,
  `nursery_id_fk` varchar(255) DEFAULT NULL,
  `content_id` varchar(255) DEFAULT NULL,
  `timeline_title` varchar(255) NOT NULL,
  `history_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_timeline`
--

INSERT INTO `tbl_timeline` (`id`, `nursery_id_fk`, `content_id`, `timeline_title`, `history_date`) VALUES
(43, '249ffcef-a29a-11ef-a9cc-6c2408a7860e', '68cd0a7c-a3d4-11ef-a9cc-6c2408a7860e', 'Harvested', '2024-11-16'),
(44, '249ffcef-a29a-11ef-a9cc-6c2408a7860e', '8b5a9091-a3d6-11ef-a9cc-6c2408a7860e', 'Fertilizing', '2024-11-16'),
(45, '67fa3dea-a40e-11ef-a9cc-6c2408a7860e', '0c5fb05c-a63e-11ef-aa6e-6c2408a7860e', 'Harvested', '2024-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `id` int(11) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`id`, `type_id`, `type_name`, `description`) VALUES
(10, 'TID-12459C4CDC', 'Seed', 'Seed is the small, matured reproductive structure produced by plants, typically containing an embryo or young plant inside.'),
(11, 'TID-E2917F25A3', 'Graft', 'Grafting is the act of placing a portion of one plant (bud or scion) into or on a stem, root, or branch of another (stock) in such a way that a union will be formed and the partners will continue to grow.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variety`
--

CREATE TABLE `tbl_variety` (
  `id` int(255) NOT NULL,
  `variety_id` varchar(255) NOT NULL,
  `variety_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_variety`
--

INSERT INTO `tbl_variety` (`id`, `variety_id`, `variety_name`, `description`) VALUES
(11, 'VID-1FDCB3577C', 'Robusta', 'Robusta coffee is a type of coffee made from the beans (seeds) of the Coffea canephora plant. Robusta originated in central and western sub-Saharan Africa.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `yearly_planting_summary`
-- (See below for the actual view)
--
CREATE TABLE `yearly_planting_summary` (
`year` int(4)
,`Jan` decimal(65,0)
,`Feb` decimal(65,0)
,`Mar` decimal(65,0)
,`Apr` decimal(65,0)
,`May` decimal(65,0)
,`Jun` decimal(65,0)
,`Jul` decimal(65,0)
,`Aug` decimal(65,0)
,`Sep` decimal(65,0)
,`Oct` decimal(65,0)
,`Nov` decimal(65,0)
,`Decs` decimal(65,0)
);

-- --------------------------------------------------------

--
-- Structure for view `nursery_plant_summary`
--
DROP TABLE IF EXISTS `nursery_plant_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nursery_plant_summary`  AS SELECT (select count(distinct `tbl_nursery`.`id`) from `tbl_nursery`) AS `total_plants`, (select count(distinct `tbl_type`.`type_id`) from `tbl_type`) AS `total_types`, (select count(distinct `tbl_variety`.`variety_id`) from `tbl_variety`) AS `total_varieties`, (select count(distinct `tbl_source`.`source_id`) from `tbl_source`) AS `total_source` ;

-- --------------------------------------------------------

--
-- Structure for view `yearly_planting_summary`
--
DROP TABLE IF EXISTS `yearly_planting_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `yearly_planting_summary`  AS SELECT year(`tbl_nursery`.`planted_date`) AS `year`, sum(case when month(`tbl_nursery`.`planted_date`) = 1 then `tbl_nursery`.`quantity` else 0 end) AS `Jan`, sum(case when month(`tbl_nursery`.`planted_date`) = 2 then `tbl_nursery`.`quantity` else 0 end) AS `Feb`, sum(case when month(`tbl_nursery`.`planted_date`) = 3 then `tbl_nursery`.`quantity` else 0 end) AS `Mar`, sum(case when month(`tbl_nursery`.`planted_date`) = 4 then `tbl_nursery`.`quantity` else 0 end) AS `Apr`, sum(case when month(`tbl_nursery`.`planted_date`) = 5 then `tbl_nursery`.`quantity` else 0 end) AS `May`, sum(case when month(`tbl_nursery`.`planted_date`) = 6 then `tbl_nursery`.`quantity` else 0 end) AS `Jun`, sum(case when month(`tbl_nursery`.`planted_date`) = 7 then `tbl_nursery`.`quantity` else 0 end) AS `Jul`, sum(case when month(`tbl_nursery`.`planted_date`) = 8 then `tbl_nursery`.`quantity` else 0 end) AS `Aug`, sum(case when month(`tbl_nursery`.`planted_date`) = 9 then `tbl_nursery`.`quantity` else 0 end) AS `Sep`, sum(case when month(`tbl_nursery`.`planted_date`) = 10 then `tbl_nursery`.`quantity` else 0 end) AS `Oct`, sum(case when month(`tbl_nursery`.`planted_date`) = 11 then `tbl_nursery`.`quantity` else 0 end) AS `Nov`, sum(case when month(`tbl_nursery`.`planted_date`) = 12 then `tbl_nursery`.`quantity` else 0 end) AS `Decs` FROM `tbl_nursery` GROUP BY year(`tbl_nursery`.`planted_date`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id_fk` (`content_id_fk`);

--
-- Indexes for table `tbl_nursery`
--
ALTER TABLE `tbl_nursery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plant_id` (`nursery_id`),
  ADD KEY `nursery_id` (`nursery_id`),
  ADD KEY `plant_type_id` (`type_id`),
  ADD KEY `plant_variety_id` (`variety_id`),
  ADD KEY `variety_id` (`variety_id`),
  ADD KEY `source_id` (`source_id`);

--
-- Indexes for table `tbl_source`
--
ALTER TABLE `tbl_source`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nurser_owner_id` (`source_id`),
  ADD KEY `nurser_owner_id_2` (`source_id`);

--
-- Indexes for table `tbl_timeline`
--
ALTER TABLE `tbl_timeline`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_id_2` (`content_id`),
  ADD KEY `plant_id_fk` (`nursery_id_fk`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `nursery_id_fk` (`nursery_id_fk`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `type_id_2` (`type_id`);

--
-- Indexes for table `tbl_variety`
--
ALTER TABLE `tbl_variety`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variety_id` (`variety_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_nursery`
--
ALTER TABLE `tbl_nursery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_source`
--
ALTER TABLE `tbl_source`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_timeline`
--
ALTER TABLE `tbl_timeline`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_variety`
--
ALTER TABLE `tbl_variety`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD CONSTRAINT `plant_content` FOREIGN KEY (`content_id_fk`) REFERENCES `tbl_timeline` (`content_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nursery`
--
ALTER TABLE `tbl_nursery`
  ADD CONSTRAINT `source` FOREIGN KEY (`source_id`) REFERENCES `tbl_source` (`source_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type` FOREIGN KEY (`type_id`) REFERENCES `tbl_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `variety` FOREIGN KEY (`variety_id`) REFERENCES `tbl_variety` (`variety_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_timeline`
--
ALTER TABLE `tbl_timeline`
  ADD CONSTRAINT `plant_history_info` FOREIGN KEY (`nursery_id_fk`) REFERENCES `tbl_nursery` (`nursery_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
