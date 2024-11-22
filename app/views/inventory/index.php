<main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Inventory</h2>
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#formModal">+ New Stock</button>
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

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Data Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
            <input class="form-control form-control-sm" type="text" name="item_name" placeholder="Nama Barang" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Kuantitas</label>
            <input class="form-control form-control-sm" type="text" name="quantity" placeholder="Kuantitas" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Harga Beli</label>
            <input class="form-control form-control-sm" type="text" name="harga_beli" placeholder="Harga Beli" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Harga Jual</label>
            <input class="form-control form-control-sm" type="text" name="harga_jual" placeholder="Harga Jual" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>Select Status</option>
              <option value="Ready">Ready</option>
              <option value="Pending">Pending</option>
              <option value="Empty">Empty</option>
            </select>
          </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </div>
        </form>
    </div>
  </div>
</div>

</body>
</html>
