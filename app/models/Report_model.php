<?php

class Report_model {
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  public function getMonthlyReport(){
    $query =  "SELECT TO_CHAR(cd.DATE_ADDED, 'DD') AS hari, 
                          SUM(cd.total_price) AS total_pemasukan,
                          SUM(cd.harga_beli * cd.quantity) AS total_pengeluaran
                      FROM (
                          SELECT r.DATE_ADDED, r.total_price, NULL AS harga_beli, NULL AS quantity, r.store_id
                          FROM i_receipt r
                          WHERE TO_CHAR(r.DATE_ADDED, 'MM') = TO_CHAR(SYSDATE, 'MM')
                            AND TO_CHAR(r.DATE_ADDED, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
                            AND r.store_id = :store_id
                            AND r.is_deleted = 0
                          UNION ALL
                          SELECT i.DATE_ADDED, NULL AS total_price, i.harga_beli, i.quantity, i.store_id
                          FROM i_inventory i
                          WHERE TO_CHAR(i.DATE_ADDED, 'MM') = TO_CHAR(SYSDATE, 'MM')
                            AND TO_CHAR(i.DATE_ADDED, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
                            AND i.store_id = :store_id
                            AND i.is_deleted = 0
                      ) cd
                      GROUP BY TO_CHAR(cd.DATE_ADDED, 'DD')
                      ORDER BY TO_CHAR(cd.DATE_ADDED, 'DD')";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
    
  }

}
?>