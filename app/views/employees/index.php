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
      
      </div>
  </div>
      <!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
    <!-- Header Modal -->
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold">Create Employee</h3>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
    </div>

    <!-- Formulir -->
    <form  action="<?= BASEURL; ?>/employees/createEmployee" method="POST">
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" name="name" required 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
      </div>

      <!-- Input Role -->
      <div class="mb-4">
        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
        <select id="role" name="role" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
          <option value="" disabled selected>-- Select Role --</option>
          <option value="Admin Gudang">Admin Gudang</option>
          <option value="Admin Kasir">Admin Kasir</option>
        </select>
      </div>

      <!-- Input Alamat -->
      <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <textarea id="address" name="address" required 
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
      </div>

      <!-- Input Nomor Telepon -->
      <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
        <input type="tel" id="phone" name="phonenumber" required 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
      </div>

      <!-- Input Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
      </div>

      <!-- Input Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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

    <script>
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