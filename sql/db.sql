-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 06:39 PM
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
(1, 'Rizal Park', 'Historic park with monuments and gardens', 'Ermita, Manila', 12500, 5.00, 1, 0.00, 0.00),
(2, 'Intramuros', 'Historic walled city from Spanish era', 'Intramuros, Manila', 9800, 5.00, 1, 0.00, 0.00),
(3, 'National Museum of Fine Arts', 'Classical and modern Filipino art', 'Padre Burgos Ave, Ermita, Manila', 7200, 5.00, 1, 0.00, 0.00),
(4, 'San Agustin Church', 'Baroque UNESCO world heritage church', 'Gen Luna St, Intramuros, Manila', 5600, 5.00, 1, 0.00, 0.00),
(5, 'Manila Ocean Park', 'Marine park with oceanarium and shows', 'Ermita, Manila', 8900, 4.00, 1, 0.00, 0.00),
(6, 'Fort Santiago', 'Citadel inside Intramuros', 'Santa Clara St, Intramuros, Manila', 6700, 5.00, 1, 0.00, 0.00),
(7, 'Binondo Church', 'Historic church in Chinatown', 'Binondo, Manila', 4300, 4.00, 1, 0.00, 0.00),
(8, 'Manila Baywalk', 'Scenic baywalk with sunset views', 'Roxas Blvd, Manila', 10400, 4.00, 1, 0.00, 0.00),
(9, 'Casa Manila', 'Colonial lifestyle museum', 'Plaza San Luis Complex, Intramuros', 3900, 5.00, 1, 0.00, 0.00),
(10, 'San Sebastian Church', 'All-steel Gothic church', 'Pasaje del Carmen, Manila', 3100, 5.00, 1, 0.00, 0.00),
(11, 'Burnham Park', 'Central park with lake and gardens', 'Burnham Park, Baguio', 11000, 5.00, 11, 0.00, 0.00),
(12, 'Mines View Park', 'Scenic overlook of former gold mines', 'Dominican Hill, Baguio', 9300, 5.00, 11, 0.00, 0.00),
(13, 'Baguio Cathedral', 'Iconic church with twin spires', 'Cathedral Loop, Baguio', 6700, 5.00, 11, 0.00, 0.00),
(14, 'Camp John Hay', 'Former US base turned recreation area', 'Camp John Hay, Baguio', 7800, 4.00, 11, 0.00, 0.00),
(15, 'Session Road', 'Famous commercial and cultural hub', 'Session Road, Baguio', 5400, 4.00, 11, 0.00, 0.00),
(16, 'Botanical Garden', 'Gardens with indigenous huts', 'Leonard Wood Rd, Baguio', 6200, 5.00, 11, 0.00, 0.00),
(17, 'The Mansion', 'Official summer palace of Philippine president', 'Leonard Wood Rd, Baguio', 4900, 5.00, 11, 0.00, 0.00),
(18, 'Wright Park', 'Park with horseback riding', 'Wright Park, Baguio', 4400, 4.00, 11, 0.00, 0.00),
(19, 'Bell Church', 'Taoist temple with dragon gate', 'Bell Church Rd, Baguio', 3700, 5.00, 11, 0.00, 0.00),
(20, 'Tam-Awan Village', 'Artist village with native huts', 'Tam-Awan, Baguio', 2900, 5.00, 11, 0.00, 0.00);

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
(1, 'Juan Dela Cruz', 'juandelacruz', 'Juan123!', 'juandelacruz@email.com', 1, 'user'),
(2, 'Maria Santos', 'mariasantos', 'Maria123!', 'mariasantos@email.com', 1, 'user'),
(3, 'Jose Rizal', 'joserizal', 'Rizal123!', 'joserizal@email.com', 1, 'user'),
(4, 'Andres Bonifacio', 'andresbonifacio', 'Bonifacio123!', 'andresbonifacio@email.com', 1, 'user'),
(5, 'Antonio Luna', 'antonioluna', 'Luna123!', 'antonioluna@email.com', 2, 'user'),
(6, 'Gabriela Silang', 'gabrielasilang', 'Silang123!', 'gabrielasilang@email.com', 2, 'user'),
(7, 'Emilio Aguinaldo', 'emilioaguinaldo', 'Aguinaldo123!', 'emilioaguinaldo@email.com', 2, 'user'),
(8, 'Manny Pacquiao', 'mannypacquiao', 'Pacquiao123!', 'mannypacquiao@email.com', 3, 'user'),
(9, 'Lea Salonga', 'leasalonga', 'Salonga123!', 'leasalonga@email.com', 3, 'user'),
(10, 'Catriona Gray', 'catrionagray', 'Gray123!', 'catrionagray@email.com', 3, 'user'),
(11, 'Grace Poe', 'gracepoe', 'Poe123!', 'gracepoe@email.com', 11, 'user'),
(12, 'Bong Go', 'bonggo', 'Go123!', 'bonggo@email.com', 11, 'user'),
(13, 'Robin Padilla', 'robinpadilla', 'Padilla123!', 'robinpadilla@email.com', 11, 'user'),
(14, 'Lapu-Lapu', 'lapulapu', 'Lapu123!', 'lapulapu@email.com', 36, 'user'),
(15, 'Gwen Garcia', 'gwengarcia', 'Garcia123!', 'gwengarcia@email.com', 36, 'user'),
(16, 'Michael Rama', 'michaelrama', 'Rama123!', 'michaelrama@email.com', 36, 'user'),
(17, 'Rodrigo Duterte', 'rodrigoduterte', 'Duterte123!', 'rodrigoduterte@email.com', 47, 'user'),
(18, 'Sara Duterte', 'saraduterte', 'Sara123!', 'saraduterte@email.com', 47, 'user'),
(19, 'Paolo Duterte', 'paoloduterte', 'Paolo123!', 'paoloduterte@email.com', 47, 'user'),
(20, 'Katherine Bernardo', 'katherinebernardo', 'Kath123!', 'katherinebernardo@email.c', 5, 'user'),
(21, 'Alden Richards', 'aldenrichards', 'Alden123!', 'aldenrichards@email.com', 5, 'user'),
(22, 'Maine Mendoza', 'mainemendoza', 'Maine123!', 'mainemendoza@email.com', 8, 'user'),
(23, 'Vice Ganda', 'viceganda', 'Vice123!', 'viceganda@email.com', 2, 'user'),
(24, 'Anne Curtis', 'annecurtis', 'Anne123!', 'annecurtis@email.com', 3, 'user'),
(25, 'Marlon Villar', 'marlonvillar', 'Marlon123!', 'marlonvillar@email.com', 15, 'user'),
(26, 'Cynthia Villar', 'cynthiavillar', 'Cynthia123!', 'cynthiavillar@email.com', 15, 'user'),
(27, 'Chiz Escudero', 'chizescudero', 'Chiz123!', 'chizescudero@email.com', 20, 'user'),
(28, 'Pia Cayetano', 'piacayetano', 'Pia123!', 'piacayetano@email.com', 4, 'user'),
(29, 'Alan Cayetano', 'alancayetano', 'Alan123!', 'alancayetano@email.com', 4, 'user'),
(30, 'Lito Lapid', 'litolapid', 'Lapid123!', 'litolapid@email.com', 19, 'user'),
(31, 'Bato dela Rosa', 'batodelarosa', 'Bato123!', 'batodelarosa@email.com', 11, 'user'),
(32, 'Christopher Go', 'christophergo', 'Chris123!', 'christophergo@email.com', 11, 'user'),
(33, 'Isko Moreno', 'iskomoreno', 'Isko123!', 'iskomoreno@email.com', 1, 'user'),
(34, 'Vico Sotto', 'vicosotto', 'Vico123!', 'vicosotto@email.com', 5, 'user'),
(35, 'Joy Belmonte', 'joybelmonte', 'Joy123!', 'joybelmonte@email.com', 2, 'user'),
(36, 'Honey Lacuna', 'honeylacuna', 'Honey123!', 'honeylacuna@email.com', 1, 'user'),
(37, 'Abby Binay', 'abbybinay', 'Abby123!', 'abbybinay@email.com', 3, 'user'),
(38, 'Inday Sara', 'indaysara', 'Inday123!', 'indaysara@email.com', 47, 'user'),
(39, 'Sebastian Duterte', 'sebastianduterte', 'Baste123!', 'sebastianduterte@email.co', 47, 'user'),
(40, 'Ramon Ang', 'ramonang', 'Ang123!', 'ramonang@email.com', 5, 'user'),
(41, 'Tony Tan Caktiong', 'tonytan', 'Tony123!', 'tonytan@email.com', 37, 'user'),
(42, 'Henry Sy Jr.', 'henrysyjr', 'Henry123!', 'henrysyjr@email.com', 3, 'user'),
(43, 'John Gokongwei', 'johngokongwei', 'John123!', 'johngokongwei@email.com', 2, 'user'),
(44, 'Lucio Tan', 'luciotan', 'Lucio123!', 'luciotan@email.com', 1, 'user'),
(45, 'Andrew Tan', 'andrewtan', 'Andrew123!', 'andrewtan@email.com', 3, 'user'),
(46, 'Manuel Pangilinan', 'manuelpangilinan', 'MVP123!', 'manuelpangilinan@email.co', 2, 'user'),
(47, 'Jaime Zobel', 'jaimezobel', 'Jaime123!', 'jaimezobel@email.com', 3, 'user'),
(48, 'Enrique Razon', 'enriquerazon', 'Razon123!', 'enriquerazon@email.com', 1, 'user'),
(49, 'Dennis Uy', 'dennisuy', 'Uy123!', 'dennisuy@email.com', 47, 'user'),
(50, 'Manny Villar', 'mannyvillar', 'Villar123!', 'mannyvillar@email.com', 15, 'user'),
(51, 'admin', 'admin', 'admin', 'admin@gmail.com', 1, 'admin');

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
(50, 12);

