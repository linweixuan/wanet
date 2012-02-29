//
// wanet articles catalog and post
//

function trim(str) {
  return str.replace(/^\s+|\s+$/g, "");
}

// load the html editor
KE.show({
    id : 'contents',
    cssPath : '../kindeditor/examples/index.css',
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

// set the brand tab
$(function() {
    $( "#brand" ).tabs();
});

// get the select value
$(function(){
    $(".sortnav_nr a").click(function(){
        if(this.href == "http://www.wanet.cn/parts.php")
            $("#module").attr("value",this.text);
        else
            $("#series").attr("value",this.text);
        return false;
    })
})

// post fields check
function trim(str) {
    return str.replace(/^\s+|\s+$/g, "");
}

// post ajaxt fields 
function submitcheck() 
{    
    var title = trim(document.part.title.value);
    var catalog = trim(document.part.catalog.value);
    var contents = trim(document.part.contents.value);
    
    if (catalog.length == 0) {
        $("#catalog").focus();
        alert("请选择发布的内容的类型,方便分类查找!");
        return false;
    }

    if (title.length == 0) {
        $("#title").focus();
        alert("请输入标题,方便获取你发布的信息!");
        return false;
    }

    if (contents.length == 0) {
        $("#contents").focus();
        alert("请输入内容,丰富你的发布信息内容!");
        return false;
    }

    /*
    $.post("../lib/article_post.php", , decodeURIComponent($("#part").serialize()), 
        function(result){
            alert("Data Loaded: " + result);
        }
    );
    */
}

// init the catalog menu for input text
$(document).ready(function()
{
    $("#catalog").focus(function(){
      $('#navlayer').show();
    });
    
    $(".test").bind('mouseover',function()
    {
        $('#navlayer').show();
    }).bind('mouseleave',function()
    {
        //$('#navlayer').hide();
    });		

    $("#navlayer").bind('mouseover',function()
    {
    }).bind('mouseleave',function()
    {
        $('#navlayer').hide();
    });		

    $(".navdiv>dl>dd").bind('mouseover',function()
    {
        var top = parseInt($(this).offset().top);
        var left = parseInt($(this).offset().left);
        $(this).children('ul').css("top",top-340);
        $(this).children('ul').show();
        
    }).bind('mouseleave',function()
    {
        $(this).children('ul').hide();
    });

   
   // click menu http
    $(function(){
		$("#navlayer a").click(function(){
			//if(this.href == "#")
            $("#catalog").attr("value",this.text);
			return false;
		})
   })

   
});