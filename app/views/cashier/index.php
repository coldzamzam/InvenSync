<main class="flex-1 ml-24 mt-20 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Transaksi Kasir</h2>
    <div class="space-x-2">
      <?php if (isset($_SESSION['receipt_id'])):?>
        <button id="konfirmasiBtn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Konfirmasi Pembelian</button>
      <?php endif;?>
      <button id="tambahBarangBtn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
    </div>
  </header>
  <div class="bg-white rounded shadow">
    <table id="barangTable" class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-200 text-gray-600">
          <th class="py-3 px-4 border">Kode Barang</th>
          <th class="py-3 px-4 border">Merk Barang</th>
          <th class="py-3 px-4 border">Kategori Barang</th>
          <th class="py-3 px-4 border">Nama Barang</th>
          <th class="py-3 px-4 border">Jumlah Barang</th>
          <th class="py-3 px-4 border">Harga Barang</th>
          <th class="py-3 px-4 border">Total Harga</th>
          <th id="optionSect" class="py-3 px-4 border text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping data item menggunakan PHP -->
        <?php foreach($data['receiptItems'] as $item): ?>
          <tr class="group hover:bg-gray-100 relative">
            <td class="py-3 px-4 border"><?= $item['ITEM_ID']; ?></td>
            <td class="py-3 px-4 border"><?= $item['BRAND_NAME']; ?></td>
            <td class="py-3 px-4 border"><?= $item['CATEGORY_NAME']; ?></td>
            <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
            <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
            <td class="py-3 px-4 border"><?= $item['COST_PRICE']; ?></td>
            <td class="py-3 px-4 border"><?= $item['QUANTITY']*$item['COST_PRICE']; ?></td>
            <td id="optionSect" class="py-3 px-4 border text-center">
              <button class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Hapus</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php Flasher::flash(); ?>
</main>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Tambah Barang</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <form id="createBarangForm" action="<?= BASEURL; ?>/cashier/addItem" method="post">
      <div class="mt-6">
        <div class="mb-4">
          <label for="namabarang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <select id="kodebarang"  name="kodebarang" onchange="fetchItemDetails()"
                  class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Nama Barang --</option>
            <?php foreach ($data['item'] as $item) : ?>
              <option value="<?= $item['ITEM_ID']; ?>"><?= $item['ITEM_ID']; ?> - <?= $item['ITEM_NAME']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="merk" class="block text-sm font-medium text-gray-700">Merk</label>
          <input type="text" id="merk" name="merk" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
        </div>
        <div class="mb-4">
          <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
          <input type="text" id="kategori" name="kategori" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
        </div>
        <div class="mb-4">
          <label for="harga" class="block text-sm font-medium text-gray-700">Harga Barang</label>
          <input type="text" id="harga" name="harga" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="formatHarga(this)" readonly>
        </div>
        <div class="mb-4">
          <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
          <input type="number" id="quantity" name="quantity" class="w-full bg-gray-200 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Pembayaran -->
<div id="konfirmasiPembayaranModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Transaksi Berhasil</h3>
    </div>
    <h3 class="text-l text-center">Berikut adalah invoice dari pembayaran yang telah dilakukan</h3>
    <div class="flex justify-end mt-4 gap-4">
      <button id="printInvoiceBtn" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Print Invoice <i class="fa fa-print"></i></button>
      <form action="<?= BASEURL;?>/cashier/closeTransaction" method="post">
        <button onclick="closeModalPembayaran()" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Tutup Transaski</button>
      </form>
    </div>
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
  

  function closeModalPembayaran() {
    document.getElementById('konfirmasiPembayaranModal').style.display = 'none';
  }
  document.getElementById('konfirmasiBtn').addEventListener('click', function () {
    swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin melakukan pembayaran?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Bayar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('konfirmasiPembayaranModal').style.display = 'flex';
        }
    }).catch((error) => {
        console.log(error);
    })
});



  document.getElementById('printInvoiceBtn').addEventListener('click', function () {
    const printContent = document.querySelector('.bg-white').outerHTML;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
      <html>
        <head>
          <style>
            @media print {
              #optionSect {
                display: none;
              }
            }
          </style>
          <title>Invoice</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f4f4f4; }

            /* Hanya menampilkan konten yang diperlukan, sembunyikan tombol */
            #printInvoiceBtn, 
            #submitButton {
              display: none;
            }
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
    const kodeBarang = $('#kodebarang').val();
    
    if (kodeBarang) {
      $.ajax({
        url: "<?= BASEURL; ?>/Cashier/getDetailItem",
        data: { kodebarang: kodeBarang },
        method: "POST",
        dataType: "json",
        success: function(data) {
          $("#harga").val(data.COST_PRICE);
          $("#namabarang").val(data.ITEM_NAME);
          $("#kategori").val(data.CATEGORY_NAME);
          $("#merk").val(data.BRAND_NAME);
          console.log(data);
        }
      })
    }
  }
  // Menangkap perubahan pada dropdown
    document.getElementById('kodebarang').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex]; // Ambil opsi yang dipilih
        const namaBarang = selectedOption.getAttribute('data-namabarang'); // Ambil data-namabarang
        
        // Isi input Nama Barang
        document.getElementById('namabarang').value = namaBarang;
    });

</script>
