<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InvenSync - <?= $data['judul'] ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <a href="<?= BASEURL; ?>/cashier" class="<?= ($_SESSION['user_role'] == 'Admin Gudang') ? 'hidden' : 'block' ?>  py-2 px-4 rounded hover:bg-gray-700">Cashier</a>
      </nav>
      <form action="<?= BASEURL; ?>/dashboard/logout" method="post">
        <button name="logout" class="mt-12 bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-400">
          Log Out
        </button>
      </form>
    </aside>
<body class=" bg-grey-100 h-[9000px]">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <div class="flex">
