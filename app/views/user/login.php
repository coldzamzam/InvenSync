<div class="relative my-[250px] mx-[350px] bg-white shadow-lg rounded-lg overflow-hidden">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
    <!-- Login Panel -->
    <div class="w-1/2 bg-white items-center flex justify-center">
        <div class="w-3/5 p-12">
          <h2 class="text-4xl font-bold mb-6 text-black text-center">Login</h2>
            <form action="<?= BASEURL; ?>/user/loginAcc" method="post">
              <div class="mb-4">
                <label class="block mb-1 text-black font-medium">Email*</label>
                <input type="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>" class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
                <span class="text-red-500"><?= $data['loginEmailError']; ?></span>
              </div>
              <div class="mb-4">
                <label class="block mb-1 text-black font-medium">Password*</label>
                <input type="password" name="password" placeholder="Minimum 8 characters" value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>" class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
                <span class="text-red-500"><?=$data['loginPasswordError']?></span>
              </div>
              <button type="submit" name="login" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                Login
              </button>
            </form>
            
        </div>
      
      <div class="m-0 bg-[#FFD369] w-2/5 h-full flex justify-center rounded-lg text-center p-6 items-center row">
            <img src="<?= BASEURL; ?>/img/ripat.jpg" width="200px" height="200px" class="rounded-circle mb-4" alt="ripat">
            <p class="text-2xl font-bold text-black mb-4">Selamat Datang! Ayo Awali harimu dengan login ke InvenSync!</p>
      </div>
    </div>
  </div>
</div>

