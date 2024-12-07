<?php

class Flasher {

    // Menyimpan pesan flash ke session
    public static function setFlash($subjek, $pesan, $aksi, $tipe) {
        $_SESSION['flash'] = [
            'subjek' => $subjek,
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    // Menampilkan pesan flash menggunakan SweetAlert2
    public static function flash() {
        // Cek apakah ada pesan flash di session
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];

            // Menampilkan SweetAlert2
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: '{$flash['subjek']}',
                    text: '{$flash['pesan']}',
                    icon: '{$flash['tipe']}',
                    confirmButtonText: '{$flash['aksi']}'
                });
            </script>
            ";

            // Hapus pesan setelah ditampilkan
            unset($_SESSION['flash']);
        }
    }
}
