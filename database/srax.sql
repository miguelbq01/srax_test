/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50727
Source Host           : localhost:3306
Source Database       : srax

Target Server Type    : MYSQL
Target Server Version : 50727
File Encoding         : 65001

Date: 2019-10-13 21:21:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hero_classes
-- ----------------------------
DROP TABLE IF EXISTS `hero_classes`;
CREATE TABLE `hero_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hero_classes
-- ----------------------------
INSERT INTO `hero_classes` VALUES ('1', 'Paladin', null, null);
INSERT INTO `hero_classes` VALUES ('2', 'Ranger', null, null);
INSERT INTO `hero_classes` VALUES ('3', 'Barbarian', null, null);
INSERT INTO `hero_classes` VALUES ('4', 'Wizard', null, null);
INSERT INTO `hero_classes` VALUES ('5', 'Cleric', null, null);
INSERT INTO `hero_classes` VALUES ('6', 'Warrior', null, null);
INSERT INTO `hero_classes` VALUES ('7', 'Thief', null, null);

-- ----------------------------
-- Table structure for hero_first_names
-- ----------------------------
DROP TABLE IF EXISTS `hero_first_names`;
CREATE TABLE `hero_first_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hero_first_names
-- ----------------------------
INSERT INTO `hero_first_names` VALUES ('1', 'Bheizerd', null, null);
INSERT INTO `hero_first_names` VALUES ('2', 'Khazund', null, null);
INSERT INTO `hero_first_names` VALUES ('3', 'Grirgeld', null, null);
INSERT INTO `hero_first_names` VALUES ('4', 'Murgild', null, null);
INSERT INTO `hero_first_names` VALUES ('5', 'Edrafd', null, null);
INSERT INTO `hero_first_names` VALUES ('6', 'End', null, null);
INSERT INTO `hero_first_names` VALUES ('7', 'Grognurd', null, null);
INSERT INTO `hero_first_names` VALUES ('8', 'Grumd', null, null);
INSERT INTO `hero_first_names` VALUES ('9', 'Surhathiond', null, null);
INSERT INTO `hero_first_names` VALUES ('10', 'Lamosd', null, null);
INSERT INTO `hero_first_names` VALUES ('11', 'Melmedjadd', null, null);
INSERT INTO `hero_first_names` VALUES ('12', 'Shouthesd', null, null);
INSERT INTO `hero_first_names` VALUES ('13', 'Ched', null, null);
INSERT INTO `hero_first_names` VALUES ('14', 'Jund', null, null);
INSERT INTO `hero_first_names` VALUES ('15', 'Rircurtund', null, null);
INSERT INTO `hero_first_names` VALUES ('16', 'Zelen', null, null);

-- ----------------------------
-- Table structure for hero_last_names
-- ----------------------------
DROP TABLE IF EXISTS `hero_last_names`;
CREATE TABLE `hero_last_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hero_last_names
-- ----------------------------
INSERT INTO `hero_last_names` VALUES ('1', 'Nema', null, null);
INSERT INTO `hero_last_names` VALUES ('2', 'Dhusher', null, null);
INSERT INTO `hero_last_names` VALUES ('3', 'Burningsun', null, null);
INSERT INTO `hero_last_names` VALUES ('4', 'Hawkglow', null, null);
INSERT INTO `hero_last_names` VALUES ('5', 'Nav', null, null);
INSERT INTO `hero_last_names` VALUES ('6', 'Kadev', null, null);
INSERT INTO `hero_last_names` VALUES ('7', 'Lightkeeper', null, null);
INSERT INTO `hero_last_names` VALUES ('8', 'Heartdancer', null, null);
INSERT INTO `hero_last_names` VALUES ('9', 'Fivrithrit', null, null);
INSERT INTO `hero_last_names` VALUES ('10', 'Suechit', null, null);
INSERT INTO `hero_last_names` VALUES ('11', 'Tuldethatvo', null, null);
INSERT INTO `hero_last_names` VALUES ('12', 'Vrovakya', null, null);
INSERT INTO `hero_last_names` VALUES ('13', 'Hiao', null, null);
INSERT INTO `hero_last_names` VALUES ('14', 'Chiay', null, null);
INSERT INTO `hero_last_names` VALUES ('15', 'Hogoscu', null, null);
INSERT INTO `hero_last_names` VALUES ('16', 'Vedrimor', null, null);

-- ----------------------------
-- Table structure for hero_races
-- ----------------------------
DROP TABLE IF EXISTS `hero_races`;
CREATE TABLE `hero_races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hero_races
-- ----------------------------
INSERT INTO `hero_races` VALUES ('1', 'Human', null, null);
INSERT INTO `hero_races` VALUES ('2', 'Elf', null, null);
INSERT INTO `hero_races` VALUES ('3', 'Halfling', null, null);
INSERT INTO `hero_races` VALUES ('4', 'Dwarf', null, null);
INSERT INTO `hero_races` VALUES ('5', 'Half-orc', null, null);
INSERT INTO `hero_races` VALUES ('6', 'Half-elf', null, null);
INSERT INTO `hero_races` VALUES ('7', 'Dragonborn', null, null);

