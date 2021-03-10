<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $hidden = [
        'id',
        'token',
        'refreshToken',
        'expiresIn',
        'email',
        'remember_token',
        'updated_at',
        'created_at',
    ];

    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
}
