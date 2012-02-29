//
// welcome user if already login
//

$(document).ready(function() {
    // show welcome title
    var tips = $(".session").html();
    $(".session").hide();
    $(".welcome").html(tips);

    // check user login name
	  var title = $(".welcome").html();
    var name = title.substr(2,title.length-12);	    

    if(name.length) {
        // change the my parts link
        change_myhome_link();
    }
    else{
        // if  login, change the publish link
        change_publish_link(); 
    }

});

function change_myhome_link() {    
    var link = '<a href="http://www.wanet.cn/company/' + name + '.php">我的配件</a>';    
    // change the link to users' home link
    $("#my").html(link);
}

function is_loginui_define() {
    var obj = $('.loginui').attr('href');
    if (typeof(obj) == 'undefined')
        return false;
    return true;
}

function change_publish_link() {
    var link = 'http://www.wanet.cn/login/index.html';
    var url = $('.loginui').attr('href');
    if (typeof(url) != 'undefined'){
        // change the link to users' login ui
        $('.loginui').attr("href",link);

        // init login fancy popup box
        $(".loginui").fancybox({
          'autoScale'			: true,
          'transitionIn'	: 'none',
          'transitionOut'	: 'none',
          'type'				  : 'iframe',
          'onClosed'		  : function() {
                              var title = $(".welcome").html();                              
                              var name = title.substr(2,title.length-12);	  
                              if(name.length) {                              
                                  window.location.href = 'http://www.wanet.cn/publish.php';
                              }
                          }
        });
    }
}