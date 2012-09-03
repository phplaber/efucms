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

	public function update()
	{
		if(!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$config = require "config.php";

			//print_r($config);
			foreach($_POST as $key=>$value)
			{
				$key = strtoupper($key);
				if(trim($value) != $config[$key])
					$config[$key] = trim($value);
			}
			array_pop($config);
			$str_config = substr(file_get_contents('config.php'), 5);
			echo $str_config;
			
		}
	}
}
?>