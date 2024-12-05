<main class="flex-1 ml-24 mt-20 p-8">
    <div class="bg-white shadow-md border border-zinc-100 w-full sm:w-72 p-4 rounded-lg">
        <!-- Header -->
        <div class="mb-4 text-center">
            <h1 class="text-xl font-semibold text-gray-800">TOTAL</h1>
        </div>
        
        <!-- Konten Data -->
        <div class="space-y-2 text-gray-700 text-sm">
            <div class="flex justify-between text-xs">
                <span class="font-semibold">Total Pemasukan:</span>
                <span>Rp. 1.000.000</span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="font-semibold">Total Pengeluaran:</span>
                <span>Rp. 500.000</span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="font-semibold">Total Pemasukan Barang:</span>
                <span>40 Pack</span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="font-semibold">Total Pengeluaran Barang:</span>
                <span>25 Pack</span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 flex justify-center gap-3">
            <button onclick="window.print()" class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 text-xs">
                Print
            </button>
            <button onclick="if(confirm('Apakah Anda yakin ingin menghapus laporan ini?')) alert('Laporan berhasil dihapus!');" class="px-5 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 text-xs">
                Delete
            </button>
        </div>
    </div>
</main>
