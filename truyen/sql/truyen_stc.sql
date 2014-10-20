/*
Navicat MySQL Data Transfer

Source Server         : infoware
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : truyen

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-08-30 16:08:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`categoryname`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`permalink`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=9

;

-- ----------------------------
-- Table structure for `chapter`
-- ----------------------------
DROP TABLE IF EXISTS `chapter`;
CREATE TABLE `chapter` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`story`  int(11) NOT NULL ,
`name`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`content`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`no`  int(16) NULL DEFAULT NULL ,
`createdtime`  timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP ,
`permalink`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`story`) REFERENCES `stories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=185609

;

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
`session_id`  varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0' ,
`ip_address`  varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0' ,
`user_agent`  varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`last_activity`  int(10) UNSIGNED NOT NULL DEFAULT 0 ,
`user_data`  text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
PRIMARY KEY (`session_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_bin

;

-- ----------------------------
-- Table structure for `crawl_chapter`
-- ----------------------------
DROP TABLE IF EXISTS `crawl_chapter`;
CREATE TABLE `crawl_chapter` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`url`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`crawled`  int(11) NOT NULL ,
`storyUrl`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=203878

;

-- ----------------------------
-- Table structure for `crawl_story`
-- ----------------------------
DROP TABLE IF EXISTS `crawl_story`;
CREATE TABLE `crawl_story` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`category`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`story`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`url`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`crawled`  varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1161

;

-- ----------------------------
-- Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`ip_address`  varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`login`  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`time`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_bin
AUTO_INCREMENT=1

;

-- ----------------------------
-- Table structure for `stories`
-- ----------------------------
DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`storyname`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`description`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`permalink`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`createdtime`  timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP ,
`category`  int(11) NULL DEFAULT NULL ,
`updatetime`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=232

;

-- ----------------------------
-- Table structure for `story_author`
-- ----------------------------
DROP TABLE IF EXISTS `story_author`;
CREATE TABLE `story_author` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`permalink`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=17

;

-- ----------------------------
-- Table structure for `story_author_story`
-- ----------------------------
DROP TABLE IF EXISTS `story_author_story`;
CREATE TABLE `story_author_story` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`story`  int(11) NOT NULL ,
`author`  int(11) NOT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`author`) REFERENCES `story_author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`story`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=13

;

-- ----------------------------
-- Table structure for `story_info`
-- ----------------------------
DROP TABLE IF EXISTS `story_info`;
CREATE TABLE `story_info` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`image`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`story`  int(11) NOT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`story`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=143

;

-- ----------------------------
-- Table structure for `story_status`
-- ----------------------------
DROP TABLE IF EXISTS `story_status`;
CREATE TABLE `story_status` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`permalink`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=11

;

-- ----------------------------
-- Table structure for `story_status_story`
-- ----------------------------
DROP TABLE IF EXISTS `story_status_story`;
CREATE TABLE `story_status_story` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`story`  int(11) NOT NULL ,
`status`  int(11) NOT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`status`) REFERENCES `story_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`story`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=11

;

-- ----------------------------
-- Table structure for `user_autologin`
-- ----------------------------
DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE `user_autologin` (
`key_id`  char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`user_id`  int(11) NOT NULL DEFAULT 0 ,
`user_agent`  varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`last_ip`  varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`last_login`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`key_id`, `user_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_bin

;

-- ----------------------------
-- Table structure for `user_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE `user_profiles` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`user_id`  int(11) NOT NULL ,
`country`  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`website`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_bin
AUTO_INCREMENT=1

;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`username`  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`password`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`activated`  tinyint(1) NOT NULL DEFAULT 1 ,
`banned`  tinyint(1) NOT NULL DEFAULT 0 ,
`ban_reason`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`new_password_key`  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`new_password_requested`  datetime NULL DEFAULT NULL ,
`new_email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`new_email_key`  varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`last_ip`  varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
`last_login`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ,
`created`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ,
`modified`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_bin
AUTO_INCREMENT=2

;

-- ----------------------------
-- View structure for `story_fullinfo`
-- ----------------------------
DROP VIEW IF EXISTS `story_fullinfo`;
CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `story_fullinfo` AS select `si`.`image` AS `image`,`ss`.`name` AS `status`,`ss`.`permalink` AS `statusKey`,`sa`.`name` AS `author`,`sa`.`permalink` AS `authorKey`,`si`.`id` AS `id`,`si`.`story` AS `story` from ((`story_info` `si` left join (`story_status_story` `sss` join `story_status` `ss` on((`sss`.`status` = `ss`.`id`))) on((`si`.`story` = `sss`.`story`))) left join (`story_author` `sa` join `story_author_story` `sas` on((`sas`.`author` = `sa`.`id`))) on((`si`.`story` = `sas`.`story`)));

-- ----------------------------
-- Indexes structure for table `categories`
-- ----------------------------
CREATE UNIQUE INDEX `PER` USING BTREE ON `categories`(`permalink`(100)) ;

-- ----------------------------
-- Auto increment value for `categories`
-- ----------------------------
ALTER TABLE `categories` AUTO_INCREMENT=9;

-- ----------------------------
-- Indexes structure for table `chapter`
-- ----------------------------
CREATE UNIQUE INDEX `PER` USING BTREE ON `chapter`(`permalink`, `story`) ;
CREATE INDEX `STORY` USING BTREE ON `chapter`(`story`) ;

-- ----------------------------
-- Auto increment value for `chapter`
-- ----------------------------
ALTER TABLE `chapter` AUTO_INCREMENT=185609;

-- ----------------------------
-- Indexes structure for table `crawl_chapter`
-- ----------------------------
CREATE UNIQUE INDEX `url` USING BTREE ON `crawl_chapter`(`url`) ;

-- ----------------------------
-- Auto increment value for `crawl_chapter`
-- ----------------------------
ALTER TABLE `crawl_chapter` AUTO_INCREMENT=203878;

-- ----------------------------
-- Indexes structure for table `crawl_story`
-- ----------------------------
CREATE UNIQUE INDEX `C_URL` USING BTREE ON `crawl_story`(`url`) ;

-- ----------------------------
-- Auto increment value for `crawl_story`
-- ----------------------------
ALTER TABLE `crawl_story` AUTO_INCREMENT=1161;

-- ----------------------------
-- Auto increment value for `login_attempts`
-- ----------------------------
ALTER TABLE `login_attempts` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `stories`
-- ----------------------------
CREATE UNIQUE INDEX `PEU` USING BTREE ON `stories`(`permalink`) ;
CREATE UNIQUE INDEX `ID` USING BTREE ON `stories`(`id`) ;
CREATE INDEX `PER` USING BTREE ON `stories`(`permalink`(1)) ;
CREATE INDEX `CATE` USING BTREE ON `stories`(`category`) ;

-- ----------------------------
-- Auto increment value for `stories`
-- ----------------------------
ALTER TABLE `stories` AUTO_INCREMENT=232;

-- ----------------------------
-- Indexes structure for table `story_author`
-- ----------------------------
CREATE UNIQUE INDEX `PERMALINK` USING BTREE ON `story_author`(`permalink`) ;
CREATE UNIQUE INDEX `ID` USING BTREE ON `story_author`(`id`) ;

-- ----------------------------
-- Auto increment value for `story_author`
-- ----------------------------
ALTER TABLE `story_author` AUTO_INCREMENT=17;

-- ----------------------------
-- Indexes structure for table `story_author_story`
-- ----------------------------
CREATE UNIQUE INDEX `sas` USING BTREE ON `story_author_story`(`story`, `author`) ;
CREATE INDEX `story_author_story_story_fk01` USING BTREE ON `story_author_story`(`author`) ;

-- ----------------------------
-- Auto increment value for `story_author_story`
-- ----------------------------
ALTER TABLE `story_author_story` AUTO_INCREMENT=13;

-- ----------------------------
-- Indexes structure for table `story_info`
-- ----------------------------
CREATE UNIQUE INDEX `STORY` USING BTREE ON `story_info`(`story`) ;

-- ----------------------------
-- Auto increment value for `story_info`
-- ----------------------------
ALTER TABLE `story_info` AUTO_INCREMENT=143;

-- ----------------------------
-- Indexes structure for table `story_status`
-- ----------------------------
CREATE UNIQUE INDEX `PERMALINK` USING BTREE ON `story_status`(`permalink`) ;
CREATE UNIQUE INDEX `ID` USING BTREE ON `story_status`(`id`) ;

-- ----------------------------
-- Auto increment value for `story_status`
-- ----------------------------
ALTER TABLE `story_status` AUTO_INCREMENT=11;

-- ----------------------------
-- Indexes structure for table `story_status_story`
-- ----------------------------
CREATE UNIQUE INDEX `sss` USING BTREE ON `story_status_story`(`story`, `status`) ;
CREATE INDEX `story_status_fk1` USING BTREE ON `story_status_story`(`status`) ;

-- ----------------------------
-- Auto increment value for `story_status_story`
-- ----------------------------
ALTER TABLE `story_status_story` AUTO_INCREMENT=11;

-- ----------------------------
-- Auto increment value for `user_profiles`
-- ----------------------------
ALTER TABLE `user_profiles` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for `users`
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=2;
