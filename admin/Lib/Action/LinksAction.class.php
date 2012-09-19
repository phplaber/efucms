<?php
// 友情链接管理模块
class LinksAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			$links = $obj_links->field('id,title,url,status')->order('id ASC')->select();
			//print_r($links);
			$this->assign("links", $links);
			// 如果保存成功，返回信息
			if(isset($_SESSION['message_links']))
			{
				$this->assign("message_links", $_SESSION['message_links']);
				unset($_SESSION['message_links']);
			}
			$this->display();
		}
	}

	// 删除友链操作
	public function deleteLinks()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			if($obj_links->where('id='.$_GET['id'])->delete())
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('links/index');
			}
			else
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:red;'>:(</span>";
				$this->redirect('links/index');
			}
		}
	}

	// 编辑友链操作
	public function editLinks()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			$links = $obj_links->find($_GET['id']);
			$linksordering = $obj_links->field('title,ordering')->select();
			//print_r($links);
			$this->assign("links", $links);
			$this->assign("ordering", $linksordering);

			$this->display('links/edit');
			
		}
	}

	// 创建友链操作
	public function addLinks()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			$linksid = $obj_links->query("SELECT MAX(id) AS id FROM __TABLE__");
			$linksordering = $obj_links->field('title,ordering')->order('ordering ASC')->select();
			//print_r($linksid);
			
			$this->assign("ordering", $linksordering);
			$this->assign("linksid", $linksid[0]['id']+1);
			$this->display('links/add');
		}
	}

	// 新增友链
	public function add()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			$obj_links->create();
			// 在排序时，新建友链排序数为选择项排序数加1
			$obj_links->ordering += 1;
			if($obj_links->add())
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('links/index');
			}
			else
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:red;'>:(</span>";
				$this->redirect('links/index');
			}
		}
	}

	// 更新友链
	public function update()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_links = M('Links');
			if($obj_links->where('id='.$_POST['id'])->save($_POST))
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('links/index');
			}
			else
			{
				session_start();
				$_SESSION['message_links'] = "<span style='color:#fff;background:red;'>:(</span>";
				$this->redirect('links/index');
			}
		}
	}
}