<?php
  require_once 'common.php';
  require_once 'functions.php';
  require_once 'db.php';
  require_once 'user.php';
  require_once 'paging.php';
  require_once 'layout.php';  
   
  class Article
  {
    // article fields
    public $id;
    public $uid;
    public $author;
    public $brand;
    public $series;
    public $module;
    public $catalog;
    public $title;
    public $content;
    public $image;
    public $level;
    public $url;
    public $link;
    public $date;
    public $refer;
    public $comment;
    public $from;
	  
    // inner members
    public $total;
    public $error;

	function __construct()
    {
        // default values
        $this->id = 0;
        $this->uid = 0;
        $this->author = '';
        $this->brand = '';
        $this->series = '';
        $this->module = '';
        $this->catalog = '';
        $this->title = '';
        $this->date = date('Y-m-d h:i:s');
        $this->refer = mt_rand(1,10);
        $this->comment = 0;
        $this->from = '转载'; 
    }

  	function __destruct()
	{
	}
		    
	function parse($post)
	{
	    // Trim all the incoming data
	    $trimmed = array_map('trim', $post);

	    // save publish post
        $this->brand = mysql_real_escape_string($trimmed['brand']);
		$this->series = mysql_real_escape_string($trimmed['series']);
		$this->module = mysql_real_escape_string($trimmed['module']);
		$this->catalog = mysql_real_escape_string($trimmed['catalog']);
		$this->title = mysql_real_escape_string($trimmed['title']);
					
		if (get_magic_quotes_gpc()) {
			$this->content = stripslashes($_POST['contents']);
		} else {
			$this->content = $_POST['contents'];
		}
		$this->getImage($this->content);
		return true;
	}

	function validate(array $post) 
	{
		if ($post['title'] == null || !strlen($post['title'])) {
			$this->error = "标题不能为空!";					
	  		return false;
		}
		if ($post['contents'] == null || !strlen($post['contents'])) {
            $this->error = "内容不能空!";
	  		return false;
		}
		if ($post['catalog'] == null || !strlen($post['catalog'])) {
            $this->error = "分类不能空!";
	  		return false;
		}
		return true;
	}

	// get publish content by article id
	function get($id)
	{
		// Query databse for a publish
		$ret = false;
		$db = GLOBALDB();
        $sql = sprintf('SELECT * FROM article WHERE id = %d', $id);

        if ($result = $db->query($sql)) {
        	if (mysql_num_rows($result)) {
	          $row = mysql_fetch_assoc($result);
		      $this->id = $row['id'];
		      $this->uid = $row['uid'];
		      $this->author = $row['author'];
		      $this->brand = $row['brand'];
		      $this->series = $row['series'];
		      $this->module = $row['module'];
		      $this->catalog = $row['catalog'];
		      $this->title = $row['title'];
		      $this->content = $row['content'];
		      $this->image = $row['image'];
		      $this->level = $row['level'];
		      $this->url = $row['url'];
		      $this->link = $row['link'];
		      $this->date = $row['date'];
		  	  $this->refer = $row['refer'];
		      $this->comment = $row['comment']; 
			  $ret = true;
        	}
        	mysql_free_result($result);
        }        
        return $ret;
	}

	function add()
	{
		// get user id by session
		$sid = $_SESSION['userid'];
		if (!isset($sid)) {
			$sid = 1; //admin
		}
		$this->getUser($sid);

		// save content to file
        $this->url = $this->save();

        // truncate the content
    	$desc = strip_tags($this->content);
    	$desc = truncat($desc, 100);

    	$db = GLOBALDB();
    	$this->content = mysql_real_escape_string($desc);
    	    	
        // insert publish statement
		$sql = sprintf(
		"INSERT INTO article(". 
		  "uid, author, brand,".
		  "series, module, catalog,".
		  "title, content, image, level,".
		  "url, link, date, refer, comment)".
		"VALUES (".
		  "%d,'%s','%s',".
		  "'%s','%s','%s',".
		  "'%s','%s','%s',%d,".
		  "'%s','%s','%s',%d,%d)",
		  $this->uid,
		  $this->author,
		  $this->brand,
		  $this->series,
		  $this->module,
		  $this->catalog,
		  $this->title,
		  $this->content,
		  $this->image,
		  $this->level,
		  $this->url,
		  $this->link,
		  $this->date,
		  $this->refer,
		  $this->comment);
		
        $fp = fopen("log.txt", "w");
	    fwrite($fp, $sql);
	    fwrite($fp, mysql_error()); 
        fclose($fp);     
        
        $result = $db->query($sql);
        if (!$result)
            return false;

		// reload page or send them to index
		$page = 'http://www.wanet.cn/'.$this->url;
		header('Location: '. $page);
        return true;
	}

	function update($id)
	{
		$sql = sprintf(
		"UPDATE article SET". 
		  "brand = '%s',".
		  "series = '%s',".
		  "module = '%s',".
		  "catalog = '%s',".
		  "title = '%s',".
		  "content = '%s',".
		  "image = '%s',".
		  "level = '%d',".
		  "date = '%s',".
		"WHERE id = %d",		  
		  $this->brand,
		  $this->series,
		  $this->module,
		  $this->catalog,
		  $this->title,
		  $this->content,
		  $this->image,
		  $this->level,
		  $this->date);

		mysql_query($sql, GLOBALDB());
		$this->id = mysql_query(GLOBALDB());
	}

	function delete($id)
	{
		// delete the publish record
		$sql = sprintf('DELETE user article where id = %d',$id);
		mysql_query($sql, GLOBALDB());
	}

	function getUser($uid)
	{
		// get user information
		$user = new User();
		if ($user->get($uid)) {
		    $this->uid = $uid;
		    $this->author = $user->name;
		    $this->link = $user->link;
		}
	}

	// user's publish function
	function getAll($uid)
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
		      $this->catalog = $row['catalog'];
		      $this->title = $row['title'];
		      $this->content = $row['content'];
		      $this->image = $row['image'];
		      $this->level = $row['level'];
		      $this->url = $row['url'];
		      $this->link = $row['link'];
		      $this->date = $row['date'];
		  	  $this->refer = $row['refer'];
		      $this->comment = $row['comment']; 
        	}
        }

        mysql_free_result($result);
        return false;
	}

	// get picture form content
	function getImageRegex()
	{
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
			$this->content, $matches);
		$first_img = $matches [1] [0];

		//Defines a default image
		if(empty($first_img)){
			$first_img = "/images/default.jpg";
		}
		$this->image = $first_img;
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
		$this->image = $first_img;
	}

    function getTotal($condition)
    {
       	// get publish count
       	$total = 0;
   	    $db = GLOBALDB();
   	    $sql = "SELECT count(*) AS total FROM article where ".$condition;
   	  
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
    	
    function paging($condtion='1')
    {
      // get query cataloy
      $url = '';
   	  if(isset($_GET["catalog"])){
   	  	$value = $_GET['catalog'];
   	  	$condtion = sprintf("catalog='%s'",$value);
   	  	$url = '&catalog='.$value;
   	  }

   	  // get page number
   	  $page = 1;
   	  if(isset($_GET["page"])){
   	  	$page = $_GET['page'];   	  	
   	  }
   	  
      // set page size
      $number = 5;
      $url = '?page={page}'.$url;
      $total = $this->getTotal($condtion);
      $pager = new Paging($total,$number,$page,$url);

   	  // get publish records
	  $db = GLOBALDB();
      $sql = 'SELECT * FROM article WHERE '.$condtion.' LIMIT '.$pager->limit.','.$pager->size;
      //echo $url;
      //echo $sql;
       
      if ($result = $db->query($sql))
      {
		$this->display($result);
      }
      
      // show paging bar
      if ($total > $number) {
	  	$pager->show();
      }
    }

    function show_count()
    {
       	// get publish count
   	    $db = GLOBALDB();
   	    $sql = "SELECT count(*) AS total FROM article";

   	    $result = $db->query($sql);
   	    if ($result = $db->query($sql)) {
   	    	if (mysql_num_rows($result)) {
   	    		$row = mysql_fetch_assoc($result);
   	  	   		$this->total = $row['total'];
   	    	}
   	  	   mysql_free_result($result);
   	    }
    }

    function show_navbar()
    {
    	echo $GLOBALS['TEMPLATE']['RESNAV'];      	
	    echo '<div class="margintop10">';
      echo '<div class="bottom2"></div>';
      echo '<div class="bottom1"></div>';    
	    echo '  <div id="newsList">';    	
	    
    }
    
    function show_content()
    {
    	$str = $GLOBALS['TEMPLATE']['RESPOST'];
    	$patterns =array( 
    		"/{read}/", 
    		"/{url}/", 
    		"/{comment}/", 
    		"/{title}/",
    		"/{content}/",
    		"/{date}/",
    		"/{author}/",
    		"/{cataloy}/"
    	);
    	$replaces = array ();    	
    	$replaces[0] = $this->refer;
    	$replaces[1] = $this->url;    	
    	$replaces[2] = $this->comment;
    	$replaces[3] = $this->title;
    	$replaces[4] = htmlspecialchars($this->content);
    	$replaces[5] = $this->date;
    	$replaces[6] = $this->author;
    	$replaces[7] = $this->catalog;
    
    	$str = preg_replace($patterns, $replaces, $str);
        echo $str;
        
        /*
        echo '<div class="post">';
        echo '  <h2><span class="f_right">阅读: '.$this->refer.' | 评论: ';
        echo '  <a href="http://www.wanet.cn/'.$this->url.'#comments" title="'.$this->title.'">{comment} »</a></span>';
        echo '  <a href="http://www.wanet.cn/'.$this->url.'">'.$this->title.'</a></h2>';
        echo '  <p>'.$this->content.'</p>';
        echo '  <p><a href="http://www.wanet.cn/'.$this->url.'">全文阅读&gt;&gt;</a></p>';
        echo '  <h4>'.$this->date.' | 作者: '.$this->author.' | 标签: '.$this->catalog.' <a href="http://www.wanet.cn/'.$this->catalog.'" rel="tag"></a></h4>';
        echo '</div>';
		*/              
    }
      
    function show_content_end()
    {
	    echo '  </div>';
	    echo '  <div class="bottom1"></div>';
	    echo '  <div class="bottom2"></div>';
	    echo '</div>'; 	
    }
    
    function show_pagebar1()
    {
    	$str = $GLOBALS['TEMPLATE']['RESPAGE'];
    	echo $str;
    }

    function show_pagebar()
    {
      // show paging bar
	  $pager->show();
    }
        
    function display($result)
    {
    	$this->show_navbar();
      	$rows = mysql_num_rows($result);
        while($rows) {
            $row = mysql_fetch_assoc($result);
            $this->id = $row['id'];
            $this->uid = $row['uid'];
            $this->author = $row['author'];
            $this->brand = $row['brand'];
            $this->series = $row['series'];
            $this->module = $row['module'];
            $this->catalog = $row['catalog'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->image = $row['image'];
            $this->level = $row['level'];
            $this->url = $row['url'];
            $this->link = $row['link'];
            $this->date = $row['date'];
            $this->refer = $row['refer'];
            $this->comment = $row['comment']; 
    		
    		$this->show_content();    		
    		$rows--;
       	}
       	$this->show_content_end();
       	//$this->show_pagebar();
    }
           
    function search($keyword)
    {
    	$condition = "title like \"".$keyword."\"";
		$this->paging($condition);
    }

    function show()
    {    
    	
    }
    
    function get_assoc_articles($tpl)
    {
		// Query databse for a article
		$related = "";
		$count = 0;
		$db = GLOBALDB();
        $sql = sprintf("SELECT title, url FROM article where catalog='%s' order by date LIMIT 4", $this->catalog);
		         
        if ($result = $db->query($sql)) {
        	 $rows = $count = mysql_num_rows($result);        	  
        	 while($rows) {
		          $row = mysql_fetch_assoc($result);
			      $title = $row['title'];
			      $url = $row['url'];			  	      
			  	  $related = $related.'<li><a href="http://www.wanet.cn/'.$url.'">'.$title.'</a></li>';
			      $rows--;
        	 }
        }
        
        $i = count($tpl);
        $tpl[$i] = $related;
        mysql_free_result($result);
        return $count;
    }
    
  
    function get_prev_next($tpl)
    {
		// Query databse for a article
		$assoc;
		$db = GLOBALDB();
        $sql = sprintf('SELECT title, url FROM article order by date LIMIT 2');

        $i = count($tpl);
        if ($result = $db->query($sql)) {
        	 $rows = $count = mysql_num_rows($result);
             if($rows<2)
                $rows = 2;             
        	 while($rows) {
		          $row = mysql_fetch_assoc($result);			      
			      $tpl[$i++] = $row['url'];
			      $tpl[$i++] = $row['title'];
			      $rows--;
        	 }
        }
        mysql_free_result($result);
        return $count;
    }       

    function save()
    {
        // read the template
        $dir = dirname(__FILE__);
        $content = file_get_contents($dir.'/templates/article-content.tpl'); 
        if (!$content){
      	  $this->error = "fail to read article content template"; 
          return false;
        }
          	
    	$patterns =array(            
            "/{title}/",
            "/{date}/",
            "/{from}/",
            "/{author}/",
            "/{url}/",
            "/{count}/", 
            "/{content}/",
            "/{editor}/",
            "/{preurl}/",
            "/{pretitle}/",
            "/{nexturl}/",
            "/{nextitle}/",
            "/{related}/"
    	);
    	$replaces = array ();
        $replaces[0] = $this->title;
        $replaces[1] = $this->date;
        $replaces[2] = $this->from;
        $replaces[3] = $this->author;
        $replaces[4] = $this->url;
        $replaces[5] = $this->refer;
        $replaces[6] = $this->content;
        $replaces[7] = "@WANET.CN";

		$this->get_prev_next(& $replaces);
		$this->get_assoc_articles(& $replaces);
    	$content = preg_replace($patterns, $replaces, $content);        

        $date = date("Ymd-Hms");
        $dirname = '../articles/docs/';
        $filename = sprintf("%d-%d-%s.php", $this->id, $this->uid, $date);
        $url = 'articles/docs/'.$filename;

        $fp = fopen($dirname.$filename, "w");
      	if (!$fp)  {
        	return "fail create file";
      	}

      	if (fwrite($fp, $content) == FALSE) {
        	fclose($fp);
        	return "fail wirte content";
      	}

      	fclose($fp);
      	return $url;
    }    
  } // end of class

  function article_display()
  {
  	  $artcles = new Article();
  	  $artcles->display();
  }

  function article_post()
  {  	  
	  $form = ob_get_clean(); 
  	  if (!isset($_POST['submitted'])) {
		$GLOBALS['TEMPLATE']['content'] = $form;
		echo $GLOBALS['TEMPLATE']['content'];
	  }
	  else
	  {
		$article = new Article();
		if ($article->parse($_POST)) {
			$article->add();
		}
      }
  }  
  
  
  // article function test 
  //$article = new Article();
  //$article->get(91);
  //$article->save();
  //$_GET["catalog"] = '发动机件'
  //$article->paging(1);
  

  // end of php script
?>
