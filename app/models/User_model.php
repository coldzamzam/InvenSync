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
    // if ($this->db->execute()) {
    //   echo 'Berhasil mengambil data i_store_info';
    //   $this->db->resultSet();
    // } else {
    //   echo 'Gagal mengambil data';
    // }
    // var_dump($this->db->rowCount());

    return $this->db->rowCount();
  }

  public function daftar() {
    if ( isset($_POST['lanjut']) ) {
      $_SESSION['nama'] = $_POST['nama'];
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      $_SESSION['telepon'] = $_POST['telepon'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['alamat'] = $_POST['alamat'];
    }
  }

  public function daftarToko($data) {
    $query = "INSERT INTO i_store_info (store_name, store_type, location, phone_number, email, year_founded)
    VALUES (:namatoko, :tipetoko, :lokasi, :telepontoko, :emailtoko, :yearfounded)";
    $this->db->query($query);
    $this->db->bind('namatoko', $data['namatoko']);
    $this->db->bind('tipetoko', $data['tipetoko']);
    $this->db->bind('lokasi', $data['lokasi']);
    $this->db->bind('telepontoko', $data['telepontoko']);
    $this->db->bind('emailtoko', $data['emailtoko']);
    $this->db->bind('yearfounded', $data['yearfounded']);

    $this->db->execute();
    // var_dump($this->db->single());

    return $this->db->rowCount();
  }
  

}

?>