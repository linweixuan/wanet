<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广孚重工</title>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="script/tab/tabpanel.css">
<script type="text/javascript" src="script/jquery-1.5.1.js"></script>
<script type="text/javascript" src="script/jquery.json-2.3.js"></script>
<script type="text/javascript" src="script/tab/fader.js"></script>
<script type="text/javascript" src="script/tab/tabpanel.js"></script>
<script type="text/javascript" src="script/tab/math.uuid.js"></script>
<script type="text/javascript" src="script/wanet.tab.js"></script>
<script type="text/javascript" src="script/wanet.ifram.js"></script>
</head>
<body>
<?php require_once './lib/login.php'; ?>
<div class="header_bg">
  <div class="header">
    <h1 class="logo"><a href="http://www.wanet.cn/" title="广福重工">广福重工</a></h1>
    <span class="tel">全国统一服务热线：020-3223-7036</span>
    <div class="login"> <a href="register.html" target="_top">注册</a> 
    <a href="lib/logout.php" target="_top">退出</a> </div>
    <div class="links"> <a href="help.php" target="_top" class="help">帮助</a>
    <a href="./about/index.html" target="_top" class="agency">连锁</a>
    <a href="./about/index.html" target="_top" class="vbokecc">广福</a> </div>
  </div>
</div>
<div class="menu">
  <ul>
    <li><a href="menu/index.php">首页</a></li>
    <li><a href="menu/base.php">基础资料</a></li>
    <li><a href="menu/purchase.php">采购管理</a></li>
    <li class="hover"><a href="menu/sale.php">销售管理</a></li>
    <li><a href="menu/stock.php">库存管理</a></li>
    <li><a href="menu/arap.php">应收应付</a></li>
    <li><a href="menu/cash.php">现金银行</a></li>
    <li><a href="menu/accounting.php">账务核算</a></li>
    <li><a href="menu/system.php">系统管理</a></li>    
  </ul>
</div>
<div class="content">
  <div class="box_w">
    <div class="box">
      <div class="box_t"></div>
      <div class="box_m clearfix">
        <div class="left_menu">
          <div class="left_w">
            <ul class="clearfix" id="vmenu">
              <li class="hover"><a href="sale.php" class="p_01">销售开单</a></li>
              <li><a href="company.php" class="p_02">添加客户</a></li>
              <li><a href="part.php" class="p_03">添加部件</a></li>
              <li><a href="grid/company.html" class="p_04">查看客户</a></li>
              <li><a href="grid/part.html" class="p_05">查看部件</a></li>
              <li><a href="grid/sale.html" class="p_06">查看销售</a></li>
              <li><a href="grid/restocking.html" class="p_07">查看库存</a></li>
              <li><a href="grid/statiscsale.html" class="p_08">销售统计</a></li>
              <li><a href="grid/statisticstock.html" class="p_09">库存统计</a></li>
              <li><a href="grid/stocktaiho.html" class="p_10">轴瓦库存</a></li>
              <li><a href="help.php" class="p_11">帮助信息</a></li>
            </ul>
            <a href="help.php" class="get_version clearfix" target="_top">查看版本帮助和说明</a> </div>
        </div>
        <div class="right_win">
        	<div id="tab"></div>
            <iframe name="navifrm" id="navifrm" src="menu/base.php" frameborder="1" scrolling="no" onLoad="autoFrameHeightId('navifrm')" >
            Your browser doesn't support iframes.</iframe>
        </div>
      </div>
      <div class="box_b"></div>
    </div>
  </div>
</div>

<div class="footer_banner">
  <div class="container">
    <div class="bredCrums">
      <ul style="float:left;">
        <li class="NewNetDna"><a href="http://www.wanet.cn/" rel="nofollow">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="f_b_box">©2011-2012 GuangFu Inc. All right reserver.  </div>
</div>

</body>
</html>
