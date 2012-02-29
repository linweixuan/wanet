//
// GF main tab panel
//

var tabpanel;  
var jcTabs = [];

function load_tab_page(name,page)
{
     $('#navifrm').hide();
     $('#tab').show();
     tabpanel.addTab({id: page,
        title: name ,
        html:'<iframe name="ifrm" id="ifrm" src="' +page+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function load_idtab_page(name,page,id)
{   
     var url = page;
     if (typeof(id) != "undefined") {
        url = page + "?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill(name);
     tabpanel.addTab({id: name,
        title: name,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_company_tab(id)
{   
     var url = "company.php";
     if (typeof(id) != "undefined") {
        url = "company.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("添加客户");
     tabpanel.addTab({id:"添加客户",
        title:"添加客户" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_part_tab(id)
{
     var url = "part.php";
     if (typeof(id) != "undefined") {
        url = "part.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("添加部件");
     tabpanel.addTab({id:"添加部件",
        title:"添加部件" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_sale_tab(id)
{
     var url = "sale.php";
     if (typeof(id) != "undefined") {
        url = "sale.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("销售开单");
     tabpanel.addTab({id:"销售开单",
        title:"销售开单" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_buy_tab(id)
{
     var url = "buy.php";
     if (typeof(id) != "undefined") {
        url = "buy.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("采购单");
     tabpanel.addTab({id:"采购单",
        title:"采购单" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_entry_tab(id)
{
     var url = "entry.php";
     if (typeof(id) != "undefined") {
        url = "entry.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("入库单");
     tabpanel.addTab({id:"入库单",
        title:"采购单" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

function add_presale_tab(id)
{
     var url = "presale.php";
     if (typeof(id) != "undefined") {
        url = "presale.php?id=" + id;
     }
     
     $('#tab').show();
     tabpanel.kill("价格定制单");
     tabpanel.addTab({id:"价格定制单",
        title:"价格定制单" ,
        html:'<iframe name="ifrm" id="ifrm" src="' +url+ '" scrolling="no"></iframe>',
        closable: false,
        disabled:false
     });
}

$(document).ready(function(){  
    tabpanel = new TabPanel({  
        renderTo:'tab',  
        width:760,  
        height:630,  
        heightResizable: true,
        border: false,  
        active : 0,
       //maxLength : 10,  
        items : []
    });  
    
    // default load the sale page
    $('#tab').hide();
    
}); 