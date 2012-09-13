<?php
// 列表页控制器
class MenuAction extends Action
{
    public function index()
    {
		$obj_menu = M('Menu');
		$menuinfo = $obj_menu->field('id, title, metakey, metadesc')->find($_GET['id']);	// 获取特定栏目ID相关信息，如title,metakey,metadesc等
		$menu = $obj_menu->where('status = 1')->order('ordering ASC')->select();
		$this->assign("menu", $menu);
		$this->assign("menuinfo", $menuinfo);
		
		$obj_content = M('Content');
		// 导入分页类
		import("ORG.Util.Page");
		$count = $obj_content->where('status =1 and menuid ='.$_GET['id'])->count();
		$p = new Page($count, C('LIST_PAGE'));
		$page = $p->show();
		// 根据栏目ID查找栏目下所有文章
		$list = $obj_content->where('status =1 and menuid ='.$_GET['id'])->field('id, title, ptime, description, hits')->limit($p->firstRow.','.$p->listRows)->order('ptime DESC')->select();
		// 获取每篇文章的评论数，压入数组
		$obj_comment = M('Comment');
		for($i=0; $i<count($list); $i++)
		{
			$list[$i]['comment'] = $obj_comment->where('artid ='.$list[$i]['id'])->count();
			array_push($list[$i]['comment']);
		}
		// 从内容数据表中依据'hits'字段的降序选取10篇文章
		$hotarticle = $obj_content->where('status = 1')->limit('10')->order('hits DESC')->select();
		for ($i=0; $i<10; $i++)
		{
			$hotarticle[$i]['_title'] = msubstr($hotarticle[$i]['title'], 0, 19);
			array_push($hotarticle[$i]['_title']);
		}
		$this->assign("list", $list);
		$this->assign("page", $page);
		$this->assign("hotarticle", $hotarticle);
		
		// 找出所有发布文章的id,title,keywords信息，获取文章标签
		$tags = $obj_content->where('status = 1')->field('id, title, keywords')->select();
		for ($i=0; $i<count($tags); $i++)
		{
			$tagslist[$i] = explode(',', $tags[$i]['keywords']);	// 将关键词串分割为数组
			$key = rand(0,count($tagslist[$i])+3);	// 随机选取某一关键词的key值(不一定存在)
			$tags[$i]['keywords'] = '<span style="color:#'.dechex(rand(0,255)).dechex(rand(0,255)).dechex(rand(0,255)).';font-size:'.rand(10, 23).'px;padding:0 1px;">'.$tagslist[$i][$key].'</span>';	
			// 用选取的关键词作为之前关键词串的代表
		}
		$this->assign("tags", $tags);
		
		// 获取友情链接数据
		$obj_links = M('Links');
		$links = $obj_links->where('status = 1')->limit(10)->select();
		$this->assign("links", $links);
		
		// 获取单页数据
		$obj_singlepage = M('Singlepage');
		$singlepage = $obj_singlepage->where('status = 1')->select();
		$this->assign("singlepage", $singlepage);
		
		$this->display('menu/index');
    }
}