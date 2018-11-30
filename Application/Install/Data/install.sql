/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : installtest

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-09-30 10:39:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_access
-- ----------------------------
DROP TABLE IF EXISTS `tb_access`;
CREATE TABLE `tb_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色标识',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '权限标识',
  `level` tinyint(1) NOT NULL COMMENT '层级',
  `module` varchar(50) DEFAULT NULL COMMENT '模块/控制器/方法',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of tb_access
-- ----------------------------

-- ----------------------------
-- Table structure for tb_node
-- ----------------------------
DROP TABLE IF EXISTS `tb_node`;
CREATE TABLE `tb_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点标识',
  `name` varchar(20) NOT NULL COMMENT '节点英文名称',
  `title` varchar(50) DEFAULT NULL COMMENT '节点中文名称',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 1：启用，0：禁用',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT '1' COMMENT '排序',
  `pid` smallint(6) unsigned NOT NULL COMMENT '父节点标识',
  `level` tinyint(1) unsigned NOT NULL COMMENT '等级 1：模块，2：控制器，3：方法',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of tb_node
-- ----------------------------
INSERT INTO `tb_node` VALUES ('1', 'Admin', '后台应用', '1', null, '1', '0', '1');
INSERT INTO `tb_node` VALUES ('2', 'Home', '前台应用', '1', null, '2', '0', '1');
INSERT INTO `tb_node` VALUES ('3', 'Index', '后台首页控制器', '1', null, '1', '1', '2');
INSERT INTO `tb_node` VALUES ('4', 'index', '首页列表', '1', null, '1', '3', '3');
INSERT INTO `tb_node` VALUES ('5', 'welcome', '欢迎界面', '1', null, '2', '3', '3');
INSERT INTO `tb_node` VALUES ('6', 'changePwd', '密码修改', '1', null, '1', '3', '3');
INSERT INTO `tb_node` VALUES ('7', 'Category', '分类控制器', '1', null, '2', '1', '2');
INSERT INTO `tb_node` VALUES ('8', 'index', '分类列表', '1', null, '1', '7', '3');
INSERT INTO `tb_node` VALUES ('9', 'addCategory', '添加分类', '1', null, '2', '7', '3');
INSERT INTO `tb_node` VALUES ('57', 'Index', '测试节点首页', '1', null, '1', '56', '2');
INSERT INTO `tb_node` VALUES ('56', 'Test', '测试节点', '1', null, '1', '0', '1');
INSERT INTO `tb_node` VALUES ('12', 'Goods', '商品控制器', '1', null, '3', '1', '2');
INSERT INTO `tb_node` VALUES ('13', 'index', '商品列表', '1', null, '1', '12', '3');
INSERT INTO `tb_node` VALUES ('14', 'addGoods', '商品添加', '1', null, '2', '12', '3');
INSERT INTO `tb_node` VALUES ('15', 'Login', '登录控制器', '1', null, '4', '1', '2');
INSERT INTO `tb_node` VALUES ('16', 'index', '登录页', '1', null, '1', '15', '3');
INSERT INTO `tb_node` VALUES ('17', 'out', '安全退出', '1', null, '2', '15', '3');
INSERT INTO `tb_node` VALUES ('18', 'verifyShow', '验证码', '1', null, '3', '15', '3');
INSERT INTO `tb_node` VALUES ('19', 'Rbac', 'Rbac权限管理控制器', '1', null, '0', '1', '2');
INSERT INTO `tb_node` VALUES ('20', 'role', '角色列表', '1', null, '1', '19', '3');
INSERT INTO `tb_node` VALUES ('21', 'addRole', '添加角色', '1', null, '2', '19', '3');
INSERT INTO `tb_node` VALUES ('22', 'editRole', '修改角色', '1', null, '3', '19', '3');
INSERT INTO `tb_node` VALUES ('23', 'delRole', '删除角色', '1', null, '4', '19', '3');
INSERT INTO `tb_node` VALUES ('24', 'node', '节点列表', '1', null, '5', '19', '3');
INSERT INTO `tb_node` VALUES ('25', 'addNode', '添加节点', '1', null, '6', '19', '3');
INSERT INTO `tb_node` VALUES ('26', 'editNode', '修改节点', '1', null, '7', '19', '3');
INSERT INTO `tb_node` VALUES ('27', 'delNode', '删除节点', '1', null, '8', '19', '3');
INSERT INTO `tb_node` VALUES ('28', 'nodeHandel', '编辑、添加节点表单处理', '1', null, '9', '19', '3');
INSERT INTO `tb_node` VALUES ('29', 'access', '分配权限列表', '1', null, '10', '19', '3');
INSERT INTO `tb_node` VALUES ('30', 'editAccess', '添加、修改权限', '1', null, '11', '19', '3');
INSERT INTO `tb_node` VALUES ('31', 'user', '用户列表', '1', null, '13', '19', '3');
INSERT INTO `tb_node` VALUES ('32', 'addUser', '添加用户', '1', null, '14', '19', '3');
INSERT INTO `tb_node` VALUES ('33', 'editUser', '修改用户', '1', null, '15', '19', '3');
INSERT INTO `tb_node` VALUES ('34', 'delUser', '删除用户', '1', null, '16', '19', '3');
INSERT INTO `tb_node` VALUES ('35', 'userHandel', '添加、修改用户表单处理', '1', null, '17', '19', '3');
INSERT INTO `tb_node` VALUES ('36', 'Index', '前台首页控制器', '1', null, '1', '2', '2');
INSERT INTO `tb_node` VALUES ('37', 'index', '前台首页', '1', null, '1', '36', '3');

-- ----------------------------
-- Table structure for tb_role
-- ----------------------------
DROP TABLE IF EXISTS `tb_role`;
CREATE TABLE `tb_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色标识',
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT '1' COMMENT 'level，0：超级管理员，1：其他',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 1：启用，0：未启用',
  `remark` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tb_role
-- ----------------------------

-- ----------------------------
-- Table structure for tb_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_role_user`;
CREATE TABLE `tb_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '角色标识',
  `user_id` char(32) DEFAULT NULL COMMENT '用户标识',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色、用户关联表';

-- ----------------------------
-- Records of tb_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户标识',
  `name` varchar(60) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `status` varchar(2) NOT NULL DEFAULT '1' COMMENT '状态 1：正常，0：不可用',
  `loginTime` varchar(20) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `loginIP` varchar(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `email` varchar(50) DEFAULT NULL COMMENT '用户邮箱',
  `auth` varchar(32) DEFAULT NULL COMMENT 'yan',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of tb_user
-- ----------------------------
