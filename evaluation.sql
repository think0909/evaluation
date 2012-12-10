-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 10 日 06:26
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `evaluation`
--

-- --------------------------------------------------------

--
-- 表的结构 `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemid`,`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `grade`
--

INSERT INTO `grade` (`itemid`, `studentid`, `point`) VALUES
(3, '5090729013', 87),
(3, '5090729022', 60),
(4, '5090729013', 88),
(4, '5090729022', 80),
(5, '5090729013', 98),
(5, '5090729022', 79),
(6, '5090729013', 87),
(6, '5090729022', 99),
(7, '5090729013', 56),
(7, '5090729022', 88),
(8, '5090729013', 90),
(8, '5090729022', 90);

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `level`, `parentid`, `weight`, `full`) VALUES
(3, '思想政治素质', '思想文化素质很重要', '1', 0, 0.393003, 100),
(4, '科学文化素质', NULL, '1', NULL, 0.371166, 100),
(5, '身心素质', NULL, '1', NULL, 0.134602, 100),
(6, '军事素质', NULL, '1', NULL, 0.101229, 100),
(8, '学习成绩', NULL, '2', 4, 0.766667, 100),
(9, '体育锻炼', NULL, '2', 5, 0.445102, 100),
(10, '课外交流', '', '2', 4, 0.233333, 100),
(11, '道德品质', '', '2', 5, 0.14322, 100),
(12, '人格魅力', '', '2', 5, 0.411678, 100);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `gender` enum('男','女') NOT NULL DEFAULT '男',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`id`, `name`, `class`, `gender`) VALUES
('5090729013', '李骏豪', 'F0907201', '男'),
('5090729022', '李军', 'F0907201', '男');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `auth` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth`) VALUES
(5, '123', 'bcbe3365e6ac95ea2c0343a2395834dd', 3);

-- --------------------------------------------------------

--
-- 表的结构 `weight`
--

CREATE TABLE IF NOT EXISTS `weight` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weight`
--

INSERT INTO `weight` (`fromid`, `toid`, `min`, `normal`, `max`) VALUES
(3, 6, 1, 3, 5),
(4, 5, 1, 3, 5),
(4, 6, 3, 5, 7),
(3, 4, 1, 3, 5),
(3, 5, 1, 3, 5),
(5, 6, 1, 1, 1),
(8, 10, 1, 3, 5),
(9, 11, 1, 2, 3),
(9, 12, 1, 4, 7),
(11, 12, 0.1, 0.2, 0.4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
