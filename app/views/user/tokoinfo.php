<main class="flex-1 ml-64 mt-20 p-8"> 
    <div>
        <div class="flex gap-4 mb-4">
            <div class="bg-white min-h-[600px] shadow-md border border-zinc-100 w-2/5 p-6 rounded-lg ">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Account Information</h1>
                </div>
                <div class="mb-2">
                    <label for="userid">UID</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_id']?></p>
                </div>
                <div class="mb-2">
                    <label for="namauser">Nama Akun</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_name']?></p>
                </div>
                <div class="mb-2">
                    <label for="userrole">Role</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_role']?></p>
                </div>
                <div class="mb-2">
                    <label for="useremail">Email</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_email']?></p>
                </div>
                <div class="mb-2">
                    <label for="userphone">Nomor Telepon</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_phonenumber']?></p>
                </div>
                <div class="mb-2">
                    <label for="useraddress">Alamat</label>
                    <p class="text-gray-900 font-medium"><?=$_SESSION['user_address']?></p>
                </div>
            </div>
            <div class="bg-white shadow-md p-6 border border-zinc-100 rounded-lg w-full">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Store Information</h1>
                </div>

                <!-- Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Toko -->
                    <div>
                    <label for="namatoko" class="text-sm text-gray-700 block mb-1">Nama Toko</label>
                    <p class="text-gray-900 font-medium"><?=$data['namatoko']?></p>
                    </div>
                    <!-- Tipe Toko -->
                    <div>
                    <label for="tipetoko" class="text-sm text-gray-700 block mb-1">Tipe Toko</label>
                    <p class="text-gray-900 font-medium"><?=$data['tipetoko']?></p>
                    </div>
                    <!-- Lokasi -->
                    <div>
                    <label for="lokasi" class="text-sm text-gray-700 block mb-1">Lokasi</label>
                    <p class="text-gray-900 font-medium"><?=$data['lokasi']?></p>
                    </div>
                    <!-- Nomor Telepon Toko -->
                    <div>
                    <label for="telepontoko" class="text-sm text-gray-700 block mb-1">Nomor Telepon Toko</label>
                    <p class="text-gray-900 font-medium"><?=$data['telepontoko']?></p>
                    </div>
                    <!-- Email Toko -->
                    <div>
                    <label for="emailtoko" class="text-sm text-gray-700 block mb-1">Email Toko</label>
                    <p class="text-gray-900 font-medium"><?=$data['emailtoko']?></p>
                    </div>
                    <!-- Tahun Didirikan -->
                    <div>
                    <label for="yearfounded" class="text-sm text-gray-700 block mb-1">Tahun Didirikan</label>
                    <p class="text-gray-900 font-medium"><?=$data['yearfounded']?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md border border-zinc-100 min-h-[300px] min-w-screen rounded-lg">
            tes
        </div>
    </div>
</main>