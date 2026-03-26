<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamJoinRequest extends Model
{
    protected $fillable = [
        'team_id',
        'player_id',
        'status'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function player()
    {
        return $this->belongsTo(\App\Models\User::class, 'player_id');
    }


}
