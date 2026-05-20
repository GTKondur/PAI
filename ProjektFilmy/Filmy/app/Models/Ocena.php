<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ocena extends Model
{
    protected $table = 'oceny';
    public $timestamps = false;

    protected $fillable = [
        'uzytkownik_id',
        'film_id',
        'wartosc',
        'data_oceny',
    ];

    public function uzytkownik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uzytkownik_id');
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}