<?php
// 文章管理模块
class ArticleAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_article = M('Content');
			$obj_menu = M('Menu');

			// 实现分页(*每一次翻页，查询一次数据库*)
			$articlesum = $obj_article->count();	// 文章总数
			$articlepage = 10;	// 每页10篇文章
			$pagesum = ceil($articlesum/$articlepage);	// 总的分页数
			$page = $_GET['page'];	// 当前页数
			if(!isset($page) || $page > $pagesum || $page < 1)	$page=1;
			$article = $obj_article->field('id,menuid,title,author,ptime,hits,status')->limit(($page-1)*$articlepage.', 10')
				->order('menuid')->select();
			
			// 将menuid对应的栏目名压入数组
			for($i=0; $i<count($article); $i++)
			{
				$menutitle = $obj_menu->field('title')->find($article[$i]['menuid']);
				$article[$i]['menutitle'] = $menutitle['title'];
				array_push($article[$i]['menutitle']);
			}
			
			switch($pagesum)
			{
				case 1:
					$prenext = '';
					break;
				
				case 2:
					if($page == 1)	$prenext = "<b>1</b>&nbsp;<a href='?page=2'>2</a>";
					if($page == 2)	$prenext = "<a href='?page=1'>1</a>&nbsp;<b>2</b>";
					break;
				
				case 3:
					if($page == 1)	$prenext = "<b>1</b>&nbsp;<a href='?page=2'>2</a>&nbsp;<a href='?page=3'>3</a>";
					if($page == 2)	$prenext = "<a href='?page=1'>1</a>&nbsp;<b>2</b>&nbsp;<a href='?page=3'>3</a>";
					if($page == 3)	$prenext = "<a href='?page=1'>1</a>&nbsp;<a href='?page=2'>2</a>&nbsp;<b>3</b>";
					break;
				
				default:
					if($page == 1)	$prenext = "Start&nbsp;Prev&nbsp;<b>1</b>&nbsp;<a href='?page=2'>2</a>&nbsp;<a href='?page=3'>3</a>&nbsp;<a href='?page=2'>Next</a>&nbsp;<a href='?page=".$pagesum."'>End</a>";
					if($page == 2)	$prenext = "<a href='?page=1'>Start</a>&nbsp;<a href='?page=1'>Prev</a>&nbsp;<a href='?page=1'>1</a>&nbsp;<b>2</b>&nbsp;<a href='?page=3'>3</a>&nbsp;<a href='?page=3'>Next</a>&nbsp;<a href='?page=".$pagesum."'>End</a>";
					if($page == 3)	$prenext = "<a href='?page=1'>Start</a>&nbsp;<a href='?page=2'>Prev</a>&nbsp;<a href='?page=1'>1</a>&nbsp;<a href='?page=2'>2</a>&nbsp;<b>3</b>&nbsp;<a href='?page=4'>Next</a>&nbsp;<a href='?page=".$pagesum."'>End</a>";
					if($page>3 && $page<$pagesum)	$prenext = "<a href='?page=1'>Start</a>&nbsp;<a href='?page=".($page-1)."'>Prev</a>&nbsp;<a href='?page=1'>1</a>&nbsp;<a href='?page=2'>2</a>&nbsp;<a href='?page=3'>3</a>&nbsp;<a href='?page=".($page+1)."'>Next</a>&nbsp;<a href='?page=".$pagesum."'>End</a>";
					if($page == $pagesum)	$prenext = "<a href='?page=1'>Start</a>&nbsp;<a href='?page=".($page-1)."'>Prev</a>&nbsp;<a href='?page=1'>1</a>&nbsp;<a href='?page=2'>2</a>&nbsp;<a href='?page=3'>3</a>&nbsp;Next&nbsp;End";
			}
			$this->assign("prenext", $prenext);
			$this->assign("article", $article);

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_article']))
			{
				$this->assign("message_article", $_SESSION['message_article']);
				unset($_SESSION['message_article']);
			}
			$this->display();

		}
	}

	// 进入创建文章页面
	public function addarticle()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_article = M('Content');
			$obj_menu = M('Menu');
			$articleid = $obj_article->query("SELECT MAX(id) AS id FROM __TABLE__");
			$menu = $obj_menu->field('id,title')->select();
			$this->assign("articleid", $articleid[0]['id']+1);
			$this->assign("menu", $menu);
			$this->display('article/add');
		}
	}

	// 删除文章操作
	public function deletearticle()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			array_pop($_POST);
			$obj_article=M('Content');
			foreach ($_POST as $value)
				$arr = $value;
			for($i=0; $i<count($arr); $i++)
			{
				if(!$obj_article->where('id='.$arr[$i])->delete())
					exit('oops!');
			}
			session_start();
			$_SESSION['message_article'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('article/index');
		}
	}

	// 编辑文章操作
	public function editarticle()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$aid = $_GET['id'];
			$obj_article = M('Content');
			$obj_menu = M('Menu');
			$article = $obj_article->find($aid);
			$menu = $obj_menu->field('id,title')->select();

			$this->assign("aid", $aid);
			$this->assign("article", $article);
			$this->assign("menu", $menu);
			// 如果保存成功，返回信息
			if(isset($_SESSION['message_article']))
			{
				$this->assign("message_article", $_SESSION['message_article']);
				unset($_SESSION['message_article']);
			}
			$this->display('article/edit');
		}
	}

	// 对新增文章表单进行处理
	public function add()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_article = M('Content');
			array_pop($_POST);
			array_pop($_POST);
			$_POST = array_filter($_POST);
			array_push($_POST['fulltextWidgToolbarSelectBlock'] = false);
			array_push($_POST['ptime'] = date("Y-m-d H:i:s", time()));
			array_push($_POST['hits'] = 0);

			if(!$obj_article->add($_POST))
				exit('oops!');
			session_start();
			$_SESSION['message_article'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('article/index');
		}
	}

	// 对更新文章表单进行处理
	public function update()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_article = M('Content');
			if($obj_article->where('id='.$_POST['id'])->save($_POST))
			{
				session_start();
				$_SESSION['message_article'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('article/index');
			}
			else
			{
				session_start();
				$_SESSION['message_article'] = "<span style='color:#fff;background:#FF0000;'>:(</span>";
				$this->redirect('article/index');
			}
		}
	}
}