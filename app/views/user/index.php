<div class="container border col-5 mt-3 p-3">
  <div class="row">
    <div class="col-3 border p-2 m-0">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <div class="col-9">
      <h3 class="text-center">Daftar Toko</h3>
      <form action="<?= BASEURL; ?>/user/regist" method="post">
        <div >
          <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
          <input class="form-control form-control-sm" type="text" name="namatoko" placeholder="Nama" aria-label="default input example">
        </div>

        <div >
          <label for="exampleFormControlInput1" class="form-label">Tipe Toko</label>
          <input class="form-control form-control-sm" type="text" name="tipetoko" placeholder="Username" aria-label="default input example">
        </div>
    
        <div >
          <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
          <input class="form-control form-control-sm" type="text" name="lokasi" placeholder="Lokasi" aria-label="default input example">
        </div>
    
        <div >
          <label for="exampleFormControlInput1" class="form-label">No Telepon Toko</label>
          <input class="form-control form-control-sm" type="text" name="telepontoko" placeholder="No Telepon Toko" aria-label="default input example">
        </div>
        
        <div >
          <label for="exampleFormControlInput1" class="form-label">Email Toko</label>
          <input class="form-control form-control-sm" type="email" name="emailtoko" placeholder="Email Toko" aria-label="default input example">
        </div>

        <div >
          <label for="exampleFormControlInput1" class="form-label">Tahun Didirikan</label>
          <input class="form-control form-control-sm" type="month" name="yearfounded" placeholder="Tahun Didirikan" aria-label="default input example">
        </div>

        <button type="submit" name="daftar" class="btn btn-primary mt-2">Daftar</button>
      </form>
    </div>
  </div>
</div>