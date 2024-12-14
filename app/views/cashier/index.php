<main class="flex-1 ml-24 p-8 mt-14">
  <header class="flex justify-between items-center mb-6 z-[1]">
    <div class="ml-4 w-1/3 top-0 right-0 fixed min-h-screen p-10 bg-white mt-16 shadow-lg">
      <h1 class="text-2xl font-bold mb-4">Barang yang Dipilih</h1>
      <div class="flex flex-col bg-gray-100 p-4 mb-4">
        <?php foreach($data['receiptItems'] as $item): ?>
        <div class="flex items-center p-2 mb-2 gap-3 shadow-sm bg-white group">
            <div>
              <img src="<?= BASEURL; ?>/img/noimage1.png" alt="gambar tidak tersedia" width="50px">
            </div>
            <div class="w-full">
              <div class="flex justify-between">
                  <h2 class="font-bold"><?= $item['ITEM_ID']; ?>-<?= $item['ITEM_NAME']; ?></h2>
                  <h2 class="font-bold">Jumlah : <?= $item['QUANTITY']; ?></h2>
              </div>
              <div>
                <h3>Total Harga : Rp.<?= $item['TOTAL_PER_ITEM']*$item['QUANTITY']; ?></h3>
              </div>
            </div>
            <form action="<?= BASEURL; ?>/cashier/removeItem" method="post">
              <input type="hidden" name="receipt_item_id" value="<?= $item['RECEIPT_ITEM_ID']; ?>">
              <button type="submit" class="hidden group-hover:block absolute bg-red-500 text-white px-2 rounded-full">
                  -
              </button>
            </form>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="space-x-2">
      <?php if (isset($_SESSION['receipt_id'])):?>
        <button id="konfirmasiBtn" class="bg-green-500 text-white w-full py-2 px-4 rounded hover:bg-green-600 bottom-0">Konfirmasi Pembelian</button>
      <?php endif;?>
      </div>
    </div>
  </header>
  <h1 class="text-2xl font-bold mb-4">Barang Yang Tersedia</h1>
  <input type="text" id="quickSearchInput" placeholder="Quick search" class="border rounded px-6 py-2">
  <div class="flex w-3/5">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
    <?php foreach($data['item'] as $item): ?>
      <button id="tambahBarangBtn_<?= $item['ITEM_ID']; ?>" 
              data-itemid="<?= $item['ITEM_ID']; ?>" 
              data-itemname="<?= $item['ITEM_NAME']; ?>"
              class="group bg-white rounded-lg shadow-lg w-full">
        <div class="flex flex-col items-center px-20 py-5">
          <img src="<?= BASEURL; ?>/img/noimage1.png" alt="gambar tidak tersedia" class="group-hover:hidden w-full h-full object-cover">
          <img src="<?= BASEURL; ?>/img/add-cart (1).png" class="w-full h-full  hidden group-hover:block" alt="">
        </div>
        <div class="bg-[#FFD369] rounded-lg flex flex-col">
        <span class="mb-2 font-semibold text-lg"><?= $item['ITEM_ID']; ?> - <?= $item['ITEM_NAME']; ?></span>
          <span class="text-gray-600">Rp.<?= number_format($item['COST_PRICE'], 2); ?></span>
        </div>
      </button>
    <?php endforeach; ?>

    </div>
  </div>

  <!-- <div class="bg-white rounded shadow">
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
      <tbody>Looping data item menggunakan PHP
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
  </div> -->
  <?php Flasher::flash(); ?>
</main>

<!-- Modal Input Quantity -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
  <div class="bg-white w-full max-w-[600px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Tambah Barang</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <form id="createBarangForm" action="<?= BASEURL; ?>/cashier/addItem" method="post">
      <input type="hidden" id="itemId" name="item_id">
      <div class="mb-4">
        <label for="itemName" class="block text-sm font-medium text-gray-700">Nama Barang</label>
        <input type="hidden" id="itemCode" name="kodebarang" class="w-full bg-gray-200 p-3 rounded-lg" readonly>
        <input type="text" id="itemName" name="item_name" class="w-full bg-gray-200 p-3 rounded-lg" readonly>
      </div>
      <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
        <input type="number" id="quantity" name="quantity" class="w-full bg-gray-200 p-3 rounded-lg" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
    </form>
  </div>
</div>

<!-- <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
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
</div> -->


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
  document.querySelectorAll('[id^="tambahBarangBtn_"]').forEach(btn => {
    btn.addEventListener('click', function () {
      const itemId = this.dataset.itemid;
      const itemName = this.dataset.itemname;

      // Isi data form modal
      document.getElementById('itemId').value = itemId;
      document.getElementById('itemName').value = itemName;
      document.getElementById('itemCode').value = itemId;

      // Tampilkan modal
      document.getElementById('modal').style.display = 'flex';
    });
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

document.addEventListener("DOMContentLoaded", function () {
    const konfirmasiBtn = document.getElementById('konfirmasiBtn');
    const itemsContainer = document.querySelector('.flex-col.bg-gray-100');

    // Fungsi untuk memeriksa apakah ada item yang dipilih
    function checkItemsSelected() {
        const items = itemsContainer.querySelectorAll('.group');
        if (items.length > 0) {
            // Menampilkan tombol konfirmasi jika ada item
            konfirmasiBtn.classList.remove('hidden');
        } else {
            // Menyembunyikan tombol konfirmasi jika tidak ada item
            konfirmasiBtn.classList.add('hidden');
        }
    }

    // Menambahkan event listener pada tombol tambah item
    document.querySelectorAll('[id^="tambahBarangBtn_"]').forEach(btn => {
        btn.addEventListener('click', function () {
            // Memanggil fungsi untuk memeriksa apakah ada item yang dipilih setelah menambah item
            checkItemsSelected();
        });
    });

    // Memanggil fungsi ketika halaman pertama kali dimuat
    checkItemsSelected();
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

    document.addEventListener('DOMContentLoaded', function() {
    const quickSearchInput = document.getElementById('quickSearchInput');
    const itemButtons = document.querySelectorAll('[id^="tambahBarangBtn_"]');

    console.log('Quick Search Setup:');
    console.log('Search Input:', quickSearchInput);
    console.log('Found Item Buttons:', itemButtons.length);

    quickSearchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        console.log('Current Search Term:', searchTerm);

        itemButtons.forEach((button, index) => {
            // Debugging: Log each button's details
            const itemId = button.dataset.itemid;
            const itemName = button.dataset.itemname;
            const priceElement = button.querySelector('.text-gray-600');
            const itemPrice = priceElement ? priceElement.textContent : 'No Price Found';

            console.log(`Button ${index}:`, {
                itemId,
                itemName,
                itemPrice
            });

            // Matching logic
            const matchesSearch = 
                itemId.toLowerCase().includes(searchTerm) || 
                itemName.toLowerCase().includes(searchTerm) || 
                itemPrice.toLowerCase().includes(searchTerm);

            console.log(`Match for Button ${index}:`, matchesSearch);

            // Toggle display
            button.style.display = matchesSearch ? 'block' : 'none';
        });
    });
});
</script>