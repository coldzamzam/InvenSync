<main class="flex-1 ml-24 mt-20 p-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafd;
            margin: 0;
            padding: 0;
        }

        .card {
            background: linear-gradient(135deg, #041A3D, #222831, #393E46);
            /* Gradient dari warna palet */
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            /* Agar konten di dalam card tersusun ke bawah */
        }

        .card-2 {
            background: linear-gradient(135deg, #041A3D, #222831, #393E46);
            /* Gradient dari warna palet */
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            /* Agar konten di dalam card tersusun ke bawah */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }
        .card-2:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .card h1 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 8px;
        }

        .card h2 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 16px;
            padding-bottom: 8px;
        }

        .card-2 h2 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 16px;
            padding-bottom: 8px;
        }

        .card label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 4px;
            display: block;
        }

        .card p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #ffffff;
        }
        .card-2 h1 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 8px;
        }

        .card-2 label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 4px;
            display: block;
        }

        .card-2 p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #ffffff;
        }
    </style>
    </head>

    <body>
        <div>
            <div class="flex gap-4 mb-4">
                <!-- Informasi Akun -->
                <div class="w-1/2">
                    <div id="infoAkun" class="card">
                        <div class="flex justify-between items-center mb-4" style="border-bottom: 2px solid rgba(255, 255, 255, 0.3);">
                            <h2>Informasi Akun</h2>
                            <button class="btnEditAkun bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="openModalAkunButton">
                                <i class="fas fa-edit "></i>
                            </button>
                        </div>
                        <div>
                            <label>UID</label>
                            <p><?= $_SESSION['user_id'] ?></p>
                        </div>
                        <div>
                            <label>Nama Akun</label>
                            <p><?= $data['nama'] ?></p>
                        </div>
                        <div>
                            <label>Role</label>
                            <p><?= $data['role'] ?></p>
                        </div>
                        <div>
                            <label>Email</label>
                            <p><?= $data['email'] ?></p>
                        </div>
                        <div>
                            <label>Nomor Telepon</label>
                            <p>+62<?= $data['nomortelp'] ?></p>
                        </div>
                        <div>
                            <label>Alamat</label>
                            <p><?= $data['alamat'] ?></p>
                        </div>
                    </div>
                    <div id="formModalAkun" class="hidden bg-white shadow-md p-6 border border-zinc-100 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Edit Informasi Akun</h2>
                            <button id="closeModalAkunButton" class="text-gray-500 hover:text-gray-700">
                                <span class="text-2xl">&times;</span>
                            </button>
                        </div>
                        <form action="<?= BASEURL; ?>/User/updateAkun" method="post">
                            <!-- Nama Toko -->
                            <div class="mb-2">
                                <label for="nama" class="text-sm text-gray-700">Nama Akun</label>
                                <input id="nama"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="text" name="namaAkun" placeholder="Nama Akun">
                                <span class="text-red-500 text-sm"><?= $data['namaError']; ?></span>
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-2">
                                <label for="Alamat" class="text-sm text-gray-700">Alamat</label>
                                <input id="Alamat"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="text" name="alamatAkun" placeholder="Alamat">
                                <span class="text-red-500 text-sm"><?= $data['alamatError']; ?></span>
                            </div>

                            <!-- Nomor Telepon Toko -->
                            <div class="mb-2">
                                <label for="nomortelepon" class="text-sm text-gray-700">Nomor Telepon Akun</label>
                                <input id="nomortelepon"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="number" name="teleponAkun" placeholder="Nomor Telepon Akun">
                                <span class="text-red-500 text-sm"><?= $data['teleponAkunError']; ?></span>
    </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end mt-4">
                                <button type="submit" name="simpan"
                                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                                    Edit Informasi</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informasi Toko -->
                <div class="w-full">
                    <div id="infoToko" class="card-2">
                        <div class="flex justify-between items-center mb-4" style="border-bottom: 2px solid rgba(255, 255, 255, 0.3);">
                            <h2>Informasi Toko</h2>
                            <button class="btnEditToko bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200 <?php if ($_SESSION['user_role'] != 'Owner')
                                echo 'hidden'; ?>" id="openModalButton">
                                    <i class="fas fa-edit"></i>
                                </button>
                        </div>
                        <div>
                            <label>Nama Toko</label>
                            <p><?= $data['namatoko'] ?></p>
                        </div>
                        <div>
                            <label>Tipe Toko</label>
                            <p><?= $data['tipetoko'] ?></p>
                        </div>
                        <div>
                            <label>Lokasi</label>
                            <p><?= $data['lokasi'] ?></p>
                        </div>
                        <div>
                            <label>Nomor Telepon</label>
                            <p>+62<?= $data['telepontoko'] ?></p>
                        </div>
                        <div>
                            <label>Email Toko</label>
                            <p><?= $data['emailtoko'] ?></p>
                        </div>
                        <div>
                            <label>Tahun Didirikan</label>
                            <p><?= $data['yearfounded'] ?></p>
                        </div>
                    </div>

                    <div id="formModal" class="hidden bg-white shadow-md p-6 border border-zinc-100 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Edit Informasi Toko</h2>
                            <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                                <span class="text-2xl">&times;</span>
                            </button>
                        </div>
                        <form action="<?= BASEURL; ?>/User/updateToko" method="post">
                            <input type="text" name="storeid" hidden class="hidden">

                            <!-- Nama Toko -->
                            <div class="mb-2">
                                <label for="namatoko" class="text-sm text-gray-700">Nama Toko</label>
                                <input id="namatoko"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="text" name="namatoko" placeholder="Nama Toko">
                                <span class="text-red-500 text-sm"><?= $data['namatokoError']; ?></span>
                            </div>

                            <!-- Tipe Toko -->
                            <div class="mb-2">
                                <label for="tipetoko" class="text-sm text-gray-700">Tipe Toko</label>
                                <select id="tipetoko" name="tipetoko"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                    <option selected disabled>Pilih Jenis Toko</option>
                                    <option value="Toko Distro">Toko Distro</option>
                                    <option value="Toko Sepatu">Toko Sepatu</option>
                                    <option value="Toko Baju">Toko Baju</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <span class="text-red-500 text-sm"><?= $data['tipetokoError']; ?></span>
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-2">
                                <label for="lokasi" class="text-sm text-gray-700">Lokasi</label>
                                <input id="lokasi"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="text" name="lokasi" placeholder="Lokasi">
                                <span class="text-red-500 text-sm"><?= $data['lokasiError']; ?></span>
                            </div>

                            <!-- Nomor Telepon Toko -->
                            <div class="mb-2">
                                <label for="telepontoko" class="text-sm text-gray-700">Nomor Telepon Toko</label>
                                <input id="telepontoko"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="number" name="telepontoko" placeholder="Nomor Telepon Toko">
                                <span class="text-red-500 text-sm"><?= $data['telepontokoError']; ?></span>
                            </div>

                            <!-- Email Toko -->
                            <div class="mb-2 hidden">
                                <label for="emailtoko" class="text-sm text-gray-700">Email Toko</label>
                                <input id="emailtoko"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="email" name="emailtoko" placeholder="Email Toko">
                                <span class="text-red-500 text-sm"><?= $data['emailtokoError']; ?></span>
                            </div>

                            <!-- Tahun Didirikan -->
                            <div class="mb-2">
                                <label for="yearfounded" class="text-sm text-gray-700">Tahun Didirikan</label>
                                <input id="yearfounded"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    type="number" name="yearfounded" placeholder="Tahun Didirikan">
                                <span class="text-red-500 text-sm"><?= $data['yearfoundedError']; ?></span>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end mt-4">
                                <button type="submit" name="simpan"
                                    class="absolute bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                                    Edit Informasi</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <button id="openModalPasswordButton"
                class="gap-3 bg-gradient-to-br from-[#041A3D] via-[#222831] to-[#393E46] w-1/3 text-white rounded-lg shadow-lg p-5 flex hover:bg-gradient-to-br hover:from-[#222831] hover:via-[#393E46] hover:to-[#041A3D] cursor-pointer transition-all duration-300 ease-in-out">
                <i class="fas fa-key"></i>
                <h1>Ubah Password</h1>
            </button>
            <button type='button' class='bg-red-500 mt-4 text-white py-2 px-4 rounded-md hover:bg-red-600 transition duration-200 <?php if ($_SESSION['user_role'] != 'Owner')
                echo 'hidden'; ?>' onclick='confirmDelete()'>
                Hapus Toko
            </button>
        </div>

        <div id="gantiPasswordModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
            <div class="flex justify-center items-center">
                <div class="bg-white shadow-md rounded-lg p-6 w-96">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold mb-4">Ubah Password</h2>
                        <button id="closeModalPasswordButton" class="text-gray-500 hover:text-gray-700">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    <form action="<?= BASEURL; ?>/user/gantiPassword" method="post" onsubmit="return validatePasswordForm()">
                        <div class="mb-4">
                            <label for="passwordLama" class="block text-sm font-medium text-gray-700">Password
                                Lama</label>
                            <div class="relative">
                                <input type="password" id="passwordLama" name="passwordLama"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                <button type="button"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                                    onclick="togglePasswordVisibility('passwordLama', 'eyeIconLama')">
                                    <i id="eyeIconLama" class="fas fa-eye"></i> <!-- Icon mata -->
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="passwordBaru" class="block text-sm font-medium text-gray-700">Password
                                Baru</label>
                            <div class="relative">
                                <input type="password" id="passwordBaru" name="passwordBaru"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                <button type="button"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                                    onclick="togglePasswordVisibility('passwordBaru', 'eyeIconBaru')">
                                    <i id="eyeIconBaru" class="fas fa-eye"></i> <!-- Icon mata -->
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="konfirmasiPasswordBaru"
                                class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" id="konfirmasiPasswordBaru" name="konfirmasiPasswordBaru"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                <button type="button"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                                    onclick="togglePasswordVisibility('konfirmasiPasswordBaru', 'eyeIconKonfirmasi')">
                                    <i id="eyeIconKonfirmasi" class="fas fa-eye"></i> <!-- Icon mata -->
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Owner') {
            echo "
					<div class='flex gap-4'>

						<form id='deleteStoreForm' action='" . BASEURL . "/User/deleteToko' method='post'>
							<input type='hidden' name='id' value='" . htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') . "'>
							<input type='hidden' name='email' value='" . htmlspecialchars($_SESSION['user_email'], ENT_QUOTES, 'UTF-8') . "'>
							<input type='hidden' name='storeID' value='" . htmlspecialchars($_SESSION['store_id'], ENT_QUOTES, 'UTF-8') . "'>
						</form>
					</div>
						";
        }
        ?>
        </div>
        </div>
        </div>
        </div>
        </div>
