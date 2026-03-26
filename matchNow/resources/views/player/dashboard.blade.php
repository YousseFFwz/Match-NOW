<!-- resources/views/player/dashboard.blade.php -->

<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <div class="bg-white shadow p-4 flex justify-between items-center">

        <h1 class="text-xl font-bold text-green-600">Player Dashboard</h1>

        <div class="space-x-4">
            <a href="/profile" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                My Profile
            </a>

            <form method="POST" action="/logout" class="inline">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Content -->
    <div class="p-10">

        <h2 class="text-2xl font-semibold mb-4">
            Welcome {{ auth()->user()->name }} 👋
        </h2>

        <div class="grid grid-cols-3 gap-6">

            <a href="/profile" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-lg font-bold">Profile</h3>
                <p class="text-gray-500">Manage your football profile</p>
            </a>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold">Teams</h3>
                <p class="text-gray-500">Coming soon...</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold">Matches</h3>
                <p class="text-gray-500">Coming soon...</p>
            </div>

            <a href="/players" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition block">
                <h3 class="text-lg font-bold">Players</h3>
                <p class="text-gray-500">Explore all players</p>
            </a>

            <a href="/my-invites"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-green-500">

                <h3 class="font-bold text-lg">My Invites</h3>
                <p class="text-gray-500 text-sm">View team invitations</p>

            </a>

            <a href="/teams"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-purple-500">

            <h3 class="text-lg font-bold">Teams</h3>

            <p class="text-gray-500 text-sm mt-1">
                Join a team
            </p>

        </a>

        </div>

    </div>

</div>