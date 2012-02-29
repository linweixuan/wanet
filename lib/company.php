<?php
require_once 'db.php';

// user class
class Company 
{      
    public $id;
    public $name;
    public $shortname;
    public $abbr;
    public $pinyin;
    public $address;
    public $telephone;
    public $mobile;
    public $fax;
    public $man;
    public $memo;
    
    // error code
    public $error;
    
    function __construct()
    {
        // default values
        $this->id = 0;
        $this->name = '';
        $this->shortname = '';
        $this->abbr = '';
        $this->pinyin = '';
        $this->address = '';
        $this->telephone = '';
        $this->mobile = '';
        $this->fax = '';
        $this->man = '';
        $this->memo = '';
        $this->error = 0;
    }
    
    function __destruct()
    {
        
    }
    
    public static function instance()
    {
        static $me;
        if (is_object($me) == true) {
            return $me;
        }
        $me = new Company;
        return $me;
    }
    
    function parse($post)
    {   
        // Trim all the incoming data
        $obj = array_map('trim', $post);
        
        if (!$this->valid_null($obj)) {
            return false;
        }
        
        $this->id = mysql_real_escape_string($obj['id']);
        $this->name = mysql_real_escape_string($obj['name']);
        $this->shortname = mysql_real_escape_string($obj['shortname']);
        $this->abbr = mysql_real_escape_string($obj['abbr']);
        $this->pinyin = mysql_real_escape_string($obj['pinyin']);
        $this->address = mysql_real_escape_string($obj['address']);
        $this->telephone = mysql_real_escape_string($obj['telephone']);
        $this->mobile = mysql_real_escape_string($obj['mobile']);
        $this->fax = mysql_real_escape_string($obj['fax']);
        $this->man = mysql_real_escape_string($obj['man']);
        $this->memo = mysql_real_escape_string($obj['memo']);

        return true;
    }
   
    function valid_null(array $post) {
        if ($post['name'] == null || !strlen($post['name'])) {
            $this->error = "公司全名不能为空!";
            return false;
        }
        if ($post['pinyin'] == null || !strlen($post['pinyin'])) {
            $this->error = "公司简称拼音不能为空!";
            return false;
        }
        if ($post['abbr'] == null || !strlen($post['abbr'])) {
            $this->error = "公司简称拼音缩写不能为空!";
            return false;
        }

        return true;
    }
    
