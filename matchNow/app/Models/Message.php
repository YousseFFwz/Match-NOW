<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Message extends Model
{
    protected $fillable = [
        'user_id',
        'player_game_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(PlayerGame::class, 'player_game_id');
    }
}
