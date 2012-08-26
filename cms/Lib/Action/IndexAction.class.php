<?php
/*
**
** 首页控制器
**
*/
class IndexAction extends Action
{
    public function index()
    {
		// 获取导航栏目数据
		$obj_menu = M('Menu');
		$menu = $obj_menu->where('status = 1')->order('ordering ASC')->select();
		$this->assign("menu", $menu);	// !!!important（因为下面操作重写了$menu，所以不能移到下面统一赋值）
		
		$obj_content = M('Content');
		for ($i=1; $i<5; $i++)
		{
			// 从4个栏目中各选取7篇文章展示
			$content_menu[$i] = $obj_content->where('status = 1 and menuid = '.$i)->limit(7)->order('ptime DESC')->select();
			// 对文章标题进行截取，同时能给每篇文章的链接加上完整的'title'属性值
			for ($j=0; $j<7; $j++)
			{
				$content_menu[$i][$j]['_title'] = msubstr($content_menu[$i][$j]['title'], 0, 20).'...';	// 对文章标题进行截取处理
				array_push($content_menu[$i][$j]['_title']);	// 将截取的部分压入数组
			}
			$menu[$i] = $obj_menu->where('status = 1 and id = '.$i)->field('id,title')->find();	// 获取栏目名称
			$this->assign("menu_".$i, $menu[$i]);
			$this->assign("menu".$i, $content_menu[$i]);
		}
		
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
		//print_r($tags);
		
		
		// 获取友情链接数据
		$obj_links = M('Links');
		$links = $obj_links->where('status = 1')->limit(10)->select();
		//print_r($links);
		
		
		// 获取单页数据
		$obj_singlepage = M('Singlepage');
		$singlepage = $obj_singlepage->where('status = 1')->select();
		//print_r($singlepage);
		
		$this->assign("tags", $tags);
		$this->assign("hotarticle", $hotarticle);
		$this->assign("links", $links);
		$this->assign("singlepage", $singlepage);
		$this->display();
    }
}
?>