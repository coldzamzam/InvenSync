<?php

class Mahasiswa extends Controller {
  public function index() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();

    $this->view('templates/header', $data);
    $this->view('mahasiswa/index', $data);
    $this->view('templates/footer');
  
  }

  public function detail($nim) {
    $data['judul'] = 'Detail Mahasiswa';
    $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($nim);

    $this->view('templates/header', $data);
    $this->view('mahasiswa/detail', $data);
    $this->view('templates/footer');

  }

  public function tambah(){
    if ( $this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0 ) {
      Flasher::setFlash('Data mahasiswa', 'berhasil', 'ditambahkan', 'success');
      header ('Location: ' . BASEURL . '/mahasiswa');
      exit;
    }
    else {
      Flasher::setFlash('Data mahasiswa', 'gagal', 'ditambahkan', 'danger');
      header ('Location: ' . BASEURL . '/mahasiswa');
      exit;
    }
  }
}

?>