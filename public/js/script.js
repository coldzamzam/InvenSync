$(function() {

  $('.btnProfileToko').on('click', function() {

    // $('#judulModal').html('Update Data Mahasiswa');
    // $('.modal-footer button[type=submit]').html('Update Data');

    // $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/edit');

    console.log('CEK');

    const id = $(this).data('toko');
    
    $.ajax({
      url: 'http://localhost/InvenSync/public/User/getToko',
      data: { id: id },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        console.log('OK');
      },
      error: function(xhr, status, error) {
        console.log('Status: ' + status);
        console.log('Error: ' + error);
        console.log(xhr.responseText);
      }
    })

  });

});