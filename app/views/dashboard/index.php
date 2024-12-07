<div class="flex-1 ml-24 mt-20 p-8">
  <p class="ml-[300px]">Selamat datang di halaman utama <b><?=$_SESSION['user_id'];?></b> <b><?= $_SESSION['user_role']; ?></b>, <b><?= $_SESSION['user_name']; ?></b> dengan owner id <b><?= $_SESSION['owner_id']; ?></b> dan dengan store id <b><?= $_SESSION['store_id']; ?></b>.</p>
  <div class="flex justify-between gap-4 mb-4 min-h-[600px]">
    <div class="bg-white shadow-md border border-zinc-100 w-1/2 p-6 rounded-lg">
      <div class="mb-6">
        <h2 class="text-2xl font-semibold">Pemasukan</h2>
        <?php foreach ($data['chartPenghasilan'] as $pemasukan) : ?>
          <p>
            <?= $pemasukan['BULAN']; ?> - <?= $pemasukan['TOTAL_PENDAPATAN']; ?>
          </p>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="flex flex-col w-1/2 gap-4 justify-between">
      <div class="bg-white shadow-md border border-zinc-100 h-full p-6 rounded-lg">
        <div class="mb-6">
          <h2 class="text-2xl font-semibold">Admin Toko</h2>
        </div>
        <div id="piechart"></div>
      </div>
      <div class="bg-white shadow-md border border-zinc-100 h-full p-6 rounded-lg">
        <div class="mb-6">
          <h2 class="text-2xl font-semibold">Pengeluaran</h2>
          <?php foreach ($data['chartPenghasilan'] as $pengeluaran) : ?>
            <p>
            <?= $pengeluaran['BULAN']; ?> - <?= $pengeluaran['TOTAL_PENGELUARAN']; ?>
            </p>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white min-h-[600px] shadow-md border border-zinc-100 w-full p-6 rounded-lg">
    <div class="mb-6">
      <h2 class="text-2xl font-semibold">Pemasukan</h2>
    </div>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </div>
</div>

  <script type="text/javascript">
    
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawMaterial);

    function drawMaterial() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Bulan');
      data.addColumn('number', 'Pemasukan');
      data.addColumn('number', 'Pengeluaran');

      data.addRows([
        ['Januari', 5000000, 2000000],
        ['Februari', 6000000, 2500000],
        ['Maret', 7000000, 3000000],
        ['April', 8000000, 3500000],
        ['Mei', 9000000, 4000000],
        ['Juni', 10000000, 4500000],
        ['Juli', 11000000, 5000000],
        ['Agustus', 12000000, 5500000],
        ['September', 13000000, 6000000],
        ['Oktober', 14000000, 6500000],
        ['November', 15000000, 7000000],
        ['Desember', 16000000, 7500000],
      ]);

      var options = {
        title: 'Pemasukan dan Pengeluaran per Bulan',
        hAxis: {
          title: 'Bulan',
        },
        vAxis: {
          title: 'Jumlah (Rp)',
          format: 'decimal'
        },
        bars: 'vertical',
        legend: { position: 'top' },
        height: 500
      };

      var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      materialChart.draw(data, google.charts.Bar.convertOptions(options));
    }


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(
          <?= json_encode($data['adminChartData']) ?>
        );
        var options = {

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
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error',
                text: 'Failed to add employee!',
                icon: 'error'
            });
        }
    </script>
<?php endif; ?>