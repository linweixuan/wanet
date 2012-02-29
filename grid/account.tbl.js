
// 初始化Grid的属性
jQuery("#tblobj").jqGrid({
    height: "100%",
    width: "100%",
   	url:'account.tbl.php?q=2',
	datatype: "json",
   	colNames:['编号','系统用户', '全名', '角色', '电话', '邮件','QQ','日期'],
   	colModel:[
   		{name:'id',index:'id', width:30},
   		{name:'name',index:'name', width:80, editable:true},
        {name:'fullname',index:'fullname', width:80, editable:true},
        {name:'role',index:'role', width:80, editable:true},
   		{name:'phone',index:'phone', width:100,editable:true},
   		{name:'email',index:'email', width:150, align:"right",editable:true},		
   		{name:'qq',index:'qq', width:80, align:"right", sortable:false,editable:true},
        {name:'date',index:'date', width:120, sortable:false,editable:true},
   	],
   	rowNum:18,
   	rowList:[10,20,30],
    gridview: true,
   	pager: '#tblpage',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
    loadui: "enable",
	editurl: "account_save.php",
    ondblClickRow: function(rowid) {
        //$(this).jqGrid('editGridRow', rowid);        
        window.parent.load_idtab_page('系统用户', './user/account.php',rowid);
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
        id, { url: 'account_save.php', reloadAfterSubmit:false}
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
        id, { url: 'account_delete.php', reloadAfterSubmit: false}
    );
}
