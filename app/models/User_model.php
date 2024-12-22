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
    $query = "SELECT COUNT(*) FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0";
    $this->db->query($query);
    $this->db->bind(':owner_id', $_SESSION['owner_id']);
    $this->db->execute();

    $storeCount = $this->db->fetchColumn() ?? 0;
    $_SESSION['ada_toko'] = ($storeCount > 0);

    return $storeCount;
  }


public function getStoreInfo() {
  $this->db->query('SELECT * FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0');
  if($_SESSION['user_role'] == 'Owner') {
    $this->db->bind(':owner_id', $_SESSION['user_id']);
  } else {
    $this->db->bind(':owner_id', $_SESSION['owner_id']);
  }
  return $this->db->single(); // Ambil 1 baris data saja
}

public function daftar($data) {
    $query = "INSERT INTO i_users (name, role, address, phone_number, email, password, verification_token, is_email_verified)
              VALUES (:name, :role, :address, :phonenumber, :email, :password, :verificationToken, 0)";
              
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', hash('sha256', $data['password']));
    $this->db->bind('verificationToken', $data['verificationCode']);

    $this->db->execute();

    return $this->db->rowCount(); // Mengembalikan jumlah baris yang ditambahkan
}

public function getUserByToken($token) {
  $query = "SELECT * FROM i_users WHERE verification_token = :token and is_deleted = 0";
  $this->db->query($query);
  $this->db->bind('token', $token);
  return $this->db->single();
}


public function verifyUserEmail($user_id) {
  $query = "UPDATE i_users SET is_email_verified = 1 WHERE user_id = :user_id and is_deleted = 0";
  $this->db->query($query);
  $this->db->bind('user_id', $user_id);
  $this->db->execute();
}

