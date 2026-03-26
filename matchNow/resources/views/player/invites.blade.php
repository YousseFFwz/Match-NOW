<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100 p-10">

    <a href="/dashboard"
       class="inline-block mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Back
    </a>

    <h1 class="text-3xl font-bold mb-6">My Invites</h1>

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

    <div class="grid grid-cols-2 gap-6">

        @forelse($invites as $invite)

        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="text-xl font-bold">
                {{ $invite->team->name }}
            </h3>

            <p class="text-gray-500 mb-4">
                Team invitation
            </p>

            <div class="flex gap-4">

                <!-- Accept -->
                <form method="POST" action="/invite/{{ $invite->id }}/accept">
                    @csrf
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
                        Accept
                    </button>
                </form>

                <!-- Reject -->
                <form method="POST" action="/invite/{{ $invite->id }}/reject">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                        Reject
                    </button>
                </form>

            </div>

        </div>

        @empty
            <p>No invites yet</p>
        @endforelse

    </div>

</div>