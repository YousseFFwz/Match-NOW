<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl p-8">

    <!-- Back -->
    <a href="/players"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <!-- Header -->
    <div class="flex items-center gap-8">

        <!-- Avatar -->
        <img src="{{ $player->avatar ? asset('storage/'.$player->avatar) : '/images/player.png' }}"
             class="w-32 h-32 rounded-full border-4 border-green-500 object-cover">

        <!-- Info -->
        <div>
            <h2 class="text-3xl font-bold">
                {{ $player->user->name }}
            </h2>

            <p class="text-gray-500 text-lg mt-1">
                {{ strtoupper(substr($player->position ?? 'NA', 0, 3)) }}
            </p>
        </div>

        <!-- Rating -->
        <div class="ml-auto text-center">
            <div class="bg-gradient-to-b from-yellow-300 to-yellow-500 px-6 py-4 rounded-xl shadow-lg">
                <p class="text-4xl font-bold">75</p>
                <span class="text-sm font-semibold">OVR</span>
            </div>
        </div>

    </div>

    <!-- Divider -->
    <div class="border-t my-6"></div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">{{ $player->age ?? '-' }}</p>
            <span class="text-gray-500 text-sm">Age</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">{{ strtoupper($player->preferred_foot ?? '-') }}</p>
            <span class="text-gray-500 text-sm">Foot</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">{{ $player->height ?? '-' }}</p>
            <span class="text-gray-500 text-sm">Height</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">{{ $player->weight ?? '-' }}</p>
            <span class="text-gray-500 text-sm">Weight</span>
        </div>

    </div>

</div>
</div>