-- Populate ratings table
INSERT INTO `ratings` (`user_id`, `attraction_id`, `rating`) VALUES
-- User 1 (Juan Dela Cruz) ratings
(1, 1, 5),
(1, 2, 4),
(1, 3, 5),
(1, 4, 4),
(1, 5, 3),

-- User 2 (Maria Santos) ratings
(2, 1, 4),
(2, 6, 5),
(2, 7, 4),
(2, 8, 3),

-- User 3 (Jose Rizal) ratings
(3, 2, 5),
(3, 4, 5),
(3, 6, 4),

-- User 4 (Andres Bonifacio) ratings
(4, 2, 4),
(4, 4, 5),
(4, 6, 4),

-- User 5 (Antonio Luna) ratings
(5, 1, 5),
(5, 3, 4),
(5, 5, 3),

-- User 6 (Gabriela Silang) ratings
(6, 11, 5),
(6, 12, 4),
(6, 13, 5),
(6, 14, 4),

-- User 7 (Emilio Aguinaldo) ratings
(7, 1, 4),
(7, 11, 5),
(7, 15, 3),

-- User 8 (Manny Pacquiao) ratings
(8, 1, 5),
(8, 6, 4),
(8, 11, 5),

-- User 9 (Lea Salonga) ratings
(9, 3, 5),
(9, 4, 5),
(9, 7, 4),
(9, 13, 5),

