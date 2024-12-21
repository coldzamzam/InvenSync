<div class="flex-1 ml-24 mt-20 p-8">
    <!-- Input Quick Search -->
    <input type="text" id="quickSearchInput" placeholder="Cari"
        class="border rounded-lg px-4 py-2 shadow-md focus:outline-none focus:ring focus:border-blue-400">
    <br><br>

    <?php if (!empty($data['receiptDetails'])): ?>
        <?php foreach ($data['receiptDetails'] as $receipt_id => $receipt): ?>
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
                    <div class="flex space-x-2">
                        <!-- Cetak Invoice Button -->
                        <button onclick="event.stopPropagation(); printInvoice(this)"
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition no-print">
                            <i class="fa fa-print mr-2"></i>Cetak Invoice
                        </button>
                    </div>
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
// Function to toggle the receipt details table
function toggleTable(id) {
    document.getElementById(id).classList.toggle('hidden');
}

// Function to print the invoice
function printInvoice(button) {
    const parentDiv = button.closest('.cursor-pointer');
    const tableContent = parentDiv.outerHTML;

    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
        <html>
            <head>
                <title>Invoice InvenSync</title>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        margin: 20px;
                        color: #333;
                    }
                    h1 {
                        text-align: center;
                        font-size: 24px;
                        color: #333;
                        margin-bottom: 30px;
                    }
                    .invoice-wrapper {
                        width: 100%;
                        max-width: 800px;
                        margin: 0 auto;
                        padding: 20px;
                        background: #fff;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                    }
                    .header {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 30px;
                    }
                    .header-left {
                        font-size: 18px;
                        font-weight: bold;
                    }
                    .header-right {
                        text-align: right;
                        font-size: 18px;
                    }
                    .invoice-details {
                        margin-top: 20px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 10px;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }
                    th {
                        background-color: #f4f4f4;
                    }
                    .total-row {
                        font-weight: bold;
                        background-color: #f9f9f9;
                    }
                    .total-price {
                        text-align: right;
                    }
                    .footer {
                        margin-top: 30px;
                        text-align: center;
                        font-size: 14px;
                    }
                    /* Hide print and delete buttons during print */
                    @media print {
                        .no-print {
                            display: none !important;
                        }
                    }
                </style>
            </head>
            <body>
                <h1>InvenSync</h1>
                <div class="invoice-wrapper">
                    <div class="header">
                        <div class="header-left">
                            <p><strong></strong> ${parentDiv.querySelector('.text-gray-700').textContent}</p>
                        </div>
                        <div class="header-right">
                            <p><strong>Total:</strong> Rp. ${parentDiv.querySelector('.text-green-600').textContent.replace('Rp.', '')}</p>
                        </div>
                    </div>

                    <div class="invoice-details">
                        <table>
                            <tbody>
                                ${parentDiv.querySelector('table').innerHTML}
                            </tbody>
                        </table>
                    </div>

                    <div class="total-row">
                        <p class="total-price"><strong>Total: Rp. ${parentDiv.querySelector('.text-green-600').textContent.replace('Rp.', '')}</strong></p>
                    </div>
                    
                    <div class="footer">
                        <p>Terima kasih atas transaksi Anda!</p>
                    </div>
                </div>
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

// Function to handle deleting a receipt
function deleteReceipt(button) {
    const parentDiv = button.closest('.receipt-container');
    if (confirm("Apakah Anda yakin ingin menghapus transaksi ini?")) {
        parentDiv.remove(); // Remove the entire receipt container
    }
}

// Quick search functionality
document.getElementById('quickSearchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase().trim();
    const receiptContainers = document.querySelectorAll('.receipt-container');

    receiptContainers.forEach(container => {
        const receiptId = container.getAttribute('data-receipt-id').toLowerCase();
        const date = container.getAttribute('data-date').toLowerCase();

        if (receiptId.includes(searchValue) || date.includes(searchValue)) {
            container.style.display = '';
        } else {
            container.style.display = 'none';
        }
    });
});
</script>
