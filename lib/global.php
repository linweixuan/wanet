<?php
  include 'db.php';
  include 'user.php';
  include 'session.php';
  
  class wanet
  {
  	public $user;
  	public $session;
  	
	function __construct()
    {
		$this->$user = new user();
		$this->session = new session();
    }
    
    function __destruct()
	{
	}
	    
	function init()
	{	
  		// start session
		session_start();	
		$curtime = time();
		
		if ($HTTP_COOKIE_VARS[online] == "on")
		{
			// get session information
			$session->uid = $HTTP_SESSION_VARS["uid"];
			$session->ip = substr($REMOTE_ADDR,0,50);
			$session->last = time() + 3600;
			
			// update session information
			$session->update();
		}
		else {
			$page = "login.php"; 
			header("Location: $page");
			exit;
		}
  	}
  }
  
  // initialization
  $WANET = new wanet();
  $WANET->init();
  
?>