<?php

Class Item extends Controller {
  public function index(){
    $data['judul'] = 'List Barang';
    $data['item'] = $this->model('Item_model')->getAllItem();

    $this->view('templates/header', $data);
    $this->view('itemdummy/index', $data);
    $this->view('templates/footer');
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