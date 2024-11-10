<?php

class Mahasiswa_model {
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllMahasiswa() {
    $this->db->query('SELECT * FROM mahasiswa ORDER BY full_name ASC');
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getMahasiswaById($nim) {
    $this->db->query('SELECT * FROM mahasiswa WHERE nim= :nim');
    $this->db->bind('nim', $nim);
    return $this->db->single();
  }

  public function tambahDataMahasiswa($data) {
    $query = "INSERT INTO mahasiswa VALUES (:nim, :nama, :jurusan, :gender)";
    $this->db->query($query);
    $this->db->bind('nim', $data['nim']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('jurusan', $data['jurusan']);
    $this->db->bind('gender', $data['gender']);

    $this->db->execute();

    return $this->db->rowCount();
  }

}

?>

