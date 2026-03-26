<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100 p-10">

    <a href="/teams"
       class="mb-6 inline-block px-4 py-2 bg-gray-200 rounded-lg">
       ← Back
    </a>

    <!-- Header -->
    <div class="bg-white p-6 rounded-xl shadow mb-8 flex items-center gap-6">

        <img src="{{ $team->logo ? asset('storage/'.$team->logo) : '/images/team.png' }}"
             class="w-24 h-24 rounded-full object-cover">

        <div>
            <h2 class="text-2xl font-bold">{{ $team->name }}</h2>
            <p class="text-gray-500">Team Players</p>
        </div>

    </div>

    <!-- Players -->
    <div class="grid grid-cols-4 gap-6">

        @foreach($team->players as $player)
        <div class="bg-white p-4 rounded-xl shadow text-center">

            <img src="{{ $player->avatar ? asset('storage/'.$player->avatar) : '/images/player.png' }}"
                 class="w-16 h-16 rounded-full mx-auto mb-2">

            <h3 class="font-bold">{{ $player->user->name }}</h3>

            <p class="text-sm text-gray-500">
                {{ $player->position }}
            </p>

        </div>
        @endforeach

    </div>

</div>