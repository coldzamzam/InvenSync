<?php

class User extends Controller {
  public function index(){
    $data['loginEmailError'] = '';
    $data['loginPasswordError'] = '';
    
    $data['nameError'] = '';
    $data['roleError'] = '';
    $data['addressError'] = '';
    $data['phonenumberError'] = '';
    $data['emailError'] = '';
    $data['passwordError'] = '';
    if ( $this->model('User_model')->checkRowAcc() > 0 ) {
      header('Location: ' . BASEURL . '/user/daftar');
    } else {
      $data['judul'] = 'Login';
      $this->view('templates/i-header', $data);
      $this->view('user/index', $data);
      $this->view('templates/footer');
    }
  }

  public function daftar() {
    $data['judul'] = 'Daftar Akun';
    $this->view('templates/i-header', $data);
    $this->view('user/daftar', $data);
    $this->view('templates/footer');
  }

  public function regist() {
    if ( $this->model('User_model')->daftarToko($_POST) > 0 ){
      Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
      header ('Location: ' . BASEURL . '/user');
      exit;
    } else{
      Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
      header ('Location: ' . BASEURL . '/user');
      exit;
    }
  }

  public function createAcc() {
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
        'loginPasswordError' => ''
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
        $this->view('templates/i-header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
        return;
    }

    // Insert data
    if ($this->model('User_model')->daftar($data) > 0) {
        Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
        header('Location: ' . BASEURL . '/user');
        exit;
    } else {
        Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
        header('Location: ' . BASEURL . '/user');
        exit;
    }
}



  public function login() {
    $data = [
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'loginEmailError' => '',
        'loginPasswordError' => '',
        'nameError' => '',
        'roleError' => '',
        'addressError' => '',
        'phonenumberError' => '',
        'emailError' => '',
        'passwordError' => '',
    ];


    if (empty($data['password'])) $data['loginPasswordError'] = 'Password tidak boleh kosong.';
    if (empty($data['email'])) {
        $data['loginEmailError'] = 'Email tidak boleh kosong.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['loginEmailError'] = 'Format email tidak valid.';
    }

    if (!empty($data['loginEmailError']) || !empty($data['passwordError'])) {
        $this->view('templates/i-header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
        return;
    }

    if ($this->model('User_model')->masuk($data)) {
        $this->view('templates/s-header', $data);
        $this->view('dashboard/index', $data);
    } else {
        $data['loginEmailError'] = 'Email atau password salah.';
        $this->view('templates/i-header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }
}


}

?>