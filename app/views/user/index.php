<div class="mt-[100px] mx-auto bg-white shadow-lg rounded-lg overflow-hidden max-w-2xl" style="margin-top: 200px;">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
    <!-- Register Panel -->
    <div class="w-1/2 flex items-center justify-center">
      <div class="m-0 bg-[#FFD369] w-2/5 h-full rounded-lg text-center p-6 flex flex-col items-center justify-center">
        <img src="<?= BASEURL; ?>/img/invensync-logo.png" width="250px" height="250px" class="rounded-circle mb-4" alt="ripat">
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
              <input id="password" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>" placeholder="Password">
              <span class="text-red-500"><?= $data['passwordError']; ?></span>
            </div>
            <div class="flex-1">
              <label for="confirmPassword" class="text-gray-700 font-medium mb-2 text-sm">Konfirmasi Password <span class="text-red-500">*</span></label>
              <input id="confirmPassword" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="confirmPassword" value="<?= htmlspecialchars($data['confirmPassword'] ?? '', ENT_QUOTES); ?>" placeholder="Konfirmasi Password">
              <span class="text-red-500"><?= $data['confirmPasswordError']; ?></span>
            </div>
          </div>
          <button type="submit" name="daftar" class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 hover:bg-blue-700">
            Daftar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_SESSION['status'])):
    $status = $_SESSION['status']; // Get status from session
    unset($_SESSION['status']); // Remove status from session after using it
?>
    <script>
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
    </script>
<?php endif; ?>