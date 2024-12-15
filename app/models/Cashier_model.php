<?php

class Cashier_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createIdReceipt() {
    // Simpan data ke dalam tabel i_receipt
    $this->db->query("INSERT INTO i_receipt (user_id, store_id) VALUES (:user_id, :store_id)");
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
  }

  public function setReceipt(){
    $this->db->query("SELECT receipt_id 
                      FROM i_receipt 
                      WHERE user_id = :user_id AND store_id = :store_id 
                      AND is_deleted = 0
                      ORDER BY time_added DESC 
                      FETCH FIRST 1 ROWS ONLY
                    ");
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $receipt = $this->db->single();

    // Simpan ID ke dalam session
    if ($receipt) {
        $_SESSION['receipt_id'] = $receipt['RECEIPT_ID'];
    } else {
        throw new Exception('Failed to retrieve receipt ID.');
    }
  }

  public function getItemByID($kodebarang) {
    $query = ('SELECT * FROM I_MASTER_ITEM I JOIN I_MASTER_CATEGORY C ON (I.CATEGORY_ID=C.CATEGORY_ID) JOIN I_MASTER_BRAND B USING (BRAND_ID) WHERE item_id = :kodebarang AND I.IS_DELETED = 0 AND I.STORE_ID = :store_id');

    // var_dump($kodebarang);

    $this->db->query($query);
    $this->db->bind('kodebarang', $kodebarang);
    $this->db->execute();

    return $this->db->single();
  }

  public function getAllReceiptItems(){
    $this->db->query("SELECT * FROM i_receipt_item ri JOIN i_master_item mi using (item_id) join i_master_category mc on (mi.category_id = mc.category_id) join i_master_brand mb on (mi.brand_id = mb.brand_id) WHERE receipt_id = :receipt_id AND ri.is_deleted = 0 AND ri.store_id = :store_id");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function checkItemRow(){
    $this->db->query("SELECT * FROM i_receipt_item WHERE receipt_id = :receipt_id AND is_deleted = 0");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->execute();
    return $this->db->fetchColumn();
  }

  public function CheckMaxQuantity($itemId) {
    $this->db->query("SELECT 
          NVL(i.TOTAL_IN, 0) - NVL(r.TOTAL_OUT, 0) AS STOCK_AVAILABLE
      FROM 
          I_MASTER_ITEM m
      LEFT JOIN (
          SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_IN
          FROM I_INVENTORY
          WHERE IS_DELETED = 0 AND STORE_ID = :store_id AND ITEM_ID = :item_id
          GROUP BY ITEM_ID
          ) i ON m.ITEM_ID = i.ITEM_ID
      LEFT JOIN (
          SELECT ITEM_ID, SUM(QUANTITY) AS TOTAL_OUT
          FROM I_RECEIPT_ITEM
          WHERE IS_DELETED = 0 AND STORE_ID = :store_id AND ITEM_ID = :item_id
          GROUP BY ITEM_ID
          ) r ON m.ITEM_ID = r.ITEM_ID
      WHERE 
          m.IS_DELETED = 0 AND m.STORE_ID = :store_id AND m.ITEM_ID = :item_id");

          $this->db->bind('item_id', $itemId);
          $this->db->bind('store_id', $_SESSION['store_id']);
    
          $this->db->execute();
    
    $result = $this->db->single();
    if ($result) {
        $totalQuantity = $result['STOCK_AVAILABLE'];
        return $totalQuantity;
    } else {
        return 0;
    }
}


  public function addItemToReceipt($itemId, $quantity) {
    $this->db->query("INSERT INTO i_receipt_item (receipt_id,total_per_item, item_id, quantity, store_id) VALUES (:receipt_id,(SELECT COST_PRICE FROM i_master_item WHERE item_id = :item_id ) , :item_id, :quantity, :store_id)");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->bind('item_id', $itemId);
    $this->db->bind('quantity', $quantity);
    $this->db->bind('store_id', $_SESSION['store_id']);
    return $this->db->execute();
  }

  public function getReceiptItems() {
    $this->db->query("SELECT * FROM i_receipt_item WHERE receipt_id = :receipt_id and is_deleted = 0");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function unsetReceipt(){
    // $this->db->query('UPDATE i_receipt SET is_deleted=1 WHERE receipt_id = :receipt_id AND is_deleted = 0 AND store_id = :store_id');
    // $this->db->bind('store_id', $_SESSION['store_id']);
    // $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    // $this->db->execute();
    $this->db->query('UPDATE i_receipt_item SET is_deleted=1 WHERE receipt_id = :receipt_id AND is_deleted = 0 AND store_id = :store_id');
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->execute();
  }

  public function removeItem($receiptItemID){
    $this->db->query('UPDATE i_receipt_item SET is_deleted=1 WHERE receipt_item_id = :receipt_item_id AND receipt_id = :receipt_id AND is_deleted = 0 AND store_id = :store_id');
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->bind('receipt_item_id', $receiptItemID);
    $this->db->execute();
  }

  public function checkRowSelectedItems(){
    $this->db->query("SELECT * FROM i_receipt_item WHERE receipt_id = :receipt_id AND is_deleted = 0");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->execute();
    return $this->db->fetchColumn();
  }

  public function getReceiptID(){
    $this->db->query('SELECT receipt_id FROM i_receipt ');
    $this->db->execute();
    return $this->db->single();
  }

  public function getAllReceipts() {
    $query = "SELECT * FROM i_receipt WHERE store_id = :store_id AND is_deleted = 0";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->resultSet();  // returns all receipts
}


  public function getReceiptDetails($receipt_id){
    $query = "SELECT * FROM i_master_category mc 
              join i_master_item mi using (category_id) 
              join i_receipt_item ri using (item_id) 
              join i_master_brand mb using (brand_id)
              WHERE ri.is_deleted = 0 AND ri.store_id = :store_id 
              AND ri.receipt_id = :receipt_id";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('receipt_id', $receipt_id);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function setTotalPrice($receipt_id){
    $query = "UPDATE i_receipt SET total_price = (SELECT SUM(quantity * total_per_item)
      FROM i_receipt_item where receipt_id= :receipt_id and store_id = :store_id and is_deleted = 0
      GROUP BY receipt_id) WHERE receipt_id = :receipt_id AND store_id = :store_id";
    $this->db->query($query);
    $this->db->bind('receipt_id', $receipt_id);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
  }

  public function getTotalPrice(){
    $query = "SELECT SUM(total_per_item * quantity) AS total_price 
              FROM i_receipt_item 
              WHERE is_deleted = 0 AND store_id = :store_id
              GROUP BY receipt_id";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->single();
  }

}

?>