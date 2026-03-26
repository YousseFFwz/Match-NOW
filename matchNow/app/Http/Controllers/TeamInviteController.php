<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamInvite;
use Illuminate\Support\Facades\Auth;

class TeamInviteController extends Controller
{
   public function send($playerId)
{
    $team = auth()->user()->team;

    $profile = \App\Models\Profile::where('user_id', $playerId)->first();

    // 🔥 نفس الفريق
    if ($profile->team_id === $team->id) {
        return back()->with('error', 'Player already in your team');
    }

    // player عندو team أخرى
    if ($profile->team_id) {
        return back()->with('error', 'Player already in another team');
    }

    \App\Models\TeamInvite::firstOrCreate([
        'team_id' => $team->id,
        'player_id' => $playerId,
    ]);

    return back()->with('success', 'Invite sent');
}



   

public function index()
{
    $invites = TeamInvite::where('player_id', Auth::id())
        ->where('status', 'pending')
        ->with('team')
        ->get();

    return view('player.invites', compact('invites'));
}

public function accept($id)
{
    $invite = TeamInvite::findOrFail($id);

    // تأكد أنه ديال نفس user
    if ($invite->player_id !== auth()->id()) {
        abort(403);
    }

    $profile = auth()->user()->profile;

    // 🔥 المنع هنا
    if ($profile->team_id) {
        return back()->with('error', 'You already belong to a team');
    }

    // قبول الطلب
    $invite->update([
        'status' => 'accepted'
    ]);

    // إدخال player للفريق
    $profile->update([
        'team_id' => $invite->team_id
    ]);

    return back()->with('success', 'Joined team successfully');
}

public function reject($id)
{
    $invite = TeamInvite::findOrFail($id);

    if ($invite->player_id !== Auth::id()) {
        abort(403);
    }

    $invite->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Invite rejected');
}
}