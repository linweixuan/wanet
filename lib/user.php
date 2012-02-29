<?php
  require_once 'db.php';
  
  // code define
  define("EU_ACCOUNT",	10000);
  define("EU_PASSWD",	10001);
  define("EU_CONFIRM",	10002);
  define("EU_TOKEN",	10003);
  define("EU_NAME",		10004);
  define("EU_PHONE",	10005);
  define("EU_MODILE",	10006);
  define("EU_EMAIL",	10007);
  define("EU_SQL",		10008);
  define("EU_EXISTED",	10009);
  define("EU_ADDRESS",	10010); 
  
  // user class
  class User 
  {      
	  public $id;
	  public $account;
	  public $passwd;
	  public $token;
	  public $name;
	  public $company;
	  public $phone;
	  public $mobile;
	  public $fax;
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
	  public $link;
	  public $web;
	  public $business;
	  public $confirm;
	  
	  // error code
	  public $error;
      
	function __construct()
    {
        // default values
        $this->id = 0;
        $this->account = '';
        $this->passwd = '';
        $this->name = '';
        $this->level = 0;
        $this->date = date('Y-m-d');
        $this->business = '';
        $this->error = 0;        
    }
    
  	function __destruct()
	{
 	
	}
	    
	function parse(array $post)
	{   
        /*
        $output = print_r ($post, true);
        $fp = fopen("dump.txt", "w");
	    fwrite($fp, $output);
	    fwrite($fp, mysql_error()); 
        fclose($fp);    
         */      
	    // Trim all the incoming data
	    $trimmed = array_map('trim', $post);
	    if (!$this->valid_null($post))
	    	return false;
	    
	    // Check for user account name
	    if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['account'])) {
	        $this->account = mysql_real_escape_string($trimmed['account']);
	    } else {
	    	$this->error = EU_ACCOUNT;
	        return false;
	    }
	    	    
        // Check user account exist
        if ($this->valid_account ($this->account))  {
        	$this->error = EU_EXISTED;
        }
           
	    // Check for a password and match against the confirmed password:
	    if (preg_match ('/^\w{4,20}$/', $trimmed['passwd']) ) {
	        if (strcmp($trimmed['passwd'],$trimmed['confirm']) == 0) {
	            $this->passwd = mysql_real_escape_string($trimmed['passwd']);
	        } else {
	        	$this->error = EU_CONFIRM;
	            return false;
	        }
	    } else {
	    	$this->error = EU_PASSWD;
	        return false;
	    }

	    // Check dynamic token
	    if ($this->valid_token($trimmed['token'])) {
	        $this->token = mysql_real_escape_string($trimmed['token']);
	    } else {
	    	$this->error = EU_TOKEN;
	        return false;
	    }
	    
	    // Check for an email address:
	    if ($this->valid_email($trimmed['email'])) {
	        $this->email = mysql_real_escape_string($trimmed['email']);
	    } else {
	    	$this->error = EU_EMAIL;
	        return false;
	    }
	    	
	    // Save contact information
	    $this->name = mysqli_real_escape_string ($db, $trimmed['name']);
	    $this->phone = mysqli_real_escape_string ($db, $trimmed['phone']);
	    $this->mobile = mysqli_real_escape_string ($db, $trimmed['mobile']);
	    $this->fax = mysqli_real_escape_string ($db, $trimmed['fax']);
		$this->address = mysqli_real_escape_string ($db, $trimmed['address']);
		$this->code = mysqli_real_escape_string ($db, $trimmed['postcode']);
		$this->province = mysqli_real_escape_string ($db, $trimmed['province']);
	  	$this->qq = mysqli_real_escape_string ($db, $trimmed['qq']);
	  	$this->msn = mysqli_real_escape_string ($db, $trimmed['msn']);
	  	$this->company = mysqli_real_escape_string ($db, $trimmed['company']);
	  	$this->business = mysqli_real_escape_string ($db, $trimmed['business']);
	  	
	  	return true;
	}

	function register()
	{  
        // insert the user to db
        $result = $this->add(); 
        if ($result) {
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
			$_SESSION['username'] = $this->account;
			
	        // set session life time
			$lifeTime = 20 * 86400;
			setcookie(session_name(), session_id(), time() + $lifeTime, "/");
			setcookie("userid", $this->id, time() + $lifeTime, "/");
			setcookie("username", $this->account, time() + $lifeTime, "/");
        }
        return $result;
	}	 
	
	function login()
	{
		// user already logged in?
		if(!empty($_SESSION['username'])){
			return true;
		}
		
		// check username and passwd
		if(!$this->valid_auth($_POST)) {
			$page = '../login.php?user='.$this->account.'&status=1';
			header('Location: '. $page);
			return false;
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
		$_SESSION['username'] = $this->account;
	    
        // set session life time
		$lifeTime = 20 * 86400;
		setcookie(session_name(), session_id(), time() + $lifeTime, "/");
		setcookie("userid", $this->id, time() + $lifeTime, "/");
		setcookie("username", $this->account, time() + $lifeTime, "/");
					
		// reload page or send them to index  
		$page = basename($_SERVER['PHP_SELF']);
		if($page == 'login.php')
			$page = 'index.php';  
		header('Location: '. $page);
		return true;
	}
	
	function valid_null(array $post) {
		if ($post['account'] == null || !strlen($post['account'])) {
			$this->error = EU_ACCOUNT;
	  		return false;
		}
		if ($post['name'] == null || !strlen($post['name'])) {
			$this->error = EU_NAME;
	  		return false;
		}
		if ($post['passwd'] == null || !strlen($post['passwd'])) {
			$this->error = EU_PASSWD;
	  		return false;
		}
		if ($post['token'] == null || !strlen($post['token'])) {
			$this->error = EU_TOKEN;
	  		return false;
		}
		if ($post['address'] == null || !strlen($post['address'])) {
			$this->error = EU_ADDRESS;
	  		return false;
		}
		if ($post['mobile'] == null || !strlen($post['mobile'])) {
			$this->error = EU_MODILE;
	  		return false;
		}
		return true;
	}
	
	function valid_account()
	{        
        // default no exist
        $exist = FALSE;
        $db = GLOBALDB();
        
		// Query databse for account
        $sql = sprintf(
            'SELECT id, account' .
            'FROM user WHERE account = "%s"',
        	$this->account);

        // Determine number of rows        
        if ($result = $db->query($sql)) {            
            if (mysql_num_rows($result))
                $exist = TRUE;
            // close result set
            mysql_free_result($result);
        }        
		                
        return $exist;
	}

  	function valid_auth(array $post)
	{
		$isauth = false;
	    $db = GLOBALDB();
		
	    // Trim all the incoming data
	    $trimmed = array_map('trim', $post);
		
		// Get user account and passwd
		$this->account = $trimmed['account'];
		$this->passwd = $trimmed['passwd'];

		// Query databse for account		
        $sql = sprintf('SELECT id, account, passwd ' .
            'FROM user WHERE account = "%s" and passwd = "%s"',
        	$this->account,$this->passwd);
                
        if ($result = $db->query($sql)) {
        	if (mysql_num_rows($result)) {
        		$row = mysql_fetch_assoc($result);      
	            $this->id = $row['id'];
	            $isauth = true;
        	}
        }
        
        mysql_free_result($result);
        return $isauth;
	}
		
  	function valid_token($token) {
	  return true;
	}
		
	/** Checks is the provided email address is formally valid
	 *  @param string $email email address to be checked
	 *  @return true if the email is valid, false otherwise
	 */
	function valid_email($email) {
	  if (strlen($email)) {
		  $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
		  if ( !preg_match($regexp, $email) ) {
		       $_obweb->addErr("Email address is not correct\n");
		       return false;
		  }
	  }
	  return true;
	}	    	
	
  	function get($uid)
	{
		$isget = false;
		$db = GLOBALDB();
				
		$sql = sprintf('SELECT * FROM user WHERE id = %d',$uid);		
		if ($result = $db->query($sql)) {
	        if (mysql_num_rows($result)) {
	            $row = mysql_fetch_assoc($result);
	            $this->id = $uid;
			    $this->account = $row['account'];     
			    $this->passwd = $row['passwd'];
			    $this->token = $row['token'];
			    $this->name = $row['name'];
			    $this->company = $row['company'];
			    $this->phone = $row['phone'];
			    $this->mobile = $row['mobile'];
			    $this->fax = $row['fax'];
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
			    $this->link = $row['link'];
			    $this->web = $row['web'];
			    $this->business = $row['bussiness'];
			    
			    $isget = true;
           }
           mysql_free_result($result);
        }		
        return $isget;
	}
		
	function geti($uid)
	{
		$isget = false;
		$db = GLOBALDB();
				
		$sql = sprintf('SELECT * FROM user WHERE id = %d',$uid);		
		if ($result = mysql_query($sql)) {
	        if (mysql_num_rows($result)) {
	            $row = mysql_fetch_array($result);
	            $this->id = $uid;
			    $this->account = $row['account'];     
			    $this->passwd = $row['passwd'];
			    $this->token = $row['token'];
			    $this->name = $row['name'];
			    $this->company = $row['company'];
			    $this->phone = $row['phone'];
			    $this->mobile = $row['mobile'];
			    $this->fax = $row['fax'];
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
			    $this->link = $row['link'];
			    $this->web = $row['web'];
			    $this->business = $row['business'];			    
			    $isget = true;
           }
           mysql_free_result($result);
        }		
        return $isget;
	}
	
	function add()
	{
		// save user to html
		if (!$this->create_home())
			return false;
		
        // Insert sql statement
		$sql = sprintf(
			'INSERT INTO user (' .
			'  account, passwd, token, name,' .
			'  company, phone, mobile, fax,' .
			'  address, province, city, code,' .
			'  email, qq, msn,' .
			'  other, type, level,' .
			'  date, link, web, bussiness)' .
			'VALUES (' .	
		    '"%s","%s","%s","%s",'.
		    '"%s","%s","%s","%s",'.
		    '"%s","%s","%s","%s",'.
		    '"%s","%s","%s",'.
		    '"%s",%d, %d,'.
		    '"%s","%s","%s","%s")',
		  $this->account, $this->passwd, $this->token, $this->name,
		  $this->company, $this->phone, $this->mobile,$this->fax,
		  $this->address, $this->province, $this->city, $this->code,
		  $this->email, $this->qq, $this->msn, 
		  $this->other, $this->type, $this->level,
		  $this->date,
		  $this->link,
		  $this->web,
		  $this->business);
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
		  'UPDATE user SET account = "%s",'.
		  'passwd = "%s",'.
		  'token = "%s",'.
		  'name = "%s",'.
		  'company = "%s",'.
		  'phone = "%s",'.
		  'mobile = "%s",'.
		  'fax = "%s",'.
		  'address = "%s",'.
		  'province = "%s",'.
		  'city = "%s",'.
		  'code = "%s",'.
		  'email = "%s",'.
		  'qq = "%s",'.
		  'msn = "%s",'.
		  'other = "%s",'.
		  'type = "%s",'.
		  'level = "%s",'.
		  'date = "%s"',
		  $this->account,
		  $this->passwd,
		  $this->token,
		  $this->name,
		  $this->company,
		  $this->phone,
		  $this->mobile,
		  $this->fax,
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
		  $this->date);
	  		
		$db = GLOBALDB();		
		$result = $db->query($sql);
		return $result; 
	}
	
	function delete($uid)
	{
		$db = GLOBALDB();
		$sql = sprintf('DELETE user WHERE id = "%d"',$uid);
		$result = $db->query($sql);
	}	

    // save publish to file
    function save()
    {
      // read the template
	  $str = dirname(__FILE__);
      $content = file_get_contents(dirname(__FILE__).'/company.php'); 
      if (!$content){
      	$this->error = "fail to read template"; 
        return false;
      }    	
      
	  $tags = array(
	    "#TITLE#", 
	  	"#COMPANY#", 
	  	"#CONTACT#", 
	  	"#TELEPHONE#", 
        "#MOBILE#", 
        "#FAX#", 
        "#ADDRESS#", 
        "#QQ#", 
	    "#WEB#",
		"#DATE#",	  
        "#BUSINESS#");
	      
      $fields[0] = $this->company;
      $fields[1] = $this->company;
      $fields[2] = $this->name;
      $fields[3] = $this->phone;
      $fields[4] = $this->mobile;
      $fields[5] = $this->fax;
      $fields[6] = $this->address;
      $fields[7] = $this->qq;
      $fields[8] = $this->web;
      $fields[9] = $this->date;
      $fields[10] = $this->business;
      	        
      $content = str_replace($tags,$fields,$content);      
      $filename = sprintf("../company/%d-%s.php", $this->id, $this->account);
  	  $this->link = $filename;
		      
      $fp = fopen($filename, "w");
      if (!$fp)  {
      	  $this->error = "fail to create file"; 
          return false;
      }
      
      if (fwrite($fp, $content) == FALSE) { 
      	  $this->error = "fail to wirte content";
          fclose($fp);
          return false;
      }
      
      fclose($fp);
      return true;
    }
    
    function fill_common_tags(&$patterns,&$replaces)
    {
    	$patterns[0] = "/{company_title}/";
    	$patterns[1] = "/{company_short}/";
    	$patterns[2] = "/{dir}/";
    	$patterns[3] = "/{date}/";
    	$patterns[4] = "/{phone}/";
    	$patterns[5] = "/{fax}/";
    	$patterns[6] = "/{mobile}/";
    	$patterns[7] = "/{address}/";
    	$patterns[8] = "/{introduce}/";
    	$patterns[9] = "/{contact}/";
	    $patterns[10] = "/{qq}/";
	    
    	$replaces[0] = $this->company;
    	$replaces[1] = "";
    	$replaces[2] = $this->account;
    	$replaces[3] = $this->date;
    	$replaces[4] = $this->phone;
    	$replaces[5] = $this->fax;
    	$replaces[6] = $this->mobile;
    	$replaces[7] = $this->address;    	
    	$replaces[8] = $this->business;
    	$replaces[9] = $this->name;
    	$replaces[10] = $this->qq;
    }
    
    function fill_introduce_tags(&$patterns,&$replaces)
    {
    	$i = count($patterns); 
    	$patterns[$i] = "/{introduce}/"; 
    	$replaces[$i] = $this->business;
    }

    function fill_parts_tags(&$patterns,&$replaces)
    {
    	$i = count($patterns); 
    	$patterns[$i++] = "/{catalog}/";
    	$patterns[$i++] = "/{parts}/";     	
    	
    	$i = count($replaces);
    	$replaces[$i++] = $this->get_catalog();
    	$replaces[$i++] = $this->get_parts();
    }
    
    function xcopy($src,$dest)
    {
    	foreach  (scandir($src) as $file) {
    		if (!is_readable($src.'/'.$file)) 
    			continue;
    		if (is_dir($file) && ($file!='.') && ($file!='..') ) {
    			mkdir($dest . '/' . $file);
    			xcopy($src.'/'.$file, $dest.'/'.$file);
    		} else {
    			copy($src.'/'.$file, $dest.'/'.$file);
    		}
    	}
    }

    function gen_home_dir()
    {
    	// read the template
    	$path = dirname(__DIR__);
    	
    	$src = $path.'/company/template'; 
    	$dest = $path.'/company/'.$this->account;
    	
    	mkdir($dest);
    	$this->xcopy($src, $dest);
    }

    function fill_template($tpl,$patterns,$replaces)
    {
    	// read the template
    	$path = dirname(__DIR__);
    	$content = file_get_contents($path.'/company/template/'.$tpl);
    	if (!$content){
    		$this->error = "fail to read template";
    		return false;
    	}
    	
    	$html = preg_replace($patterns, $replaces, $content);
    	$filename = sprintf($path."/company/%s/".$tpl, $this->account);

    	$fp = fopen($filename, "w");
    	if (!$fp)  {
    		$this->error = "fail to create file";
    		return false;
    	}
    	 
    	if (fwrite($fp, $html) == FALSE) {
    		$this->error = "fail to wirte content";
    		fclose($fp);
    		return false;
    	}
    	 
    	fclose($fp);
    	return true;
    }
        
    function create_home()
    {
    	$patterns = array();
    	$replaces = array();
    	$this->fill_common_tags($patterns,$replaces);
    	$this->fill_introduce_tags($patterns,$replaces);
    	$this->fill_parts_tags($patterns,$replaces);

    	$this->gen_home_dir();
    	$this->fill_template('index.html',$patterns,$replaces);
    	$this->fill_template('introduce.html',$patterns,$replaces);
    	$this->fill_template('sell.html',$patterns,$replaces);
    	$this->fill_template('buy.html',$patterns,$replaces);
    	$this->fill_template('news.html',$patterns,$replaces);
    	$this->fill_template('credit.html',$patterns,$replaces);
    	$this->fill_template('contact.html',$patterns,$replaces);
    	$this->fill_template('catalog.html',$patterns,$replaces);
    	
    	$home = '../company/'.$this->account.'/index.html';
    	$this->link = $home;
    	return true;
    }
        
    function create_parts()
    {
    	$patterns = array();
    	$replaces = array();
    	$this->fill_common_tags($patterns,$replaces);
    	$this->fill_introduce_tags($patterns,$replaces);
    	$this->fill_parts_tags($patterns,$replaces);
    	
    	$this->fill_template('index.html',$patterns,$replaces);
    	$this->fill_template('sell.html',$patterns,$replaces);
    }
    
    // save all to html file
    function saveall()
    {
    	$db = GLOBALDB();				
		$sql = sprintf('SELECT * FROM user');		
		if ($result = $db->query($sql)) {
			$rows = mysql_num_rows($result);
        	while($rows) {			
	            $row = mysql_fetch_assoc($result);
	            $this->id = $uid;
			    $this->account = $row['account'];
			    $this->passwd = $row['passwd'];
			    $this->token = $row['token'];
			    $this->name = $row['name'];
			    $this->company = $row['company'];
			    $this->phone = $row['phone'];
			    $this->mobile = $row['mobile'];
			    $this->fax = $row['fax'];
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
 			    $this->link = $row['link'];
				$this->web = $row['web'];
				$this->business = $row['business'];
				
				// save to html file				
				$this->save();
        		$rows--;
       		}
            mysql_free_result($result);
        } 	
    }
    
    function get_catalog()
    {
		// Query databse for a publish
		$html = '';    	
		$db = GLOBALDB();
        $sql = 'select distinct module from publish where uid = '.$this->id;
        
        if ($result = $db->query($sql)) {
			$rows = mysql_num_rows($result);
        	while($rows) {
        		$row = mysql_fetch_assoc($result);
				$catalog = $this->catalog_html($row['module']);
				$html = $html.$catalog;
				$rows--;
        	}
        	mysql_free_result($result);
        }        
        if (!strlen($html))
       		$html = '挖机配件';
        return $html;
    }
    
    function catalog_html($catalog)
    {
  		return '<li>'.$catalog.'</li>';
    }

    function get_parts()
    {
    	// user part display template
    	$path = dirname(__DIR__);
    	$content = file_get_contents($path.'\company\template\sell-show.tpl');
    	
		// Query databse for a publish
		$html = '';
		$db = GLOBALDB();
        $sql = 'select title, picture, url, date from publish where uid = '.$this->id;

        if ($result = $db->query($sql)) {
			$rows = mysql_num_rows($result);
        	while($rows) {			
        		$row = mysql_fetch_assoc($result);
				$part = $this->part_html(
					$row['title'],
					$row['picture'],
					$row['url'],
					$row['date'],
					$content);
				$html = $html.$part;
				$rows--; 
        	}
        	mysql_free_result($result);
        }        
        return $html;    	
    }
    
    function part_html($title, $picture, $url, $date, $content)
    {
    	$patterns = array();
    	$replaces = array();

    	$patterns[0] = "/{dir}/";
    	$patterns[1] = "/{partpage}/";
    	$patterns[2] = "/{partimg}/";
    	$patterns[3] = "/{parttitle}/";
    	$patterns[4] = "/{publishdate}/";
    	
    	if (strstr($picture,"http"))
    		$img = $picture;
    	else 
    		$img = 'http://www.wanet.cn'.$picture;
    		
    	$replaces[0] = $this->account;
    	$replaces[1] = $url;
    	$replaces[3] = $img;
    	$replaces[2] = $title;
    	$replaces[4] = $date;
    	
    	$html = preg_replace($patterns, $replaces, $content);
    	return $html;
    }
    
    // show the last new users
    function show_last_company()
    {
    	$html = '';
        $db = $GLOBALS['DB'];
        $sql = sprintf('SELECT company, link FROM user order by id desc LIMIT 0,10');
        if ($result = $db->query($sql)) {
        	$rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->id = $uid;
                $this->company = $row['company'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$this->link;
                $li = '<li class="last"><a href="'.$url.'">'.$this->company.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }

    function show_favor_company()
    {
        $html = '';
        $db = $GLOBALS['DB'];
        $sql = sprintf('SELECT company, link FROM user order by level desc LIMIT 0,10');
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->id = $uid;
                $this->company = $row['company'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$this->link;
                $li = '<li class="favor"><a href="'.$url.'">'.$this->company.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
    
    function show_host_man()
    {
        $html = '';
        $db = $GLOBALS['DB'];
        $sql = sprintf('SELECT company, link FROM user order by host desc LIMIT 0,10');
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->id = $uid;
                $this->company = $row['name'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$this->link;
                $li = '<li class="favor"><a href="'.$url.'">'.$this->company.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
        
    function test()
	{
		$isget = false;
		$db = GLOBALDB();
				
		$sql = sprintf('SELECT * FROM user');
		if ($result = $db->query($sql)) {
	        if (mysql_num_rows($result)) {
	            $row = mysql_fetch_assoc($result);
			    echo $row['account'];
			    echo "\n";     
			    echo "ok select user successfully\n";
           }
           mysql_free_result($result);
        }		
	}
	    
  }// end of class
  
  
  //$u = new User();
  //$u->test(38);
  
?>