-- User 10 (Catriona Gray) ratings
(10, 5, 4),
(10, 12, 5),
(10, 16, 4),

-- User 11 (Grace Poe) ratings
(11, 11, 5),
(11, 14, 4),
(11, 17, 5),
(11, 18, 4),

-- User 12 (Bong Go) ratings
(12, 2, 3),
(12, 8, 4),
(12, 15, 4),
(12, 19, 5),

-- User 13 (Robin Padilla) ratings
(13, 4, 5),
(13, 8, 4),
(13, 13, 5),
(13, 19, 4),

-- User 14 (Lapu-Lapu) ratings
(14, 1, 4),
(14, 11, 5),
(14, 20, 4),

-- User 15 (Gwen Garcia) ratings
(15, 3, 5),
(15, 6, 4),
(15, 9, 4),
(15, 16, 5),

-- User 16 (Michael Rama) ratings
(16, 1, 4),
(16, 6, 5),
(16, 11, 4),
(16, 18, 3),

-- User 17 (Rodrigo Duterte) ratings
(17, 5, 3),
(17, 12, 4),
(17, 20, 5),

-- User 18 (Sara Duterte) ratings
(18, 2, 5),
(18, 7, 4),
(18, 14, 5),

-- User 19 (Paolo Duterte) ratings
(19, 4, 4),
(19, 9, 3),
(19, 15, 4),

