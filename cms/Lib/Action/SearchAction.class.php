<?php
// 搜索页控制器
class SearchAction extends Action
{
    Public function index()
	{
		$search = addslashes(trim($_POST['search']));
		if (!$search)
		{
			// TO DO
			exit('sorry');
		}
		$obj_menu = M('Menu');
		$menu = $obj_menu->where('status = 1')->order('ordering ASC')->select();

		$obj_content = M('Content');
		$searchresult = $obj_content->query("SELECT id, menuid, title, ptime, description, hits FROM `efu_content` WHERE `status` = 1 and `fulltext` LIKE '%".$search."%'");
		for ($i = 0; $i < count($searchresult); $i++)
		{
			// 将标题中的搜索词高亮显示
			$searchresult[$i]['title'] = str_replace($search, "<span style='background-color:#FFFF66;'>".$search."</span>", $searchresult[$i]['title']);
			
			// 将描述中的搜索词高亮显示
			$searchresult[$i]['description'] = str_replace($search, "<span style='background-color:#FFFF66;'>".$search."</span>", $searchresult[$i]['description']);
		}
		if (!$searchresult)
		{
			$this->assign("searchresult", 0);
			$this->assign("search", $_POST['search']);
		}
		else
		{
			for ($i=0; $i<count($searchresult); $i++)
			{
				$menutitle = $obj_menu->where('status = 1 and id ='.$searchresult[$i]['menuid'])->field('title')->find();
				$searchresult[$i]['menutitle'] = $menutitle['title'];
				array_push($searchresult[$i]['menutitle']);
			}

			$this->assign("searchresult", $searchresult);
			$this->assign("search", $_POST['search']);
		}

		// 获取友情链接数据
		$obj_links = M('Links');
		$links = $obj_links->where('status = 1')->limit(10)->order('ordering ASC')->select();
		
		// 获取单页数据
		$obj_singlepage = M('Singlepage');
		$singlepage = $obj_singlepage->where('status = 1')->order('id ASC')->select();
		
		$this->assign("menu", $menu);
		$this->assign("links", $links);
		$this->assign("singlepage", $singlepage);
		$this->display('menu/search');
	}
}