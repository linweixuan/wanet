<?php   

    include('cutpage.php');   
    header("content-type:text/html;charset=utf-8");//设置页面编码   
    //自定义的长文章字符串，可以包含 html 代码，若字符串中有手动分页符 {nextpage} 则优先按手动分页符进行分页   
    
    $content = file_get_contents('testcut.html');   
    $ipage = $_GET["ipage"]? intval($_GET["ipage"]):1;   
    
    $page = new cutpage();   
    $page->pagestr = $content;   
    $page->cut_str();   
    echo $page->pagearr[$ipage-1]."<hr/>";   
    echo $page->show_prv_next();

?>