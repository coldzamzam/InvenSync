<main class="flex-1 ml-24 mt-20 p-8"> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafd;
            margin: 0;
            padding: 0;
        }

        main {
            margin-left: 24px;
            margin-top: 20px;
            padding: 16px;
        }

        .container {
            display: flex;
            gap: 16px;
            align-items: stretch; /* Pastikan card memiliki tinggi yang sama */
        }

        .card {
    background: linear-gradient(135deg, #041A3D, #222831,#393E46); /* Gradient dari warna palet */
    color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column; /* Agar konten di dalam card tersusun ke bawah */
}

.card:hover {
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


        .btn {
            background-color: #ffffff;
            color: #2575fc;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn:hover {
            background-color: #2575fc;
            color: #ffffff;
        }

        .card-1 {
            flex: 1; /* Card Informasi Akun memiliki lebar 1/3 */
        }

        .card-2 {
            flex: 2; /* Card Informasi Toko memiliki lebar 2/3 */
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <!-- Informasi Akun -->
            <div class="card card-1">
                <h1>Informasi Akun</h1>
                <div>
                    <label>UID</label>
                    <p><?= $_SESSION['user_id'] ?></p>
                </div>
                <div>
                    <label>Nama Akun</label>
                    <p><?= $_SESSION['user_name'] ?></p>
                </div>
                <div>
                    <label>Role</label>
                    <p><?= $_SESSION['user_role'] ?></p>
                </div>
                <div>
                    <label>Email</label>
                    <p><?= $_SESSION['user_email'] ?></p>
                </div>
                <div>
                    <label>Nomor Telepon</label>
                    <p>+62<?= $_SESSION['user_phonenumber'] ?></p>
                </div>
                <div>
                    <label>Alamat</label>
                    <p><?= $_SESSION['user_address'] ?></p>
                </div>
            </div>

            <!-- Informasi Toko -->
            <div class="card card-2">
                <h1>Informasi Toko</h1>
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
                <div style="text-align: right; margin-top: 20px;">
                    <button class="btn" id="openModalButton">Edit Informasi</button>
                    <button
							type='button'
							class='bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 transition duration-200'
							onclick='confirmDelete()'
						>
							Hapus Toko
						</button>
                </div>
            </div>
        </div>
    </main>

			<div id="formModal" class="hidden bg-white shadow-md p-6 border border-zinc-100 rounded-lg w-full">
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
							<input id="namatoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="namatoko" placeholder="Nama Toko">
							<span class="text-red-500 text-sm"><?= $data['namatokoError']; ?></span>
						</div>

						<!-- Tipe Toko -->
						<div class="mb-2">
							<label for="tipetoko" class="text-sm text-gray-700">Tipe Toko</label>
							<select id="tipetoko" name="tipetoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
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
							<input id="lokasi" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="lokasi" placeholder="Lokasi">
							<span class="text-red-500 text-sm"><?= $data['lokasiError']; ?></span>
						</div>

						<!-- Nomor Telepon Toko -->
						<div class="mb-2">
							<label for="telepontoko" class="text-sm text-gray-700">Nomor Telepon Toko</label>
							<input id="telepontoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="telepontoko" placeholder="Nomor Telepon Toko">
							<span class="text-red-500 text-sm"><?= $data['telepontokoError']; ?></span>
						</div>

						<!-- Email Toko -->
						<div class="mb-2">
							<label for="emailtoko" class="text-sm text-gray-700">Email Toko</label>
							<input id="emailtoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="email" name="emailtoko" placeholder="Email Toko">
							<span class="text-red-500 text-sm"><?= $data['emailtokoError']; ?></span>
						</div>

						<!-- Tahun Didirikan -->
						<div class="mb-2">
							<label for="yearfounded" class="text-sm text-gray-700">Tahun Didirikan</label>
							<input id="yearfounded" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="yearfounded" placeholder="Tahun Didirikan">
							<span class="text-red-500 text-sm"><?= $data['yearfoundedError']; ?></span>
						</div>

						<!-- Submit Button -->
						<div class="flex justify-end mt-4">
							<button type="submit" name="simpan" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Edit Informasi</button>
						</div>
					</form>
			</div>
					
					<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Owner') { 
						echo"
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
    // Mendapatkan elemen modal dan tombol
    const modal = document.getElementById('formModal');
    const toko = document.getElementById('infoToko');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const submitButton = document.getElementById('submitButton');
    
    // Fungsi untuk membuka modal
    openModalButton.addEventListener('click', () => {
    modal.classList.remove('hidden');
    toko.classList.add('hidden');
    document.getElementById('inventoryForm').reset();
    document.getElementById('itemId').value = '';
    submitButton.textContent = 'Tambah Barang';
    });
    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');
    toko.classList.remove('hidden');
    });
    // Menutup modal jika pengguna mengklik di luar modal
    // window.addEventListener('click', (event) => {
    //   if (event.target === modal) {
    //     modal.classList.add('hidden');
    //   }
    // });

		$(function() {

			$('.btnEditToko').on('click', function() {

				// $('#judulModal').html('Update Data Mahasiswa');
				// $('.modal-footer button[type=submit]').html('Update Data');

				// $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/edit');

				const id = $(this).data('toko');
				
				$.ajax({
					url: 'http://localhost/InvenSync/public/User/getToko',
					data: { id: id },
					method: 'post',
					dataType: 'json',
					success: function(data) {
						$('#storeid').val(data.STORE_ID);
						$('#namatoko').val(data.STORE_NAME);
						$('#tipetoko').val(data.STORE_TYPE);
						$('#lokasi').val(data.LOCATION);
						$('#telepontoko').val(data.PHONE_NUMBER);
						$('#emailtoko').val(data.EMAIL);
						$('#yearfounded').val(data.YEAR_FOUNDED);
						console.log(data);
					},
					error: function(xhr, status, error) {
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
</script>

</body>
</html>