<?php

if (!defined('THINK_PATH')) exit();
$config = require "config.php";

$config_list = array(
	'URL_CASE_INSENSITIVE'  => true,	// URL不区分大小写（对Linux有效）
	'TOKEN_ON'=>true,	// 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',	// 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',	//令牌哈希验证规则 默认为MD5
	'TMPL_CACHE_TIME'		=>	0,	// 关闭模板缓存
);

//合并输出配置
return array_merge($config, $config_list);

?>