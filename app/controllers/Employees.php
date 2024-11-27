<?php

class Employees extends Controller{
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
        header('Location: ' . BASEURL . '/user/index');
        }
    }

    public function index($page=1){
        $data['judul'] = 'Employees';
        $data['users'] = $this->model('Item_model')->getAllUser();
        // $data['invusers'] = $this->model('Item_model')->getInventoryUser();
        // $data['cashusers'] = $this->model('Item_model')->getCashierUser();
        $usersperpage = 5;
        $totalusers = $this->model('Item_model')->getUserCount();
        $totalpages = ceil($totalusers / $usersperpage);
        $start = ($page - 1) * $usersperpage;
        $data['users'] = $this->model('Item_model')->getPaginatedUsers($start, $usersperpage);
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalpages;

        $this->view('templates/s-header', $data);
        $this->view('employees/index', $data);
    }

    public function createEmployee() {
        if ($this->model('User_model')->daftarAdmin($data) > 0) {
            $_SESSION['status']='success';
        } else {
            $_SESSION['status']='error';
        }
        header('Location: ' . BASEURL . '/employees');
        exit;
    }
}
