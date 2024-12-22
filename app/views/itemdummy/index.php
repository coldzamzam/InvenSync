  <!-- Main Content -->
  <main class="flex-1 ml-24 mt-20 p-8">

    <div class="flex items-center mb-4 space-x-4 justify-between">
      <div class="wrap-filter flex items-center gap-4">
      <input type="text" id="quickSearchInput" placeholder="Cari" class="border rounded px-4 py-2">
        <!-- <input type="date" class="border rounded px-4 py-2">
        <select class="border rounded px-4 py-2">
          <option>Status</option>
          <option>Pending</option>
          <option>Completed</option>
        </select> -->
      </div>
      <div>
          <!-- Tombol Dropdown -->
        <div class="relative inline-block text-left">
          <div>
            <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-blue px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
              Tambah
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
              <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-brand">Tambah Brand</button>
              <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-category">Tambah Kategori</button>
            </div>
          </div>
        </div>
        <button id="openModalButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
      </div>
    </div>

    <div class="bg-white rounded shadow">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-[#FFD369] text-gray-600">
            <th class="py-3 px-4 border text-center">ID Barang</th>
            <th class="py-3 px-4 border text-center">Nama Barang</th>
            <th class="py-3 px-4 border text-center">Kategori Barang</th>
            <th class="py-3 px-4 border text-center">Nama Brand</th>
            <th class="py-3 px-4 border text-center">Harga Jual</th>
            <th class="py-3 px-4 border text-center">Tanggal Ditambahkan</th>
            <th class="py-3 px-4 border text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Looping data item menggunakan PHP -->
          <?php foreach($data['item'] as $item): ?>
            <tr class="group hover:bg-gray-100 relative">
              <td class="py-3 px-4 border text-center"><?= $item['ITEM_ID']; ?></td>
              <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
              <td class="py-3 px-4 border text-center"><?= $item['CATEGORY_NAME']; ?></td>
              <td class="py-3 px-4 border text-center"><?= $item['BRAND_NAME']; ?></td>
              <td class="py-3 px-4 border text-center">Rp<?= number_format($item['COST_PRICE'], 2, '.', ','); ?></td>
              <td class="py-3 px-4 border text-center"><?= $item['DATE_ADDED']; ?></td>
              <td class="py-3 px-4 border flex justify-center items-center">
              <button onclick="editModalOpen('<?= $item['ITEM_ID']; ?>')" 
                    data-item-id="<?= $item['ITEM_ID']; ?>" 
                    data-item-name="<?= $item['ITEM_NAME']; ?>" 
                    data-category-id="<?= $item['CATEGORY_ID']; ?>" 
                    data-brand-id="<?= $item['BRAND_ID']; ?>" 
                    data-cost-price="<?= $item['COST_PRICE']; ?>" 
                    class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600">
                <img src="<?= BASEURL; ?>/img/setting-logo.png" width="20px" height="20px" alt="logo edit">
            </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
          </table>
    </div>
  </main>

  <div class="flex justify-center mb-6 space-x-2">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="/invensync/public/item?page=<?= $i; ?>" 
                class="px-4 py-2 <?= $i === $data['currentPage'] ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'; ?> hover:bg-blue-400 hover:text-white">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>
        </div>

<!-- Modal for Adding or Editing Stock -->
<div id="formModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Tambah/Edit Barang</h2>
        <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form id="inventoryForm" action="<?= BASEURL; ?>/Inventory/tambahItem" method="post">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Barang -->
        <div class="mb-3">
          <label for="item_name" class="text-sm text-gray-700">Nama Barang</label>
          <input id="item_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="item_name" placeholder="Nama Barang">
        </div>
        
        <!-- Category -->
        <div class="mb-3">
          <label for="category_id" class="text-sm text-gray-700">Kategori</label>
          <select id="category_id" name="category_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Kategori --</option>
            <?php foreach($data['category'] as $category): ?>
              <option value="<?= $category['CATEGORY_ID']; ?>"><?= $category['CATEGORY_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- brand -->
        <div class="mb-3">
          <label for="brand_id" class="text-sm text-gray-700">Brand</label>
          <select id="brand_id" name="brand_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Brand --</option>
            <?php foreach($data['brand'] as $brand): ?>
              <option value="<?= $brand['BRAND_ID']; ?>"><?= $brand['BRAND_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Harga Jual -->
        <div class="mb-3">
  <label for="cost_price" class="text-sm text-gray-700">Harga Jual</label>
  <input id="formatted_cost_price" name="cost_price" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" placeholder="Harga Jual">
</div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Tambah Barang</button>
        </div>
      </form>
      <form action="<?= BASEURL;?>/Inventory/deleteItem" method="post" class="pl-6 hidden" id="deleteItemForm">
          <input type="hidden" id="deleteID" name="id">
          <button type="button" onclick="deleteConfirmation()" class="right-0 p-2 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"><img src="<?= BASEURL; ?>/img/delete.png" width="20px" height="20px" alt="delete"></button>
      </form>
  </div>
    </div>
  </div>

  <div id="modalBrand" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Tambah Brand</h2>
        <button id="closeModalBrand" class="text-gray-500 hover:text-gray-700">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form id="brandForm" action="<?= BASEURL; ?>/Inventory/tambahBrand" method="post">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Brand -->
        <div class="mb-3">
          <label for="brand_name" class="text-sm text-gray-700">Nama Brand</label>
          <input id="brand_name" name='brand_name' class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="brand_name">
          <span class="text-red-500"><?= $data['brandError']; ?></span>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButtonBrand">Tambah Brand</button>
        </div>
      </form>
    </div>
  </div>

  <div id="modalCategory" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Tambah Kategori</h2>
        <button id="closeModalCategory" class="text-gray-500 hover:text-gray-700">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <form id="categoryForm" action="<?= BASEURL; ?>/Inventory/tambahCategory" method="post">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Category -->
        <div class="mb-3">
          <label for="ITEM_NAME" class="text-sm text-gray-700">Nama Kategori</label>
          <input id="ITEM_NAME" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="category_name">
          <span class="text-red-500"><?= $data['categoryError']; ?></span>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButtonCategory">Tambah Kategori</button>
        </div>
      </form>
  </div>
    </div>
  </div>

<!---edit--->
<div id="modalEdit" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-600">Edit List Barang</h2>
        <button id="closeModalEditButton" class="text-gray-500 hover:text-gray-700">
  <span class="text-2xl">&times;</span>
</button>
      </div>
      <form action="<?= BASEURL; ?>/inventory/updateItem" method="post" id="editItemForm" class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg" enctype="multipart/form-data">
        <input type="hidden" id="itemId" name="ITEM_ID" value="">

        <!-- Nama Barang -->
        <div class="mb-3">
          <label for="item_name" class="text-sm text-gray-700">Nama Barang</label>
          <input id="item_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" name="item_name" placeholder="Nama Barang">
        </div>
        
        <!-- Category -->
        <div class="mb-3">
          <label for="category_id" class="text-sm text-gray-700">Kategori</label>
          <select id="category_id" name="category_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Kategori --</option>
            <?php foreach($data['category'] as $category): ?>
              <option value="<?= $category['CATEGORY_ID']; ?>"><?= $category['CATEGORY_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- brand -->
        <div class="mb-3">
          <label for="brand_id" class="text-sm text-gray-700">Brand</label>
          <select id="brand_id" name="brand_id" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Brand --</option>
            <?php foreach($data['brand'] as $brand): ?>
              <option value="<?= $brand['BRAND_ID']; ?>"><?= $brand['BRAND_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <!-- Harga Jual -->
        <div class="mb-3">
  <label for="cost_price" class="text-sm text-gray-700">Harga Jual</label>
  <input id="formatted_cost_price" name="cost_price" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" type="text" placeholder="Harga Jual">
</div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Tambah/Edit Barang</button>
        </div>
      </form>
      <form action="<?= BASEURL;?>/Inventory/deleteItem" method="post" class="pl-6" id="deleteItemForm">
          <input type="hidden" id="deleteID" name="id">
          <button type="button" onclick="deleteConfirmation()" class="right-0 p-2 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"><img src="<?= BASEURL; ?>/img/delete.png" width="20px" height="20px" alt="delete"></button>
    </form>
  </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Mendapatkan elemen modal dan tombol
    const modal = document.getElementById('formModal');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const closeModalEditButton = document.getElementById('closeModalEditButton');
    const submitButton = document.getElementById('submitButton');

    const modalBrand = document.getElementById('modalBrand');
    const openModalBrandButton = document.getElementById('menu-item-brand');
    const closeModalBrandButton = document.getElementById('closeModalBrand');
    const submitButtonBrand = document.getElementById('submitButtonBrand');

    const modalCategory = document.getElementById('modalCategory');
    const openModalCategoryButton = document.getElementById('menu-item-category');
    const closeModalCategoryButton = document.getElementById('closeModalCategory');
    const submitButtonCategory = document.getElementById('submitButtonCategory');
    
    // Fungsi untuk membuka modal
    openModalButton.addEventListener('click', () => {
      modal.classList.remove('hidden');
      document.getElementById('inventoryForm').reset();
      document.getElementById('itemId').value = '';
      submitButton.textContent = 'Tambah Barang';
    });

    openModalBrandButton.addEventListener('click', () => {
      modalBrand.classList.remove('hidden');
    });

    openModalCategoryButton.addEventListener('click', () => {
      modalCategory.classList.remove('hidden');
    });

    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    closeModalBrandButton.addEventListener('click', () => {
      modalBrand.classList.add('hidden');
    });

    closeModalCategoryButton.addEventListener('click', () => {
      modalCategory.classList.add('hidden');
    });
    // Menutup modal jika pengguna mengklik di luar modal
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.add('hidden');
      }
    });
    //menutup modal update
    closeModalEditButton.addEventListener('click', () => {
  document.getElementById('modalEdit').classList.add('hidden');
});
    window.addEventListener('click', (event) => {
      if (event.target === modalBrand) {
        modalBrand.classList.add('hidden');
      }
    });

    window.addEventListener('click', (event) => {
      if (event.target === modalCategory) {
        modalCategory.classList.add('hidden');
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
  const quickSearchInput = document.getElementById("quickSearchInput");
  const tableRows = document.querySelectorAll("tbody tr");

  quickSearchInput.addEventListener("input", () => {
    const query = quickSearchInput.value.toLowerCase();

    tableRows.forEach(row => {
      const rowText = row.innerText.toLowerCase();
      row.style.display = rowText.includes(query) ? "" : "none";
    });
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const quickSearchInput = document.getElementById("quickSearchInput");
  const tableRows = document.querySelectorAll("tbody tr");

  quickSearchInput.addEventListener("input", () => {
    const query = quickSearchInput.value.toLowerCase();

    tableRows.forEach(row => {
      const columns = row.querySelectorAll("td"); // Ambil semua kolom di baris ini
      const isMatch = Array.from(columns).some(column =>
        column.innerText.toLowerCase().includes(query)
      );
      
      row.style.display = isMatch ? "" : "none"; // Tampilkan/hilangkan baris berdasarkan hasil
    });
  });
});


// Validasi Modal Brand
document.getElementById('brandForm').addEventListener('submit', function (event) {
  const brandName = document.getElementById('brand_name').value.trim();

  if (brandName === '') {
    event.preventDefault(); // Mencegah form terkirim
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Nama Brand tidak boleh kosong!',
    });
    document.getElementById('brand_name').focus();
  }
});

// Validasi Modal Category
document.getElementById('categoryForm').addEventListener('submit', function (event) {
  const categoryName = document.getElementById('ITEM_NAME').value.trim();

  if (categoryName === '') {
    event.preventDefault(); // Mencegah form terkirim
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Nama Kategori tidak boleh kosong!',
    });
    document.getElementById('ITEM_NAME').focus();
  }
});

// Tutup Modal dan Reset Form
document.getElementById('closeModalBrand').addEventListener('click', function () {
  document.getElementById('modalBrand').classList.add('hidden');
  document.getElementById('brandForm').reset();
});

document.getElementById('closeModalCategory').addEventListener('click', function () {
  document.getElementById('modalCategory').classList.add('hidden');
  document.getElementById('categoryForm').reset();
});

function deleteConfirmation(){
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: "Anda akan menghapus data ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('deleteItemForm').submit();
    }
  })
}


