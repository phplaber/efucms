<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($singlepage_special["title"]); ?> — <?php echo C("APP_NAME");?></title>
<meta name="keywords" content="<?php echo ($singlepage_special["keywords"]); ?>" />
<meta name="description" content="<?php echo ($singlepage_special["description"]); ?>" />
<link rel="stylesheet" type="text/css" href="../Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/singlepage.css" />
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
<?php echo ($singlepage_special["fulltext"]); ?>
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