<?php

class Employees extends Controller{
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
        header('Location: ' . BASEURL . '/user/index');
        }
    }

    public function index($page=1){
        $data['judul'] = 'Employees';
        $data['users'] = $this->model('Item_model')->getUserStore();
        // $data['invusers'] = $this->model('Item_model')->getInventoryUser();
        // $data['cashusers'] = $this->model('Item_model')->getCashierUser();
        $usersperpage = 10;
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
        $data = [
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? '',
            'address' => $_POST['address'] ?? '',
            'phonenumber' => $_POST['phonenumber'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'nameError' => '',
            'roleError' => '',
            'addressError' => '',
            'phonenumberError' => '',
            'emailError' => '',
            'passwordError' => '',
            'loginEmailError' => '',
            'loginPasswordError' => '',
            'judul' => 'Buat Akun'
        ];
    
        // Validate data
        if (empty($data['name'])) $data['nameError'] = 'Nama tidak boleh kosong.';
        if (empty($data['role'])) $data['roleError'] = 'Role tidak boleh kosong.';
        if (empty($data['address'])) $data['addressError'] = 'Alamat tidak boleh kosong.';
        if (empty($data['phonenumber'])) $data['phonenumberError'] = 'Nomor Telepon tidak boleh kosong.';
        if (empty($data['email'])) {
            $data['emailError'] = 'Email tidak boleh kosong.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Format email tidak valid.';
        }
        if (empty($data['password'])) {
            $data['passwordError'] = 'Password tidak boleh kosong.';
        } elseif (strlen($data['password']) < 8 || !preg_match("#[0-9]+#", $data['password']) || 
            !preg_match("#[A-Z]+#", $data['password']) || !preg_match("#[a-z]+#", $data['password'])) {
            $data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
        }
    
        // Return errors if any
        if (!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) || 
            !empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'])) {
            $_SESSION['formErrors'] = $data;
            header('Location: ' . BASEURL . '/employees');
            return;
        }
        if ($this->model('User_model')->daftarAdmin($data) > 0) {
            $_SESSION['status']='success';
        } else {
            $_SESSION['status']='error';
        }
        header('Location: ' . BASEURL . '/employees');
        exit;
    }
}
