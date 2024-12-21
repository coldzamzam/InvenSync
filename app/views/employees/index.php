<main class="flex-1 ml-24 mt-20 p-8">
<div class="flex items-center mb-4 space-x-4 justify-between">
  <!-- Filter dan Pencarian -->
  <div class="flex items-center gap-4">
    <form id="searchForm" class="flex items-center">
      <input type="text" id="searchInput" placeholder="Cari" 
        name="search" 
        class="border rounded px-4 py-2 w-full"
        onkeyup="filterTable()">
    </form>
    <select id="roleFilter" class="border rounded px-4 py-2" onchange="filterByRole()">
      <option value="" disabled selected>Role</option>
      <option>Semua</option>
      <option>Admin Kasir</option>
      <option>Admin Gudang</option>
    </select>
  </div>
  
  <!-- Tombol Tambah Karyawan -->
  <button onclick="openModal()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 ml-auto">+ Tambah Karyawan</button>
</div>


      <h2 class="text-xl font-semibold pb-2">Daftar Karyawan</h2>
      <div class="bg-white rounded shadow">
      
      <table class="w-full text-left border-collapse">
      <thead>
      <tr class="bg-[#FFD369] text-gray-600">
              <th class="py-3 px-4 border text-center">No.</th>
              <th class="py-3 px-4 border text-center">User ID</th>
              <th class="py-3 px-4 border text-center">Email</th>
              <th class="py-3 px-4 border text-center">Nama</th>
              <th class="py-3 px-4 border text-center">Role</th>
              <th class="py-3 px-4 border text-center">Alamat</th>
              <th class="py-3 px-4 border text-center">Nomor Telepon</th>
              <th class="py-3 px-4 border text-center">Status</th>
              <th class="py-3 px-4 border text-center">Aksi</th>
            </tr>
      </thead>
        <tbody>
          <?php $no = 1; foreach( $data['users'] as $users ) : ?>
            <tr class="hover:bg-gray-100">
              <td  scope="row" class="py-3 px-4 border text-center"><?= $no++; ?>.</td>
              <td class="py-3 px-4 border text-center"><?= $users['USER_ID']; ?></td>
              <td class="py-3 px-4 border"><?= $users['EMAIL']; ?></td>
              <td class="py-3 px-4 border text-center"><?= $users['NAME']; ?></td>
              <td class="py-3 px-4 border text-center"><?= $users['ROLE']; ?></td>
              <td class="py-3 px-4 border"><?= $users['ADDRESS']; ?></td>
              <td class="py-3 px-4 border text-center"><?= $users['PHONE_NUMBER']; ?></td>
              <td class="py-3 px-4 border text-center<?php if ($users['IS_EMAIL_VERIFIED'] == 1) { echo " bg-green-100"; } else { echo " bg-red-100"; } ?>"><?php if ($users['IS_EMAIL_VERIFIED'] == 1) { echo "Akun Aktif"; } else { echo "Perlu Verifikasi"; } ?></td>
              <td class="py-3 px-4 border flex justify-center items-center">
                <button onclick="editModalOpen('<?= $users['USER_ID']; ?>')" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600"><img src="<?= BASEURL; ?>/img/setting-logo.png" width="20px" height="20px" alt="logo edit"></button>
              </td>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="pagination mt-4">
        <ul class="flex justify-center space-x-2">
          <?php if ($data['currentPage'] > 1): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $data['currentPage'] - 1; ?>" class="px-3 py-1 border rounded">Sebelumnya</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $i; ?>" class="px-3 py-1 border <?= $data['currentPage'] == $i ? 'bg-blue-500 text-white' : ''; ?>"><?= $i; ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($data['currentPage'] < $data['totalPages']): ?>
            <li>
              <a href="<?= BASEURL; ?>/employees/index/<?= $data['currentPage'] + 1; ?>" class="px-3 py-1 border rounded">Selanjutnya</a>
            </li>
          <?php endif; ?>
        </ul>
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
      <h3 class="text-2xl font-semibold w-full text-center">Buat Akun Karyawan</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <h3 class="text-l text-center">Buatkan Akun untuk Karyawanmu!</h3>
    <!-- Formulir -->
    <form action="<?= BASEURL; ?>/employees/createEmployee" method="POST" id="createEmployeeForm">
      <div class="flex mt-6 gap-4 mb-6">
        <!-- Input Nama -->
        <div class="w-1/2">
          <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
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
            <option value="" disabled selected>-- Pilih Role --</option>
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
          <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
          <input id="address" name="address"
                    class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></input>
          <!-- <span class="text-red-500"><?= $data['addressError']; ?></span> -->
          <span id="addressError" class="text-red-500 error"></span>
        </div>

        <!-- Input Nomor Telepon -->
        <div class="w-1/2">
          <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
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
        Simpan Akun
      </button>
    </form>
  </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Edit Akun Karyawan</h3>
      <button onclick="editModalClose()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <h3 class="text-l text-center">Edit Akun untuk Karyawanmu!</h3>
    <form action="<?= BASEURL; ?>/employees/updateEmployee" method="post" id="editEmployeeForm" class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg" enctype="multipart/form-data">
      <div class="flex gap-4 mb-6">
        <input type="hidden" id="editId" name="id">
        <!-- Input Nama -->
        <div class="w-1/2">
          <label for="name" class="block text-sm font-medium text-gray-700">Nama<label class="text-red-500">*</label></label>
          <input type="text" id="editName" name="name"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="nameErrorEdit" class="text-red-500 error"></span>
        </div>

        <!-- Input Role -->
        <div class="w-1/2">
          <label for="role" class="block text-sm font-medium text-gray-700">Role<label class="text-red-500">*</label></label>
          <select name="role" id="editRole" class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>-- Pilih Role --</option>
            <option value="Admin Gudang">Admin Gudang</option>
            <option value="Admin Kasir">Admin Kasir</option>
          </select>
          <!-- <input type="text" id="editRole" name="role"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
          <span id="roleErrorEdit" class="text-red-500 error"></span>
        </div>
      </div>
      <div class="flex gap-4 mb-6">
        <!-- Input Alamat -->
        <div class="w-1/2"> 
          <label for="address" class="block text-sm font-medium text-gray-700">Alamat<label class="text-red-500">*</label></label>
          <input type="text" id="editAddress" name="address" 
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="addressErrorEdit" class="text-red-500 error"></span>
        </div>

        <!-- Input Nomor Telepon -->
        <div class="w-1/2">
          <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon<label class="text-red-500">*</label></label>
          <input type="text" id="editPhonenumber" name="phone" 
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="phoneErrorEdit" class="text-red-500 error"></span>
        </div>
      </div>
      <div class="flex gap-4 mb-6">
        <!-- Input Email -->
        <div class="w-1/2">
          <label for="email" class="block text-sm font-medium text-gray-700">Email<label class="text-red-500">*</label></label>
          <input type="email" id="editEmail" name="email" 
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="emailErrorEdit" class="text-red-500 error"></span>
        </div>

        <!-- Input Password -->
        <div class="w-1/2">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="editPassword" name="password" 
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="passwordErrorEdit" class="text-red-500 error"></span>
        </div>
      </div>
      <!-- Tombol Simpan -->
      <div class="flex gap-2">
        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Edit Akun
        </button>
      </div>
    </form>
    <form action="<?= BASEURL;?>/employees/deleteEmployee" method="post" class="pl-6" id="deleteEmployeeForm">
          <input type="hidden" id="deleteID" name="id">
          <button type="button" onclick="deleteConfirmation()" class="right-0 p-2 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"><img src="<?= BASEURL; ?>/img/delete.png" width="20px" height="20px" alt="delete"></button>
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
        if (status === 'errorPassword') {
            Swal.fire({
                title: 'Error',
                text: 'Password tidak tersedia!',
                icon: 'success'
            });
        } else if (status === 'errorEmail') {
            Swal.fire({
                title: 'Error',
                text: 'Email tidak tersedia!',
                icon: 'error'
            });
        } else if (status === 'errorNomorTelepon') {
            Swal.fire({
                title: 'Error',
                text: 'Nomor Telepon tidak tersedia!',
                icon: 'error'
            });
        } else {
          Swal.fire({
                title: 'Success',
                text: 'Karyawan Berhasil Ditambahkan!',
                icon: 'success'
            });
        }
    </script>
