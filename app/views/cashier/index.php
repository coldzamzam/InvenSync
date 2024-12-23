<main class="flex-1 ml-24 p-8 mt-14 flex">
  <div class="w-full">
    <h1 class="text-2xl font-bold mb-4">Barang Yang Tersedia</h1>
    <input type="text" id="quickSearchInput" placeholder="Cari" class="border rounded px-6 py-2">
    <div class="flex w-3/5">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
  <?php foreach($data['item'] as $item): ?>
    <button id="tambahBarangBtn_<?= $item['ITEM_ID']; ?>" 
            data-itemid="<?= $item['ITEM_ID']; ?>" 
            data-itemname="<?= $item['ITEM_NAME']; ?>"
            class="group bg-white rounded-lg shadow-lg w-full">
      <div class="flex flex-col items-center px-20 py-5">
        <img src="<?= BASEURL; ?>/img/noimage1.png" alt="gambar tidak tersedia" class="group-hover:hidden w-full h-full object-cover">
        <img src="<?= BASEURL; ?>/img/add-to-cart.png" class="w-full h-full  hidden group-hover:block" alt="">
      </div>
      <div class="bg-[#FFD369] rounded-lg flex flex-col">
        <span class="mb-2 font-semibold text-lg">
          <?= $item['ITEM_ID']; ?> - <?= $item['ITEM_NAME']; ?>
        </span>
        <span class="text-gray-600">Rp.<?= number_format($item['COST_PRICE'], 2);?> - Stock Tersedia : <?= $item['STOCK_AVAILABLE'];?></span>
      </div>
    </button>
  <?php endforeach; ?>
