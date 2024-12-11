<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class User extends Controller {
	
  public function index(){
	$data['nameError'] = '';
	$data['roleError'] = '';
	$data['addressError'] = '';
	$data['phonenumberError'] = '';
	$data['emailError'] = '';
	$data['passwordError'] = '';
	$data['confirmPasswordError'] = '';
	// if ( $this->model('User_model')->checkRowAcc() > 0 ) {
	//   header('Location: ' . BASEURL . '/user/login');
	// } else {
	  $data['judul'] = 'Buat Akun';
	  $this->view('templates/i-header', $data);
	  $this->view('user/index', $data);
	  $this->view('templates/footer');
	// }
  }

  public function login() {
	$data['loginEmailError'] = '';
	$data['loginPasswordError'] = '';
	$data['captchaError'] = '';

	$data['judul'] = 'Login';
	$this->view('templates/i-header', $data);
	$this->view('user/login', $data);
	$this->view('templates/footer');
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

  public function createAcc() {

	function sanitizeInput($input) {
		return strtolower(trim($input));
	}

	$mail = new PHPMailer(true);

	$data = [
		'name' => $_POST['name'] ?? '',
		'role' => $_POST['role'] ?? '',
		'address' => $_POST['address'] ?? '',
		'phonenumber' => $_POST['phonenumber'] ?? '',
		'email' => sanitizeInput($_POST['email']) ?? '',
		'password' => $_POST['password'] ?? '',
		'nameError' => '',
		'roleError' => '',
		'addressError' => '',
		'phonenumberError' => '',
		'emailError' => '',
		'passwordError' => '',
		'confirmPasswordError' => '',
		'verificationCode' => bin2hex(random_bytes(16)),
		'judul' => 'Buat Akun'
	];
	$cekemail=$this->model('User_model')->cekEmail($data['email']);
	$ceknomortelepon=$this->model('User_model')->cekNomorTelepon($data['phonenumber']);

	// Validate data
	if (empty($data['name'])) $data['nameError'] = 'Nama tidak boleh kosong.';
	if (empty($data['role'])) $data['roleError'] = 'Role tidak boleh kosong.';
	if (empty($data['address'])) $data['addressError'] = 'Alamat tidak boleh kosong.';
	if (empty($data['phonenumber'])) {
		$data['phonenumberError'] = 'Nomor Telepon tidak boleh kosong.';
	} elseif (!preg_match("/^08[0-9]{9,11}$/", $data['phonenumber'])) {
		$data['phonenumberError'] = 'Format nomor telepon tidak valid.';
	}

	if (empty($data['email'])) {
		$data['emailError'] = 'Email tidak boleh kosong.';
	} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$data['emailError'] = 'Format email tidak valid.';
	} elseif ($cekemail > 0) {
		$data['emailError'] = 'Email sudah terdaftar.';
	}

	if (empty($data['password'])) {
		$data['passwordError'] = 'Password tidak boleh kosong.';
	} elseif (strlen($data['password']) < 8 || 
			!preg_match("#[0-9]+#", $data['password']) || 
			!preg_match("#[A-Z]+#", $data['password']) || 
			!preg_match("#[a-z]+#", $data['password'])) {
		$data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
	} elseif ($cekpassword > 0) {
		$data['passwordError'] = 'Password sudah terdaftar.';
	}
	
	// Validasi konfirmasi password
	$data['confirmPassword'] = $_POST['confirmPassword'] ?? '';
	if (empty($data['confirmPassword'])) {
		$data['confirmPasswordError'] = 'Konfirmasi password tidak boleh kosong.';
	} elseif ($data['password'] !== $data['confirmPassword']) {
		$data['confirmPasswordError'] = 'Konfirmasi password tidak sesuai.';
	}


	
	// Return errors if any
	if (!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) || 
		!empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'] || !empty($data['confirmPasswordError']))) {
		$this->view('templates/i-header', $data);
		$this->view('user/index', $data);
		$this->view('templates/footer');
		return;
	}
	if ($this->model('User_model')->daftar($data) > 0) {
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
                <p>Klik tautan di bawah ini untuk memverifikasi akun Anda:</p>
                <a href='" . BASEURL . "/user/verify/{$data['verificationCode']}'>
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
    } else {
        Flasher::setFlash('Gagal', 'Registrasi akun gagal.', 'Tutup', 'danger');
    }

    header('Location: ' . BASEURL . '/user/index');
    exit;
// } else {
// 	Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
// 	header('Location: ' . BASEURL . '/user');
// 	exit;
// }

	// } else {
	// 	Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
	// 	header('Location: ' . BASEURL . '/user');
	// 	exit;
	// }
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



  public function createToko() {
	

	$data = [
		'namatoko' => $_POST['namatoko'] ?? '',
		'tipetoko' => $_POST['tipetoko'] ?? '',
		'lokasi' => $_POST['lokasi'] ?? '',
		'telepontoko' => $_POST['telepontoko'] ?? '',
		'emailtoko' => $_POST['emailtoko'] ?? '',
		'yearfounded' => $_POST['yearfounded'] ?? '',
		'namatokoError' => '',
		'tipetokoError' => '',
		'lokasiError' => '',
		'telepontokoError' => '',
		'emailtokoError' => '',
		'yearfoundedError' => '',
		'judul' => 'Profile Toko'
	];
	$cekemail=$this->model('User_model')->cekEmailToko($data['emailtoko']);
	$ceknomortelepon=$this->model('User_model')->cekNomorTeleponToko($data['telepontoko']);

	// Validate data
	if (empty($data['namatoko'])) $data['namatokoError'] = 'Nama tidak boleh kosong.';
	if (empty($data['tipetoko'])) $data['tipetokoError'] = 'Tipe toko tidak boleh kosong.';
	if (empty($data['lokasi'])) $data['lokasiError'] = 'Alamat tidak boleh kosong.';
	if (empty($data['telepontoko'])) {
		$data['telepontokoError'] = 'Nomor Telepon tidak boleh kosong.';
	} elseif ($ceknomortelepon > 0) {
		$data['telepontokoError'] = 'Nomor Telepon sudah terdaftar.';
	}
	if (empty($data['yearfounded'])) $data['yearfoundedError'] = 'Tahun didirikan tidak boleh kosong.';
	if (empty($data['emailtoko'])) {
		$data['emailtokoError'] = 'emailtoko tidak boleh kosong.';
	} elseif (!filter_var($data['emailtoko'], FILTER_VALIDATE_EMAIL)) {
		$data['emailtokoError'] = 'Format email toko tidak valid.';
	} elseif ($cekemail > 0) {
		$data['emailtokoError'] = 'Email sudah terdaftar.';
	}

	// Return errors if any
	if (!empty($data['namatokoError']) || !empty($data['tipetokoError']) || !empty($data['lokasiError']) || 
		!empty($data['telepontokoError']) || !empty($data['emailtokoError']) || !empty($data['yearfoundedError'])) {
		$this->view('templates/s-header', $data);
		$this->view('user/toko', $data);
		return;
	}


	// Insert data
	  if ($this->model('User_model')->daftarToko($_POST) > 0) {
		  // Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
		  $this->model('User_model')->activateStoreID();
		  header('Location: ' . BASEURL . '/dashboard');
		  $_SESSION['status']='success';
		  exit;
	  } else {
		  // Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
		  // header('Location: ' . BASEURL . '/dashboard/toko');
		  echo 'Gagal memasukkan data';
		  exit;
	  }
  }



  public function loginAcc() {

	function sanitizeInput($input) {
		return strtolower(trim($input));
	}

		$data = [
			'judul' => 'Login',
			'email' => sanitizeInput($_POST['email']) ?? '',
			'password' => $_POST['password'] ?? '',
			'captcha' => $_POST['g-recaptcha-response'] ?? '',
			'loginEmailError' => '',
			'loginPasswordError' => '',
			'captchaError' => ''
		];

		// Validate email
		if (empty($data['email'])) {
			$data['loginEmailError'] = 'Email tidak boleh kosong.';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$data['loginEmailError'] = 'Format email tidak valid.';
		}

		// Validate password
		if (empty($data['password'])) {
			$data['loginPasswordError'] = 'Password tidak boleh kosong.';
		}

		// Validate CAPTCHA
		if (empty($data['captcha'])) {
			$data['captchaError'] = 'Captcha tidak boleh kosong.';
		} else {
			$secret = '6LdmtowqAAAAANi_nfbZ1XqYUgpZKVEwpzgt2x0w'; // Your Google reCAPTCHA secret key
			// $secret='6LeouZIqAAAAAMs0tpXmcR874nx-mw-K7pVYbTnW';
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$data['captcha']}");
			$responseKeys = json_decode($response, true);

			if (intval($responseKeys['success']) !== 1) {
				$data['captchaError'] = 'Captcha tidak valid.';
			}
		}

		// If there are errors, show the login form again
		if (!empty($data['loginEmailError']) || !empty($data['loginPasswordError']) || !empty($data['captchaError'])) {
			$this->view('templates/i-header', $data);
			$this->view('user/login', $data);
			$this->view('templates/footer');
			return;
		}

		// If no errors, proceed with login
		if ($this->model('User_model')->masuk($_POST)) {
			// if ($this->model('User_model')->checkRowToko() == 0) {
			$this->model('User_model')->activateStoreID();
			$this->model('User_model')->activateStoreName();
			header('Location: ' . BASEURL . '/dashboard');
			// } else {
			// 	header('Location: ' . BASEURL . '/dashboard');
			// }
		} else {
			$data['loginEmailError'] = 'Email atau password salah.';
			$this->view('templates/i-header', $data);
			$this->view('user/login', $data);
			$this->view('templates/footer');
		}
	}

	public function getToko() {
		echo json_encode(
			$this->model('User_model')->getEditToko($_SESSION['user_id'])
		);
	}

	public function updateToko() {
		$data = [
			'namatoko' => $_POST['namatoko'] ?? '',
			'tipetoko' => $_POST['tipetoko'] ?? '',
			'lokasi' => $_POST['lokasi'] ?? '',
			'telepontoko' => $_POST['telepontoko'] ?? '',
			'emailtoko' => $_POST['emailtoko'] ?? '',
			'yearfounded' => $_POST['yearfounded'] ?? '',
			'namatokoError' => '',
			'tipetokoError' => '',
			'lokasiError' => '',
			'telepontokoError' => '',
			'emailtokoError' => '',
			'yearfoundedError' => '',
			'judul' => 'Profile Toko'
		];
		$cekemail = $this->model('User_model')->cekEmailToko($data['emailtoko']);
		$ceknomortelepon = $this->model('User_model')->cekNomorTeleponToko($data['telepontoko']);
	
		// Validate data
		if (empty($data['namatoko'])) $data['namatokoError'] = 'Nama tidak boleh kosong.';
		if (empty($data['tipetoko'])) $data['tipetokoError'] = 'Tipe toko tidak boleh kosong.';
		if (empty($data['lokasi'])) $data['lokasiError'] = 'Alamat tidak boleh kosong.';
		if (empty($data['telepontoko'])) $data['telepontokoError'] = 'Nomor Telepon tidak boleh kosong.';
		if (empty($data['yearfounded'])) $data['yearfoundedError'] = 'Tahun didirikan tidak boleh kosong.';
		if (empty($data['emailtoko'])) {
			$data['emailtokoError'] = 'emailtoko tidak boleh kosong.';
		} elseif (!filter_var($data['emailtoko'], FILTER_VALIDATE_EMAIL)) {
			$data['emailtokoError'] = 'Format email toko tidak valid.';
		} elseif ($cekemail > 0) {
			$data['emailtokoError'] = 'Email toko sudah terdaftar.';
		}
		if (empty($data['telepontoko'])) {
			$data['telepontokoError'] = 'Nomor Telepon tidak boleh kosong.';
		} elseif ($ceknomortelepon > 0) {
			$data['telepontokoError'] = 'Nomor Telepon sudah terdaftar.';
		}

	
		// Return errors if any
		if (!empty($data['namatokoError']) || !empty($data['tipetokoError']) || !empty($data['lokasiError']) || 
			!empty($data['telepontokoError']) || !empty($data['emailtokoError']) || !empty($data['yearfoundedError'])) {
			$this->view('templates/s-header', $data);
			$this->view('user/tokoinfo', $data);
			echo "<script>
							modal.classList.remove('hidden');
							toko.classList.add('hidden');
						</script>";
			return;
		}
	
		// Insert data
		if ($this->model('User_model')->editToko($_POST) > 0) {
			// Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
			header('Location: ' . BASEURL . '/dashboard/toko');
			exit;
		} else {
			// Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
			// header('Location: ' . BASEURL . '/dashboard/toko');
			echo 'Gagal memasukkan data';
			exit;
		}
	}


}

?>