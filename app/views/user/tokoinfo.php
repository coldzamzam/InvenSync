<main class="flex-1 ml-64 mt-20 p-8"> 
	<div>
		<div class="flex gap-4 mb-4">
			<div class="bg-white min-h-[600px] shadow-md border border-zinc-100 w-2/5 p-6 rounded-lg ">
				<div class="mb-6">
					<h1 class="text-2xl font-bold text-gray-800">Account Information</h1>
				</div>
				<div class="mb-2">
					<label for="userid">UID</label>
					<p class="text-gray-900 font-medium"><?=$_SESSION['user_id']?></p>
				</div>
				<div class="mb-2">
					<label for="namauser">Nama Akun</label>
					<p class="text-gray-900 font-medium"><?=$_SESSION['user_name']?></p>
				</div>
				<div class="mb-2">
					<label for="userrole">Role</label>
					<p class="text-gray-900 font-medium"><?=$_SESSION['user_role']?></p>
				</div>
				<div class="mb-2">
					<label for="useremail">Email</label>
					<p class="text-gray-900 font-medium"><?=$_SESSION['user_email']?></p>
				</div>
				<div class="mb-2">
					<label for="userphone">Nomor Telepon</label>
					<p class="text-gray-900 font-medium">+62<?=$_SESSION['user_phonenumber']?></p>
				</div>
				<div class="mb-2">
					<label for="useraddress">Alamat</label>
					<p class="text-gray-900 font-medium"><?=$_SESSION['user_address']?></p>
				</div>
			</div>

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
							<button type="submit" name="simpan" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Update Informasi</button>
						</div>
					</form>
			</div>

			<div id="infoToko" class="bg-white shadow-md p-6 border border-zinc-100 rounded-lg w-full">
				<!-- Header -->
				<div class="mb-6">
					<h1 class="text-2xl font-bold text-gray-800">Store Information</h1>
				</div>

				<!-- Content -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<!-- Nama Toko -->
					<div>
						<label for="namatoko" class="text-sm text-gray-700 block mb-1">Nama Toko</label>
						<p class="text-gray-900 font-medium"><?=$data['namatoko']?></p>
					</div>
					<!-- Tipe Toko -->
					<div>
						<label for="tipetoko" class="text-sm text-gray-700 block mb-1">Tipe Toko</label>
						<p class="text-gray-900 font-medium"><?=$data['tipetoko']?></p>
					</div>
					<!-- Lokasi -->
					<div>
						<label for="lokasi" class="text-sm text-gray-700 block mb-1">Lokasi</label>
						<p class="text-gray-900 font-medium"><?=$data['lokasi']?></p>
					</div>
					<!-- Nomor Telepon Toko -->
					<div>
						<label for="telepontoko" class="text-sm text-gray-700 block mb-1">Nomor Telepon Toko</label>
						<p class="text-gray-900 font-medium">+62<?=$data['telepontoko']?></p>
					</div>
					<!-- Email Toko -->
					<div>
						<label for="emailtoko" class="text-sm text-gray-700 block mb-1">Email Toko</label>
						<p class="text-gray-900 font-medium"><?=$data['emailtoko']?></p>
					</div>
					<!-- Tahun Didirikan -->
					<div>
						<label for="yearfounded" class="text-sm text-gray-700 block mb-1">Tahun Didirikan</label>
						<p class="text-gray-900 font-medium"><?=$data['yearfounded']?></p>
					</div>

					<div class="flex">
						<button
							id="openModalButton"
							type="submit"
							name="simpan"
							class="btnEditToko bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200"
							onclick="berhasil()"
						>
							Edit Informasi
						</button>
					</div>
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

</script>

</body>
</html>