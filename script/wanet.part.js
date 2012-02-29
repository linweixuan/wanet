//
// GF company json
//

function Part() {
    this.id = '';
    
    // display fields
    this.catalog = '';
    this.series = '';
    this.model = '';
    this.partno = '';
    this.code = '';
    this.name = '';
    this.ename = '';
    this.alias = '';
    this.pinyin = '';
    this.abbr = '';
    this.spec = '';
    this.unit = '';
    this.quantity = '';
    this.price = '';
    
    // functions
    this.newone = function() {
        $("#catalog").attr("value","");
        $("#series").attr("value","");
        $("#model").attr("value","");
        $("#partno").attr("value","");
        $("#code").attr("value","");
        $("#name").attr("value","");
        $("#ename").attr("value","");
        $("#alias").attr("value","");
        $("#pinyin").attr("value","");
        $("#abbr").attr("value","");
        $("#spec").attr("value","");
        $("#unit").attr("value","");
        $("#quantity").attr("value","");
        $("#price").attr("value","");
    }
    
    this.check = function() {
        var isok = true;
        var value = $.trim($("#name").val());
        if (value.length == 0){
            $("#tip1").html('请输入部件全名.');
            isok = false;
        }
        
        value = $.trim($("#pinyin").val());
        if (value.length == 0){
            $("#tip4").html('请输入部件简称拼音/缩写.');
            isok = false;
        }
        
        value = $.trim($("#quantity").val());
        if (value.length == 0){
            $("#tip12").html('请输入部件库存数量.');
            isok = false;
        }else{
            if(isNaN(value)) {
                $("#tip12").html('请输入有效的部件库存数量.');
            }
        }
        
        value = $.trim($("#price").val());
        if (value.length == 0){
            $("#tip13").html('请输入部件价格.');
            isok = false;
        }else{
            if(isNaN(value)) {
                $("#tip13").html('请输入有效的部件价格.');
                isok = false;
            }
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
        this.catalog = $.trim($("#catalog").val());
        this.series = $.trim($("#series").val());
        this.model = $.trim($("#model").val());
        this.partno = $.trim($("#partno").val());
        this.code = $.trim($("#code").val());
        this.name = $.trim($("#name").val());
        this.ename = $.trim($("#ename").val());
        this.alias = $.trim($("#alias").val());
        this.pinyin = $.trim($("#pinyin").val());
        this.abbr = $.trim($("#abbr").val());
        this.spec = $.trim($("#spec").val());
        this.unit = $.trim($("#unit").val());
        this.quantity = $.trim($("#quantity").val());
        this.price = $.trim($("#price").val());
    
        $('.result').html("正在保存数据...");           
        var request = $.toJSON(this);        
        $.post(
            "lib/part_post.php",
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
    var part = new Part();
    part.post();
}

function addmore() {
    var part = new Part();
    $('.result').html('');      
    part.newone();
}

function part_init() {
    if($('#get').is('div')) {
        $("#id").val($("#v1").text());        
        $("#catalog").val($("#v2").text());
        $("#series").val($("#v3").text());
        $("#model").val($("#v4").text());
        $("#partno").val($("#v5").text());
        $("#code").val($("#v6").text());
        $("#name").val($("#v7").text());
        $("#ename").val($("#v8").text());
        $("#alias").val($("#v9").text());
        $("#pinyin").val($("#v10").text());
        $("#abbr").val($("#v11").text());
        $("#spec").val($("#v12").text());
        $("#unit").val($("#v13").text());
        $("#quantity").val($("#v14").text());
        $("#price").val($("#v15").text());        
    }
}

$(document).ready(function () {
    // load the part infor if get
    part_init();

    $("#name").blur(function(){
		var value = $.trim($("#name").val());
		if (value.length == 0) {
		    $("#tip1").html('请输入部件全名.');
		}else{
			$("#tip1").html('');
		}
    });
    
    $("#pinyin").blur(function(){
		var value = $.trim($("#pinyin").val());
		if (value.length == 0) {
		    $("#tip10").html('请输入部件简称拼音/缩写.');
		}else{
			$("#tip10").html('');
		}
    });    
    
    $("#price").blur(function(){
		var value = $.trim($("#price").val());
		if (value.length == 0) {
		    $("#tip13").html('请输入部件参考售价.');
		}else{
			$("#tip13").html('');
		}
    });        
});
