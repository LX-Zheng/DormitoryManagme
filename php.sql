/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80015
 Source Host           : localhost:3306
 Source Schema         : php

 Target Server Type    : MySQL
 Target Server Version : 80015
 File Encoding         : 65001

 Date: 15/05/2019 19:46:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data
-- ----------------------------
BEGIN;
INSERT INTO `data` VALUES (30, '点 (1).svg');
INSERT INTO `data` VALUES (31, '关闭.svg');
INSERT INTO `data` VALUES (32, '联系客服.svg');
INSERT INTO `data` VALUES (33, '个人.svg');
INSERT INTO `data` VALUES (34, '分类_.svg');
INSERT INTO `data` VALUES (35, '图书馆_library12.svg');
INSERT INTO `data` VALUES (36, '头像 男孩.svg');
INSERT INTO `data` VALUES (37, '提醒.svg');
INSERT INTO `data` VALUES (38, '首页.svg');
INSERT INTO `data` VALUES (39, '无结果.svg');
INSERT INTO `data` VALUES (40, '物品放行.svg');
INSERT INTO `data` VALUES (41, '用户.svg');
INSERT INTO `data` VALUES (42, '状态修改.svg');
COMMIT;

-- ----------------------------
-- Table structure for dorm
-- ----------------------------
DROP TABLE IF EXISTS `dorm`;
CREATE TABLE `dorm` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `dorm` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `detail_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dorm
-- ----------------------------
BEGIN;
INSERT INTO `dorm` VALUES (19, '10104', '张广洲', '第三方', '沈德符', '3', '2019-05-05');
INSERT INTO `dorm` VALUES (20, '10104', '张广洲', '撒的', '阿斯顿', '3', '2019-05-05');
INSERT INTO `dorm` VALUES (22, '10104', '张广洲', '豆腐块', '风急浪大说服力的', NULL, '2019-05-07');
INSERT INTO `dorm` VALUES (23, '10104', '张广洲', '是否', '撒的发', NULL, '2019-05-07');
INSERT INTO `dorm` VALUES (24, '10104', '张广洲', '撒的反馈', '范德萨', '3', '2019-05-07');
INSERT INTO `dorm` VALUES (25, '10104', '张广洲', '了卡就疯了似的', '算啦快递费；上岛咖啡；蓝色短裤', '3', '2019-05-07');
INSERT INTO `dorm` VALUES (26, '10104', '张广洲', '的撒疯了；撒快递费', '阿斯顿发', '2', '2019-05-07');
INSERT INTO `dorm` VALUES (27, '10104', '张广洲', '德拉科', '拍拍拍拍拍拍拍', '2', '2019-05-07');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `account` varchar(20) NOT NULL,
  `password` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dorm` int(20) NOT NULL,
  `bed_num` int(20) NOT NULL,
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('admin', 123, 'admin', 0, 0);
INSERT INTO `user` VALUES ('Z09416131', 123, '张广洲', 10104, 3);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
