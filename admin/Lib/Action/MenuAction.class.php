<?php

class MenuAction extends Action
{
	public function index()
	{
		$obj_menu = M('Menu');
		$obj_content = M('Content');
		$menuitem = $obj_menu->field('id, title, status, ordering')->select();
		for($i=0; $i<count($menuitem); $i++)
		{
			$menuitem[$i]['articlesum'] = $obj_content->where('menuid='.$menuitem[$i]['id'])->count();
			array_push($menuitem[$i]['articlesum']);
		}
		//print_r($menuitem);
		$this->assign("menuitem", $menuitem);
		$this->display();
	}
}
?>