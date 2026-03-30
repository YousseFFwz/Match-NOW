<script src="https://cdn.tailwindcss.com"></script>
<div class="bg-gray-900 p-6 rounded-2xl shadow-xl mt-6 text-white">
    <a href="/player-games"
   class="inline-flex items-center gap-2 mb-4 px-4 py-2 
          bg-gray-800 text-white rounded-lg 
          hover:bg-gray-700 transition">

    ← Back
</a>

    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
        💬 <span>Match Chat</span>
    </h3>

    <!-- Messages -->
    <div class="h-64 overflow-y-auto bg-gray-800 p-4 rounded-xl mb-4 space-y-4">

        @foreach($game->messages as $msg)

        <div class="flex items-end gap-2 
            {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">

            <!-- Avatar (غير للناس الآخرين) -->
            @if($msg->user_id !== auth()->id())
                <img src="/images/player.png"
                     class="w-8 h-8 rounded-full object-cover">
            @endif

            <div class="max-w-xs">

                <!-- Name -->
                <p class="text-xs text-gray-400 mb-1 
                    {{ $msg->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                    {{ $msg->user->name }}
                </p>

                <!-- Bubble -->
                <div class="px-4 py-2 rounded-2xl shadow
                    {{ $msg->user_id === auth()->id() 
                        ? 'bg-blue-600 text-white rounded-br-none' 
                        : 'bg-gray-700 text-gray-200 rounded-bl-none' }}">

                    <p class="text-sm">
                        {{ $msg->message }}
                    </p>

                    <!-- Time -->
                    <p class="text-[10px] mt-1 opacity-70 text-right">
                        {{ $msg->created_at->format('H:i') }}
                    </p>
                </div>

            </div>

            <!-- Avatar ديالك -->
            @if($msg->user_id === auth()->id())
                <img src="/images/player.png"
                     class="w-8 h-8 rounded-full object-cover">
            @endif

        </div>

        @endforeach

    </div>

    <!-- Send -->
    <form method="POST" action="/player-games/{{ $game->id }}/message">
        @csrf

        <div class="flex items-center gap-2 bg-gray-800 p-2 rounded-xl">

            <input name="message"
                class="flex-1 bg-transparent text-white outline-none px-2 placeholder-gray-400"
                placeholder="Type a message...">

            <button class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Send
            </button>

        </div>
    </form>

</div>