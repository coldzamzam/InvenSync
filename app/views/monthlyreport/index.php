<main class="flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg border border-zinc-200 w-full max-w-lg p-8 rounded-lg">
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">TOTAL</h1>
        </div>
        
        <!-- Konten Data -->
        <div class="space-y-4 text-gray-700 text-lg">
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total Pemasukan:</span>
                <span>Rp. 1.000.000</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total Pengeluaran:</span>
                <span>Rp. 500.000</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total Pemasukan Barang:</span>
                <span>40 Pack</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total Pengeluaran Barang:</span>
                <span>25 Pack</span>
            </div>
        </div>
<br>
<br>
<br>
        <!-- Tombol Aksi -->
        <div class="mt-8 flex justify-start gap-3">
            <button 
                onclick="window.print()" 
                class="py-2 px-4 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 text-base font-medium">
                Print
            </button>
            <button 
                onclick="if(confirm('Apakah Anda yakin ingin menghapus laporan ini?')) alert('Laporan berhasil dihapus!');" 
                class="py-2 px-4 bg-red-600 text-white rounded-md shadow-md hover:bg-red-700 text-base font-medium">
                Delete
            </button>
        </div>
    </div>
</main>
