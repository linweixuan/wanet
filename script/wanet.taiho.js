//
// wanet search configurations
//

function log(event, data, formatted) {
	$("<li>").html(!data ? "No match!" : "Selected: " + formatted).appendTo("#result");
}

function formatItem(row) {
	if ($.trim(row[1]) == "")
		return row[0];
	else
		//return row[0] + "(" + row[1] + ")";
        return '<span class="key1">' +row[0]+ '</span><span class="key2">' +row[1]+ '(' +row[6]+ ')</span>';
}

function formatCompanyItem(row) {
	if ($.trim(row[1]) == "")
		return row[0];
	else
		//return row[0] + "(" + row[1] + ")";
        return '<span class="key1">' +row[0]+ '</span><span class="key2">' +row[1]+ '</span>';
}

function formatResult(row) {
	return row[0].replace(/(<.+?>)/gi, '');
}


function setPartAutoComplete() {
	var tbl = $(".protab");
	var trlist = tbl.find("tr");
	
	for (var i = 1; i < trlist.length; i++) {
		var tr = $(trlist[i]);
		var inputs = tr.find("INPUT[type='text']");
		
		// $(inputs[1]).attr("value","++++v++");
		
		$(inputs[1]).autocomplete('http://www.wanet.cn/lib/part_search.php', {
            extraInput : "#companyid",
			width : 285,
			max : 11,
            multiple: false,
            multipleSeparator: "",
			scrollHeight : 350,
			matchContains : true,
			formatItem : formatItem,
			formatResult : formatResult
		});
		
		$(inputs[1]).result(function (event, data, formatted) {
			var hidden = $(this).parent().next().find(">:input");
			hidden.val((hidden.val() ? hidden.val() + ";" : hidden.val()) + data[1]);
            
            // set the part id value
            //var objs = $(this).siblings();
            //var id = objs[0];
            //$(id).attr("value",data[2]);

            // set the patr code value
            var tr = $(this).parent().parent().parent();
            var fields = tr.find("INPUT[type='text']");
            $(fields[0]).attr("value",data[2]); // id
            $(fields[2]).attr("value",data[3]); // code
            $(fields[3]).attr("value",data[4]); // unit
            $(fields[5]).attr("value",data[5]); // price
            //alert($(id).val());
            //alert($(fields[0]).value());
		});
	}
}

function test_com() {
    var str = $("#companyid").val();
    alert(str);
}

function setCompanyAutoComplete() {

	$("#company").autocomplete('http://www.wanet.cn/lib/company_search.php', {
		width: 345,
        max: 11,
		multiple: false,
        multipleSeparator: "",        
        scrollHeight: 350,
		matchContains: true,
		formatItem: formatCompanyItem,
		formatResult: formatResult
	});
	
	$("#company").result(function(event, data, formatted) {
		var hidden = $(this).parent().next().find(">:input");
		hidden.val( (hidden.val() ? hidden.val() + ";" : hidden.val()) + data[1]);
        var objs = $(this).siblings();
        var companyid = objs[1];        
        //$(companyid).attr("value",data[2]);        
        //alert($('#companyid').val());
        $("#address").attr("value",data[3]);
        $("#companyid").attr("value",data[2]);        
	});
}

function setPriceAutoShowHistory() {
	var tbl = $(".protab");
	var trlist = tbl.find("tr");
	
	for (var i = 1; i < trlist.length; i++) {
		var tr = $(trlist[i]);
		var inputs = tr.find("INPUT[type='text']");
        
        $(inputs[5]).bind('dblclick',function() {
            // get this input  part id number
            var tr = $(this).parent().parent().parent();
            var inputs = tr.find("INPUT[type='text']");
            var partid = $.trim($(inputs[0]).val());
            if (partid == '') return;
            
            // get this bill's compnay id number
            var companyid = trim($("#companyid").val());
            if (companyid == '') return;
            
            // get the company and partid' price
            get_history_prices(partid,companyid,this);
            
            // show price pop menu
            $(this).powerFloat({
                eventType: null,
                width: 145,
                target: $("#mprice")
            });
        });
    }
}

function get_history_prices(partid, companyid, input) {
    ajax_swap(); 
    $.post(
        "lib/prices_get.php",
        { part: partid, company: companyid }, 
        function(resp, state){
            if(state == "success") {
                build_prices_popmenu(resp,input);
            }
        },
        "json"
    );
    ajax_swap();
    return;
}

function build_prices_popmenu(prices,input) {
    var menu = '';
    
    if( typeof(prices) == "undefined" ) 
        return;
    if( $.trim(prices) == "" )
        return;
    if( prices.length == 0)
        return;
    
    for(var i=0, l=prices.length; i<l; i++) {
        menu += '<li class="ac_even"><span class="key1">' 
        +prices[i].price+ '</span><span class="key2">' 
        +prices[i].date+ '</span></li>';
    }
    
    $("#mprice ul").empty();
    $("#mprice ul").html(menu);
    
    $(".ac_even").bind('mouseover',function() {
        $(this).addClass("ac_over");
    }).bind('mouseleave',function()
    {
        $(this).removeClass("ac_over");
    });	
    
    $(".ac_even").click(function(){
        var price = $(this).find(".key1");
        //alert($(price).html());        
        var str = $(price).html();
        str = str.substring(1);
        $(input).attr("value",str);
        $("#mprice").hide();
        return false;
    });
    
    $("#mprice").bind('mouseleave',function() {
        $(this).hide();
    });
    return;
}

$().ready(function () {

	// set comany name auto complete
    setCompanyAutoComplete();
    
    // set part name auto complete
	setPartAutoComplete();
    
    // set part price auto show
    setPriceAutoShowHistory();
    
	$(":text, textarea").result(log).next().click(function () {
		$(this).prev().search();
	});
	
	$("#clear").click(function () {
		$(":input").unautocomplete();
	});
	
});
