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
    <a href="<?= BASEURL; ?>/report" id="dailyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Harian</a>
    <a href="<?= BASEURL; ?>/report/bulan" id="monthlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Bulanan</a>
    <a href="<?= BASEURL; ?>/report/tahun" id="yearlyTab" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Laporan Tahunan</a>
  </div>


    <!-- Laporan Tahunan -->
    <section id="yearlyReport" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
    <!-- Judul dan Pilihan Tahun dalam Satu Baris -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold">Laporan Tahunan</h2>
      <form action="<?= BASEURL; ?>/report/getAnnualReport" method="post">
        <select name="dateTahun" id="yearPicker" class="border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400">
          <option value="" selected disabled>Pilih Tahun</option>
          <?php foreach ($data['tahun'] as $tahun) : ?>
            <option value="<?= $tahun['TAHUN'] ?>"><?= $tahun['TAHUN'] ?></option>
          <?php endforeach; ?>
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
          CEK
        </button>
      </form>
    </div>

    <!-- Kotak Total -->
    <div class="flex md:flex-row gap-4 justify-center w-full">
      <div class="bg-blue-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pemasukan Tahunan</h3>
        <p class="text-xl font-bold text-blue-600">
          Rp<?= number_format($data['totalTahunan']['TOTAL_PENDAPATAN'], 2, ',', '.') ?>
        </p>
      </div>
      <div class="bg-red-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Total Pengeluaran Tahunan</h3>
        <p class="text-xl font-bold text-red-600">
          Rp<?= number_format($data['totalTahunan']['TOTAL_PENGELUARAN'], 2, ',', '.') ?>
        </p>
      </div>
      <!-- <div class="bg-green-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pemasukan Barang Tahunan</h3>
        <p class="text-xl font-bold text-green-600">1.600 Pack</p>
      </div>
      <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
        <h3 class="font-semibold text-gray-700">Pengeluaran Barang Tahunan</h3>
        <p class="text-xl font-bold text-yellow-600">800 Pack</p>
      </div> -->
    </div>

    <!-- Grafik Batang -->
    <canvas id="yearlyChart" class="w-full h-64"></canvas>

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
    <div id="reportHeader">
      <h1 id="modalTitle">Laporan Tahunan</h1>
    </div>

    <!-- Konten Data -->
<div id="modalContent">
      <div class="data-row">
        <span>Total Pemasukan Tahunan:</span>
        <span>Rp<?= number_format($data['totalTahunan']['TOTAL_PENDAPATAN'], 2, ',', '.') ?></span>
      </div>
      <div class="data-row">
        <span>Total Pengeluaran Tahunan:</span>
        <span>Rp<?= number_format($data['totalTahunan']['TOTAL_PENGELUARAN'], 2, ',', '.') ?></span>
      </div>
      <!-- <div class="data-row">
        <span>Total Pemasukan Barang Tahunan:</span>
        <span>1.600 Pack</span>
      </div>
      <div class="data-row">
        <span>Total Pengeluaran Barang Tahunan:</span>
        <span>800 Pack</span>
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

  // Grafik Batang Tahunan
  const ctxYearly = document.getElementById('yearlyChart').getContext('2d');
  new Chart(ctxYearly, {
    type: 'bar',
    data: {
      labels: <?= json_encode($data['chartData']['labels']); ?>,
      datasets: [
        {
          label: 'Pemasukan',
          data: <?= json_encode($data['chartData']['pemasukan']); ?>,
          backgroundColor: '#3b82f6'
        },
        {
          label: 'Pengeluaran',
          data: <?= json_encode($data['chartData']['pengeluaran']); ?>,
          backgroundColor: '#ef4444'
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
  function viewFullReport() {
    const modal = document.getElementById('reportModal');
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