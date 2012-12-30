/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50525
 Source Host           : localhost
 Source Database       : evaluation

 Target Server Type    : MySQL
 Target Server Version : 50525
 File Encoding         : utf-8

 Date: 12/30/2012 15:58:59 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `config`
-- ----------------------------
BEGIN;
INSERT INTO `config` VALUES ('calculate_mode', 'multiple'), ('current_storage', '2'), ('storage_1_name', '第一学年'), ('storage_1_weight', '0.2'), ('storage_2_name', '第二学年'), ('storage_2_weight', '0.2'), ('storage_3_name', '第三学年'), ('storage_3_weight', '0.2'), ('storage_4_name', '第四学年'), ('storage_4_weight', '0.2'), ('storage_5_name', '备用'), ('storage_5_weight', '0.2');
COMMIT;

-- ----------------------------
--  Table structure for `grade`
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade`
-- ----------------------------
BEGIN;
INSERT INTO `grade` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `grade_1`
-- ----------------------------
DROP TABLE IF EXISTS `grade_1`;
CREATE TABLE `grade_1` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade_1`
-- ----------------------------
BEGIN;
INSERT INTO `grade_1` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `grade_2`
-- ----------------------------
DROP TABLE IF EXISTS `grade_2`;
CREATE TABLE `grade_2` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade_2`
-- ----------------------------
BEGIN;
INSERT INTO `grade_2` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `grade_3`
-- ----------------------------
DROP TABLE IF EXISTS `grade_3`;
CREATE TABLE `grade_3` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade_3`
-- ----------------------------
BEGIN;
INSERT INTO `grade_3` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `grade_4`
-- ----------------------------
DROP TABLE IF EXISTS `grade_4`;
CREATE TABLE `grade_4` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade_4`
-- ----------------------------
BEGIN;
INSERT INTO `grade_4` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `grade_5`
-- ----------------------------
DROP TABLE IF EXISTS `grade_5`;
CREATE TABLE `grade_5` (
  `itemid` int(10) unsigned NOT NULL,
  `studentid` varchar(10) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `grade_5`
-- ----------------------------
BEGIN;
INSERT INTO `grade_5` VALUES ('3', '5090729013', '87'), ('3', '5090729022', '60'), ('4', '5090729013', '88'), ('4', '5090729022', '80'), ('5', '5090729013', '98'), ('5', '5090729022', '79'), ('6', '5090729013', '87'), ('6', '5090729022', '99'), ('7', '5090729013', '56'), ('7', '5090729022', '88'), ('8', '5090729013', '90'), ('8', '5090729022', '100'), ('9', '5090729022', '100'), ('10', '1110339042', '1'), ('11', '1110339042', '1'), ('8', '1110339042', '100'), ('9', '1110339042', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item`
-- ----------------------------
BEGIN;
INSERT INTO `item` VALUES ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item_1`
-- ----------------------------
DROP TABLE IF EXISTS `item_1`;
CREATE TABLE `item_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item_1`
-- ----------------------------
BEGIN;
INSERT INTO `item_1` VALUES ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item_2`
-- ----------------------------
DROP TABLE IF EXISTS `item_2`;
CREATE TABLE `item_2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item_2`
-- ----------------------------
BEGIN;
INSERT INTO `item_2` VALUES ('3', '思想政治素质', '思想文化素质很重要', '1', '0', '0.362054', '100'), ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item_3`
-- ----------------------------
DROP TABLE IF EXISTS `item_3`;
CREATE TABLE `item_3` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item_3`
-- ----------------------------
BEGIN;
INSERT INTO `item_3` VALUES ('3', '思想政治素质', '思想文化素质很重要', '1', '0', '0.362054', '100'), ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item_4`
-- ----------------------------
DROP TABLE IF EXISTS `item_4`;
CREATE TABLE `item_4` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item_4`
-- ----------------------------
BEGIN;
INSERT INTO `item_4` VALUES ('3', '思想政治素质', '思想文化素质很重要', '1', '0', '0.362054', '100'), ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `item_5`
-- ----------------------------
DROP TABLE IF EXISTS `item_5`;
CREATE TABLE `item_5` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text,
  `level` enum('1','2') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `full` int(10) unsigned DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `item_5`
-- ----------------------------
BEGIN;
INSERT INTO `item_5` VALUES ('3', '思想政治素质', '思想文化素质很重要', '1', '0', '0.362054', '100'), ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
COMMIT;

-- ----------------------------
--  Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `gender` enum('男','女') NOT NULL DEFAULT '男',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `student`
-- ----------------------------
BEGIN;
INSERT INTO `student` VALUES ('1110339042', '陈光烁', 'B1103392', '男'), ('5090729013', '李骏豪', 'F0907201', '男'), ('5090729022', '李军', 'F0907201', '男');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `auth` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('7', 'chengs', '23f6f88181146eb159749ac8c40e2fa6', '3'), ('8', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');
COMMIT;

-- ----------------------------
--  Table structure for `weight`
-- ----------------------------
DROP TABLE IF EXISTS `weight`;
CREATE TABLE `weight` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight`
-- ----------------------------
BEGIN;
INSERT INTO `weight` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

-- ----------------------------
--  Table structure for `weight_1`
-- ----------------------------
DROP TABLE IF EXISTS `weight_1`;
CREATE TABLE `weight_1` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight_1`
-- ----------------------------
BEGIN;
INSERT INTO `weight_1` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

-- ----------------------------
--  Table structure for `weight_2`
-- ----------------------------
DROP TABLE IF EXISTS `weight_2`;
CREATE TABLE `weight_2` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight_2`
-- ----------------------------
BEGIN;
INSERT INTO `weight_2` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

-- ----------------------------
--  Table structure for `weight_3`
-- ----------------------------
DROP TABLE IF EXISTS `weight_3`;
CREATE TABLE `weight_3` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight_3`
-- ----------------------------
BEGIN;
INSERT INTO `weight_3` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

-- ----------------------------
--  Table structure for `weight_4`
-- ----------------------------
DROP TABLE IF EXISTS `weight_4`;
CREATE TABLE `weight_4` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight_4`
-- ----------------------------
BEGIN;
INSERT INTO `weight_4` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

-- ----------------------------
--  Table structure for `weight_5`
-- ----------------------------
DROP TABLE IF EXISTS `weight_5`;
CREATE TABLE `weight_5` (
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  `min` float NOT NULL DEFAULT '1',
  `normal` float NOT NULL DEFAULT '1',
  `max` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `weight_5`
-- ----------------------------
BEGIN;
INSERT INTO `weight_5` VALUES ('3', '6', '1', '3', '5'), ('4', '5', '1', '3', '5'), ('4', '6', '3', '5', '7'), ('3', '4', '1', '3', '5'), ('3', '5', '1', '3', '5'), ('5', '6', '1', '1', '1'), ('8', '10', '1', '3', '5'), ('9', '11', '1', '2', '3'), ('9', '12', '1', '4', '7'), ('11', '12', '0.1', '0.2', '0.4');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
