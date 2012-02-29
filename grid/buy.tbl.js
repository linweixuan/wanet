//
// GF buy bill list
//

var select_year = '';
var select_month = '';
var select_query = 'buy.tbl.php';

// 动态查询消息月或年
function set_grid_url(query) {
    jQuery("#tblobj").jqGrid("setGridParam", {
        url: query,
        datatype: "json"
    }).trigger('reloadGrid');
}

// 显示当前年月和设置查询条件
function set_datetime_active()
{
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var date = now.getDate();
    
    // set currrent year
    var select =  '#y' + year;
    $(select).addClass("active");
    
    // set currrent month 
    select =  '#m' + month;    
    $(select).addClass("active");
    
    // make the request url  string
    select_query = 'buy.tbl.php?year='+year+'&month='+month;    
    select_year = year;
    select_month = month;

    for (var i=(year-1); i<=(year+1); i++) {
        var id = "#y" + i;
        jQuery(id).bind("click", function(){
            var select = $.trim($(this).attr("href"));
            $('#y'+select_year).removeClass("active");
            $(this).addClass("active");
            select_year = select;
            // set the grid query url
            var query = 'buy.tbl.php?year='+select_year;
            set_grid_url(query);
            return false;
        });
    }    
    
    for (var i = 1; i <= 12; i++) {
        var id = "#m" + i;
        jQuery(id).bind("click", function(){
            var select = $.trim($(this).attr("href"));            
            $('#m'+select_month).removeClass("active");            
            $(this).addClass("active");
            select_month = select;            
            // set the grid query url
            var query = 'buy.tbl.php?year='+select_year+'&month='+select_month;
            set_grid_url(query);
            return false;
        });
    }    
}


//Grid中增删改之后的数据,一起提交给服务器
function post_changes() {
    //var rowData =$.toJSON($("#crud").getRowData());
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    $("#tblobj").jqGrid('rowsave',
        id, { url: 'sale_save.php', reloadAfterSubmit:false}
    );
}

//取消Grid中增删改之后的数据.
function post_cancle() {
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    jQuery("#rowsave,#rowcancel").attr("disabled",true);
    jQuery("#tblobj").jqGrid('restoreRow',id);
}

// Grid的删除操作
function post_delete() {
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    $("#tblobj").jqGrid('delGridRow',
        id, { url: 'sale_delete.php', reloadAfterSubmit: false}
    );
}


$(document).ready(function () {
    // 设置当前时间
    set_datetime_active();
    
    // 初始化Grid的属性
    $("#tblobj").jqGrid({
        height: "100%",
        width: "100%",
        url: select_query,
        datatype: "json",
        colNames:['编号','客户','单号','总额','日期','备注'],
        colModel:[
            {name:'id',index:'id', width:40},
            {name:'name',index:'name', width:200, editable:true},
        //       {name:'operator',index:'operator', width:100,editable:true},
            {name:'num',index:'num', width:130,editable:true},
        //	{name:'book',index:'book', width:100,editable:true},
        //	{name:'sheet',index:'sheet', width:100,editable:true},        
            {name:'total',index:'total', width:70, align:"right",editable:true},   		
            {name:'date',index:'date', width:150, align:"right",editable:true},		
            {name:'memo',index:'memo', width:110, align:"centre",editable:true}   
        ],
        rowNum:20,
        rowList:[10,20,30],
        pager: '#tblpage',
        sortname: 'id',
        viewrecords: true,
        sortorder: "asc",
        loadonce: false,
        editurl: "sale_save.php",
        ondblClickRow: function(rowid) {
            //$(this).jqGrid('editGridRow', rowid);        
            window.parent.add_buy_tab(rowid);
        }    
    });

    // 设置Grid中行删除按钮和删除调用函数
    $("#tblobj").jqGrid('navGrid',
        '#tblpage',
        {
            add:false,
            edit:false,
            del:true,
            delfunc: function(id){ 
                //alert("delete "+id+"?");
                post_delete();
            }
        }
    );

    //操作Grid增删改的按钮相关事件和调用
    $("#rowedit").click( function() {
        id = $("#tblobj").jqGrid('getGridParam','selrow');
        jQuery("#tblobj").jqGrid('editRow',id);
        this.disabled = 'true';
        jQuery("#rowsave,#rowcancel").attr("disabled",false);
    });
    $("#rowsave").click( function() {
        id = $("#tblobj").jqGrid('getGridParam','selrow');
        jQuery("#tblobj").jqGrid('saveRow',id); 
        jQuery("#rowsave,#rowcancel").attr("disabled",true); 
        jQuery("#rowedit").attr("disabled",false);
        //post_changes();
    });
    $("#rowcancel").click( function() {
        id = $("#tblobj").jqGrid('getGridParam','selrow');
        jQuery("#rowsave,#rowcancel").attr("disabled",true);
        jQuery("#tblobj").jqGrid('restoreRow',id);
    });
    $("#rowdelete").click( function() {
        post_delete();
    });    
});
