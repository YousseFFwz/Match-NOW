<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <div class="bg-white shadow px-8 py-4 flex justify-between items-center">

        <h1 class="text-xl font-bold text-blue-600">
            🛠️ Admin Dashboard
        </h1>

        <form method="POST" action="/logout">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                Logout
            </button>
        </form>

    </div>

    <!-- Content -->
    <div class="p-10">

        <h2 class="text-2xl font-semibold mb-6">
            Welcome Admin 👋
        </h2>

        <!-- Cards -->
        <div class="grid grid-cols-3 gap-6">

            <!-- Terrains -->
            <a href="/admin/terrains"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-green-500">

                <h3 class="text-lg font-bold">Terrains</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Manage football fields
                </p>

            </a>

            <!-- Players -->
            <a href="/players"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-blue-500">

                <h3 class="text-lg font-bold">Players</h3>
                <p class="text-gray-500 text-sm mt-1">
                    View all players
                </p>

            </a>

            <!-- Teams -->
            <a href="/teams"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-purple-500">

                <h3 class="text-lg font-bold">Teams</h3>
                <p class="text-gray-500 text-sm mt-1">
                    View all teams
                </p>

            </a>

        </div>

    </div>

</div>