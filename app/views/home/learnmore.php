<main class="flex-1 ml-24 mt-20 p-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafd;
            margin: 0;
            padding: 0;
        }

        .card {
            background: linear-gradient(135deg, #9AA6B2, #BCCCDC, #D9EAFD, #BCCCDC, #9AA6B2);
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .card h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 8px;
        }

        .card label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 4px;
            display: block;
        }

        .card p {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>

    <body>
        <div>
            <div class="flex gap-4 mb-4">
                <!-- Informasi -->
                <div class="card w-1/3">
                <h2 class="text-xl font-bold mb-4">InvenSync adalah</h2>
                <p class="text-gray-700 mb-6 text-justify">
                    Aplikasi berbasis web yakni sistem inventaris yang dapat digunakan untuk mengelola stok barang masuk maupun keluar. Disini Anda dapat menggunakan berbagai fitur-fitur yang sudah disediakan untuk mengatur toko Anda!
                </p>

                <h2 class="text-xl font-bold mb-4">Latar Belakang Pengguna</h2>
                <p class="text-gray-700 text-justify">
                    Latar belakang pengguna dari sistem ini adalah untuk para pemilik toko seperti toko distro, toko pakaian, dan lain sebagainya! Anda dapat mengisi profil toko Anda terkait toko yang dimiliki.
                </p>
            </div>

                <!-- Informasi Toko -->
                <div class="card w-2/3">
                <h2 class="text-xl font-bold mb-4">Fitur-Fitur yang Tersedia</h2>
                <ul class="space-y-6">
                    <li>
                        <h3 class="font-semibold">• Dasbor/Halaman Utama</h3>
                        <p class="text-gray-600 text-justify ml-4">Fitur ini adalah tempat dimana Anda dapat memantau profit, pemasukan, pengeluaran, serta Anda dapat melihat produk terlaris dan yang kurang laris. Disini juga terdapat diagram berisi total karyawan dari berbagai role dan juga diagram untuk pemasukan dan pengeluaran</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• Karyawan</h3>
                        <p class="text-gray-600 text-justify ml-4">Fitur ini adalah tempat dimana Anda dapat membuat akun karyawan Anda. Anda dapat melihat daftar karyawan yang Anda miliki serta bisa mengedit profil mereka seperti nama, role, alamat, dan lain sebagainya.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• List Barang</h3>
                        <p class="text-gray-600 text-justify ml-4">Fitur ini adalah tempat dimana Anda dapat melihat daftar barang anda. Disini Anda bisa menambahkan nama brand, kategori, dan barang. Anda bisa mengatur harga barang yang diinginkan dan bisa mengedit data barangnya kapan saja!</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• Inventaris</h3>
                        <p class="text-gray-600 text-justify ml-4">Fitur ini adalah tempat dimana Anda dapat melihat stok barang. Di fitur Inventaris ini anda dapat melihat stok barang yang tersedia, segera habis, dan habis. Anda juga bisa melihat total stok barang yang dimiliki serta bisa menambahkan dan mengedit barang tersebut.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• Riwayat Transaksi</h3>
                        <p class="text-gray-600 text-justify ml-4">Fitur ini adalah tempat dimana Anda dapat melihat dan mencetak receipt transaksi Anda. Jadi setiap penjualan akan ada receipt atau invoice masing-masing, disini anda dapat mencetak invoice tersebut!</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• Laporan</h3>
                        <p class="text-gray-600 ml-4">Fitur ini adalah tempat dimana Anda dapat memantau laporan-laporan Anda. Di fitur ini Anda dapat memilih untuk melihat laporan harian, mingguan, dan bulanan! serta dapat mencetaknya juga.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">• Kasir</h3>
                        <p class="text-gray-600 ml-4">Fitur ini adalah tempat dimana Anda dapat melakukan transaksi atau jual beli barang