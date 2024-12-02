<div class="mt-[200px] mx-[350px] bg-white shadow-lg rounded-lg overflow-hidden">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
    <!-- Register Panel -->
    <div class="w-1/2  flex items-center justify-center">
      <div class="m-0 bg-[#FFD369] w-2/5 h-full rounded-lg text-center p-6 flex flex-col items-center justify-center">
          <img src="<?= BASEURL; ?>/img/invensync-logo.png" width="300px" height="300px" class="rounded-circle mb-4" alt="ripat">
          <p class="text-2xl font-bold text-black mb-4">Sudah Punya Akun? Login Sekarang Juga!</p>
          <a href="<?= BASEURL; ?>/user/login" class="text-2xl font-bold text-black mb-8 py-2 px-4 border-2 border-black rounded-lg hover:bg-black hover:text-white transition duration-100">
            Loginkan!
          </a>
      </div>
      <!-- Formulir Register -->
    <div class="w-3/5 h-full px-10 py-8 bg-white">
    <h3 class="text-center font-black text-4xl py-4 text-gray-800">Register Akun</h3>
    <form id="myForm" action="<?= BASEURL; ?>/user/createAcc" method="post">
      <div class="flex gap-4 mb-6">
        <input type="hidden" name="role" value="Owner">
        <div class="w-1/2">
            <label for="name" class="flex text-gray-700 font-medium mb-2">Nama<p class="text-red-500">*</p></label>
            <input 
                id="name"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text" 
                name="name" 
                value="<?= htmlspecialchars($data['name'] ?? '', ENT_QUOTES); ?>"
                placeholder="Nama">
            <span class="text-red-500"><?= $data['nameError']; ?></span>
        </div>
        <div class="w-1/2">
            <label for="email" class="flex text-gray-700 font-medium mb-2">Email<p class="text-red-500">*</p></label>
            <input 
                id="email"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="email" 
                name="email" 
                value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>"
                placeholder="Email">
            <span class="text-red-500"><?= $data['emailError']; ?></span>
        </div>
    </div>
    <div class="flex gap-4 mb-6">
        <div class="w-1/2">
            <label for="address" class="flex text-gray-700 font-medium mb-2">Alamat<p class="text-red-500">*</p></label>
            <input 
                id="address"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text" 
                name="address" 
                value="<?= htmlspecialchars($data['address'] ?? '', ENT_QUOTES); ?>"
                placeholder="Address">
            <span class="text-red-500"><?= $data['addressError']; ?></span>
        </div>
        <div class="w-1/2">
            <label for="phonenumber" class="flex text-gray-700 font-medium mb-2">No Telepon<p class="text-red-500">*</p></label>
            <input 
                id="phonenumber"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="number" 
                name="phonenumber" 
                value="<?= htmlspecialchars($data['phonenumber'] ?? '', ENT_QUOTES); ?>"
                placeholder="No Telepon">
            <span class="text-red-500"><?= $data['phonenumberError']; ?></span>
        </div>
    </div>
    <div class="flex gap-4 mb-6">
    <div class="w-1/2">
            <label for="password" class="flex text-gray-700 font-medium mb-2">Password<p class="text-red-500">*</p></label>
            <input 
                id="password"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="password" 
                name="password" 
                value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>"
                placeholder="Buat Password Anda">
            <span class="text-red-500"><?= $data['passwordError']; ?></span>
        </div>
        <div class="w-1/2">
            <label for="password" class="flex text-gray-700 font-medium mb-2">Konfirmasi Password<p class="text-red-500">*</p></label>
            <input 
                id="confirmPassword"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="password" 
                value="<?= htmlspecialchars($data['confirmPassword'] ?? '', ENT_QUOTES); ?>"
                name="confirmPassword" 
                placeholder="Ketik Ulang Password Anda">
            <span class="text-red-500"><?= $data['confirmPasswordError']; ?></span>
        </div>
    </div>
    <button type="submit" name="daftar" class="w-full bg-blue-600 text-white py-3 rounded-lg mt-4 hover:bg-blue-700">Daftar</button>
</form>

      </div>
    </div>
  </div>
</div>

<script>
  // public function InstantLogin(){
  //   const panels = document.getElementById("auth-panels");
  //   panels.style.transition = "none"; // Hapus transisi
  //   panels.style.transform = "translateX(0)"; // Geser ke panel login
  //   document.getElementById("register-button").style.display = "block";
  // }
  // public function InstantRegister(){
  //   const panels = document.getElementById("auth-panels");
  //   panels.style.transition = "none"; // Hapus transisi
  //   panels.style.transform = "translateX(-50%)"; // Geser ke panel login
  //   document.getElementById("login-button").style.display = "block";
  // }
  function SwitchLogin() {
    const panels = document.getElementById("auth-panels");
    panels.style.transform = "translateX(0)";
    document.getElementById("register-button").style.display = "block";
  }

  function SwitchRegister() {
    const panels = document.getElementById("auth-panels");
    panels.style.transform = "translateX(-50%)";
    document.getElementById("login-button").style.display = "block";
  }
</script>
