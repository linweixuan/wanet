// assign new url to iframe element's src property
function changeFrameUrl(id, url) {
    if (!document.getElementById) return;
    var el = document.getElementById(id);
    if (el && el.src) {
        el.src = url;
        return false;
    }
    return true;
}

function autoFrameHeight() {
    var ifm = document.getElementById("ifrm");
    var html = document.frames ? document.frames["ifrm"].document : ifm.contentDocument;
    if(ifm != null && html != null) {
       ifm.height = html.body.scrollHeight;
       $(".right_win").height(ifm.height);
       $("#navifrm").height(ifm.height);       
       if(ifm.height > 599) {
        $(".right_win").height(ifm.height);
        $("#navifrm").height(ifm.height);
       }else{
        $(".right_win").height(620);
        $("#navifrm").height(599);
       }       
    }
}

function autoFrameHeightId(id) {
    var ifm = document.getElementById(id);
    var html = document.frames ? document.frames["id"].document : ifm.contentDocument;
    if(ifm != null && html != null) {
       ifm.height = html.body.scrollHeight;
       if(ifm.height > 599) {
        $(".right_win").height(ifm.height);
        $("#navifrm").height(ifm.height);
       }else{
        $(".right_win").height(620);
        $("#navifrm").height(599);
       }
    }
}

function hover_click_menu(menu) {
    $(this).removeClass("active");
}

$(document).ready(function() {
    // click menu http
    $(function(){
      $("#vmenu a").click(function(){
        //alert(this.text);
        var name = this.text;
        var url = $(this).attr("href");
        if(url == "help.html")
            return ture;
            
        $('#vmenu li').each(function() {
            $(this).removeClass('hover');
        });            
        $(this).parent().addClass("hover");
        //alert(url);
        //changeFrameUrl('ifrm',url);
        tabpanel.clean();
        load_tab_page(name,url);
        return false;
      })      
    })

    $(".menu a").click(function(){
        var name = this.text;
        var url = $(this).attr("href");
            
        $('.menu li').each(function() {
            $(this).removeClass('hover');
        });            
        $(this).parent().addClass("hover");
        //alert(url);
        $('#tab').hide();
        tabpanel.clean();
        $('#navifrm').show();
        changeFrameUrl('navifrm',url);
        return false;
    })    
   
}); 
