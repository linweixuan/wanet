//
// login popup ui ajax
//
function trim(str) {
    return str.replace(/^\s+|\s+$/g, "");
}

$(document).ready(function() {	 
            
  $("#account").focus(function (){
      var tip = $("#account").attr("value");
      if (tip == '邮箱/会员帐号/手机号') {
        $("#account").attr("value",'');
      }
  });

  $("#passwd").focus(function (){
      var tip = $("#passwd").attr("value");
      if (tip == '请输入密码') {
        $("#passwd").hide();
        $("#passwd1").show();
        $("#passwd1").focus();
      }
  });

  $(".btn_normal").click(function (){
      //alert('you click me');
      var v1 = trim($("#account").attr("value"));
      var v2 = trim($("#passwd1").attr("value"));
      var title = '您好'+v1+', 欢迎来到中配网!';
      //alert($('.welcome', window.parent.document).html());
      
      Ajax.request({
        url:"../lib/login.php",
        params:{ account:v1, passwd:v2},
        callback:function(result) {
          result = trim(result);
          //alert('--'+result+'--');
          if ((result == "logined") || (result == "success")) {
              $('.welcome', window.parent.document).html(title);
              parent.$.fancybox.close();
          }else{
              alert('密码错误!');
          }
        }
      });
      
  });	
   
  $(".btnlogin1").click(function (){
    var title = '注册';
    $('.welcome', window.parent.document).html(title);
    parent.$.fancybox.close();
  });	
  
});

