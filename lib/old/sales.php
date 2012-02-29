<?php
require_once 'db.php';
require_once 'tansaction.php';
require_once 'bill.php';

// user class
class Sales
{      
    public $id;
    public $bill;
    public $company;
    public $part;
    public $price;
    public $quantity;
    public $total;
    public $date;
    public $memo;
    public $history;
    public $type;
    
    // error code
    public $error;
    
    function __construct()
    {
        // default values
        $this->id = '0';
        $this->bill = '';
        $this->company = '0';
        $this->part = '0';
        $this->name = '';
        $this->price = '0';
        $this->quantity = '0';
        $this->total = '0';
        $this->date = date('Y-m-d h:i:s');
        $this->memo = '';
        $this->type = '';
        $this->history = 0;  // zero indicate the recode is last, >1 is history data
        
        // inner variables
        $this->error = 0;        
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
        
        $this->part = mysql_real_escape_string($obj['id']);
        $this->name = mysql_real_escape_string($obj['name']);
        $this->price = mysql_real_escape_string($obj['price']);
        $this->quantity = mysql_real_escape_string($obj['quantity']);
        $this->total = mysql_real_escape_string($obj['total']);
        $this->memo = mysql_real_escape_string($obj['memo']);
        
        // Check part avaiable value 
        if (!$this->valid_value())  {
            return false;
        }

        return true;
    }
   
    function valid_null(array $post) {
        if ($post['id'] == null || !strlen($post['id'])) {
            $this->error = "配件ID编码不能为空!";
            return false;
        }    	
        if ($post['name'] == null || !strlen($post['name'])) {
            $this->error = "配件名称不能为空!";
            return false;
        }
        if ($post['price'] == null || !strlen($post['price'])) {
            $this->error = "价格不能为空!";
            return false;
        }
        if ($post['quantity'] == null || !strlen($post['quantity'])) {
            $this->error = "数量不能为空!";
            return false;
        }

        return true;
    }
    
    function valid_value() {
        if (strlen($this->quantity)) {
            if (!is_int((int)$this->quantity)) {
                $this->error = "请输入有效的部件库存数量!";
                return false;
            }
        }

        if (strlen($this->price)) {
            if (!is_numeric((float)$this->price)) {
                $this->error = "请输入有效的部件价格!";
                return false;
            }
        }        
        
        $this->total = ((int)$this->quantity) * ((float)$this->price);
        return true;
    }
        
    function valid_name()
    {        
        // default no exist
        $exist = FALSE;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM parts WHERE id = "%s"',$this->part);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result))
            $exist = TRUE;
            // close result set
            mysql_free_result($result);
        }
        
