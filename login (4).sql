-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 10:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minor-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `login_token` varchar(300) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `Img_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `phone_number`, `password`, `login_token`, `login_date`, `type`, `status`, `Img_path`) VALUES
(10, 'Arindam Das', 'arindam@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2d5d4cf93ccf992b3fe617b32b8296a3', '2023-05-10 18:40:13', 1, 1, NULL),
(11, 'Sudip Patra', 'sudippatra3711@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', 'c49e446a46fa27a6e18ffb6119461c3f', '2023-05-11 16:23:06', 1, 10, '../upload/1683813496.jpg'),
(13, 'Pratyay Ray', 'pratyay@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '5588902a8054f6e22ed3484c140ffc62', '2023-05-11 16:20:31', 1, 1, NULL),
(14, 'Manna', 'manna@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '79e3eb7e992b7f766bdd77cc502ff082', '2023-05-11 16:23:00', 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
