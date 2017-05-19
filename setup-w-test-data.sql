-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 19, 2017 at 05:41 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cooxledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `followerid` int(11) NOT NULL,
  `followingid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followerid`, `followingid`) VALUES
(1, 2),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`userid`, `postid`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `tag`, `content`, `username`, `time`) VALUES
(1, '', 'hello world', 'simon', '1495069198'),
(2, '', 'now should i work on likes or comments?', 'simon', '1495069274'),
(3, '', 'I think I should work on those word count', 'simon', '1495069300'),
(4, '', 'sdfasdflasfdkjflksaklfdkljflaksjdklfjlksdajflkdsjkljaflksjlkfjkslajflkjkljlkjkljlkjlkjlkjlklk', 'simon', '1495069604'),
(5, '', 'it works!!!!!!', 'simon', '1495070291'),
(6, '', 'come on tags', 'simon', '1495070484'),
(7, '', 'test tag', 'simon', '1495070546'),
(8, '', 'hello from kenny', 'kenny', '1495070787'),
(9, '', 'In the next 30 min, i am gonna try to make kenny and simon follow each other', 'simon', '1495070814'),
(10, '', 'we can be friends', 'kenny', '1495070915'),
(11, '', 'djadfakdfajksdfjkalfdafksdlfjlsdlfkasdjflkjfdkladjadfakdfajksdfjkalfdafksdlfjlsdlfkasdjflkjfdkladjadfakdfajksdfjkalfdafksdlfjlsdlfkasdjflkjfdklavdjadfakdfajksdfjkalfdafksdlfjlsdlfkasdjflkjfdkladjadfakdfajksdfjkalfdafksdlfjlsdlfkasdjflkjfdkladjadfakdfajksd', 'simon', '1495071204'),
(12, '', 'frtgfhhfhgfghfhfhfhgfghfghfghhfhfgf', 'kenny', '1495110712'),
(13, '', 'asdfsadfa', 'kenny', '1495112876'),
(14, '', 'yeah, user profile picture works', 'simon', '1495113421'),
(15, '', 'hh', 'simon', '1495113443'),
(16, 'kenny', 'yes! Bio is working!', 'simon', '1495114271'),
(17, '', 'hi i am eric', 'eric', '1495117722'),
(18, '', 'default user profile picture is working', 'simon', '1495119045'),
(19, 'kenny', 'hi i am kenny', 'kenny', '1495125747'),
(20, '', 'yeah', 'eric', '1495142811'),
(21, 'try', 'try tag', 'simon', '1495143775'),
(22, 'lit', 'tag is working!!!!!!!', 'simon', '1495143821'),
(23, 'suh', 'HELLO', 'Faisal.jaradat', '1495155895'),
(24, '#raccoonlyfe', 'Very Nice! ', 'dan.turner', '1495156971'),
(25, 'boardingsquad', 'boarding', 'simon', '1495158324'),
(26, 'lit', 'i cannot get follow to work, but this look decent lol', 'simon', '1495164630');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic` text COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `pic`, `bio`) VALUES
(1, 'simon', 'bff0cf8dc56bd6d295b8272609c72eec234affb4ce90d823a85fa3e490259cf5', '30bc9d3a6847e238', 'simon.guo@ucc.on.ca', 'http://simonguo.tech/img/head.png', 'I am Simon'),
(2, 'kenny', 'eeb24c309b448dd64d49f7fbc270171300d7102beeb3c90eca1901815564b7c7', '5910bb014263423f', 'kenny@k.k', 'https://upload.wikimedia.org/wikipedia/en/6/6f/KennyMcCormick.png', ''),
(3, 'eric', '1908e9139b60a53413a2c77ceb20effde882402ec356c464c42ef344a35653e8', '22c344c31f59609f', 'eric@r.r', '', ''),
(4, 'kyle', 'b415377d4cc1764711ee60f4b2932f340820ae4a098155de7a2efa2286bb8046', '2c9f4fbe73c10edc', 'kyle@k.k', '', ''),
(5, 'Faisal.jaradat', 'cea54e9f491c96b7b6e96160aa586605bdb1470d386545242a9ed9675bfc9a02', '25d081f85bf93f67', 'Faisal.jaradat@ucc.on.ca', 'https://http.cat/451', 'hi, im Faisal'),
(6, 'dan.turner', '894eafe242014ad3febe1271b09279dfbe9edc3dde71fd53d2cca646770a38f7', '1dfabea8731449ee', 'dan.turner@ucc.on.ca', 'http://cdn3.thr.com/sites/default/files/imagecache/square_300x300/2016/09/28fea_toronto4_raccoon.jpg', 'The Danimal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;