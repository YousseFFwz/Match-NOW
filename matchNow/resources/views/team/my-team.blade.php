<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gradient-to-r from-green-600 to-green-800 flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl p-8">

    <!-- Back -->
    <a href="/team-dashboard"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Dashboard
    </a>

    <!-- Header -->
    <div class="flex items-center gap-6">

        <!-- Logo -->
        <div class="text-center">
            <img src="{{ $team->logo ? asset('storage/'.$team->logo) : '/images/team.png' }}"
                 class="w-28 h-28 rounded-full border-4 border-green-500 object-cover">

            <input type="file" name="logo" form="teamForm" class="mt-2 text-sm">
        </div>

        <!-- Team Info -->
        <div>
            <h2 class="text-3xl font-bold">
                {{ $team->name }}
            </h2>

            <p class="text-gray-500 mt-1">
                Team Owner: {{ auth()->user()->name }}
            </p>
        </div>

        <!-- Badge -->
        <div class="ml-auto text-center">
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl shadow">
                <p class="text-2xl font-bold">TEAM</p>
                <span class="text-sm">STATUS</span>
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
    <form id="teamForm" method="POST" action="/team" enctype="multipart/form-data"
          class="mt-8 grid grid-cols-2 gap-4">
        @csrf

        <!-- Name -->
        <input name="name" value="{{ $team->name }}"
            class="p-3 border rounded-lg col-span-2">

        <!-- Save -->
        <div class="col-span-2">
            <button class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">
                Save Changes
            </button>
        </div>

    </form>

    <!-- Extra Info -->
    <div class="mt-8 grid grid-cols-3 gap-4 text-center">

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">0</p>
            <span class="text-gray-500 text-sm">Players</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">0</p>
            <span class="text-gray-500 text-sm">Matches</span>
        </div>

        <div class="bg-gray-100 p-4 rounded-xl">
            <p class="text-xl font-bold">Active</p>
            <span class="text-gray-500 text-sm">Status</span>
        </div>

    </div>

</div>
</div>