<?php
require_once 'db.php';

// user class
class Part
{      
    public $id;
    public $catalog;
    public $series;
    public $model;
    public $partno;
    public $code;
    public $name;
    public $ename;
    public $alias;
    public $pinyin;
    public $abbr;
    public $spec;
    public $unit;
    public $quantity;
    public $price;
    
    // error code
    public $error;
    
    function __construct()
    {
        // default values
        $this->id = 0;
        $this->catalog = 0;
        $this->series = 0;
        $this->model = 0;
        $this->partno = 0;
        $this->code = '';
        $this->name = '';
        $this->ename = '';
        $this->alias = '';
        $this->pinyin = '';
        $this->abbr = '';
        $this->spec = '';
        $this->unit = '';
        $this->quantity = '0';
        $this->price = '0';
        
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
        $me = new Part;
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
        $this->catalog = mysql_real_escape_string($obj['catalog']);
        $this->series = mysql_real_escape_string($obj['series']);
        $this->model = mysql_real_escape_string($obj['model']);
        $this->partno = mysql_real_escape_string($obj['partno']);
        $this->name = mysql_real_escape_string($obj['name']);
        $this->ename = mysql_real_escape_string($obj['ename']);
        $this->alias = mysql_real_escape_string($obj['alias']);
        $this->pinyin = mysql_real_escape_string($obj['pinyin']);
        $this->abbr = mysql_real_escape_string($obj['abbr']);
        $this->spec = mysql_real_escape_string($obj['spec']);
        $this->unit = mysql_real_escape_string($obj['unit']);
        $this->quantity = mysql_real_escape_string($obj['quantity']);
        $this->price = mysql_real_escape_string($obj['price']);

        // Check part avaiable value 
        if (!$this->valid_value())  {
            return false;
        }
        
        return true;
    }
   
    function valid_null(array $post) {
        if ($post['name'] == null || !strlen($post['name'])) {
            $this->error = "部件全名不能为空!";
            return false;
        }
        if ($post['pinyin'] == null || !strlen($post['pinyin'])) {
            $this->error = "部件简称拼音不能为空!";
            return false;
        }
        if ($post['abbr'] == null || !strlen($post['abbr'])) {
            $this->error = "部件简称拼音缩写不能为空!";
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
        return true;
    }
    
    function valid_name()
    {        
        // default no exist
        $exist = false;
        $db = GLOBALDB();
        
        // Query databse for account
        $sql = sprintf('SELECT id, name FROM parts WHERE name = "%s"',$this->name);

        // Determine number of rows        
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)){                
                $this->error = "该部件名称已经存在!";
                $exist = true;
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
            // check part name if exist
            if ($this->valid_name()) {
                return $this->err();
            }
            if(!$this->add()) {
                return $this->err();
            }
        }
        
