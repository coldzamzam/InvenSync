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
    $this->db->query('SELECT i.*, c.category_name, b.brand_name 
                      FROM i_master_item i 
                      JOIN i_master_category c ON i.category_id = c.category_id
                      JOIN i_master_brand b ON i.brand_id = b.brand_id
                      WHERE i.is_deleted = 0 AND i.store_id=:store_id');
    $this->db->bind('store_id', $_SESSION['store_id']);
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
    $query = "INSERT INTO I_INVENTORY (QUANTITY, HARGA_BELI, USER_ID,STORE_ID) 
              VALUES (:quantity, :harga_beli, :user_id, :store_id)";
    $this->db->query($query);
    $this->db->bind('quantity', $data['quantity']);
    $this->db->bind('harga_beli', $data['harga_beli']);
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    
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

  public function addBrand($data) {
    $query = "INSERT INTO i_master_brand (brand_name, store_id) VALUES (:brand_name, :store_id)";
    $this->db->query($query);
    $this->db->bind('brand_name', $data['brand_name']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllBrand() {
    $query = "SELECT * FROM i_master_brand WHERE store_id = :store_id";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function addCategory($data) {
    $query = "INSERT INTO i_master_category (category_name, store_id) VALUES (:category_name, :store_id)";
    $this->db->query($query);
    $this->db->bind('category_name', $data['category_name']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllCategory() {
    $query = "SELECT * FROM i_master_category WHERE store_id = :store_id";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function addItem($data) {
    $query = "INSERT INTO i_master_item (item_name, cost_price, category_id, brand_id, store_id) 
              VALUES (:item_name, :cost_price, :category_id, :brand_id, :store_id)";
    $this->db->query($query);
    $this->db->bind('item_name', $data['item_name']);
    $this->db->bind('cost_price', $data['cost_price']);
    $this->db->bind('category_id', $data['category_id']);
    $this->db->bind('brand_id', $data['brand_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }



}

?>