<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class PlayerGameController extends Controller
{
    public function create()
{
    $terrains = \App\Models\Terrain::all();
    return view('player_games.create', compact('terrains'));
}




public function store(Request $request)
{
    $request->validate([
        'terrain_id' => 'required',
        'date' => 'required|date',
        'time' => 'required'
    ]);

    $matchDateTime = Carbon::parse($request->date . ' ' . $request->time);

    // ❌ منع الماضي
    if ($matchDateTime->isPast()) {
        return back()->with('error', 'Match must be in the future');
    }

    $game = \App\Models\PlayerGame::create([
        'creator_id' => auth()->id(),
        'terrain_id' => $request->terrain_id,
        'match_date' => $matchDateTime,
        'status' => 'pending'
    ]);

    // creator يدخل مباشرة
    $game->players()->attach(auth()->id());

    return redirect('/player-games')->with('success', 'Match created');
}




public function index()
{
    $games = \App\Models\PlayerGame::with('players', 'terrain')->get();

    return view('player_games.index', compact('games'));
}





public function join($id)
{
    $game = \App\Models\PlayerGame::with('players')->findOrFail($id);

    $userId = auth()->id();

    // ❌ 1. منع duplicate
    if ($game->players->contains($userId)) {
        return back()->with('error', 'You already joined this match');
    }

    // 🕒 match time
    $matchTime = \Carbon\Carbon::parse($game->match_date);

    // ❌ 2. منع player يكون عندو match فنفس الوقت
    $conflict = \App\Models\PlayerGame::whereHas('players', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->where('match_date', $matchTime)
        ->exists();

    if ($conflict) {
        return back()->with('error', 'You already have a match at this time');
    }

    // ❌ 3. منع إلا match عامر
    if ($game->players->count() >= 10) {
        return back()->with('error', 'Match is full');
    }

    // ✅ join
    $game->players()->attach($userId);

    // 🔥 auto confirm
    if ($game->players()->count() >= 10) {
        $game->update(['status' => 'accepted']);
    }

    return back()->with('success', 'Joined successfully');
}





}
