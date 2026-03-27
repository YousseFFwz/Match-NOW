<script src="https://cdn.tailwindcss.com"></script>

<div class="p-10 bg-gray-100 min-h-screen">

    <a href="/admin"
        class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
            ← Back to Dashboard
        </a>

    <h1 class="text-2xl font-bold mb-6">Manage Terrains</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add -->
    <form method="POST" action="/admin/terrains" class="mb-6 flex gap-3">
        @csrf
        <input name="name" placeholder="Terrain name" class="p-2 border rounded">
        <input name="location" placeholder="Location" class="p-2 border rounded">
        <button class="bg-green-600 text-white px-4 rounded">Add</button>
    </form>

    <!-- List -->
    <div class="grid grid-cols-3 gap-4">

        @foreach($terrains as $terrain)
        <div class="bg-white p-4 rounded shadow">

            <h3 class="font-bold">{{ $terrain->name }}</h3>
            <p class="text-gray-500">{{ $terrain->location }}</p>

            <div class="flex gap-2 mt-3">

                <!-- Delete -->
                <form method="POST" action="/admin/terrains/{{ $terrain->id }}/delete">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>

</div>