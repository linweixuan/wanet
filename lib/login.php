<?php	
  //
  // global user login check
  //
  session_start();
    
  if (!(isset($_SESSION["userid"]) && isset($_SESSION["username"]))) {
      header('Location: ../login/index.html');
  }

?>