<?php

class User_model {
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function checkRowAcc(){
    $query = "SELECT * FROM i_store_info";
    $this->db->query($query);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function daftar() {
    if ( isset($_POST['lanjut']) ) {
      if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['telepon']) || empty($_POST['email']) || empty($_POST['alamat'])) {
        Flasher::setFlash('Data akun', 'harus', 'diisi semua', 'danger');
        return;
      } else {
        $_SESSION['nama'] = $_POST['nama'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['telepon'] = $_POST['telepon'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['alamat'] = $_POST['alamat'];
        return;
      }
    }
  }

  public function daftarToko($data) {
    $query = "INSERT INTO i_store_info (store_name, store_type, location, phone_number, email, year_founded)
    VALUES ('', :namatoko, :tipetoko, :lokasi, :telepontoko, :emailtoko, :yearfounded)";
    $this->db->query($query);
    $this->db->bind('namatoko', $data['namatoko']);
    $this->db->bind('tipetoko', $data['namstore_type']);
    $this->db->bind('lokasi', $data['location']);
    $this->db->bind('telepontoko', $data['phone_number']);
    $this->db->bind('emailtoko', $data['emailtoko']);
    $this->db->bind('yearfounded', $data['yearfounded']);

    $this->db->execute();

    return $this->db->rowCount();
  }
  

}

?>