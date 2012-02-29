//
// GF Access json
//

function Account() {
    this.id = '';
    this.name = '';
    this.fullname = '';
    this.passwd = '';
    this.role = '';
    this.phone = '';
    this.address = '';
    this.email = '';
    this.qq = '';
    
    // extern for account
    this.token = '';
    this.province = '';
    this.city = '';
    this.code = '';
    this.msn = '';
    this.type = '0';
    this.level = '0';
    this.other = '';
        
    // functions
    this.newone = function() {
        $("#name").attr("value","");
        $("#fullname").attr("value","");
        $("#passwd").attr("value","");
        $("#role").attr("value","");
        $("#phone").attr("value","");
        $("#address").attr("value","");
        $("#email").attr("value","");
        $("#qq").attr("value","");
    }
    
    this.check = function() {
        var isok = true;
        var value = $.trim($("#name").val());
        if (value.length == 0){
            $("#tip1").html('请输入系统用户名.');
            isok = false;
        }
        
        value = $.trim($("#passwd").val());
        if (value.length == 0){
            $("#tip3").html('请输入系统用户密码.');
            isok = false;
        }
              
        value = $.trim($("#phone").val());
        if (value.length == 0){
            $("#tip16").html('请输用户联系电话.');
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
        this.id = $.trim($("#id").val());
        this.name = $.trim($("#name").val());
        this.fullname = $.trim($("#fullname").val());
        this.passwd = $.trim($("#passwd").val());
        this.role = $.trim($("#role").val());
        this.phone = $.trim($("#phone").val());
        this.address = $.trim($("#address").val());
        this.email = $.trim($("#email").val());
        this.qq = $.trim($("#qq").val());
    
        $('.result').html("正在保存数据...");           
        var request = $.toJSON(this);        
        $.post(
            "../lib/account_post.php",
            {data: request},
            function(resp, state){
                if(state == "success"){
                    $('.result').html(resp.data);
                }
                else
                    $('.result').html("用户数据保存失败!");                
            },
            "json"
        );
    };
}

function ajaxpost() {
    var obj = new Account();
    obj.post();
}

function addmore() {
    var obj = new Account();
    $('.result').html('');      
    obj.newone();
}

function account_init() {
    if ($('#get').is('div')) {
        $("#id").val($("#v1").text());        
        $("#name").val($("#v2").text());
        $("#fullname").val($("#v3").text());
        $("#passwd").val($("#v4").text());
        $("#role").val($("#v5").text());
        $("#phone").val($("#v6").text());
        $("#address").val($("#v7").text());
        $("#email").val($("#v8").text());
        $("#qq").val($("#v9").text());
    }
}

$(document).ready(function () {
    // load the part infor if get
    account_init();

    $("#name").blur(function(){
		var value = $.trim($("#name").val());
		if (value.length == 0) {
		    $("#tip1").html('请输入系统用户名.');
		}else{
			$("#tip1").html('');
		}
    });
    
    $("#page").blur(function(){
		var value = $.trim($("#passwd").val());
		if (value.length == 0) {
		    $("#tip3").html('请输入要系统用户密码.');
		}else{
			$("#tip3").html('');
		}
    });    
    
});
