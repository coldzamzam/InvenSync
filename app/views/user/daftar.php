<div class="relative my-[250px] mx-[350px] bg-white shadow-lg rounded-lg overflow-hidden">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
    <!-- Login Panel -->
    <div class="w-1/2 bg-white items-center flex justify-center">
        <div class="w-3/5 p-12">
          <h2 class="text-4xl font-bold mb-6 text-black text-center">Login</h2>
            <form>
              <div class="mb-4">
                <label class="block mb-1 text-black font-medium">Email*</label>
                <input type="email" placeholder="Enter your email" class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
              </div>
              <div class="mb-4">
                <label class="block mb-1 text-black font-medium">Password*</label>
                <input type="password" placeholder="Minimum 8 characters" class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
              </div>
              <div class="text-right mb-4">
                <p class="mt-6 text-sm text-black">
                  Not registered yet? <a href="#" onclick="Register()" class="text-blue-600 hover:underline">Create a new account</a>
                </p>
                <a href="#" class="text-sm text-gray-600 hover:underline">Forgot Password?</a>
              </div>
              <button type="submit" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                Login
              </button>
            </form>
            
        </div>
      
      <div class="m-0 bg-[#FFD369] w-2/5 h-full flex justify-center rounded-lg text-center p-6 items-center row">
            <img src="<?= BASEURL; ?>/img/ripat.jpg" width="200px" height="200px" class="rounded-circle mb-4" alt="ripat">
            <p class="text-2xl font-bold text-black mb-4">Belum Punya Akun? Daftar dan Kembangkan Bisnismu Mulai dari Inventaris dengan InvenSync!</p>
            <button
              onclick="Register()"
              class="bg-black text-white py-2 px-6 rounded-lg shadow hover:bg-gray-800">
              SignUp
            </button>
      </div>
    </div>
    

    <!-- Register Panel -->
    <div class="w-1/2  flex items-center justify-center">
      <div class="m-0 bg-[#FFD369] w-2/5 h-full flex justify-center rounded-lg text-center p-6 items-center row">
        <img src="<?= BASEURL; ?>/img/aqsa.png" width="200px" height="200px" class="rounded-circle mb-4" alt="ripat">
          <p class="text-2xl font-bold text-black mb-4">Sudah Punya Akun? Masuk dan Kembangkan Bisnismu Mulai dari Inventaris dengan InvenSync! </p>
        <button
          onclick="Login()"
          class="bg-black text-white py-2 px-6 rounded-lg shadow hover:bg-gray-800">
          Login
        </button>
      </div>
      <!-- Formulir Register -->
      <div class="w-3/5 h-full px-10 py-8 bg-white">
        <h3 class="text-center font-black text-4xl py-4 text-gray-800">Register</h3>
        <form action="<?= BASEURL; ?>/user/regist" method="post">
          <div class="flex gap-4 mb-6">
            <div class="w-1/2">
              <label for="namatoko" class="block text-gray-700 font-medium mb-2">Nama Toko</label>
              <input 
                id="namatoko"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text" 
                name="namatoko" 
                placeholder="Nama Toko">
            </div>
            <div class="w-1/2">
              <label for="tipetoko" class="block text-gray-700 font-medium mb-2">Tipe Toko</label>
              <select 
                id="tipetoko"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                name="tipetoko">
                <option selected>Tipe Toko</option>
                <option value="Toko Kelontong">Toko Kelontong</option>
                <option value="Toko Hewan">Toko Hewan</option>
                <option value="Toko Pakaian">Toko Pakaian</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
          <div class="flex gap-4 mb-6">
            <div class="w-1/2">
              <label for="lokasi" class="block text-gray-700 font-medium mb-2">Lokasi</label>
              <input 
                id="lokasi"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text" 
                name="lokasi" 
                placeholder="Lokasi">
            </div>
            <div class="w-1/2">
              <label for="telepontoko" class="block text-gray-700 font-medium mb-2">No Telepon Toko</label>
              <input 
                id="telepontoko"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="number" 
                name="telepontoko" 
                placeholder="No Telepon Toko">
            </div>
          </div>
          <div class="flex gap-4 mb-6">
            <div class="w-1/2">
              <label for="emailtoko" class="block text-gray-700 font-medium mb-2">Email Toko</label>
              <input 
                id="emailtoko"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="email" 
                name="emailtoko" 
                placeholder="Email Toko">
            </div>
            <div class="w-1/2">
              <label for="yearfounded" class="block text-gray-700 font-medium mb-2">Tahun Didirikan</label>
              <input 
                id="yearfounded"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="number" 
                name="yearfounded" 
                placeholder="Tahun Didirikan">
            </div>
          </div>
          <button type="submit" name="daftar" class="w-full bg-blue-600 text-white py-3 rounded-lg mt-4 hover:bg-blue-700">Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function Login() {
    const panels = document.getElementById("auth-panels");
    panels.style.transform = "translateX(0)"; // Geser ke panel login
    document.getElementById("register-button").style.display = "block";
  }

  function Register() {
    const panels = document.getElementById("auth-panels");
    panels.style.transform = "translateX(-50%)"; // Geser ke panel register
    document.getElementById("login-button").style.display = "block";
  }
</script>
