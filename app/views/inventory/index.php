<main class="flex-1 ml-64 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Inventory</h2>
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
        <?php foreach( $data['item'] as $item ) : ?>
          <tr class="group hover:bg-gray-100 relative">
            <td class="py-3 px-4 border"><?= $item['ITEM_ID']; ?></td>
            <td class="py-3 px-4 border"><?= $item['ITEM_NAME']; ?></td>
            <td class="py-3 px-4 border"><?= $item['QUANTITY']; ?></td>
            <td class="py-3 px-4 border"><?= $item['DATE_ADDED']; ?></td>
            <td class="py-3 px-4 border"><?= $item['HARGA_BELI']; ?></td>
            <td class="py-3 px-4 border"><?= $item['HARGA_JUAL']; ?></td>
            <td class="py-3 px-4 border"><?= $item['STATUS']; ?></td>

            <!-- Logo that will appear on hover -->
            <td class="absolute top-0 right-0 hidden group-hover:block">
            <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#formModal"><img src="<?= BASEURL; ?>/img/setting-logo.png" width="25px" height="25px" alt="Setting Logo"></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="pagination mt-4">
    <ul class="flex justify-center space-x-2">
      <?php if ($data['currentPage'] > 1): ?>
        <li>
          <a href="<?= BASEURL; ?>/inventory/index/<?= $data['currentPage'] - 1; ?>" class="px-3 py-1 border rounded">Previous</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
        <li>
          <a href="<?= BASEURL; ?>/inventory/index/<?= $i; ?>" class="px-3 py-1 border <?= $data['currentPage'] == $i ? 'bg-blue-500 text-white' : ''; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($data['currentPage'] < $data['totalPages']): ?>
        <li>
          <a href="<?= BASEURL; ?>/inventory/index/<?= $data['currentPage'] + 1; ?>" class="px-3 py-1 border rounded">Next</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</main>

<!-- Modal for Adding New Stock -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Data Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/Inventory/tambah" method="post">
          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
            <input class="form-control form-control-sm" type="text" name="NAMABARANG" placeholder="Nama Barang" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Kuantitas</label>
            <input class="form-control form-control-sm" type="text" name="KUANTITAS" placeholder="Kuantitas" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Harga Beli</label>
            <input class="form-control form-control-sm" type="text" name="HARGA_BELI" placeholder="Harga Beli" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Harga Jual</label>
            <input class="form-control form-control-sm" type="text" name="HARGA_JUAL" placeholder="Harga Jual" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="STATUS" class="form-select" aria-label="Default select example">
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
