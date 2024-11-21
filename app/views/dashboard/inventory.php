    <main class="flex-1 ml-64 p-8">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Inventory</h2>
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
              <th class="py-3 px-4 border">Order ID</th>
              <th class="py-3 px-4 border">Product</th>
              <th class="py-3 px-4 border">Category</th>
              <th class="py-3 px-4 border">Sales Channel</th>
              <th class="py-3 px-4 border">Instruction</th>
              <th class="py-3 px-4 border">Items</th>
              <th class="py-3 px-4 border">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-100">
              <td class="py-3 px-4 border">001</td>
              <td class="py-3 px-4 border">Tes</td>
              <td class="py-3 px-4 border">Tes</td>
              <td class="py-3 px-4 border">Tes</td>
              <td class="py-3 px-4 border">Tes</td>
              <td class="py-3 px-4 border">Tes</td>
              <td class="py-3 px-4 border">Tes</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
