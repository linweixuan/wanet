<?php
/* 
 * mysql语句生成器
 * 创建时间：2005-01-11
 * 作　　者：多菜鸟
 * 来　　源: http://blog.csdn.net/kingerq
 * 联系邮箱: kingerq AT msn DOT com
 */
session_start();
$code = array();
$line = array("=================插入语句=================", 
   "=================选择语句=================", 
   "=================更新语句=================");
$js = "";
$typein = array();
$tbl_list = $tbltemp = "";

if($_POST){
 if(array_key_exists("tbl_name", $_POST)){
  $tbltemp = $_POST["tbl_name"];
  $_POST = $_SESSION["phpcode"][$_POST["tbl_name"]];
  //print_r($_SESSION["phpcode"]);
 }else{
  $_SESSION["phpcode"][$_POST["tbl"]] = $_POST;
 }
 $code[0] = createcode($_POST, 0);//插入语句
 $code[1] = createcode($_POST, 1);//选择语句
 $code[2] = createcode($_POST, 2);//更新语句
 $typein = $_POST["outtype"];
 
 foreach($typein as $val){
  $js .= "code[\"outtype[]\"][".$val."].checked = true;\n";
 }
 echo "<script>
 window.onload = function(){
  code.tbl.value = '".$_POST["tbl"]."';
  code.fieldlist.value = '".$_POST["fieldlist"]."';
  code.keyword.value = '".$_POST["keyword"]."';
  code.codetype[".$_POST["codetype"]."].checked = true;
  ".$js."
 }
 </script>";
}
//创建历史下拉菜单
if(!empty($_SESSION["phpcode"])){
 foreach(array_filter(array_reverse($_SESSION["phpcode"])) as $key => $val){
  $tbl_list .= "<option value='".$key."'".($tbltemp == $key ? " selected" : "").">".$key."</option>";
 }
}

/*
 * 生成语句函数
 */
function createcode($ar, $type = 0){
 switch($type){
  case 1://选择语句处理
   $sql = "\$sql = \"SELECT ".fieldlist($ar["fieldlist"])." \nFROM `".$ar["tbl"]."` ".where($_POST["keyword"])."\";\n";
   
   break;
  case 2://更新语句处理
   $sql = "\$sql = \"UPDATE `".$ar["tbl"]."` SET ".fieldlist($ar["fieldlist"], 2)." ".where($_POST["keyword"])." LIMIT 1\";\n";
   
   break;
  default://插入语句处理
   $sql = "\$sql = \"INSERT INTO `".$ar["tbl"]."`(".fieldlist($ar["fieldlist"]).")\nVALUES(".fieldlist($ar["fieldlist"], 1).")\";\n";
   
 }
 if($ar["codetype"]){//输出PHPLIB
  $sql  = "include(\"inc/db_mysql.inc\");//包括MYSQL操作类\n\$db = new DB_Sql;//定义类\n\$db->connect();//连接数据库\n\n".$sql;
  $sql .= "\$db->query(\$sql);\n";
 }else{
  $sql = "/* 连接数据库 */\n\$conn = mysql_pconnect(\"localhost\", \"username\", \"password\") or die(\"不能连接数据库：\".mysql_error());\n/* 选择数据库 */\nmysql_select_db(\"mysql_database\") or die(\"不能选择数据库\");\n\n".$sql;
  $sql .= "\$result = mysql_query(\$sql);\n";
 }
 return $sql;
}
/*
 * 字段处理
 */
function fieldlist($fieldstr, $type = 0){
 $str = "";
 $tstr = split(",", $fieldstr);
 foreach($tstr as $val){
  switch($type){
   case 1://用在插入语句中
    if($str) $str .= ", "; 
    $str .= "'\".\$_POST[\"".trim($val)."\"].\"'"; 
    break;
   case 2://用在更新语句中
    if($str) $str .= ", \n"; 
    $str .= "`".trim($val)."` = '\".\$_POST[\"".trim($val)."\"].\"'";
    break;
   default:
    if($str) $str .= ", "; 
    $str .= "`".trim($val)."`"; 
  }
 }
 return $str;
}

function where($keyword){
 return "\nWHERE `$keyword` = '\".\$_POST[\"".$keyword."\"].\"'";
}
?>
<style type="text/css">
<!--
.border {
 border: 1px dashed #009E6B;
}
td,body {
 font-size: 12px;
}
a {
 font-size: 12px;
 color: #FFFFFF;
 text-decoration: none;
}
a:hover {
 font-size: 12px;
 color: #000000;
 text-decoration: underline;
}
-->
</style>

<title>MYSQL语句生成器</title><table width="60%"  border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td bgcolor="#009F6B"><a href="http://blog.csdn.net/kingerq/archive/2005/01/11/248309.aspx">返回</a></td>
    <form name="his" method="post" action="">
 <td width="25" bgcolor="#009F6B">
      <?
   if($tbl_list){
   ?>
   <select name="tbl_name" onChange="his.submit()">
   <?= $tbl_list?>
      </select>
      <?
   }
   ?>
    </td>
 </form>
  </tr>
</table>
  <table width="60%"  border="0" align="center" cellpadding="2" cellspacing="1" class="border">
<form name="code" method="post" action="" onSubmit="return chkform()">
<script language="JavaScript">
<!--
function chkform(){
 var reg = /^[^\d]\w*$/;
 if(!reg.test(code.tbl.value)){
  alert("请输入正确的表名");
  code.tbl.focus();
  return false;
 }
 var field = code.fieldlist.value.split(",");
 for(i = 0; i < field.length; i++){
  if(!reg.test(field[i])){
   alert("请输入正确的字段列表\n\n不能以数字为开头的，\n用逗号分开各字段");
   code.fieldlist.focus();
   return false;
  }
 }
 if(!reg.test(code.keyword.value)){
  alert("请输入正确的主键字段");
  code.keyword.focus();
  return false;
 }
}
//-->
</script> 
    <tr>
      <td align="right" nowrap>表名：</td>
      <td><input name="tbl" type="text" id="tbl"></td>
    </tr>
    <tr>
      <td align="right" nowrap>字段列表：</td>
      <td><textarea name="fieldlist" cols="45" rows="7" id="fieldlist"></textarea>
      <br>
      用逗号(,)分开各字段</td>
    </tr>
    <tr>
      <td align="right" nowrap>主键字段：</td>
      <td><input name="keyword" type="text" id="keyword"></td>
    </tr>
    <tr>
      <td align="right" nowrap>代码类型：</td>
      <td><input name="codetype" type="radio" value="0" checked>
        一般代码
        <input type="radio" name="codetype" value="1">
      PHPLIB</td>
    </tr>
    <tr>
      <td align="right" nowrap>输出类型：</td>
      <td><input name="outtype[]" type="checkbox" id="outtype[]" value="0" checked>
        插入
          <input name="outtype[]" type="checkbox" id="outtype[]" value="1" checked>
          选择
          <input name="outtype[]" type="checkbox" id="outtype[]" value="2" checked>
          更新</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="Submit" value="生成代码">
      <input type="reset" name="Submit" value="重置"></td>
    </tr>
</form>
</table>
  <br>
<table width="70%"  border="0" align="center" cellpadding="5" cellspacing="1" class="border">
  <tr>
    <td bgcolor="#CCCCCC">
<?php
foreach($code as $key=>$val){
 if(in_array($key, $typein)) {
  echo $line[$key]."<br>\n ";
  highlight_string("<?php\n".$val."\n?>\n");
 }
}
?></td>
  </tr>
</table>