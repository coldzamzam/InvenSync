<?php
class Cashier extends Controller {
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
          header('Location: ' . BASEURL . '/user/login');
        }
      }

    public function index(){
        $data['judul'] = 'Cashier';
        $this->view('templates/s-header', $data);
        $this->view('cashier/index', $data);
    }
}
