<main class="bg-gray-900 text-white h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted class="absolute top-0 left-0 w-full h-full object-cover">
        <source src="<?= BASEURL; ?>/videos/background-edited.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Content Section -->
    <div class="relative z-10 w-full flex justify-center space-x-6 mx-10">
        <!-- Left Content Section (Bigger Box) -->
        <div class="relative text-justify p-6 bg-opacity-60 bg-gray-800 rounded-lg shadow-lg w-2/3 max-w-lg">
            <h1 class="text-4xl font-bold mb-4">Welcome to InvenSync</h1>
            <p class="text-lg mb-6">
                Simplify your inventory management with our comprehensive system. InvenSync ensures accurate tracking, seamless organization, and effortless control of your inventory.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="<?= BASEURL; ?>/user/login" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Get Started
                </a>
                <a href="<?= BASEURL; ?>/home/learnmore" class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Learn More
                </a>
            </div>
        </div>

        <!-- Right Content Section (Smaller Box) -->
        <div class="relative text-center p-6 bg-opacity-60 bg-gray-800 rounded-lg shadow-lg w-1/3 max-w-xs">
            <img src="<?= BASEURL; ?>/img/invensync-logo1.png" alt="InvenSync Logo" class="w-full h-auto mx-auto">
        </div>
    </div>
</main>
<?php
if (isset($_SESSION['status'])):
    $status = $_SESSION['status']; // Get status from session
    unset($_SESSION['status']); // Remove status from session after using it
?>
    <script>
        // Handle SweetAlert based on session status
        let status = '<?= $status ?>';
        if (status === 'terhapus') {
            Swal.fire({
                title: 'Berhasil',
                text: 'Akun dan Toko anda telah dihapus!',
                icon: 'success'
            });
        } else if (status === 'deleteRequest') {
            Swal.fire({
                title: 'Permintaan Hapus terkirim!',
                text: 'Tolong verifikasi di email anda.',
                icon: 'warning'
            });
        } else if (status === 'gagaldihapus') {
            Swal.fire({
                title: 'Error',
                text: 'Email tidak tersedia!',
                icon: 'error'
            });
        }
    </script>
<?php endif; ?>