<?php
require_once 'db.php';
require_once 'sales.php';
require_once 'order_num.php';

// Sale bill class
class Bill
{      
    // bill fields variables
    public $id;
    public $company;  // company id
    public $name;     // company name
    public $address;
    public $operator;
    public $total;
    public $date;
    public $memo;
    public $num;
    public $book;
    public $sheet;
    public $type;
    public $history;
    public $warehouse;
    
    // inner members variables
    public $op;
    public $error;    
    
    function __construct()
    {
        // default values
        $this->id = 0;
        $this->company = 0;
        $this->name = '';
        $this->operator = 0;
        $this->total = '';        
        $this->date = date('Y-m-d H:i:s');
        $this->num = '';
        $this->book = '';
        $this->sheet = '';
        $this->memo = '';
        $this->type = '';
        $this->history = 0;
        $this->warehouse = '';
        
        // inner variables
        $this->op = ''; 
        $this->error = '';
    }
    
    function __destruct()
    {

    }
    
    function parse($post)
    {   
        // Trim all the incoming data
        $obj = array_map('trim', $post);
        
        if (!$this->valid_null($obj)) {
            return false;
        }
        
        $this->id = mysql_real_escape_string($obj['id']);
        $this->name = mysql_real_escape_string($obj['company']);
        $this->company = mysql_real_escape_string($obj['companyid']);
        $this->operator = mysql_real_escape_string($obj['operator']);
        $this->total = mysql_real_escape_string($obj['total']);
        $this->date = mysql_real_escape_string($obj['date']);
        $this->num = mysql_real_escape_string($obj['num']);
        $this->book = mysql_real_escape_string($obj['book']);
        $this->sheet = mysql_real_escape_string($obj['sheet']);
        $this->memo = mysql_real_escape_string($obj['memo']);
        $this->type = mysql_real_escape_string($obj['type']);
        $this->warehouse = mysql_real_escape_string($obj['warehouse']);
        
        // Check part avaiable value 
        if (!$this->valid_value())  {
            return false;
        }

        return true;
    }
        
    function valid_null(array $post) 
    {
        if ($post['company'] == null || !strlen($post['company'])) {
            $this->error = "公司名不能为空!";
            return false;
        }
        if ($post['total'] == null || !strlen($post['total'])) {
            $this->error = "销售总格不能为空!";
            return false;
        }
        if ($post['date'] == null || !strlen($post['date'])) {
            $this->error = "销售日期不能为空!";
            return false;
        }
        
        return true;
    }
    
    function valid_value()
    {
        if (strlen($this->total)) {
            if (!is_numeric($this->total)) {
                $this->error = "请输入有效的部件价格!";
                return false;
            }
        }
        
        // convert the date to mysql format
        if (!$this->valid_date()) {
            $this->error = "请输入有效的日期格式!";
            return false;
        }
        
        // conver the warehouse name to int
        $this->valid_warehouse();
        
        return true;
    }
        
    function valid_name()
    {        
        // default no exist
        $exist = FALSE;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM company WHERE id = "%s"',$this->company);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result))
            $exist = TRUE;
            // close result set
            mysql_free_result($result);
        }
        
