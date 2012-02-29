//
// GF sales json
//
function trim(str) {
    return str.replace(/^\s+|\s+$/g, "");
}

function Part() {
    this.id = '';
    
    // display fields
    this.name = '';
    this.code = '';
    this.unit = '';
    this.price = '0.0';
    this.quantity = '';
    this.memo = '';
}

function Sales() {
    this.id = '';
    this.companyid = '';
    
    // display fields
    this.company = '';
    this.address = '';
    this.parts = new Array();
    this.billnum = '';
    this.billbook = '';
    this.operator = '';
    this.date = '';
    this.total = '';
}

function add_line() {
	var $rows = $("#protab tr");
	var idx = '<td class="bgs" style="width: 20px;">1</td>';
	var box = '<div class="editbox1"><input id="' + name + '" name="' + name + '" value="" class="pinput" type="text"></div>';
}

function getSales() {
	var tbl = $(".protab");
	var trlist = tbl.find("tr");    
    var sales = new Sales();    
    
    // get sale bill fields
    sales.id = trim($("#saleid").val());
    sales.companyid = trim($("#companyid").val());
    sales.company = trim($("#company").val());
    sales.address = trim($("#address").val());
    sales.billnum = trim($("#billnum").val());
    sales.billbook = trim($("#billbook").val());    
    sales.operator = trim($("#operator").val());
    sales.date = trim($("#date").val());
    sales.total = trim($("#total").val());
    
    // check all parts price sum
    if (!salesum()) {
        return;
    }
    
    // get the part fileds 
	for (var i = 1; i < trlist.length; i++) {
		var tr = $(trlist[i]);
		var inputs = tr.find("INPUT[type='text']");
                
        // get the row input fileds 
        var part = new Part();
        part.id = trim($(inputs[0]).val());
        part.name = trim($(inputs[1]).val());
        part.code = trim($(inputs[2]).val());
        part.unit = trim($(inputs[3]).val());        
        part.quantity = trim($(inputs[4]).val());
        part.price = trim($(inputs[5]).val());
        part.memo = trim($(inputs[7]).val());
        
        // skip the empty rows
        if (part.id == "" &&
            part.name == "" &&
            part.price == "" &&
            part.quantity == ""){
            continue;
        }

        // check the part id if avaiable
        if( part.id == "") {
            alert("你不能直接输入未入系统的部件名称,请先添加部件:" + part.name + "!");
            return;
        }
        
        sales.parts.push(part);
        /*
		for (var j = 0; j < inputs.length; j++) {
			var input = $(inputs[j]);
			alert(input.val());
		}
                     */
	}
    
    var request = $.toJSON(sales); 
    $.post(
        "lib/sales_post.php",
        {data: request}, 
        function(resp, state){
            if(state == "success")
                $('.result').html(resp.data);
            else
                $('.result').html("数据保存失败!");                
        },
        "json"
    );

}

function setTimeAndNo() {
    var now = new Date();
    var year;
    var month;
    var date;
    var hourse;
    var minute;
    var second;
    
    year = now.getFullYear();
    month = now.getMonth() + 1;
    date = now.getDate();
    hourse = now.getHours();       
    minute = now.getMinutes();
    second = now.getSeconds();
    
    var timestr = year+'年'+month+'月'+date+'日 '+hourse+':'+minute+':'+second;
    $("#date").attr("value",timestr);
    
    var zero = '';
    if(month<10) {
        zero = '0';
    }
    
    var billno = 'NO-'+year+zero+month+date;
    $("#billno").attr("value",billno);    
}

function sumprice(){
    $('span').parent().parent()
}


var lines = 1;
function initSaleTable(n) {
    // avoid refresh get old value
    var tr = $(".protab tr").eq(1);
    var inputs = tr.find("INPUT[type='text']");
    for (var i = 0; i < inputs.length; i++) {
        $(inputs[i]).attr("value","");
    }

    // avoid refresh get old total value
    $("#total").attr("value","0.00");
    
    // add  more rows to table
    for(var i=1; i<n; i++) {
        var tr = $(".protab tr").eq(1).clone();    
        tr.find("td").get(0).innerHTML = i;
        tr.show();
        tr.appendTo(".protab");    
    }
    lines = n;
}

function newline() {
    var tr = $(".protab tr").eq(1).clone();    

    // empty the input value
    var inputs = tr.find("INPUT[type='text']");
    for (var i = 0; i < inputs.length; i++) {
        $(inputs[i]).attr("value","");
    }     
    
    // clone the table row
    tr.find("td").get(0).innerHTML = ++lines;
    tr.show();
    tr.appendTo(".protab");
}

function ajaxpost(){
    getSales();
}

function check_inputs(tr) {
    var inputs = tr.find("INPUT[type='text']");
   
    // check the value number
    var value = $.trim($(inputs[4]).val());
    if(value == "" || isNaN(value)) {
        //alert("请输入销售数量!");
        return false;
    }
    
    value = $.trim($(inputs[5]).val());
    if(value == "" || isNaN(value)) {
        //alert("请输入销售部件销售价!");
        return false;
    }
    
    // calculate the part price*num
    var price = parseFloat($(inputs[4]).val());
    var quantity = parseInt($(inputs[5]).val());
    var sum = (price *  quantity).toFixed(2) ;
    $(inputs[6]).attr("value",sum);
    
    return true;
}

function salesum(){
	var tbl = $(".protab");
	var trlist = tbl.find("tr");    
	var total = 0.0;
    
	for (var i = 1; i < trlist.length; i++) {
		var tr = $(trlist[i]);
		var inputs = tr.find("INPUT[type='text']");
        
        var value1 = $.trim($(inputs[1]).val());
        var value4 = $.trim($(inputs[4]).val());
        var value5 = $.trim($(inputs[5]).val());

        if(value1 == "" && value4 == "" && value4 == "") {
            continue;
        }

        if(value1 == "") {
            alert("请输入部件名称,然后再计算!");
            return false;
        }
        
        if(value4 == "" || isNaN(value4)) {
            $(inputs[4]).focus();
            alert("请输入销售数量,然后再计算!");
            return false;
        }
        
        if(value5 == "" || isNaN(value5)) {
            $(inputs[5]).focus();
            alert("请输入销售部件销售价,然后再计算!!");
            return false;
        }
        
        // calculate the part price*num        
        var price = parseFloat(value4);
        var quantity = parseInt(value5);
        var sum = (price *  quantity).toFixed(2);
        total = total + (price *  quantity);        
        $(inputs[6]).attr("value",sum);
    }
    $("#total").attr("value",total.toFixed(2));
    return true;
}


$(document).ready(function () {
    // set the sale bill number
    setTimeAndNo();
    
    // add sales part lines
    initSaleTable(8);
    
    // calculate every part sum price
    $("#quantity").live("blur",function(){
        var tr = $(this).parent().parent().parent();
        var inputs = tr.find("INPUT[type='text']");
        check_inputs(tr);
    });
    
    // calculate every part sum price
    $("#price").live("blur",function(){
        var tr = $(this).parent().parent().parent();
        check_inputs(tr);
    });
    
});
