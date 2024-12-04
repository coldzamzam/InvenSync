<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InvenSync - <?= $data['judul'] ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/output.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <style>
    #sidebar {
      width: 6rem; /* Default width */
    }

    #sidebar:hover {
      width: 16rem; /* Expanded width */
    }

    .sidebar-text {
      max-width: 0;
      opacity: 0;
      transition: max-width 0.3s ease, opacity 0.3s ease;
    }

    #sidebar:hover .sidebar-text {
      max-width: 12rem; /* Allow text to expand without breaking layout */
      opacity: 1; /* Fade-in effect */
    }

  </style>
</head>
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden transition-all duration-300"></div>
<aside id="sidebar" class="fixed top-0 left-0 z-10 bg-gray-800 text-white w-24 hover:w-64 min-h-screen overflow-hidden transition-all duration-300">
  <div class="p-4">
    <h1 class="text-lg font-bold hidden hover:block">InvenSync</h1>
    <nav class="mt-6 space-y-4">
      <a href="<?= BASEURL; ?>/dashboard" 
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-tachometer-alt"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Dashboard</span>
      </a>
      <a href="<?= BASEURL; ?>/employees" 
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-users"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Employees</span>
      </a>
      <a href="<?= BASEURL; ?>/inventory" 
        class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-boxes"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Inventory</span>
      </a>
      <a href="<?= BASEURL; ?>/troublesome" 
        class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Troublesome Items</span>
      </a>
      <a href="<?= BASEURL; ?>/dailyreport" 
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-calendar-day"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Daily Report</span>
      </a>
      <a href="<?= BASEURL; ?>/monthlyreport" 
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-calendar-alt"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Monthly Report</span>
      </a>
      <a href="<?= BASEURL; ?>/cashier"
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang') ? 'hidden' : 'block' ?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-cash-register"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Cashier</span>
      </a>
      <a href="<?= BASEURL; ?>/dashboard/toko" 
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block'?> py-2 px-4 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-info-circle"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Profile Toko</span>
      </a>
    </nav>
    <form action="<?= BASEURL; ?>/dashboard/logout" id="LogoutForm" method="post" class="mt-12">
      <button type="button" class="bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-400 transition-all duration-300" onclick="logoutConfirmation()">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 transition-all duration-300">Logout</span>
      </button>
    </form>
  </div>
</aside>


  <nav class="left-0 p-6 bg-[#fdfdfd] fixed min-w-screen top-0 right-0 shadow-md"><p class="text-2xl font-bold text-center"><?=$data['judul']?></p></nav>
  <body class="bg-[#fafafa]">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?= BASEURL; ?>/js/script.js"></script>

  <script>
    function logoutConfirmation() {
      Swal.fire({
        title: 'Logout?',
        text: "Apa anda yakin ingin keluar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Selamat Tinggal!",
            text: "Semoga harimu menyenangkan!",
            icon: "success"
          }).then(() => {
            document.getElementById('LogoutForm').submit();
          });
        }
      });
    }
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const content = document.querySelector('.flex-1');

    sidebar.addEventListener('mouseenter', () => {
      overlay.classList.remove('hidden'); // Show overlay
      content.classList.add('ml-64'); // Push content when sidebar expands
    });

    sidebar.addEventListener('mouseleave', () => {
      overlay.classList.add('hidden'); // Hide overlay
      content.classList.remove('ml-64'); // Reset content margin
    });

    overlay.addEventListener('click', () => {
      overlay.classList.add('hidden'); // Hide overlay if clicked
    });
  </script>
