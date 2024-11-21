    <main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Inventory</h2>
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ New Stock</button>
      </header>

      <div class="flex items-center mb-4 space-x-4">
        <input type="text" placeholder="Quick search" class="border rounded px-4 py-2">
        <input type="date" class="border rounded px-4 py-2">
          <select class="border rounded px-4 py-2">
          <option>Status</option>
          <option>Pending</option>
          <option>Completed</option>
        </select>
      </div>

      <div class="bg-white rounded shadow">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-600">
              <th class="py-3 px-4 border">No.</th>
              <th class="py-3 px-4 border">Item ID</th>
              <th class="py-3 px-4 border">Item Name</th>
              <th class="py-3 px-4 border">Quantity</th>
              <th class="py-3 px-4 border">Date Added</th>
              <th class="py-3 px-4 border">Purchase Price</th>
              <th class="py-3 px-4 border">Selling Price</th>
              <th class="py-3 px-4 border">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach( $data['item'] as $item ) : ?>
              <tr class="hover:bg-gray-100">
                <td class="py-3 px-4 border"><?= $no++; ?></td>
                <td class="py-3 px-4 border"><?= $item['ITEM_ID']; ?></td>
                <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
                <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
                <td class="py-3 px-4 border"><?= $item['DATE_ADDED']; ?></td>
                <td class="py-3 px-4 border"><?= $item['HARGA_BELI']; ?></td>
                <td class="py-3 px-4 border"><?= $item['HARGA_JUAL']; ?></td>
                <td class="py-3 px-4 border"><?= $item['STATUS']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
