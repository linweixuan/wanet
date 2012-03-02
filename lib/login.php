<?php	
  //
  // global user login check
  //
  require_once 'access.php';
  
  session_start();
    
  if (!(isset($_SESSION["userid"]) && isset($_SESSION["username"]))) {
      header('Location: ../login/index.html');
  }

  if ( !Access::instance()->check() ) {
      header('Location: ../deny.php');
  }

?>