<?php
// 网站配置模块
class ConfigAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$config = require "config.php";
			$this->assign("config", $config);

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_config']))
			{
				$this->assign("message_config", $_SESSION['message_config']);
				unset($_SESSION['message_config']);
			}
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

			$str_config = "<?php return array('DB_PWD'=>'198802102357',";
			array_push($_POST, $_POST['__hash__']=0);
			array_pop($_POST);
			$_POST = array_filter($_POST);
			foreach($_POST as $key=>$value)
			{
				$key = strtoupper($key);
				if(trim($value) != $config[$key])
					$config[$key] = trim($value);
				$str_config .= "'".$key."'=>"."'".$config[$key]."',";
			}
			$str_config = substr($str_config, 0, -1).");";
			if(file_put_contents('config.php', $str_config))
			{
				session_start();
				$_SESSION['message_config'] = ":)";
				$this->redirect('config/index');
			}
			else
			{
				session_start();
				$_SESSION['message_config'] = "<span style='color:red;'>:(</span>";
				$this->redirect('config/index');
			}
		}
	}
}