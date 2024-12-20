-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 10:37 AM
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
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `username`, `comment`, `created_at`) VALUES
(1, 2, 'alex', 'Nice', '2024-06-14 14:44:21'),
(2, 0, 'alex', 'Helpful', '2024-06-14 14:45:17'),
(4, 0, 'Neha', 'Good Course', '2024-06-14 14:46:35'),
(5, 0, 'Test', 'It very helpful to me', '2024-06-15 08:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `image`, `user_id`) VALUES
(19, 'Threat Detection and Prevention', 'Implementing advanced tools and techniques to identify and mitigate potential cyber threats before they can cause significant harm. This includes using firewalls, intrusion detection systems, and antivirus software to protect against malware, ransomware, and other malicious activities.', '2024-06-15 08:30:32', 'images.jfif', 1),
(20, 'Data Encryption and Privacy', 'Ensuring that sensitive data is encrypted both in transit and at rest to prevent unauthorized access. This involves using strong encryption algorithms and secure communication protocols to protect personal and corporate information from cybercriminals.', '2024-06-15 08:31:44', 'download (1).jfif', 1),
(21, 'Access Control and Authentication', 'Establishing robust access control mechanisms to ensure that only authorized users can access critical systems and data. This includes implementing multi-factor authentication (MFA), role-based access control (RBAC), and regular audits of access rights to maintain a secure environment.', '2024-06-15 08:32:27', 'download.jfif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'alex', '$2y$10$JZGrozfVio47dLKKZ9LsNORkGBhmYnCCwK/28Yf1UtRPVt5Sl1Mni'),
(2, 'Neha', '$2y$10$Mx9rYICJzs1EIlERW1fTZekSHHvazPmaYHriFE0sIc6EYZPK3rxY6'),
(4, 'qw', '$2y$10$je.E00SnH7IKyFrBbnJoFueVxLp/h00bUF0UZSziqmVSxNQb4HbHm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
