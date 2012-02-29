//
// cookie functions
//

function setCookie(name,value,expiredays)
{
    var exdate = new Date();
    
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = name + "=" + escape(value)+
        ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
}


function getCookie(name)
{
    if (document.cookie.length>0)
    {
        start = document.cookie.indexOf(name + "=");
        if (start!=-1)
        { 
            start = start + name.length+1;
            end = document.cookie.indexOf(";",start);
            if (end == -1) 
                end = document.cookie.length;
            return unescape(document.cookie.substring(start,end));
        } 
    }
    return "";
}

function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    
    var value = getCookie(name);
    if( value != null ) 
        document.cookie = name + "=" + value +";expires=" + exp.toGMTString();
}

function checkCookie()
{
    username = getCookie('username');    
    if (username != null && username != "") {
        alert('Welcome again '+username+'!');
    }else {
        username = prompt('Please enter your name:',"");
        if (username !=null && username != "") {
            setCookie('username',username,365);
        }
    }
}