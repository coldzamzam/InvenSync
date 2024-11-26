<?php

class User_model {
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  public function checkRowAcc(){
    $query = "SELECT * FROM i_users";
    $this->db->query($query);
    $this->db->execute();
    // if ($this->db->execute()) {
    //   echo 'Berhasil mengambil data i_users';
    //   $this->db->resultSet();
    // } else {
    //   echo 'Gagal mengambil data';
    // }
    // var_dump($this->db->fetchColumn());

    return $this->db->fetchColumn();
  }

  public function checkRowToko(){
    $query = "SELECT * FROM i_store_info";
    $this->db->query($query);
    $this->db->execute();

    return $this->db->fetchColumn();
  }

  public function daftar($data) {
    $query = "INSERT INTO i_users (name, role, address, phone_number, email, password)
    VALUES (:name, :role, :address, :phonenumber, :email, :password)";
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', hash('sha256', $data['password']) );

    $this->db->execute();
    // var_dump($this->db->single());

    return $this->db->rowCount();
  }

  public function daftarAdmin($data) {
    $query="INSERT INTO i_users (name, role, address, phone_number, email, password, owner_id)
    VALUES (:name, :role, :address, :phonenumber, :email, :password, :owner_id)";

    $this->db->query($query);  
    $this->db->bind('name', $data['name']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', hash('sha256', $data['password']) );
    $this->db->bind('owner_id', $_SESSION['user_id']);

    $this->db->execute();

    return $this->db->rowCount();
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

  public function masuk($data) {
    $query = "SELECT * FROM i_users WHERE email = :email AND password = :password";
    $this->db->query($query);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', hash('sha256', $data['password']));
    $this->db->execute();

    $user = $this->db->single();
    // $pass = password_hash($data['password'], PASSWORD_BCRYPT);

    if($user) {
      $_SESSION['user_id'] = $user['USER_ID'];
      $_SESSION['user_email'] = $user['EMAIL'];
      $_SESSION['user_name'] = $user['NAME'];
      $_SESSION['user_role'] = $user['ROLE'];
      $_SESSION['is_login'] = true;
      
      return $user;
    } else {
      return false;
    }
    

    // return $this->db->rowCount();
  }

}

?>