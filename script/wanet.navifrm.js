
$(document).ready(function() {
    // click menu http
    $(function(){
      $("#naviicon a").click(function(){
        //alert(this.text);
        var name = $(this).text();
        var url = $(this).attr("href");
		if(url == "help.php")
			return ture;        
        if(url == "../table/taiho-quote.php")
            return ture;
        if($.trim(name) == '')
            name = $(this).attr("title");
        //alert(name);
        //changeFrameUrl('ifrm',url);
        window.parent.tabpanel.clean();
        window.parent.load_tab_page(name,url);
        return false;
      })
      
   })
   
}); 
