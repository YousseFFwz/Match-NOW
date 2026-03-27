<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 p-6">

<div class="max-w-5xl mx-auto">

    <!-- 🔙 Back -->
    <a href="{{ auth()->user()->role === 'team_owner' 
        ? '/team-dashboard' 
        : (auth()->user()->role === 'admin' ? '/admin' : '/dashboard') }}"
       class="inline-block mb-6 px-4 py-2 bg-white rounded-lg hover:bg-gray-200">
        ← Back
    </a>

    <!-- Title -->
    <h1 class="text-3xl font-bold text-white mb-6">
        ⚽ Available Matches
    </h1>

    <!-- Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- 🔍 Filter -->
    <form method="GET" class="mb-6 flex gap-3">

        <input name="city" placeholder="Filter by city..."
               class="flex-1 p-3 rounded-lg border focus:ring-2 focus:ring-green-500">

        <button class="bg-white px-4 py-2 rounded-lg hover:bg-gray-200">
            Search
        </button>

    </form>

    <!-- Matches -->
    <div class="grid md:grid-cols-2 gap-6">

        @forelse($games as $game)

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">

            <!-- Team -->
            <h3 class="text-xl font-bold text-gray-800">
                {{ $game->team1->name }}
            </h3>

            <!-- Terrain -->
            <p class="text-gray-500 mt-1">
                📍 {{ $game->terrain->name }} - {{ $game->terrain->location }}
            </p>

            <!-- Date -->
            <p class="mt-2 text-sm text-gray-600">
                🕒 {{ \Carbon\Carbon::parse($game->match_date)->format('d M Y - H:i') }}
            </p>

            <!-- Accept -->
            @if(auth()->user()->role === 'team_owner')

                <form method="POST" action="/games/{{ $game->id }}/accept">
                    @csrf
                    <button class="mt-4 w-full bg-green-600 text-white p-2 rounded-lg hover:bg-green-700 transition">
                        Accept Match
                    </button>
                </form>

            @endif

        </div>

        @empty
            <p class="text-white">No matches found</p>
        @endforelse

    </div>

</div>
</div>