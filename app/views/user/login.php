<div class="relative my-[250px] mx-[350px] bg-white shadow-lg rounded-lg overflow-hidden">
  <!-- Wrapper for sliding panels -->
  <div id="auth-panels" class="flex w-[200%] h-full transition-transform transform duration-500 ease-in-out">
  INI LOGIN
  <p><?= BASEURL; ?></p>

  <p>Email: <?= $_SESSION['user_email']; ?></p>
  <p>Email: <?= $_SESSION['user_name']; ?></p>
  </div>
</div>