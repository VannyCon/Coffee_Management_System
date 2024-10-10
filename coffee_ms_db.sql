-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 05:35 AM
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
(13, 'fc55808e-7bcb-11ef-93ce-6c2408a7860e', 'Successfull', 'success', '13:56:06.000000'),
(14, '8950a910-7bcc-11ef-93ce-6c2408a7860e', 'done ', 'done', '13:59:56.000000'),
(15, '8950a910-7bcc-11ef-93ce-6c2408a7860e', 'done1', 'asdasd', '21:03:00.000000'),
(17, '8950a910-7bcc-11ef-93ce-6c2408a7860e', 'ssdsadsad', 'ssssss', '02:06:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nursery`
--

CREATE TABLE `tbl_nursery` (
  `id` int(255) NOT NULL,
  `nursery_id` varchar(255) DEFAULT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `variety_id` varchar(255) DEFAULT NULL,
  `quantity` int(255) NOT NULL,
  `planted_date` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nursery`
--

INSERT INTO `tbl_nursery` (`id`, `nursery_id`, `source_id`, `type_id`, `variety_id`, `quantity`, `planted_date`, `created_date`) VALUES
(18, 'cb3248bf-7bb8-11ef-a2a5-6c2408a7860e', '3796cfc4-7944-11ef-945c-6c2408a7860e', 'TID-001', 'VID-001', 1, '2024-07-24', '2024-09-26 03:38:24.661249'),
(19, '9b4d3fb2-7bbc-11ef-a2a5-6c2408a7860e', '3ce2b267-793f-11ef-945c-6c2408a7860e', 'TID-002', 'VID-002', 2, '2024-09-26', '2024-09-26 04:05:42.294278'),
(21, 'ab05766c-7bc0-11ef-a2a5-6c2408a7860e', '3ce2b267-793f-11ef-945c-6c2408a7860e', 'TID-003', 'VID-003', 3, '2024-09-26', '2024-09-26 04:34:46.654306'),
(22, '4ecc34b2-86ac-11ef-abd4-6c2408a7860e', '3796cfc4-7944-11ef-945c-6c2408a7860e', 'TID-003', 'VID-003', 10, '2024-10-12', '2024-10-10 02:06:48.627609'),
(24, 'fc0108b6-86ac-11ef-abd4-6c2408a7860e', 'aa83a5da-86ac-11ef-abd4-6c2408a7860e', 'TID-002', 'VID-003', 12, '2024-10-12', '2024-10-10 02:11:39.219526');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

CREATE TABLE `tbl_source` (
  `id` int(255) NOT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `source_fullname` varchar(255) DEFAULT NULL,
  `source_contact_number` varchar(255) DEFAULT NULL,
  `source_address` varchar(255) DEFAULT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_source`
--

INSERT INTO `tbl_source` (`id`, `source_id`, `source_fullname`, `source_contact_number`, `source_address`, `created_date`) VALUES
(1, '3ce2b267-793f-11ef-945c-6c2408a7860e', 'Dr. Patrick Escalante', '097123213435', 'Cadiz City', '2024-10-03 13:43:27.945044'),
(3, '3796cfc4-7944-11ef-945c-6c2408a7860e', 'Angel Paborada', '09812323224', 'Calatrava City', '2024-09-24 01:56:01.564304'),
(4, '3b8909f2-7944-11ef-945c-6c2408a7860e', 'Beverly Saabanal', '0922222222', 'Toboso', '2024-09-26 03:50:32.030540'),
(7, '12eece16-79ac-11ef-ab8b-6c2408a7860e', 'Jessa Mae Nicos', '09232451222', 'Escalante City, Negros Occidental', '2024-09-24 02:20:09.970608'),
(10, 'aa83a5da-86ac-11ef-abd4-6c2408a7860e', 'Ivan Con', '0909090909', 'Banquerohan', '2024-10-10 02:09:22.000000');

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
(19, 'cb3248bf-7bb8-11ef-a2a5-6c2408a7860e', 'fc55808e-7bcb-11ef-93ce-6c2408a7860e', 'Abuno', '2024-09-26'),
(20, 'cb3248bf-7bb8-11ef-a2a5-6c2408a7860e', '8950a910-7bcc-11ef-93ce-6c2408a7860e', 'Abuno 4th', '2024-09-30');

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
(1, 'TID-001', 'type1', 'type 1'),
(2, 'TID-002', 'type2', 'type 2'),
(3, 'TID-003', 'type3', 'type 3');

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
(1, 'VID-001', 'Gross', 'Dummy 1'),
(2, 'VID-002', 'Gross2', 'Dummy 2'),
(3, 'VID-003', 'Gross3', 'Dummy 3');

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
  ADD KEY `nurser_owner_id_fk` (`source_id`),
  ADD KEY `nursery_id` (`nursery_id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `plant_type_id` (`type_id`),
  ADD KEY `plant_variety_id` (`variety_id`),
  ADD KEY `variety_id` (`variety_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_nursery`
--
ALTER TABLE `tbl_nursery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_source`
--
ALTER TABLE `tbl_source`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_timeline`
--
ALTER TABLE `tbl_timeline`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_variety`
--
ALTER TABLE `tbl_variety`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `plant_owner` FOREIGN KEY (`source_id`) REFERENCES `tbl_source` (`source_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
