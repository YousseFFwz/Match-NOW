<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Terrain;
use Carbon\Carbon;

class GameController extends Controller
{
    // show create page
    public function create()
    {
        $terrains = Terrain::all();
        return view('games.create', compact('terrains'));
    }

    // store match
 

public function store(Request $request)
{
    // ✅ validation
    $request->validate([
        'terrain_id' => 'required',
        'date' => 'required|date',
        'time' => 'required'
    ]);

    $team = auth()->user()->team;

    // 🕒 combine date + time
    $matchDateTime = Carbon::parse($request->date . ' ' . $request->time);

    // ❌ past check
    if ($matchDateTime->isPast()) {
        return back()->with('error', 'Match must be in the future');
    }

    // ⏱ define match duration (1h)
    $start = $matchDateTime;
    $end = (clone $start)->addHour();

    // ❌ terrain conflict
    $terrainExists = Game::where('terrain_id', $request->terrain_id)
        ->whereBetween('match_date', [$start, $end])
        ->exists();

    if ($terrainExists) {
        return back()->with('error', 'Terrain already booked at this time');
    }

    // ❌ team conflict
    $teamConflict = Game::where(function ($q) use ($team) {
            $q->where('team1_id', $team->id)
              ->orWhere('team2_id', $team->id);
        })
        ->whereBetween('match_date', [$start, $end])
        ->exists();

    if ($teamConflict) {
        return back()->with('error', 'Your team already has a match at this time');
    }

    $playersCount = $team->players()->count();

    if ($playersCount < 5) {
        return back()->with('error', 'You need at least 5 players to create a match');
    }

    // ✅ create match
    Game::create([
        'team1_id' => $team->id,
        'terrain_id' => $request->terrain_id,
        'match_date' => $matchDateTime,
        'status' => 'pending'
    ]);

    return redirect('/games')->with('success', 'Match created successfully');
}

    // show matches + filter
   public function index(Request $request)
{
    $team = auth()->user()->team;

    $query = \App\Models\Game::with('team1', 'terrain');

    // ❌ hide matches ديال نفس team
    $query->where('team1_id', '!=', $team->id);

    // filter by city
    if ($request->city) {
        $query->whereHas('terrain', function ($q) use ($request) {
            $q->where('location', $request->city);
        });
    }

    // غير pending matches
    $games = $query->where('status', 'pending')->get();

    return view('games.index', compact('games'));
}

    public function accept($id)
{
    $game = Game::findOrFail($id);

    $team = auth()->user()->team;

    // ❌ نفس الفريق
    if ($game->team1_id == $team->id) {
        return back()->with('error', 'You cannot accept your own match');
    }

    // ❌ team خاصها على الأقل 5 لاعبين
    if ($team->players()->count() < 5) {
        return back()->with('error', 'You need at least 5 players to accept a match');
    }

    // ❌ match already taken
    if ($game->team2_id !== null) {
        return back()->with('error', 'Match already accepted');
    }

    // ❌ conflict ديال الوقت
    $conflict = Game::where(function ($q) use ($team) {
            $q->where('team1_id', $team->id)
              ->orWhere('team2_id', $team->id);
        })
        ->where('match_date', $game->match_date)
        ->exists();

    if ($conflict) {
        return back()->with('error', 'Your team already has a match at this time');
    }

    // ✅ accept match
    $game->update([
        'team2_id' => $team->id,
        'status' => 'accepted'
    ]);

    return back()->with('success', 'Match accepted successfully');
}








    public function myMatches()
{
    $teamId = auth()->user()->profile->team_id;

    // إلا ما عندوش team
    if (!$teamId) {
        return back()->with('error', 'You are not in a team');
    }

    $games = \App\Models\Game::with('team1', 'team2', 'terrain')
        ->where(function ($q) use ($teamId) {
            $q->where('team1_id', $teamId)
              ->orWhere('team2_id', $teamId);
        })
        ->where('status', 'accepted') // غير matches المقبولة
        ->orderBy('match_date')
        ->get();

    return view('player.matches', compact('games'));
}

}