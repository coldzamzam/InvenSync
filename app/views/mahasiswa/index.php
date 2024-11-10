<div class="container mt-5">

  <div class="row">
    <div class="col-lg-5">
      <?= Flasher::flash(); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-5">
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah Data
      </button>
      <h3>Daftar Mahasiswa</h3>
      <table class="table table-striped table-hover table-bordered">
        <?php foreach( $data['mhs'] as $mhs ) : ?>
          <tr>
            <td class="d-flex justify-content-between">
              <?= $mhs['FULL_NAME']; ?>
              <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= $mhs['NIM']; ?>" class="badge text-bg-info text-decoration-none">DETAIL</a>
          </td>
          </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">NIM</label>
            <input class="form-control form-control-sm" type="text" name="nim" placeholder="NIM" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Mahasiswa</label>
            <input class="form-control form-control-sm" type="text" name="nama" placeholder="Nama Mahasiswa" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Jurusan</label>
            <input class="form-control form-control-sm" type="text" name="jurusan" placeholder="Jurusan" aria-label="default input example">
          </div>

          <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Gender</label>
            <input class="form-control form-control-sm" type="text" name="gender" placeholder="Gender" aria-label="default input example">
          </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
        </form>
    </div>
  </div>
</div>