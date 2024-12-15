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
  public function index(){
    $data = [
      'judul' => 'List Items',
      'brandError'=>'',
      'categoryError'=>''
    ];
    $data['item'] = $this->model('Item_model')->getAllItem();
    $data['brand'] = $this->model('Item_model')->getAllBrand();
    $data['category'] = $this->model('Item_model')->getAllCategory();

    if($this->model('User_model')->checkRowToko() > 0) {
      $this->view('templates/s-header', $data);
      $this->view('itemdummy/index', $data);
  }
  else {
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