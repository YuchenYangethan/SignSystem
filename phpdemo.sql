-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2021-01-15 01:31:34
-- 服务器版本： 5.6.50-log
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdemo`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` mediumint(6) unsigned NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` int(10) NOT NULL DEFAULT '0',
  `lastlogintime` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(30) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `lastloginip`, `lastlogintime`, `mobile`, `realname`, `status`) VALUES
(1, 'kaifa', '9cbf8a4dcb8e30682b927f352d6559a0', 1931205683, 1610640916, 'MTMxMTExMTExMTE=', '5byg5LiJ', 1),
(2, 'xitong', '9cbf8a4dcb8e30682b927f352d6559a0', 1931205683, 1609689826, 'MTMxMjIyMjIyMjI=', '5byg5Zub', 1),
(3, 'huodong', '9cbf8a4dcb8e30682b927f352d6559a0', 1931205683, 1609689809, 'MTMxMzMzMzMzMzM=', '5byg5LqU', 1),
(4, 'xuesheng', '9cbf8a4dcb8e30682b927f352d6559a0', 1931205683, 1609689869, 'MTMxNDQ0NDQ0NDQ=', '5byg5YWt', 1);

-- --------------------------------------------------------

--
-- 表的结构 `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_group`
--

INSERT INTO `admin_group` (`id`, `name`, `description`, `rules`, `listorder`, `updatetime`) VALUES
(1, '系统管理员', '管理系统信息', '1,2,3,4,5,6,23,31', 0, 1476067479),
(2, '活动管理员', '管理活动信息', '7,8,9,10,11,12,37,38,23,31,39', 0, 1479969527),
(3, '学生管理员', '管理学生信息', '13,14,15,16,18,23,31,32,33,34,35,36', 0, 1479969527),
(4, '系统开发者', '拥有全部权限', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39', 0, 1477622552);

-- --------------------------------------------------------

--
-- 表的结构 `admin_group_access`
--

CREATE TABLE IF NOT EXISTS `admin_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_group_access`
--

INSERT INTO `admin_group_access` (`uid`, `group_id`) VALUES
(2, 1),
(3, 2),
(4, 3),
(1, 4);

-- --------------------------------------------------------

--
-- 表的结构 `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `id` int(10) unsigned NOT NULL,
  `m` varchar(15) NOT NULL,
  `c` varchar(20) NOT NULL,
  `a` varchar(20) NOT NULL,
  `querystring` varchar(255) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `ip` int(10) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_log`
--

INSERT INTO `admin_log` (`id`, `m`, `c`, `a`, `querystring`, `userid`, `username`, `ip`, `time`) VALUES
(369, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609852906),
(370, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205683, 1609853450),
(371, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853452),
(372, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853454),
(373, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853465),
(374, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853466),
(375, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853468),
(376, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853469),
(377, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853470),
(378, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853472),
(379, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853876),
(380, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853877),
(381, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853889),
(382, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853891),
(383, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853948),
(384, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853950),
(385, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853952),
(386, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853963),
(387, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853964),
(388, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853989),
(389, 'admin', 'Item', 'del', '', 1, 'kaifa', 1931205683, 1609853990),
(390, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853990),
(391, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609853992),
(392, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609853996),
(393, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609854084),
(394, 'admin', 'Item', 'edit', '', 1, 'kaifa', 1931205683, 1609854085),
(395, 'admin', 'Item', 'edititem', '', 1, 'kaifa', 1931205683, 1609854112),
(396, 'admin', 'Item', 'edit', '', 1, 'kaifa', 1931205683, 1609854113),
(397, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609854114),
(398, 'admin', 'Item', 'addredis', '', 1, 'kaifa', 1931205683, 1609854115),
(399, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609854117),
(400, 'admin', 'Item', 'info', '', 1, 'kaifa', 1931205683, 1609854117),
(401, 'admin', 'Item', 'info', '', 1, 'kaifa', 1931205683, 1609854155),
(402, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205683, 1609854222),
(403, 'admin', 'Order', 'list', '', 1, 'kaifa', 1931205683, 1609854229),
(404, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205683, 1609854500),
(405, 'admin', 'Stulist', 'info', '', 1, 'kaifa', 1931205683, 1609854503),
(406, 'admin', 'Order', 'list', '', 1, 'kaifa', 1931205683, 1609854508),
(407, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205683, 1609854509),
(408, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1609854513),
(409, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205328, 1609893152),
(410, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205328, 1609895213),
(411, 'admin', 'Item', 'edit', '', 1, 'kaifa', 1931205683, 1610635551),
(412, 'admin', 'User', 'info', '', 1, 'kaifa', 1931205683, 1610640985),
(413, 'admin', 'User', 'add', '', 1, 'kaifa', 1931205683, 1610641051),
(414, 'admin', 'User', 'edit', '', 1, 'kaifa', 1931205683, 1610641067),
(415, 'admin', 'User', 'del', '', 1, 'kaifa', 1931205683, 1610641079),
(416, 'admin', 'Item', 'info', '', 1, 'kaifa', 1931205683, 1610641101),
(417, 'admin', 'Item', 'add', '', 1, 'kaifa', 1931205683, 1610641178),
(418, 'admin', 'Item', 'edit', '', 1, 'kaifa', 1931205683, 1610641192),
(419, 'admin', 'Item', 'del', '', 1, 'kaifa', 1931205683, 1610641204),
(420, 'admin', 'Item', 'redis', '', 1, 'kaifa', 1931205683, 1610641223),
(421, 'admin', 'Order', 'list', '', 1, 'kaifa', 1931205683, 1610641332),
(422, 'admin', 'Order', 'order', '', 1, 'kaifa', 1931205683, 1610641344),
(423, 'admin', 'Stulist', 'info', '', 1, 'kaifa', 1931205683, 1610641428),
(424, 'admin', 'Stulist', 'add', '', 1, 'kaifa', 1931205683, 1610641439),
(425, 'admin', 'Stulist', 'edit', '', 1, 'kaifa', 1931205683, 1610641449),
(426, 'admin', 'Stulist', 'del', '', 1, 'kaifa', 1931205683, 1610641460),
(427, 'admin', 'Register', 'info', '', 1, 'kaifa', 1931205683, 1610641473),
(428, 'admin', 'Register', 'add', '', 1, 'kaifa', 1931205683, 1610641484),
(429, 'admin', 'Register', 'edit', '', 1, 'kaifa', 1931205683, 1610641497),
(430, 'admin', 'Register', 'del', '', 1, 'kaifa', 1931205683, 1610641506),
(431, 'admin', 'Set', 'password', '', 1, 'kaifa', 1931205683, 1610641519),
(432, 'admin', 'Log', 'log', '', 1, 'kaifa', 1931205683, 1610641530),
(433, 'admin', 'User', 'info', '', 1, 'kaifa', 1931205683, 1610645012),
(434, 'admin', 'User', 'add', '', 1, 'kaifa', 1931205683, 1610645134),
(435, 'admin', 'User', 'edit', '', 1, 'kaifa', 1931205683, 1610645251),
(436, 'admin', 'User', 'del', '', 1, 'kaifa', 1931205683, 1610645345),
(437, 'admin', 'Item', 'info', '', 1, 'kaifa', 1931205683, 1610645482);

-- --------------------------------------------------------

--
-- 表的结构 `cookie`
--

CREATE TABLE IF NOT EXISTS `cookie` (
  `id` int(20) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cookie`
