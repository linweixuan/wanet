//
// GF Access json
//

function Access() {
    this.id = '';
    this.account = '';
    this.page = '';
    this.module = '';
    this.func = '';
    this.permit = '';
        
    // functions
    this.newone = function() {
        $("#account").attr("value","");
        $("#page").attr("value","");
        $("#module").attr("value","");
        $("#func").attr("value","");
        $("#permit").attr("value","");
    }
    
    this.check = function() {
        var isok = true;
        var value = $.trim($("#account").val());
        if (value.length == 0){
            $("#tip1").html('请输入系统用户名.');
            isok = false;
        }
        
        value = $.trim($("#page").val());
        if (value.length == 0){
            $("#tip2").html('请输入要访问的系统页面.');
            isok = false;
        }
              
        value = $.trim($("#permit").val());
        if (value.length == 0){
            $("#tip15").html('请输入页面访问权限.');
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
        this.account = $.trim($("#account").val());
        this.page = $.trim($("#page").val());
        this.module = $.trim($("#module").val());
        this.func = $.trim($("#func").val());
        this.permit = $.trim($("#permit").val());
    
        $('.result').html("正在保存数据...");           
        var request = $.toJSON(this);        
        $.post(
            "../lib/access_post.php",
            {data: request},
            function(resp, state){
                if(state == "success"){
                    $('.result').html(resp.data);
                }
                else
                    $('.result').html("数据保存失败!");                
            },
            "json"
        );
    };
}

function ajaxpost() {
    var obj = new Access();
    obj.post();
}

function addmore() {
    var obj = new Access();
    $('.result').html('');      
    obj.newone();
}

function access_init() {
    if ($('#get').is('div')) {
        $("#id").val($("#v1").text());        
        $("#account").val($("#v2").text());
        $("#page").val($("#v3").text());
        $("#module").val($("#v4").text());
        $("#func").val($("#v5").text());
        $("#permit").val($("#v6").text());
    }
}

$(document).ready(function () {
    // load the part infor if get
    access_init();

    $("#account").blur(function(){
		var value = $.trim($("#account").val());
		if (value.length == 0) {
		    $("#tip1").html('请输入系统用户名.');
		}else{
			$("#tip1").html('');
		}
    });
    
    $("#page").blur(function(){
		var value = $.trim($("#page").val());
		if (value.length == 0) {
		    $("#tip2").html('请输入要访问的系统页面.');
		}else{
			$("#tip2").html('');
		}
    });    
    
    $("#permit").blur(function(){
		var value = $.trim($("#permit").val());
		if (value.length == 0) {
		    $("#tip15").html('请输入页面访问权限.');
		}else{
			$("#tip15").html('');
		}
    });        
});
