-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2019 at 08:11 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postiee`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `admin_user_id` bigint(11) UNSIGNED NOT NULL,
  `friend_user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `admin_user_id`, `friend_user_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 349),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `friend_user_id` int(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `user_id`, `friend_user_id`, `date`) VALUES
(8, 1, 5, '2017-02-24 12:40:59'),
(9, 1, 77, '2017-02-24 12:41:42'),
(10, 1, 5, '2017-03-01 12:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `mod_history`
--

CREATE TABLE `mod_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `obj_type` varchar(255) NOT NULL,
  `obj_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `mod_type` varchar(255) NOT NULL,
  `mod_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_history`
--

INSERT INTO `mod_history` (`id`, `obj_type`, `obj_id`, `user_id`, `admin_id`, `mod_type`, `mod_time`) VALUES
(1, 'note', 3, 1, 1, 'update', '2017-01-30 10:36:13'),
(2, 'note', 3, 1, 1, 'update', '2017-01-30 10:36:30'),
(3, 'note', 1, 1, 1, 'update', '2017-01-30 10:36:40'),
(4, 'note', 3, 2, 1, 'update', '2017-01-30 10:37:21'),
(5, 'note', 2, 2, 1, 'update', '2017-01-30 14:02:23'),
(6, 'note', 4, 1, 1, 'add', '2017-01-31 09:03:26'),
(7, 'project', 3, 1, 1, 'add', '2017-01-31 09:33:13'),
(8, 'project', 3, 1, 1, 'update', '2017-01-31 09:37:15'),
(9, 'project', 3, 1, 1, 'assign', '2017-01-31 10:31:36'),
(10, 'account', 1, 1, 1, 'update', '2017-01-31 10:35:58'),
(11, 'friend', 4, 1, 1, 'add', '2017-01-31 12:12:52'),
(21, 'note', 4, 1, 1, 'archive', '2017-01-31 14:23:53'),
(22, 'note', 4, 1, 1, 'restore', '2017-01-31 14:24:28'),
(23, 'note', 4, 1, 1, 'archive', '2017-02-01 10:18:08'),
(24, 'note', 5, 1, 1, 'add', '2017-02-07 11:31:05'),
(25, 'note', 3, 1, 1, 'archive', '2017-02-07 11:31:19'),
(26, 'note', 3, 1, 1, 'restore', '2017-02-07 11:31:51'),
(27, 'note', 4, 1, 1, 'restore', '2017-02-07 11:32:06'),
(28, 'note', 3, 1, 1, 'archive', '2017-02-07 11:32:32'),
(29, 'note', 3, 1, 1, 'restore', '2017-02-07 11:32:37'),
(30, 'account', 1, 1, 1, 'update', '2017-02-27 14:04:52'),
(31, 'account', 1, 1, 1, 'update', '2017-02-27 14:08:32'),
(32, 'account', 1, 1, 1, 'update', '2017-02-27 14:09:20'),
(33, 'account', 1, 1, 1, 'update', '2017-02-27 14:11:15'),
(34, 'account', 1, 1, 1, 'update', '2017-02-27 14:12:12'),
(35, 'account', 1, 1, 1, 'update', '2017-02-27 14:14:10'),
(36, 'account', 1, 1, 1, 'update', '2017-02-28 11:18:38'),
(37, 'account', 1, 1, 1, 'update', '2017-02-28 11:27:59'),
(38, 'account', 1, 1, 1, 'update', '2017-02-28 11:28:53'),
(39, 'account', 1, 1, 1, 'update', '2017-02-28 11:29:39'),
(40, 'account', 1, 1, 1, 'update', '2017-02-28 11:32:34'),
(41, 'account', 1, 1, 1, 'update', '2017-02-28 11:39:48'),
(42, 'account', 1, 1, 1, 'update', '2017-02-28 12:26:04'),
(43, 'account', 1, 1, 1, 'update', '2017-02-28 13:08:25'),
(44, 'account', 1, 1, 1, 'update', '2017-02-28 13:20:53'),
(45, 'account', 1, 1, 1, 'update', '2017-02-28 13:36:03'),
(46, 'account', 1, 1, 1, 'update', '2017-03-01 10:43:53'),
(47, 'account', 1, 1, 1, 'update', '2017-03-01 10:45:04'),
(48, 'account', 1, 1, 1, 'update', '2017-03-01 11:09:06'),
(49, 'account', 1, 1, 1, 'update', '2017-03-01 11:17:45'),
(50, 'account', 1, 1, 1, 'update', '2017-03-01 11:19:54'),
(51, 'account', 1, 1, 1, 'update', '2017-03-01 11:20:04'),
(52, 'account', 1, 1, 1, 'update', '2017-03-01 11:20:36'),
(53, 'account', 1, 1, 1, 'update', '2017-03-01 12:55:20'),
(54, 'account', 1, 1, 1, 'update', '2017-03-01 12:55:39'),
(55, 'account', 1, 1, 1, 'update', '2017-03-01 12:56:24'),
(56, 'note', 6, 1, 1, 'add', '2017-03-20 12:49:48'),
(57, 'note', 6, 1, 1, 'update', '2017-03-20 12:55:49'),
(58, 'note', 6, 1, 1, 'update', '2017-03-20 13:35:45'),
(59, 'note', 6, 1, 1, 'update', '2017-03-20 13:35:53'),
(60, 'note', 6, 1, 1, 'update', '2017-03-20 13:36:04'),
(61, 'note', 6, 1, 1, 'update', '2017-03-20 13:36:19'),
(62, 'note', 6, 1, 1, 'update', '2018-02-26 08:19:32'),
(63, 'note', 6, 1, 1, 'update', '2018-02-26 08:19:45'),
(64, 'note', 5, 1, 1, 'archive', '2018-02-26 08:49:28'),
(65, 'note', 7, 1, 1, 'add', '2018-02-26 08:51:13'),
(66, 'project', 4, 1, 1, 'add', '2018-02-26 09:00:33'),
(67, 'project', 4, 1, 1, 'update', '2018-02-26 09:01:59'),
(68, 'project', 4, 1, 1, 'assign', '2018-02-26 09:02:43'),
(69, 'note', 8, 1, 1, 'add', '2018-02-26 09:24:20'),
(70, 'note', 9, 1, 1, 'add', '2018-02-26 12:21:31'),
(71, 'note', 9, 1, 1, 'update', '2018-02-28 12:15:26'),
(72, 'note', 9, 1, 1, 'update', '2018-02-28 12:18:15'),
(73, 'note', 9, 1, 1, 'update', '2018-02-28 12:19:19'),
(74, 'note', 9, 1, 1, 'update', '2018-02-28 12:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `data1` varchar(255) NOT NULL,
  `data2` varchar(255) NOT NULL,
  `data3` varchar(255) NOT NULL,
  `data4` varchar(255) NOT NULL,
  `data5` varchar(255) NOT NULL,
  `bg_color` varchar(11) NOT NULL,
  `archived` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `data1`, `data2`, `data3`, `data4`, `data5`, `bg_color`, `archived`, `last_update`) VALUES
(1, 'Create final project video', 'Submit the video', 'This is a note3', '', '', '#c7f242', 0, '2017-01-30 10:36:40'),
(2, 'Hilight admin if user is admin (projects)', 'Link user names to each individual profile pages', 'Un-assign friends', '', '', '#64b5f0', 0, '2017-01-30 14:02:23'),
(3, 'Add time-stamp to notes', 'Note by david', '', '', '', '#ec4695', 0, '2017-02-07 11:32:37'),
(4, 'Display posts with user id and admin id are same', '', '', '', '', '#f77e9d', 0, '2017-02-07 11:32:06'),
(5, 'AJAX for notes', '', '', '', '', '#f77e9d', 1, '2018-02-26 08:49:28'),
(6, 'Find friend section is not working &quot;cancel request&quot; properly', 'Display profile pictures on Friend list', '', '', '', '#28e646', 0, '2018-02-26 08:19:45'),
(7, 'Click cancel while editing a note return to whiteboard', 'Should redirect to Note itself which is editing', 'or the project itself', '', '', '#f78843', 0, '2018-02-26 08:51:13'),
(8, 'Chat system', 'Group chat for each individual projects', 'Chat window at right side', 'Active only on each project page', '', '#63e0f7', 0, '2018-02-26 09:24:20'),
(9, 'Bootstrap 4.0 updated', 'Layout fixes needs to resolved', 'Overall ui need to upgrade', 'AJAX integration pending', 'Search forms are not working', '#adf74f', 0, '2018-02-26 12:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `archived` int(11) NOT NULL,
  `total_notes` bigint(11) UNSIGNED NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `archived`, `total_notes`, `last_update`) VALUES
(1, 'CS50 Final Project', 0, 2, '2017-02-07 11:32:37'),
(2, 'Feature Upgrade', 0, 3, '2018-02-26 09:24:20'),
(3, 'Bug Reports', 0, 2, '2018-02-26 08:51:13'),
(4, '26 February 2018', 0, 1, '2018-02-26 12:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `project_assigned`
--

CREATE TABLE `project_assigned` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `project_id` bigint(11) UNSIGNED NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_assigned`
--

