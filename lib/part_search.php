<?php
  // search the company for auto complete
  require_once 'db.php';
  require_once 'part.php';

  // get user input keys  
  $key = strtolower($_GET["q"]);  
  $id = strtolower($_GET["x"]);
  if (!$key) return;  
  
  /*  
  $output = print_r($_GET, true);
  $fp = fopen("part_search.log", "w");
  fwrite($fp, $output);
  fclose($fp);  
    */
    
  //  search the keys for company
  Part::instance()->search($key,$id);
?>