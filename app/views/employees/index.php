<main class="flex-1 ml-24 mt-20 p-8">
      <div class="flex items-center mb-4 space-x-4">
        <button onclick="openModal()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Create Employee</button>
        <form id="searchForm" class="flex items-center">
  <input type="search" id="searchInput" placeholder="Cari berdasarkan UID/Nama." name="search" class="border rounded px-4 py-2">

</form>
          <input type="date" class="border rounded px-4 py-2">
          <select class="border rounded px-4 py-2">
          <option>Role</option>
          <option>Owner</option>
          <option>Admin Kasir</option>
          <option>Admin Gudang</option>
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
              <th class="py-3 px-4 border">Actions</th>
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
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <h3 class="text-l text-center">Buatkan Akun untuk Karyawanmu!</h3>
    <!-- Formulir -->
    <form action="<?= BASEURL; ?>/employees/createEmployee" method="POST" id="createEmployeeForm">
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

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold w-full text-center">Update Employee</h3>
      <button onclick="editModalClose()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold p-2">&times;</button>
    </div>
    <h3 class="text-l text-center">Update Akun untuk Karyawanmu!</h3>
    <form action="<?= BASEURL; ?>/employees/updateEmployee" method="post" id="editEmployeeForm" class="bg-white w-full max-w-[600px] max-h-[1000px] p-6 rounded-lg" enctype="multipart/form-data">
      <div class="flex gap-4 mb-6">
        <input type="hidden" id="editId" name="id">
        <!-- Input Nama -->
        <div class="w-1/2">
          <label for="name" class="block text-sm font-medium text-gray-700">Name<label class="text-red-500">*</label></label>
          <input type="text" id="editName" name="name"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="nameErrorEdit" class="text-red-500 error"></span>
        </div>

        <!-- Input Role -->
        <div class="w-1/2">
          <label for="role" class="block text-sm font-medium text-gray-700">Role<label class="text-red-500">*</label></label>
          <input type="text" id="editRole" name="role"
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="roleErrorEdit" class="text-red-500 error"></span>
        </div>
      </div>
      <div class="flex gap-4 mb-6">
        <!-- Input Alamat -->
        <div class="w-1/2"> 
          <label for="address" class="block text-sm font-medium text-gray-700">Address<label class="text-red-500">*</label></label>
          <input type="text" id="editAddress" name="address" 
                class="w-full bg-[#D9D9D9] text-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span id="addressErrorEdit" class="text-red-500 error"></span>
        </div>

        <!-- Input Nomor Telepon -->
        <div class="w-1/2">
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number<label class="text-red-500">*</label></label>
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
          Update Employee
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

// Add this function for real-time search
document.getElementById('searchInput').addEventListener('input', function(event) {
  // Optional: Add a slight delay to prevent too many API calls
  clearTimeout(this.searchTimeout);
  this.searchTimeout = setTimeout(() => {
    performSearch();
  }, 300); // 300ms delay
});

function performSearch() {
  // Ambil nilai input pencarian
  const searchValue = document.getElementById('searchInput').value.trim();
  const tbody = document.querySelector('tbody');

  // Jika input kosong, kembalikan ke tampilan awal
  if (searchValue === "") {
    // You might want to reload the original data here
    // For now, we'll just keep the existing rows
    return;
  }

  // Gunakan fetch untuk mengirim permintaan AJAX
  fetch('<?= BASEURL; ?>/employees/searchEmployee', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      search: searchValue,
    }),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Hapus semua baris tabel lama
    tbody.innerHTML = '';

    // Periksa apakah ada data
    if (data.users && data.users.length > 0) {
      // Tampilkan hasil pencarian dalam tabel
      data.users.forEach((user, index) => {
        const row = document.createElement('tr');
        row.classList.add('hover:bg-gray-100');
        row.innerHTML = `
          <td scope="row" class="py-3 px-4 border">${index + 1}</td>
          <td class="py-3 px-4 border">${user.USER_ID}</td>
          <td class="py-3 px-4 border">${user.EMAIL}</td>
          <td class="py-3 px-4 border">${user.NAME}</td>
          <td class="py-3 px-4 border">${user.ROLE}</td>
          <td class="py-3 px-4 border">${user.ADDRESS}</td>
          <td class="py-3 px-4 border">${user.PHONE_NUMBER}</td>
          <td class="py-3 px-4 border flex justify-center items-center">
            <button onclick="editModalOpen('${user.USER_ID}')" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600">
              <img src="<?= BASEURL; ?>/img/setting-logo.png" width="20px" height="20px" alt="logo edit">
            </button>
          </td>
        `;
        tbody.appendChild(row);
      });
    } else {
      // Tampilkan pesan jika tidak ada hasil
      const noResultRow = document.createElement('tr');
      noResultRow.innerHTML = `
        <td colspan="8" class="text-center py-4 text-gray-500">
          Tidak ada karyawan yang ditemukan dengan kata kunci "${searchValue}"
        </td>
      `;
      tbody.appendChild(noResultRow);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    // Tampilkan pesan kesalahan
    tbody.innerHTML = `
      <tr>
        <td colspan="8" class="text-center py-4 text-red-500">
          Terjadi kesalahan dalam pencarian. Silakan coba lagi.
        </td>
      </tr>
    `;
  });
}

// Optional: Tambahkan event listener untuk tombol Enter
document.getElementById('searchInput').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault(); // Mencegah form submit
    performSearch();
  }
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

      function editModalClose(){
          document.getElementById('modalEdit').classList.add('hidden');
      }
    </script>
</body>
</html>