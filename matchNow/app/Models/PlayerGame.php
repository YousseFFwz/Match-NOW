<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerGame extends Model
{
    protected $fillable = [
        'creator_id',
        'terrain_id',
        'match_date',
        'status'
    ];

    public function players()
    {
        return $this->belongsToMany(User::class, 'player_game_users');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
