<?php

    class Dailyreport extends Controller {
        public function __construct(){
            if ( !isset($_SESSION['is_login']) ) {
              header('Location: ' . BASEURL . '/user/login');
            }
          }
       
        public function index(){
            $data['judul'] = 'Daily Report';
            $this->view('templates/s-header', $data);
            $this->view('dailyreport/index', $data);    
        }     
    }     