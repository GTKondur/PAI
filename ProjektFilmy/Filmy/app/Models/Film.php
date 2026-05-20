<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    protected $table = 'filmy';
    protected $fillable = [
        'tytul',
        'tytul_oryginalny',
        'rok_produkcji',
        'opis',
        'czas_trwania_min',
        'plakat_url',
        'rezyser',
        'typ',
        'dodane_przez',
    ];

    public function dodanyPrzez(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dodane_przez');
    }

    public function gatunki(): BelongsToMany
    {
        return $this->belongsToMany(Gatunek::class, 'film_gatunek', 'film_id', 'gatunek_id');
    }

    public function listaUzytkownikow(): HasMany
    {
        return $this->hasMany(ListaUzytkownika::class, 'film_id');
    }

    public function oceny(): HasMany
    {
        return $this->hasMany(Ocena::class, 'film_id');
    }

    public function recenzje(): HasMany
    {
        return $this->hasMany(Recenzja::class, 'film_id');
    }

    public function srednia_ocena(): float
    {
        return round($this->oceny()->avg('wartosc') ?? 0, 1);
    }
}