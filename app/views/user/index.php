<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex mt-[90px]">
    <!-- Register Panel -->
    <div class="flex items-center justify-center">
      <div class="m-0 bg-[#FFD369] w-2/5 h-full rounded-lg text-center p-6 flex flex-col items-center justify-center">
        <img src="<?= BASEURL; ?>/img/invensync-black.png" width="250px" height="250px" class="rounded-circle mb-4" alt="ripat">
        <p class="text-xl md:text-2xl font-bold text-black mb-4">Sudah Punya Akun? Login Sekarang Juga!</p>
        <a href="<?= BASEURL; ?>/user/login" class="text-xl font-bold text-black py-2 px-4 border-2 border-black rounded-lg hover:bg-black hover:text-white transition duration-100">
          Loginkan!
        </a>
      </div>
      
      <!-- Formulir Register -->
      <div class="w-3/5 px-10 py-8 bg-white">
        <h3 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Register Akun</h3>
        <form id="myForm" action="<?= BASEURL; ?>/user/createAcc" method="post">
          <!-- Form Fields -->
          <div class="flex flex-wrap gap-6">
            <input type="hidden" name="role" value="Owner">
            <div class="flex-1">
              <label for="name" class="text-gray-700 font-medium mb-2">Nama <span class="text-red-500">*</span></label>
              <input id="name" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="name" value="<?= htmlspecialchars($data['name'] ?? '', ENT_QUOTES); ?>" placeholder="Nama">
              <span class="text-red-500"><?= $data['nameError']; ?></span>
            </div>
            <div class="flex-1">
              <label for="email" class="text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
              <input id="email" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>" placeholder="Email">
              <span class="text-red-500"><?= $data['emailError']; ?></span>
            </div>
          </div>
          <div class="flex flex-wrap gap-6 mt-4">
            <div class="flex-1">
              <label for="address" class="text-gray-700 font-medium mb-2">Alamat <span class="text-red-500">*</span></label>
              <input id="address" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="address" value="<?= htmlspecialchars($data['address'] ?? '', ENT_QUOTES); ?>" placeholder="Alamat">
              <span class="text-red-500"><?= $data['addressError']; ?></span>
            </div>
            <div class="flex-1">
              <label for="phonenumber" class="text-gray-700 font-medium mb-2">No Telepon <span class="text-red-500">*</span></label>
              <input id="phonenumber" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="number" name="phonenumber" value="<?= htmlspecialchars($data['phonenumber'] ?? '', ENT_QUOTES); ?>" placeholder="No Telepon">
              <span class="text-red-500"><?= $data['phonenumberError']; ?></span>
            </div>
          </div>
          <div class="flex flex-wrap gap-6 mt-4">
            <div class="flex-1">
              <label for="password" class="text-gray-700 font-medium mb-2">Password <span class="text-red-500">*</span></label>
              <div class="relative">
                <input id="password" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      type="password" name="password" 
                      value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>" 
                      placeholder="Password">
                <button type="button" onclick="togglePassword('password', 'eyeIcon1')" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                  <i id="eyeIcon1" class="fas fa-eye"></i>
                </button>
              </div>
              <span class="text-red-500"><?= $data['passwordError']; ?></span>
            </div>
            
            <div class="flex-1">
              <label for="confirmPassword" class="text-gray-700 font-medium mb-2 text-sm">Konfirmasi Password <span class="text-red-500">*</span></label>
              <div class="relative">
                <input id="confirmPassword" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      type="password" name="confirmPassword" 
                      value="<?= htmlspecialchars($data['confirmPassword'] ?? '', ENT_QUOTES); ?>" 
                      placeholder="Konfirmasi Password">
                <button type="button" onclick="togglePassword('confirmPassword', 'eyeIcon2')" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                  <i id="eyeIcon2" class="fas fa-eye"></i>
                </button>
              </div>
              <span class="text-red-500"><?= $data['confirmPasswordError']; ?></span>
            </div>
          </div>
          <button type="submit" name="daftar" class="mt-4 w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-300">
            Daftar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function togglePassword(inputId, eyeIconId) {
    const inputField = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeIconId);

    if (inputField.type === "password") {
      inputField.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      inputField.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }
<?php
  if (isset($_SESSION['status'])):
      $status = $_SESSION['status']; // Get status from session
      unset($_SESSION['status']); // Remove status from session after using it
  ?>

          // Handle SweetAlert based on session status
          let status = '<?= $status ?>';
          if (status === 'success') {
              Swal.fire({
                  title: 'Berhasil!',
                  text: 'Tolong Verifikasi Akunmu Terlebih Dahulu!',
                  icon: 'warning',
              });
          } else if (status === 'errorEmail') {
              Swal.fire({
                  title: 'Error',
                  text: 'Email tidak tersedia!',
                  icon: 'error'
              });
          }

  <?php endif; ?>
</script>