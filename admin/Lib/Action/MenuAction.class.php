<?php
// 栏目管理模块
class MenuAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_menu = M('Menu');
			$obj_content = M('Content');
			$menuitem = $obj_menu->field('id, title, status, ordering')->select();
			for($i=0; $i<count($menuitem); $i++)
			{
				$menuitem[$i]['articlesum'] = $obj_content->where('menuid='.$menuitem[$i]['id'])->count();
				array_push($menuitem[$i]['articlesum']);
			}
			$this->assign("menuitem", $menuitem);

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_menu']))
			{
				$this->assign("message_menu", $_SESSION['message_menu']);
				unset($_SESSION['message_menu']);
			}
			$this->display();
		}
	}

	public function editMenu()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_menu = M('Menu');
			$menuid = $_GET['id'];
			$menu = $obj_menu->find($menuid);
			$menuordering = $obj_menu->field('title,ordering')->select();
			$this->assign("menu", $menu);
			$this->assign("ordering", $menuordering);

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_menu']))
			{
				$this->assign("message_menu", $_SESSION['message_menu']);
				unset($_SESSION['message_menu']);
			}
			$this->display('menu/edit');
		}
	}

	public function addMenu()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_menu = M('Menu');
			$menuid = $obj_menu->query("SELECT MAX(id) AS id FROM __TABLE__");
			$menuordering = $obj_menu->field('title,ordering')->select();
			$this->assign("ordering", $menuordering);
			$this->assign("menuid", $menuid[0]['id']+1);
			$this->display('menu/add');
		}
	}

	public function deleteMenu()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_menu = M('Menu');
			array_pop($_POST);
			foreach($_POST as $value)
				$arr = $value;
			for($i=0; $i<count($arr); $i++)
			{
				if(!$obj_menu->where('id='.$arr[$i])->delete())
					exit('出现错误');
			}
			session_start();
			$_SESSION['message_menu'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('menu/index');
		}
	}
	
	// 更新菜单
	public function update()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_menu = M('Menu');
			if($obj_menu->where('id='.$_POST['id'])->save($_POST))
			{
				session_start();
				$_SESSION['message_menu'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('menu/editmenu');
			}
			else
			{
				session_start();
				$_SESSION['message_menu'] = "<span style='color:#fff;background:red;'>:(</span>";
				$this->redirect('menu/editmenu');
			}
		}
	}
	
	// 新增菜单
	public function add()
	{
		$obj_menu = M('menu');
		$obj_menu->create();

		// 在排序时，新建菜单排序数为选择项排序数加1
		$obj_menu->ordering += 1;
		if($obj_menu->add())
		{
			session_start();
			$_SESSION['message_menu'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('menu/index');
		}
		else
		{
			session_start();
			$_SESSION['message_menu'] = "<span style='color:#fff;background:red;'>:(</span>";
			$this->redirect('menu/index');
		}
	}
}