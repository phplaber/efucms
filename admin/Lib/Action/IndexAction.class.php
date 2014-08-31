<?php
// 后台模块
class IndexAction extends Action
{
	// 显示登陆表单
    public function index()
    {
		// 导入验证码生成类
		vendor("Securimagev2.securimage");
		$img = new Securimage();
		$options = array(
				'show_audio_button' => false,
				'show_text_input' => false,
				'input_text' => '验证码'
		);
		// 生成验证码并传给view
		$this->assign('code', $img->getCaptchaHtml($options));

		$this->display('index/login');
    }

	// 处理登陆表单提交数据
	public function login()
	{
		$obj_admin = M('Admin');
		$admin = $obj_admin->find(1);
		vendor("Securimagev2.securimage");
		$img = new Securimage();
		//print_r($admin);
		if ($_POST['username'] == $admin['username'] && md5($_POST['password']) == $admin['password'] && $img->check($_POST['captcha_code']) == true)
		{
			session_start();
			$_SESSION['uid'] = $admin['id'];
			$_SESSION['username'] = $admin['username'];
			$_SESSION['password'] = $admin['password'];
			$this->redirect('index/home');
		} elseif ($img->check($_POST['captcha_code']) == false) 
		{
			header('Content-Type: text/html;charset=utf-8');
			exit('验证码不正确');
		}
		else
		{
			header('Content-Type: text/html;charset=utf-8');
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
		$this->index();
	}
}