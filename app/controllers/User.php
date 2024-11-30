<?php

class User extends Controller {
  public function index(){
	$data['nameError'] = '';
	$data['roleError'] = '';
	$data['addressError'] = '';
	$data['phonenumberError'] = '';
	$data['emailError'] = '';
	$data['passwordError'] = '';
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
	$data = [
		'name' => $_POST['name'] ?? '',
		'role' => $_POST['role'] ?? '',
		'address' => $_POST['address'] ?? '',
		'phonenumber' => $_POST['phonenumber'] ?? '',
		'email' => $_POST['email'] ?? '',
		'password' => $_POST['password'] ?? '',
		'nameError' => '',
		'roleError' => '',
		'addressError' => '',
		'phonenumberError' => '',
		'emailError' => '',
		'passwordError' => '',
		'loginEmailError' => '',
		'loginPasswordError' => '',
		'judul' => 'Buat Akun'
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
		$data['passwordError'] = 'Password tidak boleh kosong.';
	} elseif (strlen($data['password']) < 8 || !preg_match("#[0-9]+#", $data['password']) || 
			  !preg_match("#[A-Z]+#", $data['password']) || !preg_match("#[a-z]+#", $data['password'])) {
		$data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
	}

	// Return errors if any
	if (!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) || 
		!empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'])) {
		$this->view('templates/i-header', $data);
		$this->view('user/index', $data);
		$this->view('templates/footer');
		return;
	}

	// Insert data
	if ($this->model('User_model')->daftar($data) > 0) {
		Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
		header('Location: ' . BASEURL . '/user/login');
		exit;
	} else {
		Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
		header('Location: ' . BASEURL . '/user');
		exit;
	}
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
		$data = [
			'judul' => 'Login',
			'email' => $_POST['email'] ?? '',
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