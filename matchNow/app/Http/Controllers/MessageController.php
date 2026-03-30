<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, $gameId)
{
    $game = \App\Models\PlayerGame::with('players')->findOrFail($gameId);

    // ❌ غير players ديال match
    if (!$game->players->contains(auth()->id())) {
        return back()->with('error', 'Not allowed');
    }

    $request->validate([
        'message' => 'required'
    ]);

    \App\Models\Message::create([
        'user_id' => auth()->id(),
        'player_game_id' => $gameId,
        'message' => $request->message
    ]);

    return back();
}



public function show($id)
{
    $game = \App\Models\PlayerGame::with('players', 'messages.user', 'terrain')->findOrFail($id);

    return view('player_games.show', compact('game'));
}
}
