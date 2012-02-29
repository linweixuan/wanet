<?php

  require_once 'layout.php';
  require_once 'common.php';
  require_once 'db.php';
  require_once 'functions.php';
  require_once 'user.php';
	
  //
  // write the publish text to file
  //
  function save()
  {
      // read the template
      $content = file_get_contents('partinfo.html'); 
      if (!$content){
        return "fail read template";
      }    	
      
	 $tags = array("#TITLE#", "#BRAND#", "#MODULE#", "#ENGINE#", 
		"#TYPE#", "#NAME#", "LOCATION", "#DATE#", "#PRICE#");
	 
	$fields[0] = "TITLE";
    $fields[1] = "BRAND";
    $fields[3] = "MODULE";
    $fields[4] = "ENGINE";
    $fields[5] = "TYPE";
    $fields[6] = "NAME";
    $fields[7] = "LOCATION";
    $fields[8] = "DATE";
    $fields[9] = "PRICE";
      
      $content = str_replace($tags,$fields,$content);
      
      $date = date("Ymd-Hms");
      $filename = sprintf("../publish/%d-%d-%s.html", 1, 1, $date);
      $fp = fopen($filename, "w");
      if (!$fp)  {
          return "fail create file";
      }
      
      if (fwrite($fp, $content) == FALSE) {      	  
          fclose($fp);
          return "fail wirte content";
      }
      
      fclose($fp);
      return $filename;
    }
  
    save("tgu us steest");
?>