function editModalOpen(itemId) {
  // Ambil tombol yang diklik
  const editButton = document.querySelector(`button[data-item-id='${itemId}']`);

  // Ambil data dari atribut tombol
  const itemName = editButton.getAttribute('data-item-name');
  const categoryId = editButton.getAttribute('data-category-id');
  const brandId = editButton.getAttribute('data-brand-id');
  const costPrice = editButton.getAttribute('data-cost-price');

  // Isi form modal dengan data
  document.getElementById('itemId').value = itemId;
  document.getElementById('item_name').value = itemName;
  document.getElementById('category_id').value = categoryId;
  document.getElementById('brand_id').value = brandId;
  document.getElementById('formatted_cost_price').value = costPrice;
  document.getElementById('deleteID').value = itemId;

  // Ubah teks tombol submit
  document.getElementById('submitButton').textContent = 'Edit Barang';

  document.getElementById('inventoryForm').action = '<?= BASEURL; ?>/inventory/updateItems';
  document.getElementById('deleteItemForm').classList.remove('hidden');
  document.getElementById('formModal').classList.remove('hidden');
}

// Validasi Form Tambah/Edit Barang
document.getElementById('inventoryForm').addEventListener('submit', function (event) {
  const itemName = document.getElementById('item_name').value.trim();
  const categoryId = document.getElementById('category_id').value;
  const brandId = document.getElementById('brand_id').value;
  const costPrice = document.getElementById('formatted_cost_price').value.trim();
  maxhargajual=999999999;

  // Validasi Nama Barang
  if (itemName === '') {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Nama Barang tidak boleh kosong!',
    });
    document.getElementById('item_name').focus();
    return;
  }

  // Validasi Kategori
  if (!categoryId) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silakan pilih Kategori!',
    });
    document.getElementById('category_id').focus();
    return;
  }

  // Validasi Brand
  if (!brandId) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silakan pilih Brand!',
    });
    document.getElementById('brand_id').focus();
    return;
  }

  if (costPrice > maxhargajual) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Harga Jual tidak valid',
    });
    document.getElementById('formatted_cost_price').focus();
    return;
  }

  // Validasi Harga Jual
  const costPriceValue = parseFloat(costPrice.replace(/[^\d.-]/g, '')); // Menghapus karakter selain angka dan titik
  if (isNaN(costPriceValue) || costPriceValue <= 0) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Harga Jual harus berupa angka positif!',
    });
    document.getElementById('formatted_cost_price').focus();
    return;
  }

  // Jika Semua Validasi Lulus
  Swal.fire({
    icon: 'success',
    title: 'Validasi Berhasil!',
    text: 'Data siap untuk dikirim.',
    timer: 1500,
    showConfirmButton: false
  });
});

