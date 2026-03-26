<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamInvite extends Model
{
  
    protected $fillable = [
        'team_id',
        'player_id',
        'status'
    ];


    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class);
    }

}
