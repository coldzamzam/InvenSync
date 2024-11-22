<?php

class Inventory extends Controller {
	public function __construct() {
		if ( !isset($_SESSION['is_login']) ) {
			header('Location: ' . BASEURL . '/user/index');
		}
	}

	public function index() {
		$data['judul'] = 'Inventory';
		$data['item'] = $this->model('Item_model')->getAllItem();
		$this->view('templates/s-header', $data);
		$this->view('inventory/index', $data);
	}
}