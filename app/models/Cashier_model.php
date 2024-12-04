<?php

class Cashier_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createIdReceipt() {
    $this->db->query("INSERT INTO i_receipt (user_id) VALUES (:user_id)");
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->execute();
    
    return $this->db->rowCount();
  }


}

?>