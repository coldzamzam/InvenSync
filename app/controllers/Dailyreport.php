<?php

    class Dailyreport extends Controller {
        public function __construct(){
            if ( !isset($_SESSION['is_login']) ) {
              header('Location: ' . BASEURL . '/user/login');
            }
            if ($_SESSION['user_role'] != 'Owner') {
              header('Location: ' . BASEURL . '/dashboard');          
            }
          }

        public function index(){
            $data['judul'] = 'Laporan Harian';
            $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
            $data['notifications'] = $this->model('Item_model')->getTotalStockItem();
            if($this->model('User_model')->checkRowToko() > 0) {
              $this->view('templates/s-header', $data);
              $this->view('dailyreport/index', $data);
          }
          else {
            header('Location: ' . BASEURL . '/dashboard/toko');
          }        }     
    }     