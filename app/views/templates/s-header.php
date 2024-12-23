<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InvenSync - <?= $data['judul'] ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/output.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <style>
#sidebar {
  height: 100vh;
  width: 6rem; /* Sidebar dalam keadaan normal (kecil) */
  position: fixed;
  transition: width 0.3s ease; /* Menambahkan transisi untuk perubahan lebar */
  overflow-y: auto;
  background-color: #393E46;
}

#sidebar.wide {
  width: 16rem; /* Sidebar melebar ketika mendapatkan class "wide" */
}


    #sidebar:hover {
      width: 16rem;
      /* Expanded width */
    }

    .sidebar-text {
      max-width: 0;
      opacity: 0;
      transition: max-width 0.3s ease, opacity 0.3s;
    }

    #sidebar:hover .sidebar-text {
      max-width: 12rem;
      /* Allow text to expand without breaking layout */
      opacity: 1;
      /* Fade-in effect */
    }

    #sidebar button {
      font-size: 0.875rem;
      /* Smaller font size */
      padding: 0.75rem 1rem;
      /* Adjust padding to make the button less large */
    }

    #sidebar button i {
      font-size: 1.25rem;
      /* Adjust icon size to match button */
    }

    #notificationBtn {
      position: relative;
      font-size: 1.25rem;
    }

    #notificationBadge {
      font-size: 0.75rem;
      font-weight: bold;
      line-height: 1;
      min-width: 1rem;
      text-align: center;
    }

    #sidebarModal {
      transition: transform 0.3s ease-in-out;
    }

    #sidebarModal.active {
      transform: translate-x-0;
    }

    #sidebarModal {
      transition: transform 0.3s ease-in-out;
    }

    #sidebarModal.active {
      transform: translateX(0);
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      /* Semi-transparent black background */
      z-index: 10;
    }

    #overlay.hidden {
      display: none;
    }

    #sidebarModal {
      transition: transform 0.3s ease-in-out;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    #sidebarModal.active {
      transform: translateX(0);
      /* Modal slides in from the right */
    }

    #sidebarModal .p-4 {
      padding-left: 20px;
      padding-right: 20px;
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      /* Semi-transparent black background */
      z-index: 10;
    }

    #overlay.hidden {
      display: none;
    }

    /* Arrow pointing to the bell icon */
    #arrow {
      position: absolute;
      right: -10px;
      /* Place the arrow right outside the modal */
      top: 50%;
      /* Vertically center the arrow */
      transform: translateY(-50%);
      /* Center arrow */
      width: 0;
      height: 0;
      border-left: 10px solid #FFD369;
      /* Arrow shape */
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
    }

    /* Modal content adjustments */
    #sidebarModal {
      max-height: 60%;
      /* Limit the height to 60% of the screen */
    }
  </style>
</head>
<div id="overlay" class="font-poppins fixed inset-0 bg-black bg-opacity-50 z-10 hidden transition-all duration-300">
</div>
<aside id="sidebar" class="group font-poppins fixed top-0 left-0 z-10 bg-[#393E46] text-white w-24 hover:w-64 min-h-screen overflow-hidden transition-all duration-300">
  <div class="p-4">
    <div class="relative flex justify-center items-center">
      <!-- Logo Gambar -->
      <img src="<?= BASEURL; ?>/img/invensync-logo1.png" alt="logo invensync"
        class="transition-all duration-300 absolute opacity-100 group-hover:opacity-0">
      
      <!-- Teks h1 -->
      <h1 class="ml-2 pb-4 font-black text-xl text-center group-hover:opacity-100 group-hover:translate-x-0 opacity-0 transition-all duration-300">
        InvenSync
      </h1>
    </div>
    <h1 class="
      <?php
      if ($_SESSION['user_role'] == 'Admin Gudang') {
        echo 'bg-red-400';
      } elseif ($_SESSION['user_role'] == 'Admin Kasir') {
        echo 'bg-green-400';
      } elseif ($_SESSION['user_role'] == 'Owner') {
        echo 'bg-purple-400';
      } ?> rounded-3xl ml-2 text-sm font-black text-m text-center sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">
      Anda Login Sebagai <br> <?= $_SESSION['user_role'] ?>
    </h1>
    <nav class="mt-6 space-y-4">
      <a href="<?= BASEURL; ?>/dashboard"
        class="py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-tachometer-alt"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Halaman Utama</span>
      </a>
      <a href="<?= BASEURL; ?>/employees"
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-users"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Karyawan</span>
      </a>
      <a href="<?= BASEURL; ?>/item"
        class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fa-solid fa-box"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Barang</span>
      </a>
      <a href="<?= BASEURL; ?>/inventory"
        class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-boxes"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Inventaris</span>
      </a>
      <a href="<?= BASEURL; ?>/transaction"
        class="py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-money-bill"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Transaksi</span>
      </a>
      <a href="<?= BASEURL; ?>/report"
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang' || $_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?> py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-calendar-alt"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Laporan</span>
      </a>
      <a href="<?= BASEURL; ?>/cashier"
        class="<?= ($_SESSION['user_role'] == 'Admin Gudang') ? 'hidden' : 'block' ?> py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-cash-register"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Kasir</span>
      </a>
      <a href="<?= BASEURL; ?>/dashboard/toko"
        class="py-2 px-6 rounded hover:bg-gray-700 flex items-center transition-all duration-300">
        <i class="fas fa-info-circle"></i>
        <span class="ml-2 sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Profil Toko</span>
      </a>
    </nav>
    <form action="<?= BASEURL; ?>/dashboard/logout" id="LogoutForm" method="post" class="mt-12">
      <input type="hidden" name="logout" value="1">
      <button type="button" onclick="logoutConfirmation()"
        class="bg-[#FFD369] text-black py-1.5 px-6 rounded hover:bg-yellow-400 transition-all duration-300 flex items-center justify-center space-x-2">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span class="sidebar-text whitespace-nowrap overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300">Keluar</span>
      </button>
    </form>
  </div>
