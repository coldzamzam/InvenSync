<?php

Class Item extends Controller {
  public function index(){
    $data['judul'] = 'List Items';
    $data['item'] = $this->model('Item_model')->getAllItem();
    $data['brand'] = $this->model('Item_model')->getAllBrand();
    $data['category'] = $this->model('Item_model')->getAllCategory();

    $this->view('templates/s-header', $data);
    $this->view('itemdummy/index', $data);
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