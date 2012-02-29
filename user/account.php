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
<script type="text/javascript" src="../script/wanet.account.js"></script>
</head>
<body>
<?php require_once '../lib/login.php'; ?>
<?php require_once '../lib/account_get.php'; ?>
<div id="wrap">
  <h2>添加系统用户</h2>
  <div id="header">
    <p>请完整填写系统用户信息。<br>
      添加完成后，该系统用户可以登录本系统，您可以对该用户进行系统访问控制。</p>
  </div>
  <form id="partform" name="partform" action="#" method="post" class="formbox">
    <table class="formtable" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <th style="vertical-align: top;">系统用户名:</th>
          <td><input id="id" name="id" value="" class="field" type="text" style="display:none">
              <input id="name" name="name" value="" class="field" tabindex="1" autocomplete="off" type="text" size="50">
              <span id="tip1" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th width="100">用户全称:</th>
          <td><input id="fullname" name="fullname" value="" class="field" tabindex="2" type="text" size="20">
              <span id="tip2" class="tips">&nbsp;</span></td>
        </tr>        
        <tr>
          <th width="100">密码设置:</th>
          <td><input id="passwd" name="passwd" value="" class="field" tabindex="2" type="text" size="20">
              <span id="tip3" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th>用户角色:</th>
          <td><input id="role" name="role" value="" class="field" tabindex="5" type="text" size="30">
          <span id="tip4" class="tips"></span></td>
        </tr>        
        <tr>
          <th>联系电话:</th>
          <td><input id="phone" name="phone" value="" class="field" tabindex="6" type="text" size="30">
          <span id="tip5" class="tips"></span></td>
        </tr>
        <tr>
          <th>联系地址:</th>
          <td><input id="address" name="address" value="" class="field" tabindex="7" type="text" size="30">
          <span id="tip6" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th>邮箱EMAIL:</th>
          <td><input id="email" name="email" value="" class="field" tabindex="8" type="text" size="50">
          <span id="tip7" class="tips">&nbsp;</span></td>
        </tr>        
        <tr>
          <th>QQ号码:</th>
          <td><input id="qq" name="qq" value="" class="field" tabindex="11" type="text" size="50">
          <span id="tip8" class="tips">&nbsp;</span></td>
        </tr>        
        <tr>
          <th>&nbsp;</th>
          <td>
            <input id="save" name="save" value="保存该用户" class="submit" onclick="ajaxpost();" tabindex="14" type="button">
            <input id="more" name="more" value="添加新用户" class="submit" onclick="addmore();" tabindex="15" type="button"></td>
        </tr>
        <tr>
          <th>&nbsp;</th>
          <td style="color: red; font-weight: bold;"><span class="result"></span></td>
        </tr>
      </tbody>
    </table>
  </form>
  ﻿
  <div id="footer" style="display:none">
    <p style="padding: 5px 0pt 10px;">
      <span style="padding: 0.8em;"> 
        <a href="http://my.wkabc.com/link.php?url=http://www.wkabc.com%2F" target="_top" style="font-size: 12px;">2011@ 广福工程机械设备有限公司</a>
      </span>
    </p>
  </div>
  
</div>


</body>
</html>
