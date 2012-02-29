// register fields verrify
//<script type="text/javascript">
	var onready = false;
	var account_tips;
	var passwd_tips;
	var confirm_tips;
	var token_tips;
	var name_tips;
	  
	function trim(str) {
		return str.replace(/^\s+|\s+$/g, "");
	}

	function check_account(onsubmits) {
  		 var account = trim($("#account").val());
		 if (account.length == 0) {
			 if (Boolean(onsubmits))
			 	$("#account").focus();
			 $("#account_tips").html('<p class="lh mb f11 lr" id="account_tips">登陆用户名不能为空,请输入登陆用户名。</p>');
			 return false;
		 }else {
			 $("#account_tips").html(account_tips);
		 }
		 return true;
	}

	function check_passwd(onsubmits) {
  		 var passwd = trim($("#passwd").val());
		 if (passwd.length == 0) {
			 if (Boolean(onsubmits))
				 $("#passwd").focus();
			 $("#passwd_tips").html('<p class="lh mb f11 lr" id="passwd_tips">登陆密码不能为空,请输入登陆密码。</p>');
			 return false;
		 }else {
			 $("#passwd_tips").html(passwd_tips);
		 }
		 return true;
	}
	
	function check_confirm(onsubmits) {
		 var passwd = trim($("#passwd").val());
  		 var confirm = trim($("#confirm").val());
		 if (confirm.length == 0) {
			 if (Boolean(onsubmits))
			 	$("#confirm").focus();			 
			 $("#confirm_tips").html('<p class="lh mb f11 lr" id="confirm_tips">请再次输入的密码。</p>');	 
			 return false;
		 }else{
			 if (!(confirm == passwd)) {
			 	if (Boolean(onsubmits))
			 		$("#confirm").focus();				 
			 	$("#confirm_tips").html('<p class="lh mb f11 lr" id="confirm_tips">与上面的输入的密码不符,请再次输入的密码。</p>');	 
				return false;
			 }
		 }
		 return true;
	}
	
	function check_token(onsubmits) {
  		 var passwd = trim($("#token").val());
		 if (passwd.length == 0) {
			 if (Boolean(onsubmits))
			 	$("#token").focus();
			 $("#token_tips").html('<p class="lh mb f11 lr" id="token_tips">请输入下面的注册码。</p>');
			 $("#token_tips").show();
			 return false;
		 }else{
			 $("#token_tips").hide();
		 }
		 return true;
	}
	
	function submitcheck() {
		var onsubmits = true;
		if (!check_account(onsubmits)){
			//alert(" account fail");
			return false;
		}
		if (!check_passwd(onsubmits)){
			//alert(" passwd fail");
			return false;
		}
		if (!check_confirm(onsubmits)){
			//alert(" confirm fail");
			return false;
		}
		if (!check_token(onsubmits)){
			//alert(" token fail");
			return false;
		}
		alert(" all ok");
		send();
		return false;
	}
	
	function response_check(error) {
		var code = Number(error);
		if (code == 10000){
			$("#account_tips").html('<p class="lh mb f11 lr" id="account_tips">用户名错误,请重新输入用户名。</p>');
			document.signup.account.focus();
		}else if (code == 10001){
			//$("#passwd_tips").html('<p class="lh mb f11 lr" id="passwd_tips">密码错误,请重新输入密码。</p>');			
			//document.getElementById('passwd_tips').innerHtml = '<p class="lh mb f11 lr" id="passwd_tips">密码错误,请重新输入密码。</p>';
			alert(document.getElementById('passwd_tips').innerHtml);
			document.signup.passwd.focus();
		}else if (code == 10002){
			$("#confirm_tips").html('<p class="lh mb f11 lr" id="confirm">两次输入的密码不符,请重新输入。</p>');
			document.signup.confirm.focus();
		}else if (code == 10003){
			$("#token_tips").html('<p class="lh mb f11 lr" id="token_tips">注册码错误,请重新输入注册码。</p>');
			document.signup.token.focus();
		}else if (code == 10004){
			//$("#name_tips").html('<p class="lh mb f11 lr" id="name_tips">请重新输入用户名。</p>');
			//alert("请重新输入用户名。");			
			document.signup.name.focus();
			document.signup.name.offsetHeight
		}else if (code == 10005){
			//$("#phone_tips").html('<p class="lh mb f11 lr" id="phone_tips">电话号码有误,请重新输入电话号码。</p>');
			document.signup.phone.focus();
		}else if (code == 10006){
			//$("#modile_tips").html('<p class="lh mb f11 lr" id="modile_tips">手机号码有误,请重新输入手机号码。</p>');
			document.signup.mobile.focus();
		}else if (code == 10007){
			//$("#mail_tips").html('<p class="lh mb f11 lr" id="mail_tips">邮件地址错误,请重新输入。</p>');
			document.signup.mail.focus();
		}else if (code == 10008){
			//$("#user_tips").html('<p class="lh mb f11 lr" id="user_tips">输入的注册信息有错误,请重新检查输入。</p>');
			document.signup.account.focus();
		}else if (code == 10009){
			$("#account_tips").html('<p class="lh mb f11 lr" id="account_tips">注册的用户名已经存在,请重新输入用户名。</p>');
			document.signup.account.focus();
		}else if (code == 10010){
			$("#address_tips").html('<p class="lh mb f11 lr" id="address_tips">地址错误,请重新输入地址。</p>');
			document.signup.address.focus();
		}

	}
	
	$(document).ready(function() {
							   
	  account_tips = $("#account_tips").html();
	  passwd_tips = $("#passwd_tips").html();
	  confirm_tips = $("#confirm_tips").html();
	  token_tips = $("#token_tips").html();
	  name_tips = $("#name_tips").html();
	  
	  // hide verfiy code tips
	  $("#token_tips").hide();
	  	  
	  // login account check
	  $("#account").blur(function(){
		 check_account(onready);
	  });
	  $("#account").focus(function(){
		 $("#account_tips").html(account_tips);
	  });
	  
	  // login password check
	  $("#passwd").blur(function(){
		 check_passwd(onready);
	  });
	  $("#passwd").focus(function(){
		 $("#passwd_tips").html(passwd_tips);
	  });								   
	  
	  // login password confirm check
	  $("#confirm").blur(function(){
		 check_confirm(onready);		 
	  });
	  $("#confirm").focus(function(){
		 $("#confirm_tips").html(confirm_tips);
	  });	
	  
	  // login code confirm check
	  $("#token").blur(function(){
		 check_token(onready);
	  });
	  $("#token").focus(function(){
		 $("#token_tips").html(token_tips);
	  });		  
	});
