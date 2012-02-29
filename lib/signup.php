<?php

  require_once 'layout.php';
  require_once 'common.php';
  require_once 'db.php';
  require_once 'functions.php';
  require_once 'user.php';
	
  //
  // global user register function
  //
  function register()
  {
	$user = new User();
	if ($user->parse($_POST)) {
		if ($user->register()) {
			echo "success";
			return;
		}
	}
	echo $user->error;
  }
  
  // call user register by ajax request
  register();
?>
  