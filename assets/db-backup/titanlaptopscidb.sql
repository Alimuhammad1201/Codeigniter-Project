/*
Navicat MySQL Data Transfer

Source Server         : Local Connection
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : titanlaptopscidb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-02-14 17:44:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `afa110_brand`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_brand`;
CREATE TABLE `afa110_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `brand_img` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_brand
-- ----------------------------
INSERT INTO `afa110_brand` VALUES ('3', '01/30/2023', 'LENOVO', 'LENOVO', 'No image found', 'DEACTIVE', 'lenovo', 'lenovo');

-- ----------------------------
-- Table structure for `afa110_media`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_media`;
CREATE TABLE `afa110_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` varchar(255) DEFAULT NULL,
  `media_type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `embed_code` text DEFAULT NULL,
  `media_img` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_media
-- ----------------------------

-- ----------------------------
-- Table structure for `afa110_member`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_member`;
CREATE TABLE `afa110_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_member
-- ----------------------------

-- ----------------------------
-- Table structure for `afa110_product`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_product`;
CREATE TABLE `afa110_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `product_condition` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `product_img` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_product
-- ----------------------------

-- ----------------------------
-- Table structure for `afa110_product_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_product_gallery`;
CREATE TABLE `afa110_product_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `gallery_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_product_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for `afa110_product_specification`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_product_specification`;
CREATE TABLE `afa110_product_specification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `processor_type` varchar(100) DEFAULT NULL,
  `processor_speed` varchar(100) DEFAULT NULL,
  `hard_drive_size` varchar(100) DEFAULT NULL,
  `installed_ram` varchar(100) DEFAULT NULL,
  `screen_size` varchar(100) DEFAULT NULL,
  `camera` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `operating_system` varchar(100) DEFAULT NULL,
  `bluetooth` varchar(100) DEFAULT NULL,
  `wifi` varchar(100) DEFAULT NULL,
  `lan` varchar(100) DEFAULT NULL,
  `modem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_product_specification
-- ----------------------------

-- ----------------------------
-- Table structure for `afa110_review`
-- ----------------------------
DROP TABLE IF EXISTS `afa110_review`;
CREATE TABLE `afa110_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afa110_review
-- ----------------------------
