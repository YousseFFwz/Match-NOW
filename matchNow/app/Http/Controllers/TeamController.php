<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $team = Auth::user()->team;

        return view('team.my-team', compact('team'));
    }

    public function update(Request $request)
    {
        $team = Auth::user()->team;

        $data = $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('teams', 'public');
            $data['logo'] = $path;
        }

        $team->update($data);

        return back()->with('success', 'Team updated');
    }
}
