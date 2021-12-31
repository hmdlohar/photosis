-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2021 at 04:20 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iEdit`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `type`) VALUES
(2, 'A10', 'clipart'),
(3, 'A11', 'clipart'),
(4, 'A12', 'clipart'),
(5, 'A13', 'clipart'),
(6, 'A14', 'clipart'),
(7, 'A15', 'clipart'),
(8, 'A16', 'clipart'),
(9, 'A17', 'clipart'),
(10, 'A18', 'clipart'),
(11, 'A19', 'clipart'),
(12, 'A1', 'clipart'),
(13, 'A20', 'clipart'),
(14, 'A21', 'clipart'),
(15, 'A22', 'clipart'),
(16, 'A23', 'clipart'),
(17, 'A24', 'clipart'),
(18, 'A25', 'clipart'),
(19, 'A26', 'clipart'),
(20, 'A27', 'clipart'),
(21, 'A28', 'clipart'),
(22, 'A29', 'clipart'),
(23, 'A2', 'clipart'),
(24, 'A30', 'clipart'),
(25, 'A31', 'clipart'),
(26, 'A32', 'clipart'),
(27, 'A33', 'clipart'),
(28, 'A34', 'clipart'),
(29, 'A35', 'clipart'),
(30, 'A36', 'clipart'),
(31, 'A37', 'clipart'),
(32, 'A38', 'clipart'),
(33, 'A39', 'clipart'),
(34, 'A3', 'clipart'),
(35, 'A40', 'clipart'),
(36, 'A41', 'clipart'),
(37, 'A42', 'clipart'),
(38, 'A43', 'clipart'),
(39, 'A44', 'clipart'),
(40, 'A45', 'clipart'),
(41, 'A46', 'clipart'),
(42, 'A47', 'clipart'),
(43, 'A48', 'clipart'),
(44, 'A49', 'clipart'),
(45, 'A4', 'clipart'),
(46, 'A50', 'clipart'),
(47, 'A51', 'clipart'),
(48, 'A52', 'clipart'),
(49, 'A53', 'clipart'),
(50, 'A54', 'clipart'),
(51, 'A55', 'clipart'),
(52, 'A56', 'clipart'),
(53, 'A57', 'clipart'),
(54, 'A58', 'clipart'),
(55, 'A59', 'clipart'),
(56, 'A5', 'clipart'),
(57, 'A60', 'clipart'),
(58, 'A61', 'clipart'),
(59, 'A62', 'clipart'),
(60, 'A63', 'clipart'),
(61, 'A64', 'clipart'),
(62, 'A65', 'clipart'),
(63, 'A66', 'clipart'),
(64, 'A67', 'clipart'),
(65, 'A68', 'clipart'),
(66, 'A69', 'clipart'),
(67, 'A6', 'clipart'),
(68, 'A70', 'clipart'),
(69, 'A71', 'clipart'),
(70, 'A72', 'clipart'),
(71, 'A73', 'clipart'),
(72, 'A74', 'clipart'),
(73, 'A75', 'clipart'),
(74, 'A76', 'clipart'),
(75, 'A77', 'clipart'),
(76, 'A78', 'clipart'),
(77, 'A79', 'clipart'),
(78, 'A7', 'clipart'),
(79, 'A80', 'clipart'),
(80, 'A81', 'clipart'),
(81, 'A8', 'clipart'),
(82, 'A9', 'clipart'),
(83, 'B10', 'clipart'),
(84, 'B11', 'clipart'),
(85, 'B12', 'clipart'),
(86, 'B13', 'clipart'),
(87, 'B14', 'clipart'),
(88, 'B15', 'clipart'),
(89, 'B16', 'clipart'),
(90, 'B17', 'clipart'),
(91, 'B18', 'clipart'),
(92, 'B19', 'clipart'),
(93, 'B1', 'clipart'),
(94, 'B20', 'clipart'),
(95, 'B21', 'clipart'),
(96, 'B22', 'clipart'),
(97, 'B23', 'clipart'),
(98, 'B24', 'clipart'),
(99, 'B25', 'clipart'),
(100, 'B26', 'clipart'),
(101, 'B27', 'clipart'),
(102, 'B28', 'clipart'),
(103, 'B29', 'clipart'),
(104, 'B2', 'clipart'),
(105, 'B30', 'clipart'),
(106, 'B31', 'clipart'),
(107, 'B32', 'clipart'),
(108, 'B33', 'clipart'),
(109, 'B34', 'clipart'),
(110, 'B35', 'clipart'),
(111, 'B36', 'clipart'),
(112, 'B37', 'clipart'),
(113, 'B38', 'clipart'),
(114, 'B39', 'clipart'),
(115, 'B3', 'clipart'),
(116, 'B40', 'clipart'),
(117, 'B41', 'clipart'),
(118, 'B42', 'clipart'),
(119, 'B43', 'clipart'),
(120, 'B44', 'clipart'),
(121, 'B45', 'clipart'),
(122, 'B46', 'clipart'),
(123, 'B47', 'clipart'),
(124, 'B48', 'clipart'),
(125, 'B49', 'clipart'),
(126, 'B4', 'clipart'),
(127, 'B50', 'clipart'),
(128, 'B51', 'clipart'),
(129, 'B52', 'clipart'),
(130, 'B53', 'clipart'),
(131, 'B54', 'clipart'),
(132, 'B55', 'clipart'),
(133, 'B56', 'clipart'),
(134, 'B57', 'clipart'),
(135, 'B58', 'clipart'),
(136, 'B59', 'clipart'),
(137, 'B5', 'clipart'),
(138, 'B60', 'clipart'),
(139, 'B61', 'clipart'),
(140, 'B62', 'clipart'),
(141, 'B63', 'clipart'),
(142, 'B64', 'clipart'),
(143, 'B65', 'clipart'),
(144, 'B66', 'clipart'),
(145, 'B67', 'clipart'),
(146, 'B68', 'clipart'),
(147, 'B69', 'clipart'),
(148, 'B6', 'clipart'),
(149, 'B70', 'clipart'),
(150, 'B71', 'clipart'),
(151, 'B72', 'clipart'),
(152, 'B7', 'clipart'),
(153, 'B8', 'clipart'),
(154, 'B9', 'clipart'),
(155, 'Back', 'clipart'),
(156, 'Beard10', 'clipart'),
(157, 'Beard11', 'clipart'),
(158, 'Beard12', 'clipart'),
(159, 'Beard13', 'clipart'),
(160, 'Beard14', 'clipart'),
(161, 'Beard15', 'clipart'),
(162, 'Beard16', 'clipart'),
(163, 'Beard17', 'clipart'),
(164, 'Beard18', 'clipart'),
(165, 'Beard19', 'clipart'),
(166, 'Beard1', 'clipart'),
(167, 'Beard20', 'clipart'),
(168, 'Beard21', 'clipart'),
(169, 'Beard22', 'clipart'),
(170, 'Beard23', 'clipart'),
(171, 'Beard24', 'clipart'),
(172, 'Beard25', 'clipart'),
(173, 'Beard26', 'clipart'),
(174, 'Beard27', 'clipart'),
(175, 'Beard28', 'clipart'),
(176, 'Beard29', 'clipart'),
(177, 'Beard2', 'clipart'),
(178, 'Beard30', 'clipart'),
(179, 'Beard31', 'clipart'),
(180, 'Beard32', 'clipart'),
(181, 'Beard33', 'clipart'),
(182, 'Beard34', 'clipart'),
(183, 'Beard35', 'clipart'),
(184, 'Beard36', 'clipart'),
(185, 'Beard37', 'clipart'),
(186, 'Beard38', 'clipart'),
(187, 'Beard39', 'clipart'),
(188, 'Beard3', 'clipart'),
(189, 'Beard40', 'clipart'),
(190, 'Beard4', 'clipart'),
(191, 'Beard5', 'clipart'),
(192, 'Beard6', 'clipart'),
(193, 'Beard7', 'clipart'),
(194, 'Beard8', 'clipart'),
(195, 'Beard9', 'clipart'),
(196, 'C10', 'clipart'),
(197, 'C11', 'clipart'),
(198, 'C12', 'clipart'),
(199, 'C13', 'clipart'),
(200, 'C14', 'clipart'),
(201, 'C15', 'clipart'),
(202, 'C1', 'clipart'),
(203, 'C2', 'clipart'),
(204, 'C3', 'clipart'),
(205, 'C4', 'clipart'),
(206, 'C5', 'clipart'),
(207, 'C6', 'clipart'),
(208, 'C7', 'clipart'),
(209, 'C8', 'clipart'),
(210, 'C9', 'clipart'),
(211, 'Chundricap10', 'clipart'),
(212, 'Chundricap11', 'clipart'),
(213, 'Chundricap12', 'clipart'),
(214, 'Chundricap13', 'clipart'),
(215, 'Chundricap14', 'clipart'),
(216, 'Chundricap15', 'clipart'),
(217, 'Chundricap16', 'clipart'),
(218, 'Chundricap1', 'clipart'),
(219, 'Chundricap2', 'clipart'),
(220, 'Chundricap3', 'clipart'),
(221, 'Chundricap4', 'clipart'),
(222, 'Chundricap5', 'clipart'),
(223, 'Chundricap6', 'clipart'),
(224, 'Chundricap7', 'clipart'),
(225, 'Chundricap8', 'clipart'),
(226, 'Chundricap9', 'clipart'),
(227, 'Crown10', 'clipart'),
(228, 'Crown11', 'clipart'),
(229, 'Crown12', 'clipart'),
(230, 'Crown13', 'clipart'),
(231, 'Crown14', 'clipart'),
(232, 'Crown15', 'clipart'),
(233, 'Crown16', 'clipart'),
(234, 'Crown1', 'clipart'),
(235, 'Crown2', 'clipart'),
(236, 'Crown3', 'clipart'),
(237, 'Crown4', 'clipart'),
(238, 'Crown5', 'clipart'),
(239, 'Crown6', 'clipart'),
(240, 'Crown7', 'clipart'),
(241, 'Crown8', 'clipart'),
(242, 'Crown9', 'clipart'),
(243, 'Hair10', 'clipart'),
(244, 'Hair11', 'clipart'),
(245, 'Hair12', 'clipart'),
(246, 'Hair13', 'clipart'),
(247, 'Hair14', 'clipart'),
(248, 'Hair15', 'clipart'),
(249, 'Hair16', 'clipart'),
(250, 'Hair17', 'clipart'),
(251, 'Hair18', 'clipart'),
(252, 'Hair19', 'clipart'),
(253, 'Hair1', 'clipart'),
(254, 'Hair20', 'clipart'),
(255, 'Hair21', 'clipart'),
(256, 'Hair22', 'clipart'),
(257, 'Hair23', 'clipart'),
(258, 'Hair24', 'clipart'),
(259, 'Hair25', 'clipart'),
(260, 'Hair26', 'clipart'),
(261, 'Hair27', 'clipart'),
(262, 'Hair28', 'clipart'),
(263, 'Hair29', 'clipart'),
(264, 'Hair2', 'clipart'),
(265, 'Hair30', 'clipart'),
(266, 'Hair31', 'clipart'),
(267, 'Hair32', 'clipart'),
(268, 'Hair3', 'clipart'),
(269, 'Hair4', 'clipart'),
(270, 'Hair5', 'clipart'),
(271, 'Hair6', 'clipart'),
(272, 'Hair7', 'clipart'),
(273, 'Hair8', 'clipart'),
(274, 'Hair9', 'clipart'),
(275, 'Mask10', 'clipart'),
(276, 'Mask1', 'clipart'),
(277, 'Mask2', 'clipart'),
(278, 'Mask3', 'clipart'),
(279, 'Mask4', 'clipart'),
(280, 'Mask5', 'clipart'),
(281, 'Mask6', 'clipart'),
(282, 'Mask7', 'clipart'),
(283, 'Mask8', 'clipart'),
(284, 'Mask9', 'clipart'),
(285, 'Yaban10', 'clipart'),
(286, 'Yaban11', 'clipart'),
(287, 'Yaban12', 'clipart'),
(288, 'Yaban13', 'clipart'),
(289, 'Yaban14', 'clipart'),
(290, 'Yaban15', 'clipart'),
(291, 'Yaban16', 'clipart'),
(292, 'Yaban17', 'clipart'),
(293, 'Yaban18', 'clipart'),
(294, 'Yaban19', 'clipart'),
(295, 'Yaban1', 'clipart'),
(296, 'Yaban20', 'clipart'),
(297, 'Yaban21', 'clipart'),
(298, 'Yaban22', 'clipart'),
(299, 'Yaban23', 'clipart'),
(300, 'Yaban24', 'clipart'),
(301, 'Yaban25', 'clipart'),
(302, 'Yaban26', 'clipart'),
(303, 'Yaban27', 'clipart'),
(304, 'Yaban28', 'clipart'),
(305, 'Yaban29', 'clipart'),
(306, 'Yaban2', 'clipart'),
(307, 'Yaban30', 'clipart'),
(308, 'Yaban31', 'clipart'),
(309, 'Yaban32', 'clipart'),
(310, 'Yaban33', 'clipart'),
(311, 'Yaban34', 'clipart'),
(312, 'Yaban35', 'clipart'),
(313, 'Yaban36', 'clipart'),
(314, 'Yaban37', 'clipart'),
(315, 'Yaban38', 'clipart'),
(316, 'Yaban39', 'clipart'),
(317, 'Yaban3', 'clipart'),
(318, 'Yaban40', 'clipart'),
(319, 'Yaban41', 'clipart'),
(320, 'Yaban42', 'clipart'),
(321, 'Yaban43', 'clipart'),
(322, 'Yaban44', 'clipart'),
(323, 'Yaban45', 'clipart'),
(324, 'Yaban46', 'clipart'),
(325, 'Yaban47', 'clipart'),
(326, 'Yaban48', 'clipart'),
(327, 'Yaban49', 'clipart'),
(328, 'Yaban4', 'clipart'),
(329, 'Yaban50', 'clipart'),
(330, 'Yaban51', 'clipart'),
(331, 'Yaban5', 'clipart'),
(332, 'Yaban6', 'clipart'),
(333, 'Yaban7', 'clipart'),
(334, 'Yaban8', 'clipart'),
(335, 'Yaban9', 'clipart'),
(336, 'frame1', 'frame'),
(337, 'frame2', 'frame'),
(338, 'frame3', 'frame'),
(339, 'frame4', 'frame'),
(340, 'frame5', 'frame'),
(341, 'frame6', 'frame'),
(342, 'frame7', 'frame'),
(343, 'frame8', 'frame'),
(344, 'farme9', 'frame'),
(345, 'frame10', 'frame');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `photo_id`, `time`) VALUES
(3, 14, '2019-03-17 02:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(2, 'adie', 'iamadie222', 'iamaide222@gmail.com', '20557818a590a772d01b434ff3346be5'),
(3, 'hamid lohar', 'hmdlohar', 'hmdlohar@gmail.com', '20557818a590a772d01b434ff3346be5');

-- --------------------------------------------------------

--
-- Table structure for table `user_photos`
--

CREATE TABLE `user_photos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_photos`
--

INSERT INTO `user_photos` (`id`, `name`, `user_id`, `status`, `path`) VALUES
(5, 'lalol', 2, 1, ''),
(6, 'ranweer topiwala', 2, 1, ''),
(7, 'wohoooo', 2, 1, ''),
(8, 'VarunDadhiWala', 2, 1, ''),
(10, 'gora chitta', 2, 1, ''),
(11, 'good Smile', 2, 1, ''),
(12, 'Untitled', 2, 1, ''),
(13, 'Name of photos', 1, 1, ''),
(14, 'Name of photo22', 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `user_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD UNIQUE KEY `user_id` (`user_id`,`photo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_photos`
--
ALTER TABLE `user_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_photos`
--
ALTER TABLE `user_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
