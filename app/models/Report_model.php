<?php

class Report_model {
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  public function getMonthlyReport($dateBulan){
    $query =  "SELECT TO_CHAR(cd.DATE_ADDED, 'DD') AS hari, 
                          NVL(SUM(cd.total_price), 0) AS total_pemasukan,
                          NVL(SUM(cd.harga_beli * cd.quantity), 0) AS total_pengeluaran
                      FROM (
                          SELECT r.DATE_ADDED, r.total_price, NULL AS harga_beli, NULL AS quantity, r.store_id
                          FROM i_receipt r
                          WHERE TO_CHAR(r.DATE_ADDED, 'YYYY, MM') = :dateBulan
                            AND r.store_id = :store_id
                            AND r.is_deleted = 0
                          UNION ALL
                          SELECT i.DATE_ADDED, NULL AS total_price, i.harga_beli, i.quantity, i.store_id
                          FROM i_inventory i
                          WHERE TO_CHAR(i.DATE_ADDED, 'YYYY, MM') = :dateBulan
                            AND i.store_id = :store_id
                            AND i.is_deleted = 0
                      ) cd
                      GROUP BY TO_CHAR(cd.DATE_ADDED, 'DD')
                      ORDER BY TO_CHAR(cd.DATE_ADDED, 'DD')";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('dateBulan', $dateBulan);
    $this->db->execute();
    return $this->db->resultSet();
    
  }

  // HARIAN

