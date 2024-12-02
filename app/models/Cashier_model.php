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
    $receipt =$this->db->single();

    $_SESSION['receipt_id'] = $receipt['RECEIPT_ID'];
    
    return $this->db->rowCount();
  }

  public function firstReceiptItem() {
    $this->db->query("INSERT INTO i_receipt_item (receipt_id, item_id, quantity) VALUES (:receipt_id, :item_id, :quantity)");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->bind('item_id', $_POST['kodebarang']);
    $this->db->bind('quantity', $_POST['jumlahbarang']);
    return $this->db->execute();
  }

  public function checkItemRow(){
    $this->db->query("SELECT * FROM i_receipt_item WHERE receipt_id = :receipt_id");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->execute();
    return $this->db->fetchColumn();
  }

  public function addItemToReceipt($itemId, $quantity) {
    $this->db->query("INSERT INTO i_receipt_item (receipt_id, item_id, quantity) VALUES (:receipt_id, :item_id, :quantity)");
    $this->db->bind('receipt_id', $_SESSION['receipt_id']);
    $this->db->bind('item_id', $itemId);
    $this->db->bind('quantity', $quantity);
    return $this->db->execute();
  }

  // public function createReceipt($totalPrice) {
  //   $this->db->query("INSERT INTO i_receipt (DATE_ADDED, TOTAL_PRICE, USER_ID) 
  //                     VALUES (CURRENT_TIMESTAMP, :total_price, :user_id)");
  //   $this->db->bind('total_price', $totalPrice);
  //   $this->db->bind('user_id', $_SESSION['user_id']);
  //   $this->db->execute();

  //   // Mengembalikan RECEIPT_ID
  //   return $this->db->lastInsertId();
  // }

  // // Tambahkan item ke i_receipt_item
  // public function addReceiptItem($receiptId, $itemId, $quantity, $totalItem) {
  //   $this->db->query("INSERT INTO i_receipt_item (RECEIPT_ID, ITEM_ID, QUANTITY, TOTAL_ITEM) 
  //                     VALUES (:receipt_id, :item_id, :quantity, :total_item)");
  //   $this->db->bind('receipt_id', $receiptId);
  //   $this->db->bind('item_id', $itemId);
  //   $this->db->bind('quantity', $quantity);
  //   $this->db->bind('total_item', $totalItem);
  //   return $this->db->execute();
  // }

  // // Kurangi stok barang di i_inventory
  // public function reduceStock($itemId, $quantity) {
  //   $this->db->query("UPDATE i_inventory SET STOCK = STOCK - :quantity WHERE ITEM_ID = :item_id");
  //   $this->db->bind('quantity', $quantity);
  //   $this->db->bind('item_id', $itemId);
  //   return $this->db->execute();
  // }
}

?>