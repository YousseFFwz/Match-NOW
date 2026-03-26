<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->profile;

        return view('player.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        $data = $request->validate([
            'age' => 'nullable|integer',
            'position' => 'nullable|string',
            'preferred_foot' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // upload avatar
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }
        if (!$profile) {
        $profile = \App\Models\Profile::create([
            'user_id' => Auth::id(),
        ]);
}

        $profile->update($data);

        return back()->with('success', 'Profile updated');
    }
}
