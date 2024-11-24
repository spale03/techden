-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 09:11 PM
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

--
-- RELATIONSHIPS FOR TABLE `korpa`:
--

-- --------------------------------------------------------

--
-- Table structure for table `racunari`
--

CREATE TABLE `racunari` (
  `racunar_ID` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `cena` decimal(30,0) NOT NULL,
  `slika` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `racunari`:
--

--
-- Dumping data for table `racunari`
--

INSERT INTO `racunari` (`racunar_ID`, `naziv`, `cena`, `slika`) VALUES
(1, 'Kompjuter1', 107, 'slika1.jpg'),
(2, 'Kompjuter2', 205, 'slika2.jpg'),
(3, 'Kompjuter3', 300, 'slika3.jpg'),
(4, 'Kompjuter4', 400, 'slika4.jpg'),
(5, 'Kompjuter5', 500, 'slika5.jpg'),
(6, 'Kompjuter6', 600, 'slika6.jpg'),
(7, 'Kompjuter7', 700, 'slika7.png'),
(8, 'Kompjuter8', 800, 'slika8.jpg'),
(9, 'Kompjuter9', 900, 'slika9.jpg'),
(10, 'Kompjuter10', 1000, 'slika10.jpg'),
(11, 'Kompjuter11', 1100, 'slika11.jpg'),
(12, 'Kompjuter12', 1200, 'slika12.jpg'),
(13, 'Kompjuter13', 1300, 'slika13.png'),
(14, 'Kompjuter14', 1400, 'slika14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `slika_ID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `slika`:
--

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
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `email`, `password`, `created_at`, `is_admin`) VALUES
(25, 'jocapro2003', 'jovanspasov003@gmail.com', 'jocapro2003', '2024-03-19 15:07:34', 1),
(39, 'dusan123', 'dusan123@gmail.com', 'dusan123', '2024-03-20 19:48:05', 0);

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
  ADD PRIMARY KEY (`racunar_ID`);

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
  MODIFY `korpa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `racunari`
--
ALTER TABLE `racunari`
  MODIFY `racunar_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `slika_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
