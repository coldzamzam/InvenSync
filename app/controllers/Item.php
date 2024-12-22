<?php

Class Item extends Controller {

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
  public function index($page = 1){
    $data = [
        'judul' => 'List Barang',
        'brandError' => '',
        'categoryError' => ''
    ];

    // Define how many items per page
    $itemsPerPage = 5;
    
    // Get the total number of items
    $totalItems = $this->model('Item_model')->getItemCount();  // You need to create this method in the Item_model
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Determine the starting point for pagination
    $start = ($page - 1) * $itemsPerPage;

    // Fetch the items for the current page
    $data['item'] = $this->model('Item_model')->getPaginatedItems($start, $itemsPerPage);  // You need to create this method in the Item_model

    // Other data
    $data['brand'] = $this->model('Item_model')->getAllBrand();
    $data['category'] = $this->model('Item_model')->getAllCategory();
    $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
    $data['notifications'] = $this->model('Item_model')->getTotalStockItem();

    // Pagination data
    $data['currentPage'] = $page;
    $data['totalPages'] = $totalPages;

    if($this->model('User_model')->checkRowToko() > 0) {
        $this->view('templates/s-header', $data);
        $this->view('itemdummy/index', $data);
    } else {
        header('Location: ' . BASEURL . '/dashboard/toko');
    }
}


  public function userdummy(){
    $data['judul'] = 'List User';
    $data['item'] = $this->model('Item_model')->getAllUser();

    $this->view('templates/header', $data);
    $this->view('itemdummy/index', $data);
    $this->view('templates/footer');
  }

}

?>