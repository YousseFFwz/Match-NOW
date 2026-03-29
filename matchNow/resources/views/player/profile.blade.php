<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-8">

    <!-- Back -->
    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <!-- Header -->
    <div class="flex items-center gap-6">

        <!-- Avatar -->
        <div class="text-center">
            <img src="{{ $profile?->avatar ? asset('storage/'.$profile->avatar) : '/images/player.png' }}"
                 class="w-28 h-28 rounded-full border-4 border-green-500 object-cover">

            <input type="file" name="avatar" form="profileForm" class="mt-2 text-sm">
        </div>

        <!-- Info -->
        <div>
            <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
            <p class="text-gray-500">
                {{ $profile->position ?? 'No position' }}
            </p>
        </div>

        <!-- FIFA Style Rating -->
        <div class="ml-auto text-center">
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl shadow">
                <p class="text-3xl font-bold">75</p>
                <span class="text-sm">OVR</span>
            </div>
        </div>

    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mt-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form id="profileForm" method="POST" action="/profile" enctype="multipart/form-data" class="mt-8 grid grid-cols-2 gap-4">
        @csrf

        <!-- Age -->
        <input name="age" value="{{ $profile?->age }}" placeholder="Age"
            class="p-3 border rounded-lg">

        <!-- Position (SELECT) -->
        <select name="position" class="p-3 border rounded-lg">
            <option value="">Select Position</option>
            <option value="goalkeeper" @selected($profile?->position == 'goalkeeper')>GK</option>
            <option value="defender" @selected($profile?->position == 'defender')>DEF</option>
            <option value="attacker" @selected($profile?->position == 'attacker')>ATT</option>
        </select>

        <!-- Preferred Foot -->
        <select name="preferred_foot" class="p-3 border rounded-lg">
            <option value="">Preferred Foot</option>
            <option value="right" @selected($profile?->preferred_foot == 'right')>Right</option>
            <option value="left" @selected($profile?->preferred_foot == 'left')>Left</option>
        </select>

        <!-- Height -->
        <input name="height" value="{{ $profile?->height }} (cm)" placeholder="Height (cm)"
            class="p-3 border rounded-lg">

        <!-- Weight -->
        <input name="weight" value="{{ $profile?->weight }} (kg)" placeholder="Weight (kg)"
            class="p-3 border rounded-lg">

        <!-- Save -->
        <div class="col-span-2">
            <button class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700">
                Save Profile
            </button>
        </div>

    </form>

</div>
</div>