</div>
    </div>
  </div>
  <aside class="bg-white p-5 shadow-lg rounded-lg fixed right-0 top-20 w-1/4 h-full">
      <h1 class="text-2xl font-bold mb-3">Barang yang Dipilih</h1>
      <div class="space-y-4 listedItems">
      <?php $grandTotal = 0;foreach($data['receiptItems'] as $item):
      $itemTotal = $item['TOTAL_PER_ITEM'] * $item['QUANTITY'];
        $grandTotal += $itemTotal; ?>
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
      <div class="mt-6 border-t pt-4">
        <div class="flex justify-between font-semibold text-lg mb-4">
          <span>Total:</span>
          <span><?= number_format($grandTotal, 2);?></span>
        </div>
        <div class="mt-4">
        <?php if (isset($_SESSION['receipt_id'])):?>
          <button id="konfirmasiBtn" class="bg-green-500 text-white w-full py-2 px-4 rounded hover:bg-green-600 bottom-0">Konfirmasi Pembelian</button>
        <?php endif;?>
          <div id="konfirBtnAbu" class="bg-gray-100 text-gray-600 w-full py-2 px-4 rounded bottom-0 text-center">Konfirmasi Pembelian</div>
        </div>
    </aside>

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
    const itemsContainer = document.querySelector('.listedItems');
    const konfirBtnAbu = document.getElementById('konfirBtnAbu');

    // Fungsi untuk memeriksa apakah ada item yang dipilih
    function checkItemsSelected() {
        const items = itemsContainer.querySelectorAll('.group');
        if (items.length > 0) {
            // Menampilkan tombol konfirmasi jika ada item
            konfirmasiBtn.classList.remove('hidden');
            konfirBtnAbu.classList.add('hidden');
        } else {
            // Menyembunyikan tombol konfirmasi jika tidak ada item
            konfirmasiBtn.classList.add('hidden');
            konfirBtnAbu.classList.remove('hidden');
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
    // Get all items from the current receipt
    const itemElements = document.querySelectorAll('.flex.items-center.p-2.mb-2.gap-3');
    const items = Array.from(itemElements).map(itemEl => {
        const itemName = itemEl.querySelector('h2').textContent.split('-')[1].trim();
        const quantity = parseInt(itemEl.querySelector('h2:nth-child(2)').textContent.split(':')[1].trim());
        const totalPrice = parseInt(itemEl.querySelector('h3').textContent.split('Rp.')[1].trim());
        const pricePerItem = totalPrice / quantity;
        
        return {
            ITEM_NAME: itemName,
            QUANTITY: quantity,
            COST_PRICE: pricePerItem,
            TOTAL: totalPrice
        };
    });

    // Calculate total
    const total = items.reduce((sum, item) => sum + (item.COST_PRICE * item.QUANTITY), 0);

    // Format number helper function
    const formatNumber = (num) => {
        return new Intl.NumberFormat('id-ID').format(num);
    };

    // Create the print window
    const printWindow = window.open('', '', 'width=800,height=600');
    const date = new Date().toLocaleDateString('id-ID');

    printWindow.document.write(`
    <html>
    <head>
    <title>Invoice InvenSync</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 40px;
            color: #1f2937;
            background: #f9fafb;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
                .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #222831; /* Warna #222831 untuk garis bawah */
            padding-bottom: 16px;
        }

        .company-details {
            font-size: 14px;
            color: #4b5563;
            display: flex;
            align-items: center;
        }

        .company-details img {
            max-width: 120px;
            margin-right: 20px;
        }

        .company-details h2 {
            font-size: 24px;
            color: #1f2937;
            font-weight: 700;
            margin: 0;
        }

            .invoice-details {
            text-align: right;
            font-size: 14px;
            color: #4b5563;
        }

        .invoice-details .invoice-title {
            font-size: 36px;
            font-weight: 700;
            color: #fbbf24; /* Aksen Kuning */
            margin: 0;
        }

        .invoice-details .invoice-date {
            font-size: 14px;
            margin-top: 8px;
        }
                table {
            width: 100%;
            border-collapse: collapse;
            margin: 32px 0;
        }

        thead {
            background: #f9fafb;
            border-radius: 8px;
        }

        th {
            text-align: left;
            padding: 12px;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 14px;
            background-color: #FFD369; /* Aksen Kuning */
            color: #222831; /* Teks Hitam pada Header */
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
        }

        .amount-column {
            text-align: right;
        }

        .total-section {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid #222831; /* Warna #222831 untuk garis atas total */
            text-align: right;
        }

        .total-label {
            font-size: 14px;
            color: #6b7280;
        }

        .total-amount {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .footer {
            margin-top: 48px;
            padding-top: 24px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .footer p {
            margin: 8px 0;
        }

        .footer .company-name {
            font-weight: bold;
            color: #1f2937;
        }

        .footer .highlight {
            color: #fbbf24; /* Aksen Kuning pada footer */
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
            }
        }
            </style>
        </head>
        <body>
          <div class="invoice-container">
                  <div class="header">
                      <div class="company-details">
                          <img src="<?= BASEURL; ?>/img/invensync-black.png" alt="InvenSync Logo">
                          <div>
                              <h2>InvenSync</h2>
                              <p>Jl. Kukusan No. 123, Depok, Indonesia</p>
                              <p>Email: support@invensync.com</p>
                              <p>Phone: +62 21 1234 5678</p>
                          </div>
                      </div>
                    <div class="invoice-details">
                <div class="invoice-title">Invoice</div>
                <div class="invoice-date">Date: ${date}</div>
            </div>
        </div>
                <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th class="amount-column">Total</th>
                </tr>
            </thead>
                    <tbody>
                ${items.map(item => `
                    <tr>
                        <td>${item.ITEM_NAME}</td>
                        <td>${item.QUANTITY}</td>
                        <td>Rp ${formatNumber(item.COST_PRICE)}</td>
                        <td class="amount-column">Rp ${formatNumber(item.COST_PRICE * item.QUANTITY)}</td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
                <div class="total-section">
            <div class="total-label">Total Amount</div>
            <div class="total-amount">Rp ${formatNumber(total)}</div>
        </div>
        <div class="footer">
            <p>Thank you for your business!</p>
            <p class="company-name">InvenSync</p>
            <p class="highlight">We appreciate your trust in us!</p>
        </div>
    </div>
</body>
</html>
    `);

    // Trigger print dialog
    printWindow.document.close();  // Close the document after writing
    printWindow.print();
    printWindow.close();  // Close the print window after printing
});
  const logo = new Image();
  logo.src = '<?= BASEURL; ?>/img/invensync-black.png';
  logo.onload = () => {
      // Setelah gambar dimuat, lakukan print
      printWindow.document.close();
      printWindow.print();
      printWindow.close();
  };
  printWindow.document.write(`
      <img src="${logo.src}" alt="InvenSync Logo">
  `);

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
        
        document.getElementById('namabarang').value = namaBarang;
    });

  document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("quickSearchInput");
  const itemCards = document.querySelectorAll(".grid .group");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value.toLowerCase().trim();
    
    itemCards.forEach(card => {
      const itemId = card.querySelector("span").textContent.toLowerCase();
      const itemName = card.querySelector("span").textContent.toLowerCase();

      // Show card if query matches either ITEM_ID or ITEM_NAME
      if (itemId.includes(query) || itemName.includes(query)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});

</script>