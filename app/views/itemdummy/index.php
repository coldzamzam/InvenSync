<div class="container">
  <table>
  <div class="row">
    <div class="col-lg-5 mt-3">
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah Data
      </button>
      <h3>Data User</h3>
      <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr class="table-info text-center lh-1">
          <th scope="col">NO</th>
          <th scope="col">USER ID</th>
          <th scope="col">EMAIL</th>
          <th scope="col">FULL NAME</th>
          <th scope="col">ROLE</th>
          <th scope="col">ADDRESS</th>
          <th scope="col">PHONE NUMBER</th>
        </tr>
      </thead>
        <tbody>
          <?php $no = 1; foreach( $data['item'] as $item ) : ?>
            <tr>
              <td  scope="row" class="text-center"><?= $no++; ?></td>
              <td class=""><?= $item['USER_ID']; ?></td>
              <td class=""><?= $item['EMAIL']; ?></td>
              <td class=""><?= $item['NAME']; ?></td>
              <td class=""><?= $item['ROLE']; ?></td>
              <td class=""><?= $item['ADDRESS']; ?></td>
              <td class=""><?= $item['PHONE_NUMBER']; ?></td>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </table>
</div>