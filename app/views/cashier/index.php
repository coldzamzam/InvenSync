<main class="flex-1 ml-64 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Transaksi</h2>
    <button id="tambahBarangBtn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
  </header>
  <div class="bg-white rounded shadow">
    <table id="barangTable" class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-200 text-gray-600">
          <th class="py-3 px-4 border">Nama Barang</th>
          <th class="py-3 px-4 border">Jumlah Barang</th>
          <th class="py-3 px-4 border">Harga Barang</th>
          <th class="py-3 px-4 border">Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data rows will be added here dynamically -->
      </tbody>
    </table>
  </div>
</main>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <!-- Header Modal -->
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Tambah Barang</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <form id="createBarangForm">
      <div class="mt-6">
        <!-- Nama Barang -->
        <div class="mb-4">
          <label for="namabarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <input type="text" id="namabarang" name="namabarang" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="namabarangError" class="text-red-500 error"></span>
        </div>

        <!-- Jumlah Barang -->
        <div class="mb-4">
          <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
          <input type="text" id="jumlah" name="jumlah" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="jumlahError" class="text-red-500 error"></span>
        </div>

        <!-- Harga Barang -->
        <div class="mb-4">
          <label for="harga" class="block text-sm font-medium text-gray-700">Harga Barang</label>
          <input type="text" id="harga" name="harga" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="hargaError" class="text-red-500 error"></span>
        </div>

        <!-- Total -->
        <div class="mb-6">
          <label for="total" class="block text-sm font-medium text-gray-700">Total Harga</label>
          <input type="text" id="total" name="total" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="totalError" class="text-red-500 error"></span>
        </div>

        <!-- Tombol Tambahkan -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambahkan</button>
      </div>
    </form>
  </div>
</div>

<script>
// Function to save the table data to localStorage
function saveTableData() {
  const tableRows = [];
  const rows = document.querySelectorAll('#barangTable tbody tr');
  rows.forEach(row => {
    const rowData = {
      namaBarang: row.cells[0].textContent,
      jumlah: row.cells[1].textContent,
      harga: row.cells[2].textContent,
      total: row.cells[3].textContent
    };
    tableRows.push(rowData);
  });
  localStorage.setItem('barangData', JSON.stringify(tableRows));
}

// Function to load the table data from localStorage
function loadTableData() {
  const savedData = localStorage.getItem('barangData');
  if (savedData) {
    const barangData = JSON.parse(savedData);
    const tableBody = document.querySelector('#barangTable tbody');
    barangData.forEach(item => {
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td class="py-3 px-4 border">${item.namaBarang}</td>
        <td class="py-3 px-4 border">${item.jumlah}</td>
        <td class="py-3 px-4 border">${item.harga}</td>
        <td class="py-3 px-4 border">${item.total}</td>
      `;
      tableBody.appendChild(newRow);
    });
  }
}

// Menutup modal
function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

// Menampilkan modal ketika tombol Tambah Barang diklik
document.getElementById('tambahBarangBtn').addEventListener('click', function() {
  document.getElementById('modal').style.display = 'flex';
});

// Validasi Form
document.getElementById('createBarangForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const namabarang = document.getElementById('namabarang').value;
    const harga = document.getElementById('harga').value;
    const total = document.getElementById('total').value;
    const jumlah = document.getElementById('jumlah').value;

    // Validation checks
    let errors = false;

    // Clear any existing error messages
    document.querySelectorAll('.error').forEach(function(el) {
      el.textContent = '';
    });

    // Validate each field and show errors if any
    if (!namabarang) {
      document.getElementById('namabarangError').textContent = 'Nama Barang tidak boleh kosong.';
      errors = true;
    }
    if (!harga) {
      document.getElementById('hargaError').textContent = 'Harga Barang tidak boleh kosong.';
      errors = true;
    }
    if (!total) {
      document.getElementById('totalError').textContent = 'Total Harga tidak boleh kosong.';
      errors = true;
    }
    if (!jumlah) {
      document.getElementById('jumlahError').textContent = 'Jumlah Barang tidak boleh kosong.';
      errors = true;
    }

    if (errors) {
      // Stay on the modal if there are validation errors
      return;
    }

    // If there are no errors, add the data to the table dynamically
    const tableBody = document.querySelector('#barangTable tbody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
      <td class="py-3 px-4 border">${namabarang}</td>
      <td class="py-3 px-4 border">${jumlah}</td>
      <td class="py-3 px-4 border">${harga}</td>
      <td class="py-3 px-4 border">${total}</td>
    `;

    // Append the new row to the table
    tableBody.appendChild(newRow);

    // Save the new table data to localStorage
    saveTableData();

    // Close the modal after adding the item
    closeModal();
});

// Load the table data when the page loads
window.addEventListener('load', function() {
  loadTableData();
});
</script>
