<?php
  // database connection and schema constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'root');
  define('DB_SCHEMA', 'wjdb');

  class Db
  {
    // connection
    public $conn;
    public $conn2;
    public $user;
    public $passwd;
    public $host;
    public $schema;    

    // sql members
    public $num_rows;
    public $result;
    
    function __construct()
    {
	    /*
	    $this->host = "sql200.byethost3.com"; 
	    $this->user = "b3_8959256";
	    $this->passwd = "Lwx76120";		
	    $this->schema = "b3_8959256_wjdb";
	    */
        $this->host = "localhost"; 
        $this->user = "root";
        $this->passwd = "root";		
        $this->schema = "wjdb";
        $this->result = false;        
    }

    function __destruct()
    {
        $this->close();
    }

    public static function instance()
    {
        static $me;
        if (is_object($me) == true) {        	
            return $me;
        }
        $me = new Db;
        $me->connect();
        return $me;
    }

    public function connect()
    {
        // mysql interface instance
        $this->conn = mysql_connect($this->host, $this->user, $this->passwd);
        if (!$this->conn )
        {
            die('Error: Unable to connect to database server.'.mysql_error());
            exit();
        }

        $this->query("set character set 'utf8'");
        $this->query("set names 'utf8'");
        
        // mysqli interface instance
        $GLOBALS['DB'] = new mysqli($this->host, $this->user, $this->passwd, $this->schema);
	    if (!$GLOBALS['DB'])
	    {
	        die('Error: Unable to connect to database server.'.mysql_error());
	        exit();     
	    }
	    
	    $GLOBALS['DB']->query("set character set 'utf8'");
	    $GLOBALS['DB']->query("set names 'utf8'");
    }

    public function close()
    {
        mysql_close();
    }

    public function query($sql)
    {
        $this->result = mysql_db_query($this->schema, $sql, $this->conn);
        return $this->result;
    }

    public function begin()
    {
    	mysql_db_query($this->schema, "BEGIN", $this->conn);
    	$this->result = false;
    }

    public function end()
    {
        mysql_db_query($this->schema, "END", $this->conn);
    }

    public function commit()
    {
        mysql_db_query($this->schema, "COMMIT", $this->conn);
    }

    public function rollback()
    {
        mysql_db_query($this->schema, "ROLLBACK", $this->conn);
    }
    
  } // end of class
	
  
  // Global function 
  function GLOBALDB()
  {
    return Db::instance();
  }

  // Connection instantiation
  Db::instance();
?>
