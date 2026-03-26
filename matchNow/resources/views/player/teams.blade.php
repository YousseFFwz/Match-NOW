<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 p-10">

    <!-- Back -->
    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-white rounded-lg hover:bg-gray-200">
        ← Back
    </a>

    <h1 class="text-3xl font-bold text-white mb-8">All Teams</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-6">

        @foreach($teams as $team)
        <div class="bg-gradient-to-b from-purple-400 to-purple-600 rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition">

            <!-- Click -->
            <a href="/teams/{{ $team->id }}">
                <img src="{{ $team->logo ? asset('storage/'.$team->logo) : '/images/team.png' }}"
                     class="w-20 h-20 rounded-full mx-auto border-2 border-white object-cover">

                <h3 class="font-bold text-lg mt-3 text-white">
                    {{ $team->name }}
                </h3>
            </a>

            <!-- JOIN LOGIC -->
            @php
                $profile = auth()->user()->profile;
            @endphp

            @if(!$profile->team_id)

                @if(!in_array($team->id, $requests))
                    <form method="POST" action="/teams/{{ $team->id }}/join">
                        @csrf
                        <button class="mt-4 w-full bg-white text-purple-700 p-2 rounded-lg font-semibold hover:bg-gray-200">
                            Join
                        </button>
                    </form>
                @else
                    <p class="mt-4 text-white text-sm">Request Sent</p>
                @endif

            @else
                <p class="mt-4 text-red-200 text-sm">
                    You are already in a team
                </p>
            @endif

        </div>
        @endforeach

    </div>

</div>