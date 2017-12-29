/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : 91yxq_manage

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-29 10:28:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for 91yxq_ad
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_ad`;
CREATE TABLE `91yxq_ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '广告位ID',
  `game_id` int(10) NOT NULL DEFAULT '0' COMMENT '游戏ID',
  `ad_name` varchar(100) NOT NULL DEFAULT '' COMMENT '广告位名称',
  `position_pic` varchar(200) NOT NULL DEFAULT '' COMMENT '位置预览图片',
  `ad_pic` varchar(200) NOT NULL DEFAULT '' COMMENT '广告位图片',
  `click_count` int(10) NOT NULL DEFAULT '0' COMMENT '工会ID',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1代表显示，0代表不显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ad_name` (`ad_name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='广告位列表';

-- ----------------------------
-- Records of 91yxq_ad
-- ----------------------------
INSERT INTO `91yxq_ad` VALUES ('13', '1', '搜索 右侧广告 150*280', 'static/backend/img/ad/20170414134504_643.gif', 'static/backend/img/ad/20170414134504_778.gif', '16', '1491555378', '1492148704', '1');
INSERT INTO `91yxq_ad` VALUES ('14', '1', '论坛/群组 帖间通栏广告 800*60 ', 'static/backend/img/ad/20170407165939_516.gif', 'static/backend/img/ad/20170407174645_104.gif', '4', '1491555579', '1491558405', '1');
INSERT INTO `91yxq_ad` VALUES ('15', '1', '论坛/群组 帖子列表帖位广告 960*60 ', 'static/backend/img/ad/20170407170033_776.gif', 'static/backend/img/ad/20170407174706_589.gif', '1', '1491555633', '1491558426', '1');
INSERT INTO `91yxq_ad` VALUES ('16', '1', '全局 右下角广告 180× 180 ', 'static/backend/img/ad/20170407170156_560.gif', 'static/backend/img/ad/20170407174729_528.gif', '343', '1491555716', '1491558449', '1');
INSERT INTO `91yxq_ad` VALUES ('17', '1', '门户/论坛/群组/空间 格子广告 390 × 120 ', 'static/backend/img/ad/20170407170245_928.gif', 'static/backend/img/ad/20170407174753_752.gif', '1', '1491555765', '1491558473', '1');
INSERT INTO `91yxq_ad` VALUES ('18', '1', '全局 漂浮广告 180 ×180 ', 'static/backend/img/ad/20170407170318_568.gif', 'static/backend/img/ad/20170407174811_441.gif', '2', '1491555798', '1491558491', '1');
INSERT INTO `91yxq_ad` VALUES ('19', '1', '论坛 分类间广告 960 × 130 ', 'static/backend/img/ad/20170407170357_449.gif', 'static/backend/img/ad/20170407174831_868.gif', '0', '1491555837', '1491558511', '1');
INSERT INTO `91yxq_ad` VALUES ('20', '1', '全局 页尾通栏广告 1190*70 ', 'static/backend/img/ad/20170407171051_910.gif', 'static/backend/img/ad/20170407174847_769.gif', '0', '1491556251', '1491558527', '1');
INSERT INTO `91yxq_ad` VALUES ('21', '1', '全局 对联广告 150*300 ', 'static/backend/img/ad/20170407171110_934.gif', 'static/backend/img/ad/20170407174909_662.gif', '0', '1491556270', '1491558549', '1');
INSERT INTO `91yxq_ad` VALUES ('22', '1', '全局 页头通栏广告 960 × 130 ', 'static/backend/img/ad/20170407171130_766.gif', 'static/backend/img/ad/20170407174924_942.gif', '3', '1491556290', '1491558564', '1');
INSERT INTO `91yxq_ad` VALUES ('23', '1', '全局 页头二级导航栏广告 960 × 60 ', 'static/backend/img/ad/20170407171151_767.gif', 'static/backend/img/ad/20170407174945_747.gif', '0', '1491556311', '1491558585', '1');
INSERT INTO `91yxq_ad` VALUES ('24', '1', '论坛/群组 帖内广告 200 × 300 ', 'static/backend/img/ad/20170407171221_205.gif', 'static/backend/img/ad/20170407175000_138.gif', '0', '1491556341', '1491558600', '1');
INSERT INTO `91yxq_ad` VALUES ('25', '1', '空间 日志广告 250×300 ', 'static/backend/img/ad/20170407171249_310.gif', 'static/backend/img/ad/20170407175018_631.gif', '0', '1491556369', '1491558618', '1');
INSERT INTO `91yxq_ad` VALUES ('26', '1', '空间 动态广告 960*240 ', 'static/backend/img/ad/20170407172049_162.gif', 'static/backend/img/ad/20170407175055_653.gif', '0', '1491556849', '1491558655', '1');
INSERT INTO `91yxq_ad` VALUES ('27', '1', '门户 文章列表广告 960*240 ', 'static/backend/img/ad/20170407172112_163.gif', 'static/backend/img/ad/20170407175107_179.gif', '0', '1491556872', '1491558667', '1');
INSERT INTO `91yxq_ad` VALUES ('28', '1', '门户 文章广告 250×300 ', 'static/backend/img/ad/20170407172138_907.gif', 'static/backend/img/ad/20170407175117_238.gif', '0', '1491556898', '1491558677', '1');

