-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 06:38 AM
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
-- Database: `cds`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulk_user`
--

CREATE TABLE `bulk_user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `campaignid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `StartDate` varchar(255) NOT NULL,
  `EndDate` varchar(255) NOT NULL,
  `Status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaignid`, `userid`, `name`, `StartDate`, `EndDate`, `Status`) VALUES
(38, 68, '12', '1709766000', '1711580400', 1),
(41, 68, 'admin', '1710457200', '1711753200', 1),
(46, 76, 'siva', '1709766000', '1711666800', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `operation` longtext NOT NULL,
  `log_timestamp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_type`, `operation`, `log_timestamp`) VALUES
(1, 'logout', '@logout@12:59:35 PM', '1709969375'),
(2, 'logout', '@logout@12:59:39 PM', '1709969379'),
(3, 'logout', '@logout@12:59:47 PM', '1709969387'),
(4, 'logout', 'siva@logout@01:00:05 PM', '1709969405'),
(5, 'login', 'siva@login@01:01:14 PM', '1709969474'),
(6, 'logout', 'siva@logout@02:25:47 PM', '1709974547'),
(7, 'login', 'siva@login@02:25:57 PM', '1709974557'),
(8, 'login', 'siva@login@03:14:43 PM', '1709977483'),
(9, 'logout', 'siva@logout@03:22:16 PM', '1709977936'),
(10, 'login', 'siva@login@03:23:21 PM', '1709978001'),
(11, 'login', 'siva@login@10:38:10 AM', '1710133690'),
(12, 'login', 'siva@login@10:36:00 AM', '1710219960'),
(13, 'login', 'siva@login@10:47:24 AM', '1710220644'),
(14, 'logout', 'siva@logout@11:42:48 AM', '1710223968'),
(15, 'login', 'siva@login@12:08:20 PM', '1710225500'),
(16, 'logout', 'siva@logout@12:21:12 PM', '1710226272'),
(17, 'login', 'siva@login@12:51:06 PM', '1710228066'),
(18, 'logout', 'siva@logout@05:13:52 PM', '1710243832'),
(19, 'login', 'siva@login@05:16:52 PM', '1710244012'),
(20, 'login', 'siva@login@10:35:11 AM', '1710306311'),
(21, 'logout', 'siva@logout@12:03:35 PM', '1710311615'),
(22, 'login', 'siva@login@12:03:45 PM', '1710311625'),
(23, ' created a campaign ram', 'siva@ created a campaign ram at 05:42:27 PM', '1710331947'),
(24, 'created a message', 'siva@created a message at 06:16:35 PM', '1710333995'),
(25, 'updated a message', 'siva@updated a message at 06:17:28 PM', '1710334048'),
(26, 'created a message', 'siva@created a message at 06:22:20 PM', '1710334340'),
(27, 'created a message', 'siva@created a message at 06:23:52 PM', '1710334432'),
(28, 'updated a message', 'siva@updated a message at 06:27:49 PM', '1710334669'),
(29, 'deleted a message', 'siva@deleted a message at 06:29:15 PM', '1710334755'),
(30, ' deleted a campaign ram', 'siva@ deleted a campaign ram at 06:30:04 PM', '1710334804'),
(31, ' deleted a campaign siva1', 'siva@ deleted a campaign siva1 at 06:30:18 PM', '1710334818'),
(32, ' deleted a campaign raman', 'siva@ deleted a campaign raman at 06:32:24 PM', '1710334944'),
(33, ' deleted a campaign raj ', 'siva@ deleted a campaign raj  at 06:33:33 PM', '1710335013'),
(34, ' deleted a campaign raju', 'siva@ deleted a campaign raju at 06:35:30 PM', '1710335130'),
(35, 'deleted a messagegroup', 'siva@deleted a messagegroup at 06:38:17 PM', '1710335297'),
(36, ' created a campaign siv', 'siva@ created a campaign siv at 06:40:17 PM', '1710335417'),
(37, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 06:40:24 PM', '1710335424'),
(38, ' created a campaign ram', 'siva@ created a campaign ram at 06:46:45 PM', '1710335805'),
(39, ' created a campaign siva', 'siva@ created a campaign siva at 06:51:06 PM', '1710336066'),
(40, ' deleted a campaign siva', 'siva@ deleted a campaign siva at 06:51:09 PM', '1710336069'),
(41, ' deleted a campaign ram', 'siva@ deleted a campaign ram at 06:51:20 PM', '1710336080'),
(42, ' deleted a campaign siva', 'siva@ deleted a campaign siva at 06:53:14 PM', '1710336194'),
(43, ' deleted a campaign siva', 'siva@ deleted a campaign siva at 06:55:41 PM', '1710336341'),
(44, ' created a campaign siva', 'siva@ created a campaign siva at 06:56:01 PM', '1710336361'),
(45, ' created a campaign siv', 'siva@ created a campaign siv at 06:56:21 PM', '1710336381'),
(46, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 06:59:04 PM', '1710336544'),
(47, 'created a message', 'siva@created a message at 07:00:34 PM', '1710336634'),
(48, 'deleted a message', 'siva@deleted a message at 07:00:39 PM', '1710336639'),
(49, ' deleted a campaign siva', 'siva@ deleted a campaign siva at 07:01:29 PM', '1710336689'),
(50, ' created a campaign 12', 'siva@ created a campaign 12 at 07:02:46 PM', '1710336766'),
(51, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 07:08:19 PM', '1710337099'),
(52, 'created message(s)', 'siva@created message(s) at 07:29:49 PM', '1710338389'),
(53, 'created message(s)', 'siva@created message(s) at 07:30:16 PM', '1710338416'),
(54, 'created message(s)', 'siva@created message(s) at 07:31:00 PM', '1710338460'),
(55, 'created a message', 'siva@created a message at 07:31:26 PM', '1710338486'),
(56, 'updated a message', 'siva@updated a message at 07:33:38 PM', '1710338618'),
(57, ' edited a campaign ', 'siva@ edited a campaign  at 07:37:05 PM', '1710338825'),
(58, 'updated a message', 'siva@updated a message at 07:39:08 PM', '1710338948'),
(59, 'logout', 'siva@logout at 07:46:33 PM', '1710339393'),
(60, 'login', 'siva@login at 08:34:20 PM', '1710342260'),
(61, 'created a messagegroup', 'siva@created a messagegroup at 09:06:05 PM', '1710344165'),
(62, 'deleted a messagegroup', 'siva@deleted a messagegroup at 09:06:20 PM', '1710344180'),
(63, 'deleted a messagegroup', 'siva@deleted a messagegroup at 09:07:16 PM', '1710344236'),
(64, ' deleted a campaign admi', 'siva@ deleted a campaign admi at 09:23:42 PM', '1710345222'),
(65, ' created a campaign admin', 'siva@ created a campaign admin at 09:24:30 PM', '1710345270'),
(66, ' created a campaign raj', 'siva@ created a campaign raj at 09:30:08 PM', '1710345608'),
(67, ' deleted a campaign raj', 'siva@ deleted a campaign raj at 09:30:18 PM', '1710345618'),
(68, 'Created a campaign: siv', 'siva@Created a campaign: siv at 09:40:56 PM', '1710346256'),
(69, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 09:41:01 PM', '1710346261'),
(70, ' created a campaign siv', 'siva@ created a campaign siv at 09:47:59 PM', '1710346679'),
(71, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 09:48:02 PM', '1710346682'),
(72, ' created a campaign siv', 'siva@ created a campaign siv at 09:54:05 PM', '1710347045'),
(73, ' deleted a campaign siv', 'siva@ deleted a campaign siv at 09:54:12 PM', '1710347052'),
(74, 'login', 'siva@login at 10:34:39 AM', '1710392679'),
(75, 'logout', 'siva@logout at 10:59:44 AM', '1710394184'),
(76, 'login', 'siva@login at 11:18:46 AM', '1710395326'),
(77, 'logout', 'siva@logout at 11:24:11 AM', '1710395651'),
(78, 'login', 'siva@login at 11:33:31 AM', '1710396211'),
(79, 'created a messagegroup', 'siva@created a messagegroup at 12:34:30 PM', '1710399870'),
(80, 'deleted a messagegroup', 'siva@deleted a messagegroup at 12:37:38 PM', '1710400058'),
(81, 'logout', 'siva@logout at 12:46:02 PM', '1710400562'),
(82, 'login', 'siva@login at 12:48:25 PM', '1710400705'),
(83, 'created a messagegroup', 'siva@created a messagegroup at 01:27:02 PM', '1710403022'),
(84, 'logout', 'siva@logout at 01:31:25 PM', '1710403285'),
(85, 'login', 'rahul@login at 01:32:31 PM', '1710403351'),
(86, 'logout', 'rahul@logout at 01:33:51 PM', '1710403431'),
(87, 'login', 'siva@login at 01:34:09 PM', '1710403449'),
(88, 'login', 'siva@login at 10:36:37 AM', '1710479197'),
(89, 'created a messagegroup', 'siva@created a messagegroup at 03:44:37 PM', '1710497677'),
(90, 'created a messagegroup', 'siva@created a messagegroup at 04:12:42 PM', '1710499362'),
(91, 'created a message', 'siva@created a message at 04:46:51 PM', '1710501411'),
(92, 'logout', 'siva@logout at 05:38:06 PM', '1710504486'),
(93, 'login', 'siva@login at 06:12:09 PM', '1710506529'),
(94, 'created a message', 'siva@created a message at 06:55:37 PM', '1710509137'),
(95, 'updated a message', 'siva@updated a message at 07:39:42 PM', '1710511782'),
(96, 'deleted a message', 'siva@deleted a message at 07:39:55 PM', '1710511795'),
(97, 'updated a message', 'siva@updated a message at 07:40:47 PM', '1710511847'),
(98, 'deleted a message', 'siva@deleted a message at 07:40:52 PM', '1710511852'),
(99, 'updated a message', 'siva@updated a message at 07:43:29 PM', '1710512009'),
(100, 'updated a message', 'siva@updated a message at 07:44:08 PM', '1710512048'),
(101, 'updated a message', 'siva@updated a message at 07:44:50 PM', '1710512090'),
(102, 'deleted a message', 'siva@deleted a message at 07:47:36 PM', '1710512256'),
(103, 'updated a message', 'siva@updated a message at 07:50:09 PM', '1710512409'),
(104, 'updated a message', 'siva@updated a message at 07:53:06 PM', '1710512586'),
(105, 'updated a message', 'siva@updated a message at 07:53:19 PM', '1710512599'),
(106, 'created a message', 'siva@created a message at 07:56:28 PM', '1710512788'),
(107, 'updated a message', 'siva@updated a message at 07:58:51 PM', '1710512931'),
(108, 'created a message', 'siva@created a message at 08:02:50 PM', '1710513170'),
(109, 'updated a message', 'siva@updated a message at 08:03:06 PM', '1710513186'),
(110, 'updated a message', 'siva@updated a message at 08:18:04 PM', '1710514084'),
(111, 'logout', 'siva@logout at 08:35:11 PM', '1710515111'),
(112, 'login', 'ramesh@login at 08:35:25 PM', '1710515125'),
(113, 'logout', 'ramesh@logout at 08:36:08 PM', '1710515168'),
(114, 'login', 'pradeep@login at 08:37:32 PM', '1710515252'),
(115, 'logout', 'pradeep@logout at 08:41:01 PM', '1710515461'),
(116, 'login', 'saran@login at 08:45:11 PM', '1710515711'),
(117, ' created a campaign siva', 'saran@ created a campaign siva at 08:45:43 PM', '1710515743'),
(118, 'logout', 'saran@logout at 08:48:28 PM', '1710515908'),
(119, 'login', 'pradeep@login at 08:51:10 PM', '1710516070'),
(120, 'logout', 'pradeep@logout at 08:51:34 PM', '1710516094'),
(121, 'login', 'saran@login at 08:51:48 PM', '1710516108'),
(122, 'logout', 'saran@logout at 08:53:56 PM', '1710516236');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `campaignid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `messagegroup` varchar(250) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `Status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageid`, `campaignid`, `userid`, `messagegroup`, `content`, `timestamp`, `Status`) VALUES
(497, 38, 68, 'testgroupss', '<p>sss</p>', '1710457200', 2),
(498, 38, 68, 'testgroup', '<p>ssss</p>', '1710457200', 2),
(499, 38, 68, 'testgroup', '<p>ssss</p>', '1710457200', 1),
(500, 41, 68, 'testgroup', 'sssra', '1710457200', 2),
(501, 38, 68, 'testgroup', 'sssra', '1710457200', 2),
(502, 41, 68, 'testgroup', '<p>rrrsss</p>', '1710457200', 2);

