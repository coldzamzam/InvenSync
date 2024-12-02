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

  public function checkRowToko() {
    $query = "SELECT COUNT(*) FROM i_store_info WHERE owner_id = :owner_id";
    $this->db->query($query);
    $this->db->bind(':owner_id', $_SESSION['user_id']);
    $this->db->execute();

    $storeCount = $this->db->fetchColumn() ?? 0;
    $_SESSION['ada_toko'] = ($storeCount > 0);

    return $storeCount;
}


public function getStoreInfo() {
  $this->db->query('SELECT * FROM i_store_info WHERE owner_id = :owner_id');
  $this->db->bind(':owner_id', $_SESSION['user_id']);
  return $this->db->single(); // Ambil 1 baris data saja
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
    $query = "INSERT INTO i_store_info (store_name, store_type, location, phone_number, email, year_founded, owner_id)
    VALUES (:namatoko, :tipetoko, :lokasi, :telepontoko, :emailtoko, :yearfounded, :owner_id)";
    $this->db->query($query);
    $this->db->bind('namatoko', $data['namatoko']);
    $this->db->bind('tipetoko', $data['tipetoko']);
    $this->db->bind('lokasi', $data['lokasi']);
    $this->db->bind('telepontoko', $data['telepontoko']);
    $this->db->bind('emailtoko', $data['emailtoko']);
    $this->db->bind('yearfounded', $data['yearfounded']);
    $this->db->bind('owner_id', $_SESSION['user_id']);

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
      $_SESSION['user_address'] = $user['ADDRESS'];
      $_SESSION['user_phonenumber'] = $user['PHONE_NUMBER'];

      $_SESSION['is_login'] = true;
      
      return $user;
    } else {
      return false;
    }
    

    // return $this->db->rowCount();
  }

  public function getEditToko($id) {
    $query = "SELECT * FROM i_store_info WHERE owner_id = :owner_id";
    $this->db->query($query);
    $this->db->bind('owner_id', $id);
    $this->db->execute();

    return $this->db->single();
  }

  public function editToko($data) {
    $query = "UPDATE i_store_info SET 
                store_name = :namatoko, 
                store_type = :tipetoko, 
                location = :lokasi, 
                phone_number = :telepontoko, 
                email = :emailtoko, 
                year_founded = :yearfounded 
              WHERE owner_id = :owner_id";
    $this->db->query($query);
    $this->db->bind('namatoko', $data['namatoko']);
    $this->db->bind('tipetoko', $data['tipetoko']);
    $this->db->bind('lokasi', $data['lokasi']);
    $this->db->bind('telepontoko', $data['telepontoko']);
    $this->db->bind('emailtoko', $data['emailtoko']);
    $this->db->bind('yearfounded', $data['yearfounded']);
    $this->db->bind('owner_id', $_SESSION['user_id']);

    $this->db->execute();
    // var_dump($this->db->single());

    return $this->db->rowCount();
  }

  public function getUserbyID($id){
    $this->db->query('SELECT * FROM i_users WHERE user_id = :user_id AND is_deleted = 0 AND owner_id = :owner_id');
    $this->db->bind('user_id', $id);
    $this->db->bind('owner_id', $_SESSION['user_id']);
    return $this->db->single(); // Ambil hanya satu hasil
  }

  public function updateAdmin($data) {
    $query = "UPDATE i_users SET 
                name = :name, 
                role = :role, 
                address = :address, 
                phone_number = :phonenumber, 
                email = :email ";
    
    // Add password only if it's provided
    if (isset($data['password'])) {
        $query .= ", password = :password";
    }

    $query .= " WHERE user_id = :user_id and owner_id = :owner_id";

    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('user_id', $data['user_id']);
    $this->db->bind('owner_id', $_SESSION['user_id']);

    // Bind password only if it's provided
    if (isset($data['password'])) {
        $this->db->bind('password', $data['password']);
    }

    $this->db->execute();

    return $this->db->rowCount();
}

public function deleteEmployee($id = null) {
  // Ensure that the ID is provided (either from URL or POST)
  // Proceed with deletion logic
      // Dump the provided ID and user ID for debugging
      // var_dump($id); 
      // var_dump($_SESSION['user_id']); 
      // Soft delete employee by setting is_deleted to 1
      $this->db->query("UPDATE i_users SET is_deleted = 1 WHERE user_id = :user_id AND owner_id = :owner_id");
      $this->db->bind('user_id', $id);
      $this->db->bind('owner_id', $_SESSION['user_id']);
      $this->db->execute();

      // Dump the result of the execution and row count
      // var_dump($this->db->rowCount()); // Check how many rows were affected

      // Return the row count to check if the operation was successful
      return $this->db->rowCount() > 0 ? 'success' : 'error';
  // Return 'error' if no ID is provided
}

// public function searchEmployee(){
//   $this->db->query("SELECT * FROM i_users WHERE is_deleted = 0 AND owner_id = :owner_id AND name LIKE :search");
//   $this->db->bind('owner_id', $_SESSION['user_id']);
//   $this->db->bind('search', '%' . $_GET['search'] . '%');
//   $this->db->execute();

//   return $this->db->resultSet();
// }


}

?>