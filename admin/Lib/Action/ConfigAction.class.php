<?php
/* 网站配置模块 */
class ConfigAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$config = require "config.php";
			//print_r($config);
			$this->assign("config", $config);
			$this->display();
		}
	}
}
?>