<?php

  function login()
  {
	$form = ob_get_clean(); 
	if (!isset($_POST['submitted'])){
		$GLOBALS['TEMPLATE']['content'] = $form;
		echo $GLOBALS['TEMPLATE']['content'];
	}
	else{
		$user = new User();
		$user->login();
	}  	
  }
?>