public function removeVerificationToken($user_id) {
  $query = "UPDATE i_users SET verification_token = NULL WHERE user_id = :user_id and is_deleted = 0";
  $this->db->query($query);
  $this->db->bind('user_id', $user_id);
  $this->db->execute();
}

  public function cekEmail($email) {
    $this->db->query('SELECT * FROM i_users WHERE email = :email and is_deleted = 0');
    $this->db->bind('email', $email);
    return $this->db->single();
  }

  public function cekEmailToko($email) {
    $this->db->query('SELECT * FROM i_store_info WHERE email = :email and is_deleted = 0');
    $this->db->bind('email', $email);
    return $this->db->single();
  }

  public function cekNomorTelepon($nomor_telepon) {
    $this->db->query('SELECT * FROM i_users WHERE phone_number = :nomor_telepon and is_deleted = 0');
    $this->db->bind('nomor_telepon', $nomor_telepon);
    return $this->db->single();
  }
  
  public function cekNomorTeleponToko($nomor_telepon) {
    $this->db->query('SELECT * FROM i_store_info WHERE phone_number = :nomor_telepon and is_deleted = 0');
    $this->db->bind('nomor_telepon', $nomor_telepon);
    return $this->db->single();
  }

  public function daftarAdmin($data) {
    $query="INSERT INTO i_users (name, role, address, phone_number, email, password, owner_id, store_id, verification_token, is_email_verified)
    VALUES (:name, :role, :address, :phonenumber, :email, :password, :owner_id, :store_id,:verificationToken, 0)";
  
    $this->db->query($query);  
    $this->db->bind('name', $data['name']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('phonenumber', $data['phonenumber']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', hash('sha256', $data['password']) );
    $this->db->bind('verificationToken', $data['verificationCode']);
    $this->db->bind('owner_id', $_SESSION['user_id']);
    $this->db->bind('store_id', $_SESSION['store_id']);
  
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
    $_SESSION['store_id'] = $data['store_id'];
    $_SESSION['store_name'] = $data['namatoko'];
    // var_dump($this->db->single());

    return $this->db->rowCount();
  }

  public function setOwnerStoreID(){
    $query = "UPDATE i_users SET store_id = :store_id WHERE user_id = :user_id AND is_deleted = 0";
    $this->db->query($query);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('user_id', $_SESSION['user_id']);

    $this->db->execute();
  }

  public function masuk($data) {
    $query = "SELECT * FROM i_users WHERE email = :email AND password = :password AND is_email_verified = 1 AND is_deleted = 0";
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
      if($_SESSION['user_role']!='Owner'){
        $_SESSION['owner_id'] = $user['OWNER_ID'];
      } else {
        $_SESSION['owner_id'] = $_SESSION['user_id'];
      }
      $_SESSION['store_id'] = $user['STORE_ID'];
      // $_SESSION['owner_id'] = $user['OWNER_ID'];
      if(isset($user['VERIFICATION_TOKEN'])) {
        $_SESSION['verification_token'] = $user['VERIFICATION_TOKEN'];
      }
      $_SESSION['is_login'] = true;
      
      return $user;
    } else {
      return false;
    }
  }

  public function checkDeleted($userid){
    $query = "SELECT * FROM i_users WHERE user_id = :user_id AND is_deleted = 0 AND is_email_verified = 1 AND verification_token IS NOT NULL";
    $this->db->query($query);
    $this->db->bind('user_id', $userid);
    $this->db->execute();
    $user = $this->db->single();
    if($user){
      return $user;
    } else {
      return false;
    }
  }

  public function activateStoreID() {
    // Query to fetch store information for the current owner
    $query = "SELECT STORE_ID FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0";
    $this->db->query($query);
    $this->db->bind('owner_id', $_SESSION['owner_id']);
    
    // Execute the query and fetch the single result
    $store = $this->db->single();

    // Check if a store record was found
    if ($store) {
        $_SESSION['store_id'] = $store['STORE_ID']; // Set store ID in session
        return true; // Indicate success
    } else {
        // Handle the case where no store is found
        $_SESSION['store_id'] = null; // Optionally clear any previous value
        return false; // Indicate failure
    }
}

  public function activateStoreName(){
    $query = "SELECT store_name FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0";
    $this->db->query($query);
    $this->db->bind('owner_id', $_SESSION['owner_id']);
    $this->db->execute();
    $store = $this->db->single();
    $_SESSION['store_name'] = $store['STORE_NAME'];
  }


  public function getEditToko($id) {
    $query = "SELECT * FROM i_store_info WHERE owner_id = :owner_id and is_deleted = 0";
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
              WHERE owner_id = :owner_id AND is_deleted = 0";
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

    $query .= " WHERE user_id = :user_id and owner_id = :owner_id AND is_deleted = 0";

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

public function searchEmployee($search) {
  // Clean the search string, in case there are unwanted characters
  $search = "%" . $search . "%";

  $this->db->query("SELECT * FROM i_users WHERE is_deleted = 0 AND owner_id = :owner_id AND name LIKE :search");
  $this->db->bind('owner_id', $_SESSION['user_id']);
  $this->db->bind('search', $search);
  $this->db->execute();

  return $this->db->resultSet();
}

public function getUserStore(){
  $this->db->query('SELECT * FROM i_users WHERE is_deleted = 0 and store_id = :store_id and owner_id = :owner_id');
  $this->db->bind('store_id', $_SESSION['store_id']);
  $this->db->bind('owner_id', $_SESSION['user_id']);
  $this->db->execute();
  // var_dump($this->db->resultSet());
  return $this->db->resultSet();
}  

public function getPaginatedUsers($start, $limit)
{
    $this->db->query('
        SELECT * FROM (
            SELECT a.*, ROWNUM rnum
            FROM i_users a
            WHERE is_deleted = 0 and store_id = :store_id and owner_id = :owner_id
        ) WHERE rnum > :startIndex AND rnum <= :endIndex
    ');
    $this->db->bind('startIndex', $start, PDO::PARAM_INT);
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->bind('owner_id', $_SESSION['user_id']);
    $this->db->bind('endIndex', $start + $limit, PDO::PARAM_INT);
    $this->db->execute();
    return $this->db->resultSet();
}

public function getUserCount(){
    $this->db->query('SELECT COUNT(*) as total FROM i_users WHERE is_deleted = 0 and store_id = :store_id');
    $this->db->bind('store_id', $_SESSION['store_id']);
    $this->db->execute();
    return $this->db->single()['TOTAL'];
}

public function getInventoryUserCount(){
  $this->db->query("SELECT COUNT(*) as total FROM i_users WHERE role = 'Admin Gudang' AND is_deleted = 0 AND store_id = :store_id");
  $this->db->bind('store_id', $_SESSION['store_id']);
  $this->db->execute();
  return $this->db->single()['TOTAL'];
}

public function getCashierUserCount(){
  $this->db->query("SELECT COUNT(*) as total FROM i_users WHERE role = 'Admin Kasir' AND is_deleted = 0 AND store_id = :store_id");
  $this->db->bind('store_id', $_SESSION['store_id']);
  $this->db->execute();
  return $this->db->single()['TOTAL'];
}

public function getAllUser(){
  $this->db->query('SELECT * FROM i_users WHERE is_deleted = 0');
  $this->db->execute();
  // var_dump($this->db->resultSet());
  return $this->db->resultSet();
}

public function getInventoryUser(){
  $this->db->query("SELECT * FROM i_users WHERE role = 'Admin Gudang' AND is_deleted = 0");
  $this->db->execute();
  // var_dump($this->db->resultSet());
  return $this->db->resultSet();
}

public function getCashierUser(){
  $this->db->query("SELECT * FROM i_users WHERE role = 'Admin Kasir' AND is_deleted = 0 ");
  $this->db->execute();
  // var_dump($this->db->resultSet());
  return $this->db->resultSet();
}

public function checkDeletion(){
  $this->db->query("SELECT verification_token FROM i_users WHERE user_id = :user_id and is_verified = 1");
  $this->db->bind('user_id', $_SESSION['user_id']);
  $this->db->execute();
  return $this->db->single();
}

public function checkDeletionEmployees(){
  $this->db->query("SELECT verification_token FROM i_users WHERE owner_id = :owner_id and is_verified = 1");
  $this->db->bind('owner_id', $_SESSION['owner_id']);
  $this->db->execute();
  return $this->db->single();
}


public function setDeleteToken($deleteToken,$storeID){
  $this->db->query("UPDATE i_users SET verification_token = :token WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('token', $deleteToken);
  $this->db->bind('store_id', $storeID);
  $this->db->execute();
}

public function getStoreByToken($code){
  $this->db->query("SELECT store_id FROM i_users WHERE verification_token = :token and is_deleted = 0");
  $this->db->bind('token', $code);
  $this->db->execute();
  return $this->db->single();
}

public function deleteAccounts($code){
  $this->db->query("UPDATE i_users SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
} 

public function deleteSingleUser($code){
  $this->db->query("UPDATE i_users SET is_deleted = 1 WHERE user_id = :user_id and is_deleted = 0");
  $this->db->bind('user_id', $_SESSION['user_id']);
  $this->db->execute();
}

public function deleteReceipts($code){
  $this->db->query("UPDATE i_receipt SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function deleteStore($code){
  $this->db->query("UPDATE i_store_info SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function deleteInventory($code){
  $this->db->query("UPDATE i_inventory SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function deleteItems($code){
  $this->db->query("UPDATE i_master_item SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function deleteBrand($code){
  $this->db->query("UPDATE i_master_brand SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function deleteCategory($code){
  $this->db->query("UPDATE i_master_category SET is_deleted = 1 WHERE store_id = :store_id and is_deleted = 0");
  $this->db->bind('store_id', $code);
  $this->db->execute();
}

public function removeDeleteToken($code){
  $this->db->query("UPDATE i_users SET verification_token = NULL WHERE store_id = :store_id");
  $this->db->bind('store_id', $code);
  $this->db->execute();

}

  public function cancelDeletion($store_id){
    $this->db->query("UPDATE i_users SET verification_token = null WHERE store_id = :store_id and is_deleted = 0");
    $this->db->bind('store_id', $store_id);
    $this->db->execute();
  }

  public function setCodeToAccountWithEmail($code,$email){
    $this->db->query("UPDATE i_users SET code = :code WHERE email = :email and is_deleted = 0");
    $this->db->bind('code', $code);
    $this->db->bind('email', $email);
    $this->db->execute();
  }

  public function getUserByCode($code){
    $this->db->query("SELECT * FROM i_users WHERE code = :code and is_deleted = 0");
    $this->db->bind('code', $code);
    $this->db->execute();
    return $this->db->single();
  }

  public function updatePassword($password, $code){
    $this->db->query("UPDATE i_users SET password = :password WHERE code = :code and is_deleted = 0");
    $this->db->bind('password', hash('sha256', $password));
    $this->db->bind('code', $code);
    $this->db->execute();
  }

  public function removeCode($code){
    $this->db->query("UPDATE i_users SET code = null WHERE code = :code and is_deleted = 0");
    $this->db->bind('code', $code);
    $this->db->execute();
  }

  public function cekPassword($password) {
    $this->db->query('SELECT * FROM i_users WHERE password = :password and is_deleted = 0 and user_id = :user_id');
    $this->db->bind('password', hash('sha256', $password));
    $this->db->bind('user_id', $_SESSION['user_id']);

    return $this->db->single();
  }

  public function changePassword($password) {
    $this->db->query('UPDATE i_users SET password = :password WHERE user_id = :user_id and is_deleted = 0');
    $this->db->bind('password', hash('sha256', $password));
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->execute();
  }
}
?>