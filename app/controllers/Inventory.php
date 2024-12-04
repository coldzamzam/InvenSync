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
			$this->view('templates/s-header', $data);
			$this->view('user/toko', $data);
		}
	}
	
	public function tambah() {
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
}	

