  <main class="flex-1 ml-64 p-8">
    <header class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-blue-500">Inventory</h2>
      <button id="openModalButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ New Stock</button>
    </header>

    <div class="flex items-center mb-4 space-x-4">
      <input type="text" placeholder="Quick search" class="border rounded px-4 py-2">
      <input type="date" class="border rounded px-4 py-2">
      <select class="border rounded px-4 py-2">
        <option>Status</option>
        <option>Pending</option>
        <option>Completed</option>
      </select>
    </div>

    <div class="bg-white rounded shadow">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-200 text-gray-600">
            <th class="py-3 px-4 border">Item ID</th>
            <th class="py-3 px-4 border">Item Name</th>
            <th class="py-3 px-4 border">Quantity</th>
            <th class="py-3 px-4 border">Date Added</th>
            <th class="py-3 px-4 border">Purchase Price</th>
            <th class="py-3 px-4 border">Selling Price</th>
            <th class="py-3 px-4 border">Status</th>
          </tr>
        </thead>
        <tbody>
          <!-- Looping data item menggunakan PHP -->
          <?php foreach( $data['item'] as $item ) : ?>
            <tr class="group hover:bg-gray-100 relative">
              <td class="py-3 px-4 border"><?= $item['ITEM_ID']; ?></td>
              <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
              <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
              <td class="py-3 px-4 border"><?= $item['DATE_ADDED']; ?></td>
              <td class="py-3 px-4 border"><?= $item['HARGA_BELI']; ?></td>
              <td class="py-3 px-4 border"><?= $item['HARGA_JUAL']; ?></td>
              <td class="py-3 px-4 border"><?= $item['STATUS']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="pagination mt-4">
      <ul class="flex justify-center space-x-2">
        <?php if ($data['currentPage'] > 1): ?>
          <li>
            <a href="<?= BASEURL; ?>/inventory/index/<?= $data['currentPage'] - 1; ?>" class="px-3 py-1 border rounded">Previous</a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
          <li>
            <a href="<?= BASEURL; ?>/inventory/index/<?= $i; ?>" class="px-3 py-1 border <?= $data['currentPage'] == $i ? 'bg-blue-500 text-white' : ''; ?>"><?= $i; ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($data['currentPage'] < $data['totalPages']): ?>
          <li>
            <a href="<?= BASEURL; ?>/inventory/index/<?= $data['currentPage'] + 1; ?>" class="px-3 py-1 border rounded">Next</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </main>

  <!-- Modal for Adding New Stock -->
  <div id="formModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-500">Tambah Data Barang</h2>
        <button id="closeModalButton" class="text-gray-500 hover:text-gray-800">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/Inventory/tambah" method="post">
        <div class="mb-4">
          <label for="NAMABARANG" class="form-label">Nama Barang</label>
          <input class="form-control form-control-sm w-full p-2 border rounded" type="text" name="NAMABARANG" placeholder="Nama Barang" required>
        </div>

        <div class="mb-4">
          <label for="KUANTITAS" class="form-label">Kuantitas</label>
          <input class="form-control form-control-sm w-full p-2 border rounded" type="number" name="KUANTITAS" placeholder="Kuantitas" required>
        </div>

        <div class="mb-4">
          <label for="HARGA_BELI" class="form-label">Harga Beli</label>
          <input class="form-control form-control-sm w-full p-2 border rounded" type="number" name="HARGA_BELI" placeholder="Harga Beli" required>
        </div>

        <div class="mb-4">
          <label for="HARGA_JUAL" class="form-label">Harga Jual</label>
          <input class="form-control form-control-sm w-full p-2 border rounded" type="number" name="HARGA_JUAL" placeholder="Harga Jual" required>
        </div>

        <div class="mb-4">
          <label for="STATUS" class="form-label">Status</label>
          <select name="STATUS" class="form-select w-full p-2 border rounded" required>
            <option value="" disabled selected>Pilih Status</option>
            <option value="Ready">Ready</option>
            <option value="Pending">Pending</option>
            <option value="Empty">Empty</option>
          </select>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambah Barang</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Mendapatkan elemen modal dan tombol
    const modal = document.getElementById('formModal');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');

    // Fungsi untuk membuka modal
    openModalButton.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    // Menutup modal jika pengguna mengklik di luar modal
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
