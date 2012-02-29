<?php

  require_once 'layout.php';
  require_once 'common.php';
  require_once 'db.php';
  require_once 'functions.php';
  require_once 'user.php';
  
  $key = $_POST["key"];
  if($name == "jzc"){
    echo "对不起，".$name."数据存在";
  }
  else{
    echo "恭喜你，".$name."可以使用";
  }

?>
  