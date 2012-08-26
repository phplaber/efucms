<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($article["title"]); ?> — <?php echo C("APP_NAME");?></title>
<meta name="keywords" content="<?php echo ($article["keywords"]); ?>" />
<meta name="description" content="<?php echo ($article["description"]); ?>" />
<link rel="stylesheet" type="text/css" href="../Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/right.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/article.css" />
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

<!-- container -->
<div id="container">
<div class="left">
<p class="breadcrumb">当前位置：<a href="__APP__">首页</a>&nbsp;<img src="../Public/images/arrow.png" />&nbsp;<a href="<?php echo U('menu/index/id/'.$menuid['id']);?>"><?php echo ($menuid["title"]); ?></a>&nbsp;<img src="../Public/images/arrow.png" />&nbsp;<?php echo ($article["title"]); ?></p>
<div class="article">
<p class="title"><?php echo ($article["title"]); ?></p>
<p class="info"><?php echo ($article["ptime"]); ?> - By <?php echo ($article["author"]); ?> - <?php echo ($article["hits"]); ?> views</p><br/><br/>
<p class="abstract">摘要：<?php echo ($article["description"]); ?></p>
<div class="fulltext"><?php echo ($article["fulltext"]); ?></div>
</div>
<!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare" style="padding: 0 10px;">
        <span class="bds_more">分享到：</span>
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
		<a class="shareCount"></a>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->
<div class="clear"></div>

<!-- 上下篇 -->
<div class="pronext">
    <p class="pro">上一篇：
        <?php if($pro["id"] == 0): ?><?php echo ($pro["title"]); ?>
        <?php else: ?><a href="<?php echo U('article/index/id/'.$pro['id']);?>"><?php echo ($pro["title"]); ?></a><?php endif; ?>
    </p>
	<p class="next">下一篇：
		<?php if($next["id"] == 0): ?><?php echo ($next["title"]); ?>
		<?php else: ?><a href="<?php echo U('article/index/id/'.$next['id']);?>"><?php echo ($next["title"]); ?></a><?php endif; ?>
    </p>
</div>

<!-- 评论 -->
<div class="comment">
	<div class="show_comment">
    <h3 id="check_comment">相关评论&nbsp;<a href="#post">发表</a></h3>
    <?php if($show_comment == 0): ?><p class="nocomment">暂无评论</p>
    <?php else: ?>
        <ul>
            <?php if(is_array($show_comment)): $i = 0; $__LIST__ = $show_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                	<p class="cname">
                    <?php if($vo["url"] != 'http://'): ?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cname"]); ?></a>&nbsp;说：
                    <?php else: ?><?php echo ($vo["cname"]); ?>&nbsp;说：<?php endif; ?></p>
                    <p class="ctext"><?php echo ($vo["ctext"]); ?></p>
                    <p class="ctime"><?php echo (date("m-d-Y H:i", $vo["ctime"])); ?> - <?php echo ($vo["id"]); ?>楼</p>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul><?php endif; ?>
    </div>
    <div class="post_comment">
    <h3 id="post">发表评论</h3><br/>
    	<form name="comment" method="post" action="__URL__/comment"  onSubmit="return validate_form(this)">
        {__TOKEN__} 
        <!-- 将文章ID交由程序写入数据库，实现评论和文章的 -->
        <input type="hidden" name="artid" value="<?php echo ($artid); ?>" />
        <p>
        	<textarea id="ctext" name="ctext" rows="7" cols="70" style="font-size:13px;" ></textarea>
        </p>
        <p>
        	<label for="cname" title="必填"><small>怎么称呼</small><span style="color: #F00;">*</span></label><br/>
            <input type="text" id="cname" name="cname" value="" size="23"/>
        </p>
        <p>
        	<label for="email" title="必填"><small>邮箱地址</small><span style="color: #F00;">*</span></label><br/>
            <input type="text" id="email" name="email" value="" size="23"/>
        </p>
        <p>
        	<label for="url"><small>博客URL</small></label><br/>
            <input type="text" id="url" name="url" value="" size="23"/>
        </p>
        <p class="submit"><input type="submit" name="post" value="提交发表" />&nbsp;&nbsp;&nbsp;&nbsp;<small style="font-size:12px;color:#ccc;">如果评论未显示，请等待审核。</small></p>
        </form>
    </div>
</div>
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
<!-- //container-->

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
<script type="text/javascript">
function check(field,alerttxt)
{
	with (field)
	{
	  if (value==null||value=="")
		{alert(alerttxt);return false}
	  else {return true}
	}
}

function validate_form(thisform)
{
	with (thisform)
  	{
		if (check(ctext,"请填写您的评论")==false)
    		{ctext.focus();return false}
		if (check(cname,"请填写您的称呼")==false)
			{cname.focus();return false}
		if (check(email,"请填写您的邮箱 (不会公开)")==false)
    		{email.focus();return false}
	}
}
</script>
</body>
</html>