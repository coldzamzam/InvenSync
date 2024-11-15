<?php

class User extends Controller {
  public function index(){
    if ( $this->model('User_model')->checkRowAcc() > 0 ) {
      header('Location: ' . BASEURL . '/user/login');
    } else {
      $data['judul'] = 'Daftar Toko';
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
}

?>