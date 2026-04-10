-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 06:54 PM
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
(1, 'Rizal Park', 'Historic park with monuments and gardens', 'Ermita, Manila', 12500, 4.14, 1, 4.50, 1.85),
(2, 'Intramuros', 'Historic walled city from Spanish era', 'Intramuros, Manila', 9800, 4.47, 1, 4.60, 1.92),
(3, 'National Museum of Fine Arts', 'Classical and modern Filipino art', 'Padre Burgos Ave, Ermita, Manila', 7200, 4.12, 1, 4.20, 1.75),
(4, 'San Agustin Church', 'Baroque UNESCO world heritage church', 'Gen Luna St, Intramuros, Manila', 5600, 4.35, 1, 4.40, 1.85),
(5, 'Manila Ocean Park', 'Marine park with oceanarium and shows', 'Ermita, Manila', 8901, 4.05, 1, 4.10, 1.72),
(6, 'Fort Santiago', 'Citadel inside Intramuros', 'Santa Clara St, Intramuros, Manila', 6700, 4.35, 1, 4.40, 1.82),
(7, 'Binondo Church', 'Historic church in Chinatown', 'Binondo, Manila', 4300, 3.94, 1, 3.90, 1.64),
(8, 'Manila Baywalk', 'Scenic baywalk with sunset views', 'Roxas Blvd, Manila', 10400, 4.59, 1, 4.70, 1.98),
(9, 'Casa Manila', 'Colonial lifestyle museum', 'Plaza San Luis Complex, Intramuros', 3900, 3.82, 1, 3.70, 1.56),
(10, 'San Sebastian Church', 'All-steel Gothic church', 'Pasaje del Carmen, Manila', 3100, 4.06, 1, 4.10, 1.74),
(11, 'Burnham Park', 'Central park with lake and gardens', 'Burnham Park, Baguio', 11000, 4.16, 11, 4.60, 1.89),
(12, 'Mines View Park', 'Scenic overlook of former gold mines', 'Dominican Hill, Baguio', 9300, 4.58, 11, 4.60, 1.91),
(13, 'Baguio Cathedral', 'Iconic church with twin spires', 'Cathedral Loop, Baguio', 6700, 4.08, 11, 4.20, 1.80),
(14, 'Camp John Hay', 'Former US base turned recreation area', 'Camp John Hay, Baguio', 7800, 4.09, 11, 4.60, 1.94),
(15, 'Session Road', 'Famous commercial and cultural hub', 'Session Road, Baguio', 5400, 3.92, 11, 4.00, 1.70),
(16, 'Botanical Garden', 'Gardens with indigenous huts', 'Leonard Wood Rd, Baguio', 6200, 4.08, 11, 4.20, 1.77),
(17, 'The Mansion', 'Official summer palace of Philippine president', 'Leonard Wood Rd, Baguio', 4900, 4.00, 11, 4.00, 1.72),
(18, 'Wright Park', 'Park with horseback riding', 'Wright Park, Baguio', 4400, 4.17, 11, 4.20, 1.80),
(19, 'Bell Church', 'Taoist temple with dragon gate', 'Bell Church Rd, Baguio', 3700, 4.00, 11, 4.00, 1.80),
(20, 'Tam-Awan Village', 'Artist village with native huts', 'Tam-Awan, Baguio', 2900, 4.08, 11, 4.20, 1.78);

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
(1, 'images/Baguio-Cathedral-2.jpg', 1, '2026-04-10 08:08:49', 13, 51),
(2, 'images/Baguio-Cathedral-3.webp', 1, '2026-04-10 08:08:49', 13, 51),
(3, 'images/Baguio-Cathedral-4.jpg', 1, '2026-04-10 08:08:49', 13, 51),
(4, 'images/Baguio-Cathedral-5jpg.jpg', 1, '2026-04-10 08:08:49', 13, 51),
(5, 'images/baywalk-1.jpg', 1, '2026-04-10 08:08:49', 8, 51),
(6, 'images/baywalk-2.jpg', 1, '2026-04-10 08:08:49', 8, 51),
(7, 'images/baywalk-3.webp', 1, '2026-04-10 08:08:49', 8, 51),
(8, 'images/baywalk-4.avif', 1, '2026-04-10 08:08:49', 8, 51),
(9, 'images/baywalk-5.jpg', 1, '2026-04-10 08:08:49', 8, 51),
(10, 'images/bell-church-1.jpg', 1, '2026-04-10 08:08:49', 19, 51),
(11, 'images/bell-church-2.jpg', 1, '2026-04-10 08:08:49', 19, 51),
(12, 'images/bell-church-3.webp', 1, '2026-04-10 08:08:49', 19, 51),
(13, 'images/bell-church-4.jpg', 1, '2026-04-10 08:08:49', 19, 51),
(14, 'images/bell-church-5.jpg', 1, '2026-04-10 08:08:49', 19, 51),
(15, 'images/binondo-church-1.jpg', 1, '2026-04-10 08:08:49', 7, 51),
(16, 'images/binondo-church-2.jpg', 1, '2026-04-10 08:08:49', 7, 51),
(17, 'images/binondo-church-3.jpg', 1, '2026-04-10 08:08:49', 7, 51),
(18, 'images/binondo-church-4.jpg', 1, '2026-04-10 08:08:49', 7, 51),
(19, 'images/binondo-church-5.jpg', 1, '2026-04-10 08:08:49', 7, 51),
(20, 'images/botanical-garden-1.jpg', 1, '2026-04-10 08:08:50', 16, 51),
(21, 'images/botanical-garden-2.jpg', 1, '2026-04-10 08:08:50', 16, 51),
(22, 'images/botanical-garden-3.jpg', 1, '2026-04-10 08:08:50', 16, 51),
(23, 'images/botanical-garden-4.jpg', 1, '2026-04-10 08:08:50', 16, 51),
(24, 'images/botanical-garden-5.jpg', 1, '2026-04-10 08:08:50', 16, 51),
(25, 'images/burnham-park-1.jpg', 1, '2026-04-10 08:08:50', 11, 51),
(26, 'images/burnham-park-2.jpg', 1, '2026-04-10 08:08:50', 11, 51),
(27, 'images/burnham-park-3.jpg', 1, '2026-04-10 08:08:50', 11, 51),
(28, 'images/burnham-park-4.jpg', 1, '2026-04-10 08:08:50', 11, 51),
(29, 'images/burnham-park-5.jpg', 1, '2026-04-10 08:08:50', 11, 51),
(30, 'images/camp-john-hay-1.webp', 1, '2026-04-10 08:08:50', 14, 51),
(31, 'images/camp-john-hay-2.webp', 1, '2026-04-10 08:08:50', 14, 51),
(32, 'images/camp-john-hay-3.jpg', 1, '2026-04-10 08:08:50', 14, 51),
(33, 'images/camp-john-hay-4.jpg', 1, '2026-04-10 08:08:50', 14, 51),
(34, 'images/camp-john-hay-5.webp', 1, '2026-04-10 08:08:50', 14, 51),
(35, 'images/casa-manila-1.jpg', 1, '2026-04-10 08:08:50', 9, 51),
(36, 'images/casa-manila-2.jpg', 1, '2026-04-10 08:08:50', 9, 51),
(37, 'images/casa-manila-3.jpg', 1, '2026-04-10 08:08:50', 9, 51),
(38, 'images/casa-manila-4.webp', 1, '2026-04-10 08:08:50', 9, 51),
(39, 'images/casa-manila-5.jpg', 1, '2026-04-10 08:08:50', 9, 51),
(40, 'images/fort-santiago-1.jpg', 1, '2026-04-10 08:08:50', 6, 51),
(41, 'images/fort-santiago-2.jpg', 1, '2026-04-10 08:08:50', 6, 51),
(42, 'images/fort-santiago-3.webp', 1, '2026-04-10 08:08:50', 6, 51),
(43, 'images/fort-santiago-4.jpg', 1, '2026-04-10 08:08:50', 6, 51),
(44, 'images/fort-santiago-5.jpg', 1, '2026-04-10 08:08:50', 6, 51),
(45, 'images/home-hero.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(46, 'images/home-mg-1.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(47, 'images/home-mg-2.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(48, 'images/home-mg-3.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(49, 'images/home-mg-4.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(50, 'images/home-mg-5.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(51, 'images/home-mg-6.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(52, 'images/home-mg-7.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(53, 'images/home-mg-8.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(54, 'images/intramuros-1.jpg', 1, '2026-04-10 08:08:50', 2, 51),
(55, 'images/intramuros-2.jpg', 1, '2026-04-10 08:08:50', 2, 51),
(56, 'images/intramuros-3.jpg', 1, '2026-04-10 08:08:50', 2, 51),
(57, 'images/intramuros-4.png', 1, '2026-04-10 08:08:50', 2, 51),
(58, 'images/intramuros-5.jpg', 1, '2026-04-10 08:08:50', 2, 51),
(59, 'images/mines-view-2.jpg', 1, '2026-04-10 08:08:50', 12, 51),
(60, 'images/mines-view-3.jpg', 1, '2026-04-10 08:08:50', 12, 51),
(61, 'images/mines-view-4.jpg', 1, '2026-04-10 08:08:50', 12, 51),
(62, 'images/mines-view-5.png', 1, '2026-04-10 08:08:50', 12, 51),
(63, 'images/Rizal-Park-2.webp', 1, '2026-04-10 08:08:50', 1, 51),
(64, 'images/Rizal-Park-3.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(65, 'images/Rizal-Park-4.jpg', 1, '2026-04-10 08:08:50', 1, 51),
(66, 'images/Rizal-Park-5.webp', 1, '2026-04-10 08:08:50', 1, 51),
(67, 'images/san-agustin-1.jpg', 1, '2026-04-10 08:08:50', 4, 51),
(68, 'images/san-agustin-2.jpg', 1, '2026-04-10 08:08:50', 4, 51),
(69, 'images/san-agustin-3.jpg', 1, '2026-04-10 08:08:50', 4, 51),
(70, 'images/san-agustin-4.webp', 1, '2026-04-10 08:08:50', 4, 51),
(71, 'images/san-agustin-5.jpg', 1, '2026-04-10 08:08:50', 4, 51),
(72, 'images/san-sebastian-church-1.jpg', 1, '2026-04-10 08:08:50', 10, 51),
(73, 'images/san-sebastian-church-2.jpg', 1, '2026-04-10 08:08:50', 10, 51),
(74, 'images/san-sebastian-church-3.jpg', 1, '2026-04-10 08:08:50', 10, 51),
(75, 'images/san-sebastian-church-4.jpg', 1, '2026-04-10 08:08:50', 10, 51),
(76, 'images/session-road-1.jpg', 1, '2026-04-10 08:08:50', 15, 51),
(77, 'images/session-road-2.webp', 1, '2026-04-10 08:08:50', 15, 51),
(78, 'images/session-road-3.webp', 1, '2026-04-10 08:08:50', 15, 51),
(79, 'images/session-road-4.jpg', 1, '2026-04-10 08:08:50', 15, 51),
(80, 'images/session-road-5.jpg', 1, '2026-04-10 08:08:50', 15, 51),
(81, 'images/tam-awan-1.jpg', 1, '2026-04-10 08:08:50', 20, 51),
(82, 'images/tam-awan-2.jpg', 1, '2026-04-10 08:08:50', 20, 51),
(83, 'images/tam-awan-3.webp', 1, '2026-04-10 08:08:50', 20, 51),
(84, 'images/tam-awan-4.jpg', 1, '2026-04-10 08:08:50', 20, 51),
(85, 'images/tam-awan-5.jpg', 1, '2026-04-10 08:08:50', 20, 51),
(86, 'images/the-mansion-1.jpeg', 1, '2026-04-10 08:08:50', 17, 51),
(87, 'images/the-mansion-2.webp', 1, '2026-04-10 08:08:50', 17, 51),
(88, 'images/the-mansion-3.jpeg', 1, '2026-04-10 08:08:50', 17, 51),
(89, 'images/the-mansion-4.jpeg', 1, '2026-04-10 08:08:50', 17, 51),
(90, 'images/the-mansion-5.jpeg', 1, '2026-04-10 08:08:50', 17, 51),
(91, 'images/wright-park-1.jpg', 1, '2026-04-10 08:08:50', 18, 51),
(92, 'images/wright-park-2.jpg', 1, '2026-04-10 08:08:50', 18, 51),
(93, 'images/wright-park-3.jpg', 1, '2026-04-10 08:08:50', 18, 51),
(94, 'images/wright-park-4.jpg', 1, '2026-04-10 08:08:50', 18, 51),
(95, 'images/wright-park-5.jpg', 1, '2026-04-10 08:08:50', 18, 51),
(96, 'images/mop-1.jpg', 1, '2026-04-10 16:54:06', 5, 51),
(97, 'images/mop-2.jpg', 1, '2026-04-10 16:54:06', 5, 51),
(98, 'images/mop-3.jpg', 1, '2026-04-10 16:54:06', 5, 51),
(99, 'images/mop-4.webp', 1, '2026-04-10 16:54:06', 5, 51),
(100, 'images/mop-5.avif', 1, '2026-04-10 16:54:06', 5, 51),
(101, 'images/mop-6.jpg', 1, '2026-04-10 16:54:06', 5, 51),
(102, 'images/mop-vg-1.jpg', 0, '2026-04-10 16:54:06', 5, 12),
(103, 'images/mop-vg-2.jpg', 0, '2026-04-10 16:54:06', 5, 37),
(104, 'images/mop-vg-3.avif', 0, '2026-04-10 16:54:06', 5, 8),
(105, 'images/mop-vg-4.jpg', 0, '2026-04-10 16:54:06', 5, 25),
(106, 'images/mop-vg-5.jpg', 0, '2026-04-10 16:54:06', 5, 44),
(107, 'images/mop-vg-6.png', 0, '2026-04-10 16:54:06', 5, 19),
(108, 'images/mop-vg-7.jpg', 0, '2026-04-10 16:54:06', 5, 3),
(109, 'images/mop-vg-8.png', 0, '2026-04-10 16:54:06', 5, 29),
(110, 'images/mop-vg-9.jpg', 0, '2026-04-10 16:54:06', 5, 46),
(111, 'images/mop-vg-10.png', 0, '2026-04-10 16:54:06', 5, 7),
(112, 'images/mop-vg-11.webp', 0, '2026-04-10 16:54:06', 5, 33),
(113, 'images/mop-vg-12.jpg', 0, '2026-04-10 16:54:06', 5, 21),
(114, 'images/Baguio-Cathedral-1.jpg', 1, '2026-04-10 16:54:06', 13, 51),
(115, 'images/baywalk-1.jpg', 1, '2026-04-10 16:54:06', 8, 51),
(116, 'images/bell-church-1.jpg', 1, '2026-04-10 16:54:06', 19, 51),
(117, 'images/binondo-church-1.jpg', 1, '2026-04-10 16:54:06', 7, 51),
(118, 'images/botanical-garden-1.jpg', 1, '2026-04-10 16:54:06', 16, 51),
(119, 'images/burnham-park-1.jpg', 1, '2026-04-10 16:54:06', 11, 51),
(120, 'images/camp-john-hay-1.webp', 1, '2026-04-10 16:54:06', 14, 51),
(121, 'images/casa-manila-1.jpg', 1, '2026-04-10 16:54:06', 9, 51),
(122, 'images/fort-santiago-1.jpg', 1, '2026-04-10 16:54:06', 6, 51),
(123, 'images/home-mg-1.jpg', 1, '2026-04-10 16:54:06', 10, 51),
(124, 'images/home-mg-2.jpg', 1, '2026-04-10 16:54:06', 5, 51),
(125, 'images/home-mg-3.jpg', 1, '2026-04-10 16:54:06', 8, 51),
(126, 'images/home-mg-4.jpg', 1, '2026-04-10 16:54:06', 13, 51),
(127, 'images/home-mg-5.jpg', 1, '2026-04-10 16:54:06', 20, 51),
(128, 'images/home-mg-6.jpg', 1, '2026-04-10 16:54:06', 19, 51),
(129, 'images/home-mg-7.jpg', 1, '2026-04-10 16:54:06', 15, 51),
(130, 'images/home-mg-8.jpg', 1, '2026-04-10 16:54:06', 9, 51),
(131, 'images/intramuros-1.jpg', 1, '2026-04-10 16:54:06', 2, 51),
(132, 'images/mines-view-1.jpg', 1, '2026-04-10 16:54:06', 12, 51),
(133, 'images/NMFA-1.avif', 1, '2026-04-10 16:54:06', 3, 51),
(134, 'images/Rizal-Park.jpg', 1, '2026-04-10 16:54:06', 1, 51),
(135, 'images/san-sebastian-church-1.jpg', 1, '2026-04-10 16:54:06', 10, 51),
(136, 'images/session-road-1.jpg', 1, '2026-04-10 16:54:06', 15, 51),
(137, 'images/the-mansion-1.jpeg', 1, '2026-04-10 16:54:06', 17, 51),
(138, 'images/wright-park-1.jpg', 1, '2026-04-10 16:54:06', 18, 51);

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

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `attraction_id`, `rating`, `created_at`) VALUES
(1, 1, 1, 5, '2026-04-10 16:17:08'),
(2, 2, 1, 4, '2026-04-10 16:17:08'),
(3, 3, 1, 5, '2026-04-10 16:17:08'),
(4, 4, 1, 4, '2026-04-10 16:17:08'),
(5, 33, 1, 5, '2026-04-10 16:17:08'),
(6, 36, 1, 4, '2026-04-10 16:17:08'),
(7, 44, 1, 5, '2026-04-10 16:17:08'),
(8, 48, 1, 4, '2026-04-10 16:17:08'),
(9, 51, 1, 5, '2026-04-10 16:17:08'),
(10, 53, 1, 4, '2026-04-10 16:17:08'),
(11, 5, 1, 4, '2026-04-10 16:17:08'),
(12, 6, 1, 5, '2026-04-10 16:17:08'),
(13, 7, 1, 3, '2026-04-10 16:17:08'),
(14, 8, 1, 4, '2026-04-10 16:17:08'),
(15, 9, 1, 5, '2026-04-10 16:17:08'),
(16, 11, 1, 4, '2026-04-10 16:17:08'),
(17, 12, 1, 3, '2026-04-10 16:17:08'),
(18, 1, 2, 5, '2026-04-10 16:17:08'),
(19, 2, 2, 5, '2026-04-10 16:17:08'),
(20, 3, 2, 4, '2026-04-10 16:17:08'),
(21, 4, 2, 5, '2026-04-10 16:17:08'),
(22, 33, 2, 4, '2026-04-10 16:17:08'),
(23, 36, 2, 5, '2026-04-10 16:17:08'),
(24, 44, 2, 4, '2026-04-10 16:17:08'),
(25, 48, 2, 5, '2026-04-10 16:17:08'),
(26, 51, 2, 4, '2026-04-10 16:17:08'),
(27, 53, 2, 5, '2026-04-10 16:17:08'),
(28, 5, 2, 5, '2026-04-10 16:17:08'),
(29, 6, 2, 4, '2026-04-10 16:17:08'),
(30, 7, 2, 5, '2026-04-10 16:17:08'),
(31, 8, 2, 3, '2026-04-10 16:17:08'),
(32, 9, 2, 4, '2026-04-10 16:17:08'),
(33, 11, 2, 5, '2026-04-10 16:17:08'),
(34, 13, 2, 4, '2026-04-10 16:17:08'),
(35, 1, 3, 4, '2026-04-10 16:17:08'),
(36, 2, 3, 5, '2026-04-10 16:17:08'),
(37, 3, 3, 4, '2026-04-10 16:17:08'),
(38, 4, 3, 3, '2026-04-10 16:17:08'),
(39, 33, 3, 5, '2026-04-10 16:17:08'),
(40, 36, 3, 4, '2026-04-10 16:17:08'),
(41, 44, 3, 5, '2026-04-10 16:17:08'),
(42, 48, 3, 3, '2026-04-10 16:17:08'),
(43, 51, 3, 4, '2026-04-10 16:17:08'),
(44, 53, 3, 5, '2026-04-10 16:17:08'),
(45, 5, 3, 3, '2026-04-10 16:17:08'),
(46, 6, 3, 4, '2026-04-10 16:17:08'),
(47, 7, 3, 5, '2026-04-10 16:17:08'),
(48, 9, 3, 4, '2026-04-10 16:17:08'),
(49, 10, 3, 3, '2026-04-10 16:17:08'),
(50, 12, 3, 4, '2026-04-10 16:17:08'),
(51, 14, 3, 5, '2026-04-10 16:17:08'),
(52, 1, 4, 5, '2026-04-10 16:17:08'),
(53, 2, 4, 4, '2026-04-10 16:17:08'),
(54, 3, 4, 5, '2026-04-10 16:17:08'),
(55, 4, 4, 4, '2026-04-10 16:17:08'),
(56, 33, 4, 5, '2026-04-10 16:17:08'),
(57, 36, 4, 3, '2026-04-10 16:17:08'),
(58, 44, 4, 4, '2026-04-10 16:17:08'),
(59, 48, 4, 5, '2026-04-10 16:17:08'),
(60, 51, 4, 4, '2026-04-10 16:17:08'),
(61, 53, 4, 5, '2026-04-10 16:17:08'),
(62, 6, 4, 4, '2026-04-10 16:17:08'),
(63, 7, 4, 5, '2026-04-10 16:17:08'),
(64, 8, 4, 4, '2026-04-10 16:17:08'),
(65, 10, 4, 5, '2026-04-10 16:17:08'),
(66, 11, 4, 3, '2026-04-10 16:17:08'),
(67, 13, 4, 4, '2026-04-10 16:17:08'),
(68, 15, 4, 5, '2026-04-10 16:17:08'),
(69, 1, 5, 4, '2026-04-10 16:17:08'),
(70, 2, 5, 5, '2026-04-10 16:17:08'),
(71, 3, 5, 3, '2026-04-10 16:17:08'),
(72, 4, 5, 4, '2026-04-10 16:17:08'),
(73, 33, 5, 5, '2026-04-10 16:17:08'),
(74, 36, 5, 4, '2026-04-10 16:17:08'),
(75, 44, 5, 3, '2026-04-10 16:17:08'),
(76, 48, 5, 4, '2026-04-10 16:17:08'),
(77, 51, 5, 5, '2026-04-10 16:17:08'),
(78, 53, 5, 4, '2026-04-10 16:17:08'),
(79, 5, 5, 4, '2026-04-10 16:17:08'),
(80, 7, 5, 5, '2026-04-10 16:17:08'),
(81, 8, 5, 3, '2026-04-10 16:17:08'),
(82, 9, 5, 4, '2026-04-10 16:17:08'),
(83, 10, 5, 5, '2026-04-10 16:17:08'),
(84, 12, 5, 4, '2026-04-10 16:17:08'),
(85, 16, 5, 3, '2026-04-10 16:17:08'),
(86, 1, 6, 5, '2026-04-10 16:17:08'),
(87, 2, 6, 4, '2026-04-10 16:17:08'),
(88, 3, 6, 5, '2026-04-10 16:17:08'),
(89, 4, 6, 5, '2026-04-10 16:17:08'),
(90, 33, 6, 4, '2026-04-10 16:17:08'),
(91, 36, 6, 5, '2026-04-10 16:17:08'),
(92, 44, 6, 4, '2026-04-10 16:17:08'),
(93, 48, 6, 5, '2026-04-10 16:17:08'),
(94, 51, 6, 3, '2026-04-10 16:17:08'),
(95, 53, 6, 4, '2026-04-10 16:17:08'),
(96, 5, 6, 5, '2026-04-10 16:17:08'),
(97, 6, 6, 4, '2026-04-10 16:17:08'),
(98, 8, 6, 5, '2026-04-10 16:17:08'),
(99, 9, 6, 3, '2026-04-10 16:17:08'),
(100, 10, 6, 4, '2026-04-10 16:17:08'),
(101, 13, 6, 5, '2026-04-10 16:17:08'),
(102, 14, 6, 4, '2026-04-10 16:17:08'),
(103, 1, 7, 4, '2026-04-10 16:17:08'),
(104, 2, 7, 3, '2026-04-10 16:17:08'),
(105, 3, 7, 4, '2026-04-10 16:17:08'),
(106, 4, 7, 5, '2026-04-10 16:17:08'),
(107, 33, 7, 4, '2026-04-10 16:17:08'),
(108, 36, 7, 3, '2026-04-10 16:17:08'),
(109, 44, 7, 4, '2026-04-10 16:17:08'),
(110, 48, 7, 5, '2026-04-10 16:17:08'),
(111, 51, 7, 3, '2026-04-10 16:17:08'),
(112, 53, 7, 4, '2026-04-10 16:17:08'),
(113, 5, 7, 3, '2026-04-10 16:17:08'),
(114, 6, 7, 4, '2026-04-10 16:17:08'),
(115, 7, 7, 5, '2026-04-10 16:17:08'),
(116, 9, 7, 4, '2026-04-10 16:17:08'),
(117, 11, 7, 3, '2026-04-10 16:17:08'),
(118, 14, 7, 4, '2026-04-10 16:17:08'),
(119, 16, 7, 5, '2026-04-10 16:17:08'),
(120, 1, 8, 5, '2026-04-10 16:17:08'),
(121, 2, 8, 5, '2026-04-10 16:17:08'),
(122, 3, 8, 4, '2026-04-10 16:17:08'),
(123, 4, 8, 5, '2026-04-10 16:17:08'),
(124, 33, 8, 5, '2026-04-10 16:17:08'),
(125, 36, 8, 4, '2026-04-10 16:17:08'),
(126, 44, 8, 5, '2026-04-10 16:17:08'),
(127, 48, 8, 4, '2026-04-10 16:17:08'),
(128, 51, 8, 5, '2026-04-10 16:17:08'),
(129, 53, 8, 5, '2026-04-10 16:17:08'),
(130, 5, 8, 4, '2026-04-10 16:17:08'),
(131, 6, 8, 5, '2026-04-10 16:17:08'),
(132, 7, 8, 4, '2026-04-10 16:17:08'),
(133, 8, 8, 5, '2026-04-10 16:17:08'),
(134, 10, 8, 4, '2026-04-10 16:17:08'),
(135, 12, 8, 5, '2026-04-10 16:17:08'),
(136, 15, 8, 4, '2026-04-10 16:17:08'),
(137, 1, 9, 4, '2026-04-10 16:17:08'),
(138, 2, 9, 3, '2026-04-10 16:17:08'),
(139, 3, 9, 4, '2026-04-10 16:17:08'),
(140, 4, 9, 4, '2026-04-10 16:17:08'),
(141, 33, 9, 3, '2026-04-10 16:17:08'),
(142, 36, 9, 4, '2026-04-10 16:17:08'),
(143, 44, 9, 5, '2026-04-10 16:17:08'),
(144, 48, 9, 3, '2026-04-10 16:17:08'),
(145, 51, 9, 4, '2026-04-10 16:17:08'),
(146, 53, 9, 3, '2026-04-10 16:17:08'),
(147, 6, 9, 4, '2026-04-10 16:17:08'),
(148, 7, 9, 3, '2026-04-10 16:17:08'),
(149, 8, 9, 4, '2026-04-10 16:17:08'),
(150, 9, 9, 5, '2026-04-10 16:17:08'),
(151, 10, 9, 3, '2026-04-10 16:17:08'),
(152, 13, 9, 4, '2026-04-10 16:17:08'),
(153, 16, 9, 5, '2026-04-10 16:17:08'),
(154, 1, 10, 4, '2026-04-10 16:17:08'),
(155, 2, 10, 4, '2026-04-10 16:17:08'),
(156, 3, 10, 5, '2026-04-10 16:17:08'),
(157, 4, 10, 3, '2026-04-10 16:17:08'),
(158, 33, 10, 4, '2026-04-10 16:17:08'),
(159, 36, 10, 5, '2026-04-10 16:17:08'),
(160, 44, 10, 3, '2026-04-10 16:17:08'),
(161, 48, 10, 4, '2026-04-10 16:17:08'),
(162, 51, 10, 5, '2026-04-10 16:17:08'),
(163, 53, 10, 4, '2026-04-10 16:17:08'),
(164, 5, 10, 3, '2026-04-10 16:17:08'),
(165, 7, 10, 4, '2026-04-10 16:17:08'),
(166, 8, 10, 5, '2026-04-10 16:17:08'),
(167, 9, 10, 4, '2026-04-10 16:17:08'),
(168, 11, 10, 5, '2026-04-10 16:17:08'),
(169, 14, 10, 3, '2026-04-10 16:17:08'),
(170, 15, 10, 4, '2026-04-10 16:17:08'),
(171, 11, 11, 5, '2026-04-10 16:17:08'),
(172, 12, 11, 4, '2026-04-10 16:17:08'),
(173, 13, 11, 5, '2026-04-10 16:17:08'),
(174, 31, 11, 4, '2026-04-10 16:17:08'),
(175, 32, 11, 5, '2026-04-10 16:17:08'),
(176, 1, 11, 4, '2026-04-10 16:17:08'),
(177, 2, 11, 5, '2026-04-10 16:17:08'),
(178, 3, 11, 4, '2026-04-10 16:17:08'),
(179, 4, 11, 3, '2026-04-10 16:17:08'),
(180, 5, 11, 4, '2026-04-10 16:17:08'),
(181, 6, 11, 5, '2026-04-10 16:17:08'),
(182, 7, 11, 4, '2026-04-10 16:17:08'),
(183, 11, 12, 5, '2026-04-10 16:17:08'),
(184, 12, 12, 5, '2026-04-10 16:17:08'),
(185, 13, 12, 4, '2026-04-10 16:17:08'),
(186, 31, 12, 5, '2026-04-10 16:17:08'),
(187, 32, 12, 4, '2026-04-10 16:17:08'),
(188, 1, 12, 5, '2026-04-10 16:17:08'),
(189, 2, 12, 4, '2026-04-10 16:17:08'),
(190, 3, 12, 5, '2026-04-10 16:17:08'),
(191, 4, 12, 4, '2026-04-10 16:17:08'),
(192, 5, 12, 5, '2026-04-10 16:17:08'),
(193, 8, 12, 4, '2026-04-10 16:17:08'),
(194, 9, 12, 5, '2026-04-10 16:17:08'),
(195, 11, 13, 4, '2026-04-10 16:17:08'),
(196, 12, 13, 5, '2026-04-10 16:17:08'),
(197, 13, 13, 5, '2026-04-10 16:17:08'),
(198, 31, 13, 3, '2026-04-10 16:17:08'),
(199, 32, 13, 4, '2026-04-10 16:17:08'),
(200, 1, 13, 4, '2026-04-10 16:17:08'),
(201, 2, 13, 5, '2026-04-10 16:17:08'),
(202, 3, 13, 3, '2026-04-10 16:17:08'),
(203, 4, 13, 4, '2026-04-10 16:17:08'),
(204, 6, 13, 5, '2026-04-10 16:17:08'),
(205, 7, 13, 4, '2026-04-10 16:17:08'),
(206, 10, 13, 3, '2026-04-10 16:17:08'),
(207, 11, 14, 5, '2026-04-10 16:17:08'),
(208, 12, 14, 4, '2026-04-10 16:17:08'),
(209, 13, 14, 5, '2026-04-10 16:17:08'),
(210, 31, 14, 4, '2026-04-10 16:17:08'),
(211, 32, 14, 5, '2026-04-10 16:17:08'),
(212, 1, 14, 3, '2026-04-10 16:17:08'),
(213, 2, 14, 4, '2026-04-10 16:17:08'),
(214, 3, 14, 5, '2026-04-10 16:17:08'),
(215, 5, 14, 4, '2026-04-10 16:17:08'),
(216, 6, 14, 5, '2026-04-10 16:17:08'),
(217, 8, 14, 4, '2026-04-10 16:17:08'),
(218, 9, 14, 3, '2026-04-10 16:17:08'),
(219, 11, 15, 4, '2026-04-10 16:17:08'),
(220, 12, 15, 3, '2026-04-10 16:17:08'),
(221, 13, 15, 4, '2026-04-10 16:17:08'),
(222, 31, 15, 5, '2026-04-10 16:17:08'),
(223, 32, 15, 4, '2026-04-10 16:17:08'),
(224, 1, 15, 4, '2026-04-10 16:17:08'),
(225, 2, 15, 3, '2026-04-10 16:17:08'),
(226, 4, 15, 4, '2026-04-10 16:17:08'),
(227, 5, 15, 5, '2026-04-10 16:17:08'),
(228, 7, 15, 4, '2026-04-10 16:17:08'),
(229, 9, 15, 3, '2026-04-10 16:17:08'),
(230, 10, 15, 4, '2026-04-10 16:17:08'),
(231, 11, 16, 5, '2026-04-10 16:17:08'),
(232, 12, 16, 4, '2026-04-10 16:17:08'),
(233, 13, 16, 3, '2026-04-10 16:17:08'),
(234, 31, 16, 4, '2026-04-10 16:17:08'),
(235, 32, 16, 5, '2026-04-10 16:17:08'),
(236, 1, 16, 3, '2026-04-10 16:17:08'),
(237, 2, 16, 4, '2026-04-10 16:17:08'),
(238, 3, 16, 5, '2026-04-10 16:17:08'),
(239, 4, 16, 4, '2026-04-10 16:17:08'),
(240, 6, 16, 3, '2026-04-10 16:17:08'),
(241, 8, 16, 4, '2026-04-10 16:17:08'),
(242, 10, 16, 5, '2026-04-10 16:17:08'),
(243, 11, 17, 4, '2026-04-10 16:17:08'),
(244, 12, 17, 5, '2026-04-10 16:17:08'),
(245, 13, 17, 4, '2026-04-10 16:17:08'),
(246, 31, 17, 3, '2026-04-10 16:17:08'),
(247, 32, 17, 4, '2026-04-10 16:17:08'),
(248, 1, 17, 4, '2026-04-10 16:17:08'),
(249, 2, 17, 5, '2026-04-10 16:17:08'),
(250, 3, 17, 3, '2026-04-10 16:17:08'),
(251, 5, 17, 4, '2026-04-10 16:17:08'),
(252, 7, 17, 5, '2026-04-10 16:17:08'),
(253, 8, 17, 3, '2026-04-10 16:17:08'),
(254, 9, 17, 4, '2026-04-10 16:17:08'),
(255, 11, 18, 5, '2026-04-10 16:17:08'),
(256, 12, 18, 4, '2026-04-10 16:17:08'),
(257, 13, 18, 5, '2026-04-10 16:17:08'),
(258, 31, 18, 4, '2026-04-10 16:17:08'),
(259, 32, 18, 3, '2026-04-10 16:17:08'),
(260, 1, 18, 4, '2026-04-10 16:17:08'),
(261, 2, 18, 5, '2026-04-10 16:17:08'),
(262, 4, 18, 4, '2026-04-10 16:17:08'),
(263, 5, 18, 3, '2026-04-10 16:17:08'),
(264, 6, 18, 4, '2026-04-10 16:17:08'),
(265, 9, 18, 5, '2026-04-10 16:17:08'),
(266, 10, 18, 4, '2026-04-10 16:17:08'),
(267, 11, 19, 4, '2026-04-10 16:17:08'),
(268, 12, 19, 3, '2026-04-10 16:17:08'),
(269, 13, 19, 4, '2026-04-10 16:17:08'),
(270, 31, 19, 5, '2026-04-10 16:17:08'),
(271, 32, 19, 4, '2026-04-10 16:17:08'),
(272, 1, 19, 3, '2026-04-10 16:17:08'),
(273, 2, 19, 4, '2026-04-10 16:17:08'),
(274, 3, 19, 5, '2026-04-10 16:17:08'),
(275, 4, 19, 4, '2026-04-10 16:17:08'),
(276, 5, 19, 3, '2026-04-10 16:17:08'),
(277, 7, 19, 4, '2026-04-10 16:17:08'),
(278, 8, 19, 5, '2026-04-10 16:17:08'),
(279, 11, 20, 5, '2026-04-10 16:17:08'),
(280, 12, 20, 4, '2026-04-10 16:17:08'),
(281, 13, 20, 5, '2026-04-10 16:17:08'),
(282, 31, 20, 3, '2026-04-10 16:17:08'),
(283, 32, 20, 4, '2026-04-10 16:17:08'),
(284, 1, 20, 4, '2026-04-10 16:17:08'),
(285, 2, 20, 5, '2026-04-10 16:17:08'),
(286, 3, 20, 4, '2026-04-10 16:17:08'),
(287, 4, 20, 3, '2026-04-10 16:17:08'),
(288, 6, 20, 4, '2026-04-10 16:17:08'),
(289, 7, 20, 5, '2026-04-10 16:17:08'),
(290, 10, 20, 3, '2026-04-10 16:17:08'),
(291, 14, 1, 4, '2026-04-10 16:21:18'),
(292, 15, 1, 5, '2026-04-10 16:21:18'),
(293, 16, 1, 3, '2026-04-10 16:21:18'),
(294, 17, 1, 4, '2026-04-10 16:21:18'),
(295, 18, 1, 5, '2026-04-10 16:21:18'),
(296, 19, 1, 3, '2026-04-10 16:21:18'),
(297, 20, 1, 4, '2026-04-10 16:21:18'),
(298, 21, 1, 5, '2026-04-10 16:21:18'),
(299, 22, 1, 4, '2026-04-10 16:21:18'),
(300, 23, 1, 3, '2026-04-10 16:21:18'),
(301, 24, 1, 5, '2026-04-10 16:21:18'),
(302, 25, 1, 4, '2026-04-10 16:21:18'),
(303, 26, 1, 3, '2026-04-10 16:21:18'),
(304, 27, 1, 5, '2026-04-10 16:21:18'),
(305, 28, 1, 4, '2026-04-10 16:21:18'),
(306, 29, 1, 3, '2026-04-10 16:21:18'),
(307, 30, 1, 4, '2026-04-10 16:21:18'),
(308, 34, 1, 5, '2026-04-10 16:21:18'),
(309, 35, 1, 4, '2026-04-10 16:21:18'),
(310, 37, 1, 3, '2026-04-10 16:21:18'),
(311, 6, 5, 4, '2026-04-10 16:21:18'),
(312, 11, 5, 5, '2026-04-10 16:21:18'),
(313, 13, 5, 3, '2026-04-10 16:21:18'),
(314, 14, 5, 4, '2026-04-10 16:21:18'),
(315, 15, 5, 5, '2026-04-10 16:21:18'),
(316, 17, 5, 3, '2026-04-10 16:21:18'),
(317, 18, 5, 4, '2026-04-10 16:21:18'),
(318, 19, 5, 5, '2026-04-10 16:21:18'),
(319, 20, 5, 4, '2026-04-10 16:21:18'),
(320, 21, 5, 3, '2026-04-10 16:21:18'),
(321, 22, 5, 4, '2026-04-10 16:21:18'),
(322, 23, 5, 5, '2026-04-10 16:21:18'),
(323, 24, 5, 4, '2026-04-10 16:21:18'),
(324, 25, 5, 3, '2026-04-10 16:21:18'),
(325, 26, 5, 4, '2026-04-10 16:21:18'),
(326, 27, 5, 5, '2026-04-10 16:21:18'),
(327, 28, 5, 3, '2026-04-10 16:21:18'),
(328, 29, 5, 4, '2026-04-10 16:21:18'),
(329, 30, 5, 5, '2026-04-10 16:21:18'),
(330, 31, 5, 4, '2026-04-10 16:21:18'),
(331, 8, 11, 4, '2026-04-10 16:21:18'),
(332, 9, 11, 5, '2026-04-10 16:21:18'),
(333, 10, 11, 3, '2026-04-10 16:21:18'),
(334, 14, 11, 4, '2026-04-10 16:21:18'),
(335, 15, 11, 5, '2026-04-10 16:21:18'),
(336, 16, 11, 3, '2026-04-10 16:21:18'),
(337, 17, 11, 4, '2026-04-10 16:21:18'),
(338, 18, 11, 5, '2026-04-10 16:21:18'),
(339, 19, 11, 4, '2026-04-10 16:21:18'),
(340, 20, 11, 3, '2026-04-10 16:21:18'),
(341, 21, 11, 4, '2026-04-10 16:21:18'),
(342, 22, 11, 5, '2026-04-10 16:21:18'),
(343, 23, 11, 3, '2026-04-10 16:21:18'),
(344, 24, 11, 4, '2026-04-10 16:21:18'),
(345, 25, 11, 5, '2026-04-10 16:21:18'),
(346, 26, 11, 4, '2026-04-10 16:21:18'),
(347, 27, 11, 3, '2026-04-10 16:21:18'),
(348, 28, 11, 4, '2026-04-10 16:21:18'),
(349, 29, 11, 5, '2026-04-10 16:21:18'),
(350, 30, 11, 4, '2026-04-10 16:21:18'),
(351, 4, 14, 4, '2026-04-10 16:21:18'),
(352, 7, 14, 5, '2026-04-10 16:21:18'),
(353, 10, 14, 3, '2026-04-10 16:21:18'),
(354, 14, 14, 4, '2026-04-10 16:21:18'),
(355, 15, 14, 5, '2026-04-10 16:21:18'),
(356, 16, 14, 3, '2026-04-10 16:21:18'),
(357, 17, 14, 4, '2026-04-10 16:21:18'),
(358, 18, 14, 5, '2026-04-10 16:21:18'),
(359, 19, 14, 4, '2026-04-10 16:21:18'),
(360, 20, 14, 3, '2026-04-10 16:21:18'),
(361, 21, 14, 5, '2026-04-10 16:21:18'),
(362, 22, 14, 4, '2026-04-10 16:21:18'),
(363, 23, 14, 3, '2026-04-10 16:21:18'),
(364, 24, 14, 4, '2026-04-10 16:21:18'),
(365, 25, 14, 5, '2026-04-10 16:21:18'),
(366, 26, 14, 4, '2026-04-10 16:21:18'),
(367, 27, 14, 3, '2026-04-10 16:21:18'),
(368, 28, 14, 5, '2026-04-10 16:21:18'),
(369, 29, 14, 4, '2026-04-10 16:21:18'),
(370, 30, 14, 3, '2026-04-10 16:21:18');

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

ALTER TABLE `attraction`
MODIFY `description` TEXT NOT NULL;

UPDATE `attraction` SET `description` = 'Rizal Park is one of Manilas most iconic landmarks, featuring expansive gardens, historical monuments, and cultural spaces dedicated to the memory of José Rizal. It serves as both a leisure destination and a site of national pride, hosting events, concerts, and civic gatherings.' WHERE `attraction_id` = 1;

UPDATE `attraction` SET `description` = 'Intramuros, the historic walled city, offers a glimpse into Manila’s Spanish colonial past. Visitors can explore cobblestone streets, centuries-old churches, and museums that preserve the city’s heritage, making it a living testament to Philippine history.' WHERE `attraction_id` = 2;

UPDATE `attraction` SET `description` = 'The National Museum of Fine Arts houses an extensive collection of Filipino masterpieces, from classical works by Juan Luna and Félix Resurrección Hidalgo to modern art pieces. It provides a cultural journey through the evolution of Philippine artistry.' WHERE `attraction_id` = 3;

UPDATE `attraction` SET `description` = 'San Agustin Church, a UNESCO World Heritage Site, is the oldest stone church in the Philippines. Its ornate interiors, centuries-old relics, and adjoining museum highlight the country’s deep religious and cultural traditions.' WHERE `attraction_id` = 4;

UPDATE `attraction` SET `description` = 'Manila Ocean Park is a modern marine-themed attraction featuring oceanarium tunnels, interactive exhibits, and entertaining sea lion shows. It is a family-friendly destination blending education, conservation, and leisure.' WHERE `attraction_id` = 5;

UPDATE `attraction` SET `description` = 'Fort Santiago, a citadel within Intramuros, played a pivotal role in Philippine history. Visitors can explore its dungeons, gardens, and exhibits dedicated to José Rizal, offering a solemn reminder of the nation’s struggle for freedom.' WHERE `attraction_id` = 6;

UPDATE `attraction` SET `description` = 'Binondo Church, located in the heart of Chinatown, reflects centuries of Spanish and Chinese cultural fusion. Known for its ornate altar and historic significance, it remains a spiritual and cultural landmark.' WHERE `attraction_id` = 7;

UPDATE `attraction` SET `description` = 'The Manila Baywalk is a scenic promenade along Roxas Boulevard, renowned for its breathtaking sunset views. Street performers, food stalls, and lively crowds make it a vibrant spot for both locals and tourists.' WHERE `attraction_id` = 8;

UPDATE `attraction` SET `description` = 'Casa Manila is a museum that recreates the lifestyle of colonial Filipinos. With period furniture, courtyards, and Spanish-inspired architecture, it immerses visitors in the elegance of the 19th century.' WHERE `attraction_id` = 9;

UPDATE `attraction` SET `description` = 'San Sebastian Church is the only all-steel Gothic church in Asia. Its stained glass windows, twin spires, and unique construction make it a marvel of 19th-century engineering and religious devotion.' WHERE `attraction_id` = 10;

UPDATE `attraction` SET `description` = 'Burnham Park is Baguio’s central green space, offering boating on its lake, flower gardens, playgrounds, and open areas for festivals. It is a hub of leisure and community life in the city.' WHERE `attraction_id` = 11;

UPDATE `attraction` SET `description` = 'Mines View Park provides sweeping views of Benguet’s old mining town and surrounding mountains. Souvenir shops, native crafts, and photo opportunities make it a favorite stop for visitors.' WHERE `attraction_id` = 12;

UPDATE `attraction` SET `description` = 'Baguio Cathedral, with its twin spires and colorful stained glass, is a neo-Gothic landmark overlooking the city center. It is both a place of worship and a vantage point for panoramic views.' WHERE `attraction_id` = 13;

UPDATE `attraction` SET `description` = 'Camp John Hay, once a US military base, is now a resort complex with golf courses, pine forests, and heritage structures. It combines history with recreation in a scenic mountain setting.' WHERE `attraction_id` = 14;

UPDATE `attraction` SET `description` = 'Session Road is Baguio’s bustling commercial hub, lined with shops, cafés, and restaurants. It serves as the cultural heartbeat of the city, alive with activity day and night.' WHERE `attraction_id` = 15;

UPDATE `attraction` SET `description` = 'The Botanical Garden showcases native plants, artist workshops, and traditional Cordillera huts. It is a tranquil space where culture and nature blend harmoniously.' WHERE `attraction_id` = 16;

UPDATE `attraction` SET `description` = 'The Mansion is the official summer residence of the Philippine president. Its stately architecture and landscaped grounds make it a symbol of authority and elegance in Baguio.' WHERE `attraction_id` = 17;

UPDATE `attraction` SET `description` = 'Wright Park is famous for horseback riding and its pine-lined walkways. The Pool of Pines adds to its charm, making it a relaxing retreat for families and tourists.' WHERE `attraction_id` = 18;

UPDATE `attraction` SET `description` = 'Bell Church is a Taoist temple adorned with a dragon gate, pagodas, and gardens. It symbolizes harmony and spiritual reflection, offering a peaceful escape from the city.' WHERE `attraction_id` = 19;

UPDATE `attraction` SET `description` = 'Tam-Awan Village is an artist community featuring reconstructed native huts, art exhibits, and cultural workshops. It celebrates Cordillera heritage and creativity in a rustic setting.' WHERE `attraction_id` = 20;

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
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1566;

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
