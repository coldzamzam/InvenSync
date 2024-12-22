<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('<?= BASEURL; ?>/img/background-login.jpg')">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden flex" style="margin-top: 90px;">

    <!-- Password Reset Form -->
    <div class="w-full px-8 py-12 flex items-center justify-center bg-white">
        <div class="w-full max-w-xs">
            <h2 class="text-center font-black text-3xl md:text-4xl py-4 text-gray-800">Buat Password Baru</h2>
            <h3 class="text-center font-semibold text-xl md:text-l py-2 text-gray-800">Masukkan Password Baru Anda</h3>
            <form action="<?=BASEURL?>/user/updatePassword" method="post" onsubmit="return validatePasswords()">
                <input type="hidden" name="code" value="<?=$data['code']?>">
                <div class="relative mb-4">
                    <input type="password" placeholder="Password Baru" name="new_password" id="new_password" class="w-full bg-gray-200 p-3 rounded-lg">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500" onclick="togglePasswordVisibility('new_password', 'eyeIconNewPassword')">
                        <i id="eyeIconNewPassword" class="fas fa-eye"></i> <!-- Eye Icon -->
                    </button>
                </div>
                <span id="new_password_error" class="text-red-500 text-sm hidden">Password tidak boleh kosong.</span>
                
                <!-- Confirm Password Field with Eye Icon -->
                <div class="relative mb-4">
                    <input type="password" placeholder="Konfirmasi Password" name="confirm_password" id="confirm_password" class="w-full bg-gray-200 p-3 rounded-lg">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500" onclick="togglePasswordVisibility('confirm_password', 'eyeIconConfirmPassword')">
                        <i id="eyeIconConfirmPassword" class="fas fa-eye"></i> <!-- Eye Icon -->
                    </button>
                </div>
                <span id="confirm_password_error" class="text-red-500 text-sm hidden">Konfirmasi password tidak cocok.</span>
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-300">
                        Reset Password
                    </button>
            </form>
        </div>
    </div>
  </div>
</div>

<script>
        function togglePasswordVisibility(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    
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
