<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title><?php echo ($section["title"]); ?> — <?php echo C("APP_NAME");?></title>
<meta name="keywords" content="<?php echo ($section["metakey"]); ?>" />
<meta name="description" content="<?php echo ($section["metadesc"]); ?>" />
</head>
<body>
<div id="header">
<div class="menu">
<ul>
<?php if(is_array($section)): $i = 0; $__LIST__ = $section;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo U('index/section/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?>编号：<?php echo ($vo["id"]); ?><br/>
标题：<a href="<?php echo U('article/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a><br/>
时间：<?php echo ($vo["ptime"]); ?><br/>
简介：<?php echo ($vo["description"]); ?>...<br/><br/><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>