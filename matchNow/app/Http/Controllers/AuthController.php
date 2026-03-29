<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= REGISTER =================

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validation
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:player,team_owner',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // PLAYER → create profile
        if ($user->role === 'player') {
            Profile::create([
                'user_id' => $user->id,
            ]);
        } 

        // TEAM OWNER → create team مباشرة
        if ($user->role === 'team_owner') {
            Team::create([
                'name' => $user->name . "'s Team",
                'owner_id' => $user->id,
            ]);
        }

        // Login
        Auth::login($user);

        // Redirect حسب role
        return $this->redirectByRole();
    }

    // ================= LOGIN =================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email or password incorrect',
        ]);
    }

    // ================= LOGOUT =================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // ================= REDIRECT =================

    private function redirectByRole()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        if ($user->role === 'team_owner') {
            return redirect('/team-dashboard'); 
        }

        return redirect()->route('dashboard');
    }
}