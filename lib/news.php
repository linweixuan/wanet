<?php

  class News
  {
    // members
    public $id;
    public $title;
    public $content;
    public $author;
    public $origin;
    public $date;
    public $comment;
    public $link;
      
    // error code
    public $error;
          
    function __construct()
    {
        $this->title = '';
        $this->content = '';
        $this->author = '';
        $this->origin = '';
        $this->date = '';
        $this->link = '';	
    }

    function __destruct()
    {
    }

    function add()
    {
        // save user to html
        if (!$this->create_home())
            return false;
        
        // Insert sql statement
        $sql = sprintf(
            'INSERT INTO news (title, content, author, origin, date, link)' .
            'VALUES ("%s","%s","%s","%s","%s","%s")',
          $this->title,
          $this->content,
          $this->author,
          $this->origin,
          $this->date,
          $this->link);

        $db = GLOBALDB();        
        $result = $db->query($sql);
        if ($result) {
            $this->id = mysql_insert_id();
        }
        return $result;
    }  

    function delete($id)
    {
        $db = GLOBALDB();
        $sql = sprintf('DELETE news WHERE id = "%d"',$id);
        $result = $db->query($sql);
        return $result; 
    }   

    function delete_all()
    {
        $db = GLOBALDB();
        $sql = sprintf('DELETE FROM news');
        $result = $db->query($sql);
        return $result; 
    }   
    
    // save publish to file
    function save()
    {
    }
    
    // show the last new users
    function show_keyword($words)
    {
        $html = '';
        $db = $GLOBALS['DB'];
        $condition = "title like \"".$words."\"";
        $sql = sprintf('SELECT * FROM news WHERE %s order by id desc LIMIT 0,10',$condition);
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->title = $row['title'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$link;
                $li = '<li class="news"><a href="'.$url.'">'.$this->title.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
        
    // show the last new users
    function show_type($type)
    {
        $html = '';
        $db = $GLOBALS['DB'];
        $condition = "type = ".$type;
        $sql = sprintf('SELECT * FROM news WHERE %s order by id desc LIMIT 0,10',$condition);
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->title = $row['title'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$link;
                $li = '<li class="news"><a href="'.$url.'">'.$this->title.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
        
    // show the last new users
    function show_top()
    {
        $html = '';
        $db = $GLOBALS['DB'];
        $sql = sprintf('SELECT * FROM news order by id desc LIMIT 0,10');
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->title = $row['title'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$link;
                $li = '<li class="news"><a href="'.$url.'">'.$this->title.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
    
    function show_all()
    {
    	$limit = 50;
        $html = '';
        $db = $GLOBALS['DB'];
        $sql = sprintf('SELECT company, link FROM user order by id desc LIMIT 0,10');
        if ($result = $db->query($sql)) {
            $rows = $result->num_rows;
            while($rows) {          
                $row = $result->fetch_assoc();
                $this->id = $uid;
                $this->title = $row['title'];
                $this->link = $row['link'];
                
                // save to html file
                $url = 'http://www.wanet.cn'.$this->link;
                $li = '<li class="news"><a href="'.$url.'">'.$this->title.'</a></li>';
                $html = $html.$li;
                $rows--;
            }
            $result->close();
        }
        return $html;
    }
    
  } // end of class
  
?>
