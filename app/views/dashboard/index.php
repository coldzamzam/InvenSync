<div class="flex-1 ml-24 mt-24 px-8">

  <div class="flex justify-between gap-2 mb-4">
    <!-- APUS AJA KEDUA BORDERNYA, CUMA BUAT NGECEK -->
    <div class="w-1/5 px-6 rounded-lg">
      <div class="">
        <h4 class="text-xl">Selamat Datang,</h4>
        <p><b><?= $_SESSION['user_role']; ?></b></p>
        <h2 class="text-2xl"><b><?= $_SESSION['user_name']; ?></b></h2>
      </div>
    </div>
    <div class="w-4/5">
      <div class="flex justify-between">
        <h4 class="text-xl pb-2 font-semibold">Ada apa di bulan ini?</h4>
        <h4 class="text-xl pb-2 font-semibold"><?= $data['today']['DATE']; ?></h4>
      </div>
      <div class="flex justify-between gap-2">
        <div class="border border-zinc-100 rounded-lg p-6 w-1/3<?php if ($data['revenue']['PROFIT'] < 0) { echo ' bg-red-500'; } else { echo ' bg-[#2B87FF]'; };?>">
          <div class="text-white">
            <p>Total Profit</p>
            <h2 class="text-2xl font-semibold"><b>Rp<?= number_format($data['revenue']['PROFIT'], 2, ',', '.'); ?></b>
            </h2>
          </div>
        </div>
        <div class="bg-[#041A3D] border border-zinc-100 rounded-lg p-6 w-1/3">
          <div class="text-white">
            <p>Total Barang Masuk</p>
            <h2 class="text-3xl font-semibold">
              <b><?= $data['availInventory']['TOTAL_INVENTORY']; ?></b><span class="text-sm">pcs</span>
            </h2>
          </div>
        </div>
        <div class="bg-[#00D0C2] border border-zinc-100 rounded-lg p-6 w-1/3">
          <div class="text-white">
            <p>Total Barang Terjual</p>
            <h2 class="text-3xl font-semibold"><b><?= $data['totalSoldItem']['TOTAL_SOLD']; ?></b><span class="text-sm">pcs</span></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-between gap-4 mb-4">
    <div class="bg-white shadow-md border border-zinc-100 w-3/5 p-6 rounded-lg">
      <div class="mb-6">
        <h2 class="text-2xl font-semibold">Pemasukan dan Pengeluaran</h2>
      </div>
      <div id="chart_div" class="<?= $data['penghasilanKosong'] ? 'hidden' : ''; ?>"></div>
      <div class="<?= $data['penghasilanKosong'] ? '' : 'hidden'; ?>">
        <p class="text-gray-500">Belum ada data pemasukan dan pengeluaran</p>
      </div>
    </div>
    <div class="flex flex-col w-2/5 gap-4 justify-between">
      <div class="bg-white shadow-md border border-zinc-100 p-6 rounded-lg">
        <div class="mb-6">
          <h2 class="text-2xl font-semibold">Admin Toko</h2>
        </div>
        <div id="piechart" class="<?= $data['adminKosong'] ? 'hidden' : ''; ?>"></div>
        <div class="<?= $data['adminKosong'] ? '' : 'hidden'; ?>">
          <p class="text-gray-500">Belum ada data admin</p>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-between gap-4">
    <div class="bg-white shadow-md border border-zinc-100 w-1/2 p-6 rounded-lg">
      <h2 class="text-md font-semibold mb-4">Produk Terlaris</h2>
      <div class="<?= $data['produkTerlarisKosong'] ? 'hidden' : ''; ?>">
        <h2 class="text-3xl font-semibold"><b><?= $data['produkTerlaris']['ITEM_NAME'] ?></b></h2>
        <h2 class="text-md font-semibold"><?= $data['produkTerlaris']['BRAND_NAME'] ?></h2>
        <h2 class="text-2xl font-semibold text-[#2B87FF]"><b><?= $data['produkTerlaris']['TOTAL_QUANTITY'] ?><span class="text-sm">pcs</span></b></h2>
      </div>
      <div class="<?= $data['produkTerlarisKosong'] ? '' : 'hidden'; ?>">
          <p class="text-gray-500">Belum ada data produk terlaris</p>
        </div>
    </div>
    <div class="bg-white shadow-md border border-zinc-100 w-1/2 p-6 rounded-lg">
      <h2 class="text-md font-semibold mb-4">Produk Kurang Laris</h2>
      <div class="<?= $data['produkKurangLarisKosong'] ? 'hidden' : ''; ?>">
        <h2 class="text-3xl font-semibold"><b><?= $data['produkKurangLaris']['ITEM_NAME'] ?></b></h2>
        <h2 class="text-md font-semibold"><?= $data['produkKurangLaris']['BRAND_NAME'] ?></h2>
        <h2 class="text-2xl font-semibold text-[#00D0C2]"><b><?= $data['produkKurangLaris']['TOTAL_QUANTITY'] ?><span class="text-sm">pcs</span></b></h2>
      </div>
      <div class="<?= $data['produkKurangLarisKosong'] ? '' : 'hidden'; ?>">
          <p class="text-gray-500">Belum ada data produk kurang laris</p>
        </div>
    </div>
    
  </div>