<?php endif; ?>

    <script>
    editModalClose();
    closeModal();
    
    function deleteConfirmation(){
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
          setTimeout(function() {
            document.getElementById('deleteEmployeeForm').submit();
          }, 2000);
        }
      });
    }


    document.getElementById('editEmployeeForm').addEventListener('submit', function(event) {
    // Prevent form submission
    event.preventDefault();

    // Get form values
    const name = document.getElementById('editName').value;
    const role = document.getElementById('editRole').value;
    const address = document.getElementById('editAddress').value;
    const phone = document.getElementById('editPhonenumber').value;
    const email = document.getElementById('editEmail').value;
    const password = document.getElementById('editPassword').value;

    // Validation checks
    let errors = false;

    // Clear any existing error messages
    document.querySelectorAll('.error').forEach(function(el) {
      el.textContent = '';
    });

    // Validate each field and show errors if any
    if (!name) {
      document.getElementById('nameErrorEdit').textContent = 'Nama tidak boleh kosong.';
      errors = true;
    }
    if (!role) {
      document.getElementById('roleErrorEdit').textContent = 'Role tidak boleh kosong.';
      errors = true;
    }
    if (!address) {
      document.getElementById('addressErrorEdit').textContent = 'Alamat tidak boleh kosong.';
      errors = true;
    }
    if (!phone) {
      document.getElementById('phoneErrorEdit').textContent = 'Nomor Telepon tidak boleh kosong.';
      errors = true;
    }
    if (!email || !/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
      document.getElementById('emailErrorEdit').textContent = 'Email tidak valid.';
      errors = true;
    }
    if (password && (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password))) {
      document.getElementById('passwordErrorEdit').textContent = 'Password harus memiliki minimal 8 karakter, 1 angka, 1 huruf besar, dan 1 huruf kecil.';
      errors = true;
    }

    if (errors) {
      // Stay on the modal if there are validation errors
      return;
    }

    // If there are no errors, proceed with form submission (can use AJAX or allow normal form submit)
    this.submit();
  });

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
      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
      }
      
      function openModal() {
        document.getElementById('modal').classList.remove('hidden');
      }

      function editModalOpen(id) {
          document.getElementById('deleteID').value = id;
          document.getElementById('modalEdit').classList.remove('hidden');

          fetch(`<?= BASEURL ?>/employees/getUserbyID/${id}`)
              .then(response => {
                  if (!response.ok) {
                      throw new Error(`HTTP error! Status: ${response.status}`);
                  }
                  return response.json();
              })
              .then(data => {
                  if (data) {
                      document.getElementById('editName').value = data.NAME;
                      document.getElementById('editRole').value = data.ROLE;
                      document.getElementById('editAddress').value = data.ADDRESS;
                      document.getElementById('editPhonenumber').value = data.PHONE_NUMBER;
                      document.getElementById('editEmail').value = data.EMAIL;
                      document.getElementById('editId').value = data.USER_ID;
                  } else {
                      alert('Data karyawan tidak ditemukan.');
                  }
              })
              .catch(error => {
                  console.error('Error fetching employee data:', error);
                  alert('Terjadi kesalahan saat mengambil data: ' + error.message);
              });
      }

      //quick search
  function filterTable() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const table = document.querySelector('table tbody');
  const rows = table.getElementsByTagName('tr');

  for (let i = 0; i < rows.length; i++) {
    const idCell = rows[i].getElementsByTagName('td')[1]; // Kolom User ID
    const nameCell = rows[i].getElementsByTagName('td')[3]; // Kolom Name

    if (idCell && nameCell) {
      const idText = idCell.textContent || idCell.innerText;
      const nameText = nameCell.textContent || nameCell.innerText;

      // Tampilkan atau sembunyikan baris berdasarkan kecocokan
      if (idText.toLowerCase().includes(filter) || nameText.toLowerCase().includes(filter)) {
        rows[i].style.display = '';
      } else {
        rows[i].style.display = 'none';
      }
    }
  }
}
      function editModalClose(){
          document.getElementById('modalEdit').classList.add('hidden');
      }
  function filterByRole() {
    const selectedRole = document.getElementById('roleFilter').value;
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        if (selectedRole === 'Semua') {
            row.style.display = ''; // Show all rows
        } else {
            const roleCell = row.querySelector('td:nth-child(5)').textContent; // Role column
            row.style.display = (roleCell === selectedRole) ? '' : 'none';
        }
    });
}
</script>
</body>
</html>