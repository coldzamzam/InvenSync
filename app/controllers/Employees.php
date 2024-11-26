<?php

class Employees extends Controller{
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
        header('Location: ' . BASEURL . '/user/index');
        }
    }

    public function index(){
        $data['judul'] = 'Employees';
        $data['users'] = $this->model('Item_model')->getAllUser();
        // $data['invusers'] = $this->model('Item_model')->getInventoryUser();
        // $data['cashusers'] = $this->model('Item_model')->getCashierUser();
        $this->view('templates/s-header', $data);
        $this->view('employees/index', $data);
    }

    public function createEmployee() {
        $data=[
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? '',
            'address' => $_POST['address'] ?? '',
            'phonenumber' => $_POST['phonenumber'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];
        if ($this->model('User_model')->daftarAdmin($data) > 0) {
            header('Location: ' . BASEURL . '/employees');
            exit;
        } else {
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
}
