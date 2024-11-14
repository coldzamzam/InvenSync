<div class="container border col-5 mt-3 p-3">
  <div class="row">
    <div class="col-lg-5">
      <?= Flasher::flash(); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-3 border p-2 m-0">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <div class="col-9">
      <h3 class="text-center">Buat Akun</h3>
      <form action="<?= BASEURL; ?>/user/daftarAkun" method="post">
        <div >
          <label for="exampleFormControlInput1" class="form-label">Nama</label>
          <input class="form-control form-control-sm" type="text" name="nama" placeholder="Nama" aria-label="default input example">
        </div>

        <div >
          <label for="exampleFormControlInput1" class="form-label">Username</label>
          <input class="form-control form-control-sm" type="text" name="username" placeholder="Username" aria-label="default input example">
        </div>
    
        <div >
          <label for="exampleFormControlInput1" class="form-label">Password</label>
          <input class="form-control form-control-sm" type="password" name="password" placeholder="Password" aria-label="default input example">
        </div>
    
        <div >
          <label for="exampleFormControlInput1" class="form-label">No Telepon</label>
          <input class="form-control form-control-sm" type="number" name="telepon" placeholder="No Telepon" aria-label="default input example">
        </div>
        
        <div >
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input class="form-control form-control-sm" type="email" name="email" placeholder="Email" aria-label="default input example">
        </div>

        <div >
          <label for="exampleFormControlInput1" class="form-label">Alamat</label>
          <input class="form-control form-control-sm" type="text" name="alamat" placeholder="Alamat" aria-label="default input example">
        </div>

        <button type="submit" name="lanjut" class="btn btn-primary mt-2">Lanjut</button>
      </form>
    </div>
  </div>
</div>