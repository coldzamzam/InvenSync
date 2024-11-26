<main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-center">Transaksi</h2>
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Tambah Barang</button>
      </header>
      <div class="bg-white rounded shadow">
      <table class="w-full text-left border-collapse">
      <thead>
      <tr class="bg-gray-200 text-gray-600">
              <th class="py-3 px-4 border">Nama Barang</th>
              <th class="py-3 px-4 border">Jumlah Barang</th>
              <th class="py-3 px-4 border">Harga</th>
              <th class="py-3 px-4 border">Total</th>
            </tr>
      </thead>
      </table>
      </div>
    </main>

<!--tes-->
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
            <label for="exampleFormControlInput1" class="form-label">Kode Barang</label>
            <input class="form-control form-control-sm" type="text" name="KODEBARANG" placeholder="Kode Barang" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
            <input class="form-control form-control-sm" type="text" name="NAMABARANG" placeholder="Nama Barang" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Harga Beli</label>
            <input class="form-control form-control-sm" type="text" name="HARGABELI" placeholder="Kuantitas" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">JUMLAH YANG DIBELI</label>
            <input class="form-control form-control-sm" type="text" name="JUMLAHYANGDIBELI" placeholder="Harga Beli" aria-label="default input example">
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

</div>
</body>
</html>