        $result['id'] = $this->id;
        $result['data'] = "部件信息已经成功保存!";         
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
		        echo '<li id="v2">'.$this->catalog.'</li>';
		        echo '<li id="v3">'.$this->series.'</li>';
		        echo '<li id="v4">'.$this->model.'</li>';
		        echo '<li id="v5">'.$this->partno.'</li>';
		        echo '<li id="v6">'.$this->code.'</li>';
		        echo '<li id="v7">'.$this->name.'</li>';
		        echo '<li id="v8">'.$this->ename.'</li>';
		        echo '<li id="v9">'.$this->alias.'</li>';
		        echo '<li id="v10">'.$this->pinyin.'</li>';
		        echo '<li id="v11">'.$this->abbr.'</li>';
		        echo '<li id="v12">'.$this->spec.'</li>';
		        echo '<li id="v13">'.$this->unit.'</li>';
		        echo '<li id="v14">'.$this->quantity.'</li>';
		        echo '<li id="v15">'.$this->price.'</li>';
		        echo '</div>';
            }else{
                echo '<div id="get" style="display:none">';
                echo '<li id="err">'.$this->error.'</li>';
                echo '</div>';
            }
        }
    }
        
    function get_taiho()
    {
        $db = GLOBALDB();
        $sql = 'SELECT name, alias, round(price,1) AS price, quantity FROM parts WHERE partno = "TAIHO"';
               
        $i = 0; 
        $v = array();
        $n = array();
        if ($result = $db->query($sql)) {
            $rows = mysql_num_rows($result);
            while($rows) {
                $row = mysql_fetch_assoc($result);
                $name = $row['name'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                
                $v[$i] = $price;
                $n[$i] = $quantity;
                if(strstr($name,"偏心瓦")) {
                	$name = strstr($name,'-',true);
                    $this->show_taiho1($name,$v,$n);
                    $i = 0;
                }else{
                    $i++;
                }
                $rows--;
            }
            mysql_free_result($result);
        }
    }
        
    function show_taiho($name,$v,$n)
    {
    	$f1 = (float)$v[0] + (float)$v[4];
    	$f2 = (float)$v[1] + (float)$v[5];
    	$f3 = (float)$v[2] + (float)$v[6];
    	$f4 = (float)$v[3] + (float)$v[7];
    	
        $list = 
        '  <tr>'.
        '    <td class="blue-bottom model" rowspan="3">'.$name.'</td>'.
        '    <td class="big mr" height="20">大瓦</td>'.
        '    <td class="big std"><div id="lr"><div id="l">'.$v[0].'</div><div id="r">'.$n[0].'</div></div></td>'.
        '    <td class="big s25"><div id="lr"><div id="l">'.$v[1].'</div><div id="r">'.$n[1].'</div></div></td>'.
        '    <td class="big s50"><div id="lr"><div id="l">'.$v[2].'</div><div id="r">'.$n[2].'</div></div></td>'.
        '    <td class="big s75"><div id="lr"><div id="l">'.$v[3].'</div><div id="r">'.$n[3].'</div></div></td>'.
        '    <td class="big c blue-bottom" rowspan="3"><div id="lr"><div id="l">'.$v[8].'</div><div id="r">'.$n[8].'</div></div></td>'.
        '    <td class="big t blue-bottom" rowspan="3"><div id="lr"><div id="l">'.$v[9].'</div><div id="r">'.$n[9].'</div></div></td>'.
        '    <td class="big p blue-bottom" rowspan="3"><div id="lr"><div id="l">'.$v[10].'</div><div id="r">'.$n[10].'</div></div></td>'.
        '  </tr>'.
        '  <tr>'.
        '    <td class="small mr" height="20">小瓦</td>'.
        '    <td class="small std"><div id="lr"><div id="l">'.$v[4].'</div><div id="r">'.$n[4].'</div></div></td>'.
        '    <td class="small s25"><div id="lr"><div id="l">'.$v[5].'</div><div id="r">'.$n[5].'</div></div></td>'.
        '    <td class="small s50"><div id="lr"><div id="l">'.$v[6].'</div><div id="r">'.$n[6].'</div></div></td>'.
        '    <td class="small s75"><div id="lr"><div id="l">'.$v[7].'</div><div id="r">'.$n[7].'</div></div></td>'.
        '  </tr>'.
        '  <tr>'.
        '    <td class="sum mr" height="20">共</td>'.
        '    <td class="sum std">'.number_format($f1,1).'</td>'.
        '    <td class="sum s25">'.number_format($f2,1).'</td>'.
        '    <td class="sum s50">'.number_format($f3,1).'</td>'.
        '    <td class="sum s75">'.number_format($f4,1).'</td>'.
        '  </tr>';
        echo $list;
    }
        
    function show_taiho1($name,$v,$n)
    {

        $list = 
        '  <tr>'.
        '    <td class="blue-bottom model" rowspan="2">'.$name.'</td>'.
        '    <td class="big mr" height="20">大瓦</td>'.
        '    <td class="big std"><div id="lr"><div id="l">'.$v[0].'</div><div id="r">'.$n[0].'</div></div></td>'.
        '    <td class="big s25"><div id="lr"><div id="l">'.$v[1].'</div><div id="r">'.$n[1].'</div></div></td>'.
        '    <td class="big s50"><div id="lr"><div id="l">'.$v[2].'</div><div id="r">'.$n[2].'</div></div></td>'.
        '    <td class="big s75"><div id="lr"><div id="l">'.$v[3].'</div><div id="r">'.$n[3].'</div></div></td>'.
        '    <td class="big c blue-bottom" rowspan="2"><div id="lr"><div id="l">'.$v[8].'</div><div id="r">'.$n[8].'</div></div></td>'.
        '    <td class="big t blue-bottom" rowspan="2"><div id="lr"><div id="l">'.$v[9].'</div><div id="r">'.$n[9].'</div></div></td>'.
        '    <td class="big p blue-bottom" rowspan="2"><div id="lr"><div id="l">'.$v[10].'</div><div id="r">'.$n[10].'</div></div></td>'.
        '  </tr>'.
        '  <tr>'.
        '    <td class="small mr" height="20">小瓦</td>'.
        '    <td class="small std"><div id="lr"><div id="l">'.$v[4].'</div><div id="r">'.$n[4].'</div></div></td>'.
        '    <td class="small s25"><div id="lr"><div id="l">'.$v[5].'</div><div id="r">'.$n[5].'</div></div></td>'.
        '    <td class="small s50"><div id="lr"><div id="l">'.$v[6].'</div><div id="r">'.$n[6].'</div></div></td>'.
        '    <td class="small s75"><div id="lr"><div id="l">'.$v[7].'</div><div id="r">'.$n[7].'</div></div></td>'.
        '  </tr>';
        echo $list;
    }
        
    function show_taiho2($name,$v)
    {
        $list = 
        '  <tr>'.
        '    <td class="blue-bottom">'.$name.'</td>'.
        '    <td class="big std">'.$v[0].'/'.$v[4].'</td>'.
        '    <td class="big s25">'.$v[1].'/'.$v[5].'</td>'.
        '    <td class="big s50">'.$v[2].'/'.$v[6].'</td>'.
        '    <td class="big s75">'.$v[3].'/'.$v[7].'</td>'.
        '    <td class="big c blue-bottom">'.$v[8].'</td>'.
        '    <td class="big t blue-bottom">'.$v[9].'</td>'.
        '    <td class="big p blue-bottom">'.$v[10].'</td>'.  
        '  </tr>';
        echo $list;
    }    
    
    function show_taiho3($name,$v)
    {
        $list =
        '  <tr>'.        
        '    <td class="blue-bottom">'.$name.'</td>'.
        '    <td class="big std">'.$v[0].'</td>'.
        '    <td class="big std">'.$v[4].'</td>'.
        '    <td class="big s25">'.$v[1].'</td>'.
        '    <td class="big s25">'.$v[5].'</td>'.  
        '    <td class="big s50">'.$v[2].'</td>'.
        '    <td class="big s50">'.$v[6].'</td>'.    
        '    <td class="big s75">'.$v[3].'</td>'.
        '    <td class="big s75">'.$v[7].'</td>'.  
        '    <td class="big c blue-bottom">'.$v[8].'</td>'.
        '    <td class="big t blue-bottom">'.$v[9].'</td>'.
        '    <td class="big p blue-bottom">'.$v[10].'</td>'.  
        '  </tr>';
        echo $list;
    }
    
    function get($id)
    {
        $isget = false;
        $db = GLOBALDB();
        
        $sql = sprintf('SELECT * FROM parts WHERE id = %d',$id);
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $this->id = $row['id'];
                $this->catalog = $row['catalog'];
                $this->series = $row['series'];
                $this->model = $row['model'];
                $this->partno = $row['partno'];
                $this->code = $row['code'];
                $this->name = $row['name'];
                $this->ename = $row['ename'];
                $this->alias = $row['alias'];
                $this->pinyin = $row['pinyin'];
                $this->abbr = $row['abbr'];
                $this->spec = $row['spec'];
                $this->unit = $row['unit'];
                $this->quantity = $row['quantity'];
                $this->price = $row['price'];
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
            'INSERT INTO parts(catalog,series,model,partno,name,ename,alias,pinyin,abbr,spec,unit,quantity,price)VALUES('.
            '"%d","%d","%d","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',
            $this->catalog,
            $this->series,
            $this->model,
            $this->partno,
            $this->name,
            $this->ename,
            $this->alias,
            $this->pinyin,
            $this->abbr,
            $this->spec,
            $this->unit,
            $this->quantity,
            $this->price);
        
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
            'UPDATE parts SET '.
            'catalog = %d,'.
            'series = %d,'.
            'model = %d,'.
            'partno = "%s",'.
            'name = "%s",'.
            'ename = "%s",'.
            'alias = "%s",'.
            'pinyin = "%s",'.
            'abbr = "%s",'.
            'spec = "%s",'.
            'unit = "%s",'.
            'quantity = %s,'.
            'price = %s '.
            ' WHERE id=%s',        
            $this->catalog,
            $this->series,
            $this->model,
            $this->partno,
            $this->name,
            $this->ename,
            $this->alias,
            $this->pinyin,
            $this->abbr,
            $this->spec,
            $this->unit,
            $this->quantity,
            $this->price,
            $this->id);
        
        $db = GLOBALDB();		
        $result = $db->query($sql);
        return $result; 
    }
    
    function delete($id)
    {
        $db = GLOBALDB();
        $sql = sprintf('DELETE parts WHERE id = "%d"',$id);
        $result = $db->query($sql);
    }	

    // search the company
    function load_auto_complete()
    {
        $db = GLOBALDB();
        $sql = sprintf('SELECT id, name, pinyin, abbr FROM parts');
        if ($result = $db->query($sql)) {
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_assoc($result);                
                $id = $row['id'];
                $name = $row['name'];
                $abbr = $row['abbr'];
                $pinyin = $row['pinyin'];                
                array_push ($GLOBALS['PARTS'][$abbr], $name); 
                array_push ($GLOBALS['PARTS'][$pinyin], $name); 
            }
            mysql_free_result($result);
        }
    }

    // 
    // $company: company id
    // $part: part id 
    //    
    function get_sale_price($company, $part)
    {
        $db = GLOBALDB();
        $sql = ' select price from sales'. 
               ' where part = '.$part.' and company = '.$company. 
               ' order by date asc limit 0,1';
        
        $price = '';
        if ($result = $db->query($sql)) {
            $rows = mysql_num_rows($result);
            if ($rows) {
                $row = mysql_fetch_assoc($result);
                $price = $row['price'];
            }
            mysql_free_result($result);
        }
        return $price; 
    }
    
    // 
    // $id: company id, used to search the company's parts
    // If the cid is empty value, query the parts table.
    // else query the sales table for the parts.
    //
    function search($key, $cid)
    {
        $db = GLOBALDB();
        $sql = "SELECT id, name, alias, code, unit, price, quantity FROM parts ".
               "WHERE abbr LIKE '%".$key."%' ".
               "OR pinyin LIKE '%".$key."%' ".  
               "OR name LIKE '%".$key."%' LIMIT 11";
               
        $str = '';
        if ($result = $db->query($sql)) {
            $rows = mysql_num_rows($result);
            while($rows) {
                $row = mysql_fetch_assoc($result);
                $pid = $row['id'];
                $name = $row['name'];
                $alias = $row['alias'];
                $code = $row['code'];
                $unit = $row['unit'];                
                $quantity = $row['quantity'];
                
                // get the last sale price
                $price = $this->get_sale_price($pid, $cid);
                if (floatval($price) < floatval($row['price'])){
                    $price = $row['price'];
                }
                
                // echo the result to browser
                echo "$name|$alias|$pid|$code|$unit|$price|$quantity\n";
                $rows--;
            }
            mysql_free_result($result);
        }
    }
    
    function test()
    {
        $isget = false;
        $db = GLOBALDB();
        
        $sql = sprintf('SELECT * FROM parts');
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
        $data = file_get_contents("part_post.dat");
        $post = json_decode($data, true);
        
        if(!$this->save($post)) {
           return $this->error;
        }
        
        //if(!$this->add()) {
        //   return $this->error;
        //}
    }    
    
}// end of class

//$test = new Part();
//$test->search('4BD1','2');  

?>
