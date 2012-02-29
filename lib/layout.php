<?php

  require_once 'simple_html_dom.php';

  class Layout
  {
	// instannce variable
	static $pattern;
		 
	private function __construct()
	{
	}

    function __destruct()
	{
	}
		
	private function __clone()
	{
	}

	public static function instance()
	{
		static $me;
		if (is_object($me) == true) 
		{
			return $me;
		}
		$me = new Layout;
		$me->load();
		return $me;
	}
		
	function load()
	{
		// load the main layout(top,nav,left)
		$this->load_main_layout();
		
		// load article left navigate menu
		$this->load_article_template();
	}

	function load_main_layout()
	{
		$str = dirname(__FILE__);
		$html = file_get_html(dirname(__FILE__).'/layout.html');

		// get html doctype
		$GLOBALS['TEMPLATE']['DOCTYPE'] = 
			"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n" .
			"<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
			"<head>\n".
			"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n".
			"<meta name=\"Description\" content=\"中配网提供丰富的挖机配件信息\" />\n".
			"<meta name=\"Keywords\" content=\"最专业的挖机配件信息网\" />\n";			
		
		// get html head
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
		$GLOBALS['TEMPLATE']['FOOTER'] = $e->outertext."\n";
	}
	
	function load_article_template()
	{
		$dir = dirname(__FILE__);
		$file = $dir.'\templates\article-layout.html';
		$html = file_get_html($file);
        
		// get article left navigate menu  bar
		$e = $html->find(".re_left", 0);
		$GLOBALS['TEMPLATE']['RESMENU'] = $e->outertext."\n";

		// get article post div box
		$e = $html->find(".post", 0);
		$GLOBALS['TEMPLATE']['RESPOST'] = $e->outertext."\n";

		$e = $html->find(".miniNav", 0);
		$GLOBALS['TEMPLATE']['RESNAV'] = $e->outertext."\n";

		$e = $html->find("#pageBox", 0);
		$GLOBALS['TEMPLATE']['RESPAGE'] = $e->outertext."\n";
				
		/*
        $fp = fopen("log1.txt", "w");
        fwrite($fp, $GLOBALS['TEMPLATE']['RESMENU']);
        fclose($fp);
        */
    }        
    
	function show($title, $css, $content)
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

	function show1($title, $css)
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
		echo "  <div class=\"home_content\"></div>\n";
		echo "  <div class=\"right-extra\"></div>\n"; 
		echo "  <span class=\"clr\"></span>\n";
		echo "</div>\n";
		echo "<div class=\"w\"></div>\n";
		echo $GLOBALS['TEMPLATE']['FOOTER'];
	}
   }
	
    // load global layoyt templete
    function load_layout()
    {
		$templet = Layout::instance();
	}
  
	function html_head($title)
	{
		// html doctype head
		echo $GLOBALS['TEMPLATE']['DOCTYPE'];
		
		// title and css links
		//echo '<title>'.$title.'</title>';
	}

	function topmemu()
	{
		echo $GLOBALS['TEMPLATE']['TOP'];
	}
	
	function topbar()
	{
		echo $GLOBALS['TEMPLATE']['TOP'];
		echo $GLOBALS['TEMPLATE']['NAV'];
	}

	function menubar()
	{
		echo "<div class=\"w main\">\n";
		echo $GLOBALS['TEMPLATE']['LEFT'];
	}

	function mainwin()
	{
		echo "<div class=\"w main\">\n";		
	}
    
	function footer()
	{
		echo "  <span class=\"clr\"></span>\n";
		echo "</div>\n";
		echo "<div class=\"w\"></div>\n";
		echo $GLOBALS['TEMPLATE']['FOOTER'];
	}

	function resource_left_menu()
	{
		echo $GLOBALS['TEMPLATE']['RESMENU'];
	}
	
	// global load layout function here	
	Layout::instance();
?>	