<div class="container mt-5">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"><?= $data['mhs']['FULL_NAME']; ?></h5>
      <h6 class="card-subtitle mb-2 text-body-secondary"><?= $data['mhs']['NIM']; ?></h6>
      <p class="card-text"> <b>JURUSAN</b> <br> <?= $data['mhs']['JURUSAN']; ?></p>
      <p class="card-text"> <b>GENDER</b> <br> <?= $data['mhs']['GENDER']; ?></p>
      <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-primary">Kembali</a>
    </div>
  </div>
</div>