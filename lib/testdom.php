
<?php
/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>中配网首页</title>
<meta name="Description" content="中配网提供丰富的挖机配件信息">
<meta name="Keywords" content="最专业的挖机配件信息网">
<link rel="stylesheet" href="paging.css" type="text/css" />
</head>
<body>
	include_once 'simple_html_dom.php';	
	$html = file_get_html('./layout.html');
//$html = str_get_html("<div>foo <b>bar</b></div>");
//$e = $html->find("div", 0);
$e = $html->find(".topLeftMenu", 0);

//echo $e->tag; // 返回: " div"
echo $e->outertext; // 返回: " <div>foo <b>bar</b></div>"
//echo $e->innertext; // 返回: " foo <b>bar</b>"
//echo $e->plaintext; // 返回: " foo bar"
*/
?>

<?php
    function _echo($str)
    {
    	echo str."\n";
    }
    
    function layout()
	{
		echo $GLOBALS['TEMPLATE']['DOCTYPE'];
		echo $GLOBALS['TEMPLATE']['HEAD'];
		echo "<body id=\"wanet\">\n";
		echo $GLOBALS['TEMPLATE']['TOP'];
		echo $GLOBALS['TEMPLATE']['HEADER'];
		echo "<div class=\"w main\">\n";
		echo $GLOBALS['TEMPLATE']['LEFT'];
		echo "  <div class=\"home_content\"></div>\n";
		echo "  <div class=\"right-extra\"></div>\n"; 
		echo "  <span class=\"clr\"></span>\n";
		echo "</div>\n";
		echo "<div class=\"w\"></div>\n";
		echo $GLOBALS['TEMPLATE']['FOOTER'];
	}
	
	function layout1($title, $css, $content)
    {
    	// html doctype head
		echo $GLOBALS['TEMPLATE']['DOCTYPE'];
		
		// title and css links
		echo '<title>'.$title.'</title>';
		echo '<link rel="stylesheet" type="text/css" href="'.$css.' media="all" />';
		echo "</head>\n<body>\n";
		
		// html nav and content
		echo $GLOBALS['TEMPLATE']['TOP'];
		echo $GLOBALS['TEMPLATE']['NAV'];
		echo "<div class=\"w main\">\n";
		echo $GLOBALS['TEMPLATE']['LEFT'];
		echo $content;
		echo "  <span class=\"clr\"></span>\n";
		echo "</div>\n";
		echo "<div class=\"w\"></div>\n";
		echo $GLOBALS['TEMPLATE']['FOOTER'];
	}
	
	include_once 'simple_html_dom.php';
	$html = file_get_html('./layout.html');

	// get html doctype
	$GLOBALS['TEMPLATE']['DOCTYPE'] = 
		"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n" .
		"<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		"<head>\n".
		"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n".
		"<meta name=\"Description\" content=\"中配网提供丰富的挖机配件信息\" />\n".
		"<meta name=\"Keywords\" content=\"最专业的挖机配件信息网\" />\n";			
	
	// get htnl head
	$e = $html->find("head", 0);
	$GLOBALS['TEMPLATE']['HEAD'] = $e->outertext."\n<body>\n";

	// get top navigate bar
	$e = $html->find(".topnav", 0);
	$GLOBALS['TEMPLATE']['TOP'] = $e->outertext."\n";
	
	// get top header bar
	$e = $html->find("#header", 0);
	$GLOBALS['TEMPLATE']['NAV'] = $e->outertext."\n";
	
	// get top header bar
	$e = $html->find("#w main", 0);
	$GLOBALS['TEMPLATE']['MAIN'] = $e->outertext."\n";

	// get top left bar
	$e = $html->find(".left", 0);
	$GLOBALS['TEMPLATE']['LEFT'] = $e->outertext."\n";

	// get top left bar
	$e = $html->find("#footer", 0);
	$GLOBALS['TEMPLATE']['FOOTER'] = $e->outertext."\n</body>\n</html>";

	layout1('test','','');

/*
</body>
</html>	
*/
?>
