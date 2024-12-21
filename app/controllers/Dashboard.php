<?php

Class Dashboard extends Controller{

  public function __construct(){
    if ( !isset($_SESSION['is_login']) ) {
      header('Location: ' . BASEURL . '/user/login');
    }
    if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
      if($_SESSION['user_role'] == 'Pemilik') {
          $_SESSION['status'] = 'ownerDeleted';
      } else {
          $_SESSION['status'] = 'employeeDeleted';
        }
      }
    }
  
  public function index(){
    $data = [
      'namatokoError' => '',
      'tipetokoError' => '',
      'lokasiError' => '',
      'telepontokoError' => '',
      'emailtokoError' => '',
      'yearfoundedError' => '',
      'owner_id' => $_SESSION['user_id'],
      'namatoko'=> $_POST['namatoko'] ?? '',
      'tipetoko'=> $_POST['tipetoko'] ?? '',
      'lokasi'=> $_POST['lokasi'] ?? '',
      'telepontoko'=> $_POST['telepontoko'] ?? '',
      'emailtoko'=> $_POST['emailtoko'] ?? '',
      'yearfounded'=> $_POST['yearfounded'] ?? '',
      'judul' => 'Halaman Utama',
      'totalnotifications' => $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'],
      'notifications' => $this->model('Item_model')->getTotalStockItem()
    ];

    $userInventory = (int)$this->model('Dashboard_Model')->getInventoryUserCount();
    $userCashier = (int)$this->model('Dashboard_Model')->getCashierUserCount();
    $adminChartData=[
      ['Role', 'Jumlah'],
      ['Admin Gudang', (int)$userInventory], 
      ['Admin Kasir', (int)$userCashier]
    ];
    
    $data['adminChartData'] = $adminChartData;
    if ($userInventory == 0 && $userCashier == 0) {
      $data['adminKosong'] = true ;
    } else {
      $data['adminKosong'] = false ;
    }

    $data['chartPenghasilan'] = $this->model('Dashboard_model')->getPengeluaranPendapatan(); 
    if ($data['chartPenghasilan'] == null) {
      $data['penghasilanKosong'] = true ;
    } else {
      $data['penghasilanKosong'] = false ;
    }

    $data['revenue'] = $this->model('Dashboard_model')->getRevenueThisMonth();

    if ($data['revenue'] == null) {
      $data['revenueKosong'] = true ;
    } else {
      $data['revenueKosong'] = false ;
    }

    $data['totalSoldItem'] = $this->model('Dashboard_model')->getTotalSoldItemThisMonth();
    $data['today'] = $this->model('Dashboard_model')->dateToday();
    $data['availInventory'] = $this->model('Dashboard_model')->getTotalInventory();
    $data['produkTerlaris'] = $this->model('Dashboard_model')->getProdukTerlaris();
    $data['produkKurangLaris'] = $this->model('Dashboard_model')->getProdukKurangLaris();

    if ($data['produkTerlaris'] == null) {
      $data['produkTerlarisKosong'] = true ;
    } else {
      $data['produkTerlarisKosong'] = false ;
    }

    if ($data['produkKurangLaris'] == null) {
      $data['produkKurangLarisKosong'] = true ;
    } else {
      $data['produkKurangLarisKosong'] = false ;
    }


    if($this->model('User_model')->checkRowToko() > 0) {
      $this->view('templates/s-header', $data);
      $this->view('dashboard/index', $data);
    }
    else {
      $this->view('templates/s-header', $data);
      $this->view('user/toko', $data);
    }
    if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
      if($_SESSION['user_role'] == 'Owner') {
        $data['status'] = 'ownerDeleted';
      } else{
        $data['status'] = 'employeeDeleted';
      }
    }
    // $data['users'] = $this->model('Item_model')->getUserById($id);

    // $this->view('templates/s-header', $data);
    // $this->view('dashboard/index', $data);

    //chart employee

  }
  
  public function toko() {
    $data = [
        'namatokoError' => '',
        'tipetokoError' => '',
        'lokasiError' => '',
        'telepontokoError' => '',
        'emailtokoError' => '',
        'yearfoundedError' => '',
        'judul' => 'Profile Toko',
        'owner_id' => $_SESSION['user_id'],
        'namatoko'=> $_POST['namatoko'] ?? '',
        'tipetoko'=> $_POST['tipetoko'] ?? '',
        'lokasi'=> $_POST['lokasi'] ?? '',
        'telepontoko'=> $_POST['telepontoko'] ?? '',
        'emailtoko'=> $_POST['emailtoko'] ?? '',
        'yearfounded'=> $_POST['yearfounded'] ?? '',
        'totalnotifications' => $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'],
        'notifications' => $this->model('Item_model')->getTotalStockItem()
    ];

    $storeInfo = $this->model('User_model')->getStoreInfo();

    if ($storeInfo) {
        $data['namatoko'] = $storeInfo['STORE_NAME'];
        $data['tipetoko'] = $storeInfo['STORE_TYPE'];
        $data['lokasi'] = $storeInfo['LOCATION'];
        $data['telepontoko'] = $storeInfo['PHONE_NUMBER'];
        $data['emailtoko'] = $storeInfo['EMAIL'];
        $data['yearfounded'] = $storeInfo['YEAR_FOUNDED'];

        $this->view('templates/s-header', $data);
        $this->view('user/tokoinfo', $data);
        return;
    }

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

  public function logout(){
    if(isset($_POST['logout'])){
      session_unset();
      session_destroy();
      header('Location: ' . BASEURL . '/home');
    }
  }
}

?>