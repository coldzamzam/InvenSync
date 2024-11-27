<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InvenSync - <?= $data['judul'] ?></title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/output.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <nav style="top: 0; z-index: 10;" class="flex py-7 space-between px-10 bg-[#393E46] position-fixed w-full">
      <a href="<?= BASEURL; ?>" class="container-fluid text-white font-black text-3xl w-full">InvenSync</a>
      <div class="flex justify-between gap-2 text-white font-black w-1/2 items-center">
        <a href="<?= BASEURL; ?>/features">Fitur Produk</a>
        <a href="<?= BASEURL; ?>/about">Tentang Kami</a>
        <a href="<?= BASEURL; ?>/about">Hubungi Kami</a>
        <form action="<?= BASEURL; ?>/user/" method="post">
          <button type="submit" name="ayomasuk" class="btn btn-primary">Ayo Masuk</button>
        </form>
      </div>
  </nav>
</head>
<body style="background-image: url(<?= BASEURL; ?>/img/bghome.png); background-size: cover; background-repeat: no-repeat; background-attachment: fixed">
  