    function valid_name()
    {        
        // default no exist
        $exist = false;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM company WHERE name = "%s"',$this->name);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $exist = true;
                $this->error = "该公司名称已经存在!";
            }
            // close result set
            mysql_free_result($result);
        }        
        
        return $exist;
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
            // check company name if exist
	        if ($this->valid_name()) {
	            return $this->err();
	        }
            if(!$this->add()) {
                return $this->err();
            }
        }
        
        $result['id'] = $this->id;
        $result['data'] = "公司信息已经成功保存!";         
        $json = json_encode($result);
        echo $json;
    }    
   
    function err()
    {
        $result['data'] = $this->error;
        $json = json_encode($result);
        echo $json;
    }
    
    function fetch()
    {
        if(isset($_GET["id"])){
            $id = $_GET['id'];
            if($this->get($id)) {
            	echo '<div id="get" style="display:none">';
		        echo '<li id="v1">'.$this->id.'</li>';
		        echo '<li id="v2">'.$this->name.'</li>';
		        echo '<li id="v3">'.$this->shortname.'</li>';
		        echo '<li id="v4">'.$this->abbr.'</li>';
		        echo '<li id="v5">'.$this->pinyin.'</li>';
		        echo '<li id="v6">'.$this->address.'</li>';
		        echo '<li id="v7">'.$this->telephone.'</li>';
		        echo '<li id="v8">'.$this->mobile.'</li>';
		        echo '<li id="v9">'.$this->fax.'</li>';
		        echo '<li id="v10">'.$this->man.'</li>';
		        echo '<li id="v11">'.$this->memo.'</li>';
            	echo '</div>';
            }else{
                echo '<div id="get" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
        }
    }
        
    function get($id)
    {
        $isget = false;
        $db = GLOBALDB();
        
        $sql = sprintf('SELECT * FROM company WHERE id = %d',$id);
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->shortname = $row['shortname'];
                $this->abbr = $row['abbr'];
                $this->pinyin = $row['pinyin'];
                $this->address = $row['address'];
                $this->telephone = $row['telephone'];
                $this->mobile = $row['mobile'];
                $this->fax = $row['fax'];
                $this->man = $row['man'];
                $this->memo = $row['memo'];
                $isget = true;
            }
            mysql_free_result($result);
        }else {
        	$this->error = "该公司名称不存在!";
        }
        return $isget;
    }
       
    function add()
    {
        // Insert sql statement
        $sql = sprintf(
            'INSERT INTO company(name,shortname,pinyin,abbr,address,telephone,mobile,fax,man,memo)VALUES('.
            '"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',
            $this->name,
            $this->shortname,
            $this->abbr,
            $this->pinyin,
            $this->address,
            $this->telephone,
            $this->mobile,
            $this->fax,
            $this->man,
            $this->memo);
        
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
            'UPDATE company SET '.
            'name = "%s",'.
            'shortname = "%s",'.
            'abbr = "%s",'.
            'pinyin = "%s",'.
            'address = "%s",'.
            'telephone = "%s",'.
            'mobile = "%s",'.
            'fax = "%s",'.
            'man = "%s",'.
            'memo = "%s" '.
            ' WHERE id=%s',
            $this->name,
            $this->shortname,
            $this->abbr,
            $this->pinyin,
            $this->address,
            $this->telephone,
            $this->mobile,
            $this->fax,
            $this->man,
            $this->memo,
            $this->id);
        
        $db = GLOBALDB();		
        $result = $db->query($sql);
        return $result; 
    }
    
    function delete($id)
    {
        $db = GLOBALDB();
        $sql = sprintf('DELETE company WHERE id = "%d"',$id);
        $result = $db->query($sql);
    }	

    // search the company
    function load_auto_complete()
    {
        $db = GLOBALDB();
        $sql = sprintf('SELECT id, name, pinyin, abbr FROM company');
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $id = $row['id'];
                $name = $row['name'];
                $abbr = $row['abbr'];
                $pinyin = $row['pinyin'];                
                array_push ($GLOBALS['COMPANY'][$abbr], $name); 
                array_push ($GLOBALS['COMPANY'][$pinyin], $name); 
            }
            mysql_free_result($result);
        }
    }

    function search($key)
    {
        $db = GLOBALDB();
        $sql = "SELECT id, name, shortname, address FROM company ".
               "WHERE abbr LIKE '%".$key."%' ".
               "OR pinyin LIKE '%".$key."%' ".  
               "OR name LIKE '%".$key."%' LIMIT 5";
        /*
	    $output = print_r($sql, true);
	    $fp = fopen("search.log", "a");
	    fwrite($fp, $output);
	    fwrite($fp, "========+++=========\n");
	    fclose($fp);
        */
        if ($result = $db->query($sql)) {
            $rows = mysql_num_rows($result);
            while($rows) {
                $row = mysql_fetch_assoc($result);                
                $id = $row['id'];
                $name = $row['name'];
                $shortname = $row['shortname'];
                $address = $row['address'];
                echo "$name|$shortname|$id|$address\n";
                $rows--;
            }
            mysql_free_result($result);
        }
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
    
    function test1()
    {
    	$data = file_get_contents("company_post.dat");
    	$post = json_decode($data, true);
    	
    	if(!$this->parse($post)) {
    	   return $this->error;
    	}
    	
        if(!$this->update()) {
           return $this->error;
        }
    }
    
}// end of class


// Test function here
//$test = new Company();
//$test->test1();  

?>
