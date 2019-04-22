/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : wechat

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2018-01-22 11:31:31
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openId` varchar(30) DEFAULT NULL,
  `createTime` int(10) DEFAULT NULL,
  `msgType` char(10) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `msgId` int(10) DEFAULT NULL,
  `mediaId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `sucai`
-- ----------------------------
DROP TABLE IF EXISTS `sucai`;
CREATE TABLE `sucai` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `madia` varchar(255) NOT NULL,
  `time` int(12) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sucai
-- ----------------------------
INSERT INTO sucai VALUES ('14', '', '1516441486', 'upload/5a630f8d874b4.jpg');
INSERT INTO sucai VALUES ('15', '', '1516441568', 'upload/5a630fdec3846.jpg');
INSERT INTO sucai VALUES ('12', '', '1516441146', 'upload/5a630e39241e0.jpg');
INSERT INTO sucai VALUES ('13', '', '1516441443', 'upload/5a630f626cb24.jpg');

-- ----------------------------
-- Table structure for `wx_media`
-- ----------------------------
DROP TABLE IF EXISTS `wx_media`;
CREATE TABLE `wx_media` (
  `sid` int(11) NOT NULL AUTO_INCREMENT COMMENT '上传素材的id',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_media
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_msg`
-- ----------------------------
DROP TABLE IF EXISTS `wx_msg`;
CREATE TABLE `wx_msg` (
  `mid` int(11) NOT NULL AUTO_INCREMENT COMMENT '素材库的id',
  `openid` varchar(32) NOT NULL COMMENT '用户的微信id',
  `time` varchar(32) NOT NULL COMMENT '用户发送素材的时间',
  `type` varchar(32) NOT NULL COMMENT '用户发送素材的类型',
  `content` varchar(255) DEFAULT NULL COMMENT '用户发送的文本信息',
  `msgid` varchar(255) NOT NULL COMMENT '微信提供的消息id',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_msg
-- ----------------------------
INSERT INTO wx_msg VALUES ('46', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 14:32:48', 'text', '不对啊', '6513017119662299413');
INSERT INTO wx_msg VALUES ('47', 'oVcRN1ijwdEVYkjVsl0okcw-CjvE', '2018-01-20 14:37:05', 'text', '古古怪怪', '6513018223468894569');
INSERT INTO wx_msg VALUES ('48', 'oVcRN1ijwdEVYkjVsl0okcw-CjvE', '2018-01-20 14:37:14', 'text', '你是', '6513018257828632940');
INSERT INTO wx_msg VALUES ('58', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 15:18:46', 'text', '你好', '6513028960887135598');
INSERT INTO wx_msg VALUES ('59', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 15:18:50', 'text', '爱你', '6513028978067004786');
INSERT INTO wx_msg VALUES ('68', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 18:41:06', 'event', '无', '无');
INSERT INTO wx_msg VALUES ('69', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 18:41:10', 'event', '无', '无');
INSERT INTO wx_msg VALUES ('70', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 18:41:16', 'text', '爱你', '6513081149034754493');
INSERT INTO wx_msg VALUES ('71', 'oVcRN1vCEUZ1vpiOTY9KPn2r0f94', '2018-01-20 18:41:22', 'text', '为什么', '6513081170509590977');
INSERT INTO wx_msg VALUES ('72', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516522947', 'text', '，那些年新年玄界圣杰教主', '');
INSERT INTO wx_msg VALUES ('73', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516522976', 'text', 'CN辛家庄酥', '');
INSERT INTO wx_msg VALUES ('74', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516522993', 'text', 'vvv非分的尺寸', '');
INSERT INTO wx_msg VALUES ('75', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516523163', 'text', '小女子就记着孙豪和香蕉', '6513417389151499949');
INSERT INTO wx_msg VALUES ('76', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516523352', 'text', '新年下回呵自己就', '6513418200900319007');
INSERT INTO wx_msg VALUES ('77', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516523356', 'text', '趁现在吸血级', '6513418218080188195');
INSERT INTO wx_msg VALUES ('78', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516523606', 'text', '小白号找这个', '6513419291822012237');
INSERT INTO wx_msg VALUES ('79', 'oDJV71usv7fdv62CHMlu1oM5lkhQ', '1516523674', 'text', '你民工', '6513419583879788396');
INSERT INTO wx_msg VALUES ('80', 'oDJV71s6Fu3aEdVhWvXBZZfbLNMU', '1516523867', 'text', '〈；下课玄界〉', '6513420412808476606');
