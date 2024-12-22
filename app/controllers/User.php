<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


class User extends Controller
{
	public function index()
	{
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

	public function login()
	{
		$data['loginEmailError'] = '';
		$data['loginPasswordError'] = '';
		$data['captchaError'] = '';

		$data['judul'] = 'Login';
		$this->view('templates/i-header', $data);
		$this->view('user/login', $data);
		$this->view('templates/footer');
	}

	public function daftar()
	{
		$data['judul'] = 'Daftar Akun';
		$this->view('templates/i-header', $data);
		$this->view('user/daftar', $data);
		$this->view('templates/footer');

	}

	public function regist()
	{
		if ($this->model('User_model')->daftarToko($_POST) > 0) {
			Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
			header('Location: ' . BASEURL . '/user');
			exit;
		} else {
			Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
			header('Location: ' . BASEURL . '/user');
			exit;
		}
	}


	public function createAcc()
	{

		function sanitizeInputSignIn($input)
		{
			return strtolower(trim($input));
		}

		$mail = new PHPMailer(true);

		$data = [
			'name' => $_POST['name'] ?? '',
			'role' => $_POST['role'] ?? '',
			'address' => $_POST['address'] ?? '',
			'phonenumber' => $_POST['phonenumber'] ?? '',
			'email' => sanitizeInputSignIn($_POST['email']) ?? '',
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
		$cekemail = $this->model('User_model')->cekEmail($data['email']);
		$ceknomortelepon = $this->model('User_model')->cekNomorTelepon($data['phonenumber']);

		// Validate data
		if (empty($data['name']))
			$data['nameError'] = 'Nama tidak boleh kosong.';
		if (empty($data['role']))
			$data['roleError'] = 'Role tidak boleh kosong.';
		if (empty($data['address']))
			$data['addressError'] = 'Alamat tidak boleh kosong.';
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
		} elseif (
			strlen($data['password']) < 8 ||
			!preg_match("#[0-9]+#", $data['password']) ||
			!preg_match("#[A-Z]+#", $data['password']) ||
			!preg_match("#[a-z]+#", $data['password'])
		) {
			$data['passwordError'] = 'Password harus terdiri dari minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
		}
		$data['confirmPassword'] = $_POST['confirmPassword'] ?? '';
		if (empty($data['confirmPassword'])) {
			$data['confirmPasswordError'] = 'Konfirmasi password tidak boleh kosong.';
		} elseif ($data['password'] !== $data['confirmPassword']) {
			$data['confirmPasswordError'] = 'Konfirmasi password tidak sesuai.';
		}



		// Return errors if any
		if (
			!empty($data['nameError']) || !empty($data['roleError']) || !empty($data['addressError']) ||
			!empty($data['phonenumberError']) || !empty($data['emailError']) || !empty($data['passwordError'] || !empty($data['confirmPasswordError']))
		) {
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
				$mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth = true;                                   //Enable SMTP authentication
				$mail->Username = 'rifatok123@gmail.com';                     //SMTP username
				$mail->Password = 'xpbn gjvc kkve rvcq';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				$mail->setFrom('from@InvenSync.com', 'Verification');
				$mail->addAddress($data['email'], $data['name']);     //Add a recipient
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Verifikasi Pendaftaran Akun InvenSync';
				$mail->Body = "
									<!DOCTYPE html>
									<html lang='en'>
									<head>
											<meta charset='UTF-8'>
											<meta name='viewport' content='width=device-width, initial-scale=1.0'>
											<style>
													body {
															font-family: Arial, sans-serif;
															line-height: 1.6;
															background-color: #f9f9f9;
															color: #333;
															margin: 0;
															padding: 0;
													}
													.container {
															max-width: 600px;
															margin: 20px auto;
															background: #ffffff;
															border-radius: 8px;
															box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
															overflow: hidden;
													}
													.header {
															background-color: #4CAF50;
															color: #ffffff;
															padding: 20px;
															text-align: center;
													}
													.content {
															padding: 20px;
													}
													.content h1 {
															font-size: 24px;
															margin: 0 0 10px;
													}
													.content p {
															font-size: 16px;
															margin: 10px 0;
													}
													.btn {
															display: inline-block;
															background-color: #4CAF50;
															color: #ffffff;
															text-decoration: none;
															padding: 10px 20px;
															border-radius: 5px;
															font-size: 16px;
															margin: 10px 0;
													}
													.btn:hover {
															background-color: #45a049;
													}
													.footer {
															text-align: center;
															padding: 10px;
															background-color: #f1f1f1;
															font-size: 14px;
															color: #666;
													}
													.footer a {
															color: #4CAF50;
															text-decoration: none;
													}
											</style>
									</head>
									<body>
											<div class='container'>
													<div class='header'>
															<h2>Verifikasi Akun InvenSync</h2>
													</div>
													<div class='content'>
															<h1>Halo, {$data['name']}!</h1>
															<p>Terima kasih telah mendaftar di InvenSync. Klik tombol di bawah ini untuk memverifikasi akun Anda:</p>
															<a href='" . BASEURL . "/user/verify/{$data['verificationCode']}' class='btn'>Verifikasi Akun</a>
															<p>Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut di browser Anda:</p>
															<p><a href='" . BASEURL . "/user/verify/{$data['verificationCode']}'>" . BASEURL . "/user/verify/{$data['verificationCode']}</a></p>
															<p>Terima kasih telah bergabung dengan kami!</p>
													</div>
											</div>
									</body>
									</html>
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
	}

	public function verify($code = null)
	{
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



	public function createToko()
	{


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
			'totalnotifications' => $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'],
			'notifications' => $this->model('Item_model')->getTotalStockItem(),
			'judul' => 'Profile Toko'
		];
		$cekemail = $this->model('User_model')->cekEmailToko($data['emailtoko']);
		$ceknomortelepon = $this->model('User_model')->cekNomorTeleponToko($data['telepontoko']);

		// Validate data
		if (empty($data['namatoko']))
			$data['namatokoError'] = 'Nama tidak boleh kosong.';
		if (empty($data['tipetoko']))
			$data['tipetokoError'] = 'Tipe toko tidak boleh kosong.';
		if (empty($data['lokasi']))
			$data['lokasiError'] = 'Alamat tidak boleh kosong.';
		if (empty($data['telepontoko'])) {
			$data['telepontokoError'] = 'Nomor Telepon tidak boleh kosong.';
		} elseif ($ceknomortelepon > 0) {
			$data['telepontokoError'] = 'Nomor Telepon sudah terdaftar.';
		}
		if (empty($data['yearfounded']))
			$data['yearfoundedError'] = 'Tahun didirikan tidak boleh kosong.';
		if (empty($data['emailtoko'])) {
			$data['emailtokoError'] = 'emailtoko tidak boleh kosong.';
		} elseif (!filter_var($data['emailtoko'], FILTER_VALIDATE_EMAIL)) {
			$data['emailtokoError'] = 'Format email toko tidak valid.';
		} elseif ($cekemail > 0) {
			$data['emailtokoError'] = 'Email sudah terdaftar.';
		}

		// Return errors if any
		if (
			!empty($data['namatokoError']) || !empty($data['tipetokoError']) || !empty($data['lokasiError']) ||
			!empty($data['telepontokoError']) || !empty($data['emailtokoError']) || !empty($data['yearfoundedError'])
		) {
			$this->view('templates/s-header', $data);
			$this->view('user/toko', $data);
			return;
		}


		// Insert data
		if ($this->model('User_model')->daftarToko($_POST) > 0) {
			// Flasher::setFlash('Data toko', 'berhasil', 'dibuat', 'success');
			$this->model('User_model')->activateStoreID();
			$this->model('User_model')->setOwnerStoreID();
			header('Location: ' . BASEURL . '/dashboard');
			$_SESSION['status'] = 'success';
			exit;
		} else {
			// Flasher::setFlash('Data toko', 'gagal', 'dibuat', 'danger');
			// header('Location: ' . BASEURL . '/dashboard/toko');
			echo 'Gagal memasukkan data';
			exit;
		}
	}



	public function loginAcc()
	{

		function sanitizeInputLogin($input)
		{
			return strtolower(trim($input));
		}

		$data = [
			'judul' => 'Login',
			'email' => sanitizeInputLogin($_POST['email']) ?? '',
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
		// if ($this->model('User_model')->checkDeleted($data['email']) > 0) {
		// 	$_SESSION['status'] = 'deleted';
		// 	header('Location: ' . BASEURL . '/user/login');
		// } else 
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

	public function getToko()
	{
		echo json_encode(
			$this->model('User_model')->getEditToko($_SESSION['user_id'])
		);
	}

	public function updateToko()
	{
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
		if (empty($data['namatoko']))
			$data['namatokoError'] = 'Nama tidak boleh kosong.';
		if (empty($data['tipetoko']))
			$data['tipetokoError'] = 'Tipe toko tidak boleh kosong.';
		if (empty($data['lokasi']))
			$data['lokasiError'] = 'Alamat tidak boleh kosong.';
		if (empty($data['telepontoko']))
			$data['telepontokoError'] = 'Nomor Telepon tidak boleh kosong.';
		if (empty($data['yearfounded']))
			$data['yearfoundedError'] = 'Tahun didirikan tidak boleh kosong.';
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
		if (
			!empty($data['namatokoError']) || !empty($data['tipetokoError']) || !empty($data['lokasiError']) ||
			!empty($data['telepontokoError']) || !empty($data['emailtokoError']) || !empty($data['yearfoundedError'])
		) {
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

	public function deleteToko()
	{
		$data = [
			'id' => $_POST['id'] ?? '',
			'store_id' => $_POST['storeID'] ?? '',
			'email' => $_POST['email'] ?? '',
			'name' => $_POST['name'] ?? '',
			'deleteVerificationCode' => bin2hex(random_bytes(16)),
		];
		$mail = new PHPMailer(true);

		$this->model('User_model')->setDeleteToken($data['deleteVerificationCode'], $data['store_id']);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth = true;                                   //Enable SMTP authentication
			$mail->Username = 'rifatok123@gmail.com';                     //SMTP username
			$mail->Password = 'xpbn gjvc kkve rvcq';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('from@InvenSync.com', 'Verification');
			$mail->addAddress($data['email'], $data['name']);     //Add a recipient

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Verifikasi Penghapusan Akun dan Toko';
			$mail->Body = "
                <!DOCTYPE html>
								<html lang='en'>
								<head>
										<meta charset='UTF-8'>
										<meta name='viewport' content='width=device-width, initial-scale=1.0'>
										<style>
												body {
														font-family: Arial, sans-serif;
														line-height: 1.6;
														background-color: #f9f9f9;
														color: #333;
														margin: 0;
														padding: 0;
												}
												.container {
														max-width: 600px;
														margin: 20px auto;
														background: #ffffff;
														border-radius: 8px;
														box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
														overflow: hidden;
												}
												.header {
														background-color: #e74c3c;
														color: #ffffff;
														padding: 20px;
														text-align: center;
												}
												.content {
														padding: 20px;
												}
												.content h1 {
														font-size: 24px;
														margin: 0 0 10px;
												}
												.content p {
														font-size: 16px;
														margin: 10px 0;
												}
												.btn {
														display: inline-block;
														background-color: #e74c3c;
														color: #ffffff;
														text-decoration: none;
														padding: 10px 20px;
														border-radius: 5px;
														font-size: 16px;
														margin: 10px 0;
												}
												.btn:hover {
														background-color: #c0392b;
												}
												.footer {
														text-align: center;
														padding: 10px;
														background-color: #f1f1f1;
														font-size: 14px;
														color: #666;
												}
												.footer a {
														color: #e74c3c;
														text-decoration: none;
												}
										</style>
								</head>
								<body>
										<div class='container'>
												<div class='header'>
														<h2>Konfirmasi Penghapusan Akun</h2>
												</div>
												<div class='content'>
														<h1>Halo, {$data['name']}!</h1>
														<p>Kami menerima permintaan untuk menghapus akun dan toko Anda. Jika Anda yakin ingin melanjutkan, klik tombol di bawah ini:</p>
														<a href='" . BASEURL . "/user/deletewholeaccount/{$data['deleteVerificationCode']}' class='btn'>Hapus Akun dan Toko Anda</a>
														<p>Jika Anda tidak melakukan permintaan ini, abaikan email ini. Akun Anda akan tetap aman.</p>
														<p>Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut di browser Anda:</p>
														<p><a href='" . BASEURL . "/user/deletewholeaccount/{$data['deleteVerificationCode']}'>" . BASEURL . "/user/deletewholeaccount/{$data['deleteVerificationCode']}</a></p>
												</div>
												<div class='footer'>
														<p>Jika Anda memiliki pertanyaan, hubungi kami di <a href='mailto:support@invencsync.com'>support@invencsync.com</a></p>
														<p>&copy; " . date('Y') . " InvenSync. All rights reserved.</p>
												</div>
										</div>
								</body>
								</html>
            ";
			if ($mail->send()) {
				$_SESSION['status'] = 'deleteRequest';
				header('Location: ' . BASEURL . '/home');
			} else {
				Flasher::setFlash('Gagal', 'Gagal mengirim email verifikasi.', 'Tutup', 'danger');
			}
		} catch (Exception $e) {
			Flasher::setFlash('Gagal', 'Kesalahan server: ' . $mail->ErrorInfo, 'Tutup', 'danger');
		}

	}

	public function deletewholeaccount($code = null)
	{
		if (!$code) {
			Flasher::setFlash('Gagal', 'Token tidak valid.', 'Tutup', 'danger');
			header('Location: ' . BASEURL . '/fesbuk');
			exit;
		}
		$store = $this->model('User_model')->getStoreByToken($code);

		if (!$store) {
			Flasher::setFlash('Gagal', 'Token tidak valid atau sudah kadaluarsa.', 'Tutup', 'danger');
			header('Location: ' . BASEURL . '/fesbuk');
			exit;
		}

		$this->model('User_model')->deleteAccounts($store['STORE_ID']);
		$this->model('User_model')->deleteReceipts($store['STORE_ID']);
		$this->model('User_model')->deleteStore($store['STORE_ID']);
		$this->model('User_model')->deleteInventory($store['STORE_ID']);
		$this->model('User_model')->deleteItems($store['STORE_ID']);
		$this->model('User_model')->deleteBrand($store['STORE_ID']);
		$this->model('User_model')->deleteCategory($store['STORE_ID']);
		$this->model('User_model')->removeDeleteToken($store['STORE_ID']);

		$_SESSION['status'] = 'terhapus';

		header('Location: ' . BASEURL . '/home');
		exit;
	}

	public function cancelDeletion($token = null)
	{
		$this->model('User_model')->cancelDeletion($_SESSION['store_id']);
		$data['status'] = 'cancelled';

		header('Location: ' . BASEURL . '/dashboard');
		exit;
	}

	public function forgotPassword()
	{
		$data = [
			'emailError' => '',
		];
		$this->view('templates/i-header');
		$this->view('user/forgotPassword', $data);
		$this->view('templates/footer');
	}

	public function sendResetPasswordRequest()
	{
		$mail = new PHPMailer(true);
		function sanitizeInputSignIn($input)
		{
			return strtolower(trim($input));
		}
		$data = [
			'email' => sanitizeInputSignIn($_POST['email']) ?? '',
			'code' => bin2hex(random_bytes(16)),
		];
		if (isset($_POST['email']) && $_POST['email'] != '') {
			$user = $this->model('User_model')->setCodeToAccountWithEmail($data['code'], $data['email'], );
			try {
				//Server settings
				$mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth = true;                                   //Enable SMTP authentication
				$mail->Username = 'rifatok123@gmail.com';                     //SMTP username
				$mail->Password = 'xpbn gjvc kkve rvcq';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('from@InvenSync.com', 'Verification');
				$mail->addAddress($data['email'], $data['name']);     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Permintaan Rest Password';
				$mail->Body = "
								<!DOCTYPE html>
								<html lang='id'>
								<head>
									<meta charset='UTF-8'>
									<meta name='viewport' content='width=device-width, initial-scale=1.0'>
									<style>
										body {
											font-family: Arial, sans-serif;
											line-height: 1.6;
											background-color: #f9f9f9;
											color: #333;
											margin: 0;
											padding: 0;
										}
										.container {
											max-width: 600px;
											margin: 20px auto;
											background: #ffffff;
											border-radius: 8px;
											box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
											overflow: hidden;
										}
										.header {
											background-color: #3498db;
											color: #ffffff;
											padding: 20px;
											text-align: center;
										}
										.content {
											padding: 20px;
										}
										.content h1 {
											font-size: 24px;
											margin: 0 0 10px;
										}
										.content p {
											font-size: 16px;
											margin: 10px 0;
										}
										.btn {
											display: inline-block;
											background-color: #3498db;
											color: #ffffff;
											text-decoration: none;
											padding: 10px 20px;
											border-radius: 5px;
											font-size: 16px;
											margin: 10px 0;
										}
										.btn:hover {
											background-color: #2980b9;
										}
										.footer {
											text-align: center;
											padding: 10px;
											background-color: #f1f1f1;
											font-size: 14px;
											color: #666;
										}
										.footer a {
											color: #3498db;
											text-decoration: none;
										}
									</style>
								</head>
								<body>
									<div class='container'>
										<div class='header'>
											<h2>Permintaan Reset Password</h2>
										</div>
										<div class='content'>
											<h1>Halo,</h1>
											<p>Kami menerima permintaan untuk mereset password Anda. Jika Anda yang membuat permintaan ini, klik tombol di bawah untuk mereset password Anda:</p>
											<a href='" . BASEURL . "/user/resetpassword/{$data['code']}' class='btn'>Reset Password Anda</a>
											<p>Jika Anda tidak meminta reset password, Anda dapat mengabaikan email ini. Akun Anda akan tetap aman.</p>
											<p>Jika tombol di atas tidak berfungsi, salin dan tempelkan tautan berikut ke browser Anda:</p>
											<p><a href='" . BASEURL . "/user/resetpassword/{$data['code']}'>" . BASEURL . "/user/resetpassword/{$data['code']}</a></p>
										</div>
										<div class='footer'>
											<p>Jika Anda memiliki pertanyaan, hubungi kami di <a href='mailto:support@invencsync.com'>support@invencsync.com</a></p>
											<p>&copy; " . date('Y') . " InvenSync. Semua hak dilindungi.</p>
										</div>
									</div>
								</body>
								</html>

            ";
				if ($mail->send()) {
					$_SESSION['status'] = 'resetRequest';
					header('Location: ' . BASEURL . '/user/login');
				} else {
					Flasher::setFlash('Gagal', 'Gagal mengirim email verifikasi.', 'Tutup', 'danger');
				}
			} catch (Exception $e) {
				Flasher::setFlash('Gagal', 'Kesalahan server: ' . $mail->ErrorInfo, 'Tutup', 'danger');
			}
		} else {
			$data['emailError'] = 'Email tidak boleh kosong.';
			$this->view('templates/i-header', $data);
			$this->view('user/forgotPassword', $data);
		}
	}

	public function resetpassword($code = null)
	{
		if (!$code) {
			Flasher::setFlash('Gagal', 'Token tidak valid.', 'Tutup', 'danger');
			header('Location: ' . BASEURL . '/fesbuk');
			exit;
		}

		$data['code'] = $code;

		$this->view('templates/i-header');
		$this->view('user/newPassword', $data);

		exit;
	}

	public function updatepassword()
	{
		$data = [
			'code' => $_POST['code'],
			'new_password' => $_POST['new_password'],
		];
		$this->model('User_model')->updatePassword($data['new_password'], $data['code']);
		$this->model('User_model')->removeCode($data['code']);
		$_SESSION['status'] = 'resetSuccess';
		header('Location: ' . BASEURL . '/user/login');
	}

	public function gantiPassword()
	{
		$data = [
			'user_id' => $_SESSION['user_id'],
			'password' => $_POST['passwordLama'],
			'new_password' => $_POST['passwordBaru'],
		];
		if ($this->model('User_model')->cekPassword($data['password']) == null) {
			header('Location: ' . BASEURL . '/dashboard/toko');
			$_SESSION['status'] = 'gagalReset';
		} else {
			$this->model('User_model')->changePassword($data['new_password']);
			header('Location: ' . BASEURL . '/dashboard/toko');
			$_SESSION['status'] = 'resetSuccess';
		}
	}
}

?>