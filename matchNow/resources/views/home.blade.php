
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Football Academy</title>
<script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="flex justify-between items-center px-10 py-4 bg-white shadow">
    <h1 class="text-xl font-bold text-green-600">Match Now</h1>

    <div class="space-x-4">
        <a href="/login" class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition">
            Login
        </a>
        <a href="/register" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            Register
        </a>
    </div>
</nav>

<!-- Hero Section -->
<section class="flex items-center justify-between px-10 py-16">

    <!-- Text -->
    <div class="max-w-xl">
        <h1 class="text-5xl font-bold leading-tight">
            Welcome to best <br>
            <span class="text-green-600">Football</span> Academy
        </h1>

        <p class="mt-6 text-gray-600">
            Train like a pro, join teams, compete, and grow your football skills with the best academy platform.
        </p>

        <div class="mt-8 space-x-4">
            <a href="/register" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Join Now
            </a>

            <a href="/login" class="px-6 py-3 border border-gray-400 rounded-lg hover:bg-gray-200 transition">
                Login
            </a>
        </div>
    </div>

    <!-- Image -->
    <div class="relative">
        <div class="absolute inset-0 bg-green-600 rounded-full w-[600px] h-[400px] right-0 opacity-20 blur-2xl"></div>

        <img src="/images/player.png" alt="player"
             class="relative w-[600px] z-10">
    </div>

</section>

</body>
</html>