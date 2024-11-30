<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="max-h-[1000px] max-w-[1500px] w-full p-6 rounded-lg shadow-lg flex">
    <div class="bg-[#FFD369] w-full">tes</div>
    <div class="p-6 bg-white w-full">
      <div class="flex justify-between items-center">
        <h3 class="text-2xl font-semibold w-full text-center">Selamat Datang!</h3>
      </div>
      <h3 class="text-l text-center">Masukkan Informasi Tokomu dan Langsung Pakai!</h3>

      <!-- Formulir -->
      <form action="<?= BASEURL; ?>/User/createToko" method="POST" id="createEmployeeForm">
        <div class="mt-6 gap-4 mb-6">
          <!-- Nama Toko -->
          <div class="mb-3">
            <label for="namatoko" class="text-sm text-gray-700">Nama Toko</label>
            <input
              id="namatoko"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              type="text"
              name="namatoko"
              placeholder="Nama Toko"
              value="<?= htmlspecialchars($data['namatoko'] ?? '', ENT_QUOTES); ?>"
            />
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm h-full"><?= $data['namatokoError']; ?></span>
          </div>

          <!-- Tipe Toko -->
          <div class="mb-3">
            <label for="tipetoko" class="text-sm text-gray-700">Tipe Toko</label>
            <select
              id="tipetoko"
              name="tipetoko"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              value="<?= htmlspecialchars($data['tipetoko'] ?? '', ENT_QUOTES); ?>"
            >
              <option disabled <?= empty($data['tipetoko']) ? 'selected' : ''; ?>>Pilih Jenis Toko</option>
              <option value="Toko Distro" <?= ($data['tipetoko'] ?? '') === 'Toko Distro' ? 'selected' : ''; ?>>Toko Distro</option>
              <option value="Toko Sepatu" <?= ($data['tipetoko'] ?? '') === 'Toko Sepatu' ? 'selected' : ''; ?>>Toko Sepatu</option>
              <option value="Toko Baju" <?= ($data['tipetoko'] ?? '') === 'Toko Baju' ? 'selected' : ''; ?>>Toko Baju</option>
              <option value="Lainnya" <?= ($data['tipetoko'] ?? '') === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
            </select>
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm"><?= $data['tipetokoError']; ?></span>
          </div>

          <!-- Lokasi -->
          <div class="mb-3">
            <label for="lokasi" class="text-sm text-gray-700">Lokasi</label>
            <input
              id="lokasi"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              type="text"
              name="lokasi"
              placeholder="Lokasi"
              value="<?= htmlspecialchars($data['lokasi'] ?? '', ENT_QUOTES); ?>"
            />
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm"><?= $data['lokasiError']; ?></span>
          </div>

          <!-- Nomor Telepon Toko -->
          <div class="mb-3">
            <label for="telepontoko" class="text-sm text-gray-700">Nomor Telepon Toko</label>
            <input
              id="telepontoko"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              type="number"
              name="telepontoko"
              placeholder="Nomor Telepon Toko"
              value="<?= htmlspecialchars($data['telepontoko'] ?? '', ENT_QUOTES); ?>"
            />
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm"><?= $data['telepontokoError']; ?></span>
          </div>

          <!-- Email Toko -->
          <div class="mb-3">
            <label for="emailtoko" class="text-sm text-gray-700">Email Toko</label>
            <input
              id="emailtoko"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              type="email"
              name="emailtoko"
              placeholder="Email Toko"
              value="<?= htmlspecialchars($data['emailtoko'] ?? '', ENT_QUOTES); ?>"
            />
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm"><?= $data['emailtokoError']; ?></span>
          </div>

          <!-- Tahun Didirikan -->
          <div class="mb-3">
            <label for="yearfounded" class="text-sm text-gray-700">Tahun Didirikan</label>
            <input
              id="yearfounded"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              type="number"
              name="yearfounded"
              placeholder="Tahun Didirikan"
              value="<?= htmlspecialchars($data['yearfounded'] ?? '', ENT_QUOTES); ?>"
            />
            <span style="display: inline-block; height: 1.5rem; line-height: 1.5rem; overflow: hidden; white-space: nowrap;" class="text-red-500 text-sm"><?= $data['yearfoundedError']; ?></span>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button
            type="submit"
            name="simpan"
            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200"
            onclick="berhasil()"
          >
            Simpan Informasi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function berhasil() {
        swal.fire({
            icon: 'success',
            title: 'Terima Kasih!',
            text: 'Selamat Datang di Invensync!',
        })
    }
</script>