</aside>



<nav class="font-poppins left-0 p-6 bg-[#fdfdfd] fixed min-w-screen top-0 right-0 shadow-md z-[5] flex items-center justify-between">
  <p class="text-2xl font-bold text-center flex-1"><?= $data['judul'] ?></p>
  <button id="notificationBtn"
    class="relative<?php if ($data['totalnotifications']!=0): echo ' bg-red-500'; else: echo ' bg-[#FFD369]'; endif ?> text-black py-1 px-3 rounded hover:bg-yellow-400 transition-all duration-300 flex items-center justify-center">
    <?php if ($data['totalnotifications']!=0): echo '<i class="fa-solid fa-bell" style="color: #ffffff;"></i>';else : echo '<i class="fa-solid fa-bell"></i>'; endif ?>
    <span id="notificationBadge" class="<?php if ($data['totalnotifications']!=0): echo ' text-white'; else: echo ' text-black'; endif ?>">
      <?= $data['totalnotifications']; ?>
    </span>
  </button>
</nav>

<div id="sidebarModal"
  class="font-poppins z-10 fixed top-0 right-0 h-[60%] w-80 bg-white shadow-lg hidden transition-transform transform translate-x-full">
  <div class="relative">
    <div class="p-4 border-b flex justify-between items-center">
      <h2 class="text-xl font-semibold">Notifikasi</h2>
      <button onclick="closeSidebarModal()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="p-4 overflow-y-auto">
      <ul class="space-y-2">
        <?php foreach ($data['notifications'] as $notification): ?>
          <li
            class="bg-gray-100 p-2 rounded flex <?php if ($notification['TOTAL'] > 0)
              echo 'bg-yellow-100';
            else
              echo 'bg-red-100'; ?>">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>Item dengan ID - <?= $notification['ITEM_ID']; ?> memiliki stok tersisa = <?= $notification['TOTAL']; ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div id="arrow"
    class="absolute right-[-10px] top-[50%] transform -translate-y-[50%] w-0 h-0 border-l-[10px] border-t-[10px] border-transparent border-l-[#FFD369]">
  </div>
</div>

<body class="bg-[#fafafa] font-poppins">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
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

    sidebar.addEventListener('mouseenter', () => {
      sidebar.classList.add('w-64'); // Sidebar melebar
    });

    sidebar.addEventListener('mouseleave', () => {
      sidebar.classList.remove('w-64'); // Sidebar kembali kecil
    });


    overlay.addEventListener('click', () => {
      overlay.classList.add('hidden'); // Hide overlay if clicked
    });

    // Open the notification modal
    // Open the notification modal
    function openSidebarModal() {
      document.getElementById('sidebarModal').classList.remove('hidden');
      document.getElementById('sidebarModal').classList.add('active');  // Adds active class to trigger the slide-in animation
      document.getElementById('overlay').classList.remove('hidden');  // Shows the overlay
    }

    // Close the notification modal
    function closeSidebarModal() {
      document.getElementById('sidebarModal').classList.remove('active');  // Removes active class to hide the modal
      document.getElementById('sidebarModal').classList.add('hidden');  // Hides the modal
      document.getElementById('overlay').classList.add('hidden');  // Hides the overlay
    }

    // Event listener for the notification button to open the modal
    document.getElementById('notificationBtn').addEventListener('click', openSidebarModal);

    // Event listener for overlay to close the modal when clicked
    document.getElementById('overlay').addEventListener('click', closeSidebarModal);

  </script>

  <?php if (isset($_SESSION['receipt_id'])): ?>
    <script>
      document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault(); // Cegah redirect langsung
          const targetUrl = this.href;

          Swal.fire({
            title: 'Yakin ingin keluar?',
            text: 'Transaksi sedang berlangsung. Data receipt akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              // Hapus session via AJAX
              fetch('<?= BASEURL; ?>/cashier/deleteReceiptSession', {
                method: 'POST'
              })
                .then(() => {
                  // Setelah session dihapus, langsung arahkan ke URL
                  window.location.href = targetUrl; // Redirect setelah berhasil
                })
                .catch(() => {
                  Swal.fire("Terjadi kesalahan!", "Silakan coba lagi.", "error");
                });
            }
          });
        });
      });
      document.getElementById('menuButton').addEventListener('click', function () {
  const sidebar = document.getElementById('sidebar');
  // Toggle class 'wide' untuk melebar/memperkecil sidebar
  sidebar.classList.toggle('wide');
});

    </script>
  <?php endif; ?>