<?php

class Dashboard_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getPengeluaranPendapatan() {
    $query = "SELECT 
                  COALESCE(pengeluaran.BULAN, pendapatan.BULAN) AS BULAN,
                  NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS TOTAL_PENGELUARAN,
                  NVL(pendapatan.TOTAL_PENDAPATAN, 0) AS TOTAL_PENDAPATAN
              FROM 
                  ( -- Pengeluaran
                      SELECT 
                          TO_CHAR(i.date_added, 'Month') AS BULAN, 
                          SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
                      FROM 
                          I_INVENTORY i
                      WHERE 
                          i.IS_DELETED = 0 and i.STORE_ID = :store_id
                      GROUP BY 
                          TO_CHAR(i.date_added, 'Month')
                  ) pengeluaran
              FULL OUTER JOIN 
                  ( -- Pendapatan
                      SELECT 
                          TO_CHAR(r.time_added, 'Month') AS BULAN, 
                          SUM(r.QUANTITY * m.COST_PRICE) AS TOTAL_PENDAPATAN
                      FROM 
                          I_RECEIPT_ITEM r
                      JOIN 
                          I_MASTER_ITEM m ON r.ITEM_ID = m.ITEM_ID
                      WHERE 
                          r.IS_DELETED = 0 
                          AND m.IS_DELETED = 0
                          AND r.STORE_ID = :store_id
                          AND m.STORE_ID = :store_id
                      GROUP BY 
                          TO_CHAR(r.time_added, 'Month')
                  ) pendapatan
              ON 
                  pengeluaran.BULAN = pendapatan.BULAN
              ORDER BY 
                  TO_DATE(COALESCE(pengeluaran.BULAN, pendapatan.BULAN), 'Month')";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->resultSet();
  }
}

?>