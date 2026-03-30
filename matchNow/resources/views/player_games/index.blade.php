<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-blue-600 to-indigo-800 p-6">

<div class="max-w-6xl mx-auto">

    <!-- 🔙 Back -->
    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-white rounded-lg hover:bg-gray-200">
        ← Back
    </a>

    <h1 class="text-3xl font-bold text-white mb-6">
        ⚽ Player Matches
    </h1>

    <!-- Create Button -->
    <a href="/player-games/create"
       class="inline-block mb-6 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600">
        + Create Match
    </a>

    <div class="grid md:grid-cols-2 gap-6">

        @foreach($games as $game)

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">

            <!-- Players count -->
            <div class="text-right text-sm text-gray-500">
                👥 {{ $game->players->count() }}/10
            </div>

            <!-- Terrain -->
            <h3 class="text-lg font-bold">
                {{ $game->terrain->name }}
            </h3>

            <p class="text-gray-500">
                📍 {{ $game->terrain->location }}
            </p>

            <!-- Date -->
            <p class="mt-2 text-sm">
                🕒 {{ \Carbon\Carbon::parse($game->match_date)->format('d M Y - H:i') }}
            </p>

            <!-- Status -->
            <p class="mt-2 text-sm font-semibold 
                {{ $game->status === 'accepted' ? 'text-green-600' : 'text-yellow-500' }}">
                {{ ucfirst($game->status) }}
            </p>

            <!-- Join Button -->
            @if($game->status === 'pending')

                @if(!$game->players->contains(auth()->id()))
                    <form method="POST" action="/player-games/{{ $game->id }}/join">
                        @csrf
                        <button class="mt-4 w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                            Join Match
                        </button>
                    </form>
                @else
                    <p class="mt-4 text-green-600 text-center">
                        You joined ✔️
                    </p>
                @endif

            @else
                <p class="mt-4 text-center text-green-600">
                    Match Ready ✅
                </p>
            @endif

            <div class="flex flex-wrap gap-2">
    
                @foreach($game->players as $player)
                    <div class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full">
    
                        <img src="/images/player.png"
                            class="w-6 h-6 rounded-full object-cover">
    
                        <span class="text-sm">{{ $player->name }}</span>
    
                    </div>
                @endforeach
    
            </div>

            @if($game->players->contains(auth()->id()))

                <a href="/player-games/{{ $game->id }}"
                class="mt-4 block text-center bg-gray-900 text-white p-2 rounded-lg hover:bg-black">

                    Open Chat 💬
                </a>

            @endif
        </div>


        @endforeach


    </div>

</div>
</div>