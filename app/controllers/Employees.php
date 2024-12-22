<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class Employees extends Controller{
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
        header('Location: ' . BASEURL . '/user/login');
        }
        if ($_SESSION['user_role'] != 'Owner') {
        header('Location: ' . BASEURL . '/dashboard');          
        }
        if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
            header('Location: ' . BASEURL . '/dashboard');
        }
    }

    public function index($page=1){

        $data['judul'] = 'Karyawan';
        $data['users'] = $this->model('User_model')->getUserStore();
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
        $data['notifications'] = $this->model('Item_model')->getTotalStockItem();
        // $data['invusers'] = $this->model('User_model')->getInventoryUser();
        // $data['cashusers'] = $this->model('User_model')->getCashierUser();
        $usersperpage = 1;
        $totalusers = $this->model('User_model')->getUserCount();
        $totalpages = ceil($totalusers / $usersperpage);
        $start = ($page - 1) * $usersperpage;
        $data['users'] = $this->model('User_model')->getPaginatedUsers($start, $usersperpage);
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalpages;

        if($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('employees/index', $data);
        }
        else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }
    }

    public function createEmployee() {

        $mail = new PHPMailer(true);

        function sanitizeInput($input) {
            return strtolower(trim($input));
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? '',
            'address' => $_POST['address'] ?? '',
            'phonenumber' => $_POST['phonenumber'] ?? '',
            'email' => sanitizeInput($_POST['email']) ?? '',
            'password' => $_POST['password'] ?? '',
            'verificationCode' => bin2hex(random_bytes(16)),
            'judul' => 'Buat Akun'
        ];
        $cekemail=$this->model('User_model')->cekEmail($data['email']);
        $cekpassword=$this->model('User_model')->cekPassword($data['password']);
        $ceknomortelepon=$this->model('User_model')->cekNomorTelepon($data['phonenumber']);
        if (!preg_match("/^08[0-9]{9,11}$/", $data['phonenumber'])) {
			$_SESSION['status'] = 'errorNomorTelepon';  
            header('Location: ' . BASEURL . '/employees');
		}
        if ($cekemail>0) {
            $_SESSION['status']='errorEmail';
            header('Location: ' . BASEURL . '/employees');
        } elseif ($ceknomortelepon>0){
            $_SESSION['status']='errorNomorTelepon';
            header('Location: ' . BASEURL . '/employees');
        } else{
            if ($this->model('User_model')->daftarAdmin($data)) {
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'rifatok123@gmail.com';                     //SMTP username
                    $mail->Password   = 'xpbn gjvc kkve rvcq';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('from@InvenSync.com', 'Verification');
                    $mail->addAddress($data['email'], $data['name']);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
                
                    // //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Verifikasi Akun';
                    $mail->Body = "
                        <h1>Halo, {$data['name']}!</h1>
                        <p>Anda Telah diundang untuk menjadi karyawan dari toko ".$_SESSION['store_name']." :</p>
                        <a href='" . BASEURL . "/employees/verify/{$data['verificationCode']}'>
                        Verifikasi Akun Anda
                        </a>
                        <p>Terima kasih!</p>
                    ";		
                    if ($mail->send()) {
                        $_SESSION['status'] = 'success';
                    } else {
                        Flasher::setFlash('Gagal', 'Gagal mengirim email verifikasi.', 'Tutup', 'danger');
                    }
        
                } catch (Exception $e) {
                    Flasher::setFlash('Gagal', 'Kesalahan server: ' . $mail->ErrorInfo, 'Tutup', 'danger');
                }
                header('Location: ' . BASEURL . '/employees');
                exit;
            }
        }
    }

    public function verify($code = null) {
        if (!$code) {
            Flasher::setFlash('Gagal', 'Token tidak valid.', 'Tutup', 'danger');
            header('Location: ' . BASEURL . '/fesbuk'); 
            exit;
        }
    
        $user = $this->model('User_model')->getUserByToken($code);
    
        if (!$user) {
            Flasher::setFlash('Gagal', 'Token tidak valid atau sudah kadaluarsa.', 'Tutup', 'danger');
            header('Location: ' . BASEURL . '/fesbuk');
            exit;
        }
    
        $this->model('User_model')->verifyUserEmail($user['USER_ID']);
        $this->model('User_model')->removeVerificationToken($user['USER_ID']);
        $_SESSION['status'] = 'verified';
    
        header('Location: ' . BASEURL . '/user/login');
        exit;
    }
    

    public function deleteEmployee($id = null) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id=$_POST['id'];
        }
        $this->model('User_model')->deleteEmployee($id) > 0;
        header('Location: ' . BASEURL . '/employees');
        exit;
    }

    public function getUserbyID($id)
    {
        $employee = $this->model('User_model')->getUserbyID($id);
    
        if ($employee) {
            header('Content-Type: application/json');
            echo json_encode($employee); // Langsung mengembalikan objek
        } else {
            header('Content-Type: application/json');
            echo json_encode(null);
        }
    }


    public function updateEmployee(){
        $data = [
            'user_id' => $_POST['id'],
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? '',
            'address' => $_POST['address'] ?? '',
            'phonenumber' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'nameError' => '',
            'roleError' => '',
            'addressError' => '',
            'phonenumberError' => '',
            'emailError' => '',
            'passwordError' => '',
            'judul' => 'Profile Toko'
        ];
    
        // Validate data
        if (empty($data['name'])) $data['nameError'] = 'Nama tidak boleh kosong.';
        if (empty($data['role'])) $data['roleError'] = 'Role tidak boleh kosong.';
        if (empty($data['address'])) $data['addressError'] = 'Alamat tidak boleh kosong.';
        if (empty($data['phonenumber'])) $data['phonenumberError'] = 'Nomor Telepon tidak boleh kosong.';
        if (empty($data['email'])) {
            $data['emailError'] = 'Email tidak boleh kosong.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Format email tidak valid.';
        }
        if (empty($data['password'])) {
            // If password is empty, we skip the password validation for length and characters
            // But we will not include the password in the update query
            unset($data['password']); // Remove password from data array
        } elseif (strlen($data['password']) < 8 || !preg_match("#[0-9]+#", $data['password']) || 
                !preg_match("#[A-Z]+#", $data['password']) || !preg_match("#[a-z]+#", $data['password'])) {
            $data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
        }
    
        // If there are errors, return and redirect
        if (!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) || 
            !empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'])) {
            $_SESSION['formErrors'] = $data;
            header('Location: ' . BASEURL . '/employees');
            return;
        }
    
        // If password is provided, hash it before saving
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    
        // Update the employee record in the database
        if ($this->model('User_model')->updateAdmin($data)) {
            $_SESSION['status'] = 'success';
        } else {
            $_SESSION['status'] = 'error';
        }
    
        // Redirect to employees page
        header('Location: ' . BASEURL . '/employees');
        exit;
    }
    
    public function searchEmployee() {
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $data = [
                'search' => htmlspecialchars(trim($_POST['search']))
            ];
            $employees = $this->model('User_model')->searchEmployee($data['search']);
            
            if (count($employees) > 0) {
                $_SESSION['employees'] = $employees;
                header('Location: ' . BASEURL . '/employees');
                exit;
            }
        } else {
            // Handle the case where search input is empty or invalid
            header('Location: ' . BASEURL . '/employees');
            exit;
        }
    }
    
    // public function deleteEmployee($id){
    //     if ($this->model('User_model')->deleteAdmin($id) > 0) {
    //         $_SESSION['status']='success';
    //     } else {
    //         $_SESSION['status']='error';
    //     }
    //     header('Location: ' . BASEURL . '/employees');
    //     exit;
    // }
}
