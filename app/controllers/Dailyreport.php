<?php

    class Dailyreport extends Controller {
        public function __construct(){
            if ( !isset($_SESSION['is_login']) ) {
              header('Location: ' . BASEURL . '/user/login');
            }
          }
       
        public function index(){
            $data['judul'] = 'Daily Report';
            if($this->model('User_model')->checkRowToko() > 0) {
              $this->view('templates/s-header', $data);
              $this->view('dailyreport/index', $data);
            }
            else {
              $this->view('templates/s-header', $data);
              $this->view('user/toko', $data);
            }    
        }     
    }     