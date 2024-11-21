<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InvenSync - <?= $data['judul'] ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
    <aside class="bg-gray-800 text-white w-64 p-6 min-h-screen fixed">
      <h1 class="text-xl font-bold mb-8">Selamat Datang di <br> InvenSync!</h1>
      <nav class="space-y-4">
        <a href="<?= BASEURL; ?>/dashboard" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
        <a href="<?= BASEURL; ?>/dashboard/employees" class="block py-2 px-4 rounded hover:bg-gray-700">Employees</a>
        <a href="<?= BASEURL; ?>/dashboard/inventory" class="block py-2 px-4 rounded hover:bg-gray-700">Inventory</a>
        <a href="<?= BASEURL; ?>/dashboard/troublesome" class="block py-2 px-4 rounded hover:bg-gray-700">Troublesome Items</a>
        <a href="<?=BASEURL; ?>/dashboard/dailyreport" class="block py-2 px-4 rounded hover:bg-gray-700">Daily Report</a>
        <a href="<?=BASEURL; ?>/dashboard/monthlyreport" class="block py-2 px-4 rounded hover:bg-gray-700">Monthly Report</a>
        <a href="<?= BASEURL; ?>/dashboard/cashier" class="block py-2 px-4 rounded hover:bg-gray-700">Cashier</a>
      </nav>
      <form action="<?= BASEURL; ?>/dashboard/logout" method="post">
        <button name="logout" class="mt-12 bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-400">
          Log Out
        </button>
      </form>
    </aside>
<body class=" bg-grey-100 h-[9000px]">
  <div class="flex">
