<?php

class Employees extends Controller{
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
        header('Location: ' . BASEURL . '/user/login');
        }
    }

    public function index($page=1){
        $data['judul'] = 'Employees';
        $data['users'] = $this->model('User_model')->getUserStore();
        // $data['invusers'] = $this->model('User_model')->getInventoryUser();
        // $data['cashusers'] = $this->model('User_model')->getCashierUser();
        $usersperpage = 10;
        $totalusers = $this->model('User_model')->getUserCount();
        $totalpages = ceil($totalusers / $usersperpage);
        $start = ($page - 1) * $usersperpage;
        $data['users'] = $this->model('User_model')->getPaginatedUsers($start, $usersperpage);
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

    public function deleteEmployee($id = null) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id=$_POST['id'];
        }
        $this->model('User_model')->deleteEmployee($id) > 0;
        header('Location: ' . BASEURL . '/employees');
        exit;
    }

    public function getUserbyID($id)
    {
        $employee = $this->model('User_model')->getUserbyID($id);
    
        if ($employee) {
            header('Content-Type: application/json');
            echo json_encode($employee); // Langsung mengembalikan objek
        } else {
            header('Content-Type: application/json');
            echo json_encode(null);
        }
    }


    public function updateEmployee(){
        $data = [
            'user_id' => $_POST['id'],
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? '',
            'address' => $_POST['address'] ?? '',
            'phonenumber' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'nameError' => '',
            'roleError' => '',
            'addressError' => '',
            'phonenumberError' => '',
            'emailError' => '',
            'passwordError' => '',
            'judul' => 'Profile Toko'
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
            // If password is empty, we skip the password validation for length and characters
            // But we will not include the password in the update query
            unset($data['password']); // Remove password from data array
        } elseif (strlen($data['password']) < 8 || !preg_match("#[0-9]+#", $data['password']) || 
                !preg_match("#[A-Z]+#", $data['password']) || !preg_match("#[a-z]+#", $data['password'])) {
            $data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
        }
    
        // If there are errors, return and redirect
        if (!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) || 
            !empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'])) {
            $_SESSION['formErrors'] = $data;
            header('Location: ' . BASEURL . '/employees');
            return;
        }
    
        // If password is provided, hash it before saving
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    
        // Update the employee record in the database
        if ($this->model('User_model')->updateAdmin($data)) {
            $_SESSION['status'] = 'success';
        } else {
            $_SESSION['status'] = 'error';
        }
    
        // Redirect to employees page
        header('Location: ' . BASEURL . '/employees');
        exit;
    }
    
    public function searchEmployee() {
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $data = [
                'search' => htmlspecialchars(trim($_POST['search']))
            ];
            $employees = $this->model('User_model')->searchEmployee($data['search']);
            
            if (count($employees) > 0) {
                $_SESSION['employees'] = $employees;
                header('Location: ' . BASEURL . '/employees');
                exit;
            }
        } else {
            // Handle the case where search input is empty or invalid
            header('Location: ' . BASEURL . '/employees');
            exit;
        }
    }
    
    // public function deleteEmployee($id){
    //     if ($this->model('User_model')->deleteAdmin($id) > 0) {
    //         $_SESSION['status']='success';
    //     } else {
    //         $_SESSION['status']='error';
    //     }
    //     header('Location: ' . BASEURL . '/employees');
    //     exit;
    // }
}
