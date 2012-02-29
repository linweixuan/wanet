<?php
  require_once 'common.php';
  require_once 'functions.php';
  require_once 'db.php';
  require_once 'user.php';
  require_once 'paging.php';
  require_once 'layout.php';
  require_once 'search.php';  
    	
  class Publish 
  {
    // publish fields
	  public $id;
	  public $uid;
	  public $url;
	  public $brand;
	  public $series;
	  public $module;
	  public $title;
	  public $description;
	  public $company;
	  public $link;
	  public $address;
	  public $telephone;
	  public $mobile;
	  public $fax;
	  public $price;
	  public $picture;
	  public $level;
	  public $star;	  
	  public $date;
	  	  
    // inner members
	  public $cond;
	  public $pget;
	  public $total;
	  public $error;
	  
	function __construct()
    {
        // default values
        $this->id = 0;
        $this->brand = '';
        $this->series = '';
        $this->module = '';
        $this->title = '';
        $this->date = date('Y-m-d h:i:s');
        $this->cond = '';
        $this->pget = '';
        $this->url = '';
    }
    
  	function __destruct()
	{
 	
	}
		    
	function validate(array $post) {
		if ($post['title'] == null || !strlen($post['title'])) {
			$this->error = "标题不能为空!";			
	  		return false;
		}
		if ($post['contents'] == null || !strlen($post['contents'])) {
			$this->error = "内容不能空!";
	  		return false;
		}
		if ($post['telephone'] == null || !strlen($post['telephone'])) {
			$this->error = "联系电话不能空!";
	  		return false;
		}
		return true;
	}
	
	function parse($post)
	{		
	    // Trim all the incoming data
	    $trimmed = array_map('trim', $post);
	    		
	    // save publish post
        $this->brand = mysql_real_escape_string($trimmed['brand']);
		$this->series = mysql_real_escape_string($trimmed['series']);
		$this->module = mysql_real_escape_string($trimmed['module']);
		$this->title = mysql_real_escape_string($trimmed['title']);
		
		if (get_magic_quotes_gpc()) {
			$this->description = stripslashes($_POST['contents']);
		} else {
			$this->description = $_POST['contents'];
		}				
		$this->getImage($this->description);
		return true;
	}
		
	// get publish content by pid(publish id)
	function get($pid)
	{
		// Query databse for a publish
		$isget = false;
		$db = GLOBALDB();
        $sql = sprintf('SELECT * FROM publish WHERE id = %d', $pid);
        
        if ($result = $db->query($sql)) {
        	if (mysql_num_rows($result)) {  
	            $row = mysql_fetch_assoc($result);            
				$this->id = $row['id'];
				$this->uid = $row['uid'];	   
				$this->url = $row['url'];
        		$this->brand = $row['brand'];
				$this->series = $row['series'];
				$this->module = $row['module'];
				$this->title = $row['title'];
				$this->description = $row['description'];
				$this->company = $row['company'];
				$this->link = $row['link'];
				$this->address = $row['address'];
				$this->telephone = $row['telephone'];
				$this->mobile = $row['mobile'];
				$this->fax = $row['fax'];
				$this->price = $row['price'];
				$this->picture = $row['picture'];
				$this->level = $row['level'];
				$this->star = $row['star'];				
				$this->date = $row['date'];				
				$isget = true;
        	}
        	mysql_free_result($result);
        }        
        return $isget;
	}
		
	function add()
	{		
		// get user id by session
		$sid = $_SESSION['userid'];
		if (!isset($sid)) {
			$sid = 1; //admin
		}
		$this->getUser($sid);
		
        // truncate the content
    	$content = strip_tags($this->description);
    	$content = truncat($content, 100);
    	
    	$db = GLOBALDB();
    	$this->description = mysqli_real_escape_string ($db, $content);
    	
        // insert publish statement
		$sql = sprintf(
		  "INSERT INTO publish (".
		    "uid, brand, series, module, title, description,". 
		    "company, address, telephone, mobile, fax,". 
		    "price, picture, level, star, url, link, date)" .
		  "VALUES (".
			"%d,'%s','%s','%s','%s','%s',".
		  	"'%s','%s','%s','%s','%s',".
		  	"'%s','%s',%d, %d,'%s','%s','%s')",		
		  $this->uid,
		  $this->brand,
		  $this->series,
		  $this->module,
		  $this->title,
		  $this->description,
		  $this->company,
		  $this->address,
		  $this->telephone,
		  $this->mobile,
		  $this->fax,
		  $this->price,
		  $this->picture,
		  $this->level,
		  $this->star,
		  $this->url,
		  $this->link,
		  $this->date);        	  		

		// insert produce to database
        $result = $db->query($sql);
        if (!$result)
            return false;

        // save content to file
        $this->id = mysql_insert_id();
        $this->url = $this->gen_produce_page();
		$sql = sprintf("UPDATE publish SET url = '%s' where id = %d", 
			$this->url, $this->id);

		// update the prduce url
		$result = $db->query($sql);
        if (!$result)
            return false;
			
    	// update user produce links
		$user = new User();
    	if($user->get($sid)) {
    		$user->create_parts();
    	}
    	
		// reload page or send them to index  
		//$page = $this->url;
		$page = 'http://www.wanet.cn/parts.php';
		header('Location: '. $page);
        return true;
	}
	
	function update()
	{
		$sql = sprintf(
		  'UPDATE publish SET'. 
		  'brand = "%s",'.
		  'series = "%s",'.
		  'module = "%s",'.
		  'title = "%s",'.
		  'description = "%s",'.
		  'company = "%s",'.
		  'address = "%s",'.
		  'telephone = "%s",'.
		  'mobile = "%s",'.
		  'address = "%s",'.
		  'fax = "%s",'.
		  'price = "%s",'.
		  'picture = "%s",'.
		  'level = %d,'.
		  'star = %d,'.
		  'url = "%s",'.
		  'link = "%s",'.		  
		  'date = "%s",',
		  $this->brand,
		  $this->series,
		  $this->module,
		  $this->title,
		  $this->description,
		  $this->company,
		  $this->address,
		  $this->telephone,
		  $this->mobile,
		  $this->fax,
		  $this->price,
		  $this->picture,
		  $this->level,
		  $this->star,
		  $this->url,
		  $this->link,		  
		  $this->date);
		  
		$db = GLOBALDB();		
		$result = $db->query($sql);
		return $result; 		
	}
	
	function delete($pid)
	{
		// delete the publish record
		$db = GLOBALDB();
		$sql = sprintf('DELETE user publish where id = %d',$pid);
		$result = $db->query($sql);
		return $result; 
	}	
	 
	function getUser($uid)
	{
		// get user information 
		$user = new User();
		if ($user->get($uid)) {
		    $this->uid = $uid;
		    $this->company = $user->company;
		    $this->address = $user->address;
		    $this->telephone = $user->phone;
		    $this->mobile = $user->mobile;
		    $this->fax = $user->fax;
		    $this->link = $user->link;
		}
	}
	
	// user's publish function
	function getPublish($uid)
	{
		// Query databse for a publish
		$db = GLOBALDB();
        $sql = sprintf('SELECT * FROM publish WHERE uid = %d', $uid);
        
        if ($result = $db->query($sql)) {
        	if (mysql_num_rows($result)) {  
	            $row = mysql_fetch_assoc($result);            
				$this->id = $row['id'];
				$this->uid = $row['uid'];
        		$this->brand = $row['brand'];
				$this->series = $row['series'];
				$this->module = $row['module'];
				$this->title = $row['title'];
				$this->description = $row['description'];
				$this->company = $row['company'];
				$this->address = $row['address'];
				$this->telephone = $row['telephone'];
				$this->mobile = $row['mobile'];
				$this->fax = $row['fax'];
				$this->price = $row['price'];
				$this->picture = $row['picture'];
				$this->level = $row['level'];
				$this->star = $row['star'];
				$this->url = $row['url'];
				$this->link = $row['link'];
				$this->date = $row['date'];
        	}
        }
        
        mysql_free_result($result);
        return FALSE;	
	}

	// get picture form content
	function getImageRegex()
	{
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', 
			$this->description, $matches);
		$first_img = $matches [1] [0];
		
		//Defines a default image
		if(empty($first_img)){ 
			$first_img = "/images/default.jpg";
		}
		$this->picture = $first_img;
	}
	
  	// get picture form content
	function getImage($content)
	{
		$first_img = "/images/default.jpg";
		$html = str_get_html($content);
		foreach($html->find('img') as $element) {
			$first_img = $element->src;
       		break;		
		}
		$this->picture = $first_img;
	}	
	
    function getTotal($condition)
    {
       	// get publish count
       	$total = 0;
   	    $db = GLOBALDB();
   	    $sql = "SELECT count(*) AS total FROM publish WHERE ".$condition;
   	  
   	    $result = $db->query($sql);   	  
   	    if ($result = $db->query($sql)) {
   	    	if (mysql_num_rows($result)) {
   	    		$row = mysql_fetch_assoc($result);
   	  	   		$total = $row['total'];
   	    	}
   	  	   mysql_free_result($result);   	  	   
   	    }
   	    return $total;
    }
    	
	function key_query($str,&$url)
	{
		$sql = "";
		$str = trim($str);
		$token = explode(",",$str);
		//print_r($token);				
	    foreach ($token as $key) {
	    	$key = trim($key);
	    	if($key != "") {
	    		if($sql != "") {
		    		$sql = $sql." and ";
	    		}	    		
	    		$field = keytype($key);
	    		$sql = $sql.$field."='".$key."'";
	    		$url = $url.'&'.$field.'='.$key;
	    	}
	    }
	    return $sql;
	}
	
    function test()
    {
      $_GET["key"] = 'key=小松, 修理包';
   	  $value = $_GET["key"];
   	  $condtion = $this->key_query($value);
   	  $url = $value;
    }
    	
    function prepare()
    {
      // get query cataloy for advance       
      $url = '';
      $condtion='1';
      
   	  if(isset($_GET["brand"])){
   	  	$value = trim($_GET['brand']);
   	  	if($value != ""){
	   	  	$condtion = sprintf("brand='%s'",$value);
	   	  	$url = '&brand='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["module"])){
   	  	$value = trim($_GET['module']);
   	  	if($value != ""){
	   	  	$module = sprintf("series='%s'",$value);
	   	  	$condtion = $condtion.' and '.$module;
	   	  	$url = $url.'&module='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["part"])){
   	  	$value = trim($_GET['part']);
   	  	if($value != ""){   	  	
	   	  	$part = sprintf("module='%s'",$value);
	   	  	$condtion = $condtion.' and '.$part;
	   	  	$url = $url.'&part='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["key"])){
   	  	$value = trim($_GET["key"]);
   	  	if($value != ""){
	   	  	$condtion = $this->key_query($value,$url);
	   	  	//echo "++++++++++".$condtion;
	   	  	//$url = $url.'&part='.$value;   	  	
   	  	}
   	  }
   	  $this->cond = $condtion;
   	  $this->pget = $url;
   	  $this->total = $this->getTotal($condtion);
   	  //echo "++++++++++".$condtion;
    }    
    
    function paging($condtion='1')
    {
      // get query cataloy for advance 
      /*
      $url = '';
   	  if(isset($_GET["brand"])){
   	  	$value = trim($_GET['brand']);
   	  	if($value != ""){
	   	  	$condtion = sprintf("brand='%s'",$value);
	   	  	$url = '&brand='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["module"])){
   	  	$value = trim($_GET['module']);
   	  	if($value != ""){
	   	  	$module = sprintf("series='%s'",$value);
	   	  	$condtion = $condtion.' and '.$module;
	   	  	$url = $url.'&module='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["part"])){
   	  	$value = trim($_GET['part']);
   	  	if($value != ""){   	  	
	   	  	$part = sprintf("module='%s'",$value);
	   	  	$condtion = $condtion.' and '.$part;
	   	  	$url = $url.'&part='.$value;
   	  	}
   	  }
   	  
   	  if(isset($_GET["key"])){
   	  	$value = trim($_GET["key"]);
   	  	if($value != ""){
	   	  	$condtion = $this->key_query($value,$url);
	   	  	echo "++++++++++".$condtion;
	   	  	//$url = $url.'&part='.$value;   	  	
   	  	}
   	  }
   	  */
      // get current page index
      $page = 1;
   	  if(isset($_GET["page"])){
   	  	$page = $_GET['page'];
   	  }
   	  
   	  // set paging parameters
      $number = 6;      
      $total = $this->total;
      $url = $this->pget;
      $condtion = $this->cond;
      //$total = $this->getTotal($condtion);
            
      $url = '?page={page}'.$url;      
      $pager = new Paging($total,$number,$page,$url);
   	  
   	  // get publish records
	  $db = GLOBALDB();
      $sql = "SELECT * FROM publish WHERE ".$condtion." order by id desc LIMIT ".$pager->limit.",".$pager->size;
      $result = $db->query($sql);        
      $this->display($result);
      
      // show paging bar
      //echo $sql;
	  $pager->show();
    }
    
    function show_total()
    {
       	// get publish count
       	/*
   	    $db = GLOBALDB();
   	    $sql = "SELECT count(*) AS total FROM publish";
   	  
   	    $result = $db->query($sql);   	  
   	    if ($result = $db->query($sql)) {
   	    	if (mysql_num_rows($result)) {
   	    		$row = mysql_fetch_assoc($result);
   	  	   		$this->total = $row['total'];
   	    	}
   	  	   mysql_free_result($result);   	  	   
   	    }*/
    	echo '           <div class="total"> 总共 <strong>'.$this->total.'</strong> 配件<span>-全部</span></div>';
    	echo "\n";
    }
    
    function show_poto($rows)
    {
    	if ($rows % 2)
    	  $alter_color = "";
    	else
    	  $alter_color = "prolistE"; 
    	
    	$str = sprintf(
    	    "          <div class=\"prolist %s\">\n".
		    "            <div class=\"PhotoL\">\n".
		    "              <div class=\"Photo100\"><img src=\"%s\" alt=\"#\" border=\"0\" /></div>\n".
		    "              <div class=\"useIcons\"><img class=\"images/enlarge-icon\" src=\"images/enlarge.gif\" alt=\"enlarge\" title=\"enlarge\" /></div>\n".
		    "            </div>\n",
    		$alter_color,
	    	$this->picture
	    );
	    echo $str;
    } 
    
    function show_act()
    {
    	$inquiry = "http://www.wanet.cn/inquiry.html";
    	$str = sprintf(
            "            <div class=\"act\">\n".
            "              <img src=\"images/spacer.gif\" alt=\"询价\" name=\"imflag1_0\" id=\"imflag1_0\" style=\"display: none;\" />\n". 
            "              <a href=\"%s\" target=\"_top\" rel=\"nofollow\">\n".
            "              <img src=\"images/inquiry.png\" alt=\"Click here to send inquiry\" /></a>\n".
            "              <p class=\"price\"><span>￥%s</span></p>\n".
            "            </div>\n",
    	   $inquiry,
    	   $this->price
    	);
    	echo $str;
    }
  
    function show_compnay()
    {
    	
    	$str = sprintf(
            "            <div class=\"act\">\n".
            "              <img src=\"images/spacer.gif\" alt=\"询价\" name=\"imflag1_0\" id=\"imflag1_0\" style=\"display: none;\" />\n". 
            "              <a href=\"%s\" target=\"_top\" rel=\"nofollow\">\n".
            "              <img src=\"images/inquiry.png\" alt=\"Click here to send inquiry\" /></a>\n".
            "              <p class=\"price\"><span>￥%s</span></p>\n".
            "            </div>\n",
    	   $inquiry,
    	   $this->price
    	);
    	echo $str;
    }
        
    function show_content()
    {
    	$desc = strip_tags($this->description);
    	$desc = truncat($desc, 100);
    	
    	$str = sprintf( 
            "            <div class=\"cnt\">\n".
            "              <p class=\"product\"><strong><a href=\"%s\" target=\"_blank\">%s</a></strong><span class=\"gray\">[%s]</span><span class=\"gray\">[%s]</span></p>\n".
            "              <p class=\"desc\">%s</p>\n".
            "              <p class=\"com\"><a target=\"_blank\" href=\"http://www.wanet.cn/%s\">%s</a><span class=\"cgray\">[广东, 广州]</span> </p>\n".
            "              <div class=\"viewIcons\"> <img src=\"images/gold_featured.png\" alt=\"注册成员\" border=\"0\" /> <a href=\"http://www.wanet.cn/audited-suppliers/\" target=\"blank\"> <img src=\"images/as_audited_member_s.png\" alt=\"信赖提供商\" border=\"0\" /></a></div>\n".
            "            </div>\n".
    	    "          </div>\n",
    	   $this->url,
    	   $this->title,
    	   $this->date,	
    	   $this->module,
    	   $desc,
    	   $this->link,
    	   $this->company    	   
    	);
    	echo $str;
    }          
              
    function show_end()
    {
    	echo '          </div><div class="clean"></div>';
    }
    
    function display($result)
    {
      	$rows = mysql_num_rows($result);
        while($rows) {
            $row = mysql_fetch_assoc($result);
			$this->id = $row['id'];
			$this->uid = $row['uid'];
        	$this->brand = $row['brand'];
			$this->series = $row['series'];
			$this->module = $row['module'];
			$this->title = $row['title'];
			$this->description = $row['description'];
			$this->company = $row['company'];
			$this->address = $row['address'];
			$this->telephone = $row['telephone'];
			$this->mobile = $row['mobile'];
			$this->fax = $row['fax'];
			$this->price = $row['price'];
			$this->picture = $row['picture'];
			$this->level = $row['level'];
			$this->star = $row['star'];
			$this->url = $row['url'];
			$this->date = $row['date'];
			$this->link = $row['link'];
			
    		$this->show_poto($rows);
    		$this->show_act();
    		$this->show_content();
    		$rows--;
       	}
       	$this->show_end();
    }
    
    function search($keyword)
    {
    	$condition = "title like \"".$keyword."\"";
		$this->paging($condition);
    }
 
    // save publish to file
    function save()
    {
      // read the template
	  $str = dirname(__FILE__);  
      $content = file_get_contents(dirname(__FILE__).'/partinfo.php'); 
      if (!$content){
        return "fail read template";
      }    	
      
	  $tags = array("#TITLE#", 
	  	"#BRAND#", 
	  	"#MODULE#", 
	  	"#ENGINE#", 
        "#TYPE#", 
        "#NAME#", 
        "ADDRESS", 
        "#DATE#", 
        "#PRICE#", 
        "DESCRIPTION");
	      
      $fields[0] = $this->title;
      $fields[1] = $this->brand;
      $fields[2] = $this->series;
      $fields[3] = $this->module;
      $fields[4] = "配件";
      $fields[5] = $this->module;
      $fields[6] = "广州";
      $fields[7] = $this->date;
      $fields[8] = $this->price;
      $fields[9] = $this->description;
      
      $content = str_replace($tags,$fields,$content);      
      
      $date = date("Ymd-Hms");
      $filename = sprintf("publish/%d-%d-%s.php", $this->id, $this->uid, $date);
      $fp = fopen($filename, "w");
      if (!$fp)  {
          return "fail create file";
      }
      
      if (fwrite($fp, $content) == FALSE) {      	  
          fclose($fp);
          return "fail wirte content";
      }
      
      fclose($fp);
      return $filename;
    }
    
    function fill_produce_tags(&$patterns,&$replaces)
    {
      $i = count($patterns);       
      $patterns[$i++] = "/{title}/";
      $patterns[$i++] = "/{brand}/";
      $patterns[$i++] = "/{series}/";
      $patterns[$i++] = "/{module}/";
      $patterns[$i++] = "/{catalog}/";
      $patterns[$i++] = "/{part}/";
      $patterns[$i++] = "/{location}/";
      $patterns[$i++] = "/{date}/";
      $patterns[$i++] = "/{website}/";
      $patterns[$i++] = "/{price}/";
      $patterns[$i++] = "/{content}/";

      $i = count($replaces);
      $replaces[$i++] = $this->title;
      $replaces[$i++] = $this->brand;
      $replaces[$i++] = $this->series;
      $replaces[$i++] = $this->module;
      $replaces[$i++] = "配件";
      $replaces[$i++] = $this->module;
      $replaces[$i++] = "广州";
      $replaces[$i++] = $this->date;
      $replaces[$i++] = "www.wanet.cn";
      $replaces[$i++] = $this->price;
      $replaces[$i++] = $_POST['contents'];
    }
        
    function gen_produce_page()
    {
    	// read the template
    	$path = dirname(__DIR__);
    	$content = file_get_contents($path.'/company/template/product.html');
    	if (!$content){
    		$this->error = "fail to read template";
    		return false;
    	}
    	 
    	// get user id by session
    	$user = new User();
    	if(!$user->get($this->uid)) {
    		return false;
    	}

    	// fill the template tags
    	$patterns = array();
    	$replaces = array();
    	    	
    	$user->fill_common_tags($patterns, $replaces);
    	$user->fill_introduce_tags($patterns, $replaces);
    	$user->fill_parts_tags($patterns, $replaces);
    	$this->fill_produce_tags($patterns, $replaces);
    	$html = preg_replace($patterns, $replaces, $content);
    	
    	mkdir($path.'/company/'.$user->account);
    	$filename = sprintf("/company/%s/product%d.html", $user->account,$this->id);
		$filepath = $path.$filename;
		
    	$fp = fopen($filepath, "w");
    	if (!$fp)  {
    		return "fail create file";
    	}
    	 
    	if (fwrite($fp, $html) == FALSE) {
    		fclose($fp);
    		return "fail wirte content";
    	}
    	fclose($fp);
    	return $filename;
    }    
    

    
  } // end of class  
  
  //
  // global publish functions 
  //
  function publish($post)
  {
   	  // show the form if this is the first time the page is viewed
 	  $form = ob_get_clean(); 
  	  if (!isset($post['submitted'])) {
		$GLOBALS['TEMPLATE']['content'] = $form;
		echo $GLOBALS['TEMPLATE']['content'];
	  }		
      // otherwise process incoming data
	  else
	  {
		$publish = new Publish();
		if ($publish->parse($post)) {
			$publish->add();
		}
      }
  }
  
  function publishs_display()
  {
	  $publish = new Publish();
	  $publish->display();
  }
  
  // pass the key query to partlist.php
  function publishs_url()
  {
  	$query = '';
  	$page = 'partlist.php';
    if(isset($_GET["key"])){
   	  	$value = trim($_GET["key"]);
   	  	if($value != ""){
	   	  $query = '?key='.$value ; 	   	  	
   	  	}
  	}
	$url = $page.$query;
	echo $url;
  }
  // end of php script
 
  /*
  $pub = new Publish();  
  $pub->get(54);
  $pub->gen_produce_page();
  */
?>
