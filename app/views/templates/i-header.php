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
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <nav style="top: 0; z-index: 10; box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.9);" class="fixed flex justify-center items-center py-7 px-10 bg-[#393E46] position-fixed w-full">
    <a href="<?= BASEURL; ?>" class="text-center container-fluid text-white font-black text-3xl w-full">InvenSync</a>
</nav>
</head>
<body class="font-poppins" style="background-image: url(<?= BASEURL; ?>/img/bghome-new.png); background-size: cover; background-repeat: no-repeat; background-attachment: fixed">