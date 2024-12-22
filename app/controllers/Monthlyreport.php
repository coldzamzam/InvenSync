<?php

class Monthlyreport extends Controller {
    public function __construct() {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }

    public function index() {
        $data['judul'] = 'Laporan';
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
}
