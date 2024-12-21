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
    $this->db->query("SELECT 
                          i.ITEM_ID, 
                          i.ITEM_NAME, 
                          i.cost_price,
                          c.category_name,
                          b.brand_name,
                          i.date_added,
                          b.brand_id,
                          c.category_id,
                          NVL(inv.TOTAL_IN, 0) - NVL(rec.TOTAL_OUT, 0) AS STOCK_AVAILABLE
                      FROM 
                          i_master_item i
                      JOIN 
                          i_master_category c ON i.category_id = c.category_id
                      JOIN 
                          i_master_brand b ON i.brand_id = b.brand_id
                      LEFT JOIN (
                          SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_IN
                          FROM i_inventory
                          WHERE IS_DELETED = 0 AND STATUS = 'Diterima' AND STORE_ID = :store_id
                          GROUP BY ITEM_ID
                      ) inv ON i.ITEM_ID = inv.ITEM_ID
                      LEFT JOIN (
                          SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_OUT
                          FROM i_receipt_item
                          WHERE IS_DELETED = 0 AND STORE_ID = :store_id
                          GROUP BY ITEM_ID
                      ) rec ON i.ITEM_ID = rec.ITEM_ID
                      WHERE 
                          i.IS_DELETED = 0 AND i.STORE_ID = :store_id");
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
    $query = "INSERT INTO I_INVENTORY (ITEM_ID, QUANTITY, HARGA_BELI, USER_ID, STORE_ID) 
              VALUES (:item_id, :quantity, :harga_beli, :user_id, :store_id)";
    $this->db->query($query);
    
    $this->db->bind('item_id', $data['item_id']);
    $this->db->bind('quantity', $data['quantity']);
    $this->db->bind('harga_beli', $data['harga_beli']);
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    
    echo $query; // Untuk melihat query
    
    $this->db->execute();
    
    return $this->db->rowCount();
  }

  public function getItemByID($kodebarang) {
    $query = ('SELECT * FROM i_inventory WHERE item_id = :kodebarang AND is_deleted = 0');

    // var_dump($kodebarang);

    $this->db->query($query);
    $this->db->bind('kodebarang', $kodebarang);
    $this->db->execute();

    return $this->db->single();
  }

  public function cekBrand($brand_name) {
    $this->db->query('SELECT * FROM i_master_brand WHERE brand_name = :brand_name and is_deleted = 0');
    $this->db->bind('brand_name', $brand_name);
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
    $query = "SELECT * FROM i_master_brand WHERE store_id = :store_id and is_deleted = 0";
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
    $query = "SELECT * FROM i_master_category WHERE store_id = :store_id and is_deleted = 0";
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

  public function getAllInventory() {
    $query = "SELECT i.inventory_id, i.item_id, i.quantity, i.date_added, i.harga_beli, i.user_id, i.status, mi.item_name AS item_name
              FROM i_inventory i 
              JOIN i_master_item mi ON i.item_id = mi.item_id
              AND i.store_id = :store_id AND i.is_deleted = 0
              ORDER BY i.date_added DESC";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getAllTotalQuantity() {
    $query = "SELECT 
                  m.ITEM_ID, 
                  m.ITEM_NAME, 
                  NVL(i.TOTAL_IN, 0) AS TOTAL_IN,
                  NVL(r.TOTAL_OUT, 0) AS TOTAL_OUT,
                  NVL(i.TOTAL_IN, 0) - NVL(r.TOTAL_OUT, 0) AS STOCK_AVAILABLE
              FROM 
                  I_MASTER_ITEM m
              LEFT JOIN (
                  SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_IN
                  FROM I_INVENTORY
                  WHERE IS_DELETED = 0 AND STATUS = 'Diterima' AND STORE_ID = :store_id 
                  GROUP BY ITEM_ID
                  ) i ON m.ITEM_ID = i.ITEM_ID
              LEFT JOIN (
                  SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_OUT
                  FROM I_RECEIPT_ITEM
                  WHERE IS_DELETED = 0 AND STORE_ID = :store_id
                  GROUP BY ITEM_ID
                  ) r ON m.ITEM_ID = r.ITEM_ID
              WHERE 
                  m.IS_DELETED = 0 AND m.STORE_ID = :store_id";
              

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->resultSet();

  }

  public function getItemTersedia() {
    $query = "SELECT COUNT(*) AS TOTAL_ROWS
              FROM (
                  SELECT inventory.item_name, 
                         NVL(inventory.TOTAL_IN, 0) AS TOTAL_IN, 
                         NVL(receipt.TOTAL_OUT, 0) AS TOTAL_OUT
                  FROM (
                      SELECT m.item_name, SUM(i.quantity) AS TOTAL_IN
                      FROM i_master_item m
                      JOIN i_inventory i ON m.item_id = i.item_id
                      WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                            AND m.store_id = :store_id 
                            AND i.store_id = :store_id
                      GROUP BY m.item_name
                  ) inventory
                  LEFT JOIN (
                      SELECT m.item_name, SUM(i.quantity) AS TOTAL_OUT
                      FROM i_master_item m
                      JOIN i_receipt_item i ON m.item_id = i.item_id
                      WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                            AND m.store_id = :store_id 
                            AND i.store_id = :store_id
                      GROUP BY m.item_name
                  ) receipt ON inventory.item_name = receipt.item_name
                  WHERE NVL(inventory.TOTAL_IN, 0) - NVL(receipt.TOTAL_OUT, 0) > 5
              )";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    $result = $this->db->single();

    if (!$result || !isset($result['TOTAL_ROWS'])) {
      return ['TOTAL_ROWS' => 0];
    }

    return $result;
  }

  public function getItemHampirHabis() {
    $query = "SELECT COUNT(*) AS TOTAL_ROWS
              FROM (
                SELECT inventory.item_name, 
                        NVL(inventory.TOTAL_IN, 0) AS TOTAL_IN, 
                        NVL(receipt.TOTAL_OUT, 0) AS TOTAL_OUT
                FROM (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_IN
                  FROM i_master_item m
                  JOIN i_inventory i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_name
                ) inventory
                LEFT JOIN (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_OUT
                  FROM i_master_item m
                  JOIN i_receipt_item i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_name
                ) receipt ON inventory.item_name = receipt.item_name
              WHERE NVL(inventory.TOTAL_IN, 0) - NVL(receipt.TOTAL_OUT, 0) <= 5
              AND NVL(inventory.TOTAL_IN, 0) - NVL(receipt.TOTAL_OUT, 0) != 0
              )";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    $result = $this->db->single();

    if (!$result || !isset($result['TOTAL_ROWS'])) {
      return ['TOTAL_ROWS' => 0];
    }

    return $result;
  }

  public function getItemTidakTersedia() {
    $query = "SELECT COUNT(*) AS TOTAL_ROWS
              FROM (
                SELECT inventory.item_name, 
                        NVL(inventory.TOTAL_IN, 0) AS TOTAL_IN, 
                        NVL(receipt.TOTAL_OUT, 0) AS TOTAL_OUT
                FROM (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_IN
                  FROM i_master_item m
                  JOIN i_inventory i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_name
                ) inventory
                LEFT JOIN (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_OUT
                  FROM i_master_item m
                  JOIN i_receipt_item i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_name
                ) receipt ON inventory.item_name = receipt.item_name
              WHERE NVL(inventory.TOTAL_IN, 0) - NVL(receipt.TOTAL_OUT, 0) = 0
              )";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute(); 

    $result = $this->db->single();

    if (!$result || !isset($result['TOTAL_ROWS'])) {
      return ['TOTAL_ROWS' => 0];
    }

    return $result;
  }

  public function getTotalStockItem(){
    $query = "SELECT ITEM_ID, NVL(TOTAL_IN,0)-NVL(TOTAL_OUT,0) AS TOTAL
              FROM (
                SELECT inventory.item_id AS ITEM_ID, 
                      NVL(inventory.TOTAL_IN, 0) AS TOTAL_IN, 
                      NVL(receipt.TOTAL_OUT, 0) AS TOTAL_OUT
                FROM (
                  SELECT m.item_id, SUM(i.quantity) AS TOTAL_IN
                  FROM i_master_item m
                  JOIN i_inventory i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_id
                ) inventory
                LEFT JOIN (
                  SELECT m.item_id, SUM(i.quantity) AS TOTAL_OUT
                  FROM i_master_item m
                  JOIN i_receipt_item i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id 
                        AND i.store_id = :store_id
                  GROUP BY m.item_id
                ) receipt ON inventory.item_id = receipt.item_id
              )
              WHERE NVL(TOTAL_IN, 0) - NVL(TOTAL_OUT, 0) <= 5";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getStockNotification(){
    $query = "SELECT COUNT(*) AS TOTAL_NOTIFICATIONS
              FROM (
                SELECT inventory.item_name, 
                      NVL(inventory.TOTAL_IN, 0) AS TOTAL_IN, 
                      NVL(receipt.TOTAL_OUT, 0) AS TOTAL_OUT
                FROM (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_IN
                  FROM i_master_item m
                  JOIN i_inventory i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id   
                        AND i.store_id = :store_id  
                  GROUP BY m.item_name
                ) inventory
                LEFT JOIN (
                  SELECT m.item_name, SUM(i.quantity) AS TOTAL_OUT
                  FROM i_master_item m
                  JOIN i_receipt_item i ON m.item_id = i.item_id
                  WHERE m.is_deleted = 0 AND i.is_deleted = 0 
                        AND m.store_id = :store_id   
                        AND i.store_id = :store_id  
                  GROUP BY m.item_name
                ) receipt ON inventory.item_name = receipt.item_name
                WHERE NVL(inventory.TOTAL_IN, 0) - NVL(receipt.TOTAL_OUT, 0) <= 5
              )";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->single();
  }

  public function updateStatusInventory($data){
    $query = "UPDATE i_inventory SET status = 'Diterima' WHERE inventory_id = :inventory_id AND store_id = :store_id AND is_deleted = 0";
    $this->db->query($query);
    $this->db->bind('inventory_id', $data['inventory_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }
}

?>