<div class="flex-1 ml-24 mt-20 p-8">
    <!-- Input Quick Search -->
    <input type="text" id="quickSearchInput" placeholder="Cari"
        class="border rounded-lg px-4 py-2 shadow-md focus:outline-none focus:ring focus:border-blue-400">
<br>
<br>
    <?php if (!empty($data['receiptDetails'])): ?>
        <?php foreach ($data['receiptDetails'] as $receipt_id => $receipt): ?>
            <!-- Tambahkan data-* attribute -->
            <div data-receipt-id="<?= $receipt_id; ?>" 
                 data-date="<?= $receipt['date_added']; ?>" 
                 onclick="toggleTable('table-<?= $receipt_id; ?>')"
                 class="receipt-container cursor-pointer bg-white shadow-lg rounded-lg p-6 mb-4 transition transform hover:scale-105">
                <div class="flex justify-between items-center">
                    <p class="text-gray-700 text-lg font-semibold">
                        Transaksi ID: <span class="text-blue-600 font-bold"><?= $receipt_id; ?></span> - 
                        Tanggal: <?= $receipt['date_added']; ?>
                    </p>
                    <h2 class="text-lg font-bold text-gray-800">
                        Total: <span class="text-green-600">Rp.<?= number_format($receipt['total'], 2); ?></span>
                    </h2>
                    <button onclick="event.stopPropagation(); printInvoice(this)"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                        <i class="fa fa-print mr-2"></i>Cetak Invoice
                    </button>
                </div>

                <!-- Tabel Detail -->
                <table id="table-<?= $receipt_id; ?>"
                    class="w-full text-left border-collapse hidden mt-6 rounded-lg overflow-hidden shadow-md">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-2 px-4">ID Barang</th>
                            <th class="py-2 px-4">Nama Barang</th>
                            <th class="py-2 px-4">Kuantitas</th>
                            <th class="py-2 px-4">Harga</th>
                            <th class="py-2 px-4">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receipt['items'] as $item): ?>
                            <tr class="odd:bg-gray-100 even:bg-white hover:bg-gray-200">
                                <td class="py-2 px-4"><?= $item['ITEM_ID']; ?></td>
                                <td class="py-2 px-4"><?= $item['ITEM_NAME']; ?></td>
                                <td class="py-2 px-4"><?= $item['QUANTITY']; ?></td>
                                <td class="py-2 px-4"><?= number_format($item['COST_PRICE'], 2); ?></td>
                                <td class="py-2 px-4"><?= number_format(($item['COST_PRICE'] * $item['QUANTITY']), 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="bg-yellow-200 font-bold">
                            <td colspan="4" class="text-right py-2 px-4">Total:</td>
                            <td class="py-2 px-4"><?= number_format($receipt['total'], 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-gray-600 mt-6">Tidak ada transaksi.</p>
    <?php endif; ?>
</div>

<script>
function toggleTable(id) {
    document.getElementById(id).classList.toggle('hidden');
}

function printInvoice(button) {
    const parentDiv = button.closest('.cursor-pointer');
    const tableContent = parentDiv.outerHTML;

    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
        <html>
            <head>
                <title>Invoice</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f4f4f4; }
                </style>
            </head>
            <body>
                <h1 style="text-align: center;">Invoice</h1>
                ${tableContent}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

document.getElementById('quickSearchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase().trim(); // Ambil input pencarian
    const receiptContainers = document.querySelectorAll('.receipt-container'); // Ambil semua transaksi

    receiptContainers.forEach(container => {
        const receiptId = container.getAttribute('data-receipt-id').toLowerCase();
        const date = container.getAttribute('data-date').toLowerCase();

        // Cek apakah input cocok dengan receipt ID atau tanggal
        if (receiptId.includes(searchValue) || date.includes(searchValue)) {
            container.style.display = ''; // Tampilkan jika cocok
        } else {
            container.style.display = 'none'; // Sembunyikan jika tidak cocok
        }
    });
});

function printInvoice(button) {
    const parentDiv = button.closest('.cursor-pointer'); // Ambil elemen induk dari tombol
    const tableContent = parentDiv.outerHTML;

    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
        <html>
            <head>
                <title>Invoice Transakasi</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f4f4f4; }
                    
                    /* Sembunyikan tombol print saat dicetak */
                    @media print {
                        button, .no-print {
                            display: none !important;
                        }
                          .header-title {
                            position: absolute;
                            top: 20px;
                            right: 20px;
                            font-size: 28px;
                            font-weight: bold;
                            color: #333;
                        }
                    }
                </style>
            </head>
            <body>
                <h1 style="text-align: center;">Invoice</h1>
                <div class="header-title">InvenSync</div>
                ${tableContent}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

</script>