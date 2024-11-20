<?php

Class Item_model {
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  

  public function getAllItem(){
    $this->db->query('SELECT * FROM i_inventory');
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }

  public function getAllUser(){
    $this->db->query('SELECT * FROM i_users');
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }
  
}

?>