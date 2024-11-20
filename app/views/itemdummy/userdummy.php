<div class="container">
  <table>
  <div class="row">
    <div class="col-lg-5 mt-3">
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah Data
      </button>
      <h3>Daftar Mahasiswa</h3>
      <table class="table table-striped table-hover table-bordered">
        <?php foreach( $data['item'] as $item ) : ?>
          <tr>
            <td class="d-flex justify-content-between">
              <?= $mhs['ITEM_NAME']; ?>
          </td>
          </tr>
          <?php endforeach; ?>
      </table>
    </div>
  </table>
</div>