</main>

<script>
    const modal = document.getElementById('formModal');
    const toko = document.getElementById('infoToko');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const submitButton = document.getElementById('submitButton');

    const akun = document.getElementById('infoAkun');
    const openModalButtonAkun = document.getElementById('openModalAkunButton');
    const closeModalButtonAkun = document.getElementById('closeModalAkunButton');
    const modalAkun = document.getElementById('formModalAkun');
    
    function togglePasswordVisibility(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text'; // Tampilkan password
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash'); // Ganti ikon mata
        } else {
            input.type = 'password'; // Sembunyikan password
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye'); // Kembalikan ikon mata
        }
    }


    openModalButtonAkun.addEventListener('click', () => {
        modalAkun.classList.remove('hidden');
        akun.classList.add('hidden');
        akun.classList.remove('card');
    });
    closeModalButtonAkun.addEventListener('click', () => {
        modalAkun.classList.add('hidden');
        akun.classList.remove('hidden');
        akun.classList.add('card');
    });
    $(function () {
        $('.btnEditAkun').on('click', function () {
            const id = $(this).data('akun');

            $.ajax({
                url: 'http://localhost/InvenSync/public/User/getAkun',
                data: { id: id },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    $('#Alamat').val(data.ADDRESS);
                    $('#email').val(data.EMAIL);
                    $('#nama').val(data.NAME);
                    $('#nomortelepon').val(data.PHONE_NUMBER);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log('Status: ' + status);
                    console.log('Error: ' + error);
                    console.log(xhr.responseText);
                }
            })

        });

    });







    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        toko.classList.add('hidden');
        toko.classList.remove('card-2');
        document.getElementById('inventoryForm').reset();
        document.getElementById('itemId').value = '';
    });
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        toko.classList.remove('hidden');
        toko.classList.add('card-2');
    });
    $(function () {
        $('.btnEditToko').on('click', function () {
            const id = $(this).data('toko');

            $.ajax({
                url: 'http://localhost/InvenSync/public/User/getToko',
                data: { id: id },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    $('#storeid').val(data.STORE_ID);
                    $('#namatoko').val(data.STORE_NAME);
                    $('#tipetoko').val(data.STORE_TYPE);
                    $('#lokasi').val(data.LOCATION);
                    $('#telepontoko').val(data.PHONE_NUMBER);
                    $('#emailtoko').val(data.EMAIL);
                    $('#yearfounded').val(data.YEAR_FOUNDED);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log('Status: ' + status);
                    console.log('Error: ' + error);
                    console.log(xhr.responseText);
                }
            })

        });

    });

    function confirmDelete() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan diminta untuk verifikasi di gmail anda!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Toko!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Satu langkah lagi!',
                    text: 'Tolong verifikasi di gmail anda.',
                    icon: 'warning',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    document.getElementById('deleteStoreForm').submit();
                });
            }
        });
    }
    function openModalPassword() {
        const modalPassword = document.getElementById('gantiPasswordModal');
        modalPassword.classList.remove('hidden');
        modalPassword.classList.add('flex');
    }

    // Fungsi untuk menutup modal
    function closeModalPassword() {
        const modalPassword = document.getElementById('gantiPasswordModal');
        modalPassword.classList.remove('flex');
        modalPassword.classList.add('hidden');
    }

    // Event listener untuk membuka modal
    const openModalPasswordButton = document.getElementById('openModalPasswordButton');
    openModalPasswordButton.addEventListener('click', openModalPassword);

    // Event listener untuk menutup modal ketika tombol close di klik
    const closeModalPasswordButton = document.getElementById('closeModalPasswordButton');
    closeModalPasswordButton.addEventListener('click', closeModalPassword);

    // Menutup modal jika klik di luar modal
    window.addEventListener('click', function (event) {
        const modalPassword = document.getElementById('gantiPasswordModal');
        if (event.target === modalPassword) {
            closeModalPassword();
        }
    });

    function validatePasswordForm() {
        // Get form values
        var passwordLama = document.getElementById('passwordLama').value;
        var passwordBaru = document.getElementById('passwordBaru').value;
        var konfirmasiPasswordBaru = document.getElementById('konfirmasiPasswordBaru').value;

        // Validate Password Lama
        if (passwordLama.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Lama tidak boleh kosong!',
            })
            return false;
        }

        // Validate Password Baru
        if (passwordBaru.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru tidak boleh kosong!',
            })
            return false;
        }

        // Validate Konfirmasi Password Baru
        if (konfirmasiPasswordBaru.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Konfirmasi Password Baru tidak boleh kosong!',
            })
            return false;
        }

        // Validate that both passwords match
        if (passwordBaru !== konfirmasiPasswordBaru) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru dan Konfirmasi Password Baru tidak cocok!',
            })
            return false;
        }

        // Optionally, add more complex password checks (length, characters, etc.)
        if (passwordBaru.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru minimal 8 karakter!',
            })
            return false;
        }
        var passwordRegex = /^(?=.*[A-Z])(?=.*\d)/;
        if (!passwordRegex.test(passwordBaru)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password Baru harus memiliki minimal 1 huruf besar dan 1 angka!',
            })
            return false;
        }

        return true; // Allow form submission if all checks pass
    }

    <?php
    if (isset($_SESSION['status'])):
        $status = $_SESSION['status']; // Get status from session
        unset($_SESSION['status']); // Remove status from session after using it
        ?>
        let status = '<?= $status ?>';
        console.log(status);
        if (status === 'resetSuccess') {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Password Telah Diubah!',
                icon: 'success'
            });
        } else if (status === 'gagalReset') {
            Swal.fire({
                title: 'Error',
                text: 'Password Salah!',
                icon: 'error',
                footer: '<a href="<?= BASEURL; ?>/user/forgotPassword">Lupa Kata Sandi? Tekan Sini!</a>'
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Terjadi Kesalahan!',
                icon: 'error'
            });
        }
    <?php endif; ?>
</script>
</body>

</html>