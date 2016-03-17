-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 17, 2016 at 01:45 PM
-- Server version: 5.5.42
-- PHP Version: 5.4.42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `znamke_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE `uporabniki` (
  `uporabnikID` int(5) NOT NULL,
  `uporabnisko_ime` varchar(25) NOT NULL,
  `geslo` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `priimek` varchar(35) NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `posta` varchar(25) NOT NULL,
  `telefonska` varchar(25) NOT NULL,
  `spol` varchar(20) NOT NULL,
  `starost` varchar(3) NOT NULL,
  `aktiviran` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`uporabnikID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uporabnisko_ime` (`uporabnisko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `uporabnikID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
