<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-blue-600 to-indigo-800 flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-8">

    <!-- 🔙 Back -->
    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <h1 class="text-2xl font-bold text-center mb-6">
        ⚽ Create Player Match
    </h1>

    <!-- Errors -->
    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/player-games" class="space-y-4">
        @csrf

        <!-- Terrain -->
        <select name="terrain_id" class="w-full p-3 border rounded-lg">
            @foreach($terrains as $terrain)
                <option value="{{ $terrain->id }}">
                    {{ $terrain->name }} ({{ $terrain->location }})
                </option>
            @endforeach
        </select>

        <!-- Date -->
        <input type="date" name="date" class="w-full p-3 border rounded-lg">

        <!-- Time -->
        <select name="time" class="w-full p-3 border rounded-lg">
            @for($i = 8; $i <= 22; $i++)
                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">
                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                </option>
            @endfor
        </select>

        <button class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">
            Create Match
        </button>

    </form>

</div>
</div>