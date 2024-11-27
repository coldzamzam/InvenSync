<main class="flex-1 ml-64 p-8">
  <header class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-blue-500">Profile Toko</h2>
    <!-- <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#formModal">+ New Stock</button> -->
  </header>

  <div class="modal-body">
        <form action="<?= BASEURL; ?>/User/createToko" method="post">
          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
            <input class="form-control form-control-sm" type="text" name="namatoko" placeholder="Nama Toko" aria-label="default input example">
            <span class="text-red-500"><?= $data['namatokoError']; ?></span>
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Tipe Toko</label>
            <select name="tipetoko" class="form-select form-select-sm" aria-label="Default select example>
              <option selected disabled>Pilih Jenis Toko</option>
              <option value="Toko Distro">Toko Distro</option>
              <option value="Toko Sepatu">Toko Sepatu</option>
              <option value="Toko Baju">Toko Baju</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            <span class="text-red-500"><?= $data['tipetokoError']; ?></span>
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
            <input class="form-control form-control-sm" type="text" name="lokasi" placeholder="Lokasi" aria-label="default input example">
            <span class="text-red-500"><?= $data['lokasiError']; ?></span>
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nomor Telepon Toko</label>
            <input class="form-control form-control-sm" type="number" name="telepontoko" placeholder="Nomor Telepon Toko" aria-label="default input example">
            <span class="text-red-500"><?= $data['telepontokoError']; ?></span>
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Email Toko</label>
            <input class="form-control form-control-sm" type="email" name="emailtoko" placeholder="Email Toko" aria-label="default input example">
            <span class="text-red-500"><?= $data['emailtokoError']; ?></span>
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Tahun Didirikan</label>
            <input class="form-control form-control-sm" type="number" name="yearfounded" placeholder="Tahun Didirikan" aria-label="default input example">
            <span class="text-red-500"><?= $data['yearfoundedError']; ?></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-primary">Update Informasi</button>
      </div>
      </form>

</main>