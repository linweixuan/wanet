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
    

<?php
	include_once 'simple_html_dom.php';

//$content = '<a href="http://www.wanet.cn/"><img src="http://www.wanet.cn/logo.png" alt="wanet" width="132" height="58" /></a>';
$content = '<p><img alt="" src="http://www.wanet.cn/attached/20110309105629_66420.png" border="0" /></p><p>&nbsp;</p><h3 class="t">';
  /*
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  echo $first_img;
*/
$html = str_get_html($content);

// Find all images
foreach($html->find('img') as $element)
       echo $element->src . '<br>';
	   
?>

</body>
</html>