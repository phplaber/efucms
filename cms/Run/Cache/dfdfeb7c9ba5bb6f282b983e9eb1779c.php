<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索 <?php echo ($search); ?> 的结果</title>
<link rel="stylesheet" type="text/css" href="../Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/search.css" />
</head>
<body>
<!-- begin header -->
<div id="header">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td><a href="__APP__">首页</a></td>
<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><td><a href="<?php echo U('menu/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></td><?php endforeach; endif; else: echo "" ;endif; ?>
</tr>
</table>
</div>
<!-- //end header-->

<!-- begin container -->
<div id="container">
<p class="mark">搜索<strong><?php echo ($search); ?></strong>的结果：</p>
<ul>
    <?php if($searchresult != 0): ?><?php if(is_array($searchresult)): $i = 0; $__LIST__ = $searchresult;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                <p class="title"><a href="<?php echo U('article/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></p>
                <p class="desc"><?php echo ($vo["description"]); ?>...</p>
                <p class="other">栏目：<a href="<?php echo U('menu/index/id/'.$vo['menuid']);?>"><?php echo ($vo["menutitle"]); ?></a>  时间：<?php echo ($vo["ptime"]); ?>  点击数：<?php echo ($vo["hits"]); ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?><p class="not_found">没找到相关内容</p><p class="advise">搜索建议：&nbsp;使用更一般的关键词</p><?php endif; ?>
</ul>
</div>
<!-- //end container-->

<!-- begin footer -->
<div id="footer">
<!-- version 1.0 -->

<div class="links">
<ul>
	<li class="fl">友情链接：</li>
	<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["info"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<div class="copyright">
<ul>
    <?php if(is_array($singlepage)): $i = 0; $__LIST__ = $singlepage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo U('index/'.$vo['alias']);?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<p>Copyright &copy; <?php echo C("APP_YEAR");?> <a href="<?php echo C("COMPANY_URL");?>"><?php echo C("APP_COMPANY");?> </a>  All rights reserved <?php echo C("APP_ICP");?></p>
</div>

</div>
<!-- //end footer-->
</body>
</html>