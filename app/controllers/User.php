<?php

class User extends Controller {
  public function index(){
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
    if ( $this->model('User_model')->daftar($_POST) > 0 ){
      Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
      header ('Location: ' . BASEURL . '/user');
      exit;
    } else{
      Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
      header ('Location: ' . BASEURL . '/user');
      exit;
    }
  }

  public function login(){
    $data['judul'] = 'Setelah Login';

    // $check = $this->model('User_model')->masuk($_POST);
    // var_dump($check); 

    if ( $this->model('User_model')->masuk($_POST) ) {
      // $this->view('templates/i-header', $data);
      $this->view('dashboard/index', $data);
      // $this->view('templates/footer');
      
    } else {
      echo 'Gagal login';
    }
  }

}

?>