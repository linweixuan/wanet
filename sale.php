<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广福工程机械设备有限公司</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="sale.css" media="all">
<link rel="stylesheet" type="text/css" href="script/jquery.autocomplete.css">
<link rel="stylesheet" type="text/css" href="script/common.float.css" />
<link rel="stylesheet" type="text/css" href="script/jquery.float.css" />
<link rel="stylesheet" type="text/css" href="float.css" />
<script type="text/javascript" src="script/jquery-1.5.1.js"></script>
<script type="text/javascript" src="script/jquery.json-2.3.js"></script>
<script type='text/javascript' src='script/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='script/jquery.autocomplete.js'></script>
<script type="text/javascript" src="script/jquery.float.js"></script>
<script type="text/javascript" src="script/wanet.bill.js"></script>
<script type='text/javascript' src='script/wanet.taiho.js'></script>
</head>
<body>
<?php require_once './lib/login.php'; ?>
<?php require_once './lib/bill_get.php'; ?>
<div id="wrap">
  <div class="retail">  
    <div class="bill" id="bill" style="display:none">sale</div>
    <form id="salesform" name="salesform" action="#" method="post" class="formbox">
      <div class="billtitle">
        <h2>广福工程机械设备有限公司</h2>
        <h1>销售单</h1>
      </div>
      <div class="billhead">
        <table class="headtab" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <th class="title" style="width: 60px">客户名称:</th>
              <td style="width: 250px">
              	<div class="editbox w400">
                <input id="saleid" name="saleid" value="" class="saleinput" type="text" style="display:none">
                <input id="companyid" name="companyid" value="" class="saleinput" type="text" style="display:none">
                <input id="company" name="company" value="" class="saleinput" type="text" tabindex="1">                
                </div>
              </td>
              <td style="width: 100px">           
				<div class="iconbutton">
                    <span class="active Unselected">
                    <a id="tablink" class="tablink" href="company.html"><img src="images/edit1.jpeg" title="添加新客户"/></a>
                    </span>
                </div>              
              </td>              
              <th class="title" style="width: 60px">单号:</th>
              <td>
              	<div class="editbox w150">
              	<input id="num" name="num" value="<?php generate_order_number();?>" class="saleinput" type="text">
                </div></td>
            </tr>         
            <tr>
              <th class="title">客户地址:</th>
              <td>
              	<div class="editbox w400">
                <input id="address" name="address" value="" class="saleinput" type="text">
                </div></td>
              <td style="width: 40px">     
              </td>
              <th class="title">日期:</th>
              <td>
	            <div class="editbox w150">
              	<input id="date" name="date" value="" class="saleinput" type="text">
                </div></td>
                <input id="book" name="book" value="" class="saleinput" type="text" style="display:none">
                <input id="sheet" name="sheet" value="" class="saleinput" type="text" style="display:none">
                <input id="operator" name="operator" value="" class="saleinput" type="text" style="display:none">                
            </tr>
            <tr style="display:none">
              <th class="title">仓库:</th>
              <td>
              	<div class="editbox w400">
                <input id="warehouse" name="warehouse" value="sub" class="saleinput" type="text">
                </div>
              </td>
            </tr>            
          </tbody>
        </table>
      </div>
      <div class="billbox">
        <table class="protab" cellpadding="3" cellspacing="0" width="100%">
          <tbody>
            <tr id="0">
              <td class="biaoti bgs" style="width: 24px">序号</td>
              <td class="biaoti bgs" style="width: 255px">配件品名/规格型号</td>
              <td class="biaoti bgs" style="width: 110px">配件编号</td>
              <td class="biaoti bgs" style="width: 24px">单位</td>
              <td class="biaoti bgs" style="width: 30px">数量</td>
              <td class="biaoti bgs" style="width: 60px">单价</td>
              <td class="biaoti bgs" style="width: 70px">金额</td>
              <td class="biaoti bgs" style="width: 50px" >备注</td>
            </tr>
            <tr id="1">
              <td class="bgs" style="width: 20px;">1</td>
              <td><div class="editbox1">
              	  <input id="id" name="id" value="" class="pinput" type="text" style="display:none">
              	  <input id="name" name="name" value="" class="pinput" type="text" tabindex="2">
                  </div>
              </td>
              <td><div class="editbox1">
                  <input id="code" name="code" value="" class="pinput" type="text">
                  </div>
              </td>
              <td><div class="editbox1">
              	  <input id="unit" name="unit" value="" class="pinput" type="text" autocomplete="off">
                  </div>
              </td>
              <td><div class="editbox1">
              	  <input id="quantity" name="quantity" class="pinput" onblur="sumprice()" type="text" tabindex="3" autocomplete="off" 
                  onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
                  </div>
              </td>
              <td><div class="editbox1"><input id="price" name="price" value="" class="pinput" type="text" autocomplete="off">
              </div></td>
              <td><div class="editbox1"><input id="sum" name="sum" value="" class="pinput" type="text" autocomplete="off"></div></td>
              <td><div class="editbox1"><input id="memo" name="memo" value="" class="pinput" type="text"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="billfoot">
      	<div class="totalsum" ><span class="totallable">合计:</span>
        <span class="totalvalue"><input id="total" name="total" value="7" class="pinput" type="text" size="10"></span>
      </div>
      </div>         
      <div class="billbutton">
        <div class="tips">
          <span class="result"></span>
        </div>
        <div class="apply">
            <input id="save" name="save" value="保存当前销售" class="submit" onclick="savesale();" tabindex="14" type="button">
            <input id="more" name="more" value="计算总额" class="submit" onclick="salesum();" tabindex="15" type="button">
            <input id="more" name="more" value="增加表行" class="submit" onclick="newline();" tabindex="15" type="button">
            <input id="more" name="more" value="下一单" class="submit" onclick="newsale();" tabindex="15" type="button">
            <input id="more" name="more" value="test" class="submit" onclick="test_com();" tabindex="15" type="button" style="display:none">
        </div>
      </div>         
    </form>
  </div>
  <div id="mprice" style="display: none; position: absolute; width: 135px; top: 198px; left: 361px;" class="ac_results">
    <ul style="max-height: 350px; overflow: auto;">
      <!--li class="ac_even"><span class="key2">2012-12-02</span><span class="key1">￥200.0</span></li>
      <li class="ac_even"><span class="key2">2012-09-31</span><span class="key1">￥20.0</span></li>
      <li class="ac_even"><span class="key2">2012-03-02</span><span class="key1">￥30.0</span></li>
      <li class="ac_even"><span class="key2">2012-08-23</span><span class="key1">￥250.0</span></li>
      <li class="ac_even"><span class="key2">2012-06-23</span><span class="key1">￥400.0</span></li>
      <li class="ac_even"><span class="key2">2012-02-14</span><span class="key1">￥22.0</span></li>
      <li class="ac_even"><span class="key2">2012-05-15</span><span class="key1">￥300.0</span></li-->
    </ul>
  </div>
  <div id="footer">
  <p style="padding: 5px 0pt 10px;"> 
  <span style="padding: 0.8em;"> <a id="test" href="http://www.gf.cn" target="_top" style="font-size: 12px;">2011@ 广福工程机械设备有限公司</a> </span> 
  </p>
</div>  

</div>
</body>
</html>
