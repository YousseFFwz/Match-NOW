<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
});

use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamJoinController;


Route::middleware(['auth', 'role:team_owner'])->group(function () {
  Route::get('/team-dashboard', function () {  
        return view('team.dashboard');
    });
    Route::get('/team', [TeamController::class, 'index']);
    Route::post('/team', [TeamController::class, 'update']);

    Route::get('/team/requests', [TeamJoinController::class, 'requests']);
    Route::post('/team/requests/{id}/accept', [TeamJoinController::class, 'accept']);
    Route::post('/team/requests/{id}/reject', [TeamJoinController::class, 'reject']);
});


use App\Http\Controllers\TeamInviteController;


Route::middleware(['auth', 'role:player'])->group(function () {
    Route::get('/dashboard', fn() => view('player.dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::get('/my-invites', [TeamInviteController::class, 'index']);
    Route::post('/invite/{id}/accept', [TeamInviteController::class, 'accept']);
    Route::post('/invite/{id}/reject', [TeamInviteController::class, 'reject']);
    Route::get('/teams', [TeamJoinController::class, 'index']);
    Route::post('/teams/{team}/join', [TeamJoinController::class, 'send']);
    Route::get('/teams/{team}', [TeamJoinController::class, 'show']);
});



use App\Http\Controllers\PlayerController;

Route::middleware(['auth'])->group(function () {
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
});




Route::post('/invite/{player}', [TeamInviteController::class, 'send'])
    ->middleware(['auth', 'role:team_owner']);
