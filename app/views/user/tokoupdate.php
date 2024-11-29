<main class="flex-1 ml-64 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Profile Toko</h2>
    <!-- <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#formModal">+ New Stock</button> -->
  </header>

  <div class="modal-body">
    <form action="<?= BASEURL; ?>/User/updateToko" method="post">

      <!-- Nama Toko -->
      <div class="mb-3">
        <label for="namatoko" class="text-sm text-gray-700">Nama Toko</label>
        <input id="namatoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="namatoko" placeholder="Nama Toko">
        <span class="text-red-500 text-sm"><?= $data['namatokoError']; ?></span>
      </div>

      <!-- Tipe Toko -->
      <div class="mb-3">
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
      <div class="mb-3">
        <label for="lokasi" class="text-sm text-gray-700">Lokasi</label>
        <input id="lokasi" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="lokasi" placeholder="Lokasi">
        <span class="text-red-500 text-sm"><?= $data['lokasiError']; ?></span>
      </div>

      <!-- Nomor Telepon Toko -->
      <div class="mb-3">
        <label for="telepontoko" class="text-sm text-gray-700">Nomor Telepon Toko</label>
        <input id="telepontoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="telepontoko" placeholder="Nomor Telepon Toko">
        <span class="text-red-500 text-sm"><?= $data['telepontokoError']; ?></span>
      </div>

      <!-- Email Toko -->
      <div class="mb-3">
        <label for="emailtoko" class="text-sm text-gray-700">Email Toko</label>
        <input id="emailtoko" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="email" name="emailtoko" placeholder="Email Toko">
        <span class="text-red-500 text-sm"><?= $data['emailtokoError']; ?></span>
      </div>

      <!-- Tahun Didirikan -->
      <div class="mb-3">
        <label for="yearfounded" class="text-sm text-gray-700">Tahun Didirikan</label>
        <input id="yearfounded" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="yearfounded" placeholder="Tahun Didirikan">
        <span class="text-red-500 text-sm"><?= $data['yearfoundedError']; ?></span>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end mt-4">
        <button type="submit" name="simpan" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Simpan Informasi</button>
      </div>
    </form>
  </div>

</main>