<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="table.css" />
</head>
<body>
<?php require_once '../lib/login.php'; ?>
<?php require_once '../lib/part.php'; ?>
<table width="634" cellspacing="0" class="taiho" id="taiho">
  <tr class="headline" height="30">
    <td class="head blue-bottom ">Model</td>
    <td class="head" colspan="2">标准</td>
    <td class="head" colspan="2">加25</td>
    <td class="head" colspan="2">加50</td>
    <td class="head" colspan="2">加75</td>
    <td class="head">C</td>
    <td class="head">T</td>
    <td class="head">P</td>    
  </tr>
  
  <tr style="display:none">
    <td rowspan="1" class="blue-bottom">6D95</td>
    <td class="big std">230.0</td>
    <td class="big std">230.0</td>
    <td class="big s25">62.0</td>
    <td class="big s25">62.0</td>    
    <td class="big s50">25.0</td>
    <td class="big s50">25.0</td>    
    <td class="big s75">23.0</td>
    <td class="big s75">23.0</td>    
    <td class="big c blue-bottom">34.0</td>
    <td class="big t blue-bottom">63.0</td>
    <td class="big p blue-bottom">34.0</td>    
  </tr>

  <?php $p=new Part();$p->get_taiho(); ?>
</table>
</body>
</html>