  public function getReportHarian($dateHarian) {
		$query = "SELECT 
								NVL(TO_CHAR(pengeluaran.TANGGAL, 'YYYY-MM-DD'), TO_CHAR(pendapatan.TANGGAL, 'YYYY-MM-DD')) AS TANGGAL,
								NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS TOTAL_PENGELUARAN,
								NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) AS TOTAL_PENDAPATAN,
								NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) - NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS PROFIT
							FROM 
								( -- Pengeluaran Harian
									SELECT 
										i.date_added AS TANGGAL,
										SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
									FROM 
										I_INVENTORY i
									WHERE 
										i.IS_DELETED = 0 
										AND i.STORE_ID = :store_id
										AND TO_CHAR(i.date_added, 'YYYY-MM-DD') = :dateHarian
									GROUP BY 
										i.date_added
								) pengeluaran
							FULL OUTER JOIN 
								( -- Pendapatan Harian
									SELECT 
										r.time_added AS TANGGAL,
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
										AND TO_CHAR(r.time_added, 'YYYY-MM-DD') = :dateHarian
									GROUP BY 
										r.time_added
								) pendapatan
							ON 
								pengeluaran.TANGGAL = pendapatan.TANGGAL
							GROUP BY
								NVL(TO_CHAR(pengeluaran.TANGGAL, 'YYYY-MM-DD'), TO_CHAR(pendapatan.TANGGAL, 'YYYY-MM-DD'))";
								
		$this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('dateHarian', $dateHarian);
    $this->db->execute();

    $result = $this->db->single();
    if (!$result) {
      return [
        'TOTAL_PENGELUARAN' => 0,
        'TOTAL_PENDAPATAN' => 0,
        'PROFIT' => 0
      ];
    } else {
      return $result;
    }

	}

  // TAHUNAN

  public function getAvailableYears() {
    $query = "SELECT DISTINCT TO_CHAR(r.time_added, 'YYYY') AS TAHUN
              FROM I_RECEIPT_ITEM r
              WHERE r.IS_DELETED = 0
              AND r.STORE_ID = :store_id
              UNION
              SELECT DISTINCT TO_CHAR(i.date_added, 'YYYY') AS TAHUN
              FROM I_INVENTORY i
              WHERE i.IS_DELETED = 0
              AND i.STORE_ID = :store_id";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
	}

  public function getAvailableMonths(){
    $query = "SELECT DISTINCT TO_CHAR(r.time_added, 'MM') AS BULAN
              FROM I_RECEIPT_ITEM r
              WHERE r.IS_DELETED = 0
                AND r.STORE_ID = :store_id
              UNION
              SELECT DISTINCT TO_CHAR(i.date_added, 'MM') AS BULAN
              FROM I_INVENTORY i
              WHERE i.IS_DELETED = 0
                AND i.STORE_ID = :store_id
              ORDER BY BULAN";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getDailyPerMonths($month){
    $query = "SELECT 
                  h.HARI,
                  h.NAMA_HARI,
                  NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS TOTAL_PENGELUARAN,
                  NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) AS TOTAL_PENDAPATAN,
                  NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) - NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS PROFIT
              FROM HARIAN h
              LEFT JOIN (
                  SELECT 
                      EXTRACT(DAY FROM i.date_added) AS HARI,
                      SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
                  FROM I_INVENTORY i
                  WHERE i.IS_DELETED = 0
                    AND EXTRACT(MONTH FROM i.date_added) = :bulan
                  GROUP BY EXTRACT(DAY FROM i.date_added)
              ) pengeluaran ON h.HARI = pengeluaran.HARI
              LEFT JOIN (
                  SELECT 
                      EXTRACT(DAY FROM r.time_added) AS HARI,
                      SUM(r.QUANTITY * m.COST_PRICE) AS TOTAL_PENDAPATAN
                  FROM I_RECEIPT_ITEM r
                  JOIN I_MASTER_ITEM m ON r.ITEM_ID = m.ITEM_ID
                  WHERE r.IS_DELETED = 0 
                    AND m.IS_DELETED = 0
                    AND EXTRACT(MONTH FROM r.time_added) = :bulan
                  GROUP BY EXTRACT(DAY FROM r.time_added)
              ) pendapatan ON h.HARI = pendapatan.HARI
              GROUP BY h.HARI, h.NAMA_HARI
              ORDER BY h.HARI";

    $this->db->query($query);
    $this->db->bind('bulan', $month);
    $this->db->execute();
    return $this->db->resultSet();
  }


  public function getMonthlyPerYears($year) {
    $query = "WITH BULANAN AS (
                  SELECT LEVEL AS BULAN,
                        TO_CHAR(TO_DATE(LEVEL, 'MM'), 'Month') AS NAMA_BULAN
                  FROM DUAL
                  CONNECT BY LEVEL <= 12
              )
              SELECT 
                  b.BULAN,
                  b.NAMA_BULAN,
                  NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS TOTAL_PENGELUARAN,
                  NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) AS TOTAL_PENDAPATAN,
                  NVL(SUM(pendapatan.TOTAL_PENDAPATAN), 0) - NVL(SUM(pengeluaran.TOTAL_PENGELUARAN), 0) AS PROFIT
              FROM BULANAN b
              LEFT JOIN (
                  SELECT 
                      EXTRACT(MONTH FROM i.date_added) AS BULAN,
                      SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
                  FROM I_INVENTORY i
                  WHERE i.IS_DELETED = 0
                    AND EXTRACT(YEAR FROM i.date_added) = :tahun
                  GROUP BY EXTRACT(MONTH FROM i.date_added)
              ) pengeluaran ON b.BULAN = pengeluaran.BULAN
              LEFT JOIN (
                  SELECT 
                      EXTRACT(MONTH FROM r.time_added) AS BULAN,
                      SUM(r.QUANTITY * m.COST_PRICE) AS TOTAL_PENDAPATAN
                  FROM I_RECEIPT_ITEM r
                  JOIN I_MASTER_ITEM m ON r.ITEM_ID = m.ITEM_ID
                  WHERE r.IS_DELETED = 0 
                    AND m.IS_DELETED = 0
                    AND EXTRACT(YEAR FROM r.time_added) = :tahun
                  GROUP BY EXTRACT(MONTH FROM r.time_added)
              ) pendapatan ON b.BULAN = pendapatan.BULAN
              GROUP BY b.BULAN, b.NAMA_BULAN
              ORDER BY b.BULAN";

    $this->db->query($query);
    $this->db->bind('tahun', $year);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getTotalMonth($month) {
    $query = "SELECT 
                  COALESCE(pengeluaran.BULAN, pendapatan.BULAN) AS BULAN,
                  TO_CHAR(TO_DATE(COALESCE(pengeluaran.BULAN, pendapatan.BULAN), 'MM'), 'Month') AS NAMA_BULAN,
                  NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS TOTAL_PENGELUARAN,
                  NVL(pendapatan.TOTAL_PENDAPATAN, 0) AS TOTAL_PENDAPATAN,
                  NVL(pendapatan.TOTAL_PENDAPATAN, 0) - NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS PROFIT
              FROM 
                  ( -- Pengeluaran
                      SELECT 
                          TO_CHAR(i.date_added, 'MM') AS BULAN, 
                          SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
                      FROM 
                          I_INVENTORY i
                      WHERE 
                          i.IS_DELETED = 0 
                          AND i.STORE_ID = :store_id
                      GROUP BY 
                          TO_CHAR(i.date_added, 'MM')
                  ) pengeluaran
              FULL OUTER JOIN 
                  ( -- Pendapatan
                      SELECT 
                          TO_CHAR(r.time_added, 'MM') AS BULAN, 
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
                          TO_CHAR(r.time_added, 'MM')
                  ) pendapatan
              ON 
                  pengeluaran.BULAN = pendapatan.BULAN
              WHERE 
                  COALESCE(pengeluaran.BULAN, pendapatan.BULAN) = :bulan";
    $this->db->query($query);
    $this->db->bind('bulan', $month);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->single();
  }

  public function getTotalYear($year) {
    $query = "SELECT 
                COALESCE(pengeluaran.BULAN, pendapatan.BULAN) AS TAHUN,
                NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS TOTAL_PENGELUARAN,
                NVL(pendapatan.TOTAL_PENDAPATAN, 0) AS TOTAL_PENDAPATAN,
                NVL(pendapatan.TOTAL_PENDAPATAN, 0) - NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS PROFIT
              FROM 
                ( -- Pengeluaran
                  SELECT 
                    TO_CHAR(i.date_added, 'YYYY') AS BULAN, 
                    SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
                  FROM 
                    I_INVENTORY i
                  WHERE 
                    i.IS_DELETED = 0 
                    AND i.STORE_ID = :store_id
                  GROUP BY 
                    TO_CHAR(i.date_added, 'YYYY')
                ) pengeluaran
              FULL OUTER JOIN 
                ( -- Pendapatan
                  SELECT 
                    TO_CHAR(r.time_added, 'YYYY') AS BULAN, 
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
                    TO_CHAR(r.time_added, 'YYYY')
                ) pendapatan
              ON 
                pengeluaran.BULAN = pendapatan.BULAN
              WHERE 
                COALESCE(pengeluaran.BULAN, pendapatan.BULAN) = :tahun";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('tahun', $year);
    $this->db->execute();

    $result = $this->db->single();

    if (!$result) {
      return [
        'TOTAL_PENGELUARAN' => 0,
        'TOTAL_PENDAPATAN' => 0,
        'PROFIT' => 0
      ];
    } else {
      return $result;
    }
  }

}
?>