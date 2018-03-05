/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mobadmin

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-12-23 14:21:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `real_name` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `phone` char(11) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '手机号',
  `comment` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '备注',
  `status` enum('live','disabled') COLLATE utf8_bin NOT NULL DEFAULT 'live',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  `created` timestamp NOT NULL DEFAULT 0 COMMENT '注册时间',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `login_ip` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `login_time` timestamp NULL DEFAULT NULL,
  `_version` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '6e01f16c079293f3a546c59b1b9c8abb', '', '', '', 'live', '1', '2017-12-07 16:48:58', '2017-12-07 16:48:58', '127.0.0.1', '2017-12-20 14:00:23', '0');
INSERT INTO `admin` VALUES ('2', 'admina是是是', '147141915db949059fbaaefc0fa1bc36', '', '', '', 'disabled', '1', '2017-12-11 16:46:15', '2017-12-11 16:46:15', '', null, '0');
INSERT INTO `admin` VALUES ('3', 'gdfg', '5be80b546f352fe4d1c93c34fa681bdb', '', '', '', 'live', '1', '2017-12-14 17:07:43', '2017-12-14 17:07:43', '', null, '0');
INSERT INTO `admin` VALUES ('4', '一天', '082345d85781e806a92957b53bd1b7fa', '', '', '', 'live', '1', '2017-12-20 14:12:39', '2017-12-20 14:12:39', '', null, '0');

-- ----------------------------
-- Table structure for `node`
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `module_name` varchar(155) NOT NULL DEFAULT '' COMMENT '模块名',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是菜单项 0不是 1是',
  `order` int(11) DEFAULT '0' COMMENT '排序',
  `pid` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '系统管理', '#', '#', '#', '1', '0', '0', 'fa fa-gears');
INSERT INTO `node` VALUES ('2', '角色列表', 'admin', 'role', 'index', '1', '0', '1', '');
INSERT INTO `node` VALUES ('3', '添加与编辑角色', 'admin', 'role', 'roleAddEdit', '0', '0', '1', '');
INSERT INTO `node` VALUES ('4', '删除角色', 'admin', 'role', 'roleDel', '0', '0', '1', '');
INSERT INTO `node` VALUES ('5', '分配权限', 'admin', 'role', 'giveaccess', '0', '0', '1', '');
INSERT INTO `node` VALUES ('6', '获取全部角色', 'admin', 'role', 'getRoles', '0', '0', '1', '');
INSERT INTO `node` VALUES ('7', '获取角色信息', 'admin', 'role', 'getRoleInfo', '0', '0', '1', '');
INSERT INTO `node` VALUES ('8', '管理员管理', '#', '#', '#', '1', '0', '0', 'fa fa-users');
INSERT INTO `node` VALUES ('9', '管理员列表', 'admin', 'admin', 'index', '1', '0', '8', '');
INSERT INTO `node` VALUES ('10', '添加与编辑用户', 'admin', 'admin', 'adminAddEdit', '0', '0', '8', '');
INSERT INTO `node` VALUES ('11', '删除用户', 'admin', 'admin', 'adminDel', '0', '0', '8', '');
INSERT INTO `node` VALUES ('12', '检查用户唯一性', 'admin', 'admin', 'checkAdminUnique', '0', '0', '8', '');
INSERT INTO `node` VALUES ('13', '获取管理员信息', 'admin', 'admin', 'getAdminInfo', '0', '0', '8', '');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '');
INSERT INTO `role` VALUES ('4', 'gdfgdfg', '');
