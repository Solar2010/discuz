<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2019/3/11
 * Time: 10:57 AM
 */
return "
    CREATE TABLE IF NOT EXISTS `fly_category` (
      `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
      `pid` int unsigned not null DEFAULT 0 comment '上级id,默认0',
      `name` VARCHAR(50) NOT  NULL DEFAULT '' comment '分类名称',
      `description` VARCHAR(255) comment '分类描述',
      `logo` VARCHAR(255) NOT  null DEFAULT '' comment '分类图标',
      PRIMARY KEY (`id`),
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分类表';
    
    CREATE TABLE IF NOT EXISTS `fly_topic` (
      `id` int unsigned not null auto_increment comment '主键',
      `content` text not null DEFAULT '' comment '内容',
      `modify_time` int not null DEFAULT 0 commnet '修改时间',
      `publish_time` int not null DEFAULT 0 comment '发表时间',
      `title` VARCHAR(50) NOT NULL DEFAULT '' comment '帖子标题',
      `category_id` int unsigned not null default 0 comment '所属分类id',
      `user_id` int unsigned not null default 0 comment '用户id',
      `good` tinyint(1) unsigned not null default 0 comment '是否是精华帖,0:否 1:是',
      `top` tinyint(1) unsigned not null default 0 comment '是否置顶,0:否 1:是',
      PRIMARY KEY (`id`),
      KEY `category_id` (`category_id`),
      KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帖子表';
    
    CREATE TABLE IF NOT EXISTS `fly_topic_back` (
      `id` int unsigned not null auto_increment comment '主键',
      `modify_time` int unsigned not null default 0 comment '修改时间',
      `publish_time` int unsigned not null default 0 comment '发表时间',
      `topic_id` int insigned not null default 0 comment '帖子id',
      `user_id` int unsigned not null default 0 comment '答复人id',
      `content` text not null default '' commnet '答复内容',
      PRIMARY KEY (`id`),
      KEY `topic_id` (`topic_id`),
      KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='回帖表';
    
    CREATE TABLE IF NOT EXISTS `fly_user` (
      `id` int unsigned not null auto_increment comment '主键',
      `nick_name` VARCHAR(20) not null DEFAULT '' comment '用户昵称',
      `true_name` VARCHAR(20) not null DEFAULT '' comment '真实姓名',
      `password` VARCHAR(20) comment '登入密码',
      `sex` VARCHAR(10) comment '性别',
      `face` VARCHAR(255) comment '头像',
      `reg_time` int not null default 0 comment '注册时间',
      `email` VARCHAR(20) comment '邮箱',
      `mobile` VARCHAR(20) comment '手机',
      `type` tinyint(1) not null DEFAULT 0 comment '用户类型',
      PRIMARY KEY (`id`),
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户信息表';
";