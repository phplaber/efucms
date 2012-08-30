<?php

/* 网站后台入口文件 */
//定义ThinkPHP框架路径
define('THINK_PATH', 'ThinkPHP');

//定义项目名称和路径
define('ROOT_PATH', '.');
define('APP_NAME', 'admin');
define('APP_PATH', './admin');

//自定义核心编译缓存文件和项目编译缓存文件路径
define('RUNTIME_PATH', APP_PATH.'/Run/');

//加载框架公共文件（必须）
require(THINK_PATH."/ThinkPHP.php");

//实例化一个网站App应用（必须）
//App为应用程序类，负责应用过程的调度，存放于"\ThinkPHP\Lib\Think\Core"目录下
App::run();

?>
