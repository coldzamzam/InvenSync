<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('<?= BASEURL; ?>/img/background-login.jpg')">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex" style="margin-top: 90px;">

    <!-- Password Reset Form -->
    <div class="w-full px-8 py-12 flex items-center justify-center bg-white">
        <div class="w-full max-w-xs">
            <h2 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Buat Password Baru</h2>
            <h3 class="text-center font-semibold text-xl md:text-l py-2 text-gray-800">Masukkan Password Baru Anda</h3>
            <form action="<?=BASEURL?>/user/updatePassword" method="post" onsubmit="return validatePasswords()">
                <input type="hidden" name="code" value="<?=$data['code']?>">
                <input type="password" placeholder="Password Baru" name="new_password" id="new_password" class="w-full bg-gray-200 p-3 rounded-lg mb-2" required>
                <span id="new_password_error" class="text-red-500 text-sm hidden">Password tidak boleh kosong.</span>
                
                <input type="password" placeholder="Konfirmasi Password" name="confirm_password" id="confirm_password" class="w-full bg-gray-200 p-3 rounded-lg mb-2" required>
                <span id="confirm_password_error" class="text-red-500 text-sm hidden">Konfirmasi password tidak cocok.</span>
                
                <form action="<?=BASEURL?>/user/updatePassword" method="post" onsubmit="return validatePasswords()">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Reset Password
                    </button>
                </form>
            </form>
        </div>
    </div>
  </div>
</div>

<script>
function validatePasswords() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    let isValid = true;

    if (!newPassword) {
        document.getElementById('new_password_error').classList.remove('hidden');
        isValid = false;
    } else {
        document.getElementById('new_password_error').classList.add('hidden');
    }

    if (newPassword !== confirmPassword) {
        document.getElementById('confirm_password_error').classList.remove('hidden');
        isValid = false;
    } else {
        document.getElementById('confirm_password_error').classList.add('hidden');
    }

    return isValid;
}
</script>
