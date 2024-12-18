<?php

class Inventory extends Controller {
    public function __construct() {
        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/user/login');
        }
		if ($_SESSION['user_role'] != 'Owner' && $_SESSION['user_role'] != 'Admin Gudang') {
			header('Location: ' . BASEURL . '/dashboard');
		}
		if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
			header('Location: ' . BASEURL . '/dashboard');
		}
    }

	public function index($page = 1)
	{
		$data['judul'] = 'Inventaris';
		$data['items'] = $this->model('Item_model')->getAllItem();
		$data['brand'] = $this->model('Item_model')->getAllBrand();
		$data['category'] = $this->model('Item_model')->getAllCategory();
		$data['inventory'] = $this->model('Item_model')->getAllInventory();
		if (isset($data['inventory']['STATUS']) == 'Pending') {
			$data['warnaStatus'] = true;
		} else {
			$data['warnaStatus'] = false;
		}

		$data['totalQty'] = $this->model('Item_model')->getAllTotalQuantity();
		// $stock = (int)$data['totalQty']['STOCK_AVAILABLE'];
		// if ($stock > 5) {
		// 	$data['warnaQty'] = 'tersedia';
		// } elseif ($stock <= 5) {
		// 	$data['warnaQty'] = 'hampirHabis';
		// } else {
		// 	$data['warnaQty'] = 'habis';
		// }
			
		

		$data['totalStok'] = $this->model('Item_model')->getItemTersedia();
		$data['hampirHabis'] = $this->model('Item_model')->getItemHampirHabis();
		$data['tidakTersedia'] = $this->model('Item_model')->getItemTidakTersedia();
	
		$itemsPerPage = 10; // Jumlah item per halaman
		$totalItems = $this->model('Item_model')->getItemCount(); // Total item
		$totalPages = ceil($totalItems / $itemsPerPage); // Total halaman
		$start = ($page - 1) * $itemsPerPage; // Index awal data
	
		$data['item'] = $this->model('Item_model')->getPaginatedItems($start, $itemsPerPage);
		$data['currentPage'] = $page;
		$data['totalPages'] = $totalPages;
	
        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('inventory/index', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }	
	}
	
	public function tambahInventory() {
		if ($this->model('Item_model')->addInventory($_POST) > 0) {
			// Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: ' . BASEURL . '/inventory');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/inventory');
			exit;
		}
	}

	public function tambahBrand() {
		if ($this->model('Item_model')->addBrand($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambahkan','tutup', 'success');
			header('Location: ' . BASEURL . '/Item');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/Item');
			exit;
		}
	}

	public function tambahCategory() {
		if ($this->model('Item_model')->addCategory($_POST) > 0) {
			// Flasher::setFlash('berhasil', 'ditambahkan', 'success');			
			header('Location: ' . BASEURL . '/Item');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/Item');
			exit;
		}
	}

	public function tambahItem() {
		if ($this->model('Item_model')->addItem($_POST) > 0) {
			// Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: ' . BASEURL . '/Item');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/Item');
			exit;
		}
	}

	public function updateStatus() {
		if ($this->model('Item_model')->updateStatusInventory($_POST) > 0) {
			// Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location: ' . BASEURL . '/Inventory');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/Inventory');
			exit;
		}
	}

}	

