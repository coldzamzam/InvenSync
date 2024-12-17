<?php

class Monthlyreport extends Controller {
    public function __construct() {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }

    public function index() {
        $data['judul'] = 'Laporan Bulanan';
        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('monthlyreport/index', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }    
    }
}