-- ----------------------------
-- Table structure for hero_weapons
-- ----------------------------
DROP TABLE IF EXISTS `hero_weapons`;
CREATE TABLE `hero_weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hero_weapons
-- ----------------------------
INSERT INTO `hero_weapons` VALUES ('1', 'Sword', null, null);
INSERT INTO `hero_weapons` VALUES ('2', 'Dagger', null, null);
INSERT INTO `hero_weapons` VALUES ('3', 'Hammer', null, null);
INSERT INTO `hero_weapons` VALUES ('4', 'Bow and Arrows', null, null);
INSERT INTO `hero_weapons` VALUES ('5', 'Staff', null, null);

-- ----------------------------
-- Table structure for heroes
-- ----------------------------
DROP TABLE IF EXISTS `heroes`;
CREATE TABLE `heroes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `race_id` int(255) DEFAULT NULL,
  `class_id` int(255) DEFAULT NULL,
  `weapon_id` int(255) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of heroes
-- ----------------------------

-- ----------------------------
-- Table structure for monster_abilities
-- ----------------------------
DROP TABLE IF EXISTS `monster_abilities`;
CREATE TABLE `monster_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monster_id` int(11) DEFAULT NULL,
  `power_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of monster_abilities
-- ----------------------------

-- ----------------------------
-- Table structure for monster_powers
-- ----------------------------
DROP TABLE IF EXISTS `monster_powers`;
CREATE TABLE `monster_powers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of monster_powers
-- ----------------------------
INSERT INTO `monster_powers` VALUES ('1', 'Shadow Ball', null, null);
INSERT INTO `monster_powers` VALUES ('2', 'Aerial Ace', null, null);
INSERT INTO `monster_powers` VALUES ('3', 'Giga Drain', null, null);
INSERT INTO `monster_powers` VALUES ('4', 'Thunderbolt', null, null);
INSERT INTO `monster_powers` VALUES ('5', 'Earthquake', null, null);
INSERT INTO `monster_powers` VALUES ('6', 'Crunch', null, null);
INSERT INTO `monster_powers` VALUES ('7', 'Double Team', null, null);
INSERT INTO `monster_powers` VALUES ('8', 'Psychic', null, null);
INSERT INTO `monster_powers` VALUES ('9', 'Ice Beam', null, null);
INSERT INTO `monster_powers` VALUES ('10', 'Surf', null, null);

-- ----------------------------
-- Table structure for monster_races
-- ----------------------------
DROP TABLE IF EXISTS `monster_races`;
CREATE TABLE `monster_races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of monster_races
-- ----------------------------
INSERT INTO `monster_races` VALUES ('1', 'Beholder', null, null);
INSERT INTO `monster_races` VALUES ('2', 'Mind Flayer', null, null);
INSERT INTO `monster_races` VALUES ('3', 'Drow', null, null);
INSERT INTO `monster_races` VALUES ('4', 'Dragons', null, null);
INSERT INTO `monster_races` VALUES ('5', 'Owlbear', null, null);
INSERT INTO `monster_races` VALUES ('6', 'Bulette', null, null);
INSERT INTO `monster_races` VALUES ('7', 'Rust Monster', null, null);
INSERT INTO `monster_races` VALUES ('8', 'Gelatinous', null, null);
INSERT INTO `monster_races` VALUES ('9', 'Cube', null, null);
INSERT INTO `monster_races` VALUES ('10', 'Hill Giant', null, null);
INSERT INTO `monster_races` VALUES ('11', 'Stone Giant', null, null);
INSERT INTO `monster_races` VALUES ('12', 'Frost Giant', null, null);
INSERT INTO `monster_races` VALUES ('13', 'Fire Giant', null, null);
INSERT INTO `monster_races` VALUES ('14', 'Cloud Giant', null, null);
INSERT INTO `monster_races` VALUES ('15', 'Storm Giant', null, null);
INSERT INTO `monster_races` VALUES ('16', 'Displacer Beast', null, null);
INSERT INTO `monster_races` VALUES ('17', 'Githyanki', null, null);
INSERT INTO `monster_races` VALUES ('18', 'Kobold', null, null);
INSERT INTO `monster_races` VALUES ('19', 'Kuo-Toa', null, null);
INSERT INTO `monster_races` VALUES ('20', 'Lich', null, null);
INSERT INTO `monster_races` VALUES ('21', 'Orc', null, null);
INSERT INTO `monster_races` VALUES ('22', 'Slaad', null, null);
INSERT INTO `monster_races` VALUES ('23', 'Umber Hulk', null, null);
INSERT INTO `monster_races` VALUES ('24', 'Yuan-ti', null, null);

-- ----------------------------
-- Table structure for monsters
-- ----------------------------
DROP TABLE IF EXISTS `monsters`;
CREATE TABLE `monsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `race_id` int(11) DEFAULT NULL,
  `strenght` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `dexterity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of monsters
-- ----------------------------
