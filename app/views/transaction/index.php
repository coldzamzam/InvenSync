<main class="flex-1 ml-24 mt-20 p-8">
    <div>
        <?php foreach($data['receiptDetails'] as $receipt ) : ?>
        <h1 class="text-2xl font-semibold text-gray-800">Transaksi <?= $receipt['RECEIPT_ID']; ?> pada Tanggal <?= $receipt['DATE_ADDED']; ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data['receiptDetails'] as $items ) : ?>
                <tr>
                    <td><?= $items['ITEM_ID']; ?></td>
                    <td><?= $items['ITEM_NAME']; ?></td>
                    <td><?= $items['BRAND_NAME']; ?></td>
                    <td><?= $items['CATEGORY_NAME']; ?></td>
                    <td><?= $items['QUANTITY']; ?></td>
                    <td><?= $items['COST_PRICE']; ?></td>
                    <td><?= $items['QUANTITY']*$items['COST_PRICE']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endforeach; ?>
    </div>
</main>