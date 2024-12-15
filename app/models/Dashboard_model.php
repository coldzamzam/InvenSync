<?php

class Dashboard_model {
  private $db;

  public function __construct() {
		$this->db = new Database;
  }

	public function dateToday() {
		$query = "SELECT TO_CHAR(SYSDATE, 'Dy, DD Month YYYY') AS \"DATE\" FROM DUAL";
		$this->db->query($query);
		$this->db->execute();
		return $this->db->single();
	}
	
	public function getNamaToko() {
		$query = "SELECT store_name FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0";
		$this->db->query($query);
		$this->db->bind('owner_id', $_SESSION['user_id']);
		$this->db->execute();
		return $this->db->single();
	}

  public function getPengeluaranPendapatan() {
		$query = "SELECT 
						COALESCE(pengeluaran.BULAN, pendapatan.BULAN) AS BULAN,
						NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS TOTAL_PENGELUARAN,
						NVL(pendapatan.TOTAL_PENDAPATAN, 0) AS TOTAL_PENDAPATAN,
						NVL(pendapatan.TOTAL_PENDAPATAN, 0) - NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS PROFIT
					FROM 
						( -- Pengeluaran
							SELECT 
								TO_CHAR(i.date_added, 'MON YY') AS BULAN, 
								SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
							FROM 
								I_INVENTORY i
							WHERE 
								i.IS_DELETED = 0 and i.STORE_ID = :store_id
							GROUP BY 
								TO_CHAR(i.date_added, 'MON YY')
						) pengeluaran
					FULL OUTER JOIN 
						( -- Pendapatan
							SELECT 
								TO_CHAR(r.time_added, 'MON YY') AS BULAN, 
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
								TO_CHAR(r.time_added, 'MON YY')
						) pendapatan
					ON 
						pengeluaran.BULAN = pendapatan.BULAN
					ORDER BY 
						TO_DATE(COALESCE(pengeluaran.BULAN, pendapatan.BULAN), 'MON YY')";
		$this->db->query($query);
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();

		return $this->db->resultSet();
  }

  public function getInventoryUserCount(){
		$this->db->query("SELECT COUNT(*) as total FROM i_users WHERE role = 'Admin Gudang' AND is_deleted = 0 AND store_id = :store_id");
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();
		return $this->db->single()['TOTAL'];
  }
  
  public function getCashierUserCount(){
		$this->db->query("SELECT COUNT(*) as total FROM i_users WHERE role = 'Admin Kasir' AND is_deleted = 0 AND store_id = :store_id");
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();
		return $this->db->single()['TOTAL'];
  }

  public function getTotalSoldItemThisMonth() {
		$query = "SELECT NVL(SUM(quantity), 0) AS TOTAL_SOLD, to_char(time_added, 'Month') AS MONTH
							FROM i_receipt_item
							WHERE to_char(time_added, 'Month, YY') = to_char(SYSDATE, 'Month, YY') AND is_deleted = 0 AND store_id = :store_id
							GROUP BY to_char(time_added, 'Month')";

		$this->db->query($query);
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();

		return $this->db->single();
  }

	public function getRevenueThisMonth() {
		$query = "SELECT 
								COALESCE(pengeluaran.BULAN, pendapatan.BULAN) AS BULAN,
								NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS TOTAL_PENGELUARAN,
								NVL(pendapatan.TOTAL_PENDAPATAN, 0) AS TOTAL_PENDAPATAN,
								NVL(pendapatan.TOTAL_PENDAPATAN, 0) - NVL(pengeluaran.TOTAL_PENGELUARAN, 0) AS PROFIT
							FROM 
								( -- Pengeluaran
										SELECT 
												TRIM(TO_CHAR(i.date_added, 'Month')) AS BULAN, 
												SUM(i.QUANTITY * i.HARGA_BELI) AS TOTAL_PENGELUARAN
										FROM 
												I_INVENTORY i
										WHERE 
												i.IS_DELETED = 0 
												AND i.STORE_ID = :store_id
										GROUP BY 
												TRIM(TO_CHAR(i.date_added, 'Month'))
								) pengeluaran
							FULL OUTER JOIN 
								( -- Pendapatan
										SELECT 
												TRIM(TO_CHAR(r.time_added, 'Month')) AS BULAN, 
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
												TRIM(TO_CHAR(r.time_added, 'Month'))
								) pendapatan
							ON 
								pengeluaran.BULAN = pendapatan.BULAN
							WHERE
								COALESCE(pengeluaran.BULAN, pendapatan.BULAN) = TRIM(TO_CHAR(SYSDATE, 'Month'))";

		$this->db->query($query);
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();

		return $this->db->single();
	}

	public function getTotalInventory() {
    $query = "SELECT to_char(date_added, 'Mon YY') AS BULAN, NVL(SUM(quantity), 0) AS TOTAL_INVENTORY
              FROM i_inventory
              WHERE to_char(date_added, 'Mon YY') = to_char(SYSDATE, 'Mon YY') AND is_deleted = 0 AND store_id = :store_id
              GROUP BY to_char(date_added, 'Mon YY')";

    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();

    return $this->db->single();
  }

	public function getProdukTerlaris() {
		$query = "SELECT ri.item_id, i.item_name, b.brand_name,
										NVL(SUM(ri.quantity), 0) AS total_quantity
							FROM i_receipt_item ri
							join i_master_item i on i.item_id = ri.item_id
							join i_master_brand b on b.brand_id = i.brand_id
							WHERE TO_CHAR(ri.time_added, 'MM') = TO_CHAR(SYSDATE, 'MM') AND ri.is_deleted = 0 AND ri.store_id = :store_id
							GROUP BY ri.item_id, i.item_name, b.brand_name
							ORDER BY total_quantity DESC
							FETCH FIRST 1 ROWS ONLY";

		$this->db->query($query);
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();

		return $this->db->single();
	}

	public function getProdukKurangLaris() {
		$query = "SELECT ri.item_id, i.item_name, b.brand_name,
										NVL(SUM(ri.quantity), 0) AS total_quantity
							FROM i_receipt_item ri
							join i_master_item i on i.item_id = ri.item_id
							join i_master_brand b on b.brand_id = i.brand_id
							WHERE TO_CHAR(ri.time_added, 'MM') = TO_CHAR(SYSDATE, 'MM') AND ri.is_deleted = 0 AND ri.store_id = :store_id
							GROUP BY ri.item_id, i.item_name, b.brand_name
							ORDER BY total_quantity ASC
							FETCH FIRST 1 ROWS ONLY";

		$this->db->query($query);
		$this->db->bind('store_id', $_SESSION['store_id']);
		$this->db->execute();

		return $this->db->single();
	}

}

?>