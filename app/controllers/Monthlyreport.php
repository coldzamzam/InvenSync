<?php

class Monthlyreport extends Controller {
    public function __construct() {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }

    public function index() {
        $data['judul'] = 'Laporan Harian';
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
        $data['notifications'] = $this->model('Item_model')->getTotalStockItem();
        $data['monthlyChartData'] = $this->model('Report_model')->getMonthlyReport();
        // var_dump($data['monthlyChartData']);  // Debug output
        // exit;
        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('monthlyreport/index', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }    

    }

    public function bulan() {
        $data['judul'] = 'Laporan Bulanan';
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];

        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('monthlyreport/bulan', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }    
    }

    public function tahun() {
        $data['judul'] = 'Laporan Tahunan';
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];

        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('monthlyreport/tahun', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }    
    }
}
