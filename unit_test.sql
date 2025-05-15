-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 04:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unit_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `phone`, `email`, `address`, `photo`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Ahmad  Fauzi', '081234567890', 'ahmad@gmail.com', 'Jl. Merdeka No. 1', 'fotooo14.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 16:09:06', NULL),
(2, 2, 'Dewi Lestari Umbari', '081234567891', 'dewi@gmail.com', 'Jl. Diponegoro No. 2', 'ssss3.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 15:35:07', NULL),
(3, 2, 'Budi Santoso', '081234567892', 'budi@gmail.com', 'Jl. Sudirman No. 3', 'joh1.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:44:20', NULL),
(4, 3, 'Citra Ayu', '081234567893', 'citra@gmail.com', 'Jl. Gatot Subroto No. 4', 'images2.jpg', 0, '2025-05-15 19:38:05', '2025-05-15 14:44:30', NULL),
(5, 1, 'Erik Prasetyo', '081234567894', 'erik@gmail.com', 'Jl. Ahmad Yani No. 5', 'defe1.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:44:38', NULL),
(6, 2, 'Fitriani', '081234567895', 'fitri@gmail.com', 'Jl. Kebon Jeruk No. 6', 'ssss4.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:44:45', NULL),
(7, 3, 'Gilang Ramadhan', '081234567896', 'gilang@gmail.com', 'Jl. Mangga Dua No. 7', 'deded1.jpg', 0, '2025-05-15 19:38:05', '2025-05-15 14:44:54', NULL),
(8, 1, 'Hesti Wulandari', '081234567897', 'hesti@gmail.com', 'Jl. Cempaka Putih No. 8', 'images3.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:45:02', NULL),
(9, 2, 'Iqbal Maulana', '081234567898', 'iqbal@gmail.com', 'Jl. Kemang Raya No. 9', 'fotooo15.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:45:09', NULL),
(10, 3, 'Joko Sutrisno', '081234567899', 'joko@gmail.com', 'Jl. Teuku Umar No. 10', 'defe2.jpg', 1, '2025-05-15 19:38:05', '2025-05-15 14:45:15', NULL),
(32, 3, 'Seli Felicyani', '0879276636333', 'seli@gmial.com', 'Cianjur', 'ssss2.jpg', 0, '2025-05-15 15:13:51', '2025-05-15 14:43:07', NULL),
(40, 1, 'Subroto', '085798513111', 'saepu11130@gmail.com', 'Sirnagalih, Kec.CIlaku', 'fotooo13.jpg', 1, '2025-05-15 17:14:11', '2025-05-15 17:35:57', '2025-05-15 12:35:57'),
(42, 2, 'Barito PUTRA', '085798511111', 'barito@gmail.com', 'Desa.Sirnagalih, Kec.CIlaku\r\n', 'deded2.jpg', 1, '2025-05-15 19:46:15', '2025-05-15 20:06:21', '2025-05-15 15:06:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
