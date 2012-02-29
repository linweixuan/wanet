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
<script type="text/javascript" src="script/wanet.company.js"></script>
</head>
<body>
<?php require_once './lib/login.php'; ?>
<?php require_once './lib/company_get.php'; ?>
<div id="wrap">
  <h2>添加配件商行或公司</h2>
  <div id="header">
    <p>请完整填写以下公司信息。<br>
      添加完成后，该公司将作为您在销售对象，您可以在开单的时候选择,或者输入公司名缩写。</p>
  </div>
  <form id="companyform" name="companyform" action="#" method="post" class="formbox">
    <table class="formtable" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <th style="vertical-align: top;">公司全名:</th>
          <td><input id="id" name="id" value="" class="field" type="text" style="display:none">
              <input id="name" name="name" value="" class="field" tabindex="1" autocomplete="off" type="text">
              <span id="tip1" class="tips">&nbsp;</span>
          </td>
        </tr>
        <tr>
          <th width="100">公司简称:</th>
          <td><input id="shortname" name="shortname" value="" class="field" tabindex="2" type="text">
              <span id="tip2" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th width="100">简称全拼音:</th>
          <td><input id="pinyin" name="pinyin" value="" class="field" tabindex="3" type="text">
              缩写:<input id="abbr" name="abbr" value="" class="field" tabindex="4" type="text">
              <span id="tip3" class="tips"></span><br>
            方便开单时直接输入该公司简称拼音或缩写</td>
        </tr>
        <tr>
          <th>联系人:</th>
          <td><input id="man" name="man" value="" class="field" tabindex="5" type="text"></td>
        </tr>        
        <tr>
          <th>地址:</th>
          <td><input id="address" name="address" value="" class="field" tabindex="6" type="text">
	          <span id="tip4" class="tips"></span><br></td>
        </tr>
        <tr>
          <th>电话:</th>
          <td><input id="telephone" name="telephone" value="" class="field" tabindex="7" type="text"></td>
        </tr>
        <tr>
          <th>手机:</th>
          <td><input id="mobile" name="mobile" value="" class="field" tabindex="8" type="text"></td>
        </tr>        
        <tr>
          <th>传真:</th>
          <td><input id="fax" name="fax" value="" class="field" tabindex="9" type="text"></td>
        </tr>  
        <tr>
          <th>备注:</th>
          <td><input id="memo" name="memo" value="" class="field" tabindex="10" type="text"></td>
        </tr>                        
        <tr>
          <th>&nbsp;</th>
          <td>
            <input id="save" name="save" value="保存该商行" class="submit" onclick="ajaxpost();" tabindex="11" type="button">
            <input id="save" name="save" value="添加新商行" class="submit" onclick="addmore();" tabindex="11" type="button"></td>
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
