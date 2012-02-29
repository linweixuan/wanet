//
// list menu script
//
function trim(str) {
  return str.replace(/^\s+|\s+$/g, "");
}

$(document).ready(function() {
    var catalogIndex=[0,0];
    
    if (catalogIndex[0]==2){
        catalogIndex[0]=3;
    }else if(catalogIndex[0]==3){
        catalogIndex[0]=2;
    }
    //alert(catalogIndex[0]);
    
    if(catalogIndex.length==0){
        catalogIndex=[0,0];
    }
    
    $(".re_left .menu h3 a").each(function(){
        $(this).attr("src",$(this).attr("href"));
    });
    
    $(".re_left .menu").find("ul").css("border-bottom",0).end()
        .find("h3:eq("+catalogIndex[0]+")").addClass("open").find("a")
        .attr("href","javascript:void(0);")
        .end()
        .next()
        .css("display","block")
        .find("li:eq("+(catalogIndex[1]-1==-1?9999:catalogIndex[1]-1)+")").addClass("active");
        
    $(".re_left .menu").find("h3").last().css("border-bottom-width","0");                
    
   
    // click menu http
    $(function(){
      $(".re_left a").click(function(){
        //alert(this.text);
        var key = this.text;
        var url = 'list.php?catalog=' + key;
        //window.location.href = 'http://www.wanet.cn/articles/show.php?catalog=' + key;
        //alert(url);
        changeIframeSrc('ifrm',url);
        return true;
      })
      
   })
   
});    
    
$(".re_left .menu").find("h3").bind("click",function(){
    if ($(this).hasClass("open"))
    {
        if ($(this).next().find(".active").size()==0)
        {
            $(this).next().slideUp(200,function(){
            $(this).prev().removeClass("open");
            });        
        }else{
            $(this).next().slideUp(200,function(){
            $(this).prev().removeClass("open");
            //window.location.href=$(this).prev().find("a").attr("src");
            });
        }
    }
    else
    {
        $(this).parent().find("ul").slideUp("slow").end().find("h3").removeClass("open");
        $(this).addClass("open").next().slideDown(200,function(){
            if ($(this).nextAll("h3").size()>0)
                {$(this).parent().find("h3").last().css("border-bottom-width","1px");}
            else
                {$(this).parent().find("h3").last().css("border-bottom-width","0");}
                window.location.href=$(this).prev().find("a").attr("src");
        });
    }
    
    /*
    alert(this.text);
    var key = urlEncode(trim(this.text));
    var url = 'list.php?catalog=' + key;
    //window.location.href = 'http://www.wanet.cn/articles/show.php?catalog=' + key;
    alert(url);
    changeIframeSrc('ifrm',url);
    return false;
    */
});        

// assign new url to iframe element's src property
/*
function changeIframeSrc(id, url) {
    if (!document.getElementById) return;
    var el = document.getElementById(id);
    if (el && el.src) {
        el.src = url;
        return false;
    }
    return true;
}
*/