--

INSERT INTO `cookie` (`id`, `mobile`, `token`) VALUES
(1, '13166666667', '50cc8868104c6e259583a3c649df11de');

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(20) NOT NULL,
  `num` int(20) NOT NULL,
  `number` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `num`, `number`, `name`, `time`) VALUES
(1, 4, 5, '冬奥会志愿者报名', '1610635632');

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` smallint(6) unsigned NOT NULL,
  `name` char(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) DEFAULT '0',
  `icon` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) DEFAULT NULL,
  `a` varchar(20) DEFAULT NULL,
  `data` varchar(50) NOT NULL DEFAULT '',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '999',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示(1:显示,2:不显示)',
  `updatetime` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`id`, `name`, `parentid`, `icon`, `c`, `a`, `data`, `tip`, `group`, `listorder`, `display`, `updatetime`) VALUES
(1, '日志信息', 0, 'xe761', 'Log', 'log', '', '', '', 7, 1, 1476175413),
(2, '用户管理', 0, 'xe761', 'User', 'index', '', '', '', 1, 1, 1476175413),
(3, '详情', 2, 'xe6a3', 'User', 'info', '', '', '', 0, 1, 1476175413),
(4, '添加', 2, 'xe6a3', 'User', 'add', '', '', '', 0, 1, 1476175413),
(5, '修改', 2, 'xe6a3', 'User', 'edit', '', '', '', 0, 1, 1476175413),
(6, '删除', 2, 'xe6a3', 'User', 'del', '', '', '', 0, 1, 1476175413),
(7, '活动管理', 0, 'xe761', 'Item', 'index', '', '', '', 2, 1, 1476175413),
(8, '详情', 7, 'xe6a3', 'Item', 'info', '', '', '', 0, 1, 1476175413),
(9, '添加', 7, 'xe6a3', 'Item', 'add', '', '', '', 0, 1, 1476175413),
(10, '修改', 7, 'xe6a3', 'Item', 'edit', '', '', '', 0, 1, 1476175413),
(11, '删除', 7, 'xe6a3', 'Item', 'del', '', '', '', 0, 1, 1476175413),
(12, '订单信息', 0, 'xe761', 'Order', 'index', '', '', '', 3, 1, 1476175413),
(13, '查看', 18, 'xe6a3', 'Stulist', 'info', '', '', '', 0, 1, 1476175413),
(14, '添加', 18, 'xe6a3', 'Stulist', 'add', '', '', '', 0, 1, 1476175413),
(15, '修改', 18, 'xe6a3', 'Stulist', 'edit', '', '', '', 0, 1, 1476175413),
(16, '删除', 18, 'xe6a3', 'Stulist', 'del', '', '', '', 0, 1, 1476175413),
(17, '修改密码', 23, '', 'Set', 'passwordchange', '', '', '', 999, 2, NULL),
(18, '学生信息管理', 0, 'xe761', 'Stulist', 'index', '', '', '', 4, 1, 1476175413),
(19, '新增用户', 4, '', 'User', 'adduser', '', '', '', 999, 2, NULL),
(20, '修改用户', 5, '', 'User', 'edituser', '', '', '', 999, 2, NULL),
(21, '删除用户', 6, '', 'User', 'deluser', '', '', '', 999, 2, NULL),
(22, '添加活动', 9, '', 'Item', 'additem', '', '', '', 999, 2, NULL),
(23, '密码修改', 0, 'xe761', 'Set', 'password', '', '', '', 6, 1, 1476175413),
(24, '修改活动', 10, '', 'Item', 'edititem', '', '', '', 999, 2, NULL),
(25, '删除活动', 11, '', 'Item', 'delitem', '', '', '', 999, 2, NULL),
(26, '添加学生', 14, '', 'Stulist', 'addstulist', '', '', '', 999, 2, NULL),
(27, '修改学生', 15, '', 'Stulist', 'editstulist', '', '', '', 999, 2, NULL),
(28, '删除学生', 16, '', 'Stulist', 'delstulist', '', '', '', 999, 2, NULL),
(29, '添加注册', 33, '', 'Register', 'addregister', '', '', '', 999, 2, NULL),
(30, '修改注册', 35, '', 'Register', 'editregister', '', '', '', 999, 2, NULL),
(31, '系统首页', 0, 'xe761', 'Index', 'index', '', '', '', 0, 1, 1476175413),
(32, '注册信息管理', 0, 'xe761', 'Register', 'index', '', '', '', 5, 1, NULL),
(33, '添加', 32, 'xe6a3', 'Register', 'add', '', '', '', 0, 1, NULL),
(34, '删除', 32, 'xe6a3', 'Register', 'del', '', '', '', 0, 1, NULL),
(35, '修改', 32, 'xe6a3', 'Register', 'edit', '', '', '', 0, 1, NULL),
(36, '详情', 32, 'xe6a3', 'Register', 'info', '', '', '', 0, 1, NULL),
(37, '根据活动id查看订单', 12, 'xe6a3', 'Order', 'list', '', '', '', 0, 1, NULL),
(38, '查看所有活动订单', 12, 'xe6a3', 'Order', 'order', '', '', '', 0, 1, NULL),
(39, 'idlist', 12, '', 'Order', 'idlist', '', '', '', 0, 2, NULL),
(40, '删除注册', 34, '', 'Register', 'delregister', '', '', '', 999, 2, NULL),
(41, '活动项目写入缓存', 7, 'xe761', 'Item', 'redis', '', '', '', 999, 1, NULL),
(42, '写入缓存', 41, '', 'Item', 'addredis', '', '', '', 999, 2, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `goods_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `mobile`, `goods_id`) VALUES
(16, '13166666667', 1);

