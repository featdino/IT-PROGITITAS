-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 06:02 PM
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
-- Database: `off-radar`
--

-- --------------------------------------------------------

--
-- Table structure for table `attraction`
--

CREATE TABLE `attraction` (
  `attraction_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `total_visits` int(11) NOT NULL,
  `avg_rating` decimal(10,2) NOT NULL DEFAULT 0.00,
  `city_id` int(11) NOT NULL,
  `local_rating` decimal(3,2) DEFAULT 0.00,
  `gem_score` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attraction`
--

INSERT INTO `attraction` (`attraction_id`, `name`, `description`, `street_address`, `total_visits`, `avg_rating`, `city_id`, `local_rating`, `gem_score`) VALUES
(1, 'Rizal Park', 'Historic park with monuments and gardens', 'Ermita, Manila', 12500, 0.00, 1, 0.00, 0.00),
(2, 'Intramuros', 'Historic walled city from Spanish era', 'Intramuros, Manila', 9800, 0.00, 1, 0.00, 0.00),
(3, 'National Museum of Fine Arts', 'Classical and modern Filipino art', 'Padre Burgos Ave, Ermita, Manila', 7200, 0.00, 1, 0.00, 0.00),
(4, 'San Agustin Church', 'Baroque UNESCO world heritage church', 'Gen Luna St, Intramuros, Manila', 5600, 0.00, 1, 0.00, 0.00),
(5, 'Manila Ocean Park', 'Marine park with oceanarium and shows', 'Ermita, Manila', 8901, 0.00, 1, 0.00, 0.00),
(6, 'Fort Santiago', 'Citadel inside Intramuros', 'Santa Clara St, Intramuros, Manila', 6700, 0.00, 1, 0.00, 0.00),
(7, 'Binondo Church', 'Historic church in Chinatown', 'Binondo, Manila', 4300, 0.00, 1, 0.00, 0.00),
(8, 'Manila Baywalk', 'Scenic baywalk with sunset views', 'Roxas Blvd, Manila', 10400, 0.00, 1, 0.00, 0.00),
(9, 'Casa Manila', 'Colonial lifestyle museum', 'Plaza San Luis Complex, Intramuros', 3900, 0.00, 1, 0.00, 0.00),
(10, 'San Sebastian Church', 'All-steel Gothic church', 'Pasaje del Carmen, Manila', 3100, 0.00, 1, 0.00, 0.00),
(11, 'Burnham Park', 'Central park with lake and gardens', 'Burnham Park, Baguio', 11000, 0.00, 11, 0.00, 0.00),
(12, 'Mines View Park', 'Scenic overlook of former gold mines', 'Dominican Hill, Baguio', 9300, 0.00, 11, 0.00, 0.00),
(13, 'Baguio Cathedral', 'Iconic church with twin spires', 'Cathedral Loop, Baguio', 6700, 0.00, 11, 0.00, 0.00),
(14, 'Camp John Hay', 'Former US base turned recreation area', 'Camp John Hay, Baguio', 7800, 0.00, 11, 0.00, 0.00),
(15, 'Session Road', 'Famous commercial and cultural hub', 'Session Road, Baguio', 5400, 0.00, 11, 0.00, 0.00),
(16, 'Botanical Garden', 'Gardens with indigenous huts', 'Leonard Wood Rd, Baguio', 6200, 0.00, 11, 0.00, 0.00),
(17, 'The Mansion', 'Official summer palace of Philippine president', 'Leonard Wood Rd, Baguio', 4900, 0.00, 11, 0.00, 0.00),
(18, 'Wright Park', 'Park with horseback riding', 'Wright Park, Baguio', 4400, 0.00, 11, 0.00, 0.00),
(19, 'Bell Church', 'Taoist temple with dragon gate', 'Bell Church Rd, Baguio', 3700, 0.00, 11, 0.00, 0.00),
(20, 'Tam-Awan Village', 'Artist village with native huts', 'Tam-Awan, Baguio', 2900, 0.00, 11, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `attraction_category`
--

CREATE TABLE `attraction_category` (
  `attraction_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attraction_category`
--

INSERT INTO `attraction_category` (`attraction_id`, `category_id`) VALUES
(1, 10),
(1, 13),
(2, 2),
(2, 4),
(3, 1),
(4, 2),
(4, 3),
(5, 12),
(5, 14),
(6, 2),
(7, 3),
(8, 13),
(9, 1),
(10, 3),
(11, 10),
(11, 13),
(11, 14),
(12, 13),
(13, 3),
(14, 10),
(14, 11),
(15, 7),
(15, 15),
(16, 10),
(16, 13),
(17, 2),
(18, 10),
(19, 3),
(20, 1),
(20, 16);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `main_class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`, `main_class`) VALUES
(1, 'Museums & Galleries', 'Cultural & Historical'),
(2, 'Heritage Sites', 'Cultural & Historical'),
(3, 'Religious Sites', 'Cultural & Historical'),
(4, 'Performing Arts', 'Cultural & Historical'),
(5, 'Cafes & Bistros', 'Gastronomy'),
(6, 'Fine Dining', 'Gastronomy'),
(7, 'Street Food & Markets', 'Gastronomy'),
(8, 'Bars & Nightlife', 'Gastronomy'),
(9, 'Specialty Food', 'Gastronomy'),
(10, 'Parks & Gardens', 'Nature & Outdoors'),
(11, 'Nature Reserves', 'Nature & Outdoors'),
(12, 'Water-based', 'Nature & Outdoors'),
(13, 'Scenic Viewpoints', 'Nature & Outdoors'),
(14, 'Theme Parks', 'Entertainment & Leisure'),
(15, 'Shopping', 'Entertainment & Leisure'),
(16, 'Workshops', 'Entertainment & Leisure'),
(17, 'Wellness', 'Entertainment & Leisure');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `province`) VALUES
(1, 'Manila', 'Metro Manila'),
(2, 'Quezon City', 'Metro Manila'),
(3, 'Makati', 'Metro Manila'),
(4, 'Taguig', 'Metro Manila'),
(5, 'Pasig', 'Metro Manila'),
(6, 'Parañaque', 'Metro Manila'),
(7, 'Pasay', 'Metro Manila'),
(8, 'Mandaluyong', 'Metro Manila'),
(9, 'Marikina', 'Metro Manila'),
(10, 'Muntinlupa', 'Metro Manila'),
(11, 'Baguio', 'Benguet'),
(12, 'Angeles City', 'Pampanga'),
(13, 'San Fernando', 'Pampanga'),
(14, 'Clark Freeport Zone', 'Pampanga'),
(15, 'Tarlac City', 'Tarlac'),
(16, 'Olongapo', 'Zambales'),
(17, 'Batangas City', 'Batangas'),
(18, 'Lipa', 'Batangas'),
(19, 'Calamba', 'Laguna'),
(20, 'Santa Rosa', 'Laguna'),
(21, 'Biñan', 'Laguna'),
(22, 'Cabuyao', 'Laguna'),
(23, 'San Pablo', 'Laguna'),
(24, 'Lucena', 'Quezon'),
(25, 'Antipolo', 'Rizal'),
(26, 'Cainta', 'Rizal'),
(27, 'Naga', 'Camarines Sur'),
(28, 'Legazpi', 'Albany'),
(29, 'Daet', 'Camarines Norte'),
(30, 'Vigan', 'Ilocos Sur'),
(31, 'Laoag', 'Ilocos Norte'),
(32, 'San Jose', 'Mindoro Occidental'),
(33, 'Calapan', 'Mindoro Oriental'),
(34, 'Puerto Princesa', 'Palawan'),
(35, 'Cebu City', 'Cebu'),
(36, 'Mandaue', 'Cebu'),
(37, 'Lapu-Lapu City', 'Cebu'),
(38, 'Bacolod', 'Negros Occidental'),
(39, 'Iloilo City', 'Iloilo'),
(40, 'Tacloban', 'Leyte'),
(41, 'Ormoc', 'Leyte'),
(42, 'Tagbilaran', 'Bohol'),
(43, 'Dumaguete', 'Negros Oriental'),
(44, 'Roxas City', 'Capiz'),
(45, 'Kalibo', 'Aklan'),
(46, 'Davao City', 'Davao del Sur'),
(47, 'Zamboanga City', 'Zamboanga del Sur'),
(48, 'Cagayan de Oro', 'Misamis Oriental'),
(49, 'General Santos', 'South Cotabato'),
(50, 'Butuan', 'Agusan del Norte'),
(51, 'Cotabato City', 'Maguindanao'),
(52, 'Marawi', 'Lanao del Sur'),
(53, 'Tagum', 'Davao del Norte'),
(54, 'Pagadian', 'Zamboanga del Sur'),
(55, 'Surigao City', 'Surigao del Norte'),
(56, 'Outside Philippines', 'International');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `image_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_official` tinyint(1) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `attraction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`image_id`, `image_url`, `is_official`, `upload_date`, `attraction_id`, `user_id`) VALUES
(1, 'images/Baguio-Cathedral-2.jpg', 1, '2026-04-10 16:08:49', 13, 51),
(2, 'images/Baguio-Cathedral-3.webp', 1, '2026-04-10 16:08:49', 13, 51),
(3, 'images/Baguio-Cathedral-4.jpg', 1, '2026-04-10 16:08:49', 13, 51),
(4, 'images/Baguio-Cathedral-5jpg.jpg', 1, '2026-04-10 16:08:49', 13, 51),
(5, 'images/baywalk-1.jpg', 1, '2026-04-10 16:08:49', 8, 51),
(6, 'images/baywalk-2.jpg', 1, '2026-04-10 16:08:49', 8, 51),
(7, 'images/baywalk-3.webp', 1, '2026-04-10 16:08:49', 8, 51),
(8, 'images/baywalk-4.avif', 1, '2026-04-10 16:08:49', 8, 51),
(9, 'images/baywalk-5.jpg', 1, '2026-04-10 16:08:49', 8, 51),
(10, 'images/bell-church-1.jpg', 1, '2026-04-10 16:08:49', 19, 51),
(11, 'images/bell-church-2.jpg', 1, '2026-04-10 16:08:49', 19, 51),
(12, 'images/bell-church-3.webp', 1, '2026-04-10 16:08:49', 19, 51),
(13, 'images/bell-church-4.jpg', 1, '2026-04-10 16:08:49', 19, 51),
(14, 'images/bell-church-5.jpg', 1, '2026-04-10 16:08:49', 19, 51),
(15, 'images/binondo-church-1.jpg', 1, '2026-04-10 16:08:49', 7, 51),
(16, 'images/binondo-church-2.jpg', 1, '2026-04-10 16:08:49', 7, 51),
(17, 'images/binondo-church-3.jpg', 1, '2026-04-10 16:08:49', 7, 51),
(18, 'images/binondo-church-4.jpg', 1, '2026-04-10 16:08:49', 7, 51),
(19, 'images/binondo-church-5.jpg', 1, '2026-04-10 16:08:49', 7, 51),
(20, 'images/botanical-garden-1.jpg', 1, '2026-04-10 16:08:50', 16, 51),
(21, 'images/botanical-garden-2.jpg', 1, '2026-04-10 16:08:50', 16, 51),
(22, 'images/botanical-garden-3.jpg', 1, '2026-04-10 16:08:50', 16, 51),
(23, 'images/botanical-garden-4.jpg', 1, '2026-04-10 16:08:50', 16, 51),
(24, 'images/botanical-garden-5.jpg', 1, '2026-04-10 16:08:50', 16, 51),
(25, 'images/burnham-park-1.jpg', 1, '2026-04-10 16:08:50', 11, 51),
(26, 'images/burnham-park-2.jpg', 1, '2026-04-10 16:08:50', 11, 51),
(27, 'images/burnham-park-3.jpg', 1, '2026-04-10 16:08:50', 11, 51),
(28, 'images/burnham-park-4.jpg', 1, '2026-04-10 16:08:50', 11, 51),
(29, 'images/burnham-park-5.jpg', 1, '2026-04-10 16:08:50', 11, 51),
(30, 'images/camp-john-hay-1.webp', 1, '2026-04-10 16:08:50', 14, 51),
(31, 'images/camp-john-hay-2.webp', 1, '2026-04-10 16:08:50', 14, 51),
(32, 'images/camp-john-hay-3.jpg', 1, '2026-04-10 16:08:50', 14, 51),
(33, 'images/camp-john-hay-4.jpg', 1, '2026-04-10 16:08:50', 14, 51),
(34, 'images/camp-john-hay-5.webp', 1, '2026-04-10 16:08:50', 14, 51),
(35, 'images/casa-manila-1.jpg', 1, '2026-04-10 16:08:50', 9, 51),
(36, 'images/casa-manila-2.jpg', 1, '2026-04-10 16:08:50', 9, 51),
(37, 'images/casa-manila-3.jpg', 1, '2026-04-10 16:08:50', 9, 51),
(38, 'images/casa-manila-4.webp', 1, '2026-04-10 16:08:50', 9, 51),
(39, 'images/casa-manila-5.jpg', 1, '2026-04-10 16:08:50', 9, 51),
(40, 'images/fort-santiago-1.jpg', 1, '2026-04-10 16:08:50', 6, 51),
(41, 'images/fort-santiago-2.jpg', 1, '2026-04-10 16:08:50', 6, 51),
(42, 'images/fort-santiago-3.webp', 1, '2026-04-10 16:08:50', 6, 51),
(43, 'images/fort-santiago-4.jpg', 1, '2026-04-10 16:08:50', 6, 51),
(44, 'images/fort-santiago-5.jpg', 1, '2026-04-10 16:08:50', 6, 51),
(45, 'images/home-hero.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(46, 'images/home-mg-1.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(47, 'images/home-mg-2.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(48, 'images/home-mg-3.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(49, 'images/home-mg-4.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(50, 'images/home-mg-5.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(51, 'images/home-mg-6.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(52, 'images/home-mg-7.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(53, 'images/home-mg-8.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(54, 'images/intramuros-1.jpg', 1, '2026-04-10 16:08:50', 2, 51),
(55, 'images/intramuros-2.jpg', 1, '2026-04-10 16:08:50', 2, 51),
(56, 'images/intramuros-3.jpg', 1, '2026-04-10 16:08:50', 2, 51),
(57, 'images/intramuros-4.png', 1, '2026-04-10 16:08:50', 2, 51),
(58, 'images/intramuros-5.jpg', 1, '2026-04-10 16:08:50', 2, 51),
(59, 'images/mines-view-2.jpg', 1, '2026-04-10 16:08:50', 12, 51),
(60, 'images/mines-view-3.jpg', 1, '2026-04-10 16:08:50', 12, 51),
(61, 'images/mines-view-4.jpg', 1, '2026-04-10 16:08:50', 12, 51),
(62, 'images/mines-view-5.png', 1, '2026-04-10 16:08:50', 12, 51),
(63, 'images/Rizal-Park-2.webp', 1, '2026-04-10 16:08:50', 1, 51),
(64, 'images/Rizal-Park-3.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(65, 'images/Rizal-Park-4.jpg', 1, '2026-04-10 16:08:50', 1, 51),
(66, 'images/Rizal-Park-5.webp', 1, '2026-04-10 16:08:50', 1, 51),
(67, 'images/san-agustin-1.jpg', 1, '2026-04-10 16:08:50', 4, 51),
(68, 'images/san-agustin-2.jpg', 1, '2026-04-10 16:08:50', 4, 51),
(69, 'images/san-agustin-3.jpg', 1, '2026-04-10 16:08:50', 4, 51),
(70, 'images/san-agustin-4.webp', 1, '2026-04-10 16:08:50', 4, 51),
(71, 'images/san-agustin-5.jpg', 1, '2026-04-10 16:08:50', 4, 51),
(72, 'images/san-sebastian-church-1.jpg', 1, '2026-04-10 16:08:50', 10, 51),
(73, 'images/san-sebastian-church-2.jpg', 1, '2026-04-10 16:08:50', 10, 51),
(74, 'images/san-sebastian-church-3.jpg', 1, '2026-04-10 16:08:50', 10, 51),
(75, 'images/san-sebastian-church-4.jpg', 1, '2026-04-10 16:08:50', 10, 51),
(76, 'images/session-road-1.jpg', 1, '2026-04-10 16:08:50', 15, 51),
(77, 'images/session-road-2.webp', 1, '2026-04-10 16:08:50', 15, 51),
(78, 'images/session-road-3.webp', 1, '2026-04-10 16:08:50', 15, 51),
(79, 'images/session-road-4.jpg', 1, '2026-04-10 16:08:50', 15, 51),
(80, 'images/session-road-5.jpg', 1, '2026-04-10 16:08:50', 15, 51),
(81, 'images/tam-awan-1.jpg', 1, '2026-04-10 16:08:50', 20, 51),
(82, 'images/tam-awan-2.jpg', 1, '2026-04-10 16:08:50', 20, 51),
(83, 'images/tam-awan-3.webp', 1, '2026-04-10 16:08:50', 20, 51),
(84, 'images/tam-awan-4.jpg', 1, '2026-04-10 16:08:50', 20, 51),
(85, 'images/tam-awan-5.jpg', 1, '2026-04-10 16:08:50', 20, 51),
(86, 'images/the-mansion-1.jpeg', 1, '2026-04-10 16:08:50', 17, 51),
(87, 'images/the-mansion-2.webp', 1, '2026-04-10 16:08:50', 17, 51),
(88, 'images/the-mansion-3.jpeg', 1, '2026-04-10 16:08:50', 17, 51),
(89, 'images/the-mansion-4.jpeg', 1, '2026-04-10 16:08:50', 17, 51),
(90, 'images/the-mansion-5.jpeg', 1, '2026-04-10 16:08:50', 17, 51),
(91, 'images/wright-park-1.jpg', 1, '2026-04-10 16:08:50', 18, 51),
(92, 'images/wright-park-2.jpg', 1, '2026-04-10 16:08:50', 18, 51),
(93, 'images/wright-park-3.jpg', 1, '2026-04-10 16:08:50', 18, 51),
(94, 'images/wright-park-4.jpg', 1, '2026-04-10 16:08:50', 18, 51),
(95, 'images/wright-park-5.jpg', 1, '2026-04-10 16:08:50', 18, 51);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `attraction_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `city_id` int(11) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `email`, `city_id`, `role`) VALUES
(1, 'Juan Dela Cruz', 'juandelacruz', '$2y$10$LMw5WJclE.vIcpsvxPL73.bvgpPj4O9Tgx5eYc17VA/Sz1WKsnpXm', 'juandelacruz@email.com', 1, 'user'),
(2, 'Maria Santos', 'mariasantos', '$2y$10$rvE9MXpkY1TQaD7VCWgCieTUy4X7mHeea.hrap.yVk7pQhJ2u4yCm', 'mariasantos@email.com', 1, 'user'),
(3, 'Jose Rizal', 'joserizal', '$2y$10$oAH1qB2FZMv8qLx98pLLQeTrOtAhVRyHA.lYf2LXY2tmRAh54LzDW', 'joserizal@email.com', 1, 'user'),
(4, 'Andres Bonifacio', 'andresbonifacio', '$2y$10$lp1EO3U6o53DA1p6b9cyvu8Mxao.NLdSlvwJAI5vOGbl94.oOgHvm', 'andresbonifacio@email.com', 1, 'user'),
(5, 'Antonio Luna', 'antonioluna', '$2y$10$44/w.ISguOQhqty3j5pAMOAEFcq.Dv47GkBZ3L9ptoqXo5z9uh/qm', 'antonioluna@email.com', 2, 'user'),
(6, 'Gabriela Silang', 'gabrielasilang', '$2y$10$vWktEhB3ECvnJD6BULKuj.Ev6vLEU1BFG5rgl4/XST4UbERdFunQO', 'gabrielasilang@email.com', 2, 'user'),
(7, 'Emilio Aguinaldo', 'emilioaguinaldo', '$2y$10$SW3PdmgrNlCnuV8/wA2iQu91QkI1urYmfQ8pwAZVxyo7VemGF3OpC', 'emilioaguinaldo@email.com', 2, 'user'),
(8, 'Manny Pacquiao', 'mannypacquiao', '$2y$10$Eefv8cuJWGcUOL0qgNDU6O6ahGjij5OUkh8a.oIFNXveImrba71g2', 'mannypacquiao@email.com', 3, 'user'),
(9, 'Lea Salonga', 'leasalonga', '$2y$10$4fbxl8CVSQU53z7a/ga56ezCR3.k8X6R0Y2Ukc8BfMwm9tetNj80m', 'leasalonga@email.com', 3, 'user'),
(10, 'Catriona Gray', 'catrionagray', '$2y$10$8sHFalIB92Vzxd4qOTQxLOd4OAJIBm95Q0ehtI6MWcDHxufwjU7c2', 'catrionagray@email.com', 3, 'user'),
(11, 'Grace Poe', 'gracepoe', '$2y$10$w497gGXBVfQKZYezi6M4IOrtHEU0pdwiTpRIadvqEDZbxF9TiubkO', 'gracepoe@email.com', 11, 'user'),
(12, 'Bong Go', 'bonggo', '$2y$10$BJKGDU8MbJMBskAe6tbwSesW6RxoqR43yGP/Kah11WVXWoQItRySq', 'bonggo@email.com', 11, 'user'),
(13, 'Robin Padilla', 'robinpadilla', '$2y$10$mKFOLmDG6MhSFPDENwp2BeEpgLgByggxDf/Q4f7R3m9dsiN7Azq5C', 'robinpadilla@email.com', 11, 'user'),
(14, 'Lapu-Lapu', 'lapulapu', '$2y$10$/upuWXJqhqZr2D9z2Wb3nutqZatS9PSsjfHtw7UJyADjiSdWn.t.e', 'lapulapu@email.com', 36, 'user'),
(15, 'Gwen Garcia', 'gwengarcia', '$2y$10$5wxuT7PddnEKm1dkGdEmX.nsqBiGUIF6V23aFgyw84n/XEiSqoENm', 'gwengarcia@email.com', 36, 'user'),
(16, 'Michael Rama', 'michaelrama', '$2y$10$8D5X.3Voqvxv46fsXKL3ieYgxTdaEfaGrT/4pNE0j.FWn0cLtnI2.', 'michaelrama@email.com', 36, 'user'),
(17, 'Rodrigo Duterte', 'rodrigoduterte', '$2y$10$KdVHs72RSwfPV0QkLrRGRu4rzv5UZWyZ5RDPsklYI4UZi5IM1Qbmi', 'rodrigoduterte@email.com', 47, 'user'),
(18, 'Sara Duterte', 'saraduterte', '$2y$10$jEmAW96Q10LrwmQg1BYWwOFCEOK5vHsJitvuWRXtlW6bmbfPxaXpq', 'saraduterte@email.com', 47, 'user'),
(19, 'Paolo Duterte', 'paoloduterte', '$2y$10$XvJtwnBPEpqAeknrejIFA.uIqNVH.uuJjtNG1QMR.BpzmxaowE57O', 'paoloduterte@email.com', 47, 'user'),
(20, 'Katherine Bernardo', 'katherinebernardo', '$2y$10$yKeHbVRB40PcOMMEXhwyEeQPXaAaa9zu5RGcgP4IyTroPEneCoJga', 'katherinebernardo@email.c', 5, 'user'),
(21, 'Alden Richards', 'aldenrichards', '$2y$10$hMbbPNMV8GY59jEYXybtSOkJeI2RvKUOuiG9I7/nagZeIfkezqr.G', 'aldenrichards@email.com', 5, 'user'),
(22, 'Maine Mendoza', 'mainemendoza', '$2y$10$TlZeGRxlr0/x9bGF9DN23ORLftfXJEPsI6IcBkrGVdY3awy7/.a.e', 'mainemendoza@email.com', 8, 'user'),
(23, 'Vice Ganda', 'viceganda', '$2y$10$JEuYImQrfFmmZe5mfjmaOuUMAxRxJvRy3Em/nQld2mLIz3UmvUciW', 'viceganda@email.com', 2, 'user'),
(24, 'Anne Curtis', 'annecurtis', '$2y$10$nxZrvo6faSwop9J1pFYkBe0rfgpsLCIaM28ah0D.BCQtymE/.lpT.', 'annecurtis@email.com', 3, 'user'),
(25, 'Marlon Villar', 'marlonvillar', '$2y$10$PCSwPKbLvTQRg0HVYg8z1eepccb154qESuVRBrk2U6UcP0L1kmRpK', 'marlonvillar@email.com', 15, 'user'),
(26, 'Cynthia Villar', 'cynthiavillar', '$2y$10$NiPy0StLgXxCViTjP.AZJODzEfTeU3PIAj0x3hkzfObAQL4qRsN66', 'cynthiavillar@email.com', 15, 'user'),
(27, 'Chiz Escudero', 'chizescudero', '$2y$10$D4XQS/paHxjCinFgDvkT/eq9E7OBXRY2TAw/Zsc7I2D5UFB08389q', 'chizescudero@email.com', 20, 'user'),
(28, 'Pia Cayetano', 'piacayetano', '$2y$10$IKq5T.2EKuMZYhNooaZzCevFRSUrpc3mKyH3UEC2Qa1.fihLCHEIm', 'piacayetano@email.com', 4, 'user'),
(29, 'Alan Cayetano', 'alancayetano', '$2y$10$9iN4SwvIygzmNPEHZ4LdWuY.EF3K76b3Ju/OICeKg6SHl8O.4oEAO', 'alancayetano@email.com', 4, 'user'),
(30, 'Lito Lapid', 'litolapid', '$2y$10$PGpXsIbaOK26sOlI8o18uu/ohHc5aJLkSLpVovZVhw8r/rArB.Vtm', 'litolapid@email.com', 19, 'user'),
(31, 'Bato dela Rosa', 'batodelarosa', '$2y$10$1vuqtzOjWDg4AXK2Qu5QLufHPTa8.qLzNkvc47NL7cfbmEZVhtp6S', 'batodelarosa@email.com', 11, 'user'),
(32, 'Christopher Go', 'christophergo', '$2y$10$5crlvWkfhLpFVDcExQ5ppuOHLLgqS53CqsWqpQc2k4d8Cnx.jePdS', 'christophergo@email.com', 11, 'user'),
(33, 'Isko Moreno', 'iskomoreno', '$2y$10$zbtr7Ty71Q8rNlQr6g77Uunuhai9/GsLHqLVfHGcqZhZUY24VlcXK', 'iskomoreno@email.com', 1, 'user'),
(34, 'Vico Sotto', 'vicosotto', '$2y$10$XYoSWAbRcREWMnHnAqgDVOvN.wbMImymJ2VPJF5cgUyBNhxsRrPES', 'vicosotto@email.com', 5, 'user'),
(35, 'Joy Belmonte', 'joybelmonte', '$2y$10$b/glR.PKT6T27U3lMPJcneNJdJsfn6zePEUe.o4/KLAqIy51FWoyq', 'joybelmonte@email.com', 2, 'user'),
(36, 'Honey Lacuna', 'honeylacuna', '$2y$10$IoMGKjqomRv7iFVJ3xvhA.qYA4e3n3SPaitP6HaLMxxEx3b3Jx80u', 'honeylacuna@email.com', 1, 'user'),
(37, 'Abby Binay', 'abbybinay', '$2y$10$WpL7ejvxfOAUI6H3j3fhUuBLuIVvn4Yws46u.NYeewD5PD8xTelqW', 'abbybinay@email.com', 3, 'user'),
(38, 'Inday Sara', 'indaysara', '$2y$10$SvxMMBH1msaa5aqtVNisT.h6DGH5j1akrCX64cd1xnNezULuP0sai', 'indaysara@email.com', 47, 'user'),
(39, 'Sebastian Duterte', 'sebastianduterte', '$2y$10$t1X6Z7YptuWcaqvqJV462OEHvbiX5NOtVzMUMrUpf0NcaF1llxB1C', 'sebastianduterte@email.co', 47, 'user'),
(40, 'Ramon Ang', 'ramonang', '$2y$10$nGmA9IE.enONjdRLy9.FcelpqNzKrWfEFgiddD.k5Lq.w2p5z6yzW', 'ramonang@email.com', 5, 'user'),
(41, 'Tony Tan Caktiong', 'tonytan', '$2y$10$DKEyop4uPplBdPfGDo22LeVuGrCHPzqNJtl.xJW8aI3iUtBbV.ucK', 'tonytan@email.com', 37, 'user'),
(42, 'Henry Sy Jr.', 'henrysyjr', '$2y$10$48GI776M44txx.YzaLRPs.HTAgsk0p6WU9SdIMHZ8B4JhuQphMPfO', 'henrysyjr@email.com', 3, 'user'),
(43, 'John Gokongwei', 'johngokongwei', '$2y$10$oFGopSIXpGLMgi5Z3Wh28O6dvXViwkACWiw6rZxmlm5uHjR/mxY/6', 'johngokongwei@email.com', 2, 'user'),
(44, 'Lucio Tan', 'luciotan', '$2y$10$vCcheu0pgUjqi2VkrZhoxusMIoJvyd5CazpzjRPRHAJ2L6XdGumvC', 'luciotan@email.com', 1, 'user'),
(45, 'Andrew Tan', 'andrewtan', '$2y$10$Q/oeYd6PbnsqZr2eyL3esen71Mv1XbceOH89GoSlB.mBqWtxXG3y2', 'andrewtan@email.com', 3, 'user'),
(46, 'Manuel Pangilinan', 'manuelpangilinan', '$2y$10$/Mn1l3BN31uY2GXMPw8UXuavieaXS5BxpBIwFHo4XVKZHqEpXjMIe', 'manuelpangilinan@email.co', 2, 'user'),
(47, 'Jaime Zobel', 'jaimezobel', '$2y$10$XdYbkl7450ZNkHKytJFoe.q7x0QVU9TwjkbteeHBtqlE9PNC2OQ0q', 'jaimezobel@email.com', 3, 'user'),
(48, 'Enrique Razon', 'enriquerazon', '$2y$10$0cX0QRHHKpCcM6Ok5XIn/.9Qstj89pjbNB1S.fs7bqDuwnXJDKnE.', 'enriquerazon@email.com', 1, 'user'),
(49, 'Dennis Uy', 'dennisuy', '$2y$10$CHWmeXH6.kNYM5MsO6q4ku3pJI0fo1EehTAfX1NDvge2MA1qAYN/2', 'dennisuy@email.com', 47, 'user'),
(50, 'Manny Villar', 'mannyvillar', '$2y$10$tpDifVztzBCVP20kGYFcQuEqDCqisqEE48wnMZJj7JeITVrw7Y.bq', 'mannyvillar@email.com', 15, 'user'),
(51, 'admin', 'admin', '$2y$10$cywT2Ndy1ERy.rA..ty3XuaWy9513XP4tLrhJCzUW0hB6pr5EJblG', 'admin@gmail.com', 1, 'admin'),
(53, 'Faith Francisco', 'faithtravels', '$2y$10$qe5vDIA9N.CF75zHwGukU.uQUKOrnu51P4JSogzofleqIsw4BsQQS', 'faith.francisco2006@gmail', 1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`user_id`, `attraction_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 6),
(2, 7),
(2, 8),
(3, 2),
(3, 4),
(3, 6),
(4, 2),
(4, 4),
(4, 6),
(5, 1),
(5, 3),
(5, 5),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(7, 1),
(7, 11),
(7, 15),
(8, 1),
(8, 6),
(8, 11),
(9, 3),
(9, 4),
(9, 7),
(9, 13),
(10, 5),
(10, 12),
(10, 16),
(11, 11),
(11, 14),
(11, 17),
(11, 18),
(12, 2),
(12, 8),
(12, 15),
(12, 19),
(13, 4),
(13, 8),
(13, 13),
(13, 19),
(14, 1),
(14, 11),
(14, 20),
(15, 3),
(15, 6),
(15, 9),
(15, 16),
(16, 1),
(16, 6),
(16, 11),
(16, 18),
(17, 5),
(17, 12),
(17, 20),
(18, 2),
(18, 7),
(18, 14),
(19, 4),
(19, 9),
(19, 15),
(20, 1),
(20, 10),
(20, 13),
(21, 6),
(21, 11),
(21, 16),
(22, 3),
(22, 8),
(22, 17),
(23, 2),
(23, 5),
(23, 12),
(24, 1),
(24, 7),
(24, 14),
(25, 4),
(25, 9),
(25, 18),
(26, 6),
(26, 10),
(26, 19),
(27, 3),
(27, 11),
(27, 20),
(28, 2),
(28, 8),
(28, 15),
(29, 5),
(29, 12),
(29, 16),
(30, 1),
(30, 9),
(30, 17),
(31, 7),
(31, 13),
(31, 18),
(32, 4),
(32, 10),
(32, 19),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(33, 5),
(34, 6),
(34, 11),
(34, 16),
(35, 2),
(35, 7),
(35, 12),
(36, 1),
(36, 4),
(36, 8),
(37, 3),
(37, 9),
(37, 14),
(38, 5),
(38, 10),
(38, 15),
(39, 2),
(39, 11),
(39, 20),
(40, 1),
(40, 6),
(40, 13),
(41, 7),
(41, 12),
(41, 17),
(42, 3),
(42, 8),
(42, 18),
(43, 4),
(43, 9),
(43, 19),
(44, 1),
(44, 5),
(44, 14),
(45, 6),
(45, 10),
(45, 16),
(46, 2),
(46, 11),
(46, 20),
(47, 3),
(47, 7),
(47, 15),
(48, 4),
(48, 8),
(48, 17),
(49, 5),
(49, 9),
(49, 18),
(50, 1),
(50, 6),
(50, 12),
(53, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attraction`
--
ALTER TABLE `attraction`
  ADD PRIMARY KEY (`attraction_id`),
  ADD KEY `attraction_fk1` (`city_id`);

--
-- Indexes for table `attraction_category`
--
ALTER TABLE `attraction_category`
  ADD PRIMARY KEY (`attraction_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `gallery_fk1` (`attraction_id`),
  ADD KEY `gallery_fk2` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`attraction_id`),
  ADD UNIQUE KEY `unique_user_attraction` (`user_id`,`attraction_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD UNIQUE KEY `unique_user_visit` (`user_id`,`attraction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attraction`
--
ALTER TABLE `attraction`
  MODIFY `attraction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attraction`
--
ALTER TABLE `attraction`
  ADD CONSTRAINT `attraction_fk1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attraction_category`
--
ALTER TABLE `attraction_category`
  ADD CONSTRAINT `attraction_category_ibfk_1` FOREIGN KEY (`attraction_id`) REFERENCES `attraction` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attraction_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_fk1` FOREIGN KEY (`attraction_id`) REFERENCES `attraction` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_fk2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attraction` (`attraction_id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `visits_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attraction` (`attraction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
