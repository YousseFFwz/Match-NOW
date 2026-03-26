<?php

namespace App\Http\Controllers;

 use App\Models\Profile;
use App\Models\TeamInvite;

class PlayerController extends Controller
{
    // list players
   

public function index()
{
    $players = Profile::with('user')->get();

    // default
    $invites = [];

    // غير team_owner
    if (auth()->user()->role === 'team_owner') {
        $team = auth()->user()->team;

        if ($team) {
            $invites = TeamInvite::where('team_id', $team->id)
                ->pluck('player_id')
                ->toArray();
        }
    }

    return view('players.index', compact('players', 'invites'));
}

    // show player profile
    public function show($id)
    {
        $player = Profile::with('user')->findOrFail($id);

        return view('players.show', compact('player'));
    }
}
