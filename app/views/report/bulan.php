<style>
  @media print {
    body * {
      visibility: hidden; /* Sembunyikan semua elemen */
    }

    #reportModal, #reportModal * {
      visibility: visible; /* Tampilkan hanya elemen modal */
    }

    #reportModal {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      margin: 0;
      padding: 20px;
      background: white;
      box-shadow: none;
      border: none;
    }

    #modalTitle {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
    }

    #reportHeader {
      text-align: center;
      margin-bottom: 20px;
    }

    #modalContent {
      padding: 20px;
      font-size: 16px;
      line-height: 1.6;
      border-top: 2px solid #ccc;
      border-bottom: 2px solid #ccc;
    }

    #modalFooter {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
      color: #555;
    }

    .data-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px dashed #ddd;
    }

    .data-row:last-child {
      border-bottom: none;
    }

    button {
      display: none; /* Sembunyikan tombol pada mode cetak */
    }
  }

  /* Style modal saat tidak mencetak */
  #reportModal {
    border-radius: 8px;
    overflow: hidden;
  }

  #modalContent .data-row span:first-child {
    font-weight: bold;
    color: #333;
  }

  #modalContent .data-row span:last-child {
    font-weight: bold;
    color: #007BFF; /* Biru */
  }
</style>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Container Utama -->
<main class="flex-1 ml-24 mt-20 p-8">
  <!-- Tab Navigasi -->
  <div class="flex justify-center mb-8 space-x-4">
    <a href="<?= BASEURL; ?>/report" id="dailyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Harian</a>
    <a href="<?= BASEURL; ?>/report/bulan" id="monthlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Bulanan</a>
    <a href="<?= BASEURL; ?>/report/tahun" id="yearlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Tahunan</a>
  </div>

  <!-- Laporan Bulanan -->
  <section id="monthlyReport" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
    <!-- Judul dan Pilihan Bulan dalam Satu Baris -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold">Laporan Bulanan</h2>
      <form id="reportForm" action="<?= BASEURL; ?>/report/getMonthlyReport" method="post">
        <input type="month" name="bulan" id="monthPicker" class="border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400">
        <button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        CEK
        </button>
      </form>

    </div>

    <!-- Kotak Total -->
    <div class="flex md:flex-row gap-4 justify-center w-full">
      <div class="bg-blue-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pemasukan</h3>
        <p class="text-xl font-bold text-blue-600">
          Rp<?= number_format($data['totalBulanan']['TOTAL_PENDAPATAN'], 2, ',', '.'); ?>
        </p>
      </div>
      <div class="bg-red-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pengeluaran</h3>
        <p class="text-xl font-bold text-red-600">
          Rp<?= number_format($data['totalBulanan']['TOTAL_PENGELUARAN'], 2, ',', '.'); ?>
        </p>
      </div>
      <!-- <div class="bg-green-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pemasukan Barang</h3>
        <p class="text-xl font-bold text-green-600">120 Pack</p>
      </div>
      <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pengeluaran Barang</h3>
        <p class="text-xl font-bold text-yellow-600">80 Pack</p>
      </div> -->
    </div>

    <!-- Grafik Line -->
    <canvas id="monthlyChart" class="w-full h-64"></canvas>

    <!-- Tombol View Report -->
    <div class="flex justify-end mt-6">
      <button onclick="viewFullReport()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        Lihat Laporan
      </button>
    </div>
  </section>

</main>

<!-- Modal Hasil Report -->
<div id="reportModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
  <div class="bg-white shadow-lg border border-zinc-200 w-full max-w-lg p-8 rounded-lg">
    <!-- Header -->
    <div id="reportHeader">
      <h1 id="modalTitle">Laporan Bulanan</h1>
      <p class="text-gray-600">Periode: <?= date('F Y', strtotime($data['periode'])); ?></p>
    </div>

    <!-- Konten Data -->
    <div id="modalContent">
      <div class="data-row">
        <span>Total Pemasukan:</span>
        <span>Rp<?= number_format($data['totalBulanan']['TOTAL_PENDAPATAN'], 2, ',', '.') ?></span>
      </div>
      <div class="data-row">
        <span>Total Pengeluaran:</span>
        <span>Rp<?= number_format($data['totalBulanan']['TOTAL_PENGELUARAN'], 2, ',', '.') ?></span>
      </div>
      <!-- <div class="data-row">
        <span>Total Pemasukan Barang:</span>
        <span>120 Pack</span>
      </div>
      <div class="data-row">
        <span>Total Pengeluaran Barang:</span>
        <span>80 Pack</span>
      </div> -->
    </div>

 <!-- Footer -->
 <div id="modalFooter">
      <p>Dicetak pada: <?= date('d-m-Y H:i'); ?></p>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-8 flex justify-end gap-3">
      <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        Cetak
      </button>
      <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>

  // Fungsi untuk Menampilkan Modal Report
  const modal = document.getElementById('reportModal');
  function viewFullReport() {
    // Menampilkan Modal
    modal.classList.remove('hidden');
  }

  // Fungsi untuk Menutup Modal
  function closeModal() {
    const modal = document.getElementById('reportModal');
    modal.classList.add('hidden');
  }

  // Menutup Modal ketika Klik di Luar Konten Modal
  window.onclick = function (event) {
    const modal = document.getElementById('reportModal');
    if (event.target == modal) {
      modal.classList.add('hidden');
    }
  }

  const monthlyChartData = <?php echo json_encode($data['monthlyChartData']); ?>;  // Pastikan ini mengandung data yang benar
  const labels = monthlyChartData.map(data => data.NAMA_HARI);  // Menyesuaikan nama label sesuai dengan struktur data
  const pemasukanData = monthlyChartData.map(data => data.TOTAL_PENDAPATAN);  // Ambil data pemasukan
  const pengeluaranData = monthlyChartData.map(data => data.TOTAL_PENGELUARAN);  // Ambil data pengeluaran

// Gambar Chart.js setelah halaman dimuat
window.onload = function() {
  const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
  new Chart(ctxMonthly, {
    type: 'line',  // Jenis grafik adalah line chart
    data: {
      labels: labels,  // Label untuk sumbu X (misalnya, minggu)
      datasets: [
        {
          label: 'Pemasukan',  // Label untuk dataset pertama
          data: pemasukanData,  // Data pemasukan
          borderColor: '#3b82f6',  // Warna border untuk garis
          tension: 0.4,  // Tension garis (lebih rendah untuk garis lebih lurus)
          fill: false  // Jangan isi area di bawah garis
        },
        {
          label: 'Pengeluaran',  // Label untuk dataset kedua
          data: pengeluaranData,  // Data pengeluaran
          borderColor: '#ef4444',  // Warna border untuk garis pengeluaran
          tension: 0.4,  // Tension garis
          fill: false  // Jangan isi area di bawah garis
        }
      ]
    },
    options: {
      responsive: true,  // Grafik responsif
      plugins: {
        legend: {
          position: 'bottom'  // Letakkan legenda di bawah grafik
        }
      },
      scales: {
        y: {
          beginAtZero: true  // Mulai skala Y dari 0
        }
      }
    }
  });
};

</script>