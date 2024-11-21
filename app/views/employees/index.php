<main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Employees</h2>
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ New Stock</button>
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
    </main>
  </div>
</body>
</html>
