<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <div class="bg-white shadow px-8 py-4 flex justify-between items-center">

        <h1 class="text-xl font-bold text-green-600">
            🏟️ Team Dashboard
        </h1>

        <div class="flex items-center gap-4">

            <span class="text-gray-600">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="/logout">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>

        </div>
    </div>

    <!-- Content -->
    <div class="p-10">

        <!-- Welcome -->
        <h2 class="text-2xl font-semibold mb-6">
            Welcome Coach 👋
        </h2>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- My Team -->
            <a href="/team"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-green-500">

                <h3 class="text-lg font-bold">My Team</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Edit your team info
                </p>

            </a>

            <!-- Players -->
            <a href="/players"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-blue-500">

                <h3 class="text-lg font-bold">Players</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Explore players & invite
                </p>

            </a>

            <!-- Invites -->
            <a href="/team/requests"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-purple-500">

                <h3 class="text-lg font-bold">Invites</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Manage invitations
                </p>

            </a>

            <!-- Matches -->
            <a href="#"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-l-4 border-yellow-500">

                <h3 class="text-lg font-bold">Matches</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Manage matches
                </p>

            </a>

        </div>

        <!-- Team Info -->
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <p class="text-2xl font-bold text-green-600">
                    {{ auth()->user()->team->name ?? 'No Team' }}
                </p>
                <span class="text-gray-500 text-sm">Team Name</span>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <p class="text-2xl font-bold text-blue-600">
                    0
                </p>
                <span class="text-gray-500 text-sm">Players</span>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <p class="text-2xl font-bold text-purple-600">
                    0
                </p>
                <span class="text-gray-500 text-sm">Matches</span>
            </div>

        </div>

    </div>

</div>