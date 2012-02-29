<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>中配网首页</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="price.css" media="all">
<link rel="stylesheet" type="text/css" href="script/jquery.autocomplete.css" media="all" />
<link rel="stylesheet" type="text/css" href="search.css" media="all" />
<script type='text/javascript' src="script/jquery.js"></script>
<script type='text/javascript' src='script/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='script/jquery.autocomplete.js'></script>
<script type='text/javascript' src="script/wanet.base.js"></script>
<script type='text/javascript' src='script/wanet.taiho.js'></script>
</head>
<body>
<form name="datecheck" method="POST"  onsubmit="return dateCheck(this.date.value);">
<table border="0" cellpadding="8" cellspacing="0" width="50%">
<tr>
    <td align="right" nowrap>Birth Date (DD/MM/YYYY):</td>
    <td><input type=text name="date" size="25"></td>
</tr>
<tr>
    <td class="center" colspan="2">
        <input type=submit value="发送">
        <input type=reset value="重写">
    </td>
</tr>
</table>
</form>
<script type="text/javascript" language="javascript">
function dateCheck(str){
    var re = new RegExp("^([0-9]{1,2})[./]{1}([0-9]{1,2})[./]{1}([0-9]{4})$");
    var ar;
    var res = true;
   
    if ((ar = re.exec(str)) != null){
        var i;
        i = parseFloat(ar[1]);
        // verify dd
        if (i <= 0 || i > 31){
            res = false;
        }
        i = parseFloat(ar[2]);
        // verify mm
        if (i <= 0 || i > 12){
            res = false;
        }
    }else{
        res = false;
    }

    if (!res){
        alert('请输入 DD/MM/YYYY 日期格式');
    }
    else{
     alert("success");
    }
    return res;
}
</script>
<div class="w" id="header">
  <div class="searchsort">
    <div><strong><a href="http://www.wanet.cn/allsort.php">TAIHAO瓦价格查询</a></strong> </div>
  </div>
   <?php
    $time = '2011-06-10 15:19:31';    
    $time_str = '2012年2月18日 14:39';
    $time_str = str_replace("年", "-", $time_str);
    echo $time_str; echo "\n";
    $time_str = str_replace("月", "-", $time_str);
    echo $time_str; echo "\n";
    $time_str = str_replace("日", "", $time_str);
    echo $time_str; echo "\n";
    $format_string = strtotime($time_str);
    if($format_string == FALSE)
        echo 'data time error.'
    else
        echo date('Y年m月d日 H:i:s', strtotime($time_str));
    ?>
</div>
</body>
</html>
