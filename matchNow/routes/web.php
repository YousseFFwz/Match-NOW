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

use App\Http\Controllers\TerrainController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
     Route::get('/admin/terrains', [TerrainController::class, 'index']);
    Route::post('/admin/terrains', [TerrainController::class, 'store']);
    Route::post('/admin/terrains/{id}/update', [TerrainController::class, 'update']);
    Route::post('/admin/terrains/{id}/delete', [TerrainController::class, 'destroy']);

});

use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamJoinController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerGameController;

Route::middleware(['auth', 'role:team_owner'])->group(function () {
  Route::get('/team-dashboard', function () {  
        return view('team.dashboard');
    });
    Route::get('/team', [TeamController::class, 'index']);
    Route::post('/team', [TeamController::class, 'update']);

    Route::get('/team/requests', [TeamJoinController::class, 'requests']);
    Route::post('/team/requests/{id}/accept', [TeamJoinController::class, 'accept']);
    Route::post('/team/requests/{id}/reject', [TeamJoinController::class, 'reject']);


    Route::post('/team/remove-player/{id}', [TeamController::class, 'removePlayer'])
    ->middleware(['auth', 'role:team_owner']);


    Route::get('/games/create', [GameController::class, 'create']);
    Route::post('/games', [GameController::class, 'store']);
    Route::post('/games/{id}/accept', [GameController::class, 'accept']);
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
    Route::get('/my-matches', [GameController::class, 'myMatches']);



     Route::get('/player-games/create', [PlayerGameController::class, 'create']);
    Route::post('/player-games', [PlayerGameController::class, 'store']);

    Route::get('/player-games', [PlayerGameController::class, 'index']);
    Route::post('/player-games/{id}/join', [PlayerGameController::class, 'join']);

});



use App\Http\Controllers\PlayerController;

Route::middleware(['auth'])->group(function () {
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::get('/games', [GameController::class, 'index']);

});




Route::post('/invite/{player}', [TeamInviteController::class, 'send'])
    ->middleware(['auth', 'role:team_owner']);
