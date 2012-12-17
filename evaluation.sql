/*
 Navicat Premium Data Transfer

 Source Server         : lijun
 Source Server Type    : MySQL
 Source Server Version : 50525
 Source Host           : localhost
 Source Database       : evaluation

 Target Server Type    : MySQL
 Target Server Version : 50525
 File Encoding         : utf-8

 Date: 12/17/2012 13:51:14 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

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
INSERT INTO `item` VALUES ('3', '思想政治素质', '思想文化素质很重要', '1', '0', '0.362054', '100'), ('4', '科学文化素质', null, '1', null, '0.337894', '100'), ('5', '身心素质', null, '1', null, '0.104121', '100'), ('6', '军事素质', null, '1', null, '0.074784', '100'), ('8', '学习成绩', null, '2', '4', '0.766667', '100'), ('9', '体育锻炼', null, '2', '5', '0.445102', '100'), ('10', '课外交流', '', '2', '4', '0.233333', '100'), ('11', '道德品质', '', '2', '5', '0.14322', '100'), ('12', '人格魅力', '', '2', '5', '0.411678', '100'), ('13', '科研素质', '', '1', '0', '0.121147', '100');
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
INSERT INTO `student` VALUES ('1110339042', '陈光烁', 'B1103392', '男'), ('5090729013', '李骏豪', 'F0907201', '男'), ('5090729022', '李军', 'F0907201', '男'), ('阿龙', '11111', '11', '男');
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

SET FOREIGN_KEY_CHECKS = 1;
