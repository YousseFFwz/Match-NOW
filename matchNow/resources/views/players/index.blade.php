<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100 p-10">

    <!-- Back -->
    <a href="
    {{ auth()->user()->role === 'team_owner' 
        ? '/team-dashboard' 
        : (auth()->user()->role === 'admin' 
            ? '/admin' 
            : '/dashboard') 
    }}"
    class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <h1 class="text-3xl font-bold mb-6">All Players</h1>

    <div class="grid grid-cols-4 gap-6">

        @foreach($players as $player)
        <div class="relative bg-gradient-to-b from-yellow-300 to-yellow-500 rounded-2xl shadow-xl p-4 text-center hover:scale-105 transition">

            <!-- Rating -->
            <div class="absolute top-2 left-2">
                <p class="text-xl font-bold">75</p>
            </div>

            <!-- Avatar -->
            <img src="{{ $player->avatar ? asset('storage/'.$player->avatar) : '/images/player.png' }}"
                 class="w-20 h-20 rounded-full mx-auto mt-6 border-2 border-white object-cover">

            <!-- Name -->
            <h3 class="font-bold mt-3">
                {{ $player->user->name }}
            </h3>

            <p class="text-sm text-gray-800">
                {{ $player->position ?? 'No position' }}
            </p>

            <!-- Profile -->
            <a href="/players/{{ $player->id }}"
               class="block mt-2 text-sm text-blue-700 underline">
                View Profile
            </a>

            <!-- 🔥 INVITE LOGIC -->
            @if(auth()->user()->role === 'team_owner')

                @if(!$player->team_id)

                    @if(!in_array($player->user_id, $invites))
                        <form method="POST" action="/invite/{{ $player->user_id }}">
                            @csrf
                            <button class="mt-3 w-full bg-green-600 text-white p-2 rounded-lg hover:bg-green-700">
                                Invite
                            </button>
                        </form>
                    @else
                        <p class="text-gray-600 mt-3 text-sm">
                            Already Invited
                        </p>
                    @endif

                @else
                    <p class="text-red-500 mt-3 text-sm">
                        Already in a team
                    </p>
                @endif

            @endif

        </div>
        @endforeach

    </div>

</div>