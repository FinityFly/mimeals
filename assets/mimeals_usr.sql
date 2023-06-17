-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 07:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mimeals_usr`
--

-- --------------------------------------------------------

--
-- Table structure for table `addedrecipes`
--

CREATE TABLE `addedrecipes` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `recipeId` text NOT NULL,
  `recipeTitle` text NOT NULL,
  `recipeImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plannedmeals`
--

CREATE TABLE `plannedmeals` (
  `id` int(11) NOT NULL,
  `userId` text NOT NULL,
  `recipeId` text NOT NULL,
  `recipeTitle` text NOT NULL,
  `recipeImage` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipecache`
--

CREATE TABLE `recipecache` (
  `id` int(11) NOT NULL,
  `userID` text NOT NULL,
  `userName` text NOT NULL,
  `recipeTitle` text NOT NULL,
  `recipeDescription` text NOT NULL,
  `prepTime` text NOT NULL,
  `cookTime` text NOT NULL,
  `totalTime` text NOT NULL,
  `ingredients` text NOT NULL,
  `numServings` text NOT NULL,
  `priceServing` text NOT NULL,
  `instructions` text NOT NULL,
  `dairyFree` text NOT NULL,
  `glutenFree` text NOT NULL,
  `vegan` text NOT NULL,
  `vegetarian` text NOT NULL,
  `lowFODMAP` text NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='stores user credentials';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addedrecipes`
--
ALTER TABLE `addedrecipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plannedmeals`
--
ALTER TABLE `plannedmeals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipecache`
--
ALTER TABLE `recipecache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addedrecipes`
--
ALTER TABLE `addedrecipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `plannedmeals`
--
ALTER TABLE `plannedmeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipecache`
--
ALTER TABLE `recipecache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
