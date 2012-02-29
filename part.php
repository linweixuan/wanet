<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广福工程机械设备有限公司</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="part.css" media="all">
<script type="text/javascript" src="script/jquery-1.5.1.js"></script>
<script type="text/javascript" src="script/jquery.json-2.3.js"></script>
<script type='text/javascript' src="script/wanet.base.js"></script>
<script type="text/javascript" src="script/wanet.part.js"></script>
</head>
<body>
<?php require_once './lib/login.php'; ?>
<?php require_once './lib/part_get.php'; ?>
<div id="wrap">
  <h2>添加配件基础资料</h2>
  <div id="header">
    <p>请完整填写以下公司信息。<br>
      添加完成后，该公司将作为您在销售对象，您可以在开单的时候选择,或者输入公司名缩写。</p>
  </div>
  <form id="partform" name="partform" action="#" method="post" class="formbox">
    <table class="formtable" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <th style="vertical-align: top;">部件名称:</th>
          <td><input id="id" name="id" value="" class="field" type="text" style="display:none">
              <input id="name" name="name" value="" class="field" tabindex="1" autocomplete="off" type="text" size="50">
              <span id="tip1" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th width="100">部件分类:</th>
          <td><input id="catalog" name="catalog" value="" class="field" tabindex="2" type="text" size="20">
              <span id="tip2" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th width="100">机型/发动机型号:</th>
          <td><input id="series" name="series" value="" class="field" tabindex="3" type="text" size="20">
              <input id="model" name="model" value="" class="field" tabindex="4" type="text" size="20">
              <span id="tip4" class="tips"></span><br>
            机型如PC200， 发动机型号如6D95</td>
        </tr>
        <tr>
          <th>部件编号:</th>
          <td><input id="partno" name="partno" value="" class="field" tabindex="5" type="text" size="30">
          <span id="tip5" class="tips"></span></td>
        </tr>        
        <tr>
          <th>内部编码:</th>
          <td><input id="code" name="code" value="" class="field" tabindex="6" type="text" size="30">
          <span id="tip6" class="tips"></span></td>
        </tr>
        <tr>
          <th>部件英文名:</th>
          <td><input id="ename" name="ename" value="" class="field" tabindex="7" type="text" size="30">
          <span id="tip7" class="tips">&nbsp;</span></td>
        </tr>
        <tr>
          <th>部件别名:</th>
          <td><input id="alias" name="alias" value="" class="field" tabindex="8" type="text" size="50">
          <span id="tip8" class="tips">&nbsp;</span></td>
        </tr>        
        <tr>
          <th width="100">简称全拼:</th>
          <td><input id="pinyin" name="pinyin" value="" class="field" tabindex="9" type="text" size="20">
              缩写:<input id="abbr" name="abbr" value="" class="field" tabindex="10" type="text" size="20">
              <span id="tip10" class="tips">&nbsp;</span><br>
            方便开单时直接输入该部件简称拼音或缩写</td>
        </tr>
        <tr>
          <th>规格参数:</th>
          <td><input id="spec" name="spec" value="" class="field" tabindex="11" type="text" size="50">
          <span id="tip11" class="tips">&nbsp;</span></td>
        </tr>        
        <tr>
          <th>库存数量:</th>
          <td><input name="quantity" type="text" class="field" id="quantity" tabindex="12" value="" size="10"
          	   onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
              单位:<input id="unit" name="unit" value="" class="field" tabindex="10" type="text" size="10">
          	  <span id="tip12" class="tips">&nbsp;</span></td>
        </tr>                
        <tr>
          <th>统一价格:</th>
          <td><input id="price" name="price" value="" class="field" tabindex="13" type="text" size="10">
          <span id="tip13" class="tips">&nbsp;</span></td>
        </tr>                        
        <tr>
          <th>&nbsp;</th>
          <td>
            <input id="save" name="save" value="保存该部件" class="submit" onclick="ajaxpost();" tabindex="14" type="button">
            <input id="more" name="more" value="添加新部件" class="submit" onclick="addmore();" tabindex="15" type="button"></td>
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
