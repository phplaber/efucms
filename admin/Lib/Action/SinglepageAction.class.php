<?php
// 单页管理模块
class SinglepageAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_singlepage = M('Singlepage');
			$singlepage = $obj_singlepage->order('id ASC')->select();
			//print_r($singlepage);
			$this->assign("singlepage",$singlepage);
			// 如果保存成功，返回信息
			if(isset($_SESSION['message_singlepage']))
			{
				$this->assign("message_singlepage", $_SESSION['message_singlepage']);
				unset($_SESSION['message_singlepage']);
			}
			$this->display();
		}
	}

	// 删除单页操作
	public function deletesinglepage()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			array_pop($_POST);
			$obj_singlepage = M('Singlepage');
			foreach ($_POST as $value)
				$arr = $value;
			for($i=0; $i<count($arr); $i++)
			{
				if(!$obj_singlepage->where('id='.$arr[$i])->delete())
					exit('oops!');
			}
			session_start();
			$_SESSION['message_singlepage'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('index');
		}
	}

	// 创建单页操作
	public function addsinglepage()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_singlepage = M('Singlepage');
			$singlepageid = $obj_singlepage->query("SELECT MAX(id) AS id FROM __TABLE__");
			$this->assign("singlepageid", $singlepageid[0]['id']+1);
			$this->display('singlepage/add');
		}
	}

	// 编辑单页操作
	public function editsinglepage()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$sid = $_GET['id'];
			$obj_singlepage = M('Singlepage');
			$singlepage = $obj_singlepage->find($sid);

			$this->assign("sid", $sid);
			$this->assign("singlepage", $singlepage);
			
			$this->display('singlepage/edit');
		}
	}

	// 对新增单页表单进行处理
	public function add()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_singlepage = M('Singlepage');
			array_pop($_POST);
			array_pop($_POST);
			array_push($_POST['fulltextWidgToolbarSelectBlock'] = false);
			$_POST = array_filter($_POST);
			//print_r($_POST);
			
			if(!$obj_singlepage->add($_POST))
				exit('oops!');
			session_start();
			$_SESSION['message_singlepage'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('index');
			
		}
	}

	// 对更新单页表单进行处理
	public function update()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_singlepage = M('Singlepage');
			if($obj_singlepage->where('id='.$_POST['id'])->save($_POST))
			{
				session_start();
				$_SESSION['message_singlepage'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('index');
			}
			else
			{
				session_start();
				$_SESSION['message_singlepage'] = "<span style='color:#fff;background:#FF0000;'>:(</span>";
				$this->redirect('index');
			}
		}
	}
}