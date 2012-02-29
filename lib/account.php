<?php
require_once 'db.php';

// account class
class Account
{      
	  public $id;
	  public $name;
      public $fullname;
	  public $passwd;
	  public $token;
      public $role;
	  public $phone;
	  public $address;
	  public $province;
	  public $city;
	  public $code;
	  public $email;
	  public $qq;
	  public $msn;
	  public $other;
	  public $type;
	  public $level;
	  public $date;
	  
	  // error code
	  public $error;
      
	function __construct()
    {
        // default values
        $this->id = 0;
        $this->name = '';
        $this->fullname = '';
        $this->role = '';
        $this->passwd = '';
        $this->type = '0';
        $this->level = '0';
        $this->date = date('Y-m-d H:i:s');
        
        // inner variable
        $this->error = 0;        
    }
    
  	function __destruct()
	{
 	
	}
	    
    function parse($post)
	{   
	    // Trim all the incoming data
	    $obj = array_map('trim', $post);        
	    if (!$this->valid_null($post))
	    	return false;
	    
	    // Save contact information
        $this->id = mysql_real_escape_string($obj['id']);
        $this->name = mysql_real_escape_string($obj['name']);
        $this->fullname = mysql_real_escape_string($obj['fullname']);
        $this->role = mysql_real_escape_string($obj['role']);
        $this->passwd = mysql_real_escape_string($obj['passwd']);
        $this->token = mysql_real_escape_string($obj['token']);
        $this->phone = mysql_real_escape_string($obj['phone']);
        $this->address = mysql_real_escape_string($obj['address']);
        $this->province = mysql_real_escape_string($obj['province']);
        $this->city = mysql_real_escape_string($obj['city']);
        $this->code = mysql_real_escape_string($obj['code']);
        $this->email = mysql_real_escape_string($obj['email']);
        $this->qq = mysql_real_escape_string($obj['qq']);
        $this->msn = mysql_real_escape_string($obj['msn']);
        $this->other = mysql_real_escape_string($obj['other']);
        $this->type = mysql_real_escape_string($obj['type']);
        $this->level = mysql_real_escape_string($obj['level']);
      
        // Check part avaiable value 
        if (!$this->valid_value())  {
            return false;
        }
        
	  	return true;
	}

	function valid_null(array $post) {
		if ($post['name'] == null || !strlen($post['name'])) {
			$this->error = "用户名不能为空!";
	  		return false;
		}
		if ($post['passwd'] == null || !strlen($post['passwd'])) {
			$this->error = "用户密码不能为空!";
	  		return false;
		}
		return true;
	}
    
    function valid_value()
    {
	    // Check for user account name
	    if (!preg_match ('/^[A-Z \'.-]{2,20}$/i', $this->name)) {
	    	$this->error = "用户名不合规范!";
	        return false;
	    }

	    // Check for a password and match against the confirmed password:
	    if (!preg_match ('/^\w{4,20}$/', $this->passwd) ) {
	    	$this->error = "用户密码不合规范!";
	        return false;
	    }
        return true;
    }
    
