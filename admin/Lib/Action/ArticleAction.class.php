<?php

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
			// 查询文章表中字段menuid的值
			$menuid = $obj_article->field('menuid')->select();
			$article = $obj_article->field('id,menuid,title,author,ptime,hits,status')->select();
			// 通过menuid的值查找到对应的栏目，追加到数组$article
			for($i=0; $i<count($menuid); $i++)
			{
				$menutitle = $obj_menu->field('title')->find($menuid[$i]['menuid']);
				$article[$i]['menutitle'] = $menutitle['title'];
				array_push($article[$i]['menutitle']);
			}

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
			//print_r($_POST);
			$obj_article=M('Content');
			foreach ($_POST as $value)
				$arr = $value;
			for($i=0; $i<count($arr); $i++)
			{
				if(!$obj_article->where('id='.$arr[$i])->delete())
					exit('出现错误');
			}
			session_start();
			$_SESSION['message_article'] = ":-)";
			$this->redirect('article/index');
		}
	}

	// 对新增文章表单进行处理
	public function add()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			print_r($_POST);

			// 注：在将表单数据写入数据库前，不忘了将发布时间和点击数（默认为0）添加入其中。
		}
	}
}
?>