<main class="flex-1 ml-24 mt-20 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Transaksi</h2>
    <div class="space-x-2">
      <button id="printInvoiceBtn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Cetak Invoice</button>
      <button id="tambahBarangBtn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
    </div>
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
        <div class="mb-4">
          <label for="namabarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <select id="namabarang" name="namabarang" onchange="fetchItemDetails()"
                  class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Nama Barang --</option>
            <?php foreach ($data['item'] as $item) : ?>
              <option value="<?= $item['ITEM_NAME']; ?>"><?= $item['ITEM_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="kodebarang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
          <input type="text" id="kodebarang" name="kodebarang" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
        </div>
        <div class="mb-4">
          <label for="harga" class="block text-sm font-medium text-gray-700">Harga Barang</label>
          <input type="text" id="harga" name="harga" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="formatHarga(this)" readonly>
        </div>
        <div class="mb-4">
          <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
          <input type="number" id="jumlah" name="jumlah" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  let editingRow = null;

  // Fungsi untuk menutup modal
  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    editingRow = null;
  }

  // Menampilkan modal untuk tambah barang
  document.getElementById('tambahBarangBtn').addEventListener('click', function () {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('createBarangForm').reset();
  });

  // Fungsi untuk menambah baris baru di tabel
  function addRowToTable(kodeBarang, namaBarang, jumlahBarang, hargaBarang, totalHarga) {
    const tableBody = document.querySelector('#barangTable tbody');
    const row = document.createElement('tr');

    row.innerHTML = `
      <td class="py-3 px-4 border text-center">${kodeBarang}</td>
      <td class="py-3 px-4 border text-center">${namaBarang}</td>
      <td class="py-3 px-4 border text-center">${jumlahBarang}</td>
      <td class="py-3 px-4 border text-center">Rp ${formatCurrency(hargaBarang)}</td>
      <td class="py-3 px-4 border text-center">Rp ${formatCurrency(totalHarga)}</td>
      <td class="py-3 px-4 border text-center">
        <button class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600" onclick="editRow(this)">Update</button>
        <button class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" onclick="deleteRow(this)">Hapus</button>
      </td>
    `;

    tableBody.appendChild(row);
    saveToLocalStorage(); // Simpan data setiap kali baris ditambahkan
  }

  // Fungsi untuk menghapus baris
  function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
    saveToLocalStorage(); // Simpan data setiap kali baris dihapus
  }

  // Fungsi untuk mengedit baris
  function editRow(button) {
    const row = button.closest('tr');
    editingRow = row;

    const cells = row.querySelectorAll('td');
    document.getElementById('kodebarang').value = cells[0].textContent;
    document.getElementById('namabarang').value = cells[1].textContent;
    document.getElementById('jumlah').value = cells[2].textContent;
    document.getElementById('harga').value = cells[3].textContent.replace(/[^0-9]/g, '');
    
    document.getElementById('modal').style.display = 'flex';
  }

  // Menangani form submission
  document.getElementById('createBarangForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const kodeBarang = document.getElementById('kodebarang').value.trim();
    const namaBarang = document.getElementById('namabarang').value.trim();
    const jumlahBarang = parseInt(document.getElementById('jumlah').value, 10);
    const hargaBarang = parseFloat(document.getElementById('harga').value.replace(/,/g, ''));
    const totalHarga = jumlahBarang * hargaBarang;

    if (editingRow) {
      const cells = editingRow.querySelectorAll('td');
      cells[0].textContent = kodeBarang;
      cells[1].textContent = namaBarang;
      cells[2].textContent = jumlahBarang;
      cells[3].textContent = `Rp ${formatCurrency(hargaBarang)}`;
      cells[4].textContent = `Rp ${formatCurrency(totalHarga)}`;
      editingRow = null;
    } else {
      addRowToTable(kodeBarang, namaBarang, jumlahBarang, hargaBarang, totalHarga);
    }

    this.reset();
    closeModal();
  });

  // Format harga
  function formatCurrency(value) {
    return parseInt(value).toLocaleString('id-ID');
  }

  // Simpan data ke localStorage
  function saveToLocalStorage() {
    const tableBody = document.querySelector('#barangTable tbody');
    const rows = tableBody.querySelectorAll('tr');
    const data = Array.from(rows).map(row => {
      const cells = row.querySelectorAll('td');
      return {
        kodeBarang: cells[0].textContent,
        namaBarang: cells[1].textContent,
        jumlahBarang: parseInt(cells[2].textContent, 10),
        hargaBarang: parseInt(cells[3].textContent.replace(/[^0-9]/g, ''), 10),
        totalHarga: parseInt(cells[4].textContent.replace(/[^0-9]/g, ''), 10),
      };
    });
    localStorage.setItem('barangData', JSON.stringify(data));
  }

  // Muat data dari localStorage
  function loadFromLocalStorage() {
    const data = JSON.parse(localStorage.getItem('barangData')) || [];
    data.forEach(item => {
      addRowToTable(item.kodeBarang, item.namaBarang, item.jumlahBarang, item.hargaBarang, item.totalHarga);
    });
  }

  // Panggil loadFromLocalStorage saat halaman dimuat
  document.addEventListener('DOMContentLoaded', loadFromLocalStorage);

  // Print invoice
  document.getElementById('printInvoiceBtn').addEventListener('click', function () {
    const printContent = document.querySelector('.bg-white').outerHTML;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
      <html>
        <head>
          <title>Invoice</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f4f4f4; }
          </style>
        </head>
        <body>
          <h1 style="text-align: center; color: #333;">Invoice</h1>
          ${printContent}
        </body>
      </html>
    `);
    printWindow.document.close();
    printWindow.print();
  });

  function fetchItemDetails(){
    const namaBarang = $('#namabarang').val();
    
    if (namaBarang) {
      $.ajax({
        url: "<?= BASEURL; ?>/Cashier/getDetailItem",
        data: { namabarang: namaBarang },
        method: "POST",
        dataType: "json",
        success: function(data) {
          $("#harga").val(data.HARGA_JUAL);
          $("#kodebarang").val(data.ITEM_ID);
          console.log(data);
        }
      })
      // $.post(
      //   "<?= BASEURL; ?>/Cashier/getDetailItem",
      //   { namabarang: namaBarang },
      //   function(data) {
      //     $("#harga").val(data.HARGA_JUAL);
      //     $("#kodebarang").val(data.KODE_BARANG);
      //     console.log(data);
      //   }
      // )
    }
  }
</script>
