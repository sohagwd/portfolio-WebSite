-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 10:16 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sohag`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `about_desc` text NOT NULL,
  `about_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `about_img` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `about_desc`, `about_status`, `user_id`, `about_img`, `created_at`) VALUES
(15, 'Those who develop both client and server software are considered full stack web developers. Also knows how to program a browser (using JavaScript, or jQuery) and a server (using PHP).', 1, 146, '15.png', '2022-08-22 04:26:34 am');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `info` text NOT NULL,
  `office_add` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `office_city` varchar(150) DEFAULT NULL,
  `city_num` int(11) DEFAULT NULL,
  `city_add` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `info`, `office_add`, `number`, `email`, `office_city`, `city_num`, `city_add`, `created_at`) VALUES
(10, 'Asperiores deserunt', 'Mohammadpur, Dhaka-1207', 1302979002, 'sohag.wd.bd@gmail.com', 'Dhaka', 1302979002, 'Mohammadpur, Dhaka-1207', '2022-08-22 04:34:21 am');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `first_title` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button` varchar(255) NOT NULL,
  `banner_img` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `first_title`, `title`, `description`, `button`, `banner_img`, `status`, `created_at`) VALUES
(8, 'Hello!', 'I\'m Md.Sohag', 'I\'m a professional full stack web developer.', 'Check Out My Portfollio', '8.png', 1, '2022-08-22 04:21:38 am');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_img` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_img`, `created_at`) VALUES
(18, '18.png', '2022-08-22 04:32:11 am'),
(19, '19.png', '2022-08-22 04:32:16 am'),
(20, '20.png', '2022-08-22 04:32:21 am'),
(21, '21.png', '2022-08-22 04:32:33 am'),
(22, '22.png', '2022-08-23 07:21:52 am'),
(23, '23.png', '2022-08-23 07:22:01 am'),
(24, '24.png', '2022-08-23 07:22:07 am');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `percent` int(11) NOT NULL,
  `years` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `subject`, `percent`, `years`, `status`, `user_id`, `created_at`) VALUES
(18, 'Deploma in Engineering (5th Semester Running)', 73, 2019, 1, 146, '2022-08-22 04:26:51 am'),
(19, 'H.S.C', 70, 2020, 1, 146, '2022-08-22 04:27:15 am'),
(20, 'S.S.C', 67, 2017, 1, 146, '2022-08-22 04:27:27 am');

-- --------------------------------------------------------

--
-- Table structure for table `facts`
--

CREATE TABLE `facts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `icon` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facts`
--

INSERT INTO `facts` (`id`, `title`, `number`, `icon`, `created_at`) VALUES
(2, 'Feature Item', 245, 'fas fa-award', '2021-12-28 09:23:30 pm'),
(3, 'Active Products', 345, 'far fa-thumbs-up', '2021-12-28 09:24:54 pm'),
(4, 'Year Experience', 39, 'far fa-calendar-minus', '2021-12-28 09:27:16 pm'),
(5, 'Our Clients', 3000, 'fas fa-users', '2021-12-28 10:39:51 pm'),
(6, 'Project', 56, 'fas fa-project-diagram', '2021-12-28 10:36:09 pm');

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE `icons` (
  `id` int(11) NOT NULL,
  `icon_code` varchar(200) NOT NULL,
  `created_at` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`id`, `icon_code`, `created_at`) VALUES
(2, '&#xf09a;', '2021-12-24 11:55:14 am'),
(3, '&#xf099;', '2021-12-24 11:55:55 am'),
(4, '&#xf16d;', '2021-12-24 12:52:34 pm'),
(18, '&#xf0d2;', '2021-12-24 12:53:22 pm'),
(19, '&#xf08c;', '2021-12-24 12:54:20 pm'),
(20, '&#xf232;', '2021-12-24 12:55:49 pm'),
(21, '&#xf0d5;', '2021-12-24 12:56:22 pm'),
(22, 'ghj', '2022-08-02 02:33:45 pm');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo_name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `img_cat` int(11) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `logo_name`, `status`, `img_cat`, `created_at`) VALUES
(17, '17.png', 1, 1, '2022-08-22 04:19:16 am'),
(18, '18.png', 1, 2, '2022-08-22 05:21:18 pm');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `status`, `created_at`) VALUES
(1, 'home', '#home', 1, '2022-08-19 08:52:22 pm'),
(2, 'about', '#about', 1, '2022-08-19 08:52:27 pm'),
(3, 'service', '#service', 1, '2022-08-19 08:52:30 pm'),
(4, 'portfolio', '#portfolio', 1, '2022-08-19 08:52:36 pm'),
(5, 'contact', '#contact', 1, '2022-08-19 08:52:42 pm'),
(6, 'blog', '#', 0, '2022-08-19 08:52:48 pm');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(105) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `desc_title` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_comment` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `desc_title`, `descr`, `category`, `title`, `img`, `status`, `user_id`, `user_comment`, `created_at`) VALUES
(20, 'Web Design', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'Web Code', 'Coding', '20.jpg', 1, 146, 'More Information', '2022-08-23 06:59:37 am'),
(21, 'PSD Template', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'PSD ', 'PSD Template', '21.jpg', 1, 146, 'More Information', '2022-08-23 07:04:09 am'),
(22, 'website', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'Design', 'website', '22.jpg', 1, 146, 'More Information', '2022-08-23 07:07:51 am'),
(23, 'Graphic Design', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'Design', 'Graphic Design', '23.jpg', 1, 146, '	\r\nMore Information', '2022-08-23 07:10:19 am'),
(24, 'Mobile Application', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'apps', 'Mobile Application', '24.jpg', 1, 146, 'More Information', '2022-08-23 07:13:45 am'),
(25, 'youtube content creator', '<p><span style=\"font-weight: bolder; color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">Lorem Ipsum</span><span style=\"color: rgb(115, 124, 133); font-size: 16px; background-color: rgba(0, 0, 0, 0.075);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span><br></p>', 'youtube ', 'youtube content creator', '25.svg', 1, 146, 'More Information', '2022-08-23 07:17:32 am');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_desc` text NOT NULL,
  `service_icon` text DEFAULT NULL,
  `service_status` int(11) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_title`, `service_desc`, `service_icon`, `service_status`, `created_at`) VALUES