        return $exist;
    }
   
    function valid_date()
    {
        $str = $this->date;
        $str = str_replace("年", "-", $str);
        $str = str_replace("月", "-", $str);
        $str = str_replace("日", "", $str);
        
        $stamp = strtotime($str);
        if (!is_numeric($stamp)) {
            return false;
        }
        
        //checkdate(month, day, year)
        if (checkdate(date('m', $stamp), date('d', $stamp), date('Y', $stamp)) ) {
            $this->date = $str;
            return true;
        }
        
        return false;
    } 
   
    function valid_warehouse()
    {        
        if ($this->warehouse == 'general')
            $this->warehouse = '1';
        else if ($this->warehouse == 'sub')
            $this->warehouse = '2';
        else
            $this->warehouse = '0';
        return true;
    }

    function save($post)
    {
        if(!$this->parse($post)) {
            return $this->warn();
        }
        
        // if the bill's id existed, update the bill
        // else the bill is new bill, add it to db
        if (!is_null($this->id) && ((int)$this->id)) {
            if(!$this->historized($this->id))
               return $this->warn();
               
        	if(!$this->update())
               return $this->warn();
        }
        else {
        	if(!$this->add())
               return $this->warn();
        }
        
        return true;
    }
   
    function json()
    {   $parts = new Sales();
        $parts->fetch($this->id);
        
        $data = array(
            'id' => $this->id,
            'companyid' => $this->company,
            'company' => $this->name,
            'address' => $this->address,
            'operator' => $this->operator,
            'total' => $this->total,
            'date' => $this->date,
            'num' => $this->num,
            'book' => $this->book,
            'sheet' => $this->sheet,
            'memo' => $this->memo,
            'parts' => $parts
        );
    }
        
    function fetch()
    {
       if(isset($_GET["id"])){
            $id = $_GET['id'];            
            if($this->get('id='.$id)) {
                // convert the date to our format
                $date_string = date('Y年m月d日 H:i:s', strtotime($this->date));    
                
                // output  the bill fields to html
                echo '<div id="get" style="display:none">';
                echo '<li id="v1">'.$this->id.'</li>';
                echo '<li id="v2">'.$this->name.'</li>';
                echo '<li id="v3">'.$this->company.'</li>';
                echo '<li id="v4">'.$this->address.'</li>';
                echo '<li id="v5">'.$this->operator.'</li>';
                echo '<li id="v6">'.$this->total.'</li>';
                echo '<li id="v7">'.$date_string.'</li>';
                echo '<li id="v8">'.$this->num.'</li>';
                echo '<li id="v9">'.$this->book.'</li>';
                echo '<li id="v10">'.$this->sheet.'</li>';
                echo '<li id="v11">'.$this->memo.'</li>';
                
                // echo the saled parts
                $parts = new Sales;
                $parts->fetch($id);                        
                echo '</div>';
            }else{
                echo '<div id="get" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
        }
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
        return false;
    }
        
    function type2int()
    {
        if ($this->type == 'sale')
            return 0;
        else if ($this->type == 'buy')
            return 1;
        else if ($this->type == 'presale')
            return 2;
        else if ($this->type == 'entry')
            return 3;
    }   
    
    function type2str($value)
    {
        if ($value == '0')
            $this->type = 'sale';
        else if ($value == '1')
            $this->type = 'buy';
        else if ($value == '2')
            $this->type = 'presale';
        else if ($value == '3')
            $this->type = 'entry';
    }
    
    function type2memo()
    {
        if ($this->type == 'sale')
            $this->memo = '销售单';
        else if ($this->type == 'buy') {
            $this->memo = '采购单';
            if ($this->warehouse != '1')
            $this->memo = '入库采购单';
        }
        else if ($this->type == 'presale')
            $this->memo = '价格单';
        else if ($this->type == 'entry')
            $this->memo = '入库单';
    }
    
    function get($condition)
    {
        $isget = false;
        $db = GLOBALDB();
        
    	$sql = 'SELECT'.
			   '  company.name, company.address, bills.* '.
			   'FROM'.
			   '  bills INNER JOIN'.
			   '  company ON bills.company = company.id '.    	
		       'WHERE'.
		       '  bills.'.$condition;
    	
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->address = $row['address'];
                $this->company = $row['company'];                
                $this->operator = $row['operator'];
                $this->total = $row['total'];
                $this->date = $row['date'];
                $this->num = $row['num'];
                $this->book = $row['book'];
                $this->sheet = $row['sheet'];
                $this->memo = $row['memo'];
                $isget = true;                
            }
            mysql_free_result($result);
        }
        return $isget;    	
    }    
       
    function add()
    {
        // Insert sql statement
        $this->history = 0;
        $this->type2memo();
        
        $sql = sprintf(
            'INSERT INTO bills(company,operator,total,date,num,book,sheet,memo,type,history,warehouse)VALUES('.
            '%d,%d,"%s","%s","%s","%s","%s","%s",%d,%d,%d)',
            $this->company,
            $this->operator,
            $this->total,
            $this->date,
            $this->num,
            $this->book,
            $this->sheet,
            $this->memo,
            $this->type2int(),
            $this->history,
            $this->warehouse
        );
        
        $db = GLOBALDB();
        $this->op = 'insert';
        $result = $db->query($sql);
        if ($result) {
            $this->id = mysql_insert_id();
        }
                
        return $result;
    }       
    
    function update()
    {
        $sql = sprintf(
            'UPDATE bills SET '.
            ' company = "%d",'.
            ' operator = "%d",'.
            ' total = "%s",'.
            ' date = "%s",'.
            ' num = "%s",'.
            ' book = "%s",'.
            ' sheet = "%s",'.
            ' memo = "%s" '.
            'WHERE id=%s',
            $this->company,
            $this->operator,
            $this->total,
            $this->date,
            $this->num,
            $this->book,
            $this->sheet,
            $this->memo,
            $this->id);
        
        $db = GLOBALDB();		
        $this->op = 'update';
        $result = $db->query($sql);
        if(!$result) {
            $this->error = "更新单据错误,请重新开始!";
        }        
        return $result; 
    }
    
    function delete($condition)
    {
        $db = GLOBALDB();
        $sql = 'DELETE bills WHERE '.$condition;
        $result = $db->query($sql);
        return $result; 
    }	

    // 
    // 对单据进行历史话,即history+1,  标记记录历史修改次数.
    //
    function historized($id)
    {
        $db = GLOBALDB();
        $sql = 'Update bills SET history=history+1 WHERE id='.$id;
        $result = $db->query($sql);
        if(!$result) {
            $this->error = "更新单据历史数据失败,请重新开始!";
        }
        return $result; 
    }
    
    function test()
    {
        $data = file_get_contents("sales_post.dat");
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


//$c = new Bill();
//$c->test();  

?>
