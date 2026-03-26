<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

    <h2 class="text-2xl font-bold text-center mb-6">Create Account</h2>

    <!-- Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <input name="name" placeholder="Name"
            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">

        <input name="email" type="email" placeholder="Email"
            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">

        <!-- ROLE -->
        <div>
            <label class="text-sm text-gray-600">Select Role</label>

            <div class="flex gap-4 mt-2">

                <label class="flex items-center gap-2">
                    <input type="radio" name="role" value="player" checked>
                    Player
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="role" value="team_owner">
                    Team Owner
                </label>

            </div>
        </div>

        <input name="password" type="password" placeholder="Password"
            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">

        <input name="password_confirmation" type="password" placeholder="Confirm Password"
            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">

        <button type="submit"
            class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">
            Register
        </button>
    </form>

    <p class="text-center mt-4 text-sm">
        Already have an account?
        <a href="/login" class="text-blue-600 hover:underline">Login</a>
    </p>

</div>

</body>
</html>