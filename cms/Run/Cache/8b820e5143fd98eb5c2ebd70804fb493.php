<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($menuinfo["title"]); ?> — <?php echo C("APP_NAME");?></title>
<meta name="keywords" content="<?php echo ($menuinfo["metakey"]); ?>" />
<meta name="description" content="<?php echo ($menuinfo["metadesc"]); ?>" />
<link rel="stylesheet" type="text/css" href="../Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/right.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/listpage.css" />
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
<div class="left">
<p class="breadcrumb">当前位置：<a href="__APP__">首页</a>&nbsp;<img src="../Public/images/arrow.png" />&nbsp;<a href="<?php echo U('menu/index/id/'.$menuinfo['id']);?>"><?php echo ($menuinfo["title"]); ?></a></p>
<ul class="listpage">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
<p class="title"><a href="<?php echo U('article/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a><br/><span><?php echo ($vo["ptime"]); ?></span></p>
<p class="info"><?php echo ($vo["description"]); ?>...</p>
<p class="comment"><?php if($vo["comment"] != 0): ?><small><a href="<?php echo U('article/index/id/'.$vo['id']);?>#check_comment"><?php echo ($vo["comment"]); ?>条评论</a></small><?php else: ?><small>0条评论</small><?php endif; ?> - <?php echo ($vo["hits"]); ?> views</p>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<p class="page"><?php echo ($page); ?></p>
</div>
<div class="right">

<!-- 站内搜索 -->
<div class="search">
<form name="searchform" id="searchform" method="post" action="__APP__/search"> 
<table>
<tr>
<td style="text-align:left;"><input type="text" name="search" id="search" size="32" /></td>
<td style="text-align:right;"><input type="submit" value="搜索" /></td>
</tr>
</table>
</form>
</div>

<!-- 热门文章 -->
<div class="hotarticle">
<ol>
<h5>热门文章</h5>
<?php if(is_array($hotarticle)): $k = 0; $__LIST__ = $hotarticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$k;$mod = ($k % 2 )?><li><img src="../Public/images/num_<?php echo ($k); ?>.gif" /> <a href="<?php echo U('article/index/id/'.$vo['id']);?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ol>
</div>

<!-- 标签云 -->
<div class="tags">
<div class="tagsinner">
<h5>标签</h5>
<p>
<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('article/index/id/'.$vo['id']);?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["keywords"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</p>
</div>
</div>
</div>
</div>
<!-- //end container-->

<div class="clear"></div>
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