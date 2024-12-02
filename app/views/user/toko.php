<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-2xl font-semibold text-center w-full">Selamat Datang!</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl font-bold p-2">&times;</button>
    </div>
    <p class="text-center text-gray-600 mb-6">Masukkan Informasi Tokomu dan Langsung Pakai!</p>

    <!-- Form -->
    <form action="<?= BASEURL; ?>/User/createToko" method="POST" id="createEmployeeForm">
      <!-- Nama Toko -->
      <div class="mb-4">
        <label for="namatoko" class="block text-sm font-medium text-gray-700">Nama Toko</label>
        <input
          id="namatoko"
          name="namatoko"
          type="text"
          placeholder="Nama Toko"
          value="<?= htmlspecialchars($data['namatoko'] ?? '', ENT_QUOTES); ?>"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span class="text-red-500 text-sm"><?= $data['namatokoError']; ?></span>
      </div>

      <!-- Tipe Toko -->
      <div class="mb-4">
        <label for="tipetoko" class="block text-sm font-medium text-gray-700">Tipe Toko</label>
        <select
          id="tipetoko"
          name="tipetoko"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option disabled <?= empty($data['tipetoko']) ? 'selected' : ''; ?>>Pilih Jenis Toko</option>
          <option value="Toko Distro" <?= ($data['tipetoko'] ?? '') === 'Toko Distro' ? 'selected' : ''; ?>>Toko Distro</option>
          <option value="Toko Sepatu" <?= ($data['tipetoko'] ?? '') === 'Toko Sepatu' ? 'selected' : ''; ?>>Toko Sepatu</option>
          <option value="Toko Baju" <?= ($data['tipetoko'] ?? '') === 'Toko Baju' ? 'selected' : ''; ?>>Toko Baju</option>
          <option value="Lainnya" <?= ($data['tipetoko'] ?? '') === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
        </select>
        <span class="text-red-500 text-sm"><?= $data['tipetokoError']; ?></span>
      </div>

      <!-- Lokasi -->
      <div class="mb-4">
        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
        <input
          id="lokasi"
          name="lokasi"
          type="text"
          placeholder="Lokasi"
          value="<?= htmlspecialchars($data['lokasi'] ?? '', ENT_QUOTES); ?>"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span class="text-red-500 text-sm"><?= $data['lokasiError']; ?></span>
      </div>

      <!-- Nomor Telepon -->
      <div class="mb-4">
        <label for="telepontoko" class="block text-sm font-medium text-gray-700">Nomor Telepon Toko</label>
        <input
          id="telepontoko"
          name="telepontoko"
          type="number"
          placeholder="Nomor Telepon Toko"
          value="<?= htmlspecialchars($data['telepontoko'] ?? '', ENT_QUOTES); ?>"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span class="text-red-500 text-sm"><?= $data['telepontokoError']; ?></span>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="emailtoko" class="block text-sm font-medium text-gray-700">Email Toko</label>
        <input
          id="emailtoko"
          name="emailtoko"
          type="email"
          placeholder="Email Toko"
          value="<?= htmlspecialchars($data['emailtoko'] ?? '', ENT_QUOTES); ?>"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span class="text-red-500 text-sm"><?= $data['emailtokoError']; ?></span>
      </div>

      <!-- Tahun Didirikan -->
      <div class="mb-6">
        <label for="yearfounded" class="block text-sm font-medium text-gray-700">Tahun Didirikan</label>
        <input
          id="yearfounded"
          name="yearfounded"
          type="number"
          placeholder="Tahun Didirikan"
          value="<?= htmlspecialchars($data['yearfounded'] ?? '', ENT_QUOTES); ?>"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <span class="text-red-500 text-sm"><?= $data['yearfoundedError']; ?></span>
      </div>

      <!-- Tombol -->
      <div class="flex justify-center">
        <button
          type="submit"
          name="simpan"
          class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200"
        >
          Simpan Informasi
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function closeModal() {
    document.getElementById("modal").classList.add("hidden");
  }
</script>