-- User 20 (Katherine Bernardo) ratings
(20, 1, 5),
(20, 10, 4),
(20, 13, 5),

-- User 21 (Alden Richards) ratings
(21, 6, 4),
(21, 11, 5),
(21, 16, 4),

-- User 22 (Maine Mendoza) ratings
(22, 3, 5),
(22, 8, 4),
(22, 17, 5),

-- User 23 (Vice Ganda) ratings
(23, 2, 4),
(23, 5, 3),
(23, 12, 5),

-- User 24 (Anne Curtis) ratings
(24, 1, 5),
(24, 7, 4),
(24, 14, 4),

-- User 25 (Marlon Villar) ratings
(25, 4, 4),
(25, 9, 5),
(25, 18, 3),

-- User 26 (Cynthia Villar) ratings
(26, 6, 5),
(26, 10, 4),
(26, 19, 4),

-- User 27 (Chiz Escudero) ratings
(27, 3, 4),
(27, 11, 5),
(27, 20, 4),

-- User 28 (Pia Cayetano) ratings
(28, 2, 5),
(28, 8, 4),
(28, 15, 4),

-- User 29 (Alan Cayetano) ratings
(29, 5, 3),
(29, 12, 5),
(29, 16, 4),

-- User 30 (Lito Lapid) ratings
(30, 1, 4),
(30, 9, 5),
(30, 17, 4),

-- User 31 (Bato dela Rosa) ratings
(31, 7, 4),
(31, 13, 5),
(31, 18, 3),

-- User 32 (Christopher Go) ratings
(32, 4, 5),
(32, 10, 4),
(32, 19, 4),

-- User 33 (Isko Moreno) ratings
(33, 1, 5),
(33, 2, 4),
(33, 3, 5),
(33, 4, 4),
(33, 5, 5),

-- User 34 (Vico Sotto) ratings
(34, 6, 4),
(34, 11, 5),
(34, 16, 4),

-- User 35 (Joy Belmonte) ratings
(35, 2, 5),
(35, 7, 4),
(35, 12, 4),

-- User 36 (Honey Lacuna) ratings
(36, 1, 4),
(36, 4, 5),
(36, 8, 3),

-- User 37 (Abby Binay) ratings
(37, 3, 5),
(37, 9, 4),
(37, 14, 5),

-- User 38 (Inday Sara) ratings
(38, 5, 4),
(38, 10, 5),
(38, 15, 4),

-- User 39 (Sebastian Duterte) ratings
(39, 2, 4),
(39, 11, 5),
(39, 20, 4),

-- User 40 (Ramon Ang) ratings
(40, 1, 5),
(40, 6, 4),
(40, 13, 5),

-- User 41 (Tony Tan Caktiong) ratings
(41, 7, 4),
(41, 12, 5),
(41, 17, 4),

-- User 42 (Henry Sy Jr.) ratings
(42, 3, 5),
(42, 8, 4),
(42, 18, 3),

-- User 43 (John Gokongwei) ratings
(43, 4, 4),
(43, 9, 5),
(43, 19, 4),

-- User 44 (Lucio Tan) ratings
(44, 1, 5),
(44, 5, 4),
(44, 14, 5),

-- User 45 (Andrew Tan) ratings
(45, 6, 4),
(45, 10, 5),
(45, 16, 4),

-- User 46 (Manuel Pangilinan) ratings
(46, 2, 5),
(46, 11, 4),
(46, 20, 5),

-- User 47 (Jaime Zobel) ratings
(47, 3, 4),
(47, 7, 5),
(47, 15, 4),

-- User 48 (Enrique Razon) ratings
(48, 4, 5),
(48, 8, 4),
(48, 17, 5),

-- User 49 (Dennis Uy) ratings
(49, 5, 4),
(49, 9, 5),
(49, 18, 4),

-- User 50 (Manny Villar) ratings
(50, 1, 5),
(50, 6, 4),
(50, 12, 5);
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
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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

-- allow user table to accept NULL city value
ALTER TABLE `user` CHANGE `city_id` `city_id` INT(11) NULL;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
