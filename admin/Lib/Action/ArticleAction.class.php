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
			$this->display();

		}
	}

	// 编辑文章操作
	public function editarticle()
	{
		echo 'Hello World';
	}

	// 删除文章操作
	public function deletearticle()
	{
		echo 'hello world';
	}
}
?>