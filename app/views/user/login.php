<div class="mt-[200px] mx-[350px] bg-white shadow-lg rounded-lg overflow-hidden">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
    <!-- Login Panel -->
    <div class="w-1/2 bg-white items-center flex justify-center">
      <div class="w-3/5 p-12">
        <h2 class="text-4xl font-bold mb-6 text-black text-center">Login</h2>
        <form action="<?= BASEURL; ?>/user/loginAcc" method="post">
          <div class="mb-4">
            <label class="mb-1 text-black font-medium flex">Email<p class="text-red-500">*</p></label>
            <input type="email" name="email" placeholder="Enter your email" 
                  value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>" 
                  class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
            <span class="text-red-500"><?= $data['loginEmailError']; ?></span>
          </div>
          <div class="mb-4">
            <label class="mb-1 text-black font-medium flex">Password<p class="text-red-500">*</p></label>
            <input type="password" name="password" placeholder="Minimum 8 characters" 
                  value="<?= htmlspecialchars($data['password'] ?? '', ENT_QUOTES); ?>" 
                  class="w-full p-3 bg-gray-200 rounded-lg focus:outline-none">
            <span class="text-red-500"><?= $data['loginPasswordError']; ?></span>
          </div>
          <!-- CAPTCHA -->
          <div class="mb-4">
            <label class="mb-1 text-black font-medium flex">Captcha<p class="text-red-500">*</p></label>
            <div class="flex items-center">
            <div class="g-recaptcha" data-sitekey="6LdmtowqAAAAANx4ZqJ34DmNJ5E9q-Gh_HlDLQzX"></div>
              <!-- <button class="g-recaptcha" 
                data-sitekey="reCAPTCHA_site_key" 
                data-callback='onSubmit' 
                data-action='submit'>Submit
              </button> -->
            </div>
            <span class="text-red-500"><?= $data['captchaError']; ?></span>
          </div>
          <button type="submit" name="login" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800">
            Login
          </button>
        </form>
      </div>
      <div class="m-0 bg-[#FFD369] w-2/5 h-full rounded-lg text-center p-6 flex flex-col items-center justify-center">
          <img src="<?= BASEURL; ?>/img/invensync-logo.png" width="300px" height="300px" class="rounded-circle mb-4" alt="ripat">
          <p class="text-2xl font-bold text-black mb-8">Belum Punya Akun? Tidak Perlu Khawatir, Daftarkan Sekarang Juga!</p>
          <a href="<?= BASEURL; ?>/user/register" class="text-2xl font-bold text-black mb-4 py-2 px-4 border-2 border-black rounded-lg hover:bg-black hover:text-white transition duration-100">Daftarkan!</a>
      </div>

    </div>
  </div>
</div>