        return $exist;
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
            $this->type = 'sale'; // sell
        else if ($value == '1')
            $this->type = 'buy';  // purchase
        else if ($value == '2')
            $this->type = 'presale';
        else if ($value == '3')
            $this->type = 'entry'; 
    }
    
    function save($post)
    {
        //$data = file_get_contents("bill_post.dat");
        //$post = json_decode($data, true);
        //$post['type'] = 'sale';
                     	
    	// Transaction start here.
    	{
    		// save the bill first            
            $tran = new Tansaction();
            $bill = new Bill();
            
            if(!$bill->save($post)) {
                return $bill->warn();
            }
            
            // save the bill parts
            $this->bill = $bill->id;
            $this->company = $bill->company;
            $this->type = $bill->type;
            
            // set the bill history 
            if(!$this->historized($this->bill)) {
                return $this->warn();
            }
                        
            // handle sale bill update
            if($bill->op == 'update' && $this->type == 'sale'){
                $sign = '+';
                if(!$this->restore($sign))
                   return $this->warn();
            }
            
            // save the every parts
            $objs = $post['parts'];
            $max = count($objs);
            for ($i = 0; $i < $max; $i++) {
                $part = $objs[$i];
                if(!$this->parse($part)){
                    return $this->warn();
                }
                if(!$this->add()) {
                   return $this->warn();
                }
            }

            // handle buy bill update
            if($bill->op == 'update' && $this->type == 'buy'){
                $sign = '-';
                if($this->restore($sign))
                    return $this->warn();
            }
            unset($tran);
    	}
    	
        // return the json result
        if($post['type'] == 'buy')
          $result['data'] = "采购单已经成功保存!";
        else if($post['type'] == 'presale')
          $result['data'] = "价格单已经成功保存!";
        else if($post['type'] == 'entry')
          $result['data'] = "入货单已经成功保存!";
        else if($post['type'] == 'sale')
          $result['data'] = "销售单已经成功保存!";
        
        $json = json_encode($result);
        echo $json;
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
        
    function json($bill)
    {
        $db = GLOBALDB();
        $parts = array();

        $sql = 	'SELECT'.
				' sales.part, sales.*, parts.name .parts.code, parts.unit'.
				'FROM'.
				' parts INNER JOIN'.
				' sales ON sales.part = parts.id '.
				'WHERE'.
                ' sales.history = 0 AND'.
				' sales.bill = '.$bill;
		          
        if ($result = $db->query($sql)) {
        	$rows = mysql_num_rows($result);
        	while($rows) {
                $row = mysql_fetch_assoc($result);
                $part = array(
	                'id' => $row['id'],
	                'part' => $row['part'],
                    'name' => $row['name'],
                    'code' => $row['code'],
                    'unit' => $row['unit'],
	                'price' => $row['price'],
	                'quantity' => $row['quantity'],
	                'total' => $row['total'],
	                'memo' => $row['memo']
                );
                array_push($parts, $part);
                $rows--;
            }
            mysql_free_result($result);
        }
        echo json_encode($parts);
    }   
     
    function fetch($bill)
    {
        $db = GLOBALDB();
        $parts = array();
                        
        $sql =  'SELECT'.
                ' sales.part, sales.*, parts.name, parts.code, parts.unit '.
                'FROM'.
                ' parts INNER JOIN'.
                ' sales ON sales.part = parts.id '.
                'WHERE'.
                ' sales.history = 0 AND'.
                ' sales.bill = '.$bill;
        
        $result = $db->query($sql);
        if ($result) {
            $rows = mysql_num_rows($result);
            if(!$rows){
                echo '<div id="sales" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
            while($rows) {
                $row = mysql_fetch_assoc($result);
                echo '<div id="sales" style="display:none">';
              //echo '<li id="v1">'.$row['id'].'</li>';
                echo '<li id="v1">'.$row['part'].'</li>';
                echo '<li id="v1">'.$row['name'].'</li>';
                echo '<li id="v1">'.$row['code'].'</li>';
                echo '<li id="v1">'.$row['unit'].'</li>';
                echo '<li id="v1">'.$row['quantity'].'</li>';
                echo '<li id="v1">'.$row['price'].'</li>';
                echo '<li id="v1">'.$row['total'].'</li>';
                echo '<li id="v1">'.$row['memo'].'</li>';
                echo '</div>';
                $rows--;
            }
            mysql_free_result($result);
        }
    } 
        
    function get($bill)
    {
        $isget = false;
        $db = GLOBALDB();
        
        $sql = sprintf('SELECT * FROM sales WHERE bill = %d', $bill);
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $this->id = $row['id'];
                $this->bill = $row['bill'];
                $this->company = $row['company'];
                $this->part = $row['part'];
                $this->price = $row['price'];
                $this->quantity = $row['quantity'];
                $this->total = $row['total'];
                $this->date = $row['date'];
                $this->memo = $row['memo'];
                $isget = true;
            }
            mysql_free_result($result);
        }
        return $isget;
    }

    //
    // 过程: 采购 -> 入库 -> 售价 -> 销售 -> 盘点
    // 1. 记录采购单的每个部件信息和数量及其原始价格
    // 2. 数量的处理，每次入库，采购单的数量历史化+1
    //    克隆历史化采购单，数量-入库数量
    //
    function purchase()
    {
        // Insert sql statement
        $this->history = 0;
        $sql = sprintf(
            'INSERT INTO sales(bill,company,part,price,quantity,total,date,memo,type,history)VALUES('.
            '%s,%s,%s,%s,%s,%.2f,"%s","%s",%d,%d)',
            $this->bill,
            $this->company,
            $this->part,
            $this->price,
            $this->quantity,
            $this->total,
            $this->date,
            $this->memo,
            $this->type2int(),
            $this->history);
        
        $db = GLOBALDB();        
        $result = $db->query($sql);
        if (!$result) {
            $this->error = '配件采购单保存错误!';
        }
        
        return $result;
    }

    // 入库：
    // 1. 数量的处理，每次入库，采购单的数量历史化+1
    //    克隆历史化采购单，数量-入库数量
    //
    function entry()
    {
        // Insert sql statement
        $this->history = 0;
        $sql = sprintf(
            'INSERT INTO sales(bill,company,part,price,quantity,total,date,memo,type,history)VALUES('.
            '%s,%s,%s,%s,%s,%.2f,"%s","%s",%d,%d)',
            $this->bill,
            $this->company,
            $this->part,
            $this->price,
            $this->quantity,
            $this->total,
            $this->date,
            $this->memo,
            $this->type2int(),
            $this->history);
        
        $db = GLOBALDB();
        $result = $db->query($sql);
        if (!$result) {
        	$this->error = '配件入库单保存错误!';
        	return $result;
        }

        $sql = 'UPDATE parts set quantity=quantity+'.$this->quantity.' WHERE id='.$this->part;
        $result = $db->query($sql);
        if (!$result) {
        	$this->error = '配件进销库存数量有错,请检查!';
        }
        return $result;
    }
    
    // 定制销售价格：
    // 1. 每次定制时, 数量1, 以前的定制单历史化+1
    //    不跟新parts的数量
    //    
    function presale()
    {
        // Insert sql statement
        $this->history = 0;
        $sql = sprintf(
            'INSERT INTO sales(bill,company,part,price,quantity,total,date,memo,type,history)VALUES('.
            '%s,%s,%s,%s,%s,%.2f,"%s","%s",%d,%d)',
            $this->bill,
            $this->company,
            $this->part,
            $this->price,
            $this->quantity,
            $this->total,
            $this->date,
            $this->memo,
            $this->type2int(),
            $this->history);
        
        $db = GLOBALDB();
        $result = $db->query($sql);
        if (!$result) {
            $this->error = '配件销售价格定制单保存错误!';
        }
        
        return $result;
    }
    
    //
    // 1. 保存销售单的每个部件信息和数量
    // 2. 更新部件表的数量,可能出错,库存可能已经0,再减就出错!
    //
    function sell()
    {
        // Insert sql statement
        $this->history = 0;
        $sql = sprintf(
            'INSERT INTO sales(bill,company,part,price,quantity,total,date,memo,type,history)VALUES('.
            '%s,%s,%s,%s,%s,%.2f,"%s","%s",%d,%d)',
            $this->bill,
            $this->company,
            $this->part,
            $this->price,
            $this->quantity,
            $this->total,
            $this->date,
            $this->memo,
            $this->type2int(),
            $this->history);
        
        $db = GLOBALDB();        
        $result = $db->query($sql);
        if (!$result) {
            $this->error = '配件销售保存错误!';
            return $result; 
        }
        
        $sql = 'UPDATE parts set quantity=quantity-'.$this->quantity.' WHERE id='.$this->part;       
        $result = $db->query($sql);
        if (!$result) {
            $this->error = $this->name.'库存数量不足,请检查!';
        }
        return $result;
    }
    
    function add()
    {
    	$result = false;
        
    	if($this->type === 'buy')
    		$result = $this->purchase();  //采购
    	else if($this->type === 'entry')
    	   	$result = $this->entry();     //入库
    	else if($this->type === 'presale')
            $result = $this->presale();   //预售 
        else if($this->type === 'sale')
            $result = $this->sell();      //销售
        else
            $this->error = '错误的单据类型!';
            
    	return $result;
    }   
     
    function update()
    {
        $sql = sprintf(
            'UPDATE sales SET '.
            'bill = %s,'.
            'company = %s,'.
            'part = "%s",'.
            'price = "%s",'.
            'quantity = "%s",'.
            'total = "%s",'.
            'date = "%s",'.
            'memo = "%s" '.
            ' WHERE id=%s',
            $this->bill,
            $this->company,
            $this->part,
            $this->price,
            $this->quantity,
            $this->total,
            $this->date,
            $this->memo,
            $this->id);
        
        $db = GLOBALDB();
        $result = $db->query($sql);
        return $result; 
    }
    
    function delete($condition)
    {
        $db = GLOBALDB();
        $sql = 'DELETE sales WHERE '.$condition;
        $result = $db->query($sql);
        return $result; 
    }   
    
    // 
    // 对单据进行历史话,即history+1, 对应新的单据bill的id在sales表是没记录的,
    // 对应要更新的单据, bill的id已经存在了, 进行记录历史化, 再重新插入记录.
    //
    function historized($bill)
    {
        $db = GLOBALDB();
        $sql = 'Update sales SET history=history+1 WHERE bill='.$bill;
        $result = $db->query($sql);
        if(!$result) {
            $this->error = "更新部件历史数据失败,请重新开始!";
        }
        return $result; 
    }

    //
    // 将要修改的销售单的历史记录的数目加回库存表parts
    // 在bill更新的做了history=1,这里是查回该记录
    //
    function restore($sign)
    {
        $db = GLOBALDB();
        $parts = array();
        
        $sql = 'SELECT part, quantity FROM sales WHERE history=1 AND bill='.$this->bill;
        if ($result = $db->query($sql)) {
            $rows = mysql_num_rows($result);
            while($rows) {
                $row = mysql_fetch_assoc($result);
                $part = array(
	                'id' => $row['part'],
	                'quantity' => $row['quantity'],
                );
                array_push($parts, $part);
                $rows--;
            }
            mysql_free_result($result);
        }else{
        	$this->error = "查询历史单据错误,请重新开始!"; 
        }
        
        // 变量sign在+的时候不会出错,在-的时候可能出错哦,因为库存的数量可能一减为负数!
        // 要提示用户有库存问题(入库单修改的时候).
        $num = count($parts);
        for ($i = 0; $i < $num; $i++) {
        	$part = $parts[$i];
        	$sql = 'UPDATE parts set quantity=quantity'.$sign.$part['quantity'].
        	       ' WHERE id='.$part['id'];
        	$result = $db->query($sql);
        	if(!$result) {
        		$this->error = "历史入库单和销售单的部件数量不一致,请检查历史单据!"; 
        		break;
        	}
        }
        return $result;
    }
    
    function stock_taking($part)
    {
        
    }    
    
    function search_price($company)
    {
        $db = GLOBALDB();
        $com = array();
        $sql = "SELECT id, bill, part, price,date FROM sales WHERE company = ".$company.' order by date desc LIMIT 5';
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $date = $row['date'];
            }
            mysql_free_result($result);
        }
    }
    
    function test1()
    {
        $data = file_get_contents("sales_post.dat");
        $post = json_decode($data, true);
        
        if(!$this->parse($post)) {
           return $this->error;
        }
        
        if(!$this->add()) {
           return $this->error;
        }
    }       
}// end of class


$test = new Sales();
$test->save();  

?>
