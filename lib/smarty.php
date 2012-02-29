<?php
  //
  // include smarty template engine
  //
  require_once '../smarty/libs/Smarty.class.php';
  
  // create template instance
  $smarty = new Smarty;
  $smarty->template_dir = "./templates/";
  $smarty->compile_dir = "./templates_c/";
  $smarty->config_dir = "./configs/";
  $smarty->cache_dir = "./cache/";
   
  // setup  template instance
  $smarty->debugging = true;
  $smarty->caching = true;
  $smarty->cache_lifetime = 60*60*24;
  
  //$smarty->left_delimiter = '<{';
  //$smarty->right_delimiter = '}>';

?>
  