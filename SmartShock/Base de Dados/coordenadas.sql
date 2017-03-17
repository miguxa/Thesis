-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Mar-2017 às 02:02
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tese`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenadas`
--

CREATE TABLE `coordenadas` (
  `id` int(11) NOT NULL,
  `forca` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `coordenadas`
--

INSERT INTO `coordenadas` (`id`, `forca`, `latitude`, `longitude`, `data`) VALUES
(164, 2, 39.2391, -8.3451, '2017-01-30 22:44:00'),
(165, 1, 39.2211, -8.2359, '2017-08-16 23:28:00'),
(166, 2, 41.7264, -8.6992, '2017-12-29 10:00:00'),
(168, 2, 40.4029, -7.8271, '2017-08-25 16:44:00'),
(169, 2, 41.9481, -7.1713, '2017-09-15 07:44:00'),
(170, 2, 40.4029, -7.8271, '2017-08-25 16:44:00'),
(268, 1, 38.7187, -9.3315, '2017-02-20 18:45:00'),
(269, 1, 38.7187, -9.3316, '2017-02-20 18:37:00'),
(270, 1, 38.7187, -9.3316, '2017-02-20 18:37:00'),
(271, 1, 38.7187, -9.3318, '2017-02-20 19:08:00'),
(272, 1, 38.7187, -9.3317, '2017-02-20 19:08:00'),
(273, 3, 38.7187, -9.3318, '2017-02-20 19:08:00'),
(274, 1, 38.6601, -9.2044, '2017-02-21 11:18:00'),
(275, 1, 38.7188, -9.3314, '2017-02-22 15:23:00'),
(276, 2, 38.7188, -9.3316, '2017-02-22 15:34:00'),
(277, 1, 38.7188, -9.3316, '2017-02-22 15:33:00'),
(278, 1, 38.7188, -9.3314, '2017-02-22 15:37:00'),
(279, 4, 38.7188, -9.3314, '2017-02-22 15:38:00'),
(280, 1, 0, -9.3315, '2017-02-22 15:48:00'),
(281, 1, 38.7188, -9.3316, '2017-02-22 16:50:00'),
(284, 6, 38.7188, -9.0315, '0000-00-00 00:00:00'),
(285, 6, 38.7188, -8.6684, '2017-02-23 11:33:00'),
(287, 6, 38.7188, -9.3315, '2017-02-23 11:42:00'),
(288, 1, 38.7223, -9.3258, '2017-02-23 12:17:00'),
(342, 6, 38.659, -9.204, '2017-02-23 15:26:00'),
(343, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(344, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(345, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(346, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(347, 1, 38.7187, -9.3315, '2017-03-02 21:05:00'),
(348, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(349, 1, 38.7187, -9.3315, '2017-03-02 21:05:00'),
(350, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(351, 1, 38.7187, -9.3316, '2017-03-02 21:00:00'),
(352, 1, 38.7187, -9.3315, '2017-03-02 21:05:00'),
(353, 1, 38.7187, -9.3315, '2017-03-02 21:05:00'),
(354, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(355, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(356, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(357, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(358, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(359, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(360, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(361, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(362, 1, 38.7188, -9.3315, '2017-03-03 01:04:00'),
(363, 1, 38.7186, -9.3321, '2017-03-03 01:26:00'),
(364, 1, 38.7186, -9.3321, '2017-03-03 01:26:00'),
(365, 1, 38.7186, -9.3321, '2017-03-03 01:26:00'),
(366, 1, 38.7186, -9.3321, '2017-03-03 01:26:00'),
(367, 4, 38.7187, -9.3317, '2017-03-03 01:29:00'),
(368, 4, 38.66, -9.204, '2017-02-23 12:00:00'),
(369, 4, 38.6604, -9.2036, '2017-02-23 12:00:00'),
(370, 4, 38.6604, -9.2032, '2017-02-23 12:00:00'),
(371, 4, 38.6595, -9.2035, '2017-02-23 12:00:00'),
(372, 3, 38.6591, -9.2041, '2017-03-03 20:23:00'),
(373, 3, 38.6591, -9.2041, '2017-03-03 20:23:00'),
(374, 3, 38.6591, -9.2041, '2017-03-03 20:23:00'),
(375, 3, 38.6591, -9.2041, '2017-03-03 20:23:00'),
(376, 3, 38.6591, -9.2041, '2017-03-03 20:23:00'),
(377, 3, 38.6602, -9.2038, '2017-03-08 15:48:00'),
(378, 2, 38.6596, -9.203, '2017-03-08 15:50:00'),
(379, 2, 38.6578, -9.2028, '2017-03-08 15:51:00'),
(380, 1, 38.6557, -9.2051, '2017-03-08 15:51:00'),
(381, 1, 38.6542, -9.2141, '2017-03-08 15:51:00'),
(382, 2, 38.6542, -9.2112, '2017-03-08 15:51:00'),
(383, 2, 38.6564, -9.2189, '2017-03-08 15:52:00'),
(384, 4, 38.6563, -9.2191, '2017-03-08 15:52:00'),
(385, 2, 38.6547, -9.2157, '2017-03-08 15:53:00'),
(386, 1, 38.6517, -9.2145, '2017-03-08 15:53:00'),
(387, 2, 38.651, -9.2154, '2017-03-08 15:56:00'),
(388, 1, 38.6509, -9.2154, '2017-03-08 15:57:00'),
(389, 1, 38.651, -9.2153, '2017-03-08 15:57:00'),
(390, 2, 38.6524, -9.2145, '2017-03-08 15:57:00'),
(391, 2, 38.6539, -9.213, '2017-03-08 15:57:00'),
(392, 2, 38.6549, -9.2071, '2017-03-08 15:58:00'),
(393, 1, 38.6556, -9.2051, '2017-03-08 15:58:00'),
(394, 1, 38.656, -9.204, '2017-03-08 15:58:00'),
(395, 1, 38.6602, -9.2033, '2017-03-08 16:00:00'),
(396, 1, 38.6605, -9.2043, '2017-03-08 16:01:00'),
(397, 1, 38.6601, -9.2038, '2017-03-08 16:01:00'),
(398, 2, 38.6601, -9.2038, '2017-03-08 16:01:00'),
(399, 6, 38.6597, -9.2017, '2017-03-12 18:20:00'),
(400, 1, 38.6607, -9.204, '2017-03-13 10:00:00'),
(401, 1, 38.6627, -9.206, '2017-03-13 10:01:00'),
(402, 1, 38.6629, -9.2068, '2017-03-13 10:01:00'),
(403, 1, 38.6622, -9.2073, '2017-03-13 10:01:00'),
(404, 1, 38.6607, -9.204, '2017-03-13 10:00:00'),
(405, 1, 38.6607, -9.204, '2017-03-13 10:00:00'),
(406, 6, 38.6601, -9.2037, '2017-03-13 10:11:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordenadas`
--
ALTER TABLE `coordenadas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordenadas`
--
ALTER TABLE `coordenadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