-- ----------------------------
-- Table structure for 91yxq_admin_logger
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_admin_logger`;
CREATE TABLE `91yxq_admin_logger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `resources` varchar(128) NOT NULL,
  `module_id` varchar(128) NOT NULL,
  `controller_id` varchar(128) NOT NULL,
  `action_id` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `intro` varchar(256) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_admin_logger
-- ----------------------------
INSERT INTO `91yxq_admin_logger` VALUES ('1', '1', 'delete', 'user_user_del', 'user', 'user', 'del', '/admin.php?r=user%2Fuser%2Findex', '删除用户 - service(id:3)', '127.0.0.1', '1491801831');
INSERT INTO `91yxq_admin_logger` VALUES ('2', '1', 'create', 'user_user_create', 'user', 'user', 'create', '/admin.php?r=user%2Fuser%2Findex', '创建后台用户 - service', '127.0.0.1', '1491801851');
INSERT INTO `91yxq_admin_logger` VALUES ('3', '1', 'update', 'user_user_pass-word-reset', 'user', 'user', 'pass-word-reset', '/admin.php?r=user%2Fuser%2Findex', '重置用户密码 - service(id:4)', '127.0.0.1', '1491801982');
INSERT INTO `91yxq_admin_logger` VALUES ('4', '1', 'delete', 'user_user_del', 'user', 'user', 'del', '/admin.php?r=user%2Fuser%2Findex', '删除用户 - service(id:4)', '127.0.0.1', '1491802980');
INSERT INTO `91yxq_admin_logger` VALUES ('5', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1491808409');
INSERT INTO `91yxq_admin_logger` VALUES ('6', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492507168');
INSERT INTO `91yxq_admin_logger` VALUES ('7', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492572000');
INSERT INTO `91yxq_admin_logger` VALUES ('8', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492572360');
INSERT INTO `91yxq_admin_logger` VALUES ('9', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492579549');
INSERT INTO `91yxq_admin_logger` VALUES ('10', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492583750');
INSERT INTO `91yxq_admin_logger` VALUES ('11', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492583942');
INSERT INTO `91yxq_admin_logger` VALUES ('12', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492583953');
INSERT INTO `91yxq_admin_logger` VALUES ('13', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492583982');
INSERT INTO `91yxq_admin_logger` VALUES ('14', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492583988');
INSERT INTO `91yxq_admin_logger` VALUES ('15', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492584679');
INSERT INTO `91yxq_admin_logger` VALUES ('16', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1492584841');
INSERT INTO `91yxq_admin_logger` VALUES ('17', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1492584912');
INSERT INTO `91yxq_admin_logger` VALUES ('18', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1493100091');
INSERT INTO `91yxq_admin_logger` VALUES ('19', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1493100110');
INSERT INTO `91yxq_admin_logger` VALUES ('20', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1502331965');
INSERT INTO `91yxq_admin_logger` VALUES ('21', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1503277986');
INSERT INTO `91yxq_admin_logger` VALUES ('22', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1503278013');
INSERT INTO `91yxq_admin_logger` VALUES ('23', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1503278117');
INSERT INTO `91yxq_admin_logger` VALUES ('24', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1503278121');
INSERT INTO `91yxq_admin_logger` VALUES ('25', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1511316027');
INSERT INTO `91yxq_admin_logger` VALUES ('26', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1514512538');
INSERT INTO `91yxq_admin_logger` VALUES ('27', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1514512770');
INSERT INTO `91yxq_admin_logger` VALUES ('28', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1514513130');
INSERT INTO `91yxq_admin_logger` VALUES ('29', '1', 'update', 'user_role_update', 'user', 'role', 'update', '/index.php?r=user%2Frole%2Findex', '角色管理-修改 - 普通管理员(name:manager)', '127.0.0.1', '1514513205');
INSERT INTO `91yxq_admin_logger` VALUES ('30', '1', 'update', 'user_user_pass-word-reset', 'user', 'user', 'pass-word-reset', '/index.php?r=user%2Fuser%2Findex', '重置用户密码 - manager(id:2)', '127.0.0.1', '1514513241');
INSERT INTO `91yxq_admin_logger` VALUES ('31', '1', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:admin(id:1)', '127.0.0.1', '1514513253');
INSERT INTO `91yxq_admin_logger` VALUES ('32', '2', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:manager(id:2)', '127.0.0.1', '1514513279');
INSERT INTO `91yxq_admin_logger` VALUES ('33', '2', 'logout', 'app-backend_site_logout', 'app-backend', 'site', 'logout', '', '成功登出:manager(id:2)', '127.0.0.1', '1514513346');
INSERT INTO `91yxq_admin_logger` VALUES ('34', '1', 'login', 'app-backend_site_login', 'app-backend', 'site', 'login', '', '成功登录:admin(id:1)', '127.0.0.1', '1514513353');
INSERT INTO `91yxq_admin_logger` VALUES ('35', '1', 'update', 'user_user_update', 'user', 'user', 'update', '/index.php?r=user%2Fuser%2Findex', '修改用户信息 - test11(id:2)', '127.0.0.1', '1514514306');

-- ----------------------------
-- Table structure for 91yxq_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_auth_assignment`;
CREATE TABLE `91yxq_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `91yxq_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `91yxq_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_auth_assignment
-- ----------------------------
INSERT INTO `91yxq_auth_assignment` VALUES ('admin', '1', '1491800027');
INSERT INTO `91yxq_auth_assignment` VALUES ('manager', '2', '1514513234');
INSERT INTO `91yxq_auth_assignment` VALUES ('manager', '3', '1491801778');
INSERT INTO `91yxq_auth_assignment` VALUES ('manager', '4', '1491801966');

-- ----------------------------
-- Table structure for 91yxq_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_auth_item`;
CREATE TABLE `91yxq_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `91yxq_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `91yxq_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_auth_item
-- ----------------------------
INSERT INTO `91yxq_auth_item` VALUES ('admin', '1', '超级管理员', null, null, '1491798921', '1491798921');
INSERT INTO `91yxq_auth_item` VALUES ('ad_ad_create', '2', '广告管理_创建', null, null, '1491800580', '1491800580');
INSERT INTO `91yxq_auth_item` VALUES ('ad_ad_delete', '2', '广告管理_删除', null, null, '1491800625', '1491800625');
INSERT INTO `91yxq_auth_item` VALUES ('ad_ad_index', '2', '广告管理_列表', null, null, '1491800550', '1491800550');
INSERT INTO `91yxq_auth_item` VALUES ('ad_ad_update', '2', '广告管理_修改', null, null, '1491800599', '1491800599');
INSERT INTO `91yxq_auth_item` VALUES ('ad_ad_view', '2', '广告管理_查看', null, null, '1491800650', '1491800650');
INSERT INTO `91yxq_auth_item` VALUES ('manager', '1', '普通管理员', null, null, '1491799307', '1514513205');
INSERT INTO `91yxq_auth_item` VALUES ('service', '1', '客服', null, null, '1491801875', '1491801875');
INSERT INTO `91yxq_auth_item` VALUES ('user_resources_create', '2', '资源管理_创建', null, null, '1491800354', '1491800354');
INSERT INTO `91yxq_auth_item` VALUES ('user_resources_delete', '2', '资源管理_删除', null, null, '1491800401', '1491800401');
INSERT INTO `91yxq_auth_item` VALUES ('user_resources_index', '2', '资源管理_列表', null, null, '1491800331', '1491800331');
INSERT INTO `91yxq_auth_item` VALUES ('user_resources_update', '2', '资源管理_修改', null, null, '1491800378', '1491800378');
INSERT INTO `91yxq_auth_item` VALUES ('user_resources_view', '2', '资源管理_查看', null, null, '1491800747', '1491800747');
INSERT INTO `91yxq_auth_item` VALUES ('user_role_create', '2', '角色管理_创建', null, null, '1491800455', '1491800455');
INSERT INTO `91yxq_auth_item` VALUES ('user_role_delete', '2', '角色管理_删除', null, null, '1491800501', '1491800501');
INSERT INTO `91yxq_auth_item` VALUES ('user_role_index', '2', '角色管理_列表', null, null, '1491800434', '1491800434');
INSERT INTO `91yxq_auth_item` VALUES ('user_role_update', '2', '角色管理_修改', null, null, '1491800484', '1491800484');
INSERT INTO `91yxq_auth_item` VALUES ('user_user_create', '2', '用户管理_创建', null, null, '1491800220', '1491800244');
INSERT INTO `91yxq_auth_item` VALUES ('user_user_del', '2', '用户管理_删除', null, null, '1491800277', '1491800277');
INSERT INTO `91yxq_auth_item` VALUES ('user_user_index', '2', '用户管理_列表', null, null, '1491800180', '1491800237');
INSERT INTO `91yxq_auth_item` VALUES ('user_user_update', '2', '用户管理_修改', null, null, '1491800260', '1491800260');

-- ----------------------------
-- Table structure for 91yxq_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_auth_item_child`;
CREATE TABLE `91yxq_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `91yxq_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `91yxq_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `91yxq_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `91yxq_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_auth_item_child
-- ----------------------------
INSERT INTO `91yxq_auth_item_child` VALUES ('manager', 'ad_ad_index');
INSERT INTO `91yxq_auth_item_child` VALUES ('manager', 'user_resources_index');
INSERT INTO `91yxq_auth_item_child` VALUES ('manager', 'user_role_index');

-- ----------------------------
-- Table structure for 91yxq_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_auth_rule`;
CREATE TABLE `91yxq_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for 91yxq_user
-- ----------------------------
DROP TABLE IF EXISTS `91yxq_user`;
CREATE TABLE `91yxq_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `group_type` tinyint(2) NOT NULL DEFAULT '4',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 91yxq_user
-- ----------------------------
INSERT INTO `91yxq_user` VALUES ('1', 'admin', 'admin', 'fv31ShgcQ996U3RTWE8YYO7bF7EGXGoq', '965eb72c92a549dd', null, '', '10', '10', '4', '1491800027', '1491800027');
INSERT INTO `91yxq_user` VALUES ('2', 'test11', '普通管理员', 'ySzxFhyeRhWu02gZNKn39rCb3jQPFJmX', '965eb72c92a549dd', null, '', '10', '10', '4', '1491800694', '1514514306');
