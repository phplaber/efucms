<?php

class IndexAction extends Action
{
	// 显示登陆表单
    public function index()
    {
		$this->display('index/login');
    }
	
	// 处理登陆表单提交数据
	public function login()
	{
		$obj_admin = M('Admin');
		$admin = $obj_admin->find(1);
		//print_r($admin);
		if ($_POST['username'] == $admin['username'] && md5($_POST['password']) == $admin['password'])
		{
			session_start();
			$_SESSION['uid'] = $admin['id'];
			$_SESSION['username'] = $admin['username'];
			$_SESSION['password'] = $admin['password'];
			$this->redirect('index/home');
		}
		else
		{
			exit('没有权限');
		}
	}
	
	// 显示后台首页
	public function home()
	{
		if (isset($_SESSION['uid']))
			$this->display('index/home');
		else
			$this->redirect('index/index');	// 重定向到index模块的index操作
	}

	// 登出后台管理
	public function logout()
	{
		if (isset($_SESSION['uid']))
		{
			unset($_SESSION['uid']);
			unset($_SESSION['username']);
			unset($_SESSION['password']);
		}
		$this->display('index/login');
	}


}
?>