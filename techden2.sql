-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 10:17 PM
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
-- Database: `techden`
--

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `korpa_id` int(11) NOT NULL,
  `racunar_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `racunari`
--

CREATE TABLE `racunari` (
  `racunar_ID` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `cena` decimal(30,0) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `broj_pregleda` int(7) NOT NULL,
  `broj_kupovina` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racunari`
--

INSERT INTO `racunari` (`racunar_ID`, `naziv`, `cena`, `slika`, `broj_pregleda`, `broj_kupovina`) VALUES
(1, 'Kompjuter1', 107, 'slika1.jpg', 123, 321),
(2, 'Kompjuter2', 205, 'slika2.jpg', 0, 0),
(3, 'Kompjuter3', 300, 'slika3.jpg', 0, 0),
(79, 'Kompjuter4', 400, 'slika4.jpg', 213, 33),
(80, 'Kompjuter5', 500, 'slika5.jpg', 0, 0),
(81, 'Kompjuter6', 600, 'slika6.jpg', 0, 0),
(82, 'Kompjuter7', 700, 'slika7.png', 123, 5),
(83, 'Kompjuter8', 800, 'slika8.jpg', 0, 0),
(84, 'Kompjuter9', 900, 'slika9.jpg', 0, 0),
(85, 'Kompjuter10', 1000, 'slika10.jpg', 0, 0),
(86, 'Kompjuter11', 1100, 'slika11.jpg', 0, 0),
(87, 'Kompjuter12', 1200, 'slika12.jpg', 0, 0),
(88, 'Kompjuter13', 1300, 'slika13.png', 0, 0),
(89, 'Kompjuter14', 1400, 'slika14.jpg', 2555, 0),
(638, '1234', 123, 'slika1.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `slika_ID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`slika_ID`, `naziv`) VALUES
(4, 'slika1.jpg'),
(5, 'slika2.jpg'),
(6, 'slika3.jpg'),
(7, 'slika4.jpg'),
(8, 'slika5.jpg'),
(9, 'slika6.jpg'),
(10, 'slika7.png'),
(11, 'slika8.jpg'),
(12, 'slika8.jpg'),
(13, 'slika9.jpg'),
(14, 'slika10.jpg'),
(15, 'slika11.jpg'),
(16, 'slika12.jpg'),
(17, 'slika13.png'),
(18, 'slika14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `email`, `password`, `created_at`, `is_admin`) VALUES
(25, 'jocapro2003', 'jovanspasov003@gmail.com', 'jocapro2003', '2024-03-12 14:07:34', 1),
(39, 'dusan123', 'dusan123@gmail.com', 'dusan123', '2024-02-08 18:48:05', 0),
(40, 'nikola', 'nikola@gmail.com', 'nikola ', '2024-11-13 20:29:37', 0),
(41, 'luka', 'luka@gmail.com', 'luka', '2024-09-18 19:29:45', 0),
(42, 'petar', 'petar@gmail.com', 'petar', '2024-08-14 19:29:59', 0),
(43, 'marko', 'marko@gmail.com', 'marko', '2024-07-17 19:30:26', 0),
(44, 'dejan', 'dejan@gmail.com', 'dejan', '2024-11-20 20:30:40', 0),
(45, 'ana', 'ana@gmail.com', 'ana', '2024-10-09 19:30:49', 0),
(46, 'irena', 'irena@gmail.com', 'irena', '2024-09-13 19:31:02', 0),
(47, 'nina', 'nina@gmail.com', 'nina', '2024-09-13 19:31:22', 0),
(48, 'radoje', 'radoje@gmail.com', 'radoje', '2024-08-13 19:31:30', 0),
(49, 'lazar', 'lazar@gmail.com', 'lazar', '2024-10-16 19:31:37', 0),
(50, 'aleksa', 'aleksa@gmail.com', 'aleksa', '2024-11-21 20:31:48', 0),
(51, 'djordje', 'djordje@gmail.com', 'djordje', '2024-06-13 19:32:12', 0),
(52, 'vuk', 'vuk@gmail.com', 'vuk', '2024-06-12 19:32:22', 0),
(53, 'nikolina', 'nikolina@gmail.com', 'nikolina', '2024-06-12 19:32:40', 0),
(54, 'deki', 'deki@gmail.com', 'deki', '2024-07-17 19:33:11', 0),
(55, 'lule', 'lule@gmail.com', 'lule', '2024-07-17 19:33:20', 0),
(56, 'jovan', 'jovan@gmail.com', 'jovan', '2024-08-21 19:33:29', 0),
(57, 'milos', 'milos@gmail.com', 'milos', '2024-11-20 20:33:40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`korpa_id`);

--
-- Indexes for table `racunari`
--
ALTER TABLE `racunari`
  ADD PRIMARY KEY (`racunar_ID`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`slika_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `korpa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `racunari`
--
ALTER TABLE `racunari`
  MODIFY `racunar_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `slika_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
