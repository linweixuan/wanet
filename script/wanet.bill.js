//
// GF bills json
//

var sale_rows = 1;
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
    this.num = '';
    this.book = '';
    this.sheet = '';
    this.operator = '';
    this.date = '';
    this.total = '';
    // bill type(buy,entry,presale,sale)
    this.type = '';
    this.warehouse = '';
}

function check_company() {
    // check the value number
    var value = $.trim($(inputs[4]).val());
    if(value == "" || isNaN(value)) {
        //alert("请输入销售数量!");
        return false;
    }
}

function init_bill_ifetch() {
    // set the sale bill header
    if($('#get').is('div')) {
        $("#saleid").val($("#v1").text());
        $("#company").val($("#v2").text());
        $("#companyid").val($("#v3").text());        
        $("#address").val($("#v4").text());
        $("#operator").val($("#v5").text());
        $("#total").val($("#v6").text());    
        $("#date").val($("#v7").text());    
        $("#num").val($("#v8").text());
        $("#book").val($("#v9").text());
        $("#sheet").val($("#v10").text());
    }else{
        return;
    }
    
    // get the sale parts values
    var sales = $("#get").find("#sales");
    if (typeof sales == "undefined"){
        return;
    }
    
    // get the sale table rows
    var tbl = $(".protab");
    var trlist = tbl.find("tr");    
    
    // assign the value  to inputs
    for (var i = 0; i < sales.length; i++) {
        var part = $(sales[i]);
        var value = part.find("li");
        var tr = $(trlist[i+1]);
        var inputs = tr.find("INPUT[type='text']");
        
        $(inputs[0]).attr( "value", $(value[0]).text() );
        $(inputs[1]).attr( "value", $(value[1]).text() );
        $(inputs[2]).attr( "value", $(value[2]).text() );
        $(inputs[3]).attr( "value", $(value[3]).text() );
        $(inputs[4]).attr( "value", $(value[4]).text() );
        $(inputs[5]).attr( "value", $(value[5]).text() );
        $(inputs[6]).attr( "value", $(value[6]).text() );
        $(inputs[7]).attr( "value", $(value[7]).text() );
        //alert($(value[0]).text());
    }
}

function get_bill_fields(warehouse) {
	var tbl = $(".protab");
	var trlist = tbl.find("tr");    
    var sales = new Sales();    
    
    // get sale bill fields
    sales.id = trim($("#saleid").val());
    sales.companyid = trim($("#companyid").val());
    sales.company = trim($("#company").val());
    sales.address = trim($("#address").val());
    sales.num = trim($("#num").val());
    sales.book = trim($("#book").val());
    sales.sheet = trim($("#sheet").val());
    sales.operator = trim($("#operator").val());
    sales.date = trim($("#date").val());
    sales.total = trim($("#total").val());
    sales.type = $('#bill').html();
    sales.warehouse = warehouse;
    
    // check bill head fields
    if (sales.companyid == "" || sales.company == "") {
        alert("请输入客户名或简称,新客户请先添加!");
        $("#company").focus();
        return;
    }
    
    // check parts fields and sum
    if (!salesum()) {
        return;
    }
    
    // get the part fileds 
    var count = 0;
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
            alert("没有该部件信息,请先添加该部件:" + part.name + "!");
            $(inputs[1]).focus();
            return;
        }
        
        sales.parts.push(part);
        count++;
        /*
		for (var j = 0; j < inputs.length; j++) {
			var input = $(inputs[j]);
			alert(input.val());
		}
                     */
	}
    
    // still not have the parts to saled
    if(count <= 0) {
        $('.result').html("当前单据没有部件,请输入部件!");
        return;
    }
    
    // post the sale information
    $('.result').html("正在保存数据...");
    var request = $.toJSON(sales); 
    ajax_swap();  // 与ajaxqueue.js冲突解决方法
    $.post(
        "lib/bill_post.php",
        {data: request}, 
        function(resp, state){
            if(state == "success") {
                $("#saleid").val(resp.id);
                $('.result').html(resp.data);                
            }else
                $('.result').html("数据保存失败!");                
        },
        "json"
    );
    ajax_swap();
}


function set_bill_datetime() {
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
    
    var timestr = year+'年'+month+'月'+date+'日 '+hourse+':'+minute;
    $("#date").attr("value",timestr);
    
    var zero = '';
    if(month<10) {
        zero = '0';
    }
    
    //var billno = 'NO-'+year+zero+month+date;
    //$("#billno").attr("value",billno);    
}

function init_bill_table(n) {
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
    sale_rows = n;
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
    
    // calculate the price totals
    salesum();
    return true;
}

function newline() {
    var tr = $(".protab tr").eq(1).clone();    

    // empty the input value
    var inputs = tr.find("INPUT[type='text']");
    for (var i = 0; i < inputs.length; i++) {
        $(inputs[i]).attr("value","");
    }     
    
    // clone the table row
    tr.find("td").get(0).innerHTML = sale_rows++;
    tr.show();
    tr.appendTo(".protab");
}

function newbuy(){
    // refresh the sale page for new
    location.href = "buy.php";
}

function newentry(){
    // refresh the sale page for new
    location.href = "entry.php";
}

function newprice(){
    // refresh the sale page for new
    location.href = "presale.php";
}

function newsale(){
    // refresh the sale page for new
    location.href = "sale.php";
}

function savebill(){
    // salesum function will check the fields
    if (salesum()) {
        // 单纯保存,如总库
        var warehouse = 'general';
        get_bill_fields(warehouse);
    }
}

function warehouse(){
    // salesum function will check the fields    
    if (salesum()) {
        // 保存,直接进分库
        var warehouse = 'sub';
        get_bill_fields(warehouse);
    }
}

function savesale(){
    // salesum function will check the fields
    if (salesum()) {
        // 单纯保存,如总库
        var warehouse = 'sub';
        get_bill_fields(warehouse);
    }
}

function sumprice(){
    $('span').parent().parent()
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
            alert("请输入部件名称,计算总额!");
            return false;
        }
        
        if(value4 == "" || isNaN(value4)) {
            $(inputs[4]).focus();
            alert("请输入该部件数量,计算总额!");
            return false;
        }
        
        if(value5 == "" || isNaN(value5)) {
            $(inputs[5]).focus();
            alert("请输入该部件价格,计算总额!");
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

function test_submit(){
    alert('test');
}

$(document).ready(function () {
    // set the sale bill number and date time
    set_bill_datetime();
    
    // add sales parts to sale table rows
    var rows = 8;
    var sales = $("#sales");
    if (typeof sales != "undefined") {
        if (sales.length > 8)
            rows = sales.length+1;
    }
    // init the bill's table inputs
    init_bill_table(rows);

    // put the get values to input fields
    init_bill_ifetch();
    
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
       
    // open the company page to tab panel
    $("#tablink").bind("click", function(){
        window.parent.add_company_tab();
        return false;
    });          
    
    //  just place a test  bind here.
    $("#test").bind("click", function(){
         return false;
    });        
});