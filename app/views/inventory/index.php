  <!-- Main Content -->
  <main class="flex-1 ml-24 mt-20 p-8">
    <header class="flex justify-between items-center mb-6">
      <!-- <h2 class="text-2xl font-semibold text-blue-500">Inventory</h2> -->
      <div class="flex justify-center">
        <div class="wrap-cards flex gap-6">
          <!-- Card 1 -->
          <div class="card border border-green-300 bg-green-300 rounded-lg shadow-lg flex flex-col">
            <div class="card-header flex justify-between py-2 px-4 border-b border-green-400">
              <p>Stok Tersedia</p>
            </div>
            <!-- Garis setelah header -->
            <hr class="border-green-400">
            <div class="card-body py-2 px-4 flex-grow flex items-center justify-center">
              <p class="text-md">
                <span class="text-lg font-bold"><?= $data['totalStok']['TOTAL_ROWS']; ?></span> Produk
              </p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="card border border-yellow-300 bg-yellow-300 rounded-lg shadow-lg flex flex-col">
            <div class="card-header flex justify-between py-2 px-4 border-b border-yellow-400">
              <p>Stok Segera Habis</p>
            </div>
            <!-- Garis setelah header -->
            <hr class="border-yellow-400">
            <div class="card-body py-2 px-4 flex-grow flex items-center justify-center">
              <p class="text-md">
                <span class="text-lg font-bold"><?= $data['hampirHabis']['TOTAL_ROWS']; ?></span> Produk
              </p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="card border border-red-300 bg-red-300 rounded-lg shadow-lg flex flex-col">
            <div class="card-header flex justify-between py-2 px-4 border-b border-red-400">
              <p>Stok Habis</p>
            </div>
            <!-- Garis setelah header -->
            <hr class="border-red-400">
            <div class="card-body py-2 px-4 flex-grow flex items-center justify-center">
              <p class="text-md">
                <span class="text-lg font-bold"><?= $data['tidakTersedia']['TOTAL_ROWS']; ?></span> Produk
              </p>
            </div>
          </div>
        </div>
      </div>
      
    </header>

    <div class="flex items-center mb-4 space-x-4 justify-between">
      <div class="wrap-filter flex items-center gap-4">
      <input type="text" id="quickSearch" placeholder="Cari" class="border rounded px-4 py-2">
      </div>

      <div>
        <div class="relative inline-block text-left">
          
        </div>
  
        <button id="openModalButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Stok</button>
      </div>
    </div>

    <div class="flex gap-4 mb-4">

    <div class="bg-white min-h-[600px] shadow-md border border-zinc-100 w-3/12 px-6 py-4 rounded-lg">
      <p class="text-lg font-bold pb-2">Total Stok</p>
      <div class="bg-white rounded shadow">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-600">
              <th class="py-3 px-4 border text-center">Nama Barang</th>
              <th class="py-3 px-4 border text-center">Total Kuantitas</th>
            </tr>
          </thead>
          <!-- <?= $data['warnaQty'] == 'tersedia' ? '' : ($data['warnaQty'] == 'hampirHabis' ? 'bg-yellow-100' : 'bg-red-100'); ?> -->
          <tbody>
            <?php foreach($data['totalQty'] as $total): ?>
              <tr class="group relative hover:bg-gray-100">
                <td class="py-3 px-4 border"><?= $total['ITEM_NAME']; ?></td>
                <td class="py-3 px-4 border text-center"><?= ($total['STOCK_AVAILABLE']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="bg-white shadow-md px-6 py-4 border border-zinc-100 rounded-lg w-9/12">
      <p class="text-lg font-bold pb-2">Inventaris</p>
      <div class="bg-white rounded shadow">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-600">
              <th class="py-3 px-4 border text-center">Inventory ID</th>
              <th class="py-3 px-4 border text-center">Nama Barang</th>
              <th class="py-3 px-4 border text-center">Kuantitas</th>
              <th class="py-3 px-4 border text-center">Tanggal Ditambahkan</th>
              <th class="py-3 px-4 border text-center">Harga Beli</th>
              <th class="py-3 px-4 border text-center">ID User</th>
              <th class="py-3 px-4 border text-center">Status</th>
              <th class="py-3 px-4 border text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data['inventory'] as $item): ?>
              <tr class="group hover:bg-gray-100 relative">
                <td class="py-3 px-4 border text-center"><?= $item['INVENTORY_ID']; ?></td>
                <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
                <td class="py-3 px-4 border text-center"><?= $item['QUANTITY']; ?></td>
                <td class="py-3 px-4 border text-center"><?= $item['DATE_ADDED']; ?></td>
                <td class="py-3 px-4 border text-center">Rp<?= number_format($item['HARGA_BELI'], 2, ',', '.'); ?></td>
                <td class="py-3 px-4 border text-center"><?= $item['USER_ID']; ?></td>
                <td class="py-3 px-4 border text-center <?= $item['STATUS'] == 'Pending' ? '' : 'bg-green-100'; ?>">
                  <div class="<?= $item['STATUS'] == 'Pending' ? 'hidden' : ''; ?>">
                    <?= $item['STATUS']; ?>
                  </div>
                  <div class="<?= $item['STATUS'] == 'Pending' ? '' : 'hidden'; ?>">
                    <form id="inventoryStatusForm" action="<?= BASEURL; ?>/Inventory/updateStatus" method="post">
                      <input type="hidden" name="inventory_id" value="<?= $item['INVENTORY_ID']; ?>">
                      <input type="hidden" name="item_name" value="<?= $_SESSION['store_id']; ?>">
                    </form>
                    <button id="statusButton" onclick="confirmStatus()" class="bg-<?= $item['STATUS'] == 'Pending' ? 'yellow-100' : 'green-100'; ?> py-1 px-4 rounded  hover:bg-<?= $item['STATUS'] == 'Pending' ? 'yellow-600' : 'green-600'; ?>">
                      <?= $item['STATUS']; ?>
                    </button>
                  </div>
                </td>
                <td class="py-3 px-4 border flex justify-center items-center">
                  <button onclick="editItem('<?= $users['INVENTORY_ID']; ?>')" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600">
                    <img src="<?= BASEURL; ?>/img/setting-logo.png" width="20px" height="20px" alt="logo edit">
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Modal for Adding or Editing Stock -->
  <div id="formModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Tambah Stok Barang</h2>
        <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form id="inventoryForm" action="<?= BASEURL; ?>/Inventory/tambahInventory" method="post">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Barang -->
        <div class="mb-3">
          <label for="item_id" class="text-sm text-gray-700">Nama Barang</label>
          <select id="item_id" name="item_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            <option value="" disabled selected>-- Pilih Nama Barang --</option>
            <?php foreach($data['items'] as $item): ?>
              <option value="<?= $item['ITEM_ID']; ?>"><?= $item['ITEM_ID']; ?> - <?= $item['ITEM_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Kuantitas -->
        <div class="mb-3">
          <label for="quantity" class="text-sm text-gray-700">Kuantitas</label>
          <input id="quantity" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="quantity" placeholder="Kuantitas" required>
        </div>

        <!-- Harga Beli -->
        <div class="mb-3">
          <label for="harga_beli" class="text-sm text-gray-700">Harga Beli</label>
          <input id="harga_beli" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="number" name="harga_beli" placeholder="Harga Beli" required>
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

    document.addEventListener("DOMContentLoaded", () => {
      const menuButton = document.getElementById("menu-button");
      const dropdownMenu = document.getElementById("dropdown-menu");

      menuButton.addEventListener("click", () => {
        const isExpanded = menuButton.getAttribute("aria-expanded") === "true";
        menuButton.setAttribute("aria-expanded", !isExpanded);
        dropdownMenu.classList.toggle("hidden");
      });

      // Optional: Close the menu when clicking outside
      document.addEventListener("click", (event) => {
        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
          menuButton.setAttribute("aria-expanded", "false");
          dropdownMenu.classList.add("hidden");
        }
      });
    });

    document.addEventListener("DOMContentLoaded", () => {
      const quickSearchInput = document.getElementById("quickSearch");
      const tableRows = document.querySelectorAll("tbody tr");

      quickSearchInput.addEventListener("input", (event) => {
        const searchValue = event.target.value.toLowerCase();

        // Filter rows based on input
        tableRows.forEach((row) => {
          const inventoryId = row.cells[0].textContent.toLowerCase();
          const itemName = row.cells[1].textContent.toLowerCase();
          const quantity = row.cells[2].textContent.toLowerCase();

          if (
            inventoryId.includes(searchValue) ||
            itemName.includes(searchValue) ||
            quantity.includes(searchValue)
          ) {
            row.style.display = ""; // Show row
          } else {
            row.style.display = "none"; // Hide row
          }
        });
      });
    });

    function confirmStatus() {
      swal.fire({
        title: "Apakah Anda Yakin Sudah Menerima Stok?",
        text: "Stok barang akan masuk ke inventory!",
        icon: "warning",
        confirmButtonColor: '#d33',
			  cancelButtonColor: '#3085d6',
        showCancelButton: true,
        confirmButtonText: "Ya, terima!",
        cancelButtonText: "Tidak",
        allowOutsideClick: false,
        allowEscapeKey: true,
      }).then((result) => {
        if (result.isConfirmed) {
          swal.fire({
            title: "Berhasil",
            text: "Stok barang berhasil ditambahkan!",
            icon: 'success',
            timer: 1000,
            showConfirmButton: false
          }).then(() => {
            document.getElementById("inventoryStatusForm").submit();
          });
        }
      }) 
    }

  </script>
</body>
</html>