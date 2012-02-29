//
// GF login json
//

function Account() {
    this.id = '';
    
    // display fields
    this.name = '';
    this.passwd = '';
    
    // functions
    this.newone = function() {
        $("#name").attr("value","");
        $("#passwd").attr("value","");
    }
    
    this.check = function() {
        var isok = true;
        var value = $.trim($("#name").val());
        if (value.length == 0){
            $("#form_info").html('请输入用户名!');
            isok = false;
        }
        
        value = $.trim($("#passwd").val());
        if (value.length == 0){
            $("#form_info").html('请输入用户密码!');
            isok = false;
        }
        
        return isok;
    }
    
    this.post = function() {
        // check input fields first
        if( !this.check()) {
            return;
        }
        
        // get sale bill fields
        this.name = $.trim($("#name").val());
        this.passwd = $.trim($("#passwd").val());
    
        $('#form_info').html("正在登陆...");
        var request = $.toJSON(this);        
        $.post(
            "../lib/login_post.php",
            {data: request},
            function(resp, state){
                if(state == "success"){
                    $('#form_info').html(resp.data);
                    if(resp.data == '用户登陆成功')
                        location.href = "http://www.wanet.cn/index.php";                    
                }else{
                    $('#form_info').html('登陆失败!');
                }                
            },
            "json"
        );
    };
}

function ajaxpost() {
    var account = new Account();
    account.post();
}

$(document).ready(function () {

    $("#name").blur(function(){
		var value = $.trim($("#name").val());
		if (value.length == 0) {
		    $("#form_info").html('请输入用户名!');
		}else{
			$("#form_info").html('');
		}
    });
    
    $("#passwd").blur(function(){
		var value = $.trim($("#passwd").val());
		if (value.length == 0) {
		    $("#form_info").html('请输入用户密码!');
		}else{
			$("#form_info").html('');
		}
    });    
     
});
