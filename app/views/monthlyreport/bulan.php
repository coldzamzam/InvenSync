<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .tab-active {
    @apply bg-blue-600 text-white shadow-lg;
  }

  .tab-inactive {
    @apply bg-gray-200 text-gray-600 hover:bg-gray-300;
  }
</style>

<!-- Container Utama -->
<main class="flex-1 ml-24 mt-20 p-8">
  <!-- Tab Navigasi -->
  <div class="flex justify-center mb-8 space-x-4">
    <a href="<?= BASEURL; ?>/monthlyreport" id="dailyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Harian</a>
    <a href="<?= BASEURL; ?>/monthlyreport/bulan" id="monthlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Bulanan</a>
    <a href="<?= BASEURL; ?>/monthlyreport/tahun" id="yearlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Tahunan</a>
  </div>

  <!-- Laporan Bulanan -->
  <section id="monthlyReport" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
    <!-- Judul dan Pilihan Bulan dalam Satu Baris -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold">Laporan Bulanan</h2>
      <input type="month" id="monthPicker" class="border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Kotak Total -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-center">
      <div class="bg-blue-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pemasukan</h3>
        <p class="text-xl font-bold text-blue-600">Rp. 30.000.000</p>
      </div>
      <div class="bg-red-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pengeluaran</h3>
        <p class="text-xl font-bold text-red-600">Rp. 15.000.000</p>
      </div>
      <div class="bg-green-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pemasukan Barang</h3>
        <p class="text-xl font-bold text-green-600">120 Pack</p>
      </div>
      <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pengeluaran Barang</h3>
        <p class="text-xl font-bold text-yellow-600">80 Pack</p>
      </div>
    </div>

    <!-- Grafik Line -->
    <canvas id="monthlyChart" class="w-full h-64"></canvas>

    <!-- Tombol View Report -->
    <div class="flex justify-end mt-6">
      <button onclick="viewFullReport()"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Lihat Laporan</button>
    </div>
  </section>

</main>

<!-- Modal Hasil Report -->
<div id="reportModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
  <div class="bg-white shadow-lg border border-zinc-200 w-full max-w-lg p-8 rounded-lg">
    <!-- Header -->
    <div class="mb-6 text-center">
      <h1 id="modalTitle" class="text-3xl font-bold text-gray-800">TOTAL</h1>
    </div>

    <!-- Konten Data -->
    <div id="modalContent" class="space-y-4 text-gray-700 text-lg">
      <div class="flex justify-between items-center">
        <span class="font-semibold">Total Pemasukan:</span>
        <span>Rp. 30.000.000</span>
      </div>
      <div class="flex justify-between items-center">
        <span class="font-semibold">Total Pengeluaran:</span>
        <span>Rp. 15.000.000</span>
      </div>
      <div class="flex justify-between items-center">
        <span class="font-semibold">Total Pemasukan Barang:</span>
        <span>120 Pack</span>
      </div>
      <div class="flex justify-between items-center">
        <span class="font-semibold">Total Pengeluaran Barang:</span>
        <span>80 Pack</span>
          </div>
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

  // Grafik Line Bulanan
  const monthlyChartData = <?php echo json_encode($data['monthlyChartData']); ?>;
  console.log(monthlyChartData);
  const labels = monthlyChartData.map(data => data.MINGGU);
  const pemasukanData = monthlyChartData.map(data => data.TOTAL_PEMASUKAN);
  const pengeluaranData = monthlyChartData.map(data => data.TOTAL_PENGELUARAN);


  const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
  new Chart(ctxMonthly, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Pemasukan',
          data: pemasukanData,
          borderColor: '#3b82f6',
          tension: 0.4,
          fill: false
        },
        {
          label: 'Pengeluaran',
          data: pengeluaranData,
          borderColor: '#ef4444',
          tension: 0.4,
          fill: false
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  // Fungsi untuk Menampilkan Modal Report
  const modal = document.getElementById('reportModal');
  function viewFullReport(reportType) {
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
</script>