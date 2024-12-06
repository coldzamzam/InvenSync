  <!-- Main Content -->
  <main class="flex-1 ml-24 mt-20 p-8">
    <header class="flex justify-between items-center mb-6">
      <!-- <h2 class="text-2xl font-semibold text-blue-500">Inventory</h2> -->
      <div class="wrap-cards gap-4 flex">
        <div class="card border border-green-300 bg-green-300">
          <div class="card-header flex justify-between p-2">
            <p>Stok tersedia</p>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17h6" /><path d="M9 13h6" /></svg>
          </div>
          <div class="card-body p-2">
            <p class="text-md mb-2">
              <span class="text-lg font-bold">0</span> Produk
            </p>
            
          </div>
        </div>
        <div class="card border border-green-300 bg-green-300">
          <div class="card-header flex justify-between p-2">
            <p>Stok Segera Habis</p>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17h6" /><path d="M9 13h6" /></svg>
          </div>
          <div class="card-body p-2">
            <p class="text-md mb-2">
              <span class="text-lg font-bold">0</span> Produk
            </p>
            
          </div>
        </div>
        <div class="card border border-green-300 bg-green-300">
          <div class="card-header flex justify-between p-2">
            <p>Stok Habis</p>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17h6" /><path d="M9 13h6" /></svg>
          </div>
          <div class="card-body p-2">
            <p class="text-md mb-2">
              <span class="text-lg font-bold">0</span> Produk
            </p>
          </div>
        </div>


      </div>
      
    </header>

    <div class="flex items-center mb-4 space-x-4 justify-between">
      <div class="wrap-filter flex items-center gap-4">
        <input type="text" placeholder="Quick search" class="border rounded px-4 py-2">
        <input type="date" class="border rounded px-4 py-2">
        <select class="border rounded px-4 py-2">
          <option>Status</option>
          <option>Pending</option>
          <option>Completed</option>
        </select>
      </div>

      <div>
          <!-- Tombol Dropdown -->
        <div class="relative inline-block text-left">
          <div>
            <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
              Options
              <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
  
          <!--
            Dropdown menu, show/hide based on menu state.
  
            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none hidden" id="dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
              <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
              <form method="POST" action="#" role="none">
                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
              </form>
            </div>
          </div>
        </div>
  
        <button id="openModalButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ New Stock</button>
      </div>
    </div>

    <div class="flex gap-4 mb-4">

      <div class="bg-white min-h-[600px] shadow-md border border-zinc-100 w-3/12 px-6 py-4 rounded-lg">
        <p class="text-lg font-bold pb-2">Total Stock</p>
        <div class="bg-white rounded shadow">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-200 text-gray-600">
                <th class="py-3 px-4 border">Item Name</th>
                <th class="py-3 px-4 border">Total Quantity</th>
              </tr>
            </thead>
            <tbody>
              <!-- Looping data item menggunakan PHP -->
              <?php foreach($data['totalQty'] as $total): ?>
                <tr class="group hover:bg-gray-100 relative">
                  <td class="py-3 px-4 border"><?= $total['ITEM_NAME']; ?></td>
                  <td class="py-3 px-4 border"><?= $total['TOTALQUANTITY']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
  
      <div class="bg-white shadow-md px-6 py-4 border border-zinc-100 rounded-lg w-9/12">
        <p class="text-lg font-bold pb-2">Track Inventory</p>
        <div class="bg-white rounded shadow">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-200 text-gray-600">
                <th class="py-3 px-4 border">Inventory ID</th>
                <th class="py-3 px-4 border">Item Name</th>
                <th class="py-3 px-4 border">Quantity</th>
                <th class="py-3 px-4 border">Date Added</th>
                <th class="py-3 px-4 border">Cost Price</th>
                <th class="py-3 px-4 border">User ID</th>
                <th class="py-3 px-4 border">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Looping data item menggunakan PHP -->
              <?php foreach($data['inventory'] as $item): ?>
                <tr class="group hover:bg-gray-100 relative">
                  <td class="py-3 px-4 border"><?= $item['INVENTORY_ID']; ?></td>
                  <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
                  <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
                  <td class="py-3 px-4 border"><?= $item['DATE_ADDED']; ?></td>
                  <td class="py-3 px-4 border"><?= $item['HARGA_BELI']; ?></td>
                  <td class="py-3 px-4 border"><?= $item['USER_ID']; ?></td>
                  <td class="py-3 px-4 border">
                    <button class="text-blue-500" onclick="editItem(<?= $item['INVENTORY_ID']; ?>)">Edit</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
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
    
  </script>

</body>
</html>