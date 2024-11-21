<?php

Class Item_model {
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  

  public function getAllItem(){
    $this->db->query('SELECT * FROM i_inventory WHERE is_deleted = 0');
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }

  public function getAllUser(){
    $this->db->query('SELECT * FROM i_users WHERE is_deleted = 0');
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }
  
}

?>