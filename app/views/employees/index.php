<main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Employees</h2>
        <button onclick="openModal()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Create Employee</button>
      </header>

      <div class="flex items-center mb-4 space-x-4">
        <input type="text" placeholder="Quick search" class="border rounded px-4 py-2">
        <input type="date" class="border rounded px-4 py-2">
          <select class="border rounded px-4 py-2">
          <option>Status</option>
          <option>Pending</option>
          <option>Completed</option>
        </select>
      </div>
      <h2 class="text-xl font-semibold pb-2">Karyawan</h2>
      <div class="bg-white rounded shadow">
      
      <table class="w-full text-left border-collapse">
      <thead>
      <tr class="bg-gray-200 text-gray-600">
              <th class="py-3 px-4 border">No.</th>
              <th class="py-3 px-4 border">User Id</th>
              <th class="py-3 px-4 border">Email</th>
              <th class="py-3 px-4 border">Name</th>
              <th class="py-3 px-4 border">Role</th>
              <th class="py-3 px-4 border">Address</th>
              <th class="py-3 px-4 border">Phone Number</th>
            </tr>
      </thead>
        <tbody>
          <?php $no = 1; foreach( $data['users'] as $users ) : ?>
            <tr class="hover:bg-gray-100">
              <td  scope="row" class="py-3 px-4 border"><?= $no++; ?></td>
              <td class="py-3 px-4 border"><?= $users['USER_ID']; ?></td>
              <td class="py-3 px-4 border"><?= $users['EMAIL']; ?></td>
              <td class="py-3 px-4 border"><?= $users['NAME']; ?></td>
              <td class="py-3 px-4 border"><?= $users['ROLE']; ?></td>
              <td class="py-3 px-4 border"><?= $users['ADDRESS']; ?></td>
              <td class="py-3 px-4 border"><?= $users['PHONE_NUMBER']; ?></td>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="pagination mt-4">
        <ul class="flex justify-center space-x-2">
          <?php if ($data['currentPage'] > 1): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $data['currentPage'] - 1; ?>" class="px-3 py-1 border rounded">Previous</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $i; ?>" class="px-3 py-1 border <?= $data['currentPage'] == $i ? 'bg-blue-500 text-white' : ''; ?>"><?= $i; ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($data['currentPage'] < $data['totalPages']): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $data['currentPage'] + 1; ?>" class="px-3 py-1 border rounded">Next</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
</div>

  <!-- <?php
if (isset($_SESSION['formErrors'])) {
    $data = $_SESSION['formErrors']; 
    unset($_SESSION['formErrors']);  
} else {
    $data = [
        'nameError' => '',
        'roleError' => '',
        'addressError' => '',
        'phonenumberError' => '',
        'emailError' => '',
        'passwordError' => ''
    ];
}
?> -->
      <!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg shadow-lg">
    <!-- Header Modal -->
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Create Employee</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 w-0">&times;</button>
    </div>
    <h3 class="text-l text-center">Buatkan Akun untuk Karyawanmu!</h3>
    <!-- Formulir -->
    <form  action="<?= BASEURL; ?>/employees/createEmployee" method="POST" id="createEmployeeForm">
      <div class="flex mt-6 gap-4 mb-6">
        <!-- Input Nama -->
        <div class="w-1/2">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="name" name="name"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <!-- <span class="text-red-500"><?= $data['nameError']; ?></span> -->
          <span id="nameError" class="text-red-500 error"></span>
        </div>

        <!-- Input Role -->
        <div class="w-1/2">
          <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
          <select id="role" name="role"
                  class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Select Role --</option>
            <option value="Admin Gudang">Admin Gudang</option>
            <option value="Admin Kasir">Admin Kasir</option>
          </select>
          <!-- <span class="text-red-500"><?= $data['roleError']; ?></span> -->
          <span id="roleError" class="text-red-500 error"></span>
        </div>
      </div>
      <div class="flex gap-4 mb-6">
        <!-- Input Alamat -->
        <div class="w-1/2">
          <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
          <input id="address" name="address"
                    class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></input>
          <!-- <span class="text-red-500"><?= $data['addressError']; ?></span> -->
          <span id="addressError" class="text-red-500 error"></span>
        </div>

        <!-- Input Nomor Telepon -->
        <div class="w-1/2">
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
          <input type="tel" id="phone" name="phonenumber"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <!-- <span class="text-red-500"><?= $data['phonenumberError']; ?></span> -->
          <span id="phoneError" class="text-red-500 error"></span>
        </div>
      </div>
      <div class="flex gap-4 mb-6">
        <!-- Input Email -->
        <div class="w-1/2">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <!-- <span class="text-red-500"><?= $data['emailError']; ?></span> -->
          <span id="emailError" class="text-red-500 error"></span>
        </div>

        <!-- Input Password -->
        <div class="w-1/2">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <!-- <span class="text-red-500"><?= $data['passwordError']; ?></span> -->
          <span id="passwordError" class="text-red-500 error"></span>
        </div>
      </div>
      <!-- Tombol Simpan -->
      <button type="submit"
              class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        Save Employee
      </button>
    </form>
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
        if (status === 'success') {
            Swal.fire({
                title: 'Success',
                text: 'Employee has been added successfully!',
                icon: 'success'
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error',
                text: 'Failed to add employee!',
                icon: 'error'
            });
        }
    </script>
<?php endif; ?>

    <script>

document.getElementById('createEmployeeForm').addEventListener('submit', function(event) {
    // Prevent form submission
    event.preventDefault();

    // Get form values
    const name = document.getElementById('name').value;
    const role = document.getElementById('role').value;
    const address = document.getElementById('address').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Validation checks
    let errors = false;

    // Clear any existing error messages
    document.querySelectorAll('.error').forEach(function(el) {
      el.textContent = '';
    });

    // Validate each field and show errors if any
    if (!name) {
      document.getElementById('nameError').textContent = 'Nama tidak boleh kosong.';
      errors = true;
    }
    if (!role) {
      document.getElementById('roleError').textContent = 'Role tidak boleh kosong.';
      errors = true;
    }
    if (!address) {
      document.getElementById('addressError').textContent = 'Alamat tidak boleh kosong.';
      errors = true;
    }
    if (!phone) {
      document.getElementById('phoneError').textContent = 'Nomor Telepon tidak boleh kosong.';
      errors = true;
    }
    if (!email || !/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
      document.getElementById('emailError').textContent = 'Email tidak valid.';
      errors = true;
    }
    if (!password || password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password)) {
      document.getElementById('passwordError').textContent = 'Password harus memiliki minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
      errors = true;
    }

    if (errors) {
      // Stay on the modal if there are validation errors
      return;
    }

    // If there are no errors, proceed with form submission (can use AJAX or allow normal form submit)
    this.submit();
  });

      closeModal();
      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
      }
      
      function openModal() {
        document.getElementById('modal').classList.remove('hidden');
      }
    </script>
</body>
</html>