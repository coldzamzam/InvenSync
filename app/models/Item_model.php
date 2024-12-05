<?php

Class Item_model {
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  
  public function getPaginatedItems($start, $limit)
  {
      $this->db->query('
          SELECT * FROM (
              SELECT i.*, ROWNUM rnum
              FROM i_inventory i   
              WHERE i.is_deleted = 0 AND i.store_id=:store_id
          ) WHERE rnum > :startIndex AND rnum <= :endIndex
      ');
      $this->db->bind('startIndex', $start, PDO::PARAM_INT);
      $this->db->bind('endIndex', $start + $limit, PDO::PARAM_INT);
      $this->db->bind('store_id', $_SESSION['store_id']);
      $this->db->execute();
      return $this->db->resultSet();
  }

  public function getItemCount()
  {
      $this->db->query('SELECT COUNT(*) as total FROM i_inventory i  WHERE i.is_deleted = 0 AND i.store_id=:store_id');
      $this->db->bind('store_id',$_SESSION['store_id']);
      $this->db->execute();
      return $this->db->single()['TOTAL'];
  }
  
  public function getAllItem(){
    $this->db->query('SELECT * FROM i_inventory i WHERE i.is_deleted = 0 AND i.store_id=:store_id');
    $this->db->bind('store_id',$_SESSION['store_id']);
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }

  public function getUserStore(){
    $this->db->query('SELECT * FROM i_users WHERE is_deleted = 0 and store_id = :store_id');
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }  

  public function getPaginatedUsers($start, $limit)
  {
      $this->db->query('
          SELECT * FROM (
              SELECT a.*, ROWNUM rnum
              FROM i_users a
              WHERE is_deleted = 0 and store_id = :store_id
          ) WHERE rnum > :startIndex AND rnum <= :endIndex
      ');
      $this->db->bind('startIndex', $start, PDO::PARAM_INT);
      $this->db->bind('store_id', $_SESSION['store_id']);
      $this->db->bind('endIndex', $start + $limit, PDO::PARAM_INT);
      $this->db->execute();
      return $this->db->resultSet();
  }

  public function getUserCount()
  {
      $this->db->query('SELECT COUNT(*) as total FROM i_users WHERE is_deleted = 0 and store_id = :store_id');
      $this->db->bind('store_id', $_SESSION['store_id']);
      $this->db->execute();
      return $this->db->single()['TOTAL'];
  }

  public function getAllUser(){
    $this->db->query('SELECT * FROM i_users WHERE is_deleted = 0');
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }

  public function getInventoryUser(){
    $this->db->query("SELECT * FROM i_users WHERE role = 'Admin Gudang' AND is_deleted = 0");
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }

  public function getCashierUser(){
    $this->db->query("SELECT * FROM i_users WHERE role = 'Admin Kasir' AND is_deleted = 0");
    $this->db->execute();
    // var_dump($this->db->resultSet());
    return $this->db->resultSet();
  }
  


  public function addInventory($data) {
    $query = "INSERT INTO I_INVENTORY (ITEM_NAME, QUANTITY, HARGA_BELI, HARGA_JUAL, STATUS, DATE_ADDED,USER_ID,STORE_ID)
    VALUES (:NAMABARANG, :KUANTITAS, :HARGA_BELI, :HARGA_JUAL, :STATUS, SYSDATE,:USER_ID,:STORE_ID)";
    
    $this->db->query($query);
    $this->db->bind('NAMABARANG', $data['ITEM_NAME']);
    $this->db->bind('KUANTITAS', $data['QUANTITY']);
    $this->db->bind('HARGA_BELI', $data['HARGA_BELI']);
    $this->db->bind('HARGA_JUAL', $data['HARGA_JUAL']);
    $this->db->bind('STATUS', $data['STATUS']);
    $this->db->bind('USER_ID', $_SESSION['user_id']);
    $this->db->bind('STORE_ID', $_SESSION['store_id']);
    
    $this->db->execute();
    
    return $this->db->rowCount();
  }

  public function getItemByID($kodebarang) {
    $query = ('SELECT * FROM i_inventory WHERE item_id = :kodebarang');

    // var_dump($kodebarang);

    $this->db->query($query);
    $this->db->bind('kodebarang', $kodebarang);
    $this->db->execute();

    return $this->db->single();
  }

}

?>