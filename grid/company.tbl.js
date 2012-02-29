
// 初始化Grid的属性
jQuery("#tblobj").jqGrid({
    height: "100%",
    width: "100%",
   	url:'company.tbl.php?q=2',
	datatype: "json",
   	colNames:['编号','公司全名', '简称', '拼音','缩写','地址','电话'],
   	colModel:[
   		{name:'id',index:'id', width:30},
   		{name:'name',index:'invdate', width:180, editable:true},
   		{name:'shortname',index:'name', width:80,editable:true},
   		{name:'pinyin',index:'pinyin', width:70, align:"right",editable:true},
   		{name:'abbr',index:'abbr', width:50, align:"right",editable:true},		
   		{name:'address',index:'address', width:180, sortable:false,editable:true},
        {name:'telephone',index:'telephone', width:110, sortable:false,editable:true},
   	],
   	rowNum:18,
   	rowList:[10,20,30],
    gridview: true,
   	pager: '#tblpage',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
    loadui: "enable",
	editurl: "company_save.php",
    ondblClickRow: function(rowid) {
        //$(this).jqGrid('editGridRow', rowid);        
        window.parent.add_company_tab(rowid);
    }
});

// 设置Grid中行删除按钮和删除调用函数
jQuery("#tblobj").jqGrid('navGrid',
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
jQuery("#rowedit").click( function() {
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    alert(id);
    jQuery("#tblobj").jqGrid('editRow',id);
	this.disabled = 'true';
	jQuery("#rowsave,#rowcancel").attr("disabled",false);
});
jQuery("#rowsave").click( function() {
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    jQuery("#tblobj").jqGrid('saveRow',id); 
    jQuery("#rowsave,#rowcancel").attr("disabled",true); 
    jQuery("#rowedit").attr("disabled",false);
    //post_changes();
});
jQuery("#rowcancel").click( function() {
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    jQuery("#rowsave,#rowcancel").attr("disabled",true);
    jQuery("#tblobj").jqGrid('restoreRow',id);
});
jQuery("#rowdelete").click( function() {
	post_delete();
});

//Grid中增删改之后的数据,一起提交给服务器
function post_changes() {
    //var rowData =$.toJSON($("#crud").getRowData());
    id = $("#tblobj").jqGrid('getGridParam','selrow');
    $("#tblobj").jqGrid('rowsave',
        id, { url: 'company_save.php', reloadAfterSubmit:false}
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
        id, { url: 'company_delete.php', reloadAfterSubmit: false}
    );
}
