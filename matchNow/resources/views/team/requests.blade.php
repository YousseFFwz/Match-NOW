<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-6">Join Requests</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-6">

        @forelse($requests as $req)
        <div class="bg-white p-6 rounded-xl shadow text-center">

            <h3 class="font-bold text-lg">
                {{ $req->player->name }}
            </h3>

            <p class="text-gray-500 text-sm">
                wants to join your team
            </p>

            <div class="flex gap-3 mt-4 justify-center">

                <!-- Accept -->
                <form method="POST" action="/team/requests/{{ $req->id }}/accept">
                    @csrf
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
                        Accept
                    </button>
                </form>

                <!-- Reject -->
                <form method="POST" action="/team/requests/{{ $req->id }}/reject">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                        Reject
                    </button>
                </form>

            </div>

        </div>

        @empty
            <p>No requests yet</p>
        @endforelse

    </div>

</div>