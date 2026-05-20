<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListaUzytkownika extends Model
{
    public $timestamps = false;

    protected $table = 'listy_uzytkownikow';

    protected $fillable = [
        'uzytkownik_id',
        'film_id',
        'status',
        'data_dodania',
        'data_obejrzenia',
    ];

    protected function casts(): array
    {
        return [
            'data_dodania' => 'date',
            'data_obejrzenia' => 'date',
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
}