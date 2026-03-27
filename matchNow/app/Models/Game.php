<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'team1_id',
        'team2_id',
        'terrain_id',
        'match_date',
        'status'
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }
}