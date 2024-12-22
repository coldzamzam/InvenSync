<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('<?= BASEURL; ?>/img/background-login.jpg')">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex" style="margin-top: 90px;">

    <!-- Password Reset Form -->
    <div class="w-full px-8 py-12 flex items-center justify-center bg-white">
        <div class="w-full max-w-xs">
            <h2 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Buat Password Baru</h2>
            <h3 class="text-center font-semibold text-xl md:text-l py-2 text-gray-800">Masukkan Password Baru Anda</h3>
            <form action="<?=BASEURL?>/user/updatePassword" method="post" onsubmit="return validatePasswords()">
                <input type="hidden" name="code" value="<?=$data['code']?>">
                <input type="password" placeholder="Password Baru" name="new_password" id="new_password" class="w-full bg-gray-200 p-3 rounded-lg mb-2">
                <span id="new_password_error" class="text-red-500 text-sm hidden">Password tidak boleh kosong.</span>
                
                <input type="password" placeholder="Konfirmasi Password" name="confirm_password" id="confirm_password" class="w-full bg-gray-200 p-3 rounded-lg mb-2">
                <span id="confirm_password_error" class="text-red-500 text-sm hidden">Konfirmasi password tidak cocok.</span>
                
                <form action="<?=BASEURL?>/user/updatePassword" method="post" onsubmit="return validatePasswords()">
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-300">
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
        // Get form values
        var new_password = document.getElementById('new_password').value;
        var confirm_password = document.getElementById('confirm_password').value;

        // Validate Password Baru
        if (new_password.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru tidak boleh kosong!',
            })
            return false;
        }

        // Validate Konfirmasi Password Baru
        if (confirm_password.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Konfirmasi Password Baru tidak boleh kosong!',
            })
            return false;
        }

        // Validate that both passwords match
        if (new_password !== confirm_password) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru dan Konfirmasi Password Baru tidak cocok!',
            })
            return false;
        }

        // Optionally, add more complex password checks (length, characters, etc.)
        if (new_password.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru minimal 8 karakter!',
            })
            return false;
        }
        var passwordRegex = /^(?=.*[A-Z])(?=.*\d)/;
        if (!passwordRegex.test(new_password)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru harus memiliki minimal 1 huruf besar dan 1 angka!',
            })
            return false;
        }

        return true; // Allow form submission if all checks pass
    }
</script>
