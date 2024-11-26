<?php

Class Dashboard extends Controller{

  public function __construct(){
    if ( !isset($_SESSION['is_login']) ) {
      header('Location: ' . BASEURL . '/user/index');
    }
  }
  
  public function index(){
    $data['judul'] = 'Dashboard';
    // $data['users'] = $this->model('Item_model')->getUserById($id);

    $this->view('templates/s-header', $data);
    $this->view('dashboard/index', $data);
  }
  
  public function toko() {
    $data['judul'] = 'Profile Toko';
    $this->view('templates/s-header', $data);
    $this->view('user/toko', $data);
  }

  public function employees(){
    $data['judul'] = 'Dashboard';
    $data['users'] = $this->model('Item_model')->getAllUser();
    $this->view('templates/s-header', $data);
    $this->view('dashboard/employees', $data);
  }

  public function inventory(){
    $data['judul'] = 'Inventaris';
    $data['item'] = $this->model('Item_model')->getAllItem();
    $this->view('templates/s-header', $data);
    $this->view('dashboard/inventory', $data);
  }

  public function troublesome(){
    $data['judul'] = 'Troublesome Items';
    $this->view('templates/s-header', $data);
    $this->view('dashboard/troublesome');
  }

  public function dailyreport(){  
    $data['judul'] = 'Daily Report';
    $this->view('templates/s-header', $data);
    $this->view('dashboard/dailyreport');
  }

  public function monthlyreport(){  
    $data['judul'] = 'Monthly Report';
    $this->view('templates/s-header', $data);
    $this->view('dashboard/monthlyreport');
  }

  public function cashier(){  
    $data['judul'] = 'Cashier';
    $this->view('templates/s-header', $data);
    $this->view('dashboard/cashier');
  }



  public function logout(){
    if(isset($_POST['logout'])){
      session_unset();
      session_destroy();
      header('Location: ' . BASEURL . '/user/index');
    }
  }
}

?>