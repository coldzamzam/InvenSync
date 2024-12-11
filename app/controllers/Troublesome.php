<?php

class Troublesome extends Controller
{
    public function __construct()
    {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }
    public function index()
    {
        $data['judul'] = 'Troublesome Items';
        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('troublesome/index', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }    
    }
}