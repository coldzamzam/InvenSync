<main class="bg-gray-900 text-white h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted class="absolute top-0 left-0 w-full h-full object-cover">
        <source src="<?= BASEURL; ?>/videos/background-edited.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Content Section -->
    <div class="relative z-10 text-center p-6 bg-opacity-60 bg-gray-800 rounded-lg shadow-lg max-w-lg mx-auto">
        <h1 class="text-4xl font-bold mb-4">Welcome to InvenSync</h1>
        <p class="text-lg mb-6">
            Simplify your inventory management with our comprehensive system. InvenSync ensures accurate tracking, seamless organization, and effortless control of your inventory.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="<?= BASEURL; ?>/user/login" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Get Started
            </a>
            <a href="#" class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Learn More
            </a>
        </div>
    </div>
</main>
</body>
</html>
