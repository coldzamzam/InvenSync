<div class="flex-1 ml-24 mt-20 p-8">
<input type="text" id="quickSearchInput" placeholder="Quick search" class="border rounded px-4 py-2">
    <?php if (!empty($data['receiptDetails'])): ?>
        <?php foreach ($data['receiptDetails'] as $receipt_id => $receipt): ?>
            <div onclick="toggleTable('table-<?= $receipt_id; ?>')" class="cursor-pointer bg-gray-100 shadow-lg rounded-lg p-6 mb-2">
                <div class="flex justify-between items-center">
                <p class="text-gray-600 text-xl font-bold">
                    Transaksi dengan ID : <span class="text-blue-600"><?= $receipt_id; ?></span> - Pada Tanggal : <?= $receipt['date_added']; ?>
                </p>
                    <h2 class="text-xl font-semibold text-gray-800 flex">Total:<p class="text-green-600">Rp.<?= number_format($receipt['total'], 2); ?></p></h2>
                    <button id="printInvoiceBtn" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200" id="submitButton">Print Invoice <i class="fa fa-print"></i></button>
                </div>
                <table id="table-<?= $receipt_id; ?>" class="w-full text-left border-collapse hidden mt-6">
                    <thead>
                        <tr class="bg-[#393E46] text-white">
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price per Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receipt['items'] as $item): ?>
                            <tr class="hover:bg-gray-100">
                                <td><?= $item['ITEM_ID']; ?></td>
                                <td><?= $item['ITEM_NAME']; ?></td>
                                <td><?= $item['QUANTITY']; ?></td>
                                <td><?= number_format($item['COST_PRICE'], 2); ?></td>
                                <td><?= number_format(($item['COST_PRICE'] * $item['QUANTITY']), 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="bg-[#FFD369]">
                            <td colspan="4" class="text-right font-bold">Total:</td>
                            <td class="font-bold"><?= number_format($receipt['total'], 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-gray-600">No transactions found.</p>
    <?php endif; ?>
</div>

<script>
function toggleTable(id) {
    const table = document.getElementById(id);
    table.classList.toggle('hidden');
}

document.getElementById('printInvoiceBtn').addEventListener('click', function () {
    const printContent = document.querySelector('.bg-gray-100').outerHTML;
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
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('quickSearchInput'); // Input pencarian
    const transactionDivs = document.querySelectorAll('.bg-gray-100'); // Elemen transaksi

    searchInput.addEventListener('input', function () {
        const filter = searchInput.value.toLowerCase(); // Ambil teks input pencarian
        let found = false;

        transactionDivs.forEach(div => {
            const transactionId = div.querySelector('span.text-blue-600').textContent.toLowerCase(); // Ambil ID Transaksi
            const transactionDate = div.querySelector('p.text-gray-600').textContent.toLowerCase(); // Ambil tanggal transaksi
            const matches = transactionId.includes(filter) || transactionDate.includes(filter); // Cek apakah cocok dengan ID atau tanggal
            
            if (matches) {
                div.style.display = ''; // Tampilkan div jika cocok
                found = true;
            } else {
                div.style.display = 'none'; // Sembunyikan div jika tidak cocok
            }
        });

        if (!found) {
            // Tampilkan pesan jika tidak ada hasil pencarian
            document.querySelector('.text-center.text-gray-600').style.display = '';
        } else {
            document.querySelector('.text-center.text-gray-600').style.display = 'none';
        }
    });
});

</script>