    function valid_name()
    {        
        // default no exist
        $exist = FALSE;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM account WHERE name = "%s"',$this->name);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $this->error = "该用户名已经存在!";
                $exist = TRUE;
            }
            // close result set
            mysql_free_result($result);
        }
        
        return $exist;
    }  
    
  	function valid_auth()
	{
		$isauth = false;
	    $db = GLOBALDB();
		
		// Query databse for account
        $sql = sprintf('SELECT id, name, passwd ' .
            'FROM account WHERE name = "%s" and passwd = "%s"',
        	$this->name,$this->passwd);
                
        if ($result = $db->query($sql)) {
        	if (mysql_num_rows($result)) {
        		$row = mysql_fetch_assoc($result);      
	            $this->id = $row['id'];
	            $isauth = true;
        	}else{
                $this->error = "密码输入不正确!";
            }
        }
        
        mysql_free_result($result);
        return $isauth;
	}
		
  	function valid_token($token) {
	  return true;
	}
    
    function save($post)
    {
        if(!$this->parse($post)) {
            return $this->err();
        }
        
        if (!is_null($this->id) && ((int)$this->id)) {
           if(!$this->update())
               return $this->err();
        }
        else{
            // check account name if exist
            if ($this->valid_name()) {
                return $this->err();
            }
            if(!$this->add()) {
                return $this->err();
            }
            $this->register();
        }
        
        $result['id'] = $this->id;
        $result['data'] = "用户已经成功添加!";
        $json = json_encode($result);
        echo $json;
    }    
    
    function err()
    {
        $result['data'] = $this->error;
        $json = json_encode($result);
        echo $json;
    }
    
    function auth($post)
    {
        if(!$this->parse($post)) {
            return $this->err();
        }
        
        // check account name if exist
        if (!$this->valid_auth()) {
            return $this->err();
        }
        
        // set the login sesstion
        $this->login();
        
        // login success return
        $result['id'] = $this->id;
        $result['data'] = "用户登陆成功";
        $json = json_encode($result);
        echo $json;        
    }        
    
	function register()
	{  
        // destroy previous session
        if(isset($_COOKIE[session_name()])){
            session_start();
            session_unset();
            session_destroy();
            setcookie(session_name(),'',time()-3600); 
        }
        
        // start session with user id
        session_start();
        $_SESSION['userid'] = $this->id;
        $_SESSION['username'] = $this->name;
        
        // set session life time
        $lifeTime = 20 * 86400;
        setcookie(session_name(), session_id(), time() + $lifeTime, "/");
        setcookie("userid", $this->id, time() + $lifeTime, "/");
        setcookie("username", $this->name, time() + $lifeTime, "/");
	}
	    
	function login()
	{
		// user already logged in?
		if(!empty($_SESSION['username'])){
			return true;
		}
  
		// destroy previous session
	    if(isset($_COOKIE[session_name()])){
	        session_start();
	        session_unset();
	        session_destroy();
	        setcookie(session_name(),'',time()-3600); 
	    }
	    		
        // start session with user id
        session_start();
		$_SESSION['userid'] = $this->id;
		$_SESSION['username'] = $this->name;
	    
        // set session life time
		$lifeTime = 20 * 86400;
		setcookie(session_name(), session_id(), time() + $lifeTime, "/");
		setcookie("userid", $this->id, time() + $lifeTime, "/");
		setcookie("username", $this->name, time() + $lifeTime, "/");
	}
	    
  	function get($id)
	{
		$isget = false;
		$db = GLOBALDB();
				
		$sql = sprintf('SELECT * FROM account WHERE id = %d',$id);		
		if ($result = $db->query($sql)) {
	        if (mysql_num_rows($result)) {
	            $row = mysql_fetch_assoc($result);
	            $this->id = $id;
                $this->name = $row['name'];
                $this->fullname = $row['fullname'];
			    $this->passwd = $row['passwd'];
                $this->role = $row['role'];
			    $this->token = $row['token'];
			    $this->phone = $row['phone'];
			    $this->address = $row['address'];
			    $this->province = $row['province'];
			    $this->city = $row['city'];
			    $this->code = $row['code'];
			    $this->email = $row['email'];
			    $this->qq = $row['qq'];
			    $this->msn = $row['msn'];
			    $this->other = $row['other'];
			    $this->type = $row['type'];
			    $this->level = $row['level'];
			    $this->date = $row['date'];			    
			    $isget = true;
           }
           mysql_free_result($result);
        }		
        return $isget;
	}
	
    function fetch()
    {
       //$_GET["id"] = '39';
       if(isset($_GET["id"])){
            $id = $_GET['id'];
            if($this->get($id)) {
                echo '<div id="get" style="display:none">';
                echo '<li id="v1">'.$this->id.'</li>';
                echo '<li id="v2">'.$this->name.'</li>';
                echo '<li id="v3">'.$this->fullname.'</li>';
                echo '<li id="v4">'.$this->passwd.'</li>';
                echo '<li id="v5">'.$this->role.'</li>';
                echo '<li id="v6">'.$this->phone.'</li>';                
                echo '<li id="v7">'.$this->address.'</li>';
                echo '<li id="v8">'.$this->email.'</li>';
                echo '<li id="v9">'.$this->qq.'</li>';
                echo '</div>';
            }else{
                echo '<div id="get" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
        }
    }      
	
	function add()
	{
        // Insert sql statement
		$sql = sprintf(
			'INSERT INTO account (' .
			'  name, fullname, passwd, token,' .
			'  role, phone,' .
			'  address, province, city, code,' .
			'  email, qq, msn,' .
			'  other, type, level,' .
			'  date)' .
			'VALUES (' .	
		    '"%s","%s","%s","%s",'.
		    '"%s","%s",'.
		    '"%s","%s","%s","%s",'.
		    '"%s","%s","%s",'.
		    '"%s",%d, %d,'.
		    '"%s")',
		  $this->name, $this->fullname, $this->passwd, $this->token,
		  $this->role, $this->phone,
		  $this->address, $this->province, $this->city, $this->code,
		  $this->email, $this->qq, $this->msn, 
		  $this->other, $this->type, $this->level,
		  $this->date);
	  	/*
        $fp = fopen("log.txt", "w");
	    fwrite($fp, $sql);
	    fwrite($fp, mysql_error()); 
        fclose($fp);       
        */ 
		$db = GLOBALDB();		 
        $result = $db->query($sql);
        if ($result) {
        	$this->id = mysql_insert_id();
        }
        return $result;
	}
        
	function update()
	{
		$sql = sprintf(
		  'UPDATE account SET '.
          'name = "%s",'.
          'fullname = "%s",'.
		  'passwd = "%s",'.
          'role = "%s",'.
		  'token = "%s",'.
		  'phone = "%s",'.
		  'address = "%s",'.
		  'province = "%s",'.
		  'city = "%s",'.
		  'code = "%s",'.
		  'email = "%s",'.
		  'qq = "%s",'.
		  'msn = "%s",'.
		  'other = "%s",'.
		  'type = %s,'.
		  'level = %s,'.
		  'date = "%s"'.
          ' WHERE id=%s',
		  $this->name,
          $this->fullname,
		  $this->passwd,
          $this->role,
		  $this->token,
		  $this->phone,
		  $this->address,
		  $this->province,
		  $this->city,
		  $this->code,
		  $this->email,
		  $this->qq,
		  $this->msn,
		  $this->other,
		  $this->type,
		  $this->level,
		  $this->date,
          $this->id);
	  		
		$db = GLOBALDB();		
		$result = $db->query($sql);
		return $result; 
	}
	
	function delete($id)
	{
		$db = GLOBALDB();
		$sql = sprintf('DELETE account WHERE id = "%d"',$id);
		$result = $db->query($sql);
        return $result;
	}
        
    function test()
	{
	    $data = file_get_contents("account_post.dat");
        $post = json_decode($data, true);
        
	    if(!$this->save($post)) {
           return $this->error;
        }
                
        if(!$this->auth($post)) {
           return $this->error;
        }	
	}
		    
}// end of class
    
//$a = new Account();
//$a->test();
  
?>