//paginasi wak//

<?php
// Tambahkan ini di bagian atas file atau di controller
$limit = 10; // Jumlah item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total halaman
$totalItems = count($data['item']);
$totalPages = ceil($totalItems / $limit);

// Validasi nomor halaman
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// Slice array untuk mendapatkan data sesuai halaman
$data['item'] = array_slice($data['item'], $offset, $limit);

// Tambahkan informasi paginasi ke data
$data['pagination'] = [
    'currentPage' => $page,
    'totalPages' => $totalPages,
    'limit' => $limit
];
?>

// Tambahkan script ini di bagian JavaScript yang sudah ada
document.addEventListener("DOMContentLoaded", () => {
  const quickSearchInput = document.getElementById("quickSearchInput");
  const tableRows = document.querySelectorAll("tbody tr");
  const paginationLinks = document.querySelectorAll(".pagination a");

  // Fungsi untuk pencarian
  quickSearchInput.addEventListener("input", () => {
    const query = quickSearchInput.value.toLowerCase();
    let visibleCount = 0;

    tableRows.forEach(row => {
      const columns = row.querySelectorAll("td");
      const isMatch = Array.from(columns).some(column =>
        column.innerText.toLowerCase().includes(query)
      );
      
      row.style.display = isMatch ? "" : "none";
      if (isMatch) visibleCount++;
    });

    // Sembunyikan paginasi saat pencarian aktif
    const paginationContainer = document.querySelector(".pagination");
    if (paginationContainer) {
      paginationContainer.style.display = query ? "none" : "flex";
    }
  });

  // Highlight halaman aktif
  paginationLinks?.forEach(link => {
    if (link.href === window.location.href) {
      link.classList.add("bg-blue-500", "text-white");
      link.classList.remove("bg-gray-200", "text-gray-800");
    }
  });
});

// Tambahkan script ini di bagian JavaScript yang sudah ada
document.addEventListener("DOMContentLoaded", () => {
  const quickSearchInput = document.getElementById("quickSearchInput");
  const tableRows = document.querySelectorAll("tbody tr");
  const paginationLinks = document.querySelectorAll(".pagination a");

  // Fungsi untuk pencarian
  quickSearchInput.addEventListener("input", () => {
    const query = quickSearchInput.value.toLowerCase();
    let visibleCount = 0;

    tableRows.forEach(row => {
      const columns = row.querySelectorAll("td");
      const isMatch = Array.from(columns).some(column =>
        column.innerText.toLowerCase().includes(query)
      );
      
      row.style.display = isMatch ? "" : "none";
      if (isMatch) visibleCount++;
    });

    // Sembunyikan paginasi saat pencarian aktif
    const paginationContainer = document.querySelector(".pagination");
    if (paginationContainer) {
      paginationContainer.style.display = query ? "none" : "flex";
    }
  });

  // Highlight halaman aktif
  paginationLinks?.forEach(link => {
    if (link.href === window.location.href) {
      link.classList.add("bg-blue-500", "text-white");
      link.classList.remove("bg-gray-200", "text-gray-800");
    }
  });
});

</script>
</body>
</html>