-- 创建商城数据库
CREATE DATABASE IF NOT EXISTS `mz1_shop`;

-- 使用库
USE `mz1_shop`;

-- 创建用户表
CREATE TABLE IF NOT EXISTS `mz1_user`(
    `id`    INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,-- ID
    `name`  VARCHAR(255) UNIQUE,-- 用户名
    `pwd`   CHAR(32),-- 密码
    `sex` TINYINT NOT NULL DEFAULT 1,-- 性别
    `phone` VARCHAR(255),-- 手机号
    `mail`  VARCHAR(255),-- 邮箱号
    `addr`  VARCHAR(255),-- 地址
    `reg_time` INT, -- 注册 时间
    `login_time` INT, -- 登录时间
    `points` INT,   -- 积分
    `user_type`  TINYINT -- 用户类型 0 普通会员   1 管理员
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- 添加一个管理员
 INSERT INTO `mz1_user` (`name`, `pwd`, `sex`, `user_type`) VALUES('admin',md5('123456'),'1','1');


-- 添加禁用户字段 1 禁用  0 放行
ALTER TABLE `mz1_user` ADD `disabled` TINYINT NOT NULL DEFAULT 0;


 insert into `mz1_user` (`name`, `pwd`, `sex`, `user_type`) values('shi',md5('123456'),'1','1');

CREATE TABLE IF NOT EXISTS `mz1_categroy`
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `pid` INT NOT NULL DEFAULT 0,
    `path` VARCHAR(255)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;



CREATE TABLE IF NOT EXISTS `mz1_goods`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`   VARCHAR(255),
    `cate_id` INT NOT NULL,
    `price` DECIMAL(10,2),
    `store` INT NOT NULL DEFAULT 0,
    `add_time` INT NOT NULL DEFAULT 0,
    `status`  TINYINT NOT NULL DEFAULT 1,
    `is_hot`  TINYINT NOT NULL DEFAULT 0,
    `is_best` TINYINT NOT NULL DEFAULT 0,
    `is_new`  TINYINT NOT NULL DEFAULT 0,
    `describe` VARCHAR(255) NOT NULL DEFAULT ''
)ENGINE InnoDB DEFAULT CHARSET=UTF8;



-- 商品图片表
CREATE TABLE IF NOT EXISTS `mz1_img`(
    `id`        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,    -- ID
    `name`      VARCHAR(255),                               -- 图片名称
    `goods_id`  INT UNSIGNED,                               -- 关联的商品id
    `is_face`   TINYINT NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `mz1_order`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ordernumber` VARCHAR(255) NOT NULL DEFAULT 'MZ',
    `userid` INT NOT NULL,
    `is_shou` TINYINT NOT NULL DEFAULT 0,
    `if_fu` TINYINT NOT NULL DEFAULT 0,
    `addtime` INT NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `mz1_order_info`(
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `orderid` int NOT NULL ,
    `goods_id`INT NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `num` INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `mz1_comment`(
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `comment`  VARCHAR(255) NOT NULL,
    `ordernum` INT NOT NULL,
    `is_ping`  VARCHAR(255) NOT NULL DEFAULT 'MZ1'
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;
