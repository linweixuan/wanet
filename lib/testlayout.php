<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中配网首页</title>
<meta name="Description" content="中配网提供丰富的挖机配件信息" />
<meta name="Keywords" content="最专业的挖机配件信息网" />
</head>

<link rel="stylesheet" type="text/css" href="http://www.wanet.cn/index.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://www.wanet.cn/sort.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://www.wanet.cn/content.css" media="all" />
<script type=text/javascript src="http://www.wanet.cn/script/jquery-1.2.6.pack.js"></script>
<script type=text/javascript src="http://www.wanet.cn/script/g.base.js"></script>

<?php
	require_once 'layout.php';
	get_layout();
?>

<body id="wanet">
<?php topbar(); ?>
<?php menubar(); ?>  
  <div class="home_content"></div>
<?php footer(); ?>
<script type=text/javascript> 
	(function(){var navigations=[{e:"computer",c:"电脑办公"},{e:"electronic",c:"家用电器"},{e:"digital",c:"手机数码"},{e:"home",c:"家居生活"},{e:"clothing",c:"服饰鞋帽"},{e:"beauty",c:"个护化妆"},{e:"watch",c:"钟表首饰"},{e:"bag",c:"礼品箱包"},{e:"sports",c:"运动健康"},{e:"baby",c:"母婴玩具"},{e:"food",c:"食品饮料"}];$.each(navigations,function(i){if (navigations[i]["e"]==document.body.id){$("#nav-extra").before("<div class='curr'><a href='http://www.wanet.com/"+ navigations[i]["e"] +".html'>"+ navigations[i]["c"] +"</a></div>");}});})();
	$(".allsort").hoverForIE6({current:"allsorthover",delay:200});
	$(".allsort .item").hoverForIE6({delay:150});
</script> 
</body>
</html>