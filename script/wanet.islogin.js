//
//  verrify  user login
//

function islogin() {
	var v1 = document.login.account.value;
	var v2 = document.login.passwd.value;
	
	Ajax.request({
		url:"../lib/islogin.php",
		params:{ account:v1, passwd:v2},
		callback:function(response) {
			var result = trim(response);
			if (result == "login") {
				window.location.href = 'http://www.wanet.cn/publish.php';
			}
		}
	});
}