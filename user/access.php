<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广福工程机械设备有限公司</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="user.css" media="all">
<script type="text/javascript" src="../script/jquery-1.5.1.js"></script>
<script type="text/javascript" src="../script/jquery.json-2.3.js"></script>
<script type='text/javascript' src="../script/wanet.base.js"></script>
<script type='text/javascript' src="../script/wanet.access.js"></script>
</head>
<body>
<?php require_once '../lib/login.php'; ?>
<?php require_once '../lib/access_get.php'; ?>
<div id="wrap">
  <h2>网页权限访问控制</h2>
  <div id="header">
    <p>请完输入以下网页访问权限控制信息。<br>
      添加完成后，将限制该用户访问网页的权限, 需要帮助请访问帮助页面。</p>
  </div>
  <form id="companyform" name="companyform" action="#" method="post" class="formbox">
    <table class="formtable" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <th style="vertical-align: top;">用户名:</th>
          <td><input id="id" name="id" value="" class="field" type="text" style="display:none">
              <input id="account" name="account" value="" class="field" tabindex="1" autocomplete="off" type="text">
              <span id="tip1" class="tips">&nbsp;</span>
          </td>
        </tr>
        <tr>
          <th width="100">页面链接:</th>
          <td><input id="page" name="page" value="" class="field" tabindex="2" type="text">
              <span id="tip2" class="tips"></span><br>
              可以对每个页面进行控制访问</td>
        </tr>
        <tr>
          <th width="100">模块名称:</th>
          <td><input id="module" name="module" value="" class="field" tabindex="3" type="text">
              <span id="tip3" class="tips"></span><br>
            可以对模块级别上控制访问, 可选</td>
        </tr>
        <tr>
          <th width="100">函数名称:</th>
          <td><input id="func" name="func" value="" class="field" tabindex="3" type="text">
              <span id="tip4" class="tips"></span><br>
            可以对函数级别控制访问, 可选</td>
        </tr>                
        <tr>
          <th>访问权限:</th>
          <td><input id="permit" name="permit" value="" class="field" tabindex="5" type="text">
              <span id="tip5" class="tips"></span><br></td>
        </tr>        
        <tr>
          <th>&nbsp;</th>
          <td>
            <input id="save" name="save" value="保存该权限" class="submit" onclick="ajaxpost();" tabindex="11" type="button">
            <input id="save" name="save" value="添加新权限" class="submit" onclick="addmore();" tabindex="11" type="button"></td>
        </tr>
        <tr>
          <th>&nbsp;</th>
          <td style="color: red; font-weight: bold;"><span class="result"></span></td>
        </tr>
      </tbody>
    </table>
  </form>
  ﻿
  <div id="footer">
    <p style="padding: 5px 0pt 10px;">
      <span style="padding: 0.8em;"> 
        <a href="http://www.wanet.cn" target="_top" style="font-size: 12px;">2011@ 广福工程机械设备有限公司</a>
      </span>
    </p>
  </div>
  
</div>
</body>
</html>