INSERT INTO `project_assigned` (`id`, `user_id`, `project_id`, `admin`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 0),
(3, 1, 2, 1),
(4, 3, 1, 0),
(5, 2, 2, 0),
(6, 1, 3, 1),
(7, 349, 3, 0),
(8, 1, 4, 1),
(9, 3, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `id` int(20) UNSIGNED NOT NULL,
  `note_id` int(20) UNSIGNED NOT NULL,
  `project_id` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `note_id`, `project_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 2),
(5, 5, 2),
(6, 6, 3),
(7, 7, 3),
(8, 8, 2),
(9, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_pic` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `firstname`, `lastname`, `email`, `reg_date`, `profile_pic`, `user_status`) VALUES
(1, 'debraj', '$2y$10$id6AHxmqeG8/jlC42OkKYualzEQAsD7LAAhZ6n4CMqCqotbN2jgEu', 'Debraj', 'Rakshit', 'debrajweb@gmail.com', '2017-03-01 08:26:24', 'uploads/user/debraj01.jpg', 0),
(2, 'david', '$2y$10$/y1/xOTuV7pGI9qp2279AOvejiMmKGUklsaUvW5Ba/ce22fVhvjd.', 'David', 'Malan', 'david@harvard.edu', '2017-03-20 13:28:15', 'uploads/user/david-malan.jpg', 0),
(3, 'zamyla', '$2y$10$9WUsMXiqVUMmaF8WRKEwcubf977caP4JaaELbiWNtG2aLnajlywu2', 'Zamyla', 'Chan', 'zamyla@harvard.edu', '2017-03-20 13:30:19', 'uploads/user/zamyla-chan.jpg', 0),
(4, 'colton', '$2y$10$.MTfOW0lS0BfUQwtvlBhV.eJjZ9Y6gENq8Jcvn644yBztKkguZPFa', 'Colton', 'Ogen', 'colton@harvard.edu', '2017-03-20 13:33:12', 'uploads/user/colton-ogen.jpg', 0),
(5, 'harold', '$2y$10$xpmR87NNMATloZZteSx8T.yTSV4TFOroLmqgBBr1FHh2F6/lx7ze2', 'Harold', 'Abelson', 'harold@gmail.com', '2017-03-22 13:13:35', 'https://www.imperial.ac.uk/ImageCropToolT4/imageTool/uploaded-images/Jasper-Wong--tojpeg_1457004859772_x2.jpg', 0),
(77, 'test', '$2y$10$Nw.tdTdOoRtnG52.g/lCou2No.ATCwux9/gt6dXBx1aL8X/HoWJCa', 'Fredrik', 'Haren', 'fredrik@posti.com', '2017-03-22 13:17:44', 'https://pbs.twimg.com/profile_images/454147270758240256/8T_BGJ-p.jpeg', 0),
(82, 'bill', '$2y$10$DhOr/vkKcGI76.NoZUF61e5Egq10ctx7DgT7GAFw/Nc.wTIvJ2jlW', 'Bill', 'Gates', 'billgates@microsoft.com', '2017-03-22 13:15:35', 'https://pbs.twimg.com/profile_images/558109954561679360/j1f9DiJi.jpeg', 0),
(83, 'etta', '$2y$10$E1OFjhB/eQUazLDo8BiRJuxbyoRLDbeCg8Heuh3MtCvhXLKFoxUg6', 'Etta', 'Zhang', 'etta@hotmail.com', '2017-03-22 13:13:15', 'https://www.imperial.ac.uk/ImageCropToolT4/imageTool/uploaded-images/Sonika-Sethi-2--tojpeg_1457004963707_x2.jpg', 0),
(348, 'frank', '$2y$10$6EtgaodMgOvJJBDt5LJW/eVOQayolWWNT//p1fdNxOC2rwKZKG/wG', 'Frank', 'Miller', 'frank@emailid.com', '2017-03-22 13:13:53', 'https://www.imperial.ac.uk/ImageCropToolT4/imageTool/uploaded-images/150513_scholars_009--tojpeg_1457015034263_x2.jpg', 0),
(349, 'cs50', '$2y$10$DxugkGp.h01XFFqjEWbxvOb5TgNZGpHjmoU4.tg9SUZeJk8BbUIx.', 'Doug', 'Loyed', 'doug@harvard.edu', '2017-03-20 13:31:59', 'uploads/user/doug-lloyd.jpg', 0),
(353, 'john', '$2y$10$hRHyagku1hQXlEdpdF6QXOXQPEda6mRlSRn/XfGg.hEA0Mq.4LSKC', 'John', 'Smith', 'debrajweb@gmail.com', '2017-02-07 08:05:17', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mod_history`
--
ALTER TABLE `mod_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `project_assigned`
--
ALTER TABLE `project_assigned`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mod_history`
--
ALTER TABLE `mod_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_assigned`
--
ALTER TABLE `project_assigned`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
