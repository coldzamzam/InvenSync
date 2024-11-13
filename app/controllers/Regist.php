<?php

class Regist extends Controller {
  public function index(){
    if ( $this->model('User_model')->checkRowAcc() > 0 ) {
      header('Location: ' . BASEURL . '/daftar');
    } else {
      $data['judul'] = 'Daftar Toko';
      $this->view('templates/i-header', $data);
      $this->view('regist/index', $data);
      $this->view('templates/footer');
    }
  }

  public function daftar() {
    $data['judul'] = 'Daftar Akun';
    $this->view('templates/i-header', $data);
    $this->view('regist/daftar', $data);
    $this->view('templates/footer');
  }
}

?>