(1, 'web Design', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 'fas fa-desktop', 1, '2022-08-22 04:30:06 am'),
(4, 'PSD Template', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the', 'fas fa-paint-brush', 1, '2022-08-19 08:57:00 pm'),
(5, 'Mobile Application', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum indust.', 'fas fa-mobile', 1, '2022-08-19 08:57:55 pm'),
(7, 'Graphic Design', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum indust.', 'fas fa-crop', 1, '2022-08-19 08:59:43 pm'),
(8, 'Video Editing', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum indust.', 'fas fa-film', 1, '2022-08-19 09:00:44 pm'),
(9, 'Video Capture', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum indust.', 'fas fa-video', 1, '2022-08-19 09:01:17 pm');

-- --------------------------------------------------------

--
-- Table structure for table `social_icons`
--

CREATE TABLE `social_icons` (
  `id` int(11) NOT NULL,
  `icons_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_icons`
--

INSERT INTO `social_icons` (`id`, `icons_id`, `link`, `created_at`) VALUES
(2, 2, 'https://www.facebook.com/mdsohagwebdesigner', '2022-08-20 04:49:07 am'),
(6, 4, 'https://www.instagram.com/justnirjonhasan', '2022-08-19 08:50:46 pm'),
(7, 20, 'https://wa.me/+8801740737837', '2022-08-19 09:04:43 pm'),
(9, 3, 'https://twitter.com/?lang=en', '2022-08-20 04:48:13 am');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quotes` text NOT NULL,
  `img` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `quotes`, `img`, `created_at`) VALUES
(8, 'John', 'An event is a message sent by an object to signal the occur rence of an action. The action can causd user interaction such as a button click, or it can result', '8.jpg', '2022-08-19 09:06:47 pm'),
(9, 'Michael', 'An event is a message sent by an object to signal the occur rence of an action. The action can causd user interaction such as a button click, or it can result', '9.png', '2022-08-19 09:06:52 pm'),
(10, 'Daniel', 'An event is a message sent by an object to signal the occur rence of an action. The action can causd user interaction such as a button click, or it can result', '10.jpg', '2022-08-19 09:06:56 pm'),
(16, 'Lila Casey', 'Excellent Work', '16.jpg', '2022-08-19 09:06:59 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 4,
  `status` int(11) NOT NULL DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_role`, `status`, `profile_image`, `created_at`) VALUES
(145, 'admin', 'admin@gmail.com', '$2y$10$eZg0hVluEnspR.7sztsdF.PEVW5vFQNmQxVNhVfVLRylJS.by6gOm', 1, 0, '145.png', '2022-08-22 03:57:24 am'),
(146, 'Md.Sohag', 'sohag@gmail.com', '$2y$10$6auyDQOKoZs6cJd2yBnxBemGVVpH22kZk6OPvSbWgdicPShWHd7XK', 1, 0, '146.png', '2022-08-22 03:59:33 am'),
(149, 'Md. Sohag', 'mdsohag@gmail.com', '$2y$10$aDhzeEKrJ5B3Gp8.sNxqq.5/kpIDUaqQP9ToaTqF2Jtc6BpsN3cQa', 1, 0, '149.png', '2022-11-13 03:14:28 am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facts`
--
ALTER TABLE `facts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_icons`
--
ALTER TABLE `social_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `facts`
--
ALTER TABLE `facts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `social_icons`
--
ALTER TABLE `social_icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
