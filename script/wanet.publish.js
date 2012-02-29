//
// wanet parts catalog and publish
//
function trim(str) {
  return str.replace(/^\s+|\s+$/g, "");
}

// 发布编辑器
KE.show({
  id : 'contents',
  cssPath : '../../kindeditor/examples/index.css',
  resizeMode : 1,
  afterCreate : function(id) {
    KE.event.ctrl(document, 13, function() {
      KE.util.setData(id);
      document.forms['part'].submit();
    });
    KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
      KE.util.setData(id);
      document.forms['part'].submit();
    });
  }
});

// 品牌分类页
$(function() {
  $( "#brand" ).tabs();
});

// 品牌分类分页函数
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

// 型号发动机点击赋值
$(function(){
  $(".changp a").click(function(){
    $("#series").attr("value",this.text);
    return false;
  })
})

// 部件根菜单项点击赋值
$(function(){
  $(".class_nav a").click(function(){
    $("#module").attr("value",this.text);
    return false;
  })
})

// 部件子菜单项点击赋值
$(function(){
  $(".psubmenu a").click(function(){
    $("#module").attr("value",this.text);
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
   
// 页面之间移动部件菜单初始化
var menu; var ower; var newer;
$(document).ready(function() 
{
    ower = '#page-komatsu5';
    child = ower+'::first';
    menu = $(child).html();
    
    $("#brads").attr("value",'小松');
     
    // 型号发动机菜单项点击赋值
    var parts = ower+' a';
    $(parts).click(function(){        
        $("#series").attr("value",this.text);
        return false;
    });
});
   
//  品牌点击,移动部件菜单
$(function(){
  $(".ui-corner-top a").click(function(){    
    var link = $(this).attr("href");
    var name = link.substr(1,link.length-1);        
    $("#brads").attr("value",this.text);
    
    // 移动部件菜单
    newer = '#page-'+name+'5';    
    $(ower).empty();
    $(ower).hide();
    $(newer).html(menu);
    ower = newer;
    
    // 部件子菜单重设
    submenu_float();
    
    // 设置选择的部件值
    var parts = newer+' a';
    $(parts).click(function(){    
        $(".module").attr("value",this.text);
        return false;
    });
        
    return true;    
  })
});
   
// post ajaxt fields check
function check_publish()
{
    var brand = trim(document.part.brads.value);
    var series = trim(document.part.series.value);
    var module = trim(document.part.module.value);
    var title = trim(document.part.title.value);
    var contents = trim(document.part.contents.value);
	
    if (brand.length == 0) {
        $("#brads").focus();
        alert("请选择挖机品牌,可以通过点击上面的挖机品牌!");
        return false;
    }
	
    if (series.length == 0) {
        $("#series").focus();
        alert("请选择挖机型号或发动机型号,移动鼠标自动获取!");
        return false;
    }

    if (module.length == 0) {
        $("#module").focus();
        alert("请选择挖机部件,移动鼠标选择!");
        return false;
    }    

    if (title.length == 0) {
        $("#title").focus();
        alert("请输入标题,方便快速获取你的部件信息!");
        return false;
    }

    if (contents.length == 0) {
        $("#contents").focus();
        alert("请输入内容,丰富你的部件信息,提供热点!");
        return false;
    }
}
