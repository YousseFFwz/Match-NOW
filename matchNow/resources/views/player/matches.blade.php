<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 p-6">

<div class="max-w-5xl mx-auto">

    <!-- Back -->
    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-white rounded-lg hover:bg-gray-200">
        ← Back
    </a>

    <h1 class="text-3xl font-bold text-white mb-6">
        ⚽ My Matches
    </h1>

    <div class="grid md:grid-cols-2 gap-6">

        @forelse($games as $game)

        <div class="bg-white p-6 rounded-2xl shadow">

            <!-- Teams -->
            <h3 class="font-bold text-lg text-center">
                {{ $game->team1->name }} 
                <span class="text-gray-500">vs</span> 
                {{ $game->team2->name ?? 'Waiting...' }}
            </h3>

            <!-- Terrain -->
            <p class="text-gray-500 mt-2 text-center">
                📍 {{ $game->terrain->name }} - {{ $game->terrain->location }}
            </p>

            <!-- Date -->
            <p class="text-center mt-2">
                🕒 {{ \Carbon\Carbon::parse($game->match_date)->format('d M Y - H:i') }}
            </p>

        </div>

        @empty
            <p class="text-white">No matches yet</p>
        @endforelse

    </div>

</div>
</div>