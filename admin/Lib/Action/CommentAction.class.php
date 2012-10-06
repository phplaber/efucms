<?php
// 评论管理模块
class CommentAction extends Action
{
	public function index()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_comment = M('Comment');
			$obj_content = M('Content');

			// 实现分页(*每一次翻页，查询一次数据库*)
			$commentsum = $obj_comment->count();	// 评论总数
			$commentpage = 5;	// 每页5条评论
			$pagesum = ceil($commentsum/$commentpage);	// 总的分页数
			$page = $_GET['page'];	// 当前页数
			if(!isset($page) || $page > $pagesum || $page < 1)	$page=1;

			$comment = $obj_comment->limit(($page-1)*$commentpage.', 5')->order('artid')->select();
			// 将评论文章题目压入数组
			for($i=0; $i<count($comment); $i++)
			{
				$arttitle = $obj_content->field('title')->find($comment[$i]['artid']);
				$comment[$i]['arttitle'] = $arttitle['title'];
				array_push($comment[$i]['arttitle']);
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
			$this->assign("comment", $comment);

			// 如果保存成功，返回信息
			if(isset($_SESSION['message_comment']))
			{
				$this->assign("message_comment", $_SESSION['message_comment']);
				unset($_SESSION['message_comment']);
			}
			$this->display();
		}
	}

	// 删除评论方法
	public function deleteComment()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			//$cid = $_GET['id'];
			$obj_comment = M('Comment');
			if(!$obj_comment->where('id='.$_GET['id'])->delete())
				exit('出现错误');
			session_start();
			$_SESSION['message_comment'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
			$this->redirect('comment/index');
		}
	}

	// 编辑评论方法
	public function editComment()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_comment = M('Comment');
			$obj_content = M('Content');
			$comment = $obj_comment->order('artid')->find($_GET['id']);
			$arttitle = $obj_content->field('title')->where('id='.$comment['artid'])->find();
			$comment['title'] = $arttitle['title'];
			array_push($comment['title']);	// 将所评论的文章标题写入数组

			$this->assign("comment", $comment);
			$this->display('comment/edit');
		}
	}

	// 更新评论
	public function update()
	{
		if (!isset($_SESSION['uid']))
			$this->redirect('index/index');	// 重定向到index模块的index操作
		else
		{
			$obj_comment = M('Comment');
			if($obj_comment->where('id='.$_POST['id'])->save($_POST))
			{
				session_start();
				$_SESSION['message_comment'] = "<span style='color:#fff;background:#33CC00;'>:)</span>";
				$this->redirect('comment/index');
			}
			else
			{
				session_start();
				$_SESSION['message_comment'] = "<span style='color:#fff;background:red;'>:(</span>";
				$this->redirect('comment/index');
			}
		}
	}
}