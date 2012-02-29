<?php
  //
  //  Database tansaction class
  //
  require_once 'db.php';
      
  class Tansaction
  {        
      public $db;
      
      function __construct()
      {
          $this->db = Db::instance();
          $this->db->begin();
      }

      function __destruct()
      {
          if($this->db->result)
            $this->db->commit();
          else
            $this->db->rollback();
          $this->db->end();
      }
    
  }

?>