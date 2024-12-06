<?php

class Inventory extends Controller {
    public function __construct() {
        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }

	public function index($page = 1)
	{
		$data['judul'] = 'Inventory';
		$data['items'] = $this->model('Item_model')->getAllItem();
		$data['brand'] = $this->model('Item_model')->getAllBrand();
		$data['category'] = $this->model('Item_model')->getAllCategory();
		$data['inventory'] = $this->model('Item_model')->getAllInventory();
		$data['totalQty'] = $this->model('Item_model')->getAllTotalQuantity();
	
		$itemsPerPage = 10; // Jumlah item per halaman
		$totalItems = $this->model('Item_model')->getItemCount(); // Total item
		$totalPages = ceil($totalItems / $itemsPerPage); // Total halaman
		$start = ($page - 1) * $itemsPerPage; // Index awal data
	
		$data['item'] = $this->model('Item_model')->getPaginatedItems($start, $itemsPerPage);
		$data['currentPage'] = $page;
		$data['totalPages'] = $totalPages;
	
		$this->view('templates/s-header', $data);
		$this->view('inventory/index', $data);
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
			// Flasher::setFlash('berhasil', 'ditambahkan', 'success');
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

}	

