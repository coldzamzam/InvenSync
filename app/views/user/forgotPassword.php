<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('<?= BASEURL; ?>/img/background-login.jpg')">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex" style="margin-top: 90px;">
   
  <!-- Login Panel -->
    <div class="w-3/5 px-4 py-12 flex items-center justify-center bg-white">
        <div class="w-full max-w-xs">
            <h2 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Lupa Password?</h2>
            <h3 class="text-center font-semibold text-xl md:text-l py-4 text-gray-800">Masukkan Email Anda</h3>
            <form action="<?=BASEURL?>/user/sendResetPasswordRequest" method="post">
                <input type="text" placeholder="Email" name="email" class="w-full bg-gray-200 p-3 rounded-lg mb-4">  
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Reset Password
                </button>
            </form>
        </div>
    </div>

    <!-- Registration Panel -->
    <div class="w-2/5 bg-[#FFD369] flex flex-col items-center justify-center p-4 text-center">
        tes    
    </div>
  </div>
</div>