-- --------------------------------------------------------

--
-- Table structure for table `message_group`
--

CREATE TABLE `message_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `user_created_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_group`
--

INSERT INTO `message_group` (`id`, `name`, `userid`, `user_created_id`) VALUES
(254, 'sidness1s', 47, 68),
(255, 'sidness1s', 42, 68),
(264, 'siva', 72, 68),
(265, 'siva', 47, 68),
(266, 'ramu', 67, 68),
(267, 'ramu', 67, 68),
(268, 'sivas', 47, 68),
(269, 'sivas', 70, 68),
(270, 'rohan', 47, 68),
(271, 'rohan', 67, 68),
(272, 'mohan', 67, 68),
(273, 'mohan', 70, 68);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `phonenumber`, `email`, `company`, `PASSWORD`, `role_id`) VALUES
(42, 'ram', '1234567891', 'masivavignesh79@gmail.com', NULL, '71a4076abed82b6fe8018a68ba42e460', NULL),
(47, 'siva', '1212323232', 'masivavignesh79@gmail.com', NULL, '6bb4fb7e268286f36c34049a5fcd09fc', NULL),
(67, 'admin', '1232345467', 'vigneshsiva253@gmail.com', NULL, '6bb4fb7e268286f36c34049a5fcd09fc', NULL),
(68, 'siva', '1233333333', 'siva253@gmail.com', NULL, '6bb4fb7e268286f36c34049a5fcd09fc', NULL),
(70, 'raj', '1234555555', 'siva253@gmail.com', 'cds', '6bb4fb7e268286f36c34049a5fcd09fc', NULL),
(71, 'admin', '1234522222', 'siva253@gmail.com', 'nerxpire', '6bb4fb7e268286f36c34049a5fcd09fc', NULL),
(72, 'rahul', '3456345621', 'vignesh253@gmail.com', 'cds', 'd47be97218819f1edd67801882aa03ab', NULL),
(73, 'ramesh', '1233434580', 'ramesh@gmail.com', 'cdss', 'b09ae79bb0d93a23c578fd397edd6e3c', 1),
(74, 'pradeep', '1234567800', 'preadeep@gmail.com', 'cds', '1242df0165475aa9b90767bcbceef9c4', 1),
(76, 'saran', '1234444444', 'saran@gmail.com', 'cds', 'b6fc64ff9d509de9f692e2aec623d353', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usercampaign`
--

CREATE TABLE `usercampaign` (
  `usercampaignid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `campaignid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `roles_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `roles_name`) VALUES
(1, 'admin'),
(2, 'regular_user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulk_user`
--
ALTER TABLE `bulk_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`campaignid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `campaignid` (`campaignid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `message_group`
--
ALTER TABLE `message_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `fk_user_created_id` (`user_created_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `usercampaign`
--
ALTER TABLE `usercampaign`
  ADD PRIMARY KEY (`usercampaignid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `campaignid` (`campaignid`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulk_user`
--
ALTER TABLE `bulk_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `campaignid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `message_group`
--
ALTER TABLE `message_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `usercampaign`
--
ALTER TABLE `usercampaign`
  MODIFY `usercampaignid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`campaignid`) REFERENCES `campaign` (`campaignid`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `message_group`
--
ALTER TABLE `message_group`
  ADD CONSTRAINT `fk_user_created_id` FOREIGN KEY (`user_created_id`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `message_group_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `usercampaign`
--
ALTER TABLE `usercampaign`
  ADD CONSTRAINT `usercampaign_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `usercampaign_ibfk_2` FOREIGN KEY (`campaignid`) REFERENCES `campaign` (`campaignid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
