<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Team;
use App\Models\TeamJoinRequest;
use Illuminate\Support\Facades\Auth;


class TeamJoinController extends Controller
{
    public function index()
    {
        $teams = Team::all();

        $requests = TeamJoinRequest::where('player_id', auth()->id())
            ->pluck('team_id')
            ->toArray();

        return view('player.teams', compact('teams', 'requests'));
    }

    public function send($teamId)
{
    $profile = auth()->user()->profile;

    // منع إذا عندو team
    if ($profile->team_id) {
        return back()->with('error', 'You already have a team');
    }

    TeamJoinRequest::firstOrCreate([
        'team_id' => $teamId,
        'player_id' => auth()->id(),
    ]);

    return back()->with('success', 'Request sent');
}



    public function show($id)
{
    $team = \App\Models\Team::findOrFail($id);

return view('player.team-show', compact('team'));
}


   

        public function requests()
        {
            $team = Auth::user()->team;

            $requests = TeamJoinRequest::where('team_id', $team->id)
                ->where('status', 'pending')
                ->with('team', 'player') // player relation
                ->get();

            return view('team.requests', compact('requests'));
        }



        public function accept($id)
{
    $request = TeamJoinRequest::findOrFail($id);

    $profile = \App\Models\Profile::where('user_id', $request->player_id)->first();

    // منع يكون عندو team
    if ($profile->team_id) {
        return back()->with('error', 'Player already in a team');
    }

    // قبول الطلب
    $request->update([
        'status' => 'accepted'
    ]);

    // دخلو للفريق
    $profile->update([
        'team_id' => $request->team_id
    ]);

    return back()->with('success', 'Player added to team');
}



public function reject($id)
{
    $request = TeamJoinRequest::findOrFail($id);

    $request->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Request rejected');
}
}
