<?php
/*
**
** 单页文章控制器
**
*/
class EmptyAction extends Action
{
    Public function index()
	{
		// 获取导航栏目数据
		$obj_menu = M('Menu');
		$menu = $obj_menu->where('status = 1')->order('ordering ASC')->select();
		
		$obj_singlepage = M('Singlepage');
		// 获取某一单页文章相关信息
		$singlepage_special = $obj_singlepage->where('status = 1 and alias = "'.MODULE_NAME.'"')->find();
		// 获取单页文章数据
		$singlepage = $obj_singlepage->where('status = 1')->field('title, alias')->select();
		
		// 获取友情链接数据
		$obj_links = M('Links');
		$links = $obj_links->where('status = 1')->limit(10)->select();
		
		
		
		$this->assign("menu", $menu);
		$this->assign("singlepage_special", $singlepage_special);
		$this->assign("singlepage", $singlepage);
		$this->assign("links", $links);
		
		$this->display('singlepage/index');
	}
}
?>