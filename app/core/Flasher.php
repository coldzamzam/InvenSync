<?php

class Flasher {

  public static function setFlash($subjek, $pesan, $aksi, $tipe) {
    $_SESSION['flash'] = [
      'subjek' => $subjek,
      'pesan' => $pesan,
      'aksi' => $aksi,
      'tipe' => $tipe
    ];
  }

  public static function flash(){
    if ( isset($_SESSION['flash']) ) {
      echo '<script>
          Swal.fire("SweetAlert2 is working!");
        </script>';
      
      session_unset($_SESSION['flash']);
      session_destroy($_SESSION['flash']);
    }
  }
}

?>