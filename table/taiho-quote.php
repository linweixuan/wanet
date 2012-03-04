<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="table-short.css" />
</head>
<body>
<?php require_once '../lib/login.php'; ?>
<?php require_once '../lib/part.php'; ?>
<table width="1200" cellspacing="0" class="taiho" id="taiho">
  <tr class="headline" height="30">
    <td width="200" class="head blue-bottom ">型号</td>
    <td width="90" class="head">M/R</td>
    <td width="150" class="head">标准</td>
    <td width="150" class="head">加25</td>
    <td width="150" class="head">加50</td>
    <td width="150" class="head">加75</td>
    <td width="120" class="head">止推片</td>
    <td width="120" class="head">偏心瓦</td>
    <td width="120" class="head">铜套</td>    
  </tr>
  
  <tr style="display:none">
    <td class="blue-bottom model" rowspan="3">6D95</td>
    <td height="20" class="big mr">大瓦</td>
    <td class="big std" ><div><div id="l">128<div id="r">1</div></div></div></td>
    <td class="big s25">62.0</td>
    <td class="big s50">25.0</td>
    <td class="big s75">23.0</td>
    <td rowspan="3" class="big c blue-bottom">34.0</td>
    <td rowspan="3" class="big t blue-bottom">63.0</td>
    <td rowspan="3" class="big p blue-bottom">34.0</td>    
  </tr>
  <tr style="display:none">
	<td height="25" class="small mr">小瓦</td>
    <td class="small std ">73.0</td>
    <td class="small s25">25.0</td>
    <td class="small s50">25.0</td>
    <td class="small s75">64.0</td>
  </tr style="display:none">
  <tr style="display:none">
    <td height="25" class="sum mr">共</td>
    <td class="sum std">245.0</td>
    <td class="sum s25">45.0</td>
    <td class="sum s50">74.0</td>
    <td class="sum s75">83.0</td>
  </tr>
  
  <?php $p=new Part();$p->get_taiho(); ?>
</table>
</body>
</html>
