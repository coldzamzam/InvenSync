<main class="flex-1 ml-64 mt-20 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Transaksi</h2>
    <button id="tambahBarangBtn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
  </header>
  <div class="bg-white rounded shadow">
    <table id="barangTable" class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-200 text-gray-600">
          <th class="py-3 px-4 border text-center">Kode Barang</th>
          <th class="py-3 px-4 border text-center">Nama Barang</th>
          <th class="py-3 px-4 border text-center">Jumlah Barang</th>
          <th class="py-3 px-4 border text-center">Harga Barang</th>
          <th class="py-3 px-4 border text-center">Total Harga</th>
          <th class="py-3 px-4 border text-center">Option</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data rows will be dynamically added here -->
      </tbody>
    </table>
  </div>
</main>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Tambah/Update Barang</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <form id="createBarangForm">
      <div class="mt-6">
        <!-- Kode Barang -->
        <div class="mb-4">
          <label for="kodebarang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
          <input type="text" id="kodebarang" name="kodebarang" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="kodebarangError" class="text-red-500 error"></span>
        </div>

        <!-- Nama Barang -->
        <div class="mb-4">
          <label for="namabarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <input type="text" id="namabarang" name="namabarang" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="namabarangError" class="text-red-500 error"></span>
        </div>

        <!-- Jumlah Barang -->
        <div class="mb-4">
          <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
          <input type="number" id="jumlah" name="jumlah" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="jumlahError" class="text-red-500 error"></span>
        </div>

        <!-- Harga Barang -->
        <div class="mb-4">
          <label for="harga" class="block text-sm font-medium text-gray-700">Harga Barang</label>
          <input type="text" id="harga" name="harga" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="formatHarga(this)">
          <span id="hargaError" class="text-red-500 error"></span>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  let editingRow = null; // Variable untuk menyimpan baris yang sedang diedit

  // Menutup modal
  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    editingRow = null; // Reset editingRow
  }

  // Menampilkan modal untuk Tambah Barang
  document.getElementById('tambahBarangBtn').addEventListener('click', function () {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('createBarangForm').reset(); // Reset form saat modal dibuka
  });

  // Load data dari localStorage
  function loadTableData() {
    const savedData = localStorage.getItem('barangData');
    if (savedData) {
      const barangData = JSON.parse(savedData);
      const tableBody = document.querySelector('#barangTable tbody');
      barangData.forEach(item => {
        const newRow = createRow(item);
        tableBody.appendChild(newRow);
      });
    }
  }

  // Simpan data ke localStorage
  function saveTableData() {
    const rows = Array.from(document.querySelectorAll('#barangTable tbody tr'));
    const data = rows.map(row => {
      return {
        kodeBarang: row.cells[0].textContent,
        namaBarang: row.cells[1].textContent,
        jumlah: row.cells[2].textContent,
        harga: removeNonNumericChars(row.cells[3].textContent),
        total: removeNonNumericChars(row.cells[4].textContent)
      };
    });
    localStorage.setItem('barangData', JSON.stringify(data));
  }

  // Buat baris tabel
  function createRow(item) {
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td class="py-3 px-4 border">${item.kodeBarang}</td>
      <td class="py-3 px-4 border">${item.namaBarang}</td>
      <td class="py-3 px-4 border">${item.jumlah}</td>
      <td class="py-3 px-4 border">${formatCurrency(item.harga)}</td>
      <td class="py-3 px-4 border">${formatCurrency(item.total)}</td>
      <td class="py-3 px-4 border flex justify-center space-x-4">
        <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600" onclick="editRow(this)">Update</button>
        <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteRow(this)">Delete</button>
      </td>
    `;
    return newRow;
  }

  // Edit baris
  function editRow(button) {
    const row = button.closest('tr');
    editingRow = row;

    const cells = row.querySelectorAll('td');
    document.getElementById('kodebarang').value = cells[0].textContent;
    document.getElementById('namabarang').value = cells[1].textContent;
    document.getElementById('jumlah').value = cells[2].textContent;
    document.getElementById('harga').value = removeNonNumericChars(cells[3].textContent);

    document.getElementById('modal').style.display = 'flex';
  }

  // Hapus baris
  function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
    saveTableData();
  }

  // Tangani submit form
  document.getElementById('createBarangForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const kodeBarang = document.getElementById('kodebarang').value;
    const namaBarang = document.getElementById('namabarang').value;
    const jumlah = parseInt(document.getElementById('jumlah').value, 10);
    const harga = parseInt(removeNonNumericChars(document.getElementById('harga').value), 10);
    const total = jumlah * harga; // Hitung total harga

    if (editingRow) {
      editingRow.innerHTML = `
        <td class="py-3 px-4 border">${kodeBarang}</td>
        <td class="py-3 px-4 border">${namaBarang}</td>
        <td class="py-3 px-4 border">${jumlah}</td>
        <td class="py-3 px-4 border">${formatCurrency(harga)}</td>
        <td class="py-3 px-4 border">${formatCurrency(total)}</td>
        <td class="py-3 px-4 border flex justify-center space-x-4">
          <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600" onclick="editRow(this)">Update</button>
          <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteRow(this)">Delete</button>
        </td>
      `;
      editingRow = null;
    } else {
      const tableBody = document.querySelector('#barangTable tbody');
      const newRow = createRow({ kodeBarang, namaBarang, jumlah, harga, total });
      tableBody.appendChild(newRow);
    }

    saveTableData();
    closeModal();
  });

  // Format harga menjadi format ribuan (200000 -> 200.000) dengan prefix "Rp"
  function formatCurrency(price) {
    return 'Rp ' + parseInt(price).toLocaleString('id-ID');
  }

  // Menghilangkan pemisah ribuan dan mengembalikan nilai numerik
  function removeNonNumericChars(str) {
    return str.replace(/[^\d]/g, '');
  }

  // Format input harga menjadi format ribuan dengan awalan "Rp"
  function formatHarga(input) {
    let value = removeNonNumericChars(input.value);
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    input.value = 'Rp ' + value;
  }

  // Muat data saat halaman pertama kali dimuat
  loadTableData();
</script>
