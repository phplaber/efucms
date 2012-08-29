<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("APP_NAME");?></title>
<meta name="keywords" content="<?php echo C("APP_METAKEY");?>" />
<meta name="description" content="<?php echo C("APP_METADESC");?>" />
<link rel="stylesheet" type="text/css" href="../Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/right.css" />
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
<div class="slideshow">
<script type="text/javascript"> 
var widths=640; 
var heights=230; 
var counts=4; 
img1=new Image ();img1.src='__PUBLIC__/images/upload/spring.jpg'; 
img2=new Image ();img2.src='__PUBLIC__/images/upload/summer.jpg'; 
img3=new Image ();img3.src='__PUBLIC__/images/upload/autumn.jpg'; 
img4=new Image ();img4.src='__PUBLIC__/images/upload/winter.jpg'; 
url1=new Image ();url1.src=''; 
url2=new Image ();url2.src=''; 
url3=new Image ();url3.src=''; 
url4=new Image ();url4.src=''; 
var nn=1; 
var key=0; 
function change_img() 
{if(key==0){key=1;} 
else if(document.all) 
{document.getElementById("pic").filters[0].Apply();document.getElementById("pic").filters[0].Play(duration=2);} 
eval('document.getElementById("pic").src=img'+nn+'.src'); 
eval('document.getElementById("url").href=url'+nn+'.src'); 
for (var i=1;i <=counts;i++){document.getElementById("xxjdjj"+i).className='axx';} 
document.getElementById("xxjdjj"+nn).className='bxx'; 
nn++;if(nn>counts){nn=1;} 
tt=setTimeout('change_img()',4000);} 
function changeimg(n){nn=n;window.clearInterval(tt);change_img();} 
document.write(' <style>'); 
document.write('.axx{padding:1px 7px;border-left:#cccccc 1px solid;}'); 
document.write('a.axx:link,a.axx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#666;}'); 
document.write('a.axx:active,a.axx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#999;}'); 
document.write('.bxx{padding:1px 7px;border-left:#cccccc 1px solid;}'); 
document.write('a.bxx:link,a.bxx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}'); 
document.write('a.bxx:active,a.bxx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}'); 
document.write(' </style>'); 
document.write(' <div style="width:'+widths+'px;height:'+heights+'px;overflow:hidden;text-overflow:clip;margin:0 auto;padding:5px 0;">'); 
document.write(' <div> <a id="url"> <img id="pic" style="border:0px;filter:progid:dximagetransform.microsoft.wipe(gradientsize=1.0,wipestyle=4, motion=forward)" width='+widths+' height='+heights+' /> </a> </div>'); 
document.write('<div style="text-align:right;top:-20px;right:5px;position:relative;height:15px;padding:0px;margin:1px;border:0px;">');
for(var i=1;i<counts+1;i++){document.write('<a href="javascript:changeimg('+i+');" id="xxjdjj'+i+'" class="axx" target="_self">'+i+'</a>');}
document.write(' </div> </div>'); 
change_img(); 
</script>
</div>
<div class="left_top">
<div class="menu1">
<h5><?php echo ($menu_1["title"]); ?><a href="<?php echo U('menu/index/id/'.$menu_1['id']);?>">更多</a></h5>
<ul>
<?php if(is_array($menu1)): $i = 0; $__LIST__ = $menu1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><img src="../Public/images/arrow.png" /> <a href="<?php echo U('article/index/id/'.$vo['id']);?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<div class="menu2">
<h5><?php echo ($menu_2["title"]); ?><a href="<?php echo U('menu/index/id/'.$menu_2['id']);?>">更多</a></h5>
<ul>
<?php if(is_array($menu2)): $i = 0; $__LIST__ = $menu2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><img src="../Public/images/arrow.png" /> <a href="<?php echo U('article/index/id/'.$vo['id']);?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>
<div class="left_bottom">
<div class="menu3">
<h5><?php echo ($menu_3["title"]); ?><a href="<?php echo U('menu/index/id/'.$menu_3['id']);?>">更多</a></h5>
<ul>
<?php if(is_array($menu3)): $i = 0; $__LIST__ = $menu3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><img src="../Public/images/arrow.png" /> <a href="<?php echo U('article/index/id/'.$vo['id']);?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<div class="menu4">
<h5><?php echo ($menu_4["title"]); ?><a href="<?php echo U('menu/index/id/'.$menu_4['id']);?>">更多</a></h5>
<ul>
<?php if(is_array($menu4)): $i = 0; $__LIST__ = $menu4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><img src="../Public/images/arrow.png" /> <a href="<?php echo U('article/index/id/'.$vo['id']);?>"  title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
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