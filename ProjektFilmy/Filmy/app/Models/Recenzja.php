<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recenzja extends Model
{
    protected $table = 'recenzje';
    public $timestamps = false;

    protected $fillable = [
        'uzytkownik_id',
        'film_id',
        'tresc',
        'ukryta',
        'ukryta_przez',
        'data_dodania',
    ];

    protected function casts(): array
    {
        return [
            'ukryta' => 'boolean',
            'data_dodania' => 'datetime',
        ];
    }

    public function uzytkownik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function ukrytaPrzez(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ukryta_przez');
    }
}