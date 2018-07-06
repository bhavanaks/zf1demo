-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2018 at 08:05 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kidb_category`
--

CREATE TABLE `kidb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kidb_category`
--

INSERT INTO `kidb_category` (`id`, `category_name`, `status`) VALUES
(1, 'Error', 1),
(2, 'Logical change', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kidb_serviceline`
--

CREATE TABLE `kidb_serviceline` (
  `id` int(11) NOT NULL,
  `serviceline_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kidb_serviceline`
--

INSERT INTO `kidb_serviceline` (`id`, `serviceline_name`, `status`) VALUES
(1, 'flexware', 1),
(2, 'vpn', 1),
(3, 'avpn', 1),
(4, 'wnax', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kidb_solution`
--

CREATE TABLE `kidb_solution` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `serviceline_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_description` varchar(25) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `solution` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kidb_solution`
--

INSERT INTO `kidb_solution` (`id`, `ticket_number`, `serviceline_id`, `category_id`, `short_description`, `description`, `solution`, `user_id`, `last_updated`) VALUES
(1, '001', 1, 1, 'WANX and BGP on the LAN', 'the BGP MACD test case was successful this morning. So when adding a BGP peer on the LAN on a uCPE that has a WANx...we need to select the VPN1-VWI interface as the BGP Neighbor related interface. NCS will now recognize this and configure the device properly. It will also be pulled back into SDN-GP when we do a \"load from NCS\" on this device after that initial change goes in...previously it was not pulling that interface name back into SDN-GP from NCS. We will need to get this added to our WANx documentation.  \r\n', 'hey chris... this is known issue... same applies for static routes etc... this should be fixed in the next release', 1, '2018-06-05 10:32:02'),
(2, '002', 2, 1, '400 bad request', '400 bad request', '- Disable netflow. - For all vRouter routing protocols, check if there are multiple \"No\" for the field \"auto-summary\". If there is, make sure the first \"No\" is selected. - Make sure NM subnet in uCPE is a subnet, not an IP address. Next-hop of static routes are broken.', 2, '2018-06-05 10:32:02'),
(3, '003', 3, 1, 'Custom Hostnames', 'Custom Hostnames\r\n', 'vFW custom hostname needs to be 18 characters with 3 dashes. The example given by the FW team was \"fgt-abcd-ucpe-fw01\r\n\r\nyw as long as it is 18 characters with the 3 dashes then should be good. The key is the dashes and the length to make sure SDN-GP and other tools will accept that format ', 3, '2018-06-05 10:32:02'),
(4, '004', 1, 2, 'sd1', 'd1', 's1', NULL, '2018-07-05 07:54:55'),
(5, '005', 2, 2, 'sd2', 'd2', 's2', NULL, '2018-07-05 07:58:26'),
(7, '006', 1, 2, 's4', 'd4', 's4', NULL, '2018-07-05 09:10:16'),
(8, '007', 4, 1, 'eqwe', 'qwe', 'qweq', NULL, '2018-07-05 09:12:13'),
(9, '008', 3, 1, 'qwq', 'wqwe', 'qweqwe', NULL, '2018-07-05 09:15:28'),
(10, '010', 1, 1, 'qweqw', 'qweq', 'eqwe', NULL, '2018-07-05 09:24:36'),
(11, '009', 1, 1, 'qwe', 'qwe', 'qweqw', NULL, '2018-07-05 09:27:24'),
(12, '011', 3, 1, 'asdasd', 'sadasd', 'adasd', NULL, '2018-07-05 09:28:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kidb_category`
--
ALTER TABLE `kidb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kidb_serviceline`
--
ALTER TABLE `kidb_serviceline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kidb_solution`
--
ALTER TABLE `kidb_solution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_serviceline` (`serviceline_id`),
  ADD KEY `fk_categoryid` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kidb_category`
--
ALTER TABLE `kidb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kidb_serviceline`
--
ALTER TABLE `kidb_serviceline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kidb_solution`
--
ALTER TABLE `kidb_solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kidb_solution`
--
ALTER TABLE `kidb_solution`
  ADD CONSTRAINT `fk_categoryid` FOREIGN KEY (`category_id`) REFERENCES `kidb_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_serviceline` FOREIGN KEY (`serviceline_id`) REFERENCES `kidb_serviceline` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
