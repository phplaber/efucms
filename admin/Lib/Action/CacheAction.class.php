<?php
// “缓存管理”模块
class CacheAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$this->assign("cache",array(
			"后台缓存"=>array("Cache"=>"./admin/Run/Cache","Temp"=>"./admin/Run/Temp","Logs"=>"./admin/Run/Logs","Data"=>"./admin/Run/Data"),
			"前台缓存"=>array("Cache"=>"./cms/Run/Cache","Temp"=>"./cms/Run/Temp","Logs"=>"./cms/Run/Logs","Data"=>"./cms/Run/Data")));

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_cache']))
			{
				$this->assign("message_cache", $_SESSION['message_cache']);
				unset($_SESSION['message_cache']);
			}
			$this->display();
		}
	}

	// 清除缓存操作
	public function clearCache()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$dir = $_POST['dir'];
			//print_r($dir);
			foreach($dir as $value)
			{
				$current_dir = @opendir($value); // 打开目录
				// 循环读取目录，如果是文件，删除之。
				while($item = readdir($current_dir))
				{
					if(is_file($value.'/'.$item))
						@unlink($value.'/'.$item);
				}
				@closedir($current_dir);
			}
			session_start();
			$_SESSION['message_cache'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('index');
		}
	}
}