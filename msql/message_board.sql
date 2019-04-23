-- ----------------------------
-- Table structure for `message_user`
-- ----------------------------
drop table  if exists message_user;
create table message_user (
  id mediumint  NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  account varchar(100) NOT NULL COMMENT '登录账号',
  username varchar(50) NOT NULL COMMENT '用户名',
  password varchar(100) NOT NULL,
  sex tinyint DEFAULT 3 COMMENT '用户性别（0、女 1、男 3、保密）',
  image varchar(100) COMMENT '用户照片保存路径',
  status tinyint NOT NULL COMMENT '用户类型（1、管理员 2、普通用户）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table index for `user`
-- ----------------------------
create index user_index on message_user (
  account, password
);

-- ---------------------------------------
-- Table structure for `message_theme`
-- ---------------------------------------
drop table if exists message_theme;

create table message_theme (
  id int not null auto_increment,
  user_id mediumint not null comment '用户id（记录发布帖子用户）',
  title text not null comment '帖子的标题',
  context text not null comment '帖子的内容（可以是单纯的图片，也可以是纯文本）',
  response_num mediumint default 0 not null comment '回复数量，用来排序',
  time datetime not null,
  primary key (id)
) engine=InnoDB default charset=utf8 comment '帖子表';

-- ---------------------------------------
-- Table structure for `message_response`
-- ---------------------------------------
drop table if exists message_response;
create table message_response (
  id int not null auto_increment,
  theme_id int not null comment '回复的帖子id',
  father_id int not null comment '父楼id',
  response_id int not null comment '回复留言的留言id',
  user_response mediumint not null comment '留言回复者id',
  user_accept mediumint not null comment '留言接收者id',
  agree mediumint not null comment '留言点赞数（用于排序）',
  report mediumint not null comment '举报数',
  context text not null comment '帖子的内容（可以是单纯的图片，也可以是纯文本)',
  time datetime not null,
  primary key (id)
)engine=InnoDB default charset=utf8 comment '留言表';

-- ---------------------------------------
-- Table Index for `message_response`
-- ---------------------------------------
create index response_index on message_response (
  theme_id,father_id,response_id,user_response,user_accept
);

-- ---------------------------------------
-- Table structure for `message_notice`
-- ---------------------------------------

drop table if exists message_notice;
create table message_notice (
  id int not null auto_increment,
  response_id int not null comment '自己被回复的留言id（等于response表中的response_id）' ,
  notice_id int not null comment '别人回复的留言id',
  user_response mediumint not null comment '留言回复者id',
  user_accept mediumint not null comment '留言接收者id(检索条件，确定通知的人)',
  view tinyint not null default 1 comment '是否查看留言（2:查看 1:未查看）',
  primary key(id)
)engine=InnoDB default charset=utf8 comment '留言通知表';

-- ---------------------------------------
-- Table Index for `message_notice`
-- ---------------------------------------
create index response_index on message_notice (
  user_accept
);
