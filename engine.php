<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广福工程机械设备有限公司</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="company.css" media="all">
<script type="text/javascript" src="script/jquery-1.5.1.js"></script>
<script type="text/javascript" src="script/jquery.json-2.3.js"></script>
<script type='text/javascript' src="script/wanet.base.js"></script>
<script type="text/javascript" src="script/wanet.engine.js"></script>
</head>
<body>
<?php require_once './lib/login.php'; ?>
<?php require_once './lib/engine_get.php'; ?>
<div id="wrap">
  <h2>添加发动机型号与机型信息</h2>
  <div id="header">
    <p>请填写下面的发动机与机型信息。<br>
      添加完成后，该信息将作为部件发动机分类对象，您可以在开单的时候选择,或者输入该信息名的缩写。</p>
  </div>
  <form id="companyform" name="companyform" action="#" method="post" class="formbox">
    <table class="formtable" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <th style="vertical-align: top;">发动机型号:</th>
          <td><input id="id" name="id" value="" class="field" type="text" style="display:none">
              <input id="name" name="name" value="" class="field" tabindex="1" autocomplete="off" type="text">
              <span id="tip1" class="tips">&nbsp;</span>
          </td>
        </tr>
        <tr>
          <th width="100">发动机生产厂家:</th>
          <td><input id="manufacture" name="manufacture" value="" class="field" tabindex="2" type="text">
              <span id="tip2" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th width="100">简称或拼音:</th>
          <td><input id="abbr" name="abbr" value="" class="field" tabindex="4" type="text">
              <span id="tip3" class="tips"></span><br>
            方便开单时直接输入该发动机简称拼音或缩写</td>
        </tr>
        <tr>
          <th>通用机型:</th>
          <td><input id="suitable" name="suitable" value="" class="field" tabindex="5" type="text"></td>
        </tr>        
        <tr>
          <th>图片:</th>
          <td><input id="picture" name="picture" value="" class="field" tabindex="7" type="text"></td>
        </tr>
        <tr>
          <th>备注:</th>
          <td><input id="memo" name="memo" value="" class="field" tabindex="8" type="text"></td>
        </tr>        
        <tr>
          <th>&nbsp;</th>
          <td>
            <input id="save" name="save" value="保存该发动机" class="submit" onclick="ajaxpost();" tabindex="11" type="button">
            <input id="save" name="save" value="添加新发动机" class="submit" onclick="addmore();" tabindex="11" type="button"></td>
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
