<?php
// 内容页控制器
class ArticleAction extends Action
{
    public function index()
    {
		$obj_menu = M('Menu');
		$menu = $obj_menu->where('status = 1')->order('ordering ASC')->field('id, title')->select();
		
		$obj_content = M('Content');
		// 根据文章ID获取特定文章相关信息
		$article = $obj_content->find($_GET['id']);
		$pro = $obj_content->where('id <'.$_GET['id'])->field('id, title')->order('id DESC')->limit(1)->find();	// 上一篇
		if ($pro == false)
		{
			$pro['id'] = 0;
			$pro['title'] = '第一篇';
		}
		$next = $obj_content->where('id >'.$_GET['id'])->field('id, title')->order('id ASC')->limit(1)->find();	// 下一篇
		if ($next == false)
		{
			$next['id'] = 0;
			$next['title'] = '最后一篇';
		}
		$menuid = $obj_menu->where('id ='.$article['menuid'])->field('id, title')->find();
		
		//	从内容数据表中依据'hits'字段的降序选取10篇文章
		$hotarticle = $obj_content->where('status = 1')->limit('10')->order('hits DESC')->select();
		for ($i=0; $i<10; $i++)
		{
			$hotarticle[$i]['_title'] = msubstr($hotarticle[$i]['title'], 0, 19);
			array_push($hotarticle[$i]['_title']);
		}
		
		// 找出所有发布文章的id,title,keywords信息，获取文章标签
		$tags = $obj_content->where('status = 1')->field('id, title, keywords')->select();
		for ($i=0; $i<count($tags); $i++)
		{
			$tagslist[$i] = explode(',', $tags[$i]['keywords']);	// 将关键词串分割为数组
			$key = rand(0,count($tagslist[$i])+3);	// 随机选取某一关键词的key值(不一定存在)
			$tags[$i]['keywords'] = '<span style="color:#'.dechex(rand(0,255)).dechex(rand(0,255)).dechex(rand(0,255)).';font-size:'.rand(10, 23).'px;padding:0 1px;">'.$tagslist[$i][$key].'</span>';	
			// 用选取的关键词作为之前关键词串的代表
		}
		
		// 获取友情链接数据
		$obj_links = M('Links');
		$links = $obj_links->where('status = 1')->limit(10)->select();
		
		// 获取单页数据
		$obj_singlepage = M('Singlepage');
		$singlepage = $obj_singlepage->where('status = 1')->select();

		// 显示文章评论
		$obj_comment = M('Comment');
		$show_comment = $obj_comment->where('artid ='.$_GET['id'])->field('id, cname, ctime, ctext, reply, url')->order('ctime DESC')->select();

		// 将日期转换为时间戳，以便进行日期自定义格式输出
		for ($i=0; $i<count($show_comment); $i++)
			$show_comment[$i]['ctime'] = strtotime($show_comment[$i]['ctime']);
		if ($show_comment == '') $show_comment = 0;
		
		$this->assign("menu", $menu);
		$this->assign("article", $article);
		$this->assign("pro", $pro);
		$this->assign("next", $next);
		$this->assign("menuid", $menuid);
		$this->assign("hotarticle", $hotarticle);
		$this->assign("tags", $tags);
		$this->assign("links", $links);
		$this->assign("singlepage", $singlepage);
		$this->assign("show_comment", $show_comment);
		$this->assign("artid", $_GET['id']);	// 将文章ID传给表单

		$this->display('article/index');
    }

	public function comment()
	{
		$obj_comment = M('Comment');
		$obj_comment->create();
		$obj_comment->ctime = date("Y-m-d H:i:s", time());	// 以日期的形式将当前时间写入数据库
		if($obj_comment->add())
			$this->redirect('article/index/id/'.$_POST['artid']);	// 重定向，重新加载页面。（试试：Ajax）
		else
			exit('oops!');
	}
}