-- --------------------------------------------------------

--
-- 表的结构 `stulist`
--

CREATE TABLE IF NOT EXISTS `stulist` (
  `id` int(20) NOT NULL,
  `stu_id` varchar(20) NOT NULL,
  `stu_name` varchar(20) NOT NULL,
  `enroll` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stulist`
--

INSERT INTO `stulist` (`id`, `stu_id`, `stu_name`, `enroll`) VALUES
(1, '2001200000', '5byg5LiJ', '2020'),
(2, '2001200001', '5p2O5Zub', '2020'),
(3, '2001200002', '5byg5LqU', '2020'),
(4, '2001200003', '5p2O5YWt', '2020'),
(8, '2001200004', 'eXl5eXk=', '2020');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  `studentid` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `mobile`, `password`, `username`, `studentid`) VALUES
(8, '13166666666', '9cbf8a4dcb8e30682b927f352d6559a0', '5bCR5aWz', '2001200000'),
(9, '16666666666', '9cbf8a4dcb8e30682b927f352d6559a0', '546L5a2Q', '2001200001'),
(10, '13166666667', '9cbf8a4dcb8e30682b927f352d6559a0', '6JaE6I2357u/', '2001200002'),
(12, '13166666668', '9cbf8a4dcb8e30682b927f352d6559a0', '5bCP576K', '2001200003');

-- --------------------------------------------------------

--
-- 表的结构 `www_cookie`
--

CREATE TABLE IF NOT EXISTS `www_cookie` (
  `id` int(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `www_cookie`
--

INSERT INTO `www_cookie` (`id`, `username`, `token`) VALUES
(1, 'admin', '2f1cbdb6be66e862bab55efbb47a8ec6'),
(2, 'sushe', 'c4ff4e67c57ba9674aa6c69d743f933b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listorder` (`listorder`);

--
-- Indexes for table `admin_group_access`
--
ALTER TABLE `admin_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `parentid` (`parentid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stulist`
--
ALTER TABLE `stulist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `www_cookie`
--
ALTER TABLE `www_cookie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=438;
--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `stulist`
--
ALTER TABLE `stulist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `www_cookie`
--
ALTER TABLE `www_cookie`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
