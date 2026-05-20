<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rola',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function filmy(): HasMany
    {
        return $this->hasMany(Film::class, 'dodane_przez');
    }

    public function lista(): HasMany
    {
        return $this->hasMany(ListaUzytkownika::class, 'uzytkownik_id');
    }

    public function oceny(): HasMany
    {
        return $this->hasMany(Ocena::class, 'uzytkownik_id');
    }

    public function recenzje(): HasMany
    {
        return $this->hasMany(Recenzja::class, 'uzytkownik_id');
    }
}