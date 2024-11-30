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
</head>
    <aside class="bg-gray-800 text-white w-64 p-6 min-h-screen fixed">
      <h1 class="text-xl font-bold mb-8">Selamat Datang di <br> InvenSync!</h1>
      <nav class="space-y-4">
        <a href="<?= BASEURL; ?>/dashboard" class="<?= ($_SESSION['user_role'] == 'Admin Gudang'||$_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
        <a href="<?= BASEURL; ?>/employees" class="<?= ($_SESSION['user_role'] == 'Admin Gudang'||$_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Employees</a>
        <a href="<?= BASEURL; ?>/inventory" class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Inventory</a>
        <a href="<?= BASEURL; ?>/troublesome" class="<?= ($_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Troublesome Items</a>
        <a href="<?=BASEURL; ?>/dailyreport" class="<?= ($_SESSION['user_role'] == 'Admin Gudang'||$_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Daily Report</a>
        <a href="<?=BASEURL; ?>/monthlyreport" class="<?= ($_SESSION['user_role'] == 'Admin Gudang'||$_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Monthly Report</a>
        <a href="<?= BASEURL; ?>/cashier" class="<?= ($_SESSION['user_role'] == 'Admin Gudang') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700 btnCashier">Cashier</a>
        <a href="<?= BASEURL; ?>/dashboard/toko" data-toko="<?= $_SESSION['user_id']; ?>" class="<?= ($_SESSION['user_role'] == 'Admin Gudang'||$_SESSION['user_role'] == 'Admin Kasir') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700 btnProfileToko">Profile Toko</a>
      </nav>
      <form action="<?= BASEURL; ?>/dashboard/logout" method="post">
      <button name="logout" class="mt-12 bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-400">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </button>
      </form>
    </aside>
    <nav class="left-64 p-6 bg-[#fdfdfd] fixed min-w-screen top-0 right-0 shadow-md"><p class="text-2xl font-bold text-center"><?=$data['judul']?></p></nav>
<body class="bg-[#fafafa]">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?= BASEURL; ?>/js/script.js"></script>
  <div class="flex">
