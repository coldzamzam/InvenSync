<?php

Class Dashboard extends Controller{

  public function __construct(){
    if ( !isset($_SESSION['is_login']) ) {
      header('Location: ' . BASEURL . '/user/login');
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
      'judul' => 'Dashboard'
    ];

    $userInventory = (int)$this->model('Dashboard_Model')->getInventoryUserCount();
    $userCashier = (int)$this->model('Dashboard_Model')->getCashierUserCount();
    $adminChartData=[
      ['Role', 'Jumlah'],
      ['Admin Gudang', (int)$userInventory], 
      ['Admin Kasir', (int)$userCashier]
    ];
    
    $data['adminChartData'] = $adminChartData;
    $data['chartPenghasilan'] = $this->model('Dashboard_model')->getPengeluaranPendapatan(); 
    $data['totalSoldItem'] = $this->model('Dashboard_model')->getTotalSoldItemThisMonth();
    $data['revenue'] = $this->model('Dashboard_model')->getRevenueThisMonth();
    $data['today'] = $this->model('Dashboard_model')->dateToday();
    $data['availInventory'] = $this->model('Dashboard_model')->getTotalInventory();
    $data['produkTerlaris'] = $this->model('Dashboard_model')->getProdukTerlaris();
    $data['produkKurangLaris'] = $this->model('Dashboard_model')->getProdukKurangLaris();


    if($this->model('User_model')->checkRowToko() > 0) {
      $this->view('templates/s-header', $data);
      $this->view('dashboard/index', $data);
    }
    else {
      $this->view('templates/s-header', $data);
      $this->view('user/toko', $data);
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
      header('Location: ' . BASEURL . '/home');
    }
  }
}

?>