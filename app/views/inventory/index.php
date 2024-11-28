  <!-- Main Content -->
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
            <th class="py-3 px-4 border">Category Item</th>
            <th class="py-3 px-4 border">Quantity</th>
            <th class="py-3 px-4 border">Date Added</th>
            <th class="py-3 px-4 border">Purchase Price</th>
            <th class="py-3 px-4 border">Selling Price</th>
            <th class="py-3 px-4 border">Status</th>
            <th class="py-3 px-4 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Looping data item menggunakan PHP -->
          <?php foreach($data['item'] as $item): ?>
            <tr class="group hover:bg-gray-100 relative">
              <td class="py-3 px-4 border"><?= $item['ITEM_ID']; ?></td>
              <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
              <td class="py-3 px-4 border"><?= $item['CATEGORY_ITEM']; ?></td>
              <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
              <td class="py-3 px-4 border"><?= $item['DATE_ADDED']; ?></td>
              <td class="py-3 px-4 border"><?= $item['HARGA_BELI']; ?></td>
              <td class="py-3 px-4 border"><?= $item['HARGA_JUAL']; ?></td>
              <td class="py-3 px-4 border"><?= $item['STATUS']; ?></td>
              <td class="py-3 px-4 border">
                <button class="text-blue-500" onclick="editItem(<?= $item['ITEM_ID']; ?>)">Edit</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

 <!-- Modal for Adding or Editing Stock -->
 <div id="formModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Tambah/Edit Barang</h2>
        <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form id="inventoryForm" action="<?= BASEURL; ?>/Inventory/tambah" method="post">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Barang -->
        <div class="mb-3">
          <label for="ITEM_NAME" class="text-sm text-gray-700">Nama Barang</label>
          <input id="ITEM_NAME" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="ITEM_NAME" placeholder="Nama Barang" required>
        </div>

        <!-- Kategori Barang -->
        <div class="mb-3">
          <label for="CATEGORY_ITEM" class="text-sm text-gray-700">Kategori</label>
          <input id="CATEGORY_ITEM" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="CATEGORY_ITEM" placeholder="Kategori Barang" required>
        </div>

        <!-- Kuantitas -->
        <div class="mb-3">
          <label for="QUANTITY" class="text-sm text-gray-700">Kuantitas</label>
          <input id="QUANTITY" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="QUANTITY" placeholder="Kuantitas" required>
        </div>

        <!-- Harga Beli -->
        <div class="mb-3">
          <label for="HARGA_BELI" class="text-sm text-gray-700">Harga Beli</label>
          <input id="HARGA_BELI" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="HARGA_BELI" placeholder="Harga Beli" required>
        </div>

        <!-- Harga Jual -->
        <div class="mb-3">
          <label for="HARGA_JUAL" class="text-sm text-gray-700">Harga Jual</label>
          <input id="HARGA_JUAL" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="HARGA_JUAL" placeholder="Harga Jual" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
          <label for="STATUS" class="text-sm text-gray-700">Status</label>
          <select id="STATUS" name="STATUS" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            <option value="Ready">Ready</option>
            <option value="Pending">Pending</option>
            <option value="Empty">Empty</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Tambah/Edit Barang</button>
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
    const submitButton = document.getElementById('submitButton');
    
    // Fungsi untuk membuka modal
    openModalButton.addEventListener('click', () => {
      modal.classList.remove('hidden');
      document.getElementById('inventoryForm').reset();
      document.getElementById('itemId').value = '';
      submitButton.textContent = 'Tambah Barang';
    });

    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    // Fungsi edit data barang
    function editItem(itemId) {
      // Fetch data untuk item yang ingin di-edit
      fetch(`<?= BASEURL; ?>/inventory/getItemData/${itemId}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('itemId').value = data.ITEM_ID;
          document.getElementById('ITEM_NAME').value = data.ITEM_NAME;
          document.getElementById('CATEGORY_ITEM').value = data.CATEGORY_ITEM;
          document.getElementById('QUANTITY').value = data.QUANTITY;
          document.getElementById('HARGA_BELI').value = data.HARGA_BELI;
          document.getElementById('HARGA_JUAL').value = data.HARGA_JUAL;
          document.getElementById('STATUS').value = data.STATUS;

          submitButton.textContent = 'Update Barang';
          modal.classList.remove('hidden');
        });
    }

    // Menutup modal jika pengguna mengklik di luar modal
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>

</body>
</html>