<?php

class Monthlyreport extends Controller {
    public function __construct() {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }

    public function index() {
        $data['judul'] = 'Monthlyreport';
        $this->view('templates/s-header', $data);
        $this->view('monthlyreport/index', $data);
    }
}
