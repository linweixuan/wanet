<?php	
  //
  // global user logout function
  //
  session_start();
  
  unset($_SESSION['userid']); 
  unset($_SESSION['username']); 
  
  session_destroy(); 
  header('Location: ../login/index.html');

?>
  