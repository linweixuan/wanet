//
// wanet parts catalog configurations
//

// for brand tab head catalog
$(function() {
  $( "#brand" ).tabs();
});

// for brand series module/parts catalog
function tabid(id) {
	return document.getElementById(id);
}

function showTab(name,id) {
	for(var i=1;i<=5;i++) {
		if(id==i) {
			tabid('catalog-'+name+i).className='con3_con3_col3_title1';
			tabid('page-'+name+i).style.display='';
		} else {
			tabid('catalog-'+name+i).className='con3_con3_col3_title2';
			tabid('page-'+name+i).style.display='none';
		}
	}
}

// for brand series another type catalog - not use anymore
$(function(){
  $(".changp a").click(function(){    
    $(".querymodule").attr("value",this.text);
    return false;
  })
})

// for brand series another type catalog - not use anymore
$(function(){
$(".sortnav_nr a").click(function(){
  if(this.href == "http://www.wanet.cn/parts.php")
    $("#module").attr("value",this.text);
  else
    $("#series").attr("value",this.text);
  return false;
})
})

// for parts menu and sub menu when mouse move over
function parts(id) {
	return document.getElementById(id);
}

function showpart(id) {
	for(var i=1;i<=20;i++) {
		if(id==i) {
			parts('subpart'+i).style.display='';
		} else {
			parts('subpart'+i).style.display='none';
		}
	}
}

// 部件根菜单项点击赋值
$(function(){
  $(".class_nav a").click(function(){
    $("#querypart").attr("value",this.text);
    return false;
  })
})

// 部件子菜单项点击赋值
$(function(){
  $(".psubmenu a").click(function(){
    //alert(this.text);
    document.queryfrom.part.value = this.text;
    //$("#querypart").attr("value",this.text);
    $.powerFloat.hide();
    return false;
  })
})

// 显示部件子菜单
function submenu_float(id) {
	  $("#pc1").powerFloat({eventType: "click"});
    $("#pc2").powerFloat({eventType: "click"});
    $("#pc3").powerFloat({eventType: "click"});
    $("#pc4").powerFloat({eventType: "click"});
    $("#pc5").powerFloat({eventType: "click"});
    $("#pc6").powerFloat({eventType: "click"});
    $("#pc7").powerFloat({eventType: "click"});
    $("#pc8").powerFloat({eventType: "click"});
    $("#pc9").powerFloat({eventType: "click"});
    $("#pc10").powerFloat({eventType: "click"});
    $("#pc11").powerFloat({eventType: "click"});
    $("#pc12").powerFloat({eventType: "click"});
    $("#pc13").powerFloat({eventType: "click"});
    $("#pc14").powerFloat({eventType: "click"});
    $("#pc15").powerFloat({eventType: "click"});
    $("#pc16").powerFloat({eventType: "click"});
    $("#pc17").powerFloat({eventType: "click"});
    $("#pc18").powerFloat({eventType: "click"});
    $("#pc19").powerFloat({eventType: "click"});
    $("#pc20").powerFloat({eventType: "click"});
}

$(function() {
  submenu_float();
});

// 页面之间移动部件菜单
var menu; var ower; var newer;
$(document).ready(function() 
{
    ower = '#page-komatsu5';
    child = ower+'::first';
    menu = $(child).html();
    
    // for brand series parts catalog 
    var parts = ower+' a';
    $(parts).click(function(){
        $(".querypart").attr("value",this.text);
        return false;
    });
});

// for brand series another type catalog - not use anymore
$(function(){
  $(".ui-corner-top a").click(function(){
    var link = $(this).attr("href");
    var name = link.substr(1,link.length-1);    
    
    // set query brand when click brand page
    $(".querybrand").attr("value",this.text);
    $(".querymodule").attr("value","");
    
    // 移动部件菜单
    newer = '#page-'+name+'5';
    $(ower).empty();
    $(ower).hide();
    $(newer).html(menu);
    ower = newer;
    
    // 部件子菜单重设
    submenu_float();

    // for brand series parts catalog 
    var parts = newer+' a';
    $(parts).click(function(){    
        $(".querypart").attr("value",this.text);
        return false;
    });
    
    return true;
  })
})
       
// post ajaxt fields check
function queryParts()
{
    var brand = $.trim(document.queryfrom.brand.value);
    var module = $.trim(document.queryfrom.module.value);
    var part = $.trim(document.queryfrom.part.value);
	
    if (module.length == 0 && part.length == 0) {
        $(".querymodule").focus();
        alert("请输入查询条件,可以通过点击上面链接自动获取!");
        return false;
    }
    
    var url = "partlist.php?";
    if (brand.length) {
        url = url + "brand=" + brand + "&";
    }    
    if (module.length) {
        url = url + "module=" + module + "&";
    }
    if (part.length) {
        url = url + "part=" + part;
    }
    
    //window.location.href = 'http://www.wanet.cn/articles/show.php?catalog=' + key;
    alert(url);
    changeIframeSrc('ifrm',url);
    return false;
}

$(function(){
  $("#searchbtn").click(function(){    
    return queryParts();    
  })    
})