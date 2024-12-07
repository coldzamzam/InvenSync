<?php

class Transaction extends Controller
{
    public function __construct()
    {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }
    public function index(){
        $data['judul'] = 'Transaction';
        $data['receiptDetails'] = $this->model('Cashier_model')->getReceiptDetails();
        $this->view('templates/s-header', $data);
        $this->view('transaction/index', $data);
    }


}