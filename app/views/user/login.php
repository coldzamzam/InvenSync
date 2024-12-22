<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex mt-[90px]">
    <div class="flex items-center justify-between">
        <div class="w-3/5 px-10 py-8 bg-white">
          <h2 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Login</h2>
          <form action="<?= BASEURL; ?>/user/loginAcc" method="post">
            <div class="mb-4">
              <label class="mb-1 text-black font-medium flex">Email<p class="text-red-500 ml-1">*</p></label>
              <input type="email" name="email" placeholder="Enter your email" 
                    value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>" 
                    class="w-full p-2 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
              <span class="text-red-500 text-sm"><?= $data['loginEmailError']; ?></span>
            </div>
            <div class="mb-4">
              <label class="mb-1 text-black font-medium flex">
                Password
                <p class="text-red-500 ml-1">*</p>
              </label>
              <div class="relative w-full flex">
                <input
                  type="password"
                  name="password"
                  id="password"
                  placeholder="Minimum 8 characters"
                  value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>"
                  class="w-full p-2 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                />
                <button type="button" onclick="togglePassword()" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                  <i id="eyeIcon" class="fas fa-eye"></i>
                </button>
              </div>
              <span class="text-red-500 text-sm"><?= $data['loginPasswordError']; ?></span>
              <div>
                <h2>
                  Lupa kata sandi? 
                  <a href="<?= BASEURL; ?>/user/forgotPassword">ganti passwordmu</a>
                </h2>
              </div>
            </div>
            
            <!-- CAPTCHA -->
            <div class="mb-4">
              <label class="mb-1 text-black font-medium flex">Captcha<p class="text-red-500 ml-1">*</p></label>
              <div class="flex items-center justify-center">
                <div class="g-recaptcha" data-sitekey="6LdmtowqAAAAANx4ZqJ34DmNJ5E9q-Gh_HlDLQzX"></div>
              </div>
              <span class="text-red-500 text-sm absolute"><?= $data['captchaError']; ?></span>
            </div>
            <button type="submit" name="login" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-300">
              Login
            </button>
          </form>
        </div>
        <div class="m-0 bg-[#FFD369] w-2/5 h-full rounded-lg text-center p-6 flex flex-col items-center justify-center">
          <img src="<?= BASEURL; ?>/img/invensync-black.png" width="250px" height="250px" class="rounded-circle mb-4" alt="ripat">
          <p class="text-xl md:text-2xl font-bold text-black mb-4">Belum punya akun? Daftar sekarang!</p>
          <a href="<?= BASEURL; ?>/user/index" class="text-xl font-bold text-black py-2 px-4 border-2 border-black rounded-lg hover:bg-black hover:text-white transition duration-100">
            Daftarkan!
          </a>
        </div>
      </div>

    <!-- Registration Panel -->

  </div>
</div>

<script>
<?php
if (isset($_SESSION['status'])):
    $status = $_SESSION['status']; // Get status from session
    unset($_SESSION['status']); // Remove status from session after using it
?>

        // Handle SweetAlert based on session status
        let status = '<?= $status ?>';
        if (status === 'verified') {
            Swal.fire({
                title: 'Berhasil',
                text: 'Akun telah diverifikasi!',
                icon: 'success'
            });
        } else if (status === 'deleted') {
            Swal.fire({
                title: 'Akun Tidak Tersedia',
                text: 'Akun dan Toko anda telah dihapus!',
                icon: 'error'
            });
        } else if (status === 'resetSuccess') {
            Swal.fire({
                title: 'Berhasil',
                text: 'Password telah direset!',
                icon: 'success'
            });
        } else if (status === 'resetRequest') {
            Swal.fire({
                title: 'Permintaan Reset terkirim!',
                text: 'Tolong verifikasi di email anda.',
                icon: 'warning'
            });
        }

<?php endif; ?>    

function togglePassword() {
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    } else {
      passwordField.type = 'password';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    }
  }
</script>