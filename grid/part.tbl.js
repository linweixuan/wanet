
// 初始化Grid的属性
jQuery("#tblobj").jqGrid({
    height: "100%",
    width: "100%",
   	url:'part.tbl.php?q=2',
	datatype: "json",
   	colNames:['编号','部件名称','纯正部件编号','广福编码',/*'英文名','别名',*/'简称拼音','缩写','规格参数','库存','价格'],
   	colModel:[
   		{name:'id',index:'id', width:30},
   		{name:'name',index:'invdate', width:170, sortable:false,editable:true},
   		{name:'partno',index:'name', width:90,sortable:false,editable:true},
   		{name:'code',index:'pinyin', width:90, align:"right",sortable:false,editable:true},
   	//	{name:'ename',index:'ename', width:100, align:"right",sortable:false,editable:true},		
   	//	{name:'alias',index:'alias', width:70,align:"right",sortable:false,editable:true},		
   		{name:'pinyin',index:'pinyin', width:70, sortable:false,editable:true},
        {name:'abbr',index:'abbr', width:50, sortable:false,editable:true},
        {name:'spec',index:'spec', width:90, sortable:false,editable:true},
        {name:'quantity',index:'quantity', width:40, sortable:false,editable:true},
        {name:'price',index:'price', width:60, sortable:false,editable:true}
   	],
   	rowNum:23,
   	rowList:[10,20,30],
   	pager: '#tblpage',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
	editurl: "part_save.php",
    loadui: "enable",
    gridview: true,
    ondblClickRow: function(rowid) {
        //$(this).jqGrid('editGridRow', rowid);        
        window.parent.add_part_tab(rowid);
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
        id, { url: 'part_save.php', reloadAfterSubmit:false}
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
        id, { url: 'part_delete.php', reloadAfterSubmit: false}
    );
}