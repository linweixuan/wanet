<?php
  class session 
  {
      // user fields
	  public $id;
	  public $uid;
	  public $ip;
	  public $last;
      
	function __construct()
    {
        // default values
        $this->id = 0;
        $this->uid = 0;
        $this->last = 0;        
    }

    function __destruct()
	{
	}
	    
    function add()
    {
        // insert sql statement
		$sql = sprintf('INSERT INTO session (uid, ip, last) VALUES ("%d","%s","%s")',
		  $this->id, 
		  $this->uid, 
		  $this->ip, 
		  $this->last);
	  		
		// get database instance
        $db = GLOBALDB();
        $result = $db->query($sql);
        if (!$result or mysql_affected_rows() != 1) {            
            return false;
        }
        
        // insert successfully
        mysql_free_result($result);    
        return true;            
	}    	

	function update()
	{
		$sql = sprintf(
		  'UPDATE session SET uid = %d,'.
		  'ip = "%s",'.
		  'last = "%s"',
		  $this->uid,
		  $this->ip,
		  $this->last);
	  		
		$db = GLOBALDB();		
		$result = $db->query($sql);
		return $result;
	}
		
	function delete($uid)
	{
		$db = GLOBALDB();
		$sql = sprintf('DELETE session WHERE uid = "%d"',$uid);		
		$result = $db->query($sql);
		return $result; 
	}
    
    function is_online()
    {
        $online = FALSE;
        $db = GLOBALDB();
        
        $sql = sprintf(
            'SELECT id, uid' .
            'FROM session WHERE uid = "%d"',
        	$this->uid);

        if ($result = $db->query($sql)) {            
            if (mysql_num_rows($result))
                $online = TRUE;
            mysql_free_result($result);
        }        
		                
        return $online;
    }
  }
  
  // check current session   
  function welcome()
  {
    // check session life time
    session_start();
    if (isset($_COOKIE[session_name()])) 
    {
        $name = $_SESSION['username'];
        $uid = $_SESSION['userid'];
            
        echo '<div class="session" style="display:none">您好'.$name.', 欢迎来到中配网!</div>';        
    }
  }  
  
  function islogin()
  {
    session_start();
    if (isset($_COOKIE[session_name()])) 
    {
    	//echo '+++++++++++id='.$_SESSION["userid"].'?++++++++++'; 
        //echo $_SESSION["username"];
    	if ($_SESSION["username"] != null && 
    		!empty($_SESSION["username"])) {
			return ture;
		}
    }
    header('Location: login.php');
    return false;
  }
  
  function logout()
  {
    session_start();
    unset($_SESSION['userid']); 
    unset($_SESSION['username']); 
    session_destroy(); 
    header('Location: index.php');
  }

  function verify()
  {
    if(!isset($_SESSION['user_agent'])){
        $_SESSION['user_agent'] = MD5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
    }
    elseif ($_SESSION['user_agent']!=MD5($_SERVER['REMOTE_ADDR']. $_SERVER['HTTP_USER_AGENT'])) {
        	session_regenerate_id();
    }
  }
  
?>
