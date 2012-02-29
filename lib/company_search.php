<?php
  // search the company for auto complete 
  require_once 'db.php';
  require_once 'company.php';

  // get user input keys
  $key = strtolower($_GET["q"]);
  if (!$key) return;  

  /*
  $output = print_r($_GET, true);
  $fp = fopen("company_search.log", "w");
  fwrite($fp, $output);
  fclose($fp); 
  */
  
  //  search the keys for company
  Company::instance()->search($key);
?>