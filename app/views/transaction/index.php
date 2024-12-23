<div class="flex-1 ml-24 mt-20 p-8">
    <!-- Input Quick Search -->
    <div class="mb-4 flex justify-between">
    <input type="text" id="quickSearchInput" placeholder="Cari"
        class="border rounded-lg px-4 py-2 shadow-md focus:outline-none focus:ring focus:border-blue-400">
    <br><br>
    <?php if ($data['totalPages'] > 1): ?>
    <div class="pagination mt-4">
        <ul class="flex justify-center space-x-2">
            <!-- Tombol Sebelumnya -->
            <?php if ($data['currentPage'] > 1): ?>
                <li>
                    <a href="<?= BASEURL; ?>/transaction/index/<?= $data['currentPage'] - 1; ?>" 
                       class="px-3 py-1 border rounded hover:bg-gray-200">Sebelumnya</a>
                </li>
            <?php endif; ?>

            <!-- Nomor Halaman -->
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                <li>
                    <a href="<?= BASEURL; ?>/transaction/index/<?= $i; ?>" 
                       class="px-3 py-1 border <?= $data['currentPage'] == $i ? 'bg-blue-500 text-white' : ''; ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Tombol Selanjutnya -->
            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <li>
                    <a href="<?= BASEURL; ?>/transaction/index/<?= $data['currentPage'] + 1; ?>" 
                       class="px-3 py-1 border rounded hover:bg-gray-200">Selanjutnya</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>
</div>

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

// Format number function
function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

// Function to toggle the receipt details table
function toggleTable(id) {
    document.getElementById(id).classList.toggle('hidden');
}

// Function to print the invoice
function printInvoice(event, button) {
    event.preventDefault();
    event.stopPropagation();
    
    const parentDiv = button.closest('.receipt-container');
    if (!parentDiv) {
        console.error("Receipt container not found.");
        return;
    }

    const receiptId = parentDiv.dataset.receiptId;
    const date = parentDiv.dataset.date;

    const items = Array.from(parentDiv.querySelectorAll('tbody tr:not(:last-child)')).map(row => ({
        ITEM_NAME: row.cells[1].textContent,
        QUANTITY: parseInt(row.cells[2].textContent),
        COST_PRICE: parseFloat(row.cells[3].textContent.replace(/[^0-9.-]+/g,"")),
    })).filter(item => !isNaN(item.COST_PRICE));

    const total = items.reduce((sum, item) => sum + (item.COST_PRICE * item.QUANTITY), 0);

    const printWindow = window.open('', '', 'width=800,height=600');
    if (!printWindow) {
        alert('Please allow popups for printing.');
        return;
    }

    printWindow.document.open();  // Ensures the document is open before writing
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
                    <p>Email: invensync@gmail.com</p>
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
    printWindow.document.close();  // Close the document after writing

printWindow.onload = function() {
    printWindow.print();
    printWindow.close();  // Close the print window after printing
};
}
// Attach event listeners after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Update the button click handler in HTML
    const printButtons = document.querySelectorAll('[onclick*="printInvoice"]');
    printButtons.forEach(button => {
        button.setAttribute('onclick', 'event.stopPropagation(); printInvoice(event, this)');
    });
    
    // Quick search functionality
    const quickSearchInput = document.getElementById('quickSearchInput');
    if (quickSearchInput) {
        quickSearchInput.addEventListener('input', function() {
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
    }
});

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