//</script>

//register fields ajax handle
function send()
{
	//construct data
	var v1 = document.signup.account.value;
	var v2 = document.signup.passwd.value;
	var v3 = document.signup.confirm.value;
	var v4 = document.signup.token.value;
	var v5 = document.signup.name.value;
	var v6 = document.signup.phone.value;
	var v7 = document.signup.mobile.value;
	var v8 = document.signup.fax.value;
	var v9 = document.signup.address.value;
	var v10 = document.signup.postcode.value;
	var v11 = document.signup.province.value;
	var v12 = document.signup.email.value;
	var v13 = document.signup.qq.value;
	var v14 = document.signup.msn.value;
	var v15 = document.signup.company.value;
	var v16 = document.signup.business.value;
	
	Ajax.request({
		url:"../lib/signup.php",
		params:{
			 account:v1, 
			 passwd:v2, 
			 confirm:v3,
			 token:v4, 
			 name:v5, 
			 phone:v6,
			 mobile:v7, 
			 fax:v8, 
			 address:v9, 
			 postcode:v10, 
			 province:v11, 
			 email:v12, 
			 qq:v13, 
			 msn:v14,
			 company:v15, 
			 business:v16
		},
		callback:function(response) {
			var result = trim(response);
			if (result == "success") {
				window.location.href = 'http://www.wanet.cn';
			}else{
				response_check(result);
			}
		}
	});
}