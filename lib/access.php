<?php
require_once 'db.php';

// User access control class
class Access
{      
    public $id;
    public $account;
    public $page;
    public $module;
    public $func;
    public $permit;
    public $date;
    
    // error code
    public $type;
    public $error;    
    
    function __construct()
    {
        // default values
        $this->id = 0;
        $this->account = '';
        $this->page = '';
        $this->module = '';
        $this->func = '';
        $this->permit = '0';
        $this->date = date('Y-m-d H:i:s');
        
        // error code
        $this->error = 0;        
    }
    
    function __destruct()
    {
        
    }
    
    function parse($post)
    {   
        // Trim all the incoming data
        $obj = array_map('trim', $post);
        
        // Validate the post values
        if (!$this->valid_null($obj)) {
            return false;
        }
        
        // Get the post obj values
        $this->id = mysql_real_escape_string($obj['id']);
        $this->account = mysql_real_escape_string($obj['account']);
        $this->page = mysql_real_escape_string($obj['page']);
        $this->module = mysql_real_escape_string($obj['module']);
        $this->func = mysql_real_escape_string($obj['func']);
        $this->permit = mysql_real_escape_string($obj['permit']);
        
        // Check part avaiable value 
        if (!$this->valid_value())  {
            return false;
        }

        return true;
    }
        
    function valid_null(array $post) {
        if ($post['account'] == null || !strlen($post['account'])) {
            $this->error = "系统用户名不能为空!";
            return false;
        }
        if ($post['page'] == null || !strlen($post['page'])) {
            $this->error = "访问页面不能为空!";
            return false;
        }        
        return true;
    }
    
    function valid_value() {
        if (strlen($this->permit)) {
            if (!is_numeric($this->permit)) {
                $this->error = "请输入有效的权限!";
                return false;
            }
        }        
        // get date format for mysql
        $this->date = date('Y-m-d h:i:s');
        return true;
    }
        
    function valid_account()
    {        
        // default no exist
        $exist = FALSE;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM account WHERE name = "%s"',$this->account);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result))
            $exist = TRUE;
            // close result set
            mysql_free_result($result);
        }
        
        return $exist;
    }  
   
    function save($post)
    {
        if(!$this->parse($post)) {
            $this->warn();
            return false;
        }
        
        // if the object's id existed, update the object
        // else the object is new bill, add it to db
        if (!is_null($this->id) && ((int)$this->id)) {
        	if(!$this->update()) {
        	   $this->warn();
        	   return false;
        	}
        }
        else {
        	if(!$this->add()) {
                $this->warn();
                return false;
        	}
        }
        
        $result['data'] = "用户权限已经成功保存!";
        $json = json_encode($result);
        echo $json;
        return true;
    }
   
    function warn()
    {
        // check if mysql error
        if ($this->error == '') {
            $this->error = mysql_error();
        }
        
        // return the error infor    
        $result['data'] = $this->error;
        $json = json_encode($result);
        echo $json;
    }
        
    function json()
    {   
    	$obj = new Access();
        $obj->fetch($this->id);
        
        $data = array(
            'id' => $this->id,
            'account' => $this->account,
            'page' => $this->page,
            'module' => $this->module,
            'func' => $this->func,
            'permit' => $this->permit
        );
    }
        
    function fetch()
    {
       //$_GET["id"] = '1';
       if(isset($_GET["id"])){
            $id = $_GET['id'];
            if($this->get('id='.$id)) {
                echo '<div id="get" style="display:none">';
                echo '<li id="v1">'.$this->id.'</li>';
                echo '<li id="v2">'.$this->account.'</li>';
                echo '<li id="v3">'.$this->page.'</li>';
                echo '<li id="v4">'.$this->module.'</li>';
                echo '<li id="v5">'.$this->func.'</li>';
                echo '<li id="v6">'.$this->permit.'</li>';                   
                echo '</div>';
            }else{
                echo '<div id="get" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
        }
    }
        
    function get($condition)
    {
        $isget = false;
        $db = GLOBALDB();
        
    	$sql = 'SELECT * FROM access WHERE '.$condition;
    	
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $this->id = $row['id'];
                $this->account = $row['account'];
                $this->page = $row['page'];
                $this->module = $row['module'];                
                $this->func = $row['func'];
                $this->permit = $row['permit'];
                $this->date = $row['date'];
                $isget = true;
            }
            mysql_free_result($result);
        }
        return $isget;    	
    }    
       
    function add()
    {
        // Insert sql statement
        $sql = sprintf(
            'INSERT INTO access(account,page,module,func,permit,date)VALUES('.
            '"%s","%s","%s","%s","%s","%s")',
            $this->account,
            $this->page,
            $this->module,
            $this->func,
            $this->permit,
            $this->date);
        
        $db = GLOBALDB();
        $this->type = 'insert';
        $result = $db->query($sql);
        if ($result) {
            $this->id = mysql_insert_id();
        }

        return $result;
    }       
    
    function update()
    {
        $sql = sprintf(
            'UPDATE access SET '.
            'account = "%s",'.
            'page = "%s",'.
            'module = "%s",'.
            'func = "%s",'.
            'permit = "%s",'.
            'date = "%s" '.
            ' WHERE id=%s',
            $this->account,
            $this->page,
            $this->module,
            $this->func,
            $this->permit,
            $this->date,
            $this->id);
        
        $db = GLOBALDB();		
        $this->type = 'update';
        $result = $db->query($sql);
        return $result; 
    }
    
    function delete($condition)
    {
        $db = GLOBALDB();
        $sql = 'DELETE access WHERE '.$condition;
        $result = $db->query($sql);
        return $result; 
    }	
           
    function test()
    {
        $data = file_get_contents("access_post.dat");
        $post = json_decode($data, true);
        
        if(!$this->save($post)) {
           return $this->error;
        }
        
        //if(!$this->add()) {
        //   return $this->error;
        //}
        
        //$this->update();
    }
    
}// end of class


//$obj = new Access();
//$obj->test();  

?>
