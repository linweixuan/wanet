<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>中配网首页</title>
<meta name="Description" content="中配网提供丰富的挖机配件信息">
<meta name="Keywords" content="最专业的挖机配件信息网">
<link rel="stylesheet" href="paging.css" type="text/css" />
</head>
<body>
      
   <?php
   include_once ("paging.php"); //分页类
   $page=$_GET['page'];
   $conn = mysql_connect("localhost", "root", "root") or die ("无法连接数据库".mysql_error());
   mysql_select_db("wjdb", $conn) or die ("数据库无法使用".mysql_error());
   $sql = "SELECT `name`, `shortname`, `englishname` FROM `brand` WHERE 1";
   mysql_query("set names 'utf-8'");
   $query = mysql_query($sql);
   $totail = mysql_num_rows($query);//记录总条数
   $number = 5;//每页显示条数
   $my_page=new pager($totail,$number,$page,'?page={page}');//参数设定：总记录，每页显示的条数，当前页，连接的地址

   $sql_p = "SELECT `name`, `shortname`, `englishname` FROM `brand` WHERE 1 LIMIT ".$my_page->limit.",".$my_page->size;
   $query_p = mysql_query($sql_p);
   //while($row = mysql_fetch_array($query_p)){
   //
   //}
   ?>

	<?php 
		$my_page->show();	  
	?>


</body>
</html>