</div>

  <script type="text/javascript">

    const chartPenghasilan = <?= json_encode(array_map(function($item) {
      return [
        $item['BULAN'],
        (float)$item['TOTAL_PENDAPATAN'] ?? 0, // Pendapatan
        (float)$item['TOTAL_PENGELUARAN']     // Pengeluaran
      ];
    }, $data['chartPenghasilan'])); ?>;

    console.log(chartPenghasilan); // Debug: Cek outputnya di console

    // Load Google Charts sekali saja
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      drawMaterialChart();
      drawPieChart();
    }

    function drawMaterialChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Bulan');
      data.addColumn('number', 'Pemasukan');
      data.addColumn('number', 'Pengeluaran');

      // Tambahkan data dari chartPenghasilan
      data.addRows(chartPenghasilan);

      var options = {
        title: 'Pemasukan dan Pengeluaran per Bulan',
        colors: ['#2B87FF', '#FFD369'],
        hAxis: {
            title: 'Bulan',
        },
        vAxis: {
            title: 'Jumlah (Rp)',
            format: 'decimal'
        },
        bars: 'vertical',
        legend: { position: 'top' },
        height: 300
      };

      var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      materialChart.draw(data, google.charts.Bar.convertOptions(options));
    }

    function drawPieChart() {
      var data = google.visualization.arrayToDataTable(
        <?= json_encode($data['adminChartData']) ?>
      );

      var options = {
          is3D: false,
          slices: {
            0: { color: '#FFD369' },
            1: { color: '#041A3D' }
          },
          height: 300
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

  </script>
        

        <?php
if (isset($_SESSION['status'])):
    $status = $_SESSION['status']; // Get status from session
    unset($_SESSION['status']); // Remove status from session after using it
?>
    <script>
        // Handle SweetAlert based on session status
        let status = '<?= $status ?>';
        if (status === 'success') {
            Swal.fire({
                title: 'Terima Kasih!',
                text: 'Selamat Datang di Invensync!',
                icon: 'success'
            });
        } else if (status === 'ownerDeleted') {
            Swal.fire({
                title: 'Akun Anda Sudah dihapus dan Perlu Konfirmasi.',
                text: 'Apakah anda berubah pikiran dan ingin mengembalikan akun ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Kembalikan Akun',
                cancelButtonText: 'Tidak',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= BASEURL; ?>/user/cancelDeletion/<?= $_SESSION['verification_token'] ?>';
                } else {
                  document.getElementById('LogoutForm').submit();
                }
            });
        } else if (status === 'employeeDeleted') {
            Swal.fire({
                title: 'Toko ini sudah dihapus.',
                text: 'Apabila ini sebuah kesalahan, silahkan hubungi owner toko.',
                icon: 'warning',
            }).then(() => {
                document.getElementById('LogoutForm').submit();
            });
        } else if (status === 'cancelled') {
          Swal.fire({
                title: 'Penghapusan Dibatalkan!',
                text: 'Selamat Datang kembali di Invensync!',
                icon: 'success'
            });    
        } 
    </script>
<?php endif; ?>