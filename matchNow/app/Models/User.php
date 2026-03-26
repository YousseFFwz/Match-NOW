<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Fields اللي يمكن تعمرهم (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // مهم 🔥
    ];

    /**
     * Fields اللي خاصهم يتخباو
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ================= RELATIONS =================

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'owner_id');
    }
}