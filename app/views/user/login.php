<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('<?= BASEURL; ?>/img/background-login.jpg')">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex" style="margin-top: 90px;">
    <!-- Login Panel -->
    <div class="w-3/5 px-4 py-12 flex items-center justify-center bg-white">
      <div class="w-full max-w-xs">
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
            <label class="mb-1 text-black font-medium flex">Password<p class="text-red-500 ml-1">*</p></label>
            <input type="password" name="password" placeholder="Minimum 8 characters" 
                   value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>" 
                   class="w-full p-2 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
            <span class="text-red-500 text-sm"><?= $data['loginPasswordError']; ?></span>
          </div>
          
          <!-- CAPTCHA -->
          <div class="mb-4">
            <label class="mb-1 text-black font-medium flex">Captcha<p class="text-red-500 ml-1">*</p></label>
            <div class="flex items-center justify-center">
              <div class="g-recaptcha" data-sitekey="6LdmtowqAAAAANx4ZqJ34DmNJ5E9q-Gh_HlDLQzX"></div>
            </div>
            <span class="text-red-500 text-sm"><?= $data['captchaError']; ?></span>
          </div>
          
          <button type="submit" name="login" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-300">
            Login
          </button>
        </form>
      </div>
    </div>

    <!-- Registration Panel -->
    <div class="w-2/5 bg-[#FFD369] flex flex-col items-center justify-center p-4 text-center">
      <img src="<?= BASEURL; ?>/img/invensync-logo.png" 
           class="w-36 h-36 object-contain rounded-full mb-3" 
           alt="Invensync Logo">
      <p class="text-xl font-bold text-black mb-4">Belum Punya Akun? Daftarkan Sekarang!</p>
      <a href="<?= BASEURL; ?>/user/register" 
         class="text-base font-bold text-black py-2 px-4 border-2 border-black rounded-lg 
                hover:bg-black hover:text-white transition duration-300">
        Daftarkan!
      </a>
    </div>
  </div>
</div>