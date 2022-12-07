/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : safe_login

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 29/11/2022 17:00:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

create database if not exists safe_login charset=utf8mb4;

use safe_login;

-- ----------------------------
-- Table structure for sl_comment
-- ----------------------------
DROP TABLE IF EXISTS `sl_comment`;
CREATE TABLE `sl_comment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_mode` tinyint(4) NULL DEFAULT 1 COMMENT '1 - phone 2 - email',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sl_comment
-- ----------------------------
INSERT INTO `sl_comment` VALUES (2, 'user1', '', 1, '19874444222', 1, '2022-11-29 16:46:30', '2022-11-29 16:46:30');
INSERT INTO `sl_comment` VALUES (3, 'user1', '3423423423423', 1, '19874444222', 1, '2022-11-29 16:46:40', '2022-11-29 16:46:40');
INSERT INTO `sl_comment` VALUES (4, 'user1', '1231231', 1, '19874444222', 1, '2022-11-29 16:47:39', '2022-11-29 16:47:39');
INSERT INTO `sl_comment` VALUES (5, 'user1', '12313123123', 1, '19874444222', 1, '2022-11-29 16:47:43', '2022-11-29 16:47:43');
INSERT INTO `sl_comment` VALUES (6, 'user1', '12313edwdasdasd', 1, '82362131@qq.com', 2, '2022-11-29 16:47:47', '2022-11-29 16:47:47');

-- ----------------------------
-- Table structure for sl_user
-- ----------------------------
DROP TABLE IF EXISTS `sl_user`;
CREATE TABLE `sl_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nickname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint(3) UNSIGNED NULL DEFAULT 2 COMMENT '1 - admin 2 - user',
  `phone` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sl_user
-- ----------------------------
INSERT INTO `sl_user` VALUES (1, 'user1', '$2y$10$Oh7RA4cO6hNo8g8IAibFneqVKpHNtudsll4NecwWon0hZGzy6Zxgu', '!@#$%^&*', '82362131@qq.com', 'user11111', 1, '19874444222', '2022-11-29 15:31:25', '2022-11-29 15:31:25');
INSERT INTO `sl_user` VALUES (2, 'user2', '$2y$10$Jx1WOSJ9zkQDxiYIQg8Ogem.m4bRzgoWwYO7K0M4.o9ZUsYwzXRB6', '!@#$%^&*', '82362131@qq.com', 'user11111', 1, '19874444222', '2022-11-29 15:31:32', '2022-11-29 15:31:32');
INSERT INTO `sl_user` VALUES (3, 'user3', '$2y$10$hPgp6P3ln4lSiJNYQ5Wzku4UKo/2Bb6I5bhaeMNQ/3rX8oNdV0S4S', '!@#$%^&*', '123121@qq.com', '123123', 2, '132344324234', '2022-11-29 16:53:19', '2022-11-29 16:53:19');

SET FOREIGN_KEY_CHECKS = 1;
