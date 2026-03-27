<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-8">

    <!-- 🔙 Back -->
    <a href="{{ auth()->user()->role === 'team_owner' 
        ? '/team-dashboard' 
        : (auth()->user()->role === 'admin' ? '/admin' : '/dashboard') }}"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <!-- Title -->
    <h1 class="text-2xl font-bold text-center mb-6">
        ⚽ Create Match
    </h1>

    <!-- Success / Error -->
    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-600 p-3 mb-4 rounded-lg">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-600 p-3 mb-4 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Form -->
    <form method="POST" action="/games" class="space-y-4">
        @csrf

        <!-- Terrain -->
        <div>
            <label class="block text-sm font-semibold mb-1">Terrain</label>
            <select name="terrain_id" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500">
                @foreach($terrains as $terrain)
                    <option value="{{ $terrain->id }}">
                        {{ $terrain->name }} ({{ $terrain->location }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date -->
        <div>
            <label class="block text-sm font-semibold mb-1">Date</label>
            <input type="date" name="date"
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Time -->
        <div>
            <label class="block text-sm font-semibold mb-1">Time</label>
            <select name="time" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500">

                @for($i = 8; $i <= 22; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">
                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                    </option>
                @endfor

            </select>
        </div>

        <!-- Submit -->
        <button class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">
            Create Match
        </button>

    </form>

</div>
</div>