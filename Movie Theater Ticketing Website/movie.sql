/*
	OSU CS 340 Spring 2020 Databases
	Project Group 10
	Authors: Jacob Lee, Pamela Yin 
	Date: June 8, 2020
	Description: This is MySQL file that is used for this project that has initial data to use the db with.
              This is compatible with MariaDB, used in combination with phpMyAdmin.
*/

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2020 at 07:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-8:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_first_name` varchar(255) NOT NULL,
  `customer_last_name` varchar(255) NOT NULL,
  `customer_dob` date NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_dob`, `customer_email`, `customer_phone`) VALUES
(4, 'Angela', 'Lee', '1994-08-12', 'angela@kim.com', ''),
(2, 'Jane', 'Smith', '1987-05-04', 'jane@smith.com', '123-456-7890'),
(1, 'John', 'Doe', '1991-01-04', 'john@doe.com', '111-111-1111'),
(3, 'Michael', 'Anderson', '1973-02-02', 'michael@anderson.com', '505-555-5555');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `employee_pw` varchar(30) NOT NULL,
  `location_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_pw`, `location_id`) VALUES
(1, 'leesa6', 'test1234', ''),
(2, 'yinp', 'test1234', ''),
(3, 'cs340', 'test1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `film_id` varchar(255) NOT NULL,
  `age_rating` int(11) NOT NULL,
  `film_title` varchar(255) NOT NULL,
  `runtime` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `down_date` date NOT NULL,
  `showing_now` char(1) NOT NULL,
  `film_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`film_id`, `age_rating`, `film_title`, `runtime`, `release_date`, `down_date`, `showing_now`, `film_description`) VALUES
('Avengers,Endgame_re_2020', 15, 'Avengers,Endgame', 182, '2020-05-01', '2020-07-09', 'Y', 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.'),
('Joker_re_2020', 17, 'Joker', 122, '2020-05-01', '2020-07-09', 'Y', 'Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Arthur wears two masks -- the one he paints for his day job as a clown, and the guise he projects in a futile attempt to feel like he\'s part of the world around him. Isolated, bullied and disRegulararded by society, Fleck begins a slow descent into madness as he transforms into the criminal mastermind known as the Joker.'),
('Maleficent,Mistress of Evil_re_2020', 12, 'Maleficent,Mistress of Evil', 118, '2020-05-01', '2020-07-09', 'Y', 'Maleficent travels to a grand old castle to celebrate young Aurora\'s upcoming wedding to Prince Phillip. While there, she meets Aurora\'s future mother-in-law -- a conniving queen who hatches a devious plot to destroy the land\'s fairies. Hoping to stop her, Maleficent joins forces with a seasoned warrior and a group of outcasts to battle the queen and her powerful army.'),
('Parasite_new_2020', 15, 'Parasite', 132, '2020-05-01', '2020-07-09', 'Y', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.'),
('Up_new_2009', 0, 'Up', 96, '2009-03-01', '2009-07-09', 'Y', 'Carl Fredricksen, a 78-year-old balloon salesman, is about to fulfill a lifelong dream. Tying thousands of balloons to his house, he flies away to the South American wilderness. But curmudgeonly Carl\'s worst nightmare comes true when he discovers a little boy named Russell is a stowaway aboard the balloon-powered house. A Pixar animation.');

-- --------------------------------------------------------

--
-- Table structure for table `films_schedule`
--

CREATE TABLE `films_schedule` (
  `schedule_id` int(11) NOT NULL,
  `film_id` varchar(255) DEFAULT NULL,
  `location_id` varchar(255) NOT NULL,
  `movie_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `seat_available` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `films_schedule`
--

INSERT INTO `films_schedule` (`schedule_id`, `film_id`, `location_id`, `movie_date`, `start_time`, `seat_available`) VALUES
(2134, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-21', '10:02', 10),
(2135, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-22', '10:03', 10),
(2136, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-23', '10:04', 10),
(2137, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-24', '12:05', 10),
(2138, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-25', '08:46', 10),
(2139, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-26', '10:07', 10),
(2140, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-27', '09:04', 10),
(2141, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-28', '09:05', 10),
(2142, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-29', '09:06', 10),
(2143, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-30', '09:07', 10),
(2144, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-31', '09:08', 10),
(2145, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-01', '09:09', 10),
(2146, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-02', '08:46', 10),
(2147, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-03', '08:47', 10),
(2148, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-04', '08:48', 10),
(2149, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-05', '08:49', 10),
(2150, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-06', '08:50', 10),
(2151, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-07', '08:51', 10),
(2152, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-08', '09:16', 10),
(2153, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-09', '09:17', 10),
(2154, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-10', '09:18', 10),
(2155, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-11', '09:19', 10),
(2156, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-12', '09:20', 10),
(2157, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-13', '09:21', 10),
(2158, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-14', '09:22', 10),
(2159, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-15', '09:23', 10),
(2160, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-16', '09:24', 10),
(2161, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-17', '09:25', 10),
(2162, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-18', '09:26', 10),
(2163, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-19', '09:27', 10),
(2164, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-20', '09:28', 10),
(2165, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-21', '09:29', 10),
(2166, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-22', '09:30', 10),
(2167, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-23', '09:31', 10),
(2168, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-24', '09:32', 10),
(2169, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-25', '11:33', 10),
(2170, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-26', '11:34', 10),
(2171, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-27', '11:35', 10),
(2172, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-28', '11:36', 10),
(2173, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-29', '09:37', 10),
(2174, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-30', '09:38', 10),
(2175, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-01', '09:39', 10),
(2176, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-02', '09:40', 10),
(2177, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-03', '09:41', 10),
(2178, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-04', '09:42', 10),
(2179, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-05', '09:43', 10),
(2180, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-06', '09:44', 10),
(2181, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-07', '09:45', 10),
(2182, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-21', '15:40', 10),
(2183, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-22', '16:15', 10),
(2184, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-23', '20:50', 10),
(2185, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-24', '22:02', 10),
(2186, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-25', '13:55', 10),
(2187, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-26', '15:41', 10),
(2188, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-27', '16:16', 10),
(2189, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-28', '20:51', 10),
(2190, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-29', '22:03', 10),
(2191, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-30', '13:56', 10),
(2192, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-05-31', '15:42', 10),
(2193, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-01', '16:17', 10),
(2194, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-02', '20:52', 10),
(2195, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-03', '22:04', 10),
(2196, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-04', '13:57', 10),
(2197, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-05', '15:43', 10),
(2198, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-06', '16:18', 10),
(2199, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-07', '20:53', 10),
(2200, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-08', '22:05', 10),
(2201, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-09', '13:58', 10),
(2202, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-10', '15:44', 10),
(2203, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-11', '16:19', 10),
(2204, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-12', '20:54', 10),
(2205, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-13', '22:06', 10),
(2206, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-14', '13:59', 10),
(2207, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-15', '15:45', 10),
(2208, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-16', '16:20', 10),
(2209, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-17', '20:55', 10),
(2210, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-18', '22:07', 10),
(2211, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-19', '13:60', 10),
(2212, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-20', '15:46', 10),
(2213, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-21', '16:21', 10),
(2214, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-22', '20:56', 10),
(2215, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-23', '22:08', 10),
(2216, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-24', '13:61', 10),
(2217, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-25', '15:47', 10),
(2218, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-26', '16:22', 10),
(2219, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-27', '20:57', 10),
(2220, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-28', '22:09', 10),
(2221, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-29', '13:62', 10),
(2222, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-06-30', '15:48', 10),
(2223, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-01', '16:23', 10),
(2224, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-02', '20:58', 10),
(2225, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-03', '22:10', 10),
(2226, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-04', '13:63', 10),
(2228, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-06', '16:24', 10),
(2229, 'Avengers,Endgame_re_2020', 'LA_ANONE', '2020-07-07', '20:59', 10),
(2230, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-21', '10:02', 10),
(2231, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-22', '10:03', 10),
(2232, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-23', '10:04', 10),
(2233, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-24', '12:05', 10),
(2234, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-25', '08:46', 10),
(2235, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-26', '10:07', 10),
(2236, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-27', '09:04', 10),
(2237, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-28', '09:05', 10),
(2238, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-29', '09:06', 10),
(2239, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-30', '09:07', 10),
(2240, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-31', '09:08', 10),
(2241, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-01', '09:09', 10),
(2242, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-02', '08:46', 10),
(2243, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-03', '08:47', 10),
(2244, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-04', '08:48', 10),
(2245, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-05', '08:49', 10),
(2246, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-06', '08:50', 10),
(2247, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-07', '08:51', 10),
(2248, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-08', '09:16', 10),
(2249, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-09', '09:17', 10),
(2250, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-10', '09:18', 10),
(2251, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-11', '09:19', 10),
(2252, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-12', '09:20', 10),
(2253, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-13', '09:21', 10),
(2254, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-14', '09:22', 10),
(2255, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-15', '09:23', 10),
(2256, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-16', '09:24', 10),
(2257, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-17', '09:25', 10),
(2258, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-18', '09:26', 10),
(2259, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-19', '09:27', 10),
(2260, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-20', '09:28', 10),
(2261, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-21', '09:29', 10),
(2262, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-22', '09:30', 10),
(2263, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-23', '09:31', 10),
(2264, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-24', '09:32', 10),
(2265, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-25', '11:33', 10),
(2266, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-26', '11:34', 10),
(2267, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-27', '11:35', 10),
(2268, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-28', '11:36', 10),
(2269, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-29', '09:37', 10),
(2270, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-30', '09:38', 10),
(2271, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-01', '09:39', 10),
(2272, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-02', '09:40', 7),
(2273, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-03', '09:41', 10),
(2274, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-04', '09:42', 10),
(2275, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-05', '09:43', 10),
(2276, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-06', '09:44', 10),
(2277, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-07', '09:45', 10),
(2278, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-21', '15:40', 10),
(2279, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-22', '16:15', 10),
(2280, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-23', '20:50', 10),
(2281, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-24', '22:02', 10),
(2282, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-25', '13:55', 10),
(2283, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-26', '15:41', 10),
(2284, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-27', '16:16', 10),
(2285, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-28', '20:51', 10),
(2286, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-29', '22:03', 10),
(2287, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-30', '13:56', 10),
(2288, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-05-31', '15:42', 10),
(2289, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-01', '16:17', 10),
(2290, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-02', '20:52', 10),
(2291, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-03', '22:04', 10),
(2292, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-04', '13:57', 7),
(2293, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-05', '15:43', 10),
(2294, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-06', '16:18', 10),
(2295, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-07', '20:53', 10),
(2296, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-08', '22:05', 10),
(2297, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-09', '13:58', 10),
(2298, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-10', '15:44', 10),
(2299, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-11', '16:19', 10),
(2300, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-12', '20:54', 10),
(2301, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-13', '22:06', 10),
(2302, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-14', '13:59', 10),
(2303, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-15', '15:45', 10),
(2304, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-16', '16:20', 10),
(2305, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-17', '20:55', 10),
(2306, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-18', '22:07', 10),
(2307, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-19', '13:60', 10),
(2308, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-20', '15:46', 10),
(2309, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-21', '16:21', 10),
(2310, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-22', '20:56', 10),
(2311, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-23', '22:08', 10),
(2312, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-24', '13:61', 10),
(2313, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-25', '15:47', 10),
(2314, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-26', '16:22', 10),
(2315, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-27', '20:57', 10),
(2316, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-28', '22:09', 10),
(2317, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-29', '13:62', 10),
(2318, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-06-30', '15:48', 10),
(2319, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-01', '16:23', 10),
(2320, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-02', '20:58', 10),
(2321, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-03', '22:10', 10),
(2322, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-04', '13:63', 10),
(2323, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-05', '15:49', 10),
(2324, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-06', '16:24', 10),
(2325, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-07-07', '20:59', 10),
(2326, 'Parasite_new_2020', 'LA_ANONE', '2020-05-21', '10:02', 10),
(2327, 'Parasite_new_2020', 'LA_ANONE', '2020-05-22', '10:03', 10),
(2328, 'Parasite_new_2020', 'LA_ANONE', '2020-05-23', '10:04', 10),
(2329, 'Parasite_new_2020', 'LA_ANONE', '2020-05-24', '12:05', 10),
(2330, 'Parasite_new_2020', 'LA_ANONE', '2020-05-25', '08:46', 10),
(2331, 'Parasite_new_2020', 'LA_ANONE', '2020-05-26', '10:07', 10),
(2332, 'Parasite_new_2020', 'LA_ANONE', '2020-05-27', '09:04', 10),
(2333, 'Parasite_new_2020', 'LA_ANONE', '2020-05-28', '09:05', 10),
(2334, 'Parasite_new_2020', 'LA_ANONE', '2020-05-29', '09:06', 10),
(2335, 'Parasite_new_2020', 'LA_ANONE', '2020-05-30', '09:07', 10),
(2336, 'Parasite_new_2020', 'LA_ANONE', '2020-05-31', '09:08', 10),
(2337, 'Parasite_new_2020', 'LA_ANONE', '2020-06-01', '09:09', 10),
(2338, 'Parasite_new_2020', 'LA_ANONE', '2020-06-02', '08:46', 10),
(2339, 'Parasite_new_2020', 'LA_ANONE', '2020-06-03', '08:47', 10),
(2340, 'Parasite_new_2020', 'LA_ANONE', '2020-06-04', '08:48', 10),
(2341, 'Parasite_new_2020', 'LA_ANONE', '2020-06-05', '08:49', 10),
(2342, 'Parasite_new_2020', 'LA_ANONE', '2020-06-06', '08:50', 10),
(2343, 'Parasite_new_2020', 'LA_ANONE', '2020-06-07', '08:51', 10),
(2344, 'Parasite_new_2020', 'LA_ANONE', '2020-06-08', '09:16', 10),
(2345, 'Parasite_new_2020', 'LA_ANONE', '2020-06-09', '09:17', 10),
(2346, 'Parasite_new_2020', 'LA_ANONE', '2020-06-10', '09:18', 10),
(2347, 'Parasite_new_2020', 'LA_ANONE', '2020-06-11', '09:19', 10),
(2348, 'Parasite_new_2020', 'LA_ANONE', '2020-06-12', '09:20', 10),
(2349, 'Parasite_new_2020', 'LA_ANONE', '2020-06-13', '09:21', 10),
(2350, 'Parasite_new_2020', 'LA_ANONE', '2020-06-14', '09:22', 10),
(2351, 'Parasite_new_2020', 'LA_ANONE', '2020-06-15', '09:23', 10),
(2352, 'Parasite_new_2020', 'LA_ANONE', '2020-06-16', '09:24', 10),
(2353, 'Parasite_new_2020', 'LA_ANONE', '2020-06-17', '09:25', 10),
(2354, 'Parasite_new_2020', 'LA_ANONE', '2020-06-18', '09:26', 10),
(2355, 'Parasite_new_2020', 'LA_ANONE', '2020-06-19', '09:27', 10),
(2356, 'Parasite_new_2020', 'LA_ANONE', '2020-06-20', '09:28', 10),
(2357, 'Parasite_new_2020', 'LA_ANONE', '2020-06-21', '09:29', 10),
(2358, 'Parasite_new_2020', 'LA_ANONE', '2020-06-22', '09:30', 10),
(2359, 'Parasite_new_2020', 'LA_ANONE', '2020-06-23', '09:31', 10),
(2360, 'Parasite_new_2020', 'LA_ANONE', '2020-06-24', '09:32', 10),
(2361, 'Parasite_new_2020', 'LA_ANONE', '2020-06-25', '11:33', 10),
(2362, 'Parasite_new_2020', 'LA_ANONE', '2020-06-26', '11:34', 10),
(2363, 'Parasite_new_2020', 'LA_ANONE', '2020-06-27', '11:35', 10),
(2364, 'Parasite_new_2020', 'LA_ANONE', '2020-06-28', '11:36', 10),
(2365, 'Parasite_new_2020', 'LA_ANONE', '2020-06-29', '09:37', 10),
(2366, 'Parasite_new_2020', 'LA_ANONE', '2020-06-30', '09:38', 10),
(2367, 'Parasite_new_2020', 'LA_ANONE', '2020-07-01', '09:39', 10),
(2368, 'Parasite_new_2020', 'LA_ANONE', '2020-07-02', '09:40', 10),
(2369, 'Parasite_new_2020', 'LA_ANONE', '2020-07-03', '09:41', 10),
(2370, 'Parasite_new_2020', 'LA_ANONE', '2020-07-04', '09:42', 10),
(2371, 'Parasite_new_2020', 'LA_ANONE', '2020-07-05', '09:43', 10),
(2372, 'Parasite_new_2020', 'LA_ANONE', '2020-07-06', '09:44', 10),
(2373, 'Parasite_new_2020', 'LA_ANONE', '2020-07-07', '09:45', 10),
(2374, 'Parasite_new_2020', 'LA_ANONE', '2020-05-21', '15:40', 10),
(2375, 'Parasite_new_2020', 'LA_ANONE', '2020-05-22', '16:15', 10),
(2376, 'Parasite_new_2020', 'LA_ANONE', '2020-05-23', '20:50', 10),
(2377, 'Parasite_new_2020', 'LA_ANONE', '2020-05-24', '22:02', 10),
(2378, 'Parasite_new_2020', 'LA_ANONE', '2020-05-25', '13:55', 10),
(2379, 'Parasite_new_2020', 'LA_ANONE', '2020-05-26', '15:41', 10),
(2380, 'Parasite_new_2020', 'LA_ANONE', '2020-05-27', '16:16', 10),
(2381, 'Parasite_new_2020', 'LA_ANONE', '2020-05-28', '20:51', 10),
(2382, 'Parasite_new_2020', 'LA_ANONE', '2020-05-29', '22:03', 10),
(2383, 'Parasite_new_2020', 'LA_ANONE', '2020-05-30', '13:56', 10),
(2384, 'Parasite_new_2020', 'LA_ANONE', '2020-05-31', '15:42', 10),
(2385, 'Parasite_new_2020', 'LA_ANONE', '2020-06-01', '16:17', 10),
(2386, 'Parasite_new_2020', 'LA_ANONE', '2020-06-02', '20:52', 10),
(2387, 'Parasite_new_2020', 'LA_ANONE', '2020-06-03', '22:04', 10),
(2388, 'Parasite_new_2020', 'LA_ANONE', '2020-06-04', '13:57', 8),
(2389, 'Parasite_new_2020', 'LA_ANONE', '2020-06-05', '15:43', 10),
(2390, 'Parasite_new_2020', 'LA_ANONE', '2020-06-06', '16:18', 10),
(2391, 'Parasite_new_2020', 'LA_ANONE', '2020-06-07', '20:53', 10),
(2392, 'Parasite_new_2020', 'LA_ANONE', '2020-06-08', '22:05', 10),
(2393, 'Parasite_new_2020', 'LA_ANONE', '2020-06-09', '13:58', 10),
(2394, 'Parasite_new_2020', 'LA_ANONE', '2020-06-10', '15:44', 10),
(2395, 'Parasite_new_2020', 'LA_ANONE', '2020-06-11', '16:19', 10),
(2396, 'Parasite_new_2020', 'LA_ANONE', '2020-06-12', '20:54', 10),
(2397, 'Parasite_new_2020', 'LA_ANONE', '2020-06-13', '22:06', 10),
(2398, 'Parasite_new_2020', 'LA_ANONE', '2020-06-14', '13:59', 10),
(2399, 'Parasite_new_2020', 'LA_ANONE', '2020-06-15', '15:45', 10),
(2400, 'Parasite_new_2020', 'LA_ANONE', '2020-06-16', '16:20', 10),
(2401, 'Parasite_new_2020', 'LA_ANONE', '2020-06-17', '20:55', 10),
(2402, 'Parasite_new_2020', 'LA_ANONE', '2020-06-18', '22:07', 10),
(2403, 'Parasite_new_2020', 'LA_ANONE', '2020-06-19', '13:60', 10),
(2404, 'Parasite_new_2020', 'LA_ANONE', '2020-06-20', '15:46', 10),
(2405, 'Parasite_new_2020', 'LA_ANONE', '2020-06-21', '16:21', 10),
(2406, 'Parasite_new_2020', 'LA_ANONE', '2020-06-22', '20:56', 10),
(2407, 'Parasite_new_2020', 'LA_ANONE', '2020-06-23', '22:08', 10),
(2408, 'Parasite_new_2020', 'LA_ANONE', '2020-06-24', '13:61', 10),
(2409, 'Parasite_new_2020', 'LA_ANONE', '2020-06-25', '15:47', 10),
(2410, 'Parasite_new_2020', 'LA_ANONE', '2020-06-26', '16:22', 10),
(2411, 'Parasite_new_2020', 'LA_ANONE', '2020-06-27', '20:57', 10),
(2412, 'Parasite_new_2020', 'LA_ANONE', '2020-06-28', '22:09', 10),
(2413, 'Parasite_new_2020', 'LA_ANONE', '2020-06-29', '13:62', 10),
(2414, 'Parasite_new_2020', 'LA_ANONE', '2020-06-30', '15:48', 10),
(2415, 'Parasite_new_2020', 'LA_ANONE', '2020-07-01', '16:23', 10),
(2416, 'Parasite_new_2020', 'LA_ANONE', '2020-07-02', '20:58', 10),
(2417, 'Parasite_new_2020', 'LA_ANONE', '2020-07-03', '22:10', 10),
(2418, 'Parasite_new_2020', 'LA_ANONE', '2020-07-04', '13:63', 10),
(2419, 'Parasite_new_2020', 'LA_ANONE', '2020-07-05', '15:49', 10),
(2420, 'Parasite_new_2020', 'LA_ANONE', '2020-07-06', '16:24', 10),
(2422, 'Parasite_new_2020', 'OR_ANONE', '2020-05-21', '10:02', 10),
(2423, 'Parasite_new_2020', 'OR_ANONE', '2020-05-22', '10:03', 10),
(2424, 'Parasite_new_2020', 'OR_ANONE', '2020-05-23', '10:04', 10),
(2425, 'Parasite_new_2020', 'OR_ANONE', '2020-05-24', '12:05', 10),
(2426, 'Parasite_new_2020', 'OR_ANONE', '2020-05-25', '08:46', 10),
(2427, 'Parasite_new_2020', 'OR_ANONE', '2020-05-26', '10:07', 10),
(2428, 'Parasite_new_2020', 'OR_ANONE', '2020-05-27', '09:04', 10),
(2429, 'Parasite_new_2020', 'OR_ANONE', '2020-05-28', '09:05', 10),
(2430, 'Parasite_new_2020', 'OR_ANONE', '2020-05-29', '09:06', 10),
(2431, 'Parasite_new_2020', 'OR_ANONE', '2020-05-30', '09:07', 10),
(2432, 'Parasite_new_2020', 'OR_ANONE', '2020-05-31', '09:08', 10),
(2434, 'Parasite_new_2020', 'OR_ANONE', '2020-06-02', '08:46', 10),
(2435, 'Parasite_new_2020', 'OR_ANONE', '2020-06-03', '08:47', 10),
(2436, 'Parasite_new_2020', 'OR_ANONE', '2020-06-04', '08:48', 10),
(2437, 'Parasite_new_2020', 'OR_ANONE', '2020-06-05', '08:49', 10),
(2438, 'Parasite_new_2020', 'OR_ANONE', '2020-06-06', '08:50', 10),
(2439, 'Parasite_new_2020', 'OR_ANONE', '2020-06-07', '08:51', 10),
(2440, 'Parasite_new_2020', 'OR_ANONE', '2020-06-08', '09:16', 10),
(2441, 'Parasite_new_2020', 'OR_ANONE', '2020-06-09', '09:17', 10),
(2442, 'Parasite_new_2020', 'OR_ANONE', '2020-06-10', '09:18', 10),
(2443, 'Parasite_new_2020', 'OR_ANONE', '2020-06-11', '09:19', 10),
(2444, 'Parasite_new_2020', 'OR_ANONE', '2020-06-12', '09:20', 10),
(2445, 'Parasite_new_2020', 'OR_ANONE', '2020-06-13', '09:21', 10),
(2446, 'Parasite_new_2020', 'OR_ANONE', '2020-06-14', '09:22', 10),
(2447, 'Parasite_new_2020', 'OR_ANONE', '2020-06-15', '09:23', 10),
(2448, 'Parasite_new_2020', 'OR_ANONE', '2020-06-16', '09:24', 10),
(2449, 'Parasite_new_2020', 'OR_ANONE', '2020-06-17', '09:25', 10),
(2450, 'Parasite_new_2020', 'OR_ANONE', '2020-06-18', '09:26', 10),
(2451, 'Parasite_new_2020', 'OR_ANONE', '2020-06-19', '09:27', 10),
(2452, 'Parasite_new_2020', 'OR_ANONE', '2020-06-20', '09:28', 10),
(2453, 'Parasite_new_2020', 'OR_ANONE', '2020-06-21', '09:29', 10),
(2454, 'Parasite_new_2020', 'OR_ANONE', '2020-06-22', '09:30', 10),
(2455, 'Parasite_new_2020', 'OR_ANONE', '2020-06-23', '09:31', 10),
(2456, 'Parasite_new_2020', 'OR_ANONE', '2020-06-24', '09:32', 10),
(2457, 'Parasite_new_2020', 'OR_ANONE', '2020-06-25', '11:33', 10),
(2458, 'Parasite_new_2020', 'OR_ANONE', '2020-06-26', '11:34', 10),
(2459, 'Parasite_new_2020', 'OR_ANONE', '2020-06-27', '11:35', 10),
(2460, 'Parasite_new_2020', 'OR_ANONE', '2020-06-28', '11:36', 10),
(2461, 'Parasite_new_2020', 'OR_ANONE', '2020-06-29', '09:37', 10),
(2462, 'Parasite_new_2020', 'OR_ANONE', '2020-06-30', '09:38', 10),
(2463, 'Parasite_new_2020', 'OR_ANONE', '2020-07-01', '09:39', 10),
(2464, 'Parasite_new_2020', 'OR_ANONE', '2020-07-02', '09:40', 10),
(2465, 'Parasite_new_2020', 'OR_ANONE', '2020-07-03', '09:41', 10),
(2466, 'Parasite_new_2020', 'OR_ANONE', '2020-07-04', '09:42', 10),
(2467, 'Parasite_new_2020', 'OR_ANONE', '2020-07-05', '09:43', 10),
(2468, 'Parasite_new_2020', 'OR_ANONE', '2020-07-06', '09:44', 10),
(2469, 'Parasite_new_2020', 'OR_ANONE', '2020-07-07', '09:45', 10),
(2470, 'Parasite_new_2020', 'OR_ANONE', '2020-05-21', '15:40', 10),
(2471, 'Parasite_new_2020', 'OR_ANONE', '2020-05-22', '16:15', 10),
(2472, 'Parasite_new_2020', 'OR_ANONE', '2020-05-23', '20:50', 10),
(2473, 'Parasite_new_2020', 'OR_ANONE', '2020-05-24', '22:02', 10),
(2474, 'Parasite_new_2020', 'OR_ANONE', '2020-05-25', '13:55', 10),
(2475, 'Parasite_new_2020', 'OR_ANONE', '2020-05-26', '15:41', 10),
(2476, 'Parasite_new_2020', 'OR_ANONE', '2020-05-27', '16:16', 10),
(2477, 'Parasite_new_2020', 'OR_ANONE', '2020-05-28', '20:51', 10),
(2478, 'Parasite_new_2020', 'OR_ANONE', '2020-05-29', '22:03', 10),
(2479, 'Parasite_new_2020', 'OR_ANONE', '2020-05-30', '13:56', 10),
(2480, 'Parasite_new_2020', 'OR_ANONE', '2020-05-31', '15:42', 10),
(2481, 'Parasite_new_2020', 'OR_ANONE', '2020-06-01', '16:17', 10),
(2482, 'Parasite_new_2020', 'OR_ANONE', '2020-06-02', '20:52', 10),
(2483, 'Parasite_new_2020', 'OR_ANONE', '2020-06-03', '22:04', 10),
(2484, 'Parasite_new_2020', 'OR_ANONE', '2020-06-04', '13:57', 10),
(2485, 'Parasite_new_2020', 'OR_ANONE', '2020-06-05', '15:43', 10),
(2486, 'Parasite_new_2020', 'OR_ANONE', '2020-06-06', '16:18', 10),
(2487, 'Parasite_new_2020', 'OR_ANONE', '2020-06-07', '20:53', 10),
(2488, 'Parasite_new_2020', 'OR_ANONE', '2020-06-08', '22:05', 10),
(2489, 'Parasite_new_2020', 'OR_ANONE', '2020-06-09', '13:58', 10),
(2490, 'Parasite_new_2020', 'OR_ANONE', '2020-06-10', '15:44', 10),
(2491, 'Parasite_new_2020', 'OR_ANONE', '2020-06-11', '16:19', 10),
(2492, 'Parasite_new_2020', 'OR_ANONE', '2020-06-12', '20:54', 10),
(2493, 'Parasite_new_2020', 'OR_ANONE', '2020-06-13', '22:06', 10),
(2494, 'Parasite_new_2020', 'OR_ANONE', '2020-06-14', '13:59', 10),
(2495, 'Parasite_new_2020', 'OR_ANONE', '2020-06-15', '15:45', 10),
(2496, 'Parasite_new_2020', 'OR_ANONE', '2020-06-16', '16:20', 10),
(2497, 'Parasite_new_2020', 'OR_ANONE', '2020-06-17', '20:55', 10),
(2498, 'Parasite_new_2020', 'OR_ANONE', '2020-06-18', '22:07', 10),
(2499, 'Parasite_new_2020', 'OR_ANONE', '2020-06-19', '13:60', 10),
(2500, 'Parasite_new_2020', 'OR_ANONE', '2020-06-20', '15:46', 10),
(2501, 'Parasite_new_2020', 'OR_ANONE', '2020-06-21', '16:21', 10),
(2502, 'Parasite_new_2020', 'OR_ANONE', '2020-06-22', '20:56', 10),
(2503, 'Parasite_new_2020', 'OR_ANONE', '2020-06-23', '22:08', 10),
(2504, 'Parasite_new_2020', 'OR_ANONE', '2020-06-24', '13:61', 10),
(2505, 'Parasite_new_2020', 'OR_ANONE', '2020-06-25', '15:47', 10),
(2506, 'Parasite_new_2020', 'OR_ANONE', '2020-06-26', '16:22', 10),
(2507, 'Parasite_new_2020', 'OR_ANONE', '2020-06-27', '20:57', 10),
(2508, 'Parasite_new_2020', 'OR_ANONE', '2020-06-28', '22:09', 10),
(2509, 'Parasite_new_2020', 'OR_ANONE', '2020-06-29', '13:62', 10),
(2510, 'Parasite_new_2020', 'OR_ANONE', '2020-06-30', '15:48', 10),
(2511, 'Parasite_new_2020', 'OR_ANONE', '2020-07-01', '16:23', 10),
(2512, 'Parasite_new_2020', 'OR_ANONE', '2020-07-02', '20:58', 10),
(2513, 'Parasite_new_2020', 'OR_ANONE', '2020-07-03', '22:10', 10),
(2514, 'Parasite_new_2020', 'OR_ANONE', '2020-07-04', '13:63', 10),
(2515, 'Parasite_new_2020', 'OR_ANONE', '2020-07-05', '15:49', 10),
(2516, 'Parasite_new_2020', 'OR_ANONE', '2020-07-06', '16:24', 10),
(2517, 'Parasite_new_2020', 'OR_ANONE', '2020-07-07', '20:59', 10),
(2518, 'Joker_re_2020', 'SD_ANONE', '2020-05-21', '10:02', 10),
(2519, 'Joker_re_2020', 'SD_ANONE', '2020-05-22', '11:34', 10),
(2520, 'Joker_re_2020', 'SD_ANONE', '2020-05-23', '10:07', 10),
(2521, 'Joker_re_2020', 'SD_ANONE', '2020-05-24', '09:44', 10),
(2522, 'Joker_re_2020', 'SD_ANONE', '2020-05-25', '09:19', 10),
(2523, 'Joker_re_2020', 'SD_ANONE', '2020-05-26', '09:39', 10),
(2524, 'Joker_re_2020', 'SD_ANONE', '2020-05-27', '10:04', 10),
(2525, 'Joker_re_2020', 'SD_ANONE', '2020-05-28', '09:21', 10),
(2526, 'Joker_re_2020', 'SD_ANONE', '2020-05-29', '09:18', 10),
(2527, 'Joker_re_2020', 'SD_ANONE', '2020-05-30', '08:50', 10),
(2528, 'Joker_re_2020', 'SD_ANONE', '2020-05-31', '10:03', 10),
(2529, 'Joker_re_2020', 'SD_ANONE', '2020-06-01', '08:48', 10),
(2530, 'Joker_re_2020', 'SD_ANONE', '2020-06-02', '09:08', 10),
(2531, 'Joker_re_2020', 'SD_ANONE', '2020-06-03', '09:05', 10),
(2532, 'Joker_re_2020', 'SD_ANONE', '2020-06-04', '09:23', 10),
(2533, 'Joker_re_2020', 'SD_ANONE', '2020-06-05', '09:24', 10),
(2534, 'Joker_re_2020', 'SD_ANONE', '2020-06-06', '09:07', 10),
(2535, 'Joker_re_2020', 'SD_ANONE', '2020-06-07', '09:30', 10),
(2536, 'Joker_re_2020', 'SD_ANONE', '2020-06-08', '12:05', 10),
(2537, 'Joker_re_2020', 'SD_ANONE', '2020-06-09', '11:35', 10),
(2538, 'Joker_re_2020', 'SD_ANONE', '2020-06-10', '09:16', 10),
(2539, 'Joker_re_2020', 'SD_ANONE', '2020-06-11', '09:43', 10),
(2540, 'Joker_re_2020', 'SD_ANONE', '2020-06-12', '08:49', 10),
(2541, 'Joker_re_2020', 'SD_ANONE', '2020-06-13', '09:09', 10),
(2542, 'Joker_re_2020', 'SD_ANONE', '2020-06-14', '09:41', 10),
(2543, 'Joker_re_2020', 'SD_ANONE', '2020-06-15', '08:46', 10),
(2544, 'Joker_re_2020', 'SD_ANONE', '2020-06-16', '09:25', 10),
(2545, 'Joker_re_2020', 'SD_ANONE', '2020-06-17', '09:17', 10),
(2546, 'Joker_re_2020', 'SD_ANONE', '2020-06-18', '09:26', 10),
(2547, 'Joker_re_2020', 'SD_ANONE', '2020-06-19', '09:28', 10),
(2548, 'Joker_re_2020', 'SD_ANONE', '2020-06-20', '09:04', 10),
(2549, 'Joker_re_2020', 'SD_ANONE', '2020-06-21', '09:45', 10),
(2550, 'Joker_re_2020', 'SD_ANONE', '2020-06-22', '09:42', 10),
(2551, 'Joker_re_2020', 'SD_ANONE', '2020-06-23', '09:38', 10),
(2552, 'Joker_re_2020', 'SD_ANONE', '2020-06-24', '09:40', 10),
(2553, 'Joker_re_2020', 'SD_ANONE', '2020-06-25', '09:20', 10),
(2554, 'Joker_re_2020', 'SD_ANONE', '2020-06-26', '09:29', 10),
(2555, 'Joker_re_2020', 'SD_ANONE', '2020-06-27', '11:33', 10),
(2556, 'Joker_re_2020', 'SD_ANONE', '2020-06-28', '09:37', 10),
(2557, 'Joker_re_2020', 'SD_ANONE', '2020-06-29', '09:06', 10),
(2558, 'Joker_re_2020', 'SD_ANONE', '2020-06-30', '08:46', 10),
(2559, 'Joker_re_2020', 'SD_ANONE', '2020-07-01', '11:36', 10),
(2560, 'Joker_re_2020', 'SD_ANONE', '2020-07-02', '09:27', 10),
(2561, 'Joker_re_2020', 'SD_ANONE', '2020-07-03', '08:47', 10),
(2562, 'Joker_re_2020', 'SD_ANONE', '2020-07-04', '09:22', 10),
(2563, 'Joker_re_2020', 'SD_ANONE', '2020-07-05', '09:32', 10),
(2564, 'Joker_re_2020', 'SD_ANONE', '2020-07-06', '08:51', 10),
(2565, 'Joker_re_2020', 'SD_ANONE', '2020-07-07', '09:31', 10),
(2566, 'Joker_re_2020', 'SD_ANONE', '2020-05-21', '15:40', 10),
(2567, 'Joker_re_2020', 'SD_ANONE', '2020-05-22', '15:43', 10),
(2568, 'Joker_re_2020', 'SD_ANONE', '2020-05-23', '16:20', 10),
(2569, 'Joker_re_2020', 'SD_ANONE', '2020-05-24', '15:49', 10),
(2570, 'Joker_re_2020', 'SD_ANONE', '2020-05-25', '20:52', 10),
(2571, 'Joker_re_2020', 'SD_ANONE', '2020-05-26', '16:18', 10),
(2572, 'Joker_re_2020', 'SD_ANONE', '2020-05-27', '16:24', 10),
(2573, 'Joker_re_2020', 'SD_ANONE', '2020-05-28', '20:50', 10),
(2574, 'Joker_re_2020', 'SD_ANONE', '2020-05-29', '15:42', 10),
(2575, 'Joker_re_2020', 'SD_ANONE', '2020-05-30', '20:58', 10),
(2576, 'Joker_re_2020', 'SD_ANONE', '2020-05-31', '22:06', 10),
(2577, 'Joker_re_2020', 'SD_ANONE', '2020-06-01', '22:05', 10),
(2578, 'Joker_re_2020', 'SD_ANONE', '2020-06-02', '20:56', 10),
(2579, 'Joker_re_2020', 'SD_ANONE', '2020-06-03', '13:56', 10),
(2580, 'Joker_re_2020', 'SD_ANONE', '2020-06-04', '20:53', 10),
(2581, 'Joker_re_2020', 'SD_ANONE', '2020-06-05', '22:10', 10),
(2582, 'Joker_re_2020', 'SD_ANONE', '2020-06-06', '20:51', 10),
(2583, 'Joker_re_2020', 'SD_ANONE', '2020-06-07', '15:47', 10),
(2584, 'Joker_re_2020', 'SD_ANONE', '2020-06-08', '15:48', 10),
(2585, 'Joker_re_2020', 'SD_ANONE', '2020-06-09', '13:55', 10),
(2586, 'Joker_re_2020', 'SD_ANONE', '2020-06-10', '13:58', 10),
(2587, 'Joker_re_2020', 'SD_ANONE', '2020-06-11', '22:07', 10),
(2588, 'Joker_re_2020', 'SD_ANONE', '2020-06-12', '20:55', 10),
(2589, 'Joker_re_2020', 'SD_ANONE', '2020-06-13', '16:23', 10),
(2590, 'Joker_re_2020', 'SD_ANONE', '2020-06-14', '13:57', 10),
(2591, 'Joker_re_2020', 'SD_ANONE', '2020-06-15', '15:41', 10),
(2592, 'Joker_re_2020', 'SD_ANONE', '2020-06-16', '13:59', 10),
(2593, 'Joker_re_2020', 'SD_ANONE', '2020-06-17', '16:16', 10),
(2594, 'Joker_re_2020', 'SD_ANONE', '2020-06-18', '13:63', 10),
(2595, 'Joker_re_2020', 'SD_ANONE', '2020-06-19', '15:45', 10),
(2596, 'Joker_re_2020', 'SD_ANONE', '2020-06-20', '20:59', 10),
(2597, 'Joker_re_2020', 'SD_ANONE', '2020-06-21', '13:60', 10),
(2598, 'Joker_re_2020', 'SD_ANONE', '2020-06-22', '16:21', 10),
(2599, 'Joker_re_2020', 'SD_ANONE', '2020-06-23', '22:09', 10),
(2600, 'Joker_re_2020', 'SD_ANONE', '2020-06-24', '15:46', 10),
(2601, 'Joker_re_2020', 'SD_ANONE', '2020-06-25', '20:54', 10),
(2602, 'Joker_re_2020', 'SD_ANONE', '2020-06-26', '16:19', 10),
(2603, 'Joker_re_2020', 'SD_ANONE', '2020-06-27', '22:02', 10),
(2604, 'Joker_re_2020', 'SD_ANONE', '2020-06-28', '13:62', 10),
(2605, 'Joker_re_2020', 'SD_ANONE', '2020-06-29', '16:17', 10),
(2606, 'Joker_re_2020', 'SD_ANONE', '2020-06-30', '16:15', 10),
(2607, 'Joker_re_2020', 'SD_ANONE', '2020-07-01', '22:03', 10),
(2608, 'Joker_re_2020', 'SD_ANONE', '2020-07-02', '22:04', 10),
(2609, 'Joker_re_2020', 'SD_ANONE', '2020-07-03', '13:61', 10),
(2610, 'Joker_re_2020', 'SD_ANONE', '2020-07-04', '20:57', 10),
(2611, 'Joker_re_2020', 'SD_ANONE', '2020-07-05', '22:08', 10),
(2612, 'Joker_re_2020', 'SD_ANONE', '2020-07-06', '16:22', 10),
(2613, 'Joker_re_2020', 'SD_ANONE', '2020-07-07', '15:44', 10),
(2614, 'Joker_re_2020', 'OR_ANONE', '2020-05-21', '10:02', 10),
(2615, 'Joker_re_2020', 'OR_ANONE', '2020-05-22', '08:49', 10),
(2616, 'Joker_re_2020', 'OR_ANONE', '2020-05-23', '09:24', 10),
(2617, 'Joker_re_2020', 'OR_ANONE', '2020-05-24', '09:43', 10),
(2618, 'Joker_re_2020', 'OR_ANONE', '2020-05-25', '08:46', 10),
(2619, 'Joker_re_2020', 'OR_ANONE', '2020-05-26', '08:50', 10),
(2620, 'Joker_re_2020', 'OR_ANONE', '2020-05-27', '09:44', 10),
(2621, 'Joker_re_2020', 'OR_ANONE', '2020-05-28', '10:04', 10),
(2622, 'Joker_re_2020', 'OR_ANONE', '2020-05-29', '09:08', 10),
(2623, 'Joker_re_2020', 'OR_ANONE', '2020-05-30', '09:40', 10),
(2624, 'Joker_re_2020', 'OR_ANONE', '2020-05-31', '09:21', 10),
(2625, 'Joker_re_2020', 'OR_ANONE', '2020-06-01', '09:16', 10),
(2626, 'Joker_re_2020', 'OR_ANONE', '2020-06-02', '09:30', 10),
(2627, 'Joker_re_2020', 'OR_ANONE', '2020-06-03', '09:07', 10),
(2628, 'Joker_re_2020', 'OR_ANONE', '2020-06-04', '08:51', 10),
(2629, 'Joker_re_2020', 'OR_ANONE', '2020-06-05', '09:41', 10),
(2630, 'Joker_re_2020', 'OR_ANONE', '2020-06-06', '09:05', 10),
(2631, 'Joker_re_2020', 'OR_ANONE', '2020-06-07', '11:33', 10),
(2632, 'Joker_re_2020', 'OR_ANONE', '2020-06-08', '09:38', 10),
(2633, 'Joker_re_2020', 'OR_ANONE', '2020-06-09', '08:46', 10),
(2634, 'Joker_re_2020', 'OR_ANONE', '2020-06-10', '09:17', 10),
(2635, 'Joker_re_2020', 'OR_ANONE', '2020-06-11', '09:26', 10),
(2636, 'Joker_re_2020', 'OR_ANONE', '2020-06-12', '09:25', 10),
(2637, 'Joker_re_2020', 'OR_ANONE', '2020-06-13', '09:39', 10),
(2638, 'Joker_re_2020', 'OR_ANONE', '2020-06-14', '08:48', 10),
(2639, 'Joker_re_2020', 'OR_ANONE', '2020-06-15', '10:07', 10),
(2640, 'Joker_re_2020', 'OR_ANONE', '2020-06-16', '09:22', 10),
(2641, 'Joker_re_2020', 'OR_ANONE', '2020-06-17', '09:04', 10),
(2642, 'Joker_re_2020', 'OR_ANONE', '2020-06-18', '09:42', 10),
(2643, 'Joker_re_2020', 'OR_ANONE', '2020-06-19', '09:23', 10),
(2644, 'Joker_re_2020', 'OR_ANONE', '2020-06-20', '09:45', 10),
(2645, 'Joker_re_2020', 'OR_ANONE', '2020-06-21', '09:27', 10),
(2646, 'Joker_re_2020', 'OR_ANONE', '2020-06-22', '09:29', 10),
(2647, 'Joker_re_2020', 'OR_ANONE', '2020-06-23', '11:36', 10),
(2648, 'Joker_re_2020', 'OR_ANONE', '2020-06-24', '09:28', 10),
(2649, 'Joker_re_2020', 'OR_ANONE', '2020-06-25', '09:20', 10),
(2650, 'Joker_re_2020', 'OR_ANONE', '2020-06-26', '09:19', 10),
(2651, 'Joker_re_2020', 'OR_ANONE', '2020-06-27', '12:05', 10),
(2652, 'Joker_re_2020', 'OR_ANONE', '2020-06-28', '09:37', 10),
(2653, 'Joker_re_2020', 'OR_ANONE', '2020-06-29', '09:09', 10),
(2654, 'Joker_re_2020', 'OR_ANONE', '2020-06-30', '10:03', 10),
(2655, 'Joker_re_2020', 'OR_ANONE', '2020-07-01', '09:06', 10),
(2656, 'Joker_re_2020', 'OR_ANONE', '2020-07-02', '08:47', 10),
(2657, 'Joker_re_2020', 'OR_ANONE', '2020-07-03', '09:32', 10),
(2658, 'Joker_re_2020', 'OR_ANONE', '2020-07-04', '11:35', 10),
(2659, 'Joker_re_2020', 'OR_ANONE', '2020-07-05', '09:31', 10),
(2660, 'Joker_re_2020', 'OR_ANONE', '2020-07-06', '11:34', 10),
(2661, 'Joker_re_2020', 'OR_ANONE', '2020-07-07', '09:18', 10),
(2662, 'Joker_re_2020', 'OR_ANONE', '2020-05-21', '15:40', 10),
(2663, 'Joker_re_2020', 'OR_ANONE', '2020-05-22', '15:43', 10),
(2664, 'Joker_re_2020', 'OR_ANONE', '2020-05-23', '16:20', 10),
(2665, 'Joker_re_2020', 'OR_ANONE', '2020-05-24', '15:49', 10),
(2666, 'Joker_re_2020', 'OR_ANONE', '2020-05-25', '20:52', 10),
(2667, 'Joker_re_2020', 'OR_ANONE', '2020-05-26', '16:18', 10),
(2668, 'Joker_re_2020', 'OR_ANONE', '2020-05-27', '16:24', 10),
(2669, 'Joker_re_2020', 'OR_ANONE', '2020-05-28', '20:50', 10),
(2670, 'Joker_re_2020', 'OR_ANONE', '2020-05-29', '15:42', 10),
(2671, 'Joker_re_2020', 'OR_ANONE', '2020-05-30', '20:58', 10),
(2672, 'Joker_re_2020', 'OR_ANONE', '2020-05-31', '22:06', 10),
(2673, 'Joker_re_2020', 'OR_ANONE', '2020-06-01', '22:05', 10),
(2674, 'Joker_re_2020', 'OR_ANONE', '2020-06-02', '20:56', 10),
(2675, 'Joker_re_2020', 'OR_ANONE', '2020-06-03', '13:56', 10),
(2676, 'Joker_re_2020', 'OR_ANONE', '2020-06-04', '20:53', 10),
(2677, 'Joker_re_2020', 'OR_ANONE', '2020-06-05', '22:10', 10),
(2678, 'Joker_re_2020', 'OR_ANONE', '2020-06-06', '20:51', 10),
(2679, 'Joker_re_2020', 'OR_ANONE', '2020-06-07', '15:47', 10),
(2680, 'Joker_re_2020', 'OR_ANONE', '2020-06-08', '15:48', 10),
(2681, 'Joker_re_2020', 'OR_ANONE', '2020-06-09', '13:55', 10),
(2682, 'Joker_re_2020', 'OR_ANONE', '2020-06-10', '13:58', 10),
(2683, 'Joker_re_2020', 'OR_ANONE', '2020-06-11', '22:07', 10),
(2684, 'Joker_re_2020', 'OR_ANONE', '2020-06-12', '20:55', 10),
(2685, 'Joker_re_2020', 'OR_ANONE', '2020-06-13', '16:23', 10),
(2686, 'Joker_re_2020', 'OR_ANONE', '2020-06-14', '13:57', 10),
(2687, 'Joker_re_2020', 'OR_ANONE', '2020-06-15', '15:41', 10),
(2688, 'Joker_re_2020', 'OR_ANONE', '2020-06-16', '13:59', 10),
(2689, 'Joker_re_2020', 'OR_ANONE', '2020-06-17', '16:16', 10),
(2690, 'Joker_re_2020', 'OR_ANONE', '2020-06-18', '13:63', 10),
(2691, 'Joker_re_2020', 'OR_ANONE', '2020-06-19', '15:45', 10),
(2692, 'Joker_re_2020', 'OR_ANONE', '2020-06-20', '20:59', 10),
(2693, 'Joker_re_2020', 'OR_ANONE', '2020-06-21', '13:60', 10),
(2694, 'Joker_re_2020', 'OR_ANONE', '2020-06-22', '16:21', 10),
(2695, 'Joker_re_2020', 'OR_ANONE', '2020-06-23', '22:09', 10),
(2696, 'Joker_re_2020', 'OR_ANONE', '2020-06-24', '15:46', 10),
(2697, 'Joker_re_2020', 'OR_ANONE', '2020-06-25', '20:54', 10),
(2698, 'Joker_re_2020', 'OR_ANONE', '2020-06-26', '16:19', 10),
(2699, 'Joker_re_2020', 'OR_ANONE', '2020-06-27', '22:02', 10),
(2700, 'Joker_re_2020', 'OR_ANONE', '2020-06-28', '13:62', 10),
(2701, 'Joker_re_2020', 'OR_ANONE', '2020-06-29', '16:17', 10),
(2702, 'Joker_re_2020', 'OR_ANONE', '2020-06-30', '16:15', 10),
(2703, 'Joker_re_2020', 'OR_ANONE', '2020-07-01', '22:03', 10),
(2704, 'Joker_re_2020', 'OR_ANONE', '2020-07-02', '22:04', 10),
(2705, 'Joker_re_2020', 'OR_ANONE', '2020-07-03', '13:61', 10),
(2706, 'Joker_re_2020', 'OR_ANONE', '2020-07-04', '20:57', 10),
(2707, 'Joker_re_2020', 'OR_ANONE', '2020-07-05', '22:08', 10),
(2708, 'Joker_re_2020', 'OR_ANONE', '2020-07-06', '16:22', 10),
(2709, 'Joker_re_2020', 'OR_ANONE', '2020-07-07', '15:44', 10),
(2710, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-21', '10:02', 10),
(2711, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-22', '11:34', 10),
(2712, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-23', '10:07', 10),
(2713, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-24', '09:44', 10),
(2714, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-25', '09:19', 10),
(2715, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-26', '09:39', 10),
(2716, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-27', '10:04', 10),
(2717, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-28', '09:21', 10),
(2718, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-29', '09:18', 10),
(2719, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-30', '08:50', 10),
(2720, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-31', '10:03', 10),
(2721, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-01', '08:48', 10),
(2722, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-02', '09:08', 10),
(2723, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-03', '09:05', 10),
(2724, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-04', '09:23', 10),
(2725, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-05', '09:24', 10),
(2726, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-06', '09:07', 10),
(2727, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-07', '09:30', 10),
(2728, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-08', '12:05', 10),
(2729, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-09', '11:35', 10),
(2730, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-10', '09:16', 10),
(2731, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-11', '09:43', 10),
(2732, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-12', '08:49', 10),
(2733, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-13', '09:09', 10),
(2734, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-14', '09:41', 10),
(2735, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-15', '08:46', 10),
(2736, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-16', '09:25', 10),
(2737, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-17', '09:17', 10),
(2738, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-18', '09:26', 10),
(2739, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-19', '09:28', 10),
(2740, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-20', '09:04', 10),
(2741, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-21', '09:45', 10),
(2742, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-22', '09:42', 10),
(2743, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-23', '09:38', 10),
(2744, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-24', '09:40', 10),
(2745, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-25', '09:20', 10),
(2746, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-26', '09:29', 10),
(2747, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-27', '11:33', 10),
(2748, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-28', '09:37', 10),
(2749, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-29', '09:06', 10),
(2750, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-30', '08:46', 10),
(2751, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-01', '11:36', 10),
(2752, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-02', '09:27', 10),
(2753, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-03', '08:47', 10),
(2754, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-04', '09:22', 10),
(2755, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-05', '09:32', 10),
(2756, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-06', '08:51', 10),
(2757, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-07', '09:31', 10),
(2758, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-21', '15:40', 10),
(2759, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-22', '15:43', 10),
(2760, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-23', '16:20', 10),
(2761, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-24', '15:49', 10),
(2762, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-25', '20:52', 10),
(2763, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-26', '16:18', 10),
(2764, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-27', '16:24', 10),
(2765, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-28', '20:50', 10),
(2766, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-29', '15:42', 10),
(2767, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-30', '20:58', 10),
(2768, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-05-31', '22:06', 10),
(2769, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-01', '22:05', 10),
(2770, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-02', '20:56', 10),
(2771, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-03', '13:56', 10),
(2772, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-04', '20:53', 10),
(2773, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-05', '22:10', 10),
(2774, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-06', '20:51', 10),
(2775, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-07', '15:47', 10),
(2776, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-08', '15:48', 10),
(2777, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-09', '13:55', 10),
(2778, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-10', '13:58', 10),
(2779, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-11', '22:07', 10),
(2780, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-12', '20:55', 10),
(2781, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-13', '16:23', 10),
(2782, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-14', '13:57', 10),
(2783, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-15', '15:41', 10),
(2784, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-16', '13:59', 10),
(2785, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-17', '16:16', 10),
(2786, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-18', '13:63', 10),
(2787, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-19', '15:45', 10),
(2788, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-20', '20:59', 10),
(2789, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-21', '13:60', 10),
(2790, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-22', '16:21', 10),
(2791, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-23', '22:09', 10),
(2792, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-24', '15:46', 10),
(2793, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-25', '20:54', 10),
(2794, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-26', '16:19', 10),
(2795, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-27', '22:02', 10),
(2796, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-28', '13:62', 10),
(2797, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-29', '16:17', 10),
(2798, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-06-30', '16:15', 10),
(2799, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-01', '22:03', 10),
(2800, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-02', '22:04', 10),
(2801, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-03', '13:61', 10),
(2802, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-04', '20:57', 10),
(2803, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-05', '22:08', 10),
(2804, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-06', '16:22', 10),
(2805, 'Maleficent,Mistress of Evil_re_2020', 'LA_ANONE', '2020-07-07', '15:44', 10),
(2806, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-21', '10:02', 10),
(2807, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-22', '08:49', 10),
(2808, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-23', '09:24', 10),
(2809, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-24', '09:43', 10),
(2810, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-25', '08:46', 10),
(2811, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-26', '08:50', 10),
(2812, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-27', '09:44', 10),
(2813, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-28', '10:04', 10),
(2814, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-29', '09:08', 10),
(2815, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-30', '09:40', 10),
(2816, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-31', '09:21', 10),
(2817, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-01', '09:16', 10),
(2818, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-02', '09:30', 10),
(2819, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-03', '09:07', 10),
(2820, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-04', '08:51', 10),
(2821, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-05', '09:41', 10),
(2822, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-06', '09:05', 10),
(2823, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-07', '11:33', 10),
(2824, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-08', '09:38', 10),
(2825, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-09', '08:46', 10),
(2826, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-10', '09:17', 10),
(2827, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-11', '09:26', 10),
(2828, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-12', '09:25', 10),
(2829, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-13', '09:39', 10),
(2830, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-14', '08:48', 10),
(2831, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-15', '10:07', 10),
(2832, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-16', '09:22', 10),
(2833, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-17', '09:04', 10),
(2834, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-18', '09:42', 10),
(2835, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-19', '09:23', 10),
(2836, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-20', '09:45', 10),
(2837, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-21', '09:27', 10),
(2838, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-22', '09:29', 10),
(2839, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-23', '11:36', 10),
(2840, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-24', '09:28', 10),
(2841, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-25', '09:20', 10),
(2842, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-26', '09:19', 10),
(2843, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-27', '12:05', 10),
(2844, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-28', '09:37', 10),
(2845, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-29', '09:09', 10);
INSERT INTO `films_schedule` (`schedule_id`, `film_id`, `location_id`, `movie_date`, `start_time`, `seat_available`) VALUES
(2846, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-30', '10:03', 10),
(2847, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-01', '09:06', 10),
(2848, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-02', '08:47', 10),
(2849, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-03', '09:32', 10),
(2850, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-04', '11:35', 10),
(2851, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-05', '09:31', 10),
(2852, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-06', '11:34', 10),
(2853, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-07', '09:18', 10),
(2854, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-21', '15:40', 10),
(2855, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-22', '15:43', 10),
(2856, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-23', '16:20', 10),
(2857, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-24', '15:49', 10),
(2858, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-25', '20:52', 10),
(2859, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-26', '16:18', 10),
(2860, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-27', '16:24', 10),
(2861, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-28', '20:50', 10),
(2862, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-29', '15:42', 10),
(2863, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-30', '20:58', 10),
(2864, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-05-31', '22:06', 10),
(2865, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-01', '22:05', 10),
(2866, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-02', '20:56', 10),
(2867, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-03', '13:56', 10),
(2868, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-04', '20:53', 10),
(2869, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-05', '22:10', 10),
(2870, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-06', '20:51', 10),
(2871, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-07', '15:47', 10),
(2872, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-08', '15:48', 10),
(2873, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-09', '13:55', 10),
(2874, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-10', '13:58', 10),
(2875, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-11', '22:07', 10),
(2876, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-12', '20:55', 10),
(2877, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-13', '16:23', 10),
(2878, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-14', '13:57', 10),
(2879, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-15', '15:41', 10),
(2880, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-16', '13:59', 10),
(2881, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-17', '16:16', 10),
(2882, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-18', '13:63', 10),
(2883, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-19', '15:45', 10),
(2884, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-20', '20:59', 10),
(2885, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-21', '13:60', 10),
(2886, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-22', '16:21', 10),
(2887, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-23', '22:09', 10),
(2888, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-24', '15:46', 10),
(2889, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-25', '20:54', 10),
(2890, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-26', '16:19', 10),
(2891, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-27', '22:02', 10),
(2892, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-28', '13:62', 10),
(2893, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-29', '16:17', 10),
(2894, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-06-30', '16:15', 10),
(2895, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-01', '22:03', 10),
(2896, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-02', '22:04', 10),
(2897, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-03', '13:61', 10),
(2898, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-04', '20:57', 10),
(2899, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-05', '22:08', 10),
(2900, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-06', '16:22', 10),
(2901, 'Maleficent,Mistress of Evil_re_2020', 'OR_ANONE', '2020-07-07', '15:44', 10),
(2902, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-21', '10:02', 10),
(2903, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-22', '11:34', 10),
(2904, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-23', '10:07', 10),
(2905, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-24', '09:44', 10),
(2906, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-25', '09:19', 10),
(2907, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-26', '09:39', 10),
(2908, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-27', '10:04', 10),
(2909, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-28', '09:21', 10),
(2910, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-29', '09:18', 10),
(2911, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-30', '08:50', 10),
(2912, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-31', '10:03', 10),
(2913, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-01', '08:48', 10),
(2914, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-02', '09:08', 10),
(2915, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-03', '09:05', 10),
(2916, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-04', '09:23', 10),
(2917, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-05', '09:24', 10),
(2918, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-06', '09:07', 10),
(2919, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-07', '09:30', 10),
(2920, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-08', '12:05', 10),
(2921, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-09', '11:35', 10),
(2922, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-10', '09:16', 10),
(2923, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-11', '09:43', 10),
(2924, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-12', '08:49', 10),
(2925, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-13', '09:09', 10),
(2926, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-14', '09:41', 10),
(2927, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-15', '08:46', 10),
(2928, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-16', '09:25', 10),
(2929, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-17', '09:17', 10),
(2930, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-18', '09:26', 10),
(2931, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-19', '09:28', 10),
(2932, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-20', '09:04', 10),
(2933, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-21', '09:45', 10),
(2934, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-22', '09:42', 10),
(2935, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-23', '09:38', 10),
(2936, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-24', '09:40', 10),
(2937, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-25', '09:20', 10),
(2938, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-26', '09:29', 10),
(2939, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-27', '11:33', 10),
(2940, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-28', '09:37', 10),
(2941, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-29', '09:06', 10),
(2942, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-30', '08:46', 10),
(2943, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-01', '11:36', 10),
(2944, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-02', '09:27', 10),
(2945, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-03', '08:47', 10),
(2946, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-04', '09:22', 10),
(2947, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-05', '09:32', 10),
(2948, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-06', '08:51', 10),
(2949, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-07', '09:31', 10),
(2950, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-21', '15:40', 10),
(2951, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-22', '15:43', 10),
(2952, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-23', '16:20', 10),
(2953, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-24', '15:49', 10),
(2954, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-25', '20:52', 10),
(2955, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-26', '16:18', 10),
(2956, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-27', '16:24', 10),
(2957, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-28', '20:50', 10),
(2958, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-29', '15:42', 10),
(2959, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-30', '20:58', 10),
(2960, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-05-31', '22:06', 10),
(2961, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-01', '22:05', 10),
(2962, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-02', '20:56', 10),
(2963, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-03', '13:56', 10),
(2964, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-04', '20:53', 10),
(2965, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-05', '22:10', 10),
(2966, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-06', '20:51', 10),
(2967, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-07', '15:47', 10),
(2968, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-08', '15:48', 10),
(2969, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-09', '13:55', 10),
(2970, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-10', '13:58', 10),
(2971, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-11', '22:07', 10),
(2972, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-12', '20:55', 10),
(2973, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-13', '16:23', 10),
(2974, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-14', '13:57', 10),
(2975, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-15', '15:41', 10),
(2976, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-16', '13:59', 10),
(2977, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-17', '16:16', 10),
(2978, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-18', '13:63', 10),
(2979, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-19', '15:45', 10),
(2980, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-20', '20:59', 10),
(2981, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-21', '13:60', 10),
(2982, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-22', '16:21', 10),
(2983, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-23', '22:09', 10),
(2984, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-24', '15:46', 10),
(2985, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-25', '20:54', 10),
(2986, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-26', '16:19', 10),
(2987, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-27', '22:02', 10),
(2988, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-28', '13:62', 10),
(2989, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-29', '16:17', 10),
(2990, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-06-30', '16:15', 10),
(2991, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-01', '22:03', 10),
(2992, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-02', '22:04', 10),
(2993, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-03', '13:61', 10),
(2994, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-04', '20:57', 10),
(2995, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-05', '22:08', 10),
(2996, 'Maleficent,Mistress of Evil_re_2020', 'SD_ANONE', '2020-07-06', '16:22', 10),
(2997, 'Avengers,Endgame_re_2020', 'SD_ANONE', '2020-09-01', '23:55', 10);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zipcode` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `address`, `city`, `state`, `zipcode`) VALUES
('LA_ANONE', '625 S Kingsley Dr.', 'Los Angeles', 'CA', '90005'),
('OR_ANONE', '2016 Airport Rd', 'Pendleton', 'OR', '97801'),
('SD_ANONE', '9500 Gilman Dr', 'La Jolla', 'CA', '92093');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_email`, `order_quantity`, `order_date`, `order_price`) VALUES
(1, 'jane@smith.com', 3, '2020-06-04', 165),
(2, 'jane@smith.com', 3, '2020-06-04', 165),
(3, 'john@doe.com', 2, '2020-06-04', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `ticket_type` varchar(255) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `schedule_id`, `ticket_type`, `ticket_price`, `order_id`) VALUES
(1, 2272, 'Special', 55, 1),
(2, 2272, 'Special', 55, 1),
(3, 2272, 'Special', 55, 1),
(4, 2292, 'Special', 55, 2),
(5, 2292, 'Special', 55, 2),
(6, 2292, 'Special', 55, 2),
(7, 2388, 'Regular', 50, 3),
(8, 2388, 'Regular', 50, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_email`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `films_schedule`
--
ALTER TABLE `films_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_customer_email_orders` (`customer_email`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_order_id_tickets` (`order_id`),
  ADD KEY `fk_schedule_id_tickets` (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `films_schedule`
--
ALTER TABLE `films_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_customer_email_orders` FOREIGN KEY (`customer_email`) REFERENCES `customers` (`customer_email`);

--
-- Constraints for table `films_schedule`
--
  ALTER TABLE `films_schedule`
  ADD CONSTRAINT `fk_film_id_fs` FOREIGN KEY (`film_id`) REFERENCES `films` (`film_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_location_id_fs` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);
  
--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_order_id_tickets` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_schedule_id_tickets` FOREIGN KEY (`schedule_id`) REFERENCES `films_schedule` (`schedule_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
