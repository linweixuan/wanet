//
// GF company json
//

function Company() {
    this.id = '';
    
    // display fields
    this.name = '';
    this.shortname = '';
    this.pinyin = '';
    this.abbr = '';
    this.man = '';
    this.address = '';
    this.telephone = '';
    this.mobile = '';
    this.fax = '';
    this.memo = ''; 
    
    // functions
    this.newone = function() {
        $("#name").attr("value","");
        $("#shortname").attr("value","");
        $("#pinyin").attr("value","");
        $("#abbr").attr("value","");
        $("#man").attr("value","");
        $("#address").attr("value","");
        $("#telephone").attr("value","");
        $("#mobile").attr("value","");
        $("#fax").attr("value","");
        $("#memo").attr("value","");
    }
    
    this.check = function() {
        var isok = true;
        var value = $.trim($("#name").val());
        if (value.length == 0){
            $("#tip1").html('请输入公司全名.');
            isok = false;
        }

        value = $.trim($("#shortname").val());
        if (value.length == 0){
            $("#tip2").html('请输入公司简称.');
            isok = false;
        }
        
        value = $.trim($("#pinyin").val());
        if (value.length == 0){
            $("#tip3").html('请输入公司简称拼音/缩写.');
            isok = false;
        }

        value = $.trim($("#address").val());
        if (value.length == 0){
            $("#tip4").html('请输入公司地址.');
            isok = false;
        }
        
        if (isok) {
            $("#tip1").html('');
            $("#tip2").html('');
            $("#tip13").html('');
            $("#tip14").html('');
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
        this.shortname = $.trim($("#shortname").val());
        this.pinyin = $.trim($("#pinyin").val());
        this.abbr = $.trim($("#abbr").val());
        this.man = $.trim($("#man").val());
        this.address = $.trim($("#address").val());
        this.telephone = $.trim($("#telephone").val());
        this.mobile = $.trim($("#mobile").val());
        this.fax = $.trim($("#fax").val());
        this.memo = $.trim($("#memo").val());

        $('.result').html("正在保存数据...");           
        var request = $.toJSON(this);
        $.post(
            "lib/company_post.php",
            {data: request}, 
            function(resp, state){
                if(state == "success")
                    $('.result').html(resp.data);
                else
                    $('.result').html("数据保存失败!");                
            },
            "json"
        );
    };
}

function ajaxpost() {
    var company = new Company();
    company.post();
}

function addmore() {
    var company = new Company();
    $('.result').html('');      
    company.newone();
}

function company_init() {
    if($('#get').is('div')) {
        //alert($("#v2").text());
        $("#id").val($("#v1").text());
        $("#name").val($("#v2").text());
        $("#shortname").val($("#v3").text());
        $("#pinyin").val($("#v5").text());
        $("#abbr").val($("#v4").text());
        $("#man").val($("#v10").text());
        $("#address").val($("#v6").text());
        $("#telephone").val($("#v7").text());
        $("#mobile").val($("#v8").text());
        $("#fax").val($("#v9").text());
        $("#memo").val($("#v11").text());
    }
}

$(document).ready(function () {
    // init the input fields if get
    company_init();
    
    $("#name").blur(function(){
		var value = $.trim($("#name").val());
		if (value.length == 0) {
		    $("#tip1").html('请输入公司全名.');
		}else{
			$("#tip1").html('');
		}
    });
    
    $("#shortname").blur(function(){
		var value = $.trim($("#shortname").val());
		if (value.length == 0) {
		    $("#tip2").html('请输入公司简称.');
		}else{
			$("#tip2").html('');
		}
    });

    $("#pinyin").blur(function(){
		var value = $.trim($("#pinyin").val());
		if (value.length == 0) {
		    $("#tip3").html('请输入公司简称拼音/缩写.');
		}else{
			$("#tip3").html('');
		}
    });    
    
    $("#address").blur(function(){
		var value = $.trim($("#address").val());
		if (value.length == 0) {
		    $("#tip4").html('请输入公司详细地址.');
		}else{
			$("#tip4").html('');
		}
    });        
    
    $("#test").bind("click", function(){
         //alert($("#v1").text());
         //alert($("#id").val());
         return false;
    });    
    
});
