-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 09:04 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caht`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `meg_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `other` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` varchar(70) NOT NULL,
  `meg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`meg_id`, `sender`, `other`, `content`, `status`, `meg_date`) VALUES
(20, 2, 3, 'helllo', '0', '2020-09-12 16:58:17'),
(21, 3, 2, 'ail', '0', '2020-09-12 17:01:01'),
(22, 3, 2, 'mahmoud', '0', '2020-09-12 17:05:28'),
(23, 2, 3, 'mahmoud', '0', '2020-09-12 17:06:49'),
(24, 3, 2, 'hi', '0', '2020-09-12 17:07:44'),
(25, 2, 3, 'how are you ail', '0', '2020-09-12 17:22:20'),
(26, 3, 2, 'i,m fine mahmoud', '0', '2020-09-12 17:22:49'),
(27, 3, 2, 'can i help you with homework mahmoud', '0', '2020-09-12 17:24:32'),
(28, 2, 3, 'yes ail but not now please', '0', '2020-09-12 17:24:59'),
(29, 2, 4, 'hi medhat ', '0', '2020-09-12 17:26:31'),
(30, 4, 2, 'i,m fine mahmoud', '0', '2020-09-12 17:27:35'),
(31, 2, 4, 'helllo', '0', '2020-09-12 18:04:17'),
(32, 4, 2, 'hello thanx', '0', '2020-09-12 18:05:24'),
(33, 2, 4, 'how are you sir', '0', '2020-09-12 18:05:39'),
(34, 2, 4, 'can i,m help yhou', '0', '2020-09-12 18:05:47'),
(35, 2, 4, 'send me sheet 7 ', '0', '2020-09-12 18:06:00'),
(36, 2, 4, 'every body', '0', '2020-09-12 18:06:50'),
(37, 4, 2, 'helllo', '0', '2020-09-12 18:07:08'),
(38, 4, 2, 'helllo', '0', '2020-09-12 18:07:10'),
(39, 4, 2, 'every body is happy of you', '0', '2020-09-12 18:10:16'),
(40, 3, 6, 'hi mohmmed', '0', '2020-09-13 11:34:32'),
(41, 2, 5, 'hi mai', '0', '2020-09-13 15:40:41'),
(42, 2, 3, 'hello aik', '0', '2020-09-13 16:52:14'),
(43, 2, 3, 'how are you ?? ', '0', '2020-09-13 16:52:25'),
(44, 3, 2, 'i,m fine thanx mahmoud', '0', '2020-09-13 16:52:48'),
(45, 3, 2, 'can you goo to club today after university', '0', '2020-09-13 16:53:50'),
(46, 2, 3, 'OK', '0', '2020-09-13 16:54:04'),
(47, 7, 2, 'hi mahmoud', '0', '2020-09-14 15:04:40'),
(48, 2, 7, 'how are you mostafa ', '0', '2020-09-14 15:05:38'),
(49, 2, 7, 'can i help you', '0', '2020-09-14 15:05:52'),
(50, 7, 2, 'no bro ', '0', '2020-09-14 15:06:25'),
(51, 2, 7, 'i,m leave chating room beacuse mam call me', '0', '2020-09-14 15:07:31'),
(52, 7, 2, 'yes ', '0', '2020-09-14 15:07:44'),
(53, 2, 7, ':)', '0', '2020-09-14 15:07:55'),
(54, 2, 7, ':)', '0', '2020-09-14 15:08:01'),
(55, 2, 6, 'hi mohmmed', '0', '2020-09-14 15:33:29'),
(56, 6, 2, 'hi mahmoud', '0', '2020-09-14 15:37:48'),
(57, 9, 5, 'hi mai ', '0', '2020-09-14 22:24:07'),
(61, 11, 3, 'hi ail ', '0', '2020-09-14 23:35:23'),
(62, 11, 3, 'hi how are you', '0', '2020-09-14 23:35:32'),
(63, 11, 3, 'can i help you', '0', '2020-09-14 23:35:42'),
(64, 11, 2, 'hello mahmoud', '0', '2020-09-14 23:37:34'),
(65, 2, 11, 'hello nade', '0', '2020-09-14 23:38:00'),
(66, 12, 2, 'hi mahmoud', '0', '2020-09-15 12:53:54'),
(67, 12, 2, 'how are you', '0', '2020-09-15 12:54:06'),
(68, 12, 5, 'hi mai', '0', '2020-09-15 12:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_forgot` int(11) DEFAULT NULL,
  `user_country` int(11) NOT NULL,
  `user_gender` tinyint(1) NOT NULL,
  `user_date` date NOT NULL,
  `login` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_image`, `user_forgot`, `user_country`, `user_gender`, `user_date`, `login`) VALUES
(2, 'mahmoud khairy', 'mahmoud@gmail.com', '123', '581_81765865_2579960068902788_2040475620151918592_n.jpg', 20, 3, 1, '2020-09-11', 'online'),
(3, 'ail', 'ail@gmail.com', '2276218', '30_82828660_3140275926006272_3917737681282400256_n.jpg', 10, 2, 1, '2020-09-11', 'offline'),
(4, 'medhat ahmed', 'medhat@gmail.com', '123', '904_82815859_862439140874122_4396091171407921152_n.jpg', 0, 4, 1, '2020-09-11', 'offline'),
(5, 'mai', 'mai@gmail.com', '123', '145_83091688_179585170083892_9103006673601036288_n.jpg', 0, 6, 2, '2020-09-11', 'online'),
(6, 'mohmmed ahmed', 'moh@gmail.com', '123', '121_81742794_478388032824724_7061326396726968320_n.jpg', 0, 1, 1, '2020-09-11', 'offline'),
(7, 'mostafa', 'mos@gmail.com', '123', '905_83005279_872084589910020_4674046976470286336_n.jpg', 0, 5, 1, '2020-09-11', 'offline'),
(8, 'marwa', 'marwa@gmail.com', '123', '558_82438617_140987980694049_8982196944440918016_n.jpg', 0, 1, 2, '2020-09-11', 'offline'),
(9, 'ahmed elsayed', 'ahmed123@gmail.com', '123456', '494_69258451_488202801958431_462082642179784704_n.jpg', 30, 3, 1, '2020-09-14', 'offline'),
(11, 'nade mahmoud', 'nade@gmail.com', '123', '437_69258451_488202801958431_462082642179784704_n.jpg', 30, 3, 2, '2020-09-14', 'offline'),
(12, 'amr mahmoud', 'amr@gmail.com', '123', '59_69258451_488202801958431_462082642179784704_n.jpg', 30, 4, 1, '2020-09-15', 'online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`meg_id`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `meg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
