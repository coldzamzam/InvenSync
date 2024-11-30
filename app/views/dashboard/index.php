<div class="flex-1 ml-64 mt-20 p-8">
  <p class="ml-[300px]">Selamat datang di halaman utama <?=$_SESSION['user_id'];?> <b><?= $_SESSION['user_role']; ?></b>, <b><?= $_SESSION['user_name']; ?></b>.</p>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        ['Desember', 16000000, 7500000]
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
  </script>
  <div id="chart_div"></div>
</div>
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