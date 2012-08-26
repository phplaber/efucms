<?php
return array(
	//'配置项'=>'配置值'
	'APP_DEBUG' => false, // 关闭调试模式
	'DB_TYPE'=> 'mysql',      // 数据库类型
	'DB_HOST'=> 'localhost', // 数据库服务器地址
	'DB_NAME'=>'efucms',  // 数据库名称
	'DB_USER'=>'root', // 数据库用户名
	'DB_PWD'=>'198802102357', // 数据库密码
	'DB_PORT'=>'3306', // 数据库端口
	'DB_PREFIX'=>'efu_', // 数据表前缀
	
	/* URL重写模式 */
	'URL_MODEL'      => 2,
	
	/* URL路由 */
	'URL_ROUTER_ON' => true,	// 开启URL路由
	'URL_ROUTE_RULES' => array(array('Index', 'Index/singlepage', 'name')),	// 定义URL路由规则

	/* URL伪静态 */
	'URL_HTML_SUFFIX' => '.html',	// 设置URL伪静态后缀

	/* URL大小写 */
	'URL_CASE_INSENSITIVE'  => true,	// URL不区分大小写（对Linux有效）

	/* 令牌验证 */
	'TOKEN_ON'=>true,	// 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',	// 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',	//令牌哈希验证规则 默认为MD5
	
	/* 应用配置 */
	'APP_NAME'=>'Easy For Use CMS',
	'APP_METAKEY'=>'CMS, 简单易用',
	'APP_METADESC'=>'EFUcms是一款简单易用的内容管理系统，提供了CMS所有最基本的功能。',
	'APP_YEAR'=>'2012',
	'APP_COMPANY'=>'开源软件实验室',
	'COMPANY_URL'=>'http://www.phplabor.com',
	'APP_ICP'=>'苏ICP备11033855号-1',
	'LIST_PAGE' =>'5',	// 栏目列表每页展示文章数
	
	'TMPL_CACHE_TIME'		=>	0,	// 关闭模板缓存
);
?>