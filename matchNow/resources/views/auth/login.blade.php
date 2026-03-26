
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
<script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

    <h2 class="text-2xl font-bold text-center mb-6">Welcome Back</h2>

    <form method="POST" action="/login" class="space-y-4">
        @csrf

        <input name="email" type="email" placeholder="Email"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

        <input name="password" type="password" placeholder="Password"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button type="submit"
            class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">
            Login
        </button>
    </form>

    <p class="text-center mt-4 text-sm">
        Don’t have an account?
        <a href="/register" class="text-blue-600 hover:underline">Register</a>
    </p>

</div>

</body>
</html>