<?php

/* 配置文件 (说明：修改配置文件后，需重新进行项目编译，修改才会生效。)*/
return array(
	// 数据库配置
	'DB_TYPE'=> 'mysql',      // 数据库类型
	'DB_HOST'=> 'localhost', // 数据库服务器地址
	'DB_NAME'=>'efucms',  // 数据库名称
	'DB_USER'=>'root', // 数据库用户名
	'DB_PWD'=>'198802102357', // 数据库密码
	'DB_PORT'=>'3306', // 数据库端口
	'DB_PREFIX'=>'efu_', // 数据表前缀

	// 应用配置
	'APP_NAME'=>'Easy For Use CMS',
	'APP_METAKEY'=>'CMS, 简单易用',
	'APP_METADESC'=>'EFUcms是一款简单易用的内容管理系统，提供了CMS所有最基本的功能。',
	'APP_ICP'=>'苏ICP备11033855号-1',
	'APP_YEAR'=> '2012',
	'LIST_PAGE' => 5,	// 栏目